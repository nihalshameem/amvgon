<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\api\customer;
use App\Models\Feedback;
use Auth;
use Validator;
use Session;

class FeedbackController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function feedbackForm(){
        return view('customer.feedback.feedback-form');
    }

    public function feedbackAdd(Request $request){
        $user = auth()->user();
        $validator = Validator::make($request->all(),[
            'message' => 'required',
        ]);
        if($validator->fails()){
            Session::flash('error','Message field is empty');
            return redirect()->back();
        }
        Feedback::create([
            'name' => $user->first_name.' '.$user->last_name,
            'email' => $user->email,
            'phone' => $user->phone,
            'message' => $request->message,
        ]);
        Session::flash('success','Feedback sent');
            return redirect('/');
    }
}
