<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\api\customer;
use App\Models\Delivery;
use App\Models\DeliveryRequest;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\PaymentStatus;
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
        $this->middleware('auth:admin');
    }

    public function orderList()
    {
        if(auth()->user()->role !== 'SuperAdmin' && auth()->user()->role !== 'OrderAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $print_orders = Order::orderBy('created_at', 'desc')->where('order_status',1)->get();
        foreach($print_orders as $po){
            $po->customer_name = customer::find($po->customer_id)->first_name;
            $po->qty = number_format((float)$po->qty,'2','.','');
        }
        $orders = Order::orderBy('created_at', 'desc')->where('created_at', '>=',date('Y-m-d',strtotime('today')))->get();
        foreach ($orders as $item) {
            $payment_method = PaymentMethod::find($item->payment_method);
            $payment_status = PaymentStatus::find($item->payment_status);
            $order_status = OrderStatus::find($item->order_status);
            $item->payment_method = $payment_method->name;
            $item->payment_status = $payment_status->name;
            $item->order_status = $order_status->name;
			$item->qty = number_format((float)$item->qty, 2, '.', '');
        }
        return view('admin.orders.order-list',[
            'orders' => $orders,
            'print_orders' => $print_orders,
            'order_search' => '',
            'start_date' => '',
            'end_date' => '',
        ]);
    }

    public function orderFilter(Request $request)
    {
        if(auth()->user()->role !== 'SuperAdmin' && auth()->user()->role !== 'OrderAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $print_orders = Order::orderBy('created_at', 'desc')->where('order_status',1)->get();
        foreach($print_orders as $po){
            $po->customer_name = customer::find($po->customer_id)->first_name;
            $po->qty = number_format((float)$po->qty,'2','.','');
        }
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        if ($start_date !== null && $end_date !== null) {
            $orders = Order::orderBy('created_at', 'desc')->whereDate('created_at','<=',$end_date)->whereDate('created_at','>=',$start_date)->get();
        }elseif($start_date !== null && $end_date == null){
            $orders = Order::orderBy('created_at', 'desc')->whereDate('created_at','>=',$start_date)->get();
        }elseif($start_date == null && $end_date !== null){
            $orders = Order::orderBy('created_at', 'desc')->whereDate('created_at','<=',$end_date)->get();
        }else {
            $orders = Order::orderBy('created_at', 'desc')->where('created_at', '>=',date('Y-m-d',strtotime('today')))->get();
        }
        
        foreach ($orders as $item) {
            $payment_method = PaymentMethod::find($item->payment_method);
            $payment_status = PaymentStatus::find($item->payment_status);
            $order_status = OrderStatus::find($item->order_status);
            $item->payment_method = $payment_method->name;
            $item->payment_status = $payment_status->name;
            $item->order_status = $order_status->name;
			$item->qty = number_format((float)$item->qty, 2, '.', '');
        }
        return view('admin.orders.order-list',[
            'orders' => $orders,
            'print_orders' => $print_orders,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'order_search' => '',
        ]);
    }

    public function searchResult(Request $request){
        $print_orders = Order::orderBy('created_at', 'desc')->where('order_status',1)->get();
        foreach($print_orders as $po){
            $po->customer_name = customer::find($po->customer_id)->first_name;
            $po->qty = number_format((float)$po->qty,'2','.','');
        }
        $value = $request->order_search;
        $orders = Order::where('id', 'LIKE', '%' . $value . '%')->get();
        foreach ($orders as $item) {
            $payment_method = PaymentMethod::find($item->payment_method);
            $payment_status = PaymentStatus::find($item->payment_status);
            $order_status = OrderStatus::find($item->order_status);
            $item->payment_method = $payment_method->name;
            $item->payment_status = $payment_status->name;
            $item->order_status = $order_status->name;
			$item->qty = number_format((float)$item->qty, 2, '.', '');
        }
        return view('admin.orders.order-list', [
            'orders' => $orders,
            'order_search' => $value,
            'print_orders' => $print_orders,
            'start_date' => '',
            'end_date' => '',
        ]);
    }

    public function orderDetail($id)
    {
        if(auth()->user()->role !== 'SuperAdmin' && auth()->user()->role !== 'OrderAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $order = Order::find($id);
        $order_details = OrderDetail::where('order_id', $id)->get();
        $customer = customer::where('id', $order->customer_id)->first();
        $payment_method = PaymentMethod::all();
        $payment_status = PaymentStatus::all();
        $order_status = OrderStatus::all();
        $delivery = Delivery::where('status',1)->get();
        $district = District::find($order->district);
		$order->qty = number_format((float)$order->qty, 2, '.', '');
        if($district != null){
            $order->district = $district->name;
        }
        return view('admin.orders.order-detail', [
            'order' => $order,
            'order_details' => $order_details,
            'customer' => $customer,
            'payment_method' => $payment_method,
            'payment_status' => $payment_status,
            'order_status' => $order_status,
            'delivery' => $delivery,
        ]);
    }

    public function orderUpdate(Request $request, $id)
    {
        if(auth()->user()->role !== 'SuperAdmin' && auth()->user()->role !== 'OrderAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $order = Order::find($id);
        $order->shipping_amount = $request->shipping_amount;
        $order->total = $request->total;
        $order->payment_method = $request->payment_method;
        $order->payment_status = $request->payment_status;
        $order->order_status = $request->order_status;
        if ($request->delivery !== $order->delivery) {
            if($request->delivery == null){
                Session::flash('success', 'Order updated');
                $order->delivery = $request->delivery;
            }else{
                $delivery_boy = Delivery::find($request->delivery);
                $delivery_orders = Order::where('delivery',$request->delivery)->get();
                foreach($delivery_orders as $key => $do){
                    if($do->order_status == 3){
                        $delivery_orders->forget($key);
                    }else if($do->order_status == 4){
                        $delivery_orders->forget($key);
                    }
                }
                if(count($delivery_orders) < 7){
                    Session::flash('success', 'Order updated');
                    $order->delivery = $request->delivery;
                    $status = OrderStatus::find($request->order_status);
                    app('App\Http\Controllers\PushNotification')->send_notification_FCM($order->customer_id, 'Order Status', 'Your order status is '.$status->name);
                    app('App\Http\Controllers\PushNotification')->send_notification_delivery($delivery_boy->id, 'New Order', 'Your new order',$id,null);
                }else{
                    Session::flash('error', 'Selected delivery boy is full!');
                }
            }
        }else{
            Session::flash('success', 'Order updated');
        }
        $order->save();
        return redirect('/admin/orders');
    }
}
