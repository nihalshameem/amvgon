<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Validator;
use Session;

class ProductsController extends Controller
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

    public function productList()
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $products = Product::paginate(15);
        foreach($products as $p){
            if($p->unit == 'piece'){
                $p->stock = number_format($p->stock);
                $p->excellent_stock = number_format($p->excellent_stock);
                $p->standard_stock = number_format($p->standard_stock);
            }
        }
        return view('admin.products.product-list')->with('products', $products);
    }

    public function productAddForm()
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $product_type = ProductType::all();
        $category = Category::all();
        return view('admin.products.product-add')->with('product_type',$product_type)->with('category',$category);
    }

    public function productAdd(Request $request)
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3000',
            'active' => 'required',
            'category' => 'required',
            'description' => 'required|string',
            'cost' => 'required',
            'discount' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'excellent_stock' => 'required',
            'standard_stock' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('error','Validation failed');
            return back()->withInput($request->all())->withErrors($validator);

        }

        $products = Product::create([
            'name' => $request->name,
            'image' => 'nill',
            'active' => $request->active,
            'category' => $request->category,
            'description' => $request->description,
            'cost' => $request->cost,
            'discount' => $request->discount,
            'price' => $request->price,
            'type' => $request->type,
            'stock' => $request->stock,
            'excellent_stock' => $request->excellent_stock,
            'standard_stock' => $request->standard_stock,
            'min_qty' => $request->min_qty,
            'standard_min_qty' => $request->standard_min_qty,
            'excellent_min_qty' => $request->excellent_min_qty,
            'unit' => $request->unit,
            'standard_cost' => $request->standard_cost,
            'standard_discount' => $request->standard_discount,
            'standard_price' => $request->standard_price,
            'excellent_cost' => $request->excellent_cost,
            'excellent_discount' => $request->excellent_discount,
            'excellent_price' => $request->excellent_price,
        ]);

        
        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();

        $destinationPath = public_path('/images/products/');
        $filename = $products->id.'.'.$ext;

        $file->move($destinationPath, $filename);
        $filename = '/images/products/' . $filename;

        $image = Product::find($products->id);
        $image->image = $filename;
        $image->save();
        Session::flash('success','Product added');
        return redirect('/admin/products');
    }

    public function UpdatePrice(){
        $products = Product::all();
        return view('admin.products.all-edit',[
            'products' => $products
        ]);
    }

    public function SubmitAll(Request $request){
        $validated = request()->validate([
            'products.*.id' => ['required'],
            'products.*.price' => ['required', 'numeric', 'min:0'],
            'products.*.standard_price' => ['required', 'numeric', 'min:0'],
            'products.*.excellent_price' => ['required', 'numeric', 'min:0'],
            'products.*.discount' => ['required', 'numeric', 'min:0'],
            'products.*.standard_discount' => ['required', 'numeric', 'min:0'],
            'products.*.excellent_discount' => ['required', 'numeric', 'min:0'],
            'products.*.stock' => ['required', 'numeric', 'min:0'],
            'products.*.standard_stock' => ['required', 'numeric', 'min:0'],
            'products.*.excellent_stock' => ['required', 'numeric', 'min:0'],
        ]);
    
        $input = Collection::make($validated['products']);
    
        Product::query()->whereKey($input->pluck('id'))
            ->each(function (Product $product) use ($input) {
                $record = $input->firstWhere('id', $product->getKey()) ?? [];
    
                $product->price = $record['price'] ?? 0;
                $product->standard_price = $record['standard_price'] ?? 0;
                $product->excellent_price = $record['excellent_price'] ?? 0;
                $product->discount = $record['discount'] ?? 0;
                $product->standard_discount = $record['standard_discount'] ?? 0;
                $product->excellent_discount = $record['excellent_discount'] ?? 0;
                $product->stock = $record['stock'] ?? 0;
                $product->standard_stock = $record['standard_stock'] ?? 0;
                $product->excellent_stock = $record['excellent_stock'] ?? 0;
    
                $product->save();
            });
            Session::flash('success','All price updated!');
        return redirect('admin/products/update-price');
    }

    public function productEditForm($id)
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $product = Product::find($id);
        $product_type = ProductType::all();
        $category = Category::all();
        if($product->unit == 'piece'){
            $product->stock = number_format($product->stock);
            $product->excellent_stock = number_format($product->excellent_stock);
            $product->standard_stock = number_format($product->standard_stock);
        }
        return view('admin.products.product-edit')->with('product', $product)->with('product_type', $product_type)->with('category',$category);
    }

    public function productEdit(Request $request, $id)
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $product = Product::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'active' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3000',
            'category' => 'required',
            'description' => 'required|string',
            'cost' => 'required',
            'discount' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('error','Validation failed');
            return back()->withInput($request->all())->withErrors($validator);

        }

        if ($request->hasFile('image')) {
            \File::delete(public_path($product->image));
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();

            $destinationPath = public_path('/images/products/');
            $filename = $product->id.'.'.$ext;

            $file->move($destinationPath, $filename);
            $filename = '/images/products/' . $filename;
        } else {
            $filename = $product->image;
        }

        $product->name = $request->name;
        $product->image = $filename;
        $product->active = $request->active;
        $product->category = $request->category;
        $product->description = $request->description;
        $product->cost = $request->cost;
        $product->discount = $request->discount;
        $product->price = $request->price;
        $product->type = $request->type;
        $product->stock = $request->stock;
        $product->standard_stock = $request->standard_stock;
        $product->excellent_stock = $request->excellent_stock;
        $product->min_qty = $request->min_qty;
        $product->standard_min_qty = $request->standard_min_qty;
        $product->excellent_min_qty = $request->excellent_min_qty;
        $product->unit = $request->unit;
        $product->standard_cost = $request->standard_cost;
        $product->standard_discount = $request->standard_discount;
        $product->standard_price = $request->standard_price;
        $product->excellent_cost = $request->excellent_cost;
        $product->excellent_discount = $request->excellent_discount;
        $product->excellent_price = $request->excellent_price;
        $product->save();
        Session::flash('success','Product updated');
        return redirect('/admin/products');
    }

    public function productDelete($id)
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $product = Product::find($id);
        \File::delete(public_path($product->image));
        $product->delete();
        Session::flash('success','Product deleted');
        return redirect('/admin/products');
    }
}
