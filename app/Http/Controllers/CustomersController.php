<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\api\customer;
use App\Models\District;
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
        $this->middleware('auth:customer');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $customer = auth()->user();
        $addresses = Address::where('customer_id', $customer->id)->get();
        $districts = District::where('status', 1)->get();
        foreach ($addresses as $ad) {
            $dis = District::find($ad->district);
            $ad->district = $dis->name;
        }
        return view('customer.profile.profile-show')->with('customer', $customer)->with('addresses', $addresses)->with('districts', $districts);
    }

    public function profileUpdate(Request $request)
    {
        $id = auth()->user()->id;
        $user = customer::find($id);
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'nullable|email|unique:customers,email,' . $user->id,
            'phone' => 'required|digits:10|numeric|unique:customers,phone,' . $user->id,
            'image' => 'image|mimes:jpeg,png,jpg|max:3000',
        ]);
        if ($validator->fails()) {
            Session::flash('error', 'Something wrong');
            return redirect()->back()->withErrors($validator)->with('error_code', 5);
        }
        if ($request->hasFile('image')) {
            if ($user->image !== '/images/customers/no_image.png') {
        \File::delete(public_path($user->image));
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();

            $destinationPath = public_path('/images/customers/');
            $filename = $user->id . '.' . $ext;

            $file->move($destinationPath, $filename);
            $filename = '/images/customers/' . $filename;
        } else {
            $filename = $user->image;
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->image = $filename;
        $user->save();
        Session::flash('success', 'Profile updated');
        return redirect()->back();
    }
    public function changePassword(Request $request)
    {
        $id = auth()->user()->id;
        $user = customer::find($id);
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);
        if ($validator->fails()) {
            Session::flash('error', 'Something wrong');
            return redirect()->back()->withErrors($validator)->with('error_code', 6);
        }
        if (\Hash::check($request->old_password, $user->password)) {
            $update = customer::find($user->id);
            $update->password = bcrypt($request->new_password);
            $update->save();
            Session::flash('success', 'Password changed');
            return redirect()->back();
        } else {
            $validator->old_password = 'Old password is incorrect';
            $validator->new_password = '';
            $validator->confirm_password = '';
            Session::flash('error', 'Old password incorrect');
            return redirect()->back()->withErrors($validator);
        }
    }
}
