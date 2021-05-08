<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\api\customer;
use App\Models\District;
use Illuminate\Http\Request;
use Session;
use Validator;

class AddressesController extends Controller
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
    public function addressAdd(Request $request)
    {
        $user_id = auth()->user()->id;
        $validator = Validator::make($request->all(), [
            'door_no' => 'required',
            'village' => 'required',
            'district' => 'required',
            'pincode' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('error', 'Something wrong');
            return redirect()->back()->withErrors($validator);
        }

        $alladdress = Address::where('customer_id', $user_id)->get();
        $adstring = $request->door_no.', '.$request->village.', '.District::find($request->district)->name.', tamil nadu '.$request->pincode.', india';
        $adstring = str_replace(" ", "+", $adstring);
        $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?key=".env('MAP_KEY')."&address=" . $adstring . "&sensor=false");
        $json = json_decode($json);

        $latitude = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
        $longitude = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
        if (count($alladdress) < 4) {
            Address::create([
                'customer_id' => $user_id,
                'door_no' => $request->door_no, 
                'village' => $request->village,
                'district' => $request->district,
                'pincode' => $request->pincode,
                'latitude' => $latitude,
                'longitude' => $longitude,
            ]);
            Session::flash('success', 'Address added');
            return redirect()->back();
        }
        Session::flash('error', 'Maximum address added!');
        return redirect()->back();
    }

    public function addressSingle($id)
    {
        $address = Address::find($id);
        $districts = District::where('status', 1)->get();
        return view('customer.profile.address-single', [
            'address' => $address,
            'districts' => $districts,
        ]);
    }
    public function addressUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'door_no' => 'required',
            'village' => 'required',
            'district' => 'required',
            'pincode' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Something wrong');
            return redirect()->back()->withErrors($validator);
        }

        $adstring = $request->door_no.', '.$request->village.', '.District::find($request->district)->name.', tamil nadu '.$request->pincode.', india';
        $adstring = str_replace(" ", "+", $adstring);
        $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?key=".env('MAP_KEY')."&address=" . $adstring . "&sensor=false");
        $json = json_decode($json);

        $latitude = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
        $longitude = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
        $address = Address::find($id);
        $address->door_no = $request->door_no;
        $address->village = $request->village;
        $address->district = $request->district;
        $address->pincode = $request->pincode;
        $address->latitude = $latitude;
        $address->longitude = $longitude;
        $address->save();
        Session::flash('success', 'Address updated');
        return redirect('/customer');
    }

    public function addressDelete($id)
    {
        Address::find($id)->delete();
        Session::flash('success', 'Address deleted');
        return redirect()->back();
    }
}
