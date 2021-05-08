<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\ComboDetail;
use App\Models\ComboProduct;
use App\Models\DeliveryDay;
use App\Models\FunctionModel;
use App\Models\Hotel;
use App\Models\Product;
use Illuminate\Http\Request;
use Session;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $banners = Banner::where('status', 1)->get();
        if($request->exists('day')){
            $day = DeliveryDay::where('name',$request->day)->where('status',1)->first();
        }else {
            $day = DeliveryDay::where('status',1)->first();
        }
        if($day !== null){
            $day = $day->name;
            if($day == 'today'){
                $hotProducts = Product::where('stock','!=',0)->where('standard_stock','!=',0)->where('excellent_stock','!=',0)->where('type', 3)->where('active',1)->get()->take(4);
                $allHots = Product::where('stock','!=',0)->where('standard_stock','!=',0)->where('excellent_stock','!=',0)->orderBy('name', 'ASC')->where('type', 3)->where('active',1)->get();
                $products = Product::where('stock','!=',0)->where('standard_stock','!=',0)->where('excellent_stock','!=',0)->where('type', 1)->get()->where('active',1)->take(10);
                $sideRandoms = Product::where('stock','!=',0)->where('standard_stock','!=',0)->where('excellent_stock','!=',0)->where('type', 1)->get()->where('active',1)->take(10);
            }elseif($day == 'tomorrow'){
                $hotProducts = Product::where('type', 3)->where('active',1)->get()->take(4);
                $allHots = Product::orderBy('name', 'ASC')->where('type', 3)->where('active',1)->get();
                $products = Product::where('type', 1)->get()->where('active',1)->take(10);
                $sideRandoms = Product::where('type', 1)->get()->where('active',1)->take(10);
            }
        }else{
            $hotProducts = [];
            $allHots = [];
            $products = [];
            $sideRandoms = [];
        }
        foreach ($hotProducts as $hot) {
            if ($hot->unit == 'kg') {
                $hot->price = $hot->price / 10;
                $hot->standard_price = $hot->standard_price / 10;
                $hot->excellent_price = $hot->excellent_price / 10;
            }
        }
        $today = date('Y-m-d', strtotime(\Carbon\carbon::now()));
        $sideCombos = ComboProduct::where('expiry_date', '>=', $today)->get();
        foreach ($products as $product) {
            if ($product->unit == 'kg') {
                $product->price = $product->price / 10;
                $product->standard_price = $product->standard_price / 10;
                $product->excellent_price = $product->excellent_price / 10;
            }
        }
        $today = date('Y-m-d', strtotime(\Carbon\carbon::now()));
        $combos = ComboProduct::orderBy('created_at', 'desc')->where('expiry_date', '>=', $today)->take(4)->get();
        foreach ($combos as $combo) {
            $remin_qty = [];
            $y = 0;
            $combo_price = 0;
            $details = ComboDetail::where('combo_id', $combo->id)->get();
            foreach ($details as $d) {
                $price = 0;
                $p = Product::find($d->product_id);
                if ($d->type == 'normal') {
                    $price_type = 'price';
                    $minqty_type = 'min_qty';
                } else {
                    $price_type = $d->type . '_price';
                    $minqty_type = $d->type . '_min_qty';
                }
                $remin_qty[$y] = $p->$minqty_type;
                $y++;
                $price = $p->$price_type;
                $combo_price = $combo_price + $price;
                $d->product = $p;
                $d->price = $p->$price_type;
            }
            $combo->remin_qty = min($remin_qty) * 1000;
            $combo_price = $combo_price * min($remin_qty);
            $combo->combo_price = $combo_price - ($combo_price * $combo->discount / 100);
            $combo->details = $details;
        }
        return view('welcome', [
            'banners' => $banners,
            'hotProducts' => $hotProducts,
            'allHots' => $allHots,
            'sideCombos' => $sideCombos,
            'sideRandoms' => $sideRandoms,
            'products' => $products,
            'combos' => $combos,
            'day' => $day,
        ]);
    }

    public function products(Request $request)
    {
        if($request->exists('day')){
            $day = DeliveryDay::where('name',$request->day)->where('status',1)->first();
        }else {
            $day = DeliveryDay::where('status',1)->first();
        }
        if ($day !== null) {
            $day = $day->name;
            if($day == 'today'){
                $products = Product::where('stock','!=',0)->where('standard_stock','!=',0)->where('excellent_stock','!=',0)->where('active',1)->paginate(20);
            }else{
                $products = Product::where('active',1)->paginate(20);
            }
        } else {
            $products = [];
        }
        foreach ($products as $product) {
            $product->price = $product->price * $product->min_qty;
            $product->standard_price = $product->standard_price * $product->standard_min_qty;
            $product->excellent_price = $product->excellent_price * $product->excellent_min_qty;
        }
        $sidecategories = Category::all();
        $today = date('Y-m-d', strtotime(\Carbon\carbon::now()));
        $combos = ComboProduct::orderBy('created_at', 'desc')->where('expiry_date', '>=', $today)->get();
        foreach ($combos as $combo) {
            $remin_qty = [];
            $y = 0;
            $combo_price = 0;
            $details = ComboDetail::where('combo_id', $combo->id)->get();
            foreach ($details as $d) {
                $price = 0;
                $p = Product::find($d->product_id);
                if ($d->type == 'normal') {
                    $price_type = 'price';
                    $minqty_type = 'min_qty';
                } else {
                    $price_type = $d->type . '_price';
                    $minqty_type = $d->type . '_min_qty';
                }
                $remin_qty[$y] = $p->$minqty_type;
                $y++;
                $price = $p->$price_type;
                $combo_price = $combo_price + $price;
                $d->product = $p;
                $d->price = $p->$price_type;
            }
            $combo->remin_qty = min($remin_qty) * 1000;
            $combo_price = $combo_price * min($remin_qty);
            $combo->combo_price = $combo_price - ($combo_price * $combo->discount / 100);
            $combo->details = $details;
        }
        return view('customer.product.product-list', [
            'products' => $products,
            'sidecategories' => $sidecategories,
            'combos' => $combos,
            'day' => $day,
        ]);
    }

    public function productSingle(Request $request,$id)
    {
        if($request->exists('day')){
            $day = DeliveryDay::where('name',$request->day)->where('status',1)->first();
        }else {
            $day = DeliveryDay::where('status',1)->first();
        }
        if($day !== null){
            $day = $day->name;
            if($day == 'today'){
                $product = Product::where('stock','!=',0)->where('standard_stock','!=',0)->where('excellent_stock','!=',0)->where('id',$id)->first();
                $relateds = Product::where('stock','!=',0)->where('standard_stock','!=',0)->where('excellent_stock','!=',0)->where('active',1)->get()->take(4);
            }else {
                $product = Product::find($id);
                $relateds = Product::where('active',1)->get()->take(4);
            }
        }else{
            Session::flash('error', 'Product not available');
            return back();
        }
        if($product !== null){
            if($product->active == 0){
                Session::flash('error', 'Product not active');
                return redirect()->back();
            }
        }else{
            Session::flash('error', 'Product not available');
            return redirect('/products?day='.$day);
        }
        $minArr = [];
        $minArr[0] = $product->min_qty;
        $minArr[1] = $product->standard_min_qty;
        $minArr[2] = $product->excellent_min_qty;
        $product->price = $product->price * min($minArr);
        $product->standard_price = $product->standard_price * min($minArr);
        $product->excellent_price = $product->excellent_price * min($minArr);
        $product->low_qty = min($minArr);
        foreach ($relateds as $item) {
                
            $item->price = $item->price * $item->min_qty;
            $item->standard_price = $item->standard_price * $item->standard_min_qty;
            $item->excellent_price = $item->excellent_price * $item->excellent_min_qty;
        }
        Session::forget('error');
        return view('customer.product.product-single',[
            'product' => $product,
            'relateds' => $relateds,
            'day' => $day,
        ]);
    }

    public function comboSingle(Request $request,$id)
    {
        if($request->exists('day')){
            $day = DeliveryDay::where('name',$request->day)->where('status',1)->first();
        }else {
            $day = DeliveryDay::where('status',1)->first();
        }
        if($day !== null){
            $day = $day->name;
        }
        $combo = ComboProduct::find($id);
        $combo_details = ComboDetail::where('combo_id', $id)->get();
        $min_qty = [];
        $x = 0;
        foreach ($combo_details as $detail) {
            $product = Product::find($detail->product_id);
            if ($detail->type == 'normal') {
                $price = 'price';
                $selqty = 'min_qty';
            } else {
                $price = $detail->type . '_price';
                $selqty = $detail->type . '_min_qty';
            }
            $min_qty[$x] = $product->$selqty * 1000;
            $x++;
            $detail->product = $product;
            $detail->price = $product->$price;
        }
        $combo->min_qty = min($min_qty);
        $today = date('Y-m-d', strtotime(\Carbon\carbon::now()));
        $relateds = ComboProduct::orderBy('created_at', 'desc')->where('expiry_date', '>=', $today)->take(4)->get();
        foreach ($relateds as $relate) {
            $remin_qty = [];
            $y = 0;
            $combo_price = 0;
            $details = ComboDetail::where('combo_id', $relate->id)->get();
            foreach ($details as $d) {
                $price = 0;
                $p = Product::find($d->product_id);
                if ($d->type == 'normal') {
                    $price_type = 'price';
                    $minqty_type = 'min_qty';
                } else {
                    $price_type = $d->type . '_price';
                    $minqty_type = $d->type . '_min_qty';
                }
                $remin_qty[$y] = $p->$minqty_type;
                $y++;
                $price = $p->$price_type;
                $combo_price = $combo_price + $price;
                $d->product = $p;
                $d->price = $p->$price_type;
            }
            $relate->remin_qty = min($remin_qty) * 1000;
            $combo_price = $combo_price * min($remin_qty);
            $relate->combo_price = $combo_price - ($combo_price * $relate->discount / 100);
            $relate->details = $details;
        }
        return view('customer.product.combo-single', [
            'combo' => $combo,
            'combo_details' => $combo_details,
            'relateds' => $relateds,
            'day' => $day,
        ]);
    }

    public function categoryList()
    {
        $categories = Category::paginate(20);
        return view('customer.category.category-list')->with('categories', $categories);
    }

    public function categoryProducts($id)
    {
        if ($id == 'Regular') {
            $category_name = 'Regular';
        } else {
            $category = Category::find($id);
            $category_name = $category->name;
        }
        $products = Product::where('category', $id)->paginate(15);
        return view('customer.category.category-single')->with('category_name', $category_name)->with('products', $products);
    }

    public function searchResult(Request $request)
    {
        $name = $request->value;
        $today = date('Y-m-d', strtotime(\Carbon\carbon::now()));
        $products = Product::where('name', 'LIKE', '%' . $name . '%')->get();
        $combos = ComboProduct::where('name', 'LIKE', '%' . $name . '%')->where('expiry_date', '>=', $today)->get();
        return view('customer.layouts.search',[
            'products' => $products,
            'combos' => $combos,
        ]);
    }

    public function functionList(Request $request){
        if($request->exists('day')){
            $day = DeliveryDay::where('name',$request->day)->where('status',1)->first();
        }else {
            $day = DeliveryDay::where('status',1)->first();
        }
        if($day !== null){
            $day = $day->name;
        }
        $lists = FunctionModel::all();
        return view('customer.category.album',[
            'lists' => $lists,
            'day' => $day,
            'title' => 'Functions',
        ]);
    }

    public function hotelList(Request $request){
        if($request->exists('day')){
            $day = DeliveryDay::where('name',$request->day)->where('status',1)->first();
        }else {
            $day = DeliveryDay::where('status',1)->first();
        }
        if($day !== null){
            $day = $day->name;
        }
        $lists = Hotel::all();
        return view('customer.category.album',[
            'lists' => $lists,
            'title' => 'Hotels',
            'day' => $day,
        ]);
    }
}
