<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\api\customer;
use App\Models\Delivery;
use App\Models\DeliveryRating;
use App\Models\Feedback;
use App\Models\Order;
use Illuminate\Http\Request;
use Validator;

class FeedbacksController extends Controller
{
    public function customerFeedback(Request $request, $token)
    {
        $user = customer::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $validator = Validator::make($request->all(),
            [
                'message' => 'required',
            ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $feedback = Feedback::create([
            'name' => $user->first_name . ' ' . $user->last_name,
            'email' => $user->email,
            'phone' => $user->phone,
            'message' => $request->message,
        ]);

        return response()->json(['message' => 'feedback sent']);
    }
    public function deliveryRating(Request $request, $token)
    {
        $user = customer::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $validator = Validator::make($request->all(),
            [
                'rating' => 'required|numeric|max:5|min:1',
                'order_id' => 'required|unique:delivery_ratings',
            ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $order = Order::find($request->order_id);
        $order->rating = $request->rating;
        $order->save();
        DeliveryRating::create([
            'delivery_id' => $order->delivery,
            'customer_id' => $user->id,
            'order_id' => $request->order_id,
            'rating' => $request->rating,
        ]);

        $rate = DeliveryRating::where('delivery_id', $order->delivery)->sum('rating');
        $avg = count(DeliveryRating::where('delivery_id', $order->delivery)->get());
        if ($avg !== 0) {
            $total = $rate / $avg;
            $total = number_format($total, 1);
        } else {
            $total = $request->rating;
        }
        $delivery = Delivery::find($order->delivery);
        $delivery->rating = $total;
        $delivery->save();

        return response()->json(['message' => 'Rating updated']);
    }

    public function customerRating($token)
    {
        $user = customer::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $not_rated = Order::orderBy('created_at', 'desc')->where('order_status', 3)->where('customer_id', $user->id)->where('rating', null)->get();
        foreach($not_rated as $nr){
            $nr->delivery_boy = Delivery::find($nr->delivery);
        }
        $rated = Order::orderBy('created_at', 'desc')->where('order_status', 3)->where('customer_id', $user->id)->where('rating', '!=', null)->get();
        foreach($rated as $r){
            $r->delivery_boy = Delivery::find($r->delivery);
        }

        return response()->json([
            'not_rated' => $not_rated,
            'rated' => $rated,
        ]);
    }
}
