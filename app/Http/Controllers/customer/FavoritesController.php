<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;
use Session;

class FavoritesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:customer');
    }
    public function favoriteList()
    {
        $user = auth()->user();
        $favorites = Favorite::where('customer_id', $user->id)->get();
        foreach ($favorites as $fav) {
            $product = Product::find($fav->product_id);
            $fav->image = $product->image;
            $fav->name = $product->name;
            if ($product->category == 'Root') {
                $fav->category_name = 'Root';
            } else {
                $cat = Category::find($product->category);
                $fav->category_name = $cat->name;
            }
        }
        return view('customer.favorite.favorite-list')->with('favorites', $favorites);
    }
    public static function addFavoriteAjax(Request $request)
    {
        $user_id = auth()->user()->id;
        $userFavs = Favorite::where('customer_id', $user_id)->get();
        foreach ($userFavs as $fav) {
            if ($fav->product_id == $request->product_id) {
                return response()->json([
                    'update' => '1',
                ]);
            }
        }
        Favorite::create([
            'customer_id' => $user_id,
            'product_id' => $request->product_id,
        ]);
        return response()->json([
            'success' => '1',
        ]);

    }
    public static function addFavorite($id)
    {
        $user_id = auth()->user()->id;
        $userFavs = Favorite::where('customer_id', $user_id)->get();
        foreach ($userFavs as $fav) {
            if ($fav->product_id == $id) {
                Session::flash('error', 'Product already exists');
                return redirect('/customer/favorites');
            }
        }
        Favorite::create([
            'customer_id' => $user_id,
            'product_id' => $id,
        ]);
        Session::flash('success', 'Added to favorites');
                return redirect('/customer/favorites');

    }

    public function favoriteDelete($id)
    {
        Favorite::find($id)->delete();
        Session::flash('success', 'Favorite item deleted');
        return redirect()->back();
    }

    public function favoriteClearall()
    {
        $user_id = auth()->user()->id;
        Favorite::where('customer_id', $user_id)->delete();
        Session::flash('success', 'Favorite list cleared');
        return redirect()->back();
    }
}
