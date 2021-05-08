<?php

namespace App\Http\Controllers\delivery;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Delivery;
use App\Models\DeliverySalary;
use App\Models\DeliveryCharge;
use App\Models\DeliveryRequest;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderReject;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\PaymentStatus;
use App\Models\Store;
use Illuminate\Http\Request;
use Validator;

class OrdersController extends Controller
{
    public function orderList($token)
    {
        $user = Delivery::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $store = Store::find(1);
        if ($store->delivery == 'manual') {
            return response()->json(['error' => 'Delivery Selection changed to manual control']);
        }
        $dis = District::find($user->district);
        $orders = Order::orderBy('created_at', 'desc')->where('order_status', 1)->where('district', $user->district)->get();
        $rejectList = OrderReject::where('delivery_id',$user->id)->get();
        $norder = [];
        foreach ($orders as $key => $or) {
            $or->district = $dis->name;
            $order_details = OrderDetail::where('order_id', $or->id)->get();
            $or->details = $order_details;
            foreach($rejectList as $rl){
                if($rl->order_id == $or->id){
                    $orders->forget($key);
                }
            }
        }
        foreach($orders as $key => $o){
            $norder[] = $o;
        }
        return response()->json([
            'orders' => $norder,
        ]);
    }
    public function orderSelect(Request $request, $token)
    {
        $user = Delivery::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $store = Store::find(1);
        if ($store->delivery == 'manual') {
            return response()->json(['error' => 'Delivery Selection changed to manual control']);
        }
        $validator = Validator::make($request->all(), ['order_id' => 'required']);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $order = Order::find($request->order_id);
        if($order->delivery !==null){
            return response()->json(['error' => 'This order is already taken']);
        }
        $order->order_status = 2;
        $order->delivery = $user->id;
        $order->save();
        app('App\Http\Controllers\PushNotification')->send_notification_FCM($order->customer_id, 'Order status', 'Your order is in ' . OrderStatus::find($order->order_status)->name . ' and delivery boy name is ' . $user->name);

        return response()->json([
            'success' => 'Order Taken',
        ]);
    }
    public function orderReject(Request $request, $token)
    {
        $user = Delivery::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $validator = Validator::make($request->all(), ['order_id' => 'required']);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        OrderReject::create([
            'delivery_id' => $user->id,
            'order_id' => $request->order_id,
        ]);
        return response()->json([
            'success' => 'Order rejected',
        ]);
    }
    public function selectedList($token)
    {
        $user = Delivery::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $orders = Order::orderBy('created_at', 'desc')->where('delivery', $user->id)->where('order_status','!=',3)->where('order_status','!=',4)->get();
        if ($orders !== null) {
            foreach ($orders as $o) {
                $o->delivery = $user->name;
                $o->payment_method = PaymentMethod::find($o->payment_method)->name;
                $o->payment_status = PaymentStatus::find($o->payment_status)->name;
                $o->order_status = OrderStatus::find($o->order_status)->name;
                $o->district = District::find($o->district)->name;
                $o->details = OrderDetail::where('order_id',$o->id)->get();
            }
        }

        return response()->json([
            'orders' => $orders,
        ]);
    }
    public function orderStart(Request $request, $token)
    {
        $user = Delivery::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $user->latitude = $request->latitude;
        $user->longitude = $request->longitude;
        $user->save();
        $order = Order::find($request->order_id);
        $order->order_status = 5;
        $order->save();
        app('App\Http\Controllers\PushNotification')->send_notification_FCM($order->customer_id, 'Order status', 'Your order is ' . OrderStatus::find($order->order_status)->name . ' and delivery boy name is ' . $user->name);

        return response()->json([
            'success' => 'Order Started',
        ]);
    }
    public function orderFinished(Request $request, $token)
    {
        $user = Delivery::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'distance' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $user->latitude = $request->latitude;
        $user->longitude = $request->longitude;
        $user->save();
        $completed_order = Order::find($request->order_id);
        $completed_order->order_status = 3;
        $completed_order->payment_status = 2;
        $completed_order->save();
        $charges = DeliveryCharge::find(1);
        $price = $charges->price / $charges->distance;
        $final = $price * $request->distance;
        DeliverySalary::create([
            'delivery_id' => $user->id,
            'order_id' => $request->order_id,
            'distance' => $request->distance,
            'salary' => $final,
            'order_total' => $completed_order->total,
        ]);
        app('App\Http\Controllers\PushNotification')->send_notification_FCM($completed_order->customer_id, 'Order Delivered', 'Your order is delivered by ' . $user->name);
        $store = Store::find(1);
        if($store->delivery == 'auto'){
            $orders = Order::where('delivery', null)->get();
            foreach($orders as $order){
                if($order->order_status == 3){
                    $delivery_orders->forget($key);
                }else if($order->order_status == 4){
                    continue;
                }
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
                    $set_delivery_boy->delivery = $closest;
                    $set_delivery_boy->save();
                    app('App\Http\Controllers\PushNotification')->send_notification_delivery($closest, 'New Order', 'Your new order',$order->id,null);
                }
            }
        }
        return response()->json([
            'success' => 'Order Completed',
        ]);
    }

    public function completedList($token)
    {
        $user = Delivery::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $orders = Order::orderBy('created_at', 'desc')->where('order_status', 3)->where('delivery', $user->id)->get();
        foreach ($orders as $or) {
            $dis = District::find($or->district);
            $os = OrderStatus::find($or->order_status);
            $or->district = $dis->name;
            $or->order_status = $os->name;
            $order_details = OrderDetail::where('order_id', $or->id)->get();
            $or->details = $order_details;
        }

        return response()->json([
            'orders' => $orders,
        ]);
    }

    public function requestList($token)
    {
        $user = Delivery::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $requestList = DeliveryRequest::where('delivery_id', $user->id)->get();
        return response()->json([
            'requestList' => $requestList,
        ]);
    }

    public function requestDecline(Request $request, $token)
    {
        $user = Delivery::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $validator = Validator::make($request->all(), ['request_id' => 'required']);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $req = DeliveryRequest::find($request->request_id);
        $order = Order::find($req->order_id);
        $admin = Admin::find(1);
        $notify = [
            'head' => 'Order declined by delivery boy',
            'date' => $order->created_at,
            'id' => $order->id,
        ];
        $super_admins = Admin::where('role', 'SuperAdmin')->get();
        $delivery_admins = Admin::where('role', 'DeliveryAdmin')->get();
        foreach($super_admins as $sa){
            app('App\Http\Controllers\admin\AdminNotificationsController')->adminNotification($sa->id,'Order declined', 'A order was declined by delivery boy');
        }
        foreach($delivery_admins as $da){
            app('App\Http\Controllers\admin\AdminNotificationsController')->adminNotification($da->id,'Order declined', 'A order was declined by delivery boy');
        }
        $admin->notify(new \App\Notifications\OrderNotification($notify));
        $req->delete();
        return response()->json([
            'success' => 'order declined',
        ]);
    }
}
