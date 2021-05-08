<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Validator;
use Session;

class FeedbacksController extends Controller
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

    public function feedbackList()
    {
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $feedbacks = Feedback::paginate(15);
        return view('admin.feedback.feedback-list')->with('feedbacks', $feedbacks);
    }

    public function feedbackDetail($id){
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $feedback = Feedback::find($id);
        return view('admin.feedback.feedback-detail')->with('feedback',$feedback);
    }

    public function feedbackDelete($id){
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        Feedback::find($id)->delete();
        Session::flash('success','Feedback deleted');
        return redirect('/admin/feedback');
    }
}
