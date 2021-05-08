<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Admin;
use App\Models\api\customer;
use App\Models\Banner;
use App\Models\Cart;
use App\Models\Category;
use App\Models\FunctionModel;
use App\Models\Hotel;
use App\Models\ComboDetail;
use App\Models\ComboProduct;
use App\Models\CustomerCare;
use App\Models\Delivery;
use App\Models\DeliveryDay;
use App\Models\DeliveryTime;
use App\Models\District;
use App\Models\OfferBanner;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PaymentStatus;
use App\Models\Product;
use App\Models\Store;
use App\Models\ShippingCharge;
use Illuminate\Http\Request;
use Validator;

class ApiController extends Controller
{

    public function customerdetails($token)
    {
        $user = customer::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $addresses = Address::where('customer_id', $user->id)->get();
        return response()->json([
            'user' => $user,
            'addresses' => $addresses,
        ]);
    }

    public function customerUpdate(Request $request, $token)
    {
        $user = customer::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $validator = Validator::make($request->all(),
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:customers,email,' . $user->id,
                'phone' => 'required|numeric|digits:10|unique:customers,phone,' . $user->id,
                'image' => 'image|mimes:jpeg,png,jpg|max:3000',
            ]);
        if ($validator->fails()) {

            return response()->json(['error' => $validator->errors()], 401);

        }
        if ($request->hasFile('image')) {
            if ($user->image !== '/images/customers/no_image.png') {
        \File::delete(public_path($user->image));
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();

            $destinationPath = public_path('/images/customers/');
            $filename = $user->id . '.' . $ext;

            $file->move($destinationPath, $filename);
            $filename = '/images/customers/' . $filename;
        } else {
            $filename = $user->image;
        }
        $update = customer::find($user->id);
        $update->first_name = $request->first_name;
        $update->last_name = $request->last_name;
        $update->image = $filename;
        $update->email = $request->email;
        $update->phone = $request->phone;
        $update->save();

        return response()->json(['message' => 'Profile updated']);
    }

    public function productList()
    {
        $products = Product::where('active',1)->paginate(15);
        $today = date('Y-m-d', strtotime(\Carbon\carbon::now()));
        $combos = ComboProduct::where('expiry_date', '>=', $today)->get();
        foreach ($combos as $combo) {
            $combo_price = 0;
            $details = ComboDetail::where('combo_id', $combo->id)->get();
            foreach ($details as $d) {
                $p = Product::find($d->product_id);
                if($d->type == 'normal'){
                    $price_type = 'price';
                }else{
                    $price_type = $d->type.'_price';
                }
                $combo_price = $combo_price + $p->$price_type;
                $d->product = $p;
            }
            $combo->combo_price = $combo_price;
            $combo->details = $details;
        }
        return response()->json([
            'combos' => $combos,
            'products' => $products,
        ]);
    }

    public function combos()
    {
        $today = date('Y-m-d', strtotime(\Carbon\carbon::now()));
        $combos = ComboProduct::where('expiry_date', '>=', $today)->get();
        foreach ($combos as $combo) {
        $combo_price = 0;
            $details = ComboDetail::where('combo_id', $combo->id)->get();
            foreach ($details as $d) {
                $p = Product::find($d->product_id);
                if($d->type == 'normal'){
                    $price_type = 'price';
                }else{
                    $price_type = $d->type.'_price';
                }
                $combo_price = $combo_price + $p->$price_type;
                $d->product = $p;
            }
            $combo->combo_price = $combo_price;
            $combo->details = $details;
        }
        return response()->json([
            'combos' => $combos,
        ]);
    }

    public function productSingle($id)
    {
        $product = Product::find($id);
        return response()->json([
            'single_product' => $product,
        ]);
    }

    public function productsHot()
    {
        $products = Product::where('type', 3)->where('active',1)->get();
        if ($products->count() > 0) {
            return response()->json([
                'hot_products' => $products,
            ]);
        }
        return response()->json([
            'message' => 'no prodcuts',
        ]);
    }

    public function Banner()
    {
        $banners = Banner::where('status', 1)->get();
        if ($banners->count() > 0) {
            return response()->json([
                'banners' => $banners,
            ]);
        }
        return response()->json([
            'message' => 'no banners found',
        ]);
    }

    public function OfferBanner()
    {
        $offer_banners = OfferBanner::where('status', 1)->get();
        return response()->json([
            'offer_banners' => $offer_banners,
        ]);
    }

    public function timeList()
	{
        $delivery_times = DeliveryTime::all();
        return response()->json([
            'delivery_times' => $delivery_times,
        ]);
    }

    public function districtList()
    {
        $districts = District::where('status', 1)->get();
        return response()->json([
            'districts' => $districts,
        ]);
    }

