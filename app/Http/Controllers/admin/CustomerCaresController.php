<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerCare;
use Illuminate\Http\Request;
use Validator;
use Session;
use Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Gate;

class CustomerCaresController extends Controller
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

    public function customerCareList(){
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $customercare = CustomerCare::paginate(15);
        return view('admin.customer-care.care-list',['customercare' => $customercare]);
    }

    public function customerCareAdd(Request $request){
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone' => 'required|numeric|digits:10|unique:customer_cares,phone',
            'usecase' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('error','Validation failed');
            return back()->withInput($request->all())->withErrors($validator);
        }
        CustomerCare::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'usecase' => $request->usecase,
        ]);
        Session::flash('success','Customer care added');
        return redirect('admin/customer-cares');
    }

    public function customerCareEdit($id){
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $care = CustomerCare::find($id);
        return view('admin.customer-care.care-edit',['care'=>$care]);
    }

    public function customerCareUpdate($id,Request $request){
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $care = CustomerCare::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone' => 'required|numeric|digits:10|unique:customer_cares,phone,' . $care->id,
            'usecase' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('error','Validation failed');
            return back()->withInput($request->all())->withErrors($validator);
        }
        $care->name = $request->name;
        $care->phone = $request->phone;
        $care->usecase = $request->usecase;
        $care->save();
        Session::flash('success','Customer care updated');
        return redirect('admin/customer-cares');
    }

    public function customercareDelete($id){
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        CustomerCare::find($id)->delete();
        Session::flash('success','Customer care deleted');
        return redirect('admin/customer-cares');
    }
}
