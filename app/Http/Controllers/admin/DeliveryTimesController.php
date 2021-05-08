<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeliveryTime;
use Validator;
use Session;

class DeliveryTimesController extends Controller
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

    public function timeList(){
        $times = DeliveryTime::paginate(15);
        return view('admin.delivery-time.list',['times' => $times]);
    }

    public function timeAdd(Request $request){
        if(auth()->user()->role == 'OrderAdmin'){
            Session::flash('error','Permission denied');
            return back();
        }
        $validator = Validator::make($request->all(), [
            'start' => 'required',
            'end' => 'required',
            'charge' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('error','Validation failed');
            return back()->withInput($request->all())->withErrors($validator);
        }
        DeliveryTime::create([
            'start' => date('h:i a', strtotime($request->start)),
            'end' => date('h:i a', strtotime($request->end)),
            'charge' => $request->charge
        ]);
        Session::flash('success','Delivery time added');
        return redirect('/admin/delivery-time');
    }

    public function timeEdit($id){
        $time = DeliveryTime::find($id);
        return view('admin.delivery-time.edit',['time'=>$time]);
    }

    public function timeUpdate(Request $request,$id){
        if(auth()->user()->role == 'OrderAdmin'){
            Session::flash('error','Permission denied');
            return back();
        }
        $validator = Validator::make($request->all(), [
            'start' => 'required',
            'end' => 'required',
            'charge' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('error','Validation failed');
            return back()->withInput($request->all())->withErrors($validator);
        }
        $time = DeliveryTime::find($id);
        $time->start = date('h:i a', strtotime($request->start));
        $time->end = date('h:i a', strtotime($request->end));
        $time->charge = $request->charge;
        $time->save();
        Session::flash('success','Delivery time updated');
        return redirect('/admin/delivery-time');
    }

    public function timeDelete($id){
        if(auth()->user()->role == 'OrderAdmin'){
            Session::flash('error','Permission denied');
            return back();
        }
        DeliveryTime::find($id)->delete();
        Session::flash('success','Delivery time deleted');
        return redirect('/admin/delivery-time');
    }
}
