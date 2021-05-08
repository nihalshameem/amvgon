<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\api\customer;
use App\Models\Delivery;
use App\Models\Product;
use Illuminate\Http\Request;
use Session;
use Validator;

class SendNotificationsController extends Controller
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
    public function showForm()
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $products = Product::all();
        return view('admin.notification.index', ['products' => $products]);
    }
    public function send_all_notification(Request $request)
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg|max:5000|nullable',
            'body' => 'required',
            'to' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('error', 'Validation failed');
            return back()->withInput($request->all())->withErrors($validator);
        }
        $accesstoken = env('FCM_KEY');
        $to = $request->to;
        if ($to == 'delivery') {
            $users = Delivery::all();
        } else {
            $users = customer::all();
        }
        $notification_id = [];
        $x = 0;
        foreach ($users as $user) {
            if ($user->notification_id !== null) {
                $notification_id[$x] = $user->notification_id;
                $x++;
            }
        }
        if ($notification_id == null) {
            Session::flash('error', 'no ' . $request->to . ' logged in');
            return back()->withInput($request->all());
        }
        $headers = array(
            'Authorization: key=' . $accesstoken,
            'Content-Type: application/json',
        );
        $url = 'https://fcm.googleapis.com/fcm/send';
        if ($request->hasFile('image')) {
            \File::delete(public_path('/images/notify/temp.png'));
            $file = $request->file('image');
            $destinationPath = public_path('/images/notify/');
            $file->move($destinationPath, 'temp.png');
        } else {
            \File::delete(public_path('/images/notify/temp.png'));
        }
        $fields = array(
            'registration_ids' => $notification_id, // here Mobile Registration ID
            'collapse_key' => 'New Message',
            'notification' => array(
                "title" => $request->title,
                "body" => $request->body,
                "image" => 'https://www.amvgon.com//images/notify/temp.png',
            ),
            'data' => array(
                "product_id" => $request->product_id,
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
        // $reposeDet = array('response' => $merge['success']);
        curl_close($ch);
        if ($merge['success'] > 0) {
            Session::flash('success', 'message sent');
            return redirect('/admin/send-notification');
        } else {
            Session::flash('error', 'Somthing wrong');
            return back();
        }
    }
}
