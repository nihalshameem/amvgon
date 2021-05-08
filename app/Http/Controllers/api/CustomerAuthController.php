<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\api\customer;
use Illuminate\Http\Request;
use Validator;

class CustomerAuthController extends Controller
{
    public function phoneValidate(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'phone' => 'required|numeric|digits:10|unique:customers,phone',
            ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        return response()->json(['success' => 'Valid phone number']);
    }
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'nullable|email|unique:customers,email',
                'phone' => 'required|numeric|digits:10|unique:customers,phone',
                'password' => 'required|min:4',
                'c_password' => 'required|same:password',
            ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $email = $request->email;
        $phone = $request->phone;
        $password = bcrypt($request->password);
        $user = customer::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' => $phone,
            'password' => $password,
            'notification_id' => $request->notification_id
        ]);
        return response()->json([
            'message' => 'customer registered!',
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|numeric|digits:10',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $phone = $request->input('phone');
        $password = $request->input('password');
        $user = customer::where('phone', $phone)->first();
        if ($user !== null) {
            $length = strlen($user->id);
            if (\Hash::check($password, $user->password)) {
                $user->api_token = $user->id . str_random(60 - $length);
                $user->notification_id = $request->notification_id;
                $user->save();
                return response()->json([
                    'api_token' => $user->api_token,
                ]);
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

    public function forgetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|numeric|digits:10',
            'new_password' => 'required|min:4',
            'confirm_password' => 'required|same:new_password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $user = customer::where('phone', $request->phone)->first();
        if ($user == null) {
            return response()->json(['error' => 'Invalid user phone number']);
        }
        $user->password = bcrypt($request->new_password);
        $user->save();
        return response()->json(['success' => 'password updated']);
    }

    public function logout($token)
    {

        $loggeduser = customer::where('api_token', $token)->first();

        if ($loggeduser) {
            $user = customer::find($loggeduser->id);
            $user->api_token = null; // clear api token
            $user->notification_id = null;
            $user->save();

            return response()->json([
                'message' => 'you are logged out',
            ]);
        }

        return response()->json([
            'error' => 'Unable to logout user',
            'code' => 401,
        ], 401);
    }
}
