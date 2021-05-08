<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Validator;

class DeliveryAuthController extends Controller
{
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'phone' => 'required|numeric|digits:10',
                'password' => 'required',
            ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $phone = $request->input('phone');
        $password = $request->input('password');
        $user = Delivery::where('phone', $phone)->first();
        if ($user !== null) {
            $length = strlen($user->id);
            if (\Hash::check($password, $user->password)) {
                $user->api_token = $user->id . str_random(60 - $length);
                $user->notification_id = $request->notification_id;
                $user->save();
                return response()->json(['api_token' => $user->api_token]);
            }
            return response()->json([
                'error' => 'Password Incorrect',
                'code' => 401,
            ], 401);
        }

        return response()->json([
            'error' => 'Unauthenticated user',
            'code' => 401,
        ], 401);
    }

    public function logout($token)
    {
        $loggeduser = Delivery::where('api_token', $token)->first();
        if ($loggeduser) {
            $user = Delivery::find($loggeduser->id);
            $user->api_token = null; // clear api token
            $user->notification_id = null;
            $user->save();

            return response()->json(['message' => 'you are logged out']);
        }

        return response()->json([
            'error' => 'Unable to logout user',
            'code' => 401,
        ], 401);
    }

    public function changePass(Request $request, $token)
    {
        $user = Delivery::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $validator = Validator::make($request->all(),
            [
                'old_password' => 'required',
                'new_password' => 'required|min:8',
                'confirm_password' => 'required|same:new_password',
            ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        if (\Hash::check($request->old_password, $user->password)) {
            $update = Delivery::find($user->id);
            $update->password = bcrypt($request->new_password);
            $update->show_password = $request->new_password;
            $update->save();

            return response()->json(['message' => 'password updated']);
        }

        return response()->json(['error' => 'old password incorrect']);
    }
}
