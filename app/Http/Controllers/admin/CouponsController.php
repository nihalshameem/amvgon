<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Session;
use Validator;

class CouponsController extends Controller
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

    public function couponList()
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $coupons = Coupon::paginate(15);
        return view('admin.coupons.coupon-list', ['coupons' => $coupons]);
    }

    public function couponAddForm()
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        return view('admin.coupons.coupon-add');
    }

    public function couponAdd(Request $request)
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5000',
            'code' => 'required|unique:coupons',
            'min_price' => 'required|numeric',
            'max_price' => 'required|numeric',
            'discount' => 'required|numeric',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('error', 'Validation failed');
            return back()->withInput($request->all())->withErrors($validator);

        }
        $coupon = Coupon::create([
            'name' => $request->name,
        'image' => 'nil',
        'code' => $request->code,
        'min_price' => $request->min_price,
        'max_price' => $request->max_price,
        'discount' => $request->discount,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        ]);
        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();
        $destinationPath = public_path('images/coupons');
        $filename = $coupon->id . '.' . $ext;
        $file->move($destinationPath, $filename);
        $filename = '/images/coupons/' . $filename;
        $coupon->image = $filename;
        $coupon->save();
        
        Session::flash('success', 'New coupon added');
        return redirect('/admin/coupons');
    }

    public function couponEditForm($id){
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $coupon = Coupon::find($id);
        return view('admin.coupons.coupon-edit',['coupon' => $coupon]);
    }

    public function couponUpdate(Request $request,$id)
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $coupon = Coupon::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg|max:5000',
            'code' => 'required|unique:coupons,code,' . $coupon->id,
            'min_price' => 'required|numeric',
            'max_price' => 'required|numeric',
            'discount' => 'required|numeric',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('error', 'Validation failed');
            return back()->withInput($request->all())->withErrors($validator);

        }
        $filename = $coupon->image;
        if($request->hasFile('image')){
            \File::delete(public_path($coupon->image));
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $destinationPath = public_path('images/coupons');
            $filename = $coupon->id . '.' . $ext;
            $file->move($destinationPath, $filename);
            $filename = '/images/coupons/' . $filename;
        }
        $coupon->name = $request->name;
        $coupon->image = $filename;
        $coupon->code = $request->code;
        $coupon->min_price = $request->min_price;
        $coupon->max_price = $request->max_price;
        $coupon->discount = $request->discount;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->save();
        
        Session::flash('success', 'New coupon added');
        return redirect('/admin/coupons');
    }

    public function couponDelete($id)
	{
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $coupon = Coupon::find($id);
        \File::delete(public_path($coupon->image));
        $coupon->delete();
        Session::flash('success','Coupon Deleted');
        return redirect('/admin/coupons');
    }
}
