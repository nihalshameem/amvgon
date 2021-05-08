<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\api\customer;
use App\Models\Address;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\PaymentStatus;
use Illuminate\Http\Request;
use Validator;
use Session;

class CustomersController extends Controller
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

    public function customerList()
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $customers = customer::paginate(15);
        return view('admin.customer.customer-list',[
            'customers' => $customers,
            'cus_search' => '',
        ]);
    }

    public function searchResult(Request $request){
        $value = $request->cus_search;
        $customers = customer::where('first_name', 'LIKE', '%' . $value . '%')->orWhere('last_name', 'LIKE', '%' . $value . '%')->orWhere('id', 'LIKE', '%' . $value . '%')->paginate(15);
        return view('admin.customer.customer-list', [
            'customers' => $customers,
            'cus_search' => $value,
        ]);
    }

    public function customerDetail($id){
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $customer = customer::find($id);
        $addresses = Address::where('customer_id',$id)->get();
        foreach($addresses as $ad){
            $district = district::find($ad->district);
            $ad->district = $district->name;
        }
        $orders = Order::where('customer_id',$id)->get();
        foreach($orders as $order){
            $os = OrderStatus::find($order->order_status);
            $order->order_status = $os->name;
            $ps = PaymentStatus::find($order->payment_status);
            $order->payment_status = $ps->name;
        }
        return view('admin.customer.customer-detail')->with('customer',$customer)->with('addresses',$addresses)->with('orders',$orders);
    }

    public function customerDelete($id){
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $customer = customer::find($id);
        if($customer->image !== '/images/customers/no_image.png'){
            \File::delete(public_path($customer->image));
        }
        $customer->delete();
        Session::flash('success','Customer deleted');
        return redirect('/admin/customers');
    }
}
