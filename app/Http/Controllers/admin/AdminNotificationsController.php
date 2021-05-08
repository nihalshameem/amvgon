<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminNotification;
use Validator;

class AdminNotificationsController extends Controller
{
    public function addDevice(Request $request){
        $validator = Validator::make($request->all(),
            [
                'admin_id' => 'required',
                'device_id' => 'required',
            ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        if(AdminNotification::where('device_id','=',$request->device_id)->exists()){
            return response()->json(['error' => 'device already exists']);
        }
        AdminNotification::create([
            'admin_id' => $request->admin_id,
            'device_id' => $request->device_id,
        ]);
        return response()->json(['success' => 'device added']);
    }
    public function removeDevice(Request $request){
        $validator = Validator::make($request->all(),
            [
                'device_id' => 'required',
            ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        AdminNotification::where('device_id',$request->device_id)->delete();

        return response()->json(['success' => 'device removed']);
    }
    
    public function adminNotification($admin_id,$title, $body,$orderID)
    {
        $accesstoken = env('FCM_KEY');
        $users = adminNotification::where('admin_id', $admin_id)->get();
        $device_id = [];
        $x = 0;
        foreach ($users as $user) {
            if ($user->device_id !== null) {
                $device_id[$x] = $user->device_id;
                $x++;
            }
        }
        if (count($users) > 0) {
            $headers = array(
                'Authorization: key=' . $accesstoken,
                'Content-Type: application/json',
            );
            $url = 'https://fcm.googleapis.com/fcm/send';
            $fields = array(
                'registration_ids' => $device_id, // here Mobile Registration ID
                'collapse_key' => 'New Message',
                'notification' => array(
                    "title" => $title,
                    "body" => $body,
                    "sound" => true,
                ),
                'data' => array(
                    "order_id" => $orderID,
                ),
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $res_json = curl_exec($ch);
            $result = get_object_vars(json_decode($res_json));
            $code = array('info' => curl_getinfo($ch, CURLINFO_HTTP_CODE));
            $merge1 = array_merge($code, $fields);
            $merge = array_merge($result, $merge1);
            $reposeDet = array('response' => $merge);
            curl_close($ch);
            return $reposeDet;
        }

    }
}
