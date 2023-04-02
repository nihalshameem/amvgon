<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\api\customer;
use App\Models\Cart;
use App\Models\ComboDetail;
use App\Models\ComboProduct;
use App\Models\PaymentMethod;
use App\Models\DeliveryDay;
use App\Models\Product;
use Illuminate\Http\Request;
use Validator;

class CartsController extends Controller
{

    public function cartList($token)
    {
        $user = customer::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $carts = Cart::where('customer_id', $user->id)->get();
        $addresses = Address::where('customer_id', $user->id)->get();
        $payment_method = PaymentMethod::all();
        $x = 0;
        $combos = [];
        $products = [];
        $order_qty = 0;
        $order_price = 0;
        foreach ($carts as $cart) {
            if($cart->price_type == 'normal'){
                $price = 'price';
                $stock = 'stock';
            }else{
                $price = $cart->price_type.'_price';
                $stock = $cart->price_type.'_stock';
            }
            if ($cart->combo_id !== null) {
                $combo[$x] = ComboProduct::find($cart->combo_id);
                $combo[$x]->cart_id = $cart->id;
                $details = ComboDetail::where('combo_id', $cart->combo_id)->get();
                $instock = true;
                $combo_price = 0;
                foreach ($details as $d) {
                    $p = Product::find($d->product_id);
                    if ($d->type == 'normal') {
                        $c_price = 'price';
                        $c_stock = 'stock';
                    } else {
                        $c_price = $d->type.'_price';
                        $c_stock = $d->type.'_stock';
                    }
                    $d->price = $p->$c_price;
                    $d->qty = $cart->qty;
                    $d->total = ($p->$c_price * $cart->qty);
                    $combo_price = $combo_price + ($p->$c_price * ($cart->qty * 10));
                    $discount = $combo[$x]->discount / 100;
                    $d->total = $d->total - $d->total * $discount;
					$d->total = number_format((float)$d->total, 2, '.', '');
                    if ($cart->day == 'today') {
                        if ($p->$c_stock < $cart->qty) {
                            $instock = false;
                        }
                    }
                }
                $combo[$x]->combo_price = $combo_price;
                $combo[$x]->qty = $cart->qty;
                $combo_discount = $combo[$x]->discount / 100;
                $combo_total = $combo_price - $combo_price * $combo_discount;
                $combo[$x]->combo_total = number_format((float)$combo_total, 2, '.', '');
                $combo[$x]->details = $details;
                if ($instock == true) {
                    foreach ($details as $d) {
                        $order_qty = $order_qty + $d->qty;
                        $order_price = $order_price + $d->total;
                    }
                }
                $combos = array_values($combo);
            } else {
                $products[$x] = Product::find($cart->product_id);
                $products[$x]->cart_id = $cart->id;
                $products[$x]->qty = $cart->qty;
                $products[$x]->price_type = $cart->price_type;
                $products[$x]->total = ($products[$x]->$price * ($cart->qty * 10));
                if($cart->day == 'today'){
                    if ($products[$x]->$stock > $cart->qty) {
                        $order_qty = $order_qty + $cart->qty;
                        $order_price = $order_price + $products[$x]->total;
                    }
                }else{
                    $order_qty = $order_qty + $cart->qty;
                    $order_price = $order_price + $products[$x]->total;
                }
                $products = array_values($products);
            }
            $x++;
        }

        return response()->json([
            'combos' => $combos,
            'carts' => $products,
            'payment_method' => $payment_method,
            'addresses' => $addresses,
            'shipping_amount' => 50,
            'order_price' => $order_price,
            'order_qty' => $order_qty,
        ]);
    }

