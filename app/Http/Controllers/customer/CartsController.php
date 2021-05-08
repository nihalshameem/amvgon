<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\api\customer;
use App\Models\Cart;
use App\Models\ComboDetail;
use App\Models\ComboProduct;
use App\Models\Coupon;
use App\Models\District;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\DeliveryDay;
use Auth;
use Illuminate\Http\Request;
use Session;

class CartsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:customer');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function cartList(Request $request)
    {
        $user = auth()->user();
        if($request->exists('day')){
            $day = DeliveryDay::where('name',$request->day)->where('status',1)->first();
        }else {
            $day = DeliveryDay::where('status',1)->first();
        }
        if($day !== null){
            $day = $day->name;
        }
        $carts = Cart::where('customer_id', $user->id)->get();
        $addresses = Address::where('customer_id', $user->id)->get();
        $payment_methods = PaymentMethod::all();
        $x = 0;
        $combos = [];
        $products = [];
        $final_amount = 0;
        $final_qty = 0;
        foreach ($carts as $cart) {
            if ($cart->price_type == 'normal') {
                $price = 'price';
                $stock = 'stock';
                $minqty = 'min_qty';
            } else {
                $price = $cart->price_type . '_price';
                $stock = $cart->price_type . '_stock';
                $minqty = $cart->price_type . '_min_qty';
            }
            if ($cart->product_id !== null) {

                $products[$x] = Product::find($cart->product_id);
                $products[$x]->cart_id = $cart->id;
                $products[$x]->qty = $cart->qty;
                $products[$x]->day = $cart->day;
                $products[$x]->minqty = $products[$x]->$minqty * 1000;
                $products[$x]->price_type = $cart->price_type;
                $products[$x]->total = ($products[$x]->$price * $cart->qty);
                if($cart->day == 'today'){
                    if ($cart->qty > $products[$x]->$stock) {
                        $products[$x]->overflow = 'out of stock';
                    }else{
                        $final_amount = $final_amount + $products[$x]->total;
                        $final_qty = $final_qty + $products[$x]->qty;
                    }
                } else {
                    $final_amount = $final_amount + $products[$x]->total;
                    $final_qty = $final_qty + $products[$x]->qty;
                }
                $products = array_values($products);
            } else {
                $combo[$x] = ComboProduct::find($cart->combo_id);
                $combo[$x]->cart_id = $cart->id;
                $combo[$x]->day = $cart->day;
                $details = ComboDetail::where('combo_id', $cart->combo_id)->get();
                $instock = true;
                $combo_price = 0;
                $y = 0;
                foreach ($details as $d) {
                    $p = Product::find($d->product_id);
                    if ($d->type == 'normal') {
                        $c_price = 'price';
                        $c_stock = 'stock';
                        $c_minqty = 'min_qty';
                    } else {
                        $c_price = $d->type . '_price';
                        $c_stock = $d->type . '_stock';
                        $c_minqty = $d->type . '_min_qty';
                    }
                    $remin_qty[$y] = $p->$c_minqty;
                    $d->price = $p->$c_price;
                    $d->qty = $cart->qty;
                    $combo_price = $combo_price + ($p->$c_price * $cart->qty);
                    if($cart->day == 'today'){
                        if ($p->$c_stock < $cart->qty) {
                            $instock = false;
                        }
                    }
                    $y++;
                }
                $combo[$x]->remin_qty = min($remin_qty) * 1000;
                $combo[$x]->combo_price = $combo_price;
                $combo[$x]->qty = $cart->qty;
                $combo_discount = $combo[$x]->discount / 100;
                $combo_total = $combo_price - $combo_price * $combo_discount;
                $combo[$x]->combo_total = number_format((float) $combo_total, 2, '.', '');
                $combo[$x]->details = $details;
                if ($instock !== true) {
                    $combo[$x]->overflow = 'out of stock';
                } else {
                    $final_amount = $final_amount + $combo[$x]->combo_total;
                    $final_qty = $final_qty + $combo[$x]->qty * $combo[$x]->product_count;
                }
                $combos = array_values($combo);
            }
            $x++;
        }
        foreach ($addresses as $address) {
            $dis = District::find($address->district);
            $address->district = $dis->name;
        }
        $districts = District::where('status', 1)->get();
        return view('customer.cart.cart-list', [
            'combos' => $combos,
            'carts' => $products,
            'addresses' => $addresses,
            'payment_methods' => $payment_methods,
            'districts' => $districts,
            'final_qty' => $final_qty,
            'final_amount' => $final_amount,
            'day' => $day,
        ]);
    }
    public static function addCartAjax(Request $request)
    {
        $user_id = auth()->user()->id;
        $day = $request->day;
        $dayCheck = Cart::where('customer_id',$user_id)->get();
        if($dayCheck !== null){
            foreach($dayCheck as $dc){
                if($dc->day !== $day){
                    return response()->json(['dp' => '1']);
                }
            }
        }
        $product = Product::find($request->product_id);
        if ($request->price_type == 'normal') {
            $stock_type = 'stock';
        } else {
            $stock_type = $request->price_type . '_stock';
        }
        $userCarts = Cart::where('customer_id', $user_id)->get();
        foreach ($userCarts as $cart) {
            if ($cart->product_id == $request->product_id) {
                if ($cart->price_type == $request->price_type) {
                    $old = Cart::find($cart->id);
                    $old->qty = $old->qty + $request->qty;
                    if($day == 'today'){
                        if ($product->$stock_type < $old->qty) {
                            return response()->json(['ofs' => '1']);
                        }
                    }
                    $old->save();
                    return response()->json([
                        'update' => '1',
                    ]);
                }
            }
        }
        if($day == 'today'){
            if ($product->$stock_type < $request->qty) {
                return response()->json(['ofs' => '1']);
            }
        }
        $newcart = Cart::create([
            'customer_id' => $user_id,
            'product_id' => $request->product_id,
            'qty' => $request->qty,
            'price_type' => $request->price_type,
            'day' => $day,
        ]);
        return response()->json([
            'success' => '1',
        ]);
    }
    public static function addCart(Request $request, $id)
    {
        $user_id = auth()->user()->id;
        $day = $request->day;
        $dayCheck = Cart::where('customer_id',$user_id)->get();
        if($dayCheck !== null){
            foreach($dayCheck as $dc){
                    if($dc->day !== $day){
                        if($day == 'today'){
                            $dp = 'tomorrow';
                        }else {
                            $dp = 'today';
                        }
                        Session::flash('error','Cart has '.$dp.' product, Please Clear and continue!');
                        return redirect('/customer/carts?day='.$day);
                }
            }
        }
        $product = Product::find($id);
        if ($request->price_type == 'normal') {
            $stock_type = 'stock';
        } else {
            $stock_type = $request->price_type . '_stock';
        }
        $userCarts = Cart::where('customer_id', $user_id)->get();
        foreach ($userCarts as $cart) {
            if ($cart->product_id == $id) {
                if ($cart->price_type == $request->price_type) {
                    $old = Cart::find($cart->id);
                    $old->qty = $old->qty + ($request->qty/1000);
                    if($day == 'today'){
                        if ($product->$stock_type < $old->qty) {
                            Session::flash('error','Sorry product out of stock');
                            return redirect('/customer/carts?day='.$day);
                        }
                    }
                    $old->save();
                    Session::flash('success','Success, Updated to carts');
                    return redirect('/customer/carts?day='.$day);
                }
            }
        }
        if($day == 'today'){
            if ($product->$stock_type < $request->qty) {
                Session::flash('error','Sorry product out of stock');
                return redirect('/customer/carts?day='.$day);
            }
        }
        $newcart = Cart::create([
            'customer_id' => $user_id,
            'product_id' => $id,
            'qty' => $request->qty/1000,
            'price_type' => $request->price_type,
            'day' => $day,
        ]);
        Session::flash('sucess','Success,Added to carts');
        return redirect('/customer/carts?day='.$day);
    }
    public function addComboAjax(Request $request)
    {
        $user_id = auth()->user()->id;
        $allcombo = Cart::where('customer_id', $user_id)->where('combo_id', $request->combo_id)->first();
        $day = $request->day;
        $dayCheck = Cart::where('customer_id',$user_id)->get();
        if($dayCheck !== null){
            foreach($dayCheck as $dc){
                if($dc->day !== $day){
                    return response()->json(['dp' => '1']);
                }
            }
        }
        if ($allcombo !== null) {
            return response()->json([
                'exists' => '1',
            ]);
        }
        $details = ComboDetail::where('combo_id',$request->combo_id)->get();
        foreach($details as $d){
            if ($d->type == 'normal') {
                $stock = 'stock';
            } else {
                $stock = $d->type . '_stock';
            }
            $product = Product::find($d->product_id);
            if ($day == 'today') {
                if ($product->$stock < ($request->qty/1000)) {
                    return response()->json(['ofs' => '1']);
                }
            }
        }
        Cart::create([
            'customer_id' => $user_id,
            'qty' => $request->qty / 1000,
            'combo_id' => $request->combo_id,
            'day' => $request->day,
        ]);
        return response()->json([
            'success' => '1',
        ]);
    }
    public function addCombo(Request $request, $id)
    {
        $user_id = auth()->user()->id;
        $day = $request->day;
        $dayCheck = Cart::where('customer_id',$user_id)->get();
        if($dayCheck !== null){
            foreach($dayCheck as $dc){
                    if($dc->day !== $day){
                        if($day == 'today'){
                            $dp = 'tomorrow';
                        }else {
                            $dp = 'today';
                        }
                        Session::flash('error','Cart has '.$dp.' product, Please Clear and continue!');
                        return redirect('/customer/carts?day='.$day);
                }
            }
        }
        $allcombo = Cart::where('customer_id', $user_id)->where('combo_id', $id)->first();
        if ($allcombo !== null) {
            Session::flash('error', 'Cart already Exists');
            return redirect('/customer/carts');
        }
        $details = ComboDetail::where('combo_id',$id)->get();
        foreach($details as $d){
            if ($d->type == 'normal') {
                $stock = 'stock';
            } else {
                $stock = $d->type . '_stock';
            }
            $product = Product::find($d->product_id);
            if ($day == 'today') {
                if ($product->$stock < ($request->qty/1000)) {
                    Session::flash('error', 'Combo out of stock');
                    return redirect('/customer/carts');
                }
            }
        }
        Cart::create([
            'customer_id' => $user_id,
            'qty' => $request->qty / 1000,
            'combo_id' => $id,
            'day' => $request->day,
        ]);
        Session::flash('success', 'Added to carts');
        return redirect('/customer/carts');
    }
    public function updateCartAjax(Request $request, $id)
    {
        $cart = Cart::find($id);
        if ($cart->combo_id !== null) {
            return app('App\Http\Controllers\customer\CartsController')->comboUpdate($id, $request->qty);
        }
        if ($cart->price_type == 'normal') {
            $stock = 'stock';
            $price = 'price';
        } else {
            $stock = $cart->price_type . '_stock';
            $price = $cart->price_type . '_price';
        }
        $product = Product::find($cart->product_id);
        $cart->qty = $request->qty;
        $cart->save();
        $price = $request->qty * $product->$price;
        $price = number_format((float) $price, 2, '.', '');
        if($cart->day == 'today'){
            if ($request->qty > $product->$stock) {
                return response()->json([
                    'overflow' => '1',
                    'cart' => $cart,
                    'price' => $price,
                ]);
            }
        }
        return response()->json([
            'success' => '1',
            'cart' => $cart,
            'price' => $price,
        ]);
    }
    public function comboUpdate($cart_id, $qty)
    {
        $cart = Cart::find($cart_id);
        $combo = ComboProduct::find($cart->combo_id);
        $details = ComboDetail::where('combo_id', $cart->combo_id)->get();
        $instock = true;
        $total = 0;
        foreach ($details as $d) {
            if ($d->type == 'normal') {
                $stock = 'stock';
                $price = 'price';
            } else {
                $stock = $d->type . '_stock';
                $price = $d->type . '_price';
            }
            $product = Product::find($d->product_id);
            $total = $total + ($product->$price * $qty);
            $total = number_format((float) $total, 2, '.', '');
            if ($product->$stock < $qty) {
                $instock = false;
            }
        }
        $cart->qty = $qty;
        $cart->save();
        if($cart->day == 'today'){
            if ($instock == false) {
                return response()->json([
                    'overflow' => '1',
                    'cart' => $cart,
                    'price' => $total,
                ]);
            }
        }
        return response()->json([
            'success' => '1',
            'cart' => $cart,
            'price' => $total,
        ]);

    }
    public function couponCheck(Request $request)
    {
        $code = $request->code;
        $amount = $request->amount;
        $today = date('Y-m-d', strtotime(\Carbon\carbon::now()));
        $coupon = Coupon::where('code', $code)->where('start_date', '<=', $today)->first();
        if ($coupon == null) {
            return response()->json([
                'invalid' => '1',
                'message' => 'Invalid Coupon code',
            ]);
        }
        if ($today > $coupon->end_date) {
            return response()->json([
                'invalid' => '1',
                'message' => 'Coupon Expired',
            ]);
        }
        if ($amount < $coupon->min_price) {
            return response()->json([
                'invalid' => '1',
                'message' => 'Valid for price above ₹' . $coupon->min_price,
            ]);
        }
        if ($amount > $coupon->max_price) {
            return response()->json([
                'invalid' => '1',
                'message' => 'Valid for price below ₹' . $coupon->min_price,
            ]);
        }
        return response()->json([
            'success' => '1',
            'message' => 'Valid coupon of ' . $coupon->discount . '% discount',
        ]);
    }
    public function cartDelete($id)
    {
        $cart = Cart::find($id)->delete();
        Session::flash('success', 'Cart item deleted');
        return redirect()->back();
    }

    public function cartClearall()
    {
        $user_id = auth()->user()->id;
        Cart::where('customer_id', $user_id)->delete();
        Session::flash('success', 'carts cleared');
        return redirect()->back();
    }
}
