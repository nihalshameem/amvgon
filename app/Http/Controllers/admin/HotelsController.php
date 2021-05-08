<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use Validator;
use Session;

class HotelsController extends Controller
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

    public function hotelList()
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $hotels = Hotel::paginate(15);
        return view('admin.hotel.hotel-list')->with('hotels', $hotels);
    }

    public function hotelAdd(Request $request){
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5000',
        ]);
        if ($validator->fails()) {
            Session::flash('error','Validation failed');
            return back()->withInput($request->all())->withErrors($validator);
        }
        $hotel = Hotel::create([
            'name' => $request->name,
            'image' => 'nill',
        ]);
        

        // image
        $imageFile = $request->file('image');
        $imageExt = $imageFile->getClientOriginalExtension();
        $imageDestinationPath = public_path('images/hotels/');
        $imageFilename = $hotel->id . '.' . $imageExt;
        $imageFile->move($imageDestinationPath, $imageFilename);
        $imageFilename = '/images/hotels/' . $imageFilename;

        $update = Hotel::find($hotel->id);
        $update->image = $imageFilename;
        $update->save();
        Session::flash('success','hotel added');
        return redirect('/admin/hotels');
    }

    public function hotelEdit($id){
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $hotel = Hotel::find($id);
        return view('admin.hotel.hotel-edit')->with('hotel',$hotel);
    }

    public function hotelUpdate(Request $request,$id){
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg|max:5000',
        ]);
        if ($validator->fails()) {
            Session::flash('error','Validation error');
            return back()->withInput($request->all())->withErrors($validator);
        }
        $hotel = Hotel::find($id);
        if($request->hasFile('image')){
        \File::delete(public_path($hotel->image));
            $imageFile = $request->file('image');
        $imageExt = $imageFile->getClientOriginalExtension();
        $imageDestinationPath = public_path('/images/hotels/');
        $imageFilename = $hotel->id . '.' . $imageExt;
        $imageFile->move($imageDestinationPath, $imageFilename);
        $imageFilename = '/images/hotels/' . $imageFilename;
        }else{
            $imageFilename = $hotel->image;
        }

        $hotel->name = $request->name;
        $hotel->image = $imageFilename;
        $hotel->save();
        Session::flash('success','hotel updated');
        return redirect('/admin/hotels');
    }

    public function hotelDelete($id){
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $hotel = Hotel::find($id);
        \File::delete(public_path($hotel->image));
        $hotel->delete();
        Session::flash('success','hotel deleted');
        return redirect('/admin/hotels');
    }
}
