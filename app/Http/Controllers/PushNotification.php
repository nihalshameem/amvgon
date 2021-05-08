<?php

namespace App\Http\Controllers;

use App\Models\api\customer;
use App\Models\Delivery;

class PushNotification extends Controller
{
    public function send_notification_FCM($id, $title, $message)
    {

        $accesstoken = env('FCM_KEY');
        $user = customer::where('id', $id)->first();
        $notification_id = $user->notification_id;
        if ($user != null) {
            $URL = 'https://fcm.googleapis.com/fcm/send';

            $post_data = '{
          "to" : "' . $notification_id . '",
          "data" : {
            "body" : "",
            "title" : "' . $title . '",
            "message" : "' . $message . '",
          },
          "notification" : {
               "body" : "' . $message . '",
               "title" : "' . $title . '",
               "message" : "' . $message . '",
              "icon" : "new",
              "sound" : "default"
              },

        }';
            // print_r($post_data);die;

            $crl = curl_init();

            $headr = array();
            $headr[] = 'Content-type: application/json';
            $headr[] = 'Authorization: key=' . $accesstoken;
            curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, false);

            curl_setopt($crl, CURLOPT_URL, $URL);
            curl_setopt($crl, CURLOPT_HTTPHEADER, $headr);

            curl_setopt($crl, CURLOPT_POST, true);
            curl_setopt($crl, CURLOPT_POSTFIELDS, $post_data);
            curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);

            $rest = curl_exec($crl);
        }

    }
     public function send_notification_delivery($id, $title, $message, $orderId, $reqId)
    {
        $accesstoken = env('FCM_KEY');
        $user = Delivery::where('id', $id)->first();
        $notification_id = $user->notification_id;
        if ($user->notification_id !== null) {
            $headers = array(
                'Authorization: key=' . $accesstoken, // here Assigning Authentication Key
                'Content-Type: application/json',
            );
            $url = 'https://fcm.googleapis.com/fcm/send';
            $fields = array(
                'to' => $notification_id, // here Mobile Registration ID
                'collapse_key' => 'Test Message',
                'notification' => array(
                    "title" => $title,
                    "body" => $message,
                ),
                'data' => array(
                    "order_id" => $orderId,
                    "request_id" => $reqId,
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
    public function send_all_delivery($orderId, $title, $body)
    {
        $accesstoken = env('FCM_KEY');
        $users = Delivery::where('status', 1)->get();
        $notification_id = [];
        $x = 0;
        foreach ($users as $user) {
            if ($user->notification_id !== null) {
                $notification_id[$x] = $user->notification_id;
                $x++;
            }
        }
        if ($notification_id !== null) {
            $headers = array(
                'Authorization: key=' . $accesstoken,
                'Content-Type: application/json',
            );
            $url = 'https://fcm.googleapis.com/fcm/send';
            $fields = array(
                'registration_ids' => $notification_id, // here Mobile Registration ID
                'collapse_key' => 'New Message',
                'notification' => array(
                    "title" => $title,
                    "body" => $body,
                    "sound" => true,
                ),
                'data' => array(
                    "order_id" => $orderId,
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
        }

    }

}