    public function categoryList()
    {
        $category = Category::all();
        return response()->json([
            'categories' => $category,
        ]);
    }

    public function store()
	{
        $store = Store::find(1);
        return response()->json([
            'store' => $store,
        ]);
    }

    public function changePass(Request $request, $token)
    {
        $user = customer::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $validator = Validator::make($request->all(),
            [
                'old_password' => 'required',
                'new_password' => 'required|min:4',
                'confirm_password' => 'required|same:new_password',
            ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        if (\Hash::check($request->old_password, $user->password)) {
            $update = customer::find($user->id);
            $update->password = bcrypt($request->new_password);
            $update->save();

            return response()->json(['message' => 'password updated']);
        }

        return response()->json(['error' => 'old password incorrect']);
    }

    public function orderList($token)
    {
        $user = customer::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $orders = Order::where('customer_id', $user->id)->orderBy('created_at','desc')->get();
        $payment_status = PaymentStatus::all();
        foreach($orders as $order){
            if ($order->delivery !== null) {
                $order->delivery_boy = Delivery::find($order->delivery);
            }
            $order->details = OrderDetail::where('order_id',$order->id)->get();
        }
        return response()->json([
            'orders' => $orders,
            'payment_status' => $payment_status,
        ]);
    }

    public function orderDetail($token, Request $request)
    {
        $user = customer::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $validator = Validator::make($request->all(),
            [
                'order_id' => 'required',
            ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $order_details = OrderDetail::where('order_id', $request->order_id)->get();
        return response()->json(['order_details' => $order_details]);
    }

    public function orderAdd($token, Request $request)
    {
        $user = customer::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $validator = Validator::make($request->all(),
            [
                'address_id' => 'required',
                'order_qty' => 'required',
                'order_price' => 'required',
                'payment_method' => 'required',
                'shipping_amount' => 'required',
                // 'payment_status' => 'required',
            ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $carts = Cart::where('customer_id', $user->id)->get();
        $address = Address::find($request->address_id);
        $start_time = '';
        $end_time = '';
        $charge = 0;
        if ($request->delivery_start !== null) {
            $start_time = $request->delivery_start;
            $end_time = $request->delivery_end;
            $charge = 10;
        }
        $day = Cart::where('customer_id', $user->id)->first()->day;
        if($day == 'today'){
            $delivery_date = date('Y-m-d');
        }else{
            $delivery_date = date('Y-m-d', strtotime('tomorrow'));
        }
        $order_price = $request->order_price;
        $shipping = $request->shipping_amount;
        $order_qty = $request->order_qty;
        $order_total = $shipping + $order_price + $charge;
        if($request->coupon !== null){
            $order_total = $order_total - $request->coupon;
        }
        $payment_status = 1;
        if ($request->payment_method == 2) {
            $payment_status = 2;
        }
        $order = Order::create([
            'customer_id' => $user->id,
            'qty' => $order_qty,
            'price' => $order_price,
            'payment_method' => $request->payment_method,
            'payment_status' => $payment_status,
            'order_status' => 1,
            'delivery' => null,
            'shipping_amount' => $shipping,
            'total' => $order_total,
            'time_charge' => $charge,
            'door_no' => $address->door_no,
            'village' => $address->village,
            'district' => $address->district,
            'pincode' => $address->pincode,
            'state' => $address->state,
            'country' => $address->country,
            'latitude' => $address->latitude,
            'longitude' => $address->longitude,
            'phone' => $user->phone,
            'email' => $user->email,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'delivery_date' => $delivery_date,
            'coupon' => $request->coupon,
        ]);
        foreach ($carts as $cart) {
            if ($cart->combo_id !== null) {
                $combo = ComboProduct::find($cart->combo_id);
                $combo_details = ComboDetail::where('combo_id', $cart->combo_id)->get();
                $combo_instock = true;
                foreach ($combo_details as $d) {
                    if ($d->type == 'normal') {
                        $combo_stock = 'stock';
                        $combo_price = 'price';
                    } else {
                        $combo_stock = $d->type . '_stock';
                        $combo_price = $d->type . '_price';
                    }
                    $product = Product::find($d->product_id);
                    if($day == 'today'){
                        if ($cart->qty > $product->$combo_stock) {
                            $combo_instock = false;
                        }
                    }
                }
                if ($combo_instock == true) {
                    foreach ($combo_details as $d) {
                        if ($d->type == 'normal') {
                            $combo_stock = 'stock';
                            $combo_price = 'price';
                        } else {
                            $combo_stock = $d->type . '_stock';
                            $combo_price = $d->type . '_price';
                        }
                        $product = Product::find($d->product_id);
                        $combo_total = (($product->$combo_price * 10) * $cart->qty);
                        $combo_discount = $combo->discount / 100;
                        $combo_total = $combo_total - $combo_total * $combo_discount;
                        OrderDetail::create([
                            'order_id' => $order->id,
                            'product_id' => $d->product_id,
                            'image' => $product->image,
                            'name' => $product->name,
                            'price' => $product->$combo_price,
                            'qty' => $cart->qty,
                            'total_price' => $combo_total,
                            'price_type' => $d->type,
                        ]);
                        $cart->delete();
                        if($day == 'today'){
                            $product->$combo_stock = $product->$combo_stock - $cart->qty;
                            $product->save();
                        }
                    }
                }
            } else {
                if ($cart->price_type == 'standard') {
                    $type = 'standard_';
                } else if ($cart->price_type == 'excellent') {
                    $type = 'excellent_';
                } else {
                    $type = '';
                }
                $price = $type . 'price';
                $stock = $type . 'stock';
                $product = Product::find($cart->product_id);
                if($day == 'today'){
                    if ($cart->qty < $product->$stock) {
                        $order_detail = OrderDetail::create([
                            'order_id' => $order->id,
                            'product_id' => $cart->product_id,
                            'image' => $product->image,
                            'name' => $product->name,
                            'price' => $product->$price,
                            'qty' => $cart->qty,
                            'total_price' => ($cart->qty * ($product->$price * 10)),
                            'price_type' => $cart->price_type,
                        ]);
                        $cart->delete();
                        $product->$stock = $product->$stock - $cart->qty;
                        $product->save();
                    }
                }else{
                    $order_detail = OrderDetail::create([
                        'order_id' => $order->id,
                        'product_id' => $cart->product_id,
                        'image' => $product->image,
                        'name' => $product->name,
                        'price' => $product->$price,
                        'qty' => $cart->qty,
                        'total_price' => ($cart->qty * ($product->$price * 10)),
                        'price_type' => $cart->price_type,
                    ]);
                    $cart->delete();
                }
            }
        }
        $notify = [
            'head' => 'New Order',
            'date' => $order->created_at,
            'id' => $order->id,
        ];
        $store = Store::find(1);
        if ($store->delivery == 'auto') {
            $delivery_boys = Delivery::where('status',1)->get();
            $closest = null;
            $search = $order->pincode;
            foreach ($delivery_boys as $bkey => $boy) {
                $delivery_orders = Order::where('delivery',$boy->id)->get();
                foreach($delivery_orders as $key => $do){
                    if($do->order_status == 3){
                        $delivery_orders->forget($key);
                    }else if($do->order_status == 4){
                        $delivery_orders->forget($key);
                    }
                }
                if(count($delivery_orders) >= 7){
                    continue;
                }
                if ($closest === null || abs($search - $closest) > abs($boy->pincode - $search)) {
                    $closest = $boy->id;
                }
            }
            if($closest !== null){
                $set_delivery_boy = Order::find($order->id);
                if($set_delivery_boy->delivery_date == date('Y-m-d')){
                    $set_delivery_boy->delivery = $closest;
                    $set_delivery_boy->save();
                    app('App\Http\Controllers\PushNotification')->send_notification_delivery($closest, 'New Order', 'Your new Order',$order->id,null);
                }
            }
        }
        $super_admins = Admin::where('role', 'SuperAdmin')->get();
        $order_admins = Admin::where('role', 'OrderAdmin')->get();
        foreach($super_admins as $sa){
            app('App\Http\Controllers\admin\AdminNotificationsController')->adminNotification($sa->id,'New Order', 'New order placed',$order->id);
        }
        foreach($order_admins as $oa){
            app('App\Http\Controllers\admin\AdminNotificationsController')->adminNotification($oa->id,'New Order', 'New order placed',$order->id);
        }
        foreach ($super_admins as $sa) {
            $sa->notify(new \App\Notifications\OrderNotification($notify));
        }
        foreach ($order_admins as $oa) {
            $oa->notify(new \App\Notifications\OrderNotification($notify));
        }
        app('App\Http\Controllers\PushNotification')->send_notification_FCM($user->id, 'Order placed', 'Your order has been placed successfully');
        return response()->json(['message' => 'Order success']);
    }

    public function orderCancel(Request $request, $token)
    {
        $user = customer::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $validator = Validator::make($request->all(),
            [
                'order_id' => 'required',
            ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $orderDetails = OrderDetail::where('order_id', $request->order_id)->get();
        foreach ($orderDetails as $detail) {
            $product = Product::find($detail->product_id);
            $product->stock = $product->stock + $detail->qty;
            $product->save();
        }
        $order = Order::find($request->order_id);
        $order->order_status = 4;
        $order->save();
        
        $notify = [
            'head' => 'Order Cancelled',
            'date' => $order->created_at,
            'id' => $order->id,
        ];
        $super_admins = Admin::where('role', 'SuperAdmin')->get();
        $order_admins = Admin::where('role', 'OrderAdmin')->get();
        foreach($super_admins as $sa){
            app('App\Http\Controllers\admin\AdminNotificationsController')->adminNotification($sa->id,'Order Cancelled', 'Order cancelled by user',$order->id);
        }
        foreach($order_admins as $oa){
            app('App\Http\Controllers\admin\AdminNotificationsController')->adminNotification($oa->id,'Order Cancelled', 'Order cancelled by user',$order->id);
        }
        // foreach ($super_admins as $sa) {
        //     $sa->notify(new \App\Notifications\OrderNotification($notify));
        // }
        // foreach ($order_admins as $oa) {
        //     $oa->notify(new \App\Notifications\OrderNotification($notify));
        // }
        app('App\Http\Controllers\PushNotification')->send_notification_FCM($user->id, 'Order cancelled', 'Your order has been cancelled successfully');
        return response()->json(['message' => 'order cancelled']);
    }

    public function customerCare()
    {
        $customercare = CustomerCare::where('usecase', 'customer')->get();
        $deliverycare = CustomerCare::where('usecase', 'delivery-boy')->get();
        return response()->json([
            'customercare' => $customercare,
            'deliverycare' => $deliverycare,
        ]);
    }

    public function hotelList(){
        $hotels = Hotel::all();
        return response()->json([
            'hotels' => $hotels,
        ]);
    }

    public function functionList(){
        $func_list = FunctionModel::all();
        return response()->json([
            'func_list' => $func_list,
        ]);
    }

    public function deliveryDay(){
        $delivery_days = deliveryDay::where('status',1)->get();
        return response()->json([
            'delivery_days' => $delivery_days,
        ]);
    }

    public function shippingCharge(){
        return ShippingCharge::find(1)->shipping_charge;
    }

    public function adminPurchase($date){
        $normal = [];
        $standard = [];
        $excellent = [];
        $normal_products = Product::all();
        $standard_products =  Product::all();
        $excellent_products =  Product::all();
        $products = Product::all();
        if($date == 'today'){
            $todays = Order::where('order_status','!=',3)->where('order_status','!=',4)->where('delivery_date','=',date('Y-m-d'))->get();
        }else{
            $todays = Order::where('order_status','!=',3)->where('order_status','!=',4)->where('delivery_date','=',date('Y-m-d',strtotime('tomorrow')))->get();
        }
        foreach($todays as $today){
            $details = OrderDetail::where('order_id',$today->id)->get();
            foreach($details as $detail){
                if($detail->price_type == 'normal'){
                    $normal[] = $detail;
                }elseif($detail->price_type == 'standard'){
                    $standard[] = $detail;
                }else{
                    $excellent[] = $detail;
                }
            }
        }
        foreach($normal_products as $tnp){
            $tnp->total_qty = 0;
            foreach($normal as $tn){
                $tnp->price_type = $tn->price_type;
                if($tn->product_id == $tnp->id){
                    $tnp->total_qty += $tn->qty;
                }
            }
        }
        foreach($standard_products as $tsp){
            $tsp->total_qty = 0;
            foreach($standard as $ts){
                $tsp->price_type = $ts->price_type;
                if($ts->product_id == $tsp->id){
                    $tsp->total_qty += $ts->qty;
                }
            }
        }
        foreach($excellent_products as $tep){
            $tep->total_qty = 0;
            foreach($excellent as $te){
                $tep->price_type = $te->price_type;
                if($te->product_id == $tep->id){
                    $tep->total_qty += $te->qty;
                }
            }
        }
        foreach($normal_products as $key => $np){
            if($np->total_qty == 0){
                $normal_products->forget($key);
            }
        }
        foreach($standard_products as $key => $np){
            if($np->total_qty == 0){
                $standard_products->forget($key);
            }
        }
        foreach($excellent_products as $key => $np){
            if($np->total_qty == 0){
                $excellent_products->forget($key);
            }
        }
        $full_total = $normal_products->sum('total_qty') + $standard_products->sum('total_qty') + $excellent_products->sum('total_qty');
        
        return response()->json([
            'normal_products' => $normal_products,
            'standard_products' => $standard_products,
            'excellent_products' => $excellent_products,
            'date' => $date,
            'full_total' => number_format((float)$full_total, 2, '.', ''),
        ]);
    }

    public function adminInvoice(Request $request){
        $order = Order::find($request->order_id);
        $order->customer_name = customer::find($order->customer_id)->first_name;
        $order->district = District::find($order->district)->name;
        $order_details = OrderDetail::where('order_id',$request->order_id)->get();
        return response()->json([
            'order' => $order,
            'order_details' => $order_details,
            'total_price' => $request->total_price,
            'total_qty' => $request->total_qty,
        ]);
    }
}
