<?php

namespace App\Http\Controllers\delivery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\SalaryPaid;
use Validator;

class DeliveriesController extends Controller
{

    public function profile($token)
    {
        $user = Delivery::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        return response()->json([
            'user' => $user,
        ]);
    }

    public function statusChange($token)
    {
        $user = Delivery::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        if($user->status == 1){
            $user->status = 0;
        }else{
            $user->status = 1;
        }
        $user->save();
        return response()->json([
            'status' => $user->status,
        ]);
    }

    public function locationUpdate($token, Request $request)
    {
        $user = Delivery::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $validator = Validator::make($request->all(), [
            'latitude' => 'required',
            'longitude' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $user->latitude = $request->latitude;
        $user->longitude = $request->longitude;
        $user->save();
        return response()->json([
            'message' => 'Location updated',
        ]);
    }

    public function paidList($token){
        $user = Delivery::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $salaries = SalaryPaid::where('delivery_id',$user->id)->get();
        return response()->json([
            'salaries' => $salaries,
        ]);
    }

    public function cashGiven($token)
    {
        $user = Delivery::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $orders = Order::where('delivery',$user->id)->where('get_cash',1)->get();
        return response()->json([
            'cash_given' => $orders,
        ]);
    }
}
