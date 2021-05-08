<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Validator;
use Session;

class CategoriesController extends Controller
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

    public function categoryList()
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $categories = Category::paginate(15);
        return view('admin.category.category-list')->with('categories', $categories);
    }

    public function categoryAdd(Request $request){
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $validator = Validator::make($request->all(), [
            'category' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5000',
        ]);
        if ($validator->fails()) {
            Session::flash('error','Validation failed');
            return back()->withInput($request->all())->withErrors($validator);
        }
        $category = Category::create([
            'name' => $request->category,
            'image' => 'nill',
        ]);
        

        // image
        $imageFile = $request->file('image');
        $imageExt = $imageFile->getClientOriginalExtension();
        $imageDestinationPath = public_path('images/category/');
        $imageFilename = $category->id . '.' . $imageExt;
        $imageFile->move($imageDestinationPath, $imageFilename);
        $imageFilename = '/images/category/' . $imageFilename;

        $update = Category::find($category->id);
        $update->image = $imageFilename;
        $update->save();
        Session::flash('success','Category added');
        return redirect('/admin/categories');
    }

    public function categoryEditForm($id){
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $category = Category::find($id);
        return view('admin.category.category-edit')->with('category',$category);
    }

    public function categoryUpdate(Request $request,$id){
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $validator = Validator::make($request->all(), [
            'category' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg|max:5000',
        ]);
        if ($validator->fails()) {
            Session::flash('error','Validation error');
            return back()->withInput($request->all())->withErrors($validator);
        }
        $category = Category::find($id);
        if($request->hasFile('image')){
        \File::delete(public_path($category->image));
            $imageFile = $request->file('image');
        $imageExt = $imageFile->getClientOriginalExtension();
        $imageDestinationPath = public_path('images/category/');
        $imageFilename = $category->id . '.' . $imageExt;
        $imageFile->move($imageDestinationPath, $imageFilename);
        $imageFilename = '/images/category/' . $imageFilename;
        }else{
            $imageFilename = $category->image;
        }

        $category->name = $request->category;
        $category->image = $imageFilename;
        $category->save();
        Session::flash('success','Category updated');
        return redirect('/admin/categories');
    }

    public function categoryDelete($id){
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        if($id == 3 || $id == 5){
            Session::flash('error','This cannot be deleted');
            return redirect()->back();
        }
        $category = Category::find($id);
        \File::delete(public_path($category->image));
        $category->delete();
        Session::flash('success','category deleted');
        return redirect('/admin/categories');
    }
}
