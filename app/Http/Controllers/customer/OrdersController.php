<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Admin;
use App\Models\api\customer;
use App\Models\Cart;
use App\Models\ComboDetail;
use App\Models\ComboProduct;
use App\Models\Coupon;
use App\Models\District;
use App\Models\Delivery;
use App\Models\DeliveryDay;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\PaymentStatus;
use App\Models\Product;
use App\Models\Store;
use App\Models\ShippingCharge;
use Auth;
use Illuminate\Http\Request;
use Session;
use Validator;

class OrdersController extends Controller
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

    public function checkout(Request $request)
    {

        $user = auth()->user();
        $fullcarts = Cart::where('customer_id', $user->id)->get();
        $address = Address::find($request->address_id);
        $district = District::find($address->district);
        $payment_method = PaymentMethod::find($request->payment_method);
        $carts = [];
        $combos = [];
        $coupon = [];
        $total_qty = 0;
        $total_price = 0;
        $coupon_discount = 0;
        $coupon_price = 0;
        $delivery_charge = 0;
        $shipping_amount = ShippingCharge::find(1)->shipping_charge;
        $start_time = null;
        $end_time = null;
        if($fullcarts !== null){
            $day = Cart::where('customer_id', $user->id)->first()->day;
        }
        foreach ($fullcarts as $i => $cart) {
            if ($cart->price_type == 'normal') {
                $price = 'price';
                $stock = 'stock';
            } else {
                $price = $cart->price_type . '_price';
                $stock = $cart->price_type . '_stock';
            }
            if ($cart->product_id !== null) {
                $product = Product::find($cart->product_id);
                if($day == 'today'){
                    if ($cart->qty < $product->$stock) {
                        $carts[$i] = Cart::find($cart->id);
                        $carts[$i]->image = $product->image;
                        $carts[$i]->name = $product->name;
                        $carts[$i]->price = number_format((float) ($cart->qty * $product->$price * 10), 2, '.', '');
                        $total_qty += $cart->qty;
                        $total_price += $carts[$i]->price;
                    }
                }else{
                    $carts[$i] = Cart::find($cart->id);
                    $carts[$i]->image = $product->image;
                    $carts[$i]->name = $product->name;
                    $carts[$i]->price = number_format((float) ($cart->qty * $product->$price * 10), 2, '.', '');
                    $total_qty += $cart->qty;
                    $total_price += $carts[$i]->price;
                }
            } else {
                $combo[$i] = ComboProduct::find($cart->combo_id);
                $combo[$i]->cart_id = $cart->id;
                $details = ComboDetail::where('combo_id', $cart->combo_id)->get();
                $instock = true;
                $combo_price = 0;
                $y = 0;
                foreach ($details as $d) {
                    $p = Product::find($d->product_id);
                    if ($d->type == 'normal') {
                        $c_price = 'price';
                        $c_stock = 'stock';
                    } else {
                        $c_price = $d->type . '_price';
                        $c_stock = $d->type . '_stock';
                    }
                    $d->price = $p->$c_price * 10;
                    $d->qty = $cart->qty;
                    $combo_price = $combo_price + (($p->$c_price *10) * $cart->qty);
                    if($day == 'today'){
                        if ($p->$c_stock < $cart->qty) {
                            $instock = false;
                        }
                    }
                    $y++;
                }
                $combo[$i]->qty = $cart->qty;
                $combo_discount = $combo[$i]->discount / 100;
                $combo_total = $combo_price - $combo_price * $combo_discount;
                $combo[$i]->combo_total = number_format((float) $combo_total, 2, '.', '');
                $combo[$i]->details = $details;
                if ($instock == true) {
                    $total_price = $total_price + $combo[$i]->combo_total;
                    $total_qty += $cart->qty * $combo[$i]->product_count;
                    $combos = array_values($combo);
                }
            }
        }
        if ($request->coupon !== null) {
            $coupon = Coupon::where('code', $request->coupon)->first();
            $coupon_price = number_format((float) $total_price * ($coupon->discount / 100), 2, '.', '');
            $coupon_discount = $coupon->discount;
        }
        if ($request->delivery_period == 'custom') {
            $start_time = $request->delivery_start;
            $end_time = $request->delivery_end;
            $delivery_charge = 10;
        }
        $total = $total_price + $shipping_amount - $coupon_price + $delivery_charge;
        if($day == 'today'){
            $delivery_date = date('Y-m-d');
        }else{
            $delivery_date = date('Y-m-d',strtotime('tomorrow'));
        }
        return view('customer.order.checkout', [
            'carts' => $carts,
            'combos' => $combos,
            'coupon' => $coupon,
            'address' => $address,
            'district' => $district,
            'delivery_date' => $delivery_date,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'delivery_charge' => $delivery_charge,
            'payment_method' => $payment_method,
            'total_qty' => $total_qty,
            'price' => $total_price,
            'coupon_price' => $coupon_price,
            'coupon_discount' => $coupon_discount,
            'shipping_amount' => $shipping_amount,
            'total' => $total,
            'day' => $day,
        ]);
    }

    public function orderAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address_id' => 'required',
            'total_qty' => 'required',
            'payment_method' => 'required',
            'payment_status' => 'required',
            'price' => 'required',
            'shipping_amount' => 'required',
            'total' => 'required',
        ]);
        $user = customer::find($request->customer_id);
        if ($validator->fails()) {
            Session::flash('error', 'Something wroung');
            return redirect('/customer/carts');
        }
        $address = Address::find($request->address_id);
        $order = Order::create([
            'customer_id' => $user->id,
            'qty' => $request->total_qty,
            'price' => $request->price,
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_status,
            'order_status' => 1,
            'shipping_amount' => $request->shipping_amount,
            'time_charge' => $request->time_charge,
            'coupon' => $request->coupon,
            'total' => $request->total,
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
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'delivery_date' => date('Y-m-d', strtotime($request->delivery_date)),
        ]);
        $carts = Cart::where('customer_id', $user->id)->get();
        foreach ($carts as $cart) {
            if ($cart->price_type == 'normal') {
                $price = 'price';
                $stock = 'stock';
            } else {
                $price = $cart->price_type . '_price';
                $stock = $cart->price_type . '_stock';
            }
            if ($cart->product_id !== null) {
                $product = Product::find($cart->product_id);
                if($cart->day == 'today'){
                    if ($cart->qty < $product->$stock) {
                        $orderDetail = OrderDetail::create([
                            'order_id' => $order->id,
                            'product_id' => $cart->product_id,
                            'image' => $product->image,
                            'name' => $product->name,
                            'price_type' => $cart->price_type,
                            'price' => $product->$price,
                            'qty' => $cart->qty,
                            'total_price' => ($product->$price * 10) * $cart->qty,
                        ]);
                        $product->$stock = $product->$stock - $cart->qty;
                        $product->save();
                        $cart->delete();
                    }
                }else{
                    $orderDetail = OrderDetail::create([
                        'order_id' => $order->id,
                        'product_id' => $cart->product_id,
                        'image' => $product->image,
                        'name' => $product->name,
                        'price_type' => $cart->price_type,
                        'price' => $product->$price,
                        'qty' => $cart->qty,
                        'total_price' => ($product->$price * 10) * $cart->qty,
                    ]);
                    $cart->delete();
                }
            } else {
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
                    if($cart->day == 'today'){
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
                        if($cart->day == 'today'){
                            $product->$combo_stock = $product->$combo_stock - $cart->qty;
                            $product->save();
                        }
                        $cart->delete();
                    }
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
                if ($set_delivery_boy->delivery_date == date('Y-m-d')) {
                    $set_delivery_boy->delivery = $closest;
                    $set_delivery_boy->save();
                    app('App\Http\Controllers\PushNotification')->send_notification_delivery($closest, 'New Order', 'Your new Order',$order->id,null);
                }
            }
        }
        $super_admins = Admin::where('role', 'SuperAdmin')->get();
        $order_admins = Admin::where('role', 'OrderAdmin')->get();
        foreach ($super_admins as $sa) {
            app('App\Http\Controllers\admin\AdminNotificationsController')->adminNotification($sa->id, 'New Order', 'New order placed', $order->id);
        }
        foreach ($order_admins as $oa) {
            app('App\Http\Controllers\admin\AdminNotificationsController')->adminNotification($oa->id, 'New Order', 'New order placed', $order->id);
        }
        foreach ($super_admins as $sa) {
            $sa->notify(new \App\Notifications\OrderNotification($notify));
        }
        foreach ($order_admins as $oa) {
            $oa->notify(new \App\Notifications\OrderNotification($notify));
        }
        app('App\Http\Controllers\PushNotification')->send_notification_FCM($user->id, 'Order placed', 'Your order has been placed successfully');
        Session::flash('success', 'Order placed!');
        return redirect('/customer/orders');
    }
    public function orderList(Request $request)
    {
        if($request->exists('day')){
            $day = DeliveryDay::where('name',$request->day)->where('status',1)->first();
        }else {
            $day = DeliveryDay::where('status',1)->first();
        }
        if($day !== null){
            $day = $day->name;
        }
        $user = auth()->user();
        $orders = Order::where('customer_id', $user->id)->orderBy('created_at', 'desc')->get();
        foreach ($orders as $or) {
            $payment = PaymentStatus::find($or->payment_status);
            $status = OrderStatus::find($or->order_status);
            $or->payment_status = $payment->name;
            $or->status = $status->name;
        }
        return view('customer.order.order-list',[
            'orders' => $orders,
            'day' => $day,
        ]);
    }

    public function orderDetail($id)
    {
        $order = Order::find($id);
        $orderDetails = OrderDetail::where('order_id', $id)->get();
        return view('customer.order.order-detail', [
            'orderDetails' => $orderDetails,
            'order' => $order,
        ]);
    }

    public function orderCancel($id)
    {
        $order = Order::find($id);
        $order->order_status = 4;
        $order->save();
        $orderDetails = OrderDetail::where('order_id', $id)->get();
        foreach ($orderDetails as $detail) {
            $product = Product::find($detail->product_id);
            $product->stock = $product->stock + number_format($detail->qty);
            $product->save();
        }

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
        foreach ($super_admins as $sa) {
            $sa->notify(new \App\Notifications\OrderNotification($notify));
        }
        foreach ($order_admins as $oa) {
            $oa->notify(new \App\Notifications\OrderNotification($notify));
        }
        app('App\Http\Controllers\PushNotification')->send_notification_FCM($user->id, 'Order cancelled', 'Your order has been cancelled successfully');
        Session::flash('success', 'Order cancelled');
        return redirect()->back();
    }
}
