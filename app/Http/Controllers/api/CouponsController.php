<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\api\customer;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Validator;

class CouponsController extends Controller
{
    public function couponSingle($token, Request $request)
    {
        $user = customer::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $validator = Validator::make($request->all(),
            [
                'code' => 'required',
            ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $coupon = Coupon::where('code',$request->code)->first();
        if($coupon == null){
            return response()->json(['coupon' => '']);
        }
        return response()->json(['coupon' => $coupon]);
    }
    public function couponAll($token)
    {
        $user = customer::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $today = date('Y-m-d', strtotime(\Carbon\carbon::now()));
        $coupons = Coupon::where('end_date', '>=', $today)->where('start_date', '<=', $today)->get();
        return response()->json(['coupons' => $coupons]);
    }
}
