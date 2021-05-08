<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeliveryDay;
use Session;

class DeliveryDaysController extends Controller
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

    public function statusChange(Request $request){
        if(auth()->user()->role !== 'SuperAdmin'){
            return response()->json(['error' => 1]);
        }
        $delivery_day = DeliveryDay::find($request->id);
        if($delivery_day->status == 1){
            $delivery_day->status = 0;
        }else{
            $delivery_day->status = 1;
        }
        $delivery_day->save();
        return response()->json(['success' => 1]);
    }

    public function setting()
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $delivery_days = DeliveryDay::all();
        return view('admin.delivery-day.index', [
            'delivery_days' => $delivery_days,
        ]);
    }

    public function update(Request $request,$id){
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $delivery_day = DeliveryDay::find($id);
        $delivery_day->start = $request->start;
        $delivery_day->end = $request->end;
        $delivery_day->status = $request->status;
        $delivery_day->save();

        Session::flash('success','Updated Successfully');
        return redirect('admin/delivery-day/setting');

    }
}
