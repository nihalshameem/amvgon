<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ComboDetail;
use App\Models\ComboProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Session;
use Validator;

class CombosController extends Controller
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

    public function comboList()
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $combos = ComboProduct::orderBy('expiry_date', 'desc')->paginate(15);
        return view('admin.combos.combo-list', ['combos' => $combos]);
    }

    public function comboAdd()
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $products = Product::all();
        return view('admin.combos.combo-add', ['products' => $products]);
    }

    public function comboAddSubmit(Request $request)
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'discount' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:3000',
            'product_count' => 'required',
            'expiry_date' => 'required',
            'product_id0' => 'required',
            'type0' => 'required',
            'product_id1' => 'required',
            'type1' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('error', 'Validation failed');
            return back()->withInput($request->all())->withErrors($validator);
        }
        $combo = ComboProduct::create([
            'name' => $request->name,
            'discount' => $request->discount,
            'product_count' => $request->product_count,
            'expiry_date' => $request->expiry_date,
        ]);
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $destinationPath = public_path('images/combos');
            $filename = $combo->id.'.'.$ext;
            $file->move($destinationPath, $filename);
            $filename = '/images/combos/' . $filename;
            $combo->image = $filename;
            $combo->save();
        }
        for ($x = 0; $x < $request->product_count; $x++) {
            ComboDetail::create([
                'combo_id' => $combo->id,
                'product_id' => request('product_id' . $x),
                'type' => request('type' . $x),
            ]);
        }
        Session::flash('success', 'New combo added');
        return redirect('admin/combo-offers');
    }

    public function comboEdit($id)
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $combo = ComboProduct::find($id);
        $products = Product::all();
        $details = ComboDetail::where('combo_id', $id)->get();
        $x = 0;
        $product_id = [];
        $type = [];
        $detail_id = [];
        foreach ($details as $d) {
            $detail_id[$x] = $d->id;
            $product_id[$x] = $d->product_id;
            $type[$x] = $d->type;
            $x++;
        }
        if ($combo->product_count < 3) {
            $detail_id[2] = '';
            $product_id[2] = '';
            $type[2] = '';
        }
        $combo->detail_id = $detail_id;
        $combo->product_id = $product_id;
        $combo->type = $type;
        return view('admin.combos.combo-edit', [
            'combo' => $combo,
            'products' => $products,
        ]);
    }

    public function comboUpdate(Request $request, $id)
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'discount' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:3000',
            'product_count' => 'required',
            'expiry_date' => 'required',
            'product_id0' => 'required',
            'type0' => 'required',
            'product_id1' => 'required',
            'type1' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('error', 'Validation failed');
            return back()->withErrors($validator);
        }
        $combo = ComboProduct::find($id);
        if($request->product_count < $combo->product_count){
            ComboDetail::find($request->detail2)->delete();
        }
        $combo->name = $request->name;
        $combo->discount = $request->discount;
        $combo->product_count = $request->product_count;
        $combo->expiry_date = $request->expiry_date;
        if ($request->hasFile('image')){
            if($combo->image !== null){
                \File::delete(public_path($combo->image));
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $destinationPath = public_path('images/combos');
            $filename = $combo->id.'.'.$ext;
            $file->move($destinationPath, $filename);
            $filename = '/images/combos/' . $filename;
            $combo->image = $filename;
        }
        $combo->save();
        $details = ComboDetail::where('combo_id', $id)->get();
        for ($x = 0; $x < $request->product_count; $x++) {
            if(ComboDetail::find(request('detail' . $x)))
            {
                $d = ComboDetail::find(request('detail' . $x));
                $d->product_id = request('product_id' . $x);
                $d->type = request('type' . $x);
                $d->save();
            }else {
                ComboDetail::create([
                    'combo_id' => $combo->id,
                    'product_id' => request('product_id' . $x),
                    'type' => request('type' . $x)
                ]);
            }
        }
        Session::flash('success', 'Combo updated');
        return redirect('admin/combo-offers');
    }

    public function comboDelete($id)
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $combo = ComboProduct::find($id)->delete();
        $details = ComboDetail::where('combo_id', $id)->delete();
        Session::flash('success', 'Combo deleted');
        return redirect('admin/combo-offers');
    }
}
