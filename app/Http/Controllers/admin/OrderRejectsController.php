<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\api\customer;
use App\Models\Delivery;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderReject;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\PaymentStatus;
use Session;

class OrderRejectsController extends Controller
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

    public function rejectList()
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $rejects = OrderReject::orderBy('created_at', 'desc')->paginate(15);
        foreach ($rejects as $r) {
            $r->name = Delivery::find($r->delivery_id)->name;
            $r->phone = Delivery::find($r->delivery_id)->phone;
        }

        return view('admin.order-rejects.reject-list', ['rejects' => $rejects]);
    }

    public function rejectDetail($id)
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $reject = OrderReject::find($id);
        $order = Order::find($reject->order_id);
        $order->payment_method = PaymentMethod::find($order->payment_method)->name;
        $order->payment_status = PaymentStatus::find($order->payment_status)->name;
        $order->order_status = OrderStatus::find($order->order_status)->name;
        $order->district = District::find($order->district)->name;
        $reject->first_name = customer::find($order->customer_id)->first_name;
        $reject->last_name = customer::find($order->customer_id)->last_name;
        $delivery = Delivery::find($reject->delivery_id);
        $delivery->district = District::find($delivery->district)->name;

        return view('admin.order-rejects.reject-detail', [
            'reject' => $reject,
            'order' => $order,
            'delivery' => $delivery,
        ]);
    }

    public function rejectDelete($id)
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        OrderReject::find($id)->delete();
        Session::flash('success', 'Order Reject deleted');
        return redirect('/admin/rejects');
    }
}
