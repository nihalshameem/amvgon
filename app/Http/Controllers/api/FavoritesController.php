<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Favorite;
use App\Models\api\customer;
use Validator;

class FavoritesController extends Controller
{

    public function favoriteList($token){
        $user = customer::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $favorites = Favorite::where('customer_id',$user->id)->get();
        $x = 0;
        foreach($favorites as $fav){
            $products[$x] = Product::find($fav->product_id);
            $products[$x]->favorite_id = $fav->id;
            $x++;
        }
        return response()->json([
            'favorites' => $products,
        ]);
    }

    public function favoriteAdd(Request $request,$token){
        $user = customer::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $userFav = Favorite::where('customer_id', $user->id)->get();
        foreach ($userFav as $fav) {
            if ($fav->product_id == $request->product_id) {
                return response()->json([
                    'message' => 'already exists',
                ]);
            }
        }
        $favorites = Favorite::create([
            'customer_id' => $user->id,
            'product_id' => $request->product_id,
        ]);

        return response()->json([
            'message' => 'added to favorite succesfully!',
        ]);
    }

    public function favoriteDelete(Request $request,$token)
    {
        $user = customer::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $validator = Validator::make($request->all(),
            [
                'favorite_id' => 'required',
            ]);

        if ($validator->fails()) {

            return response()->json(['error' => $validator->errors()], 401);

        }
        $favorites = Favorite::where('customer_id', $user->id)->get();
        foreach($favorites as $favorite){
            if($favorite->id == $request->favorite_id){
                $address = Favorite::find($favorite->id);
                $address->delete();
            }
        }
            return response()->json([
                'message' => 'favorite deleted successfully!',
            ]);
    }

    public function favoriteDeleteAll(Request $request, $token)
    {
        $user = customer::where('api_token', $token)->first();
        if ($user == null) {return response()->json(['error' => 'Authentication error']);}
        $favorite = Favorite::where('customer_id',$user->id)->delete();
        return response()->json(['message' => 'favorites cleared']);
    }
}