    public function cartAdd(Request $request, $token)
    {
        $user = customer::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $validator = Validator::make($request->all(),
            [
                // 'product_id' => 'required',
                'qty' => 'required',
                'day' => 'required',
                // 'price_type' => 'required',
            ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $day = DeliveryDay::where('name',$request->day)->where('status',1)->first();
        \Log::info("day >>> ".json_encode($day));
        if($day !== null){
            $day = $day->name;
        }else{
            return response()->json([
                'error' => 'Selected day is not available!',
            ]);
        }
        $dayCheck = Cart::where('customer_id',$user->id)->get();
        if($dayCheck !== null){
            foreach($dayCheck as $dc){
                    if($dc->day !== $day){
                        return response()->json(['error' => 'Cart has another day products,Please clear and continue!']);
                }
            }
        }
        if ($request->combo_id !== null) {
            return app('App\Http\Controllers\api\CartsController')->comboAdd($request->combo_id, $request->qty, $user->id,$day);
        }
        $product = Product::find($request->product_id);
        if ($request->price_type == 'normal') {
            $stock_type = 'stock';
        } else {
            $stock_type = $request->price_type . '_stock';
        }
        $userCart = Cart::where('customer_id', $user->id)->get();
        foreach ($userCart as $cart) {
            if ($cart->product_id == $request->product_id) {
                if ($cart->price_type == $request->price_type) {
                    $old = Cart::find($cart->id);
                    $old->qty = $old->qty + $request->qty;
                    if($day == 'today'){
                        if ($product->$stock_type < $old->qty) {
                            return response()->json(['error' => 'Sorry product out of stock']);
                        }
                    }
                    $old->save();
                    $cartCount = count(Cart::where('customer_id', $user->id)->get());
                    return response()->json([
                        'message' => 'updated to cart succesfully!',
                        'cartCount' => $cartCount,
                    ]);
                }
            }
        }
        if($day == 'today'){
            if ($product->$stock_type < $request->qty) {
                return response()->json(['error' => 'Sorry product out of stock']);
            }
        }
        $newcart = Cart::create([
            'customer_id' => $user->id,
            'product_id' => $request->product_id,
            'qty' => $request->qty,
            'price_type' => $request->price_type,
            'day' => $day,
        ]);
        $cartCount = count(Cart::where('customer_id', $user->id)->get());
        return response()->json([
            'message' => 'added to cart succesfully!',
            'cartCount' => $cartCount,
        ]);
    }

    public function comboAdd($combo_id, $qty, $user_id,$day)
    {
        $combo = ComboProduct::find($combo_id);
        $details = ComboDetail::where('combo_id', $combo_id)->get();
        $allcombo = Cart::where('customer_id', $user_id)->where('combo_id', $combo_id)->first();
        if ($allcombo !== null) {
            $cartCount = count(Cart::where('customer_id', $user_id)->get());
            return response()->json([
                'message' => 'Combo already exists',
                'cartCount' => $cartCount,
            ]);
        }
        foreach($details as $d){
            if ($d->type == 'normal') {
                $stock = 'stock';
            } else {
                $stock = $d->type . '_stock';
            }
            $product = Product::find($d->product_id);
            if ($day == 'today') {
                if ($product->$stock < $qty) {
                    return response()->json(['message' => 'Quantity exceeds available stock combo']);
                }
            }
        }
        Cart::create([
            'customer_id' => $user_id,
            'qty' => $qty,
            'combo_id' => $combo_id,
            'day' => $day,
        ]);
        $cartCount = count(Cart::where('customer_id', $user_id)->get());
        return response()->json([
            'message' => 'added to cart succesfully!',
            'cartCount' => $cartCount,
        ]);
    }

    public function cartUpdate(Request $request, $token)
    {
        $user = customer::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $validator = Validator::make($request->all(),
            [
                'qty' => 'required',
                'cart_id' => 'required',
            ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        if ($request->qty == 0) {
            return response()->json(['error' => 'Not valid quantity'], 401);
        }
        $cartupdate = Cart::find($request->cart_id);
        $day = $cartupdate->day;
        if($cartupdate->combo_id !== null){
            return app('App\Http\Controllers\api\CartsController')->comboUpdate($request->cart_id, $request->qty);
        }
        $product = Product::find($cartupdate->product_id);
        if ($cartupdate->price_type == 'normal') {
            $price_type = 'stock';
        } else {
            $price_type = $cartupdate->price_type . '_stock';
        }
        if ($day == 'today') {
            if ($product->$price_type < $request->qty) {
                return response()->json(['error' => 'Quantity exceeds available stock'], 401);
            }
        }
        $cartupdate->qty = $request->qty;
        $cartupdate->save();
        $cartCount = count(Cart::where('customer_id', $user->id)->get());

        return response()->json([
            'message' => 'updated successfully!',
            'cartCount' => $cartCount,
        ]);
    }

    public function comboUpdate($cart_id,$qty){
        $cart = Cart::find($cart_id);
        $day = $cart->day;
        $combo = ComboProduct::find($cart->combo_id);
        $details = ComboDetail::where('combo_id',$cart->combo_id)->get();
        foreach($details as $d){
            if ($d->type == 'normal') {
                $stock = 'stock';
            } else {
                $stock = $d->type . '_stock';
            }
            $product = Product::find($d->product_id);
            if ($day == 'today') {
                if ($product->$stock < $qty) {
                    return response()->json(['error' => 'Quantity exceeds available stock combo'], 401);
                }
            }
        }
        $cart->qty = $qty;
        $cart->save();
        $cartCount = count(Cart::where('customer_id', $cart->customer_id)->get());

        return response()->json([
            'message' => 'updated successfully!combo',
            'cartCount' => $cartCount,
        ]);

    }

    public function cartDelete(Request $request, $token)
    {
        $user = customer::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $validator = Validator::make($request->all(),
            [
                'cart_id' => 'required',
            ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $cart = Cart::find($request->cart_id);
        $cart->delete();
        $cartCount = count(Cart::where('customer_id', $user->id)->get());
        return response()->json(['message' => 'cart deleted successfully!', 'cartCount' => $cartCount]);
    }

    public function cartDeleteAll(Request $request, $token)
    {
        $user = customer::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $cart = Cart::where('customer_id', $user->id)->delete();
        return response()->json(['message' => 'carts cleared', 'cartCount' => 0]);
    }
}
