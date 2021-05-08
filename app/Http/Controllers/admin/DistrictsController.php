<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use Validator;
use Session;

class DistrictsController extends Controller
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

    public function districtList(Request $request){
        $districts = District::paginate(15);
        return view('admin.districts.district-list')->with('districts',$districts);
    }

    public function districtAdd(Request $request){
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Permission denied');
            return back();
        }
        $validator = Validator::make($request->all(), [
            'district' => 'required|string',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('error','Validation failed');
            return back()->withInput($request->all())->withErrors($validator);
        }
        $district = District::create([
            'name' => $request->district,
            'status' => $request->status,
        ]);
        Session::flash('success','District added');
        return redirect('/admin/districts');
    }

    public function districtEditForm($id){
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Permission denied');
            return back();
        }
        $district = District::find($id);
        return view('admin.districts.district-edit')->with('district',$district);
    }

    public function districtUpdate(Request $request,$id){
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Permission denied');
            return back();
        }
        $district = District::find($id);

        $validator = Validator::make($request->all(), [
            'district' => 'required|string',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('error','Validation failed');
            return back()->withInput($request->all())->withErrors($validator);
        }
        $district->name = $request->district;
        $district->status = $request->status;
        $district->save();
        Session::flash('success','District updated');
        return redirect('/admin/districts');
    }

    public function districtDelete($id){
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Permission denied');
            return back();
        }
        District::find($id)->delete();
        Session::flash('success','District deleted');
        return redirect('/admin/districts');
    }
}
