<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\api\customer;
use App\Models\District;
use Illuminate\Http\Request;
use Validator;

class AddressesController extends Controller
{

    public function addressList($token)
    {
        $user = customer::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $addresses = Address::where('customer_id', $user->id)->get();
        if ($addresses->count() > 0) {
            foreach ($addresses as $ad) {
                $d = District::find($ad->district);
                $ad->district = $d->name;
            }
            return response()->json([
                'addresses' => $addresses,
            ]);
        }
        return response()->json([
            'message' => 'no data',
        ]);

    }

    public function addressSingle(Request $request, $token)
    {
        $user = customer::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $validator = Validator::make($request->all(),
            [
                'address_id' => 'required',
            ]);

        if ($validator->fails()) {

            return response()->json(['error' => $validator->errors()], 401);

        }
        $districts = District::where('status', 1)->get();
        $address = Address::find($request->address_id);
        $d = District::find($address->district);
        $address->district_name = $d->name;
        return response()->json([
            'address' => $address,
            'districts' => $districts,
        ]);
    }

    public function addressAdd(Request $request, $token)
    {
        $user = customer::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $validator = Validator::make($request->all(),
            [
                'door_no' => 'required',
                'village' => 'required',
                'district' => 'required',
                'pincode' => 'required',
            ]);

        if ($validator->fails()) {

            return response()->json(['error' => $validator->errors()], 401);

        }
        $alladdress = Address::where('customer_id', $user->id)->get();
        if(count($alladdress) < 4){
            $address = Address::create([
                'customer_id' => $user->id,
                'door_no' => $request->door_no,
                'village' => $request->village,
                'district' => $request->district,
                'pincode' => $request->pincode,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);
            return response()->json(['message' => 'address added successfuly!']);
        }
        return response()->json(['error' => 'Maximum address added!']);
        
    }

    public function addressUpdate(Request $request, $token)
    {
        $user = customer::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $validator = Validator::make($request->all(),
            [
                'address_id' => 'required',
                'door_no' => 'required',
                'village' => 'required',
                'district' => 'required',
                'pincode' => 'required',
            ]);

        if ($validator->fails()) {

            return response()->json(['error' => $validator->errors()], 401);

        }
        $address = Address::find($request->address_id);
        $address->customer_id = $user->id;
        $address->door_no = $request->door_no;
        $address->village = $request->village;
        $address->district = $request->district;
        $address->pincode = $request->pincode;
        $address->latitude = $request->latitude;
        $address->longitude = $request->longitude;
        $address->save();
        return response()->json(['message' => 'address updated successfuly!']);
    }

    public function addressDelete(Request $request, $token)
    {
        $user = customer::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $validator = Validator::make($request->all(),
            [
                'address_id' => 'required',
            ]);

        if ($validator->fails()) {

            return response()->json(['error' => $validator->errors()], 401);

        }
        $addresses = Address::where('customer_id', $user->id)->get();
        foreach ($addresses as $adds) {
            if ($adds->id == $request->address_id) {
                $address = Address::find($adds->id);
                $address->delete();
            }
        }
        return response()->json([
            'message' => 'address deleted successfully!',
        ]);
    }
}
