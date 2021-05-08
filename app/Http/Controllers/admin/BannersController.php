<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Banner;
use Illuminate\Http\Request;
use Validator;
use Session;

class BannersController extends Controller
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

    public function bannerList()
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $banners = Banner::paginate(15);
        return view('admin.banners.banner-list')->with('banners', $banners);
    }

    public function bannerAddForm()
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        return view('admin.banners.banner-add');
    }

    public function bannerAdd(Request $request)
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5000',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('error','Validation failed');
            return back()->withInput($request->all())->withErrors($validator);

        }

        $file = $request->file('image');
        $destinationPath = public_path('images/banners/');
        $filename = $file->getClientOriginalName();
        $file->move($destinationPath, $filename);

        $banners = Banner::create([
            'name' => $request->name,
            'image' => '/images/banners/' . $filename,
            'status' => $request->status,
            'link' => $request->link,
        ]);
        Session::flash('success','Banner added');
        return redirect('/admin/banners');
    }

    public function bannerEditForm($id)
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $banner = Banner::find($id);
        return view('admin.banners.banner-edit')->with('banner', $banner);
    }

    public function bannerEdit(Request $request,$id)
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $banner = Banner::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3000',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('error','Validation failed');
            return back()->withInput($request->all())->withErrors($validator);

        }

        if ($request->hasFile('image')) {
            \File::delete(public_path($banner->image));
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();

            $destinationPath = public_path('images/banners/');
            $filename = $banner->id.'.'.$ext;

            $file->move($destinationPath, $filename);
            $filename = '/images/banners/' . $filename;
        } else {
            $filename = $banner->image;
        }

        $banner->name = $request->name;
        $banner->image = $filename;
        $banner->status = $request->status;
        $banner->link = $request->link;
        $banner->save();
        Session::flash('success','Banner updated');
        return redirect('/admin/banners');
    }

    public function bannerDelete($id)
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $banner = Banner::find($id);
        \File::delete(public_path($banner->image));
        $banner->delete();
        Session::flash('success','Banner deleted');
        return redirect('/admin/banners');
    }
}
