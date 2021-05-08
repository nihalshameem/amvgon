<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FunctionModel;
use Validator;
use Session;

class FunctionsController extends Controller
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

    public function functionList()
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $functions = FunctionModel::paginate(15);
        return view('admin.function.function-list')->with('functions', $functions);
    }

    public function functionAdd(Request $request){
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5000',
        ]);
        if ($validator->fails()) {
            Session::flash('error','Validation failed');
            return back()->withInput($request->all())->withErrors($validator);
        }
        $function = FunctionModel::create([
            'name' => $request->name,
            'image' => 'nill',
        ]);
        

        // image
        $imageFile = $request->file('image');
        $imageExt = $imageFile->getClientOriginalExtension();
        $imageDestinationPath = public_path('images/functions/');
        $imageFilename = $function->id . '.' . $imageExt;
        $imageFile->move($imageDestinationPath, $imageFilename);
        $imageFilename = '/images/functions/' . $imageFilename;

        $update = FunctionModel::find($function->id);
        $update->image = $imageFilename;
        $update->save();
        Session::flash('success','Function added');
        return redirect('/admin/functions');
    }

    public function functionEdit($id){
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $function = FunctionModel::find($id);
        return view('admin.function.function-edit')->with('function',$function);
    }

    public function functionUpdate(Request $request,$id){
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg|max:5000',
        ]);
        if ($validator->fails()) {
            Session::flash('error','Validation error');
            return back()->withInput($request->all())->withErrors($validator);
        }
        $function = FunctionModel::find($id);
        if($request->hasFile('image')){
        \File::delete(public_path($function->image));
            $imageFile = $request->file('image');
        $imageExt = $imageFile->getClientOriginalExtension();
        $imageDestinationPath = public_path('/images/functions/');
        $imageFilename = $function->id . '.' . $imageExt;
        $imageFile->move($imageDestinationPath, $imageFilename);
        $imageFilename = '/images/functions/' . $imageFilename;
        }else{
            $imageFilename = $function->image;
        }

        $function->name = $request->name;
        $function->image = $imageFilename;
        $function->save();
        Session::flash('success','Function updated');
        return redirect('/admin/functions');
    }

    public function functionDelete($id){
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $function = FunctionModel::find($id);
        \File::delete(public_path($function->image));
        $function->delete();
        Session::flash('success','Function deleted');
        return redirect('/admin/functions');
    }

}
