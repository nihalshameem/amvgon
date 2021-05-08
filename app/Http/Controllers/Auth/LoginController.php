<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\api\customer;
use App\Models\DeliveryDay;
use App\Providers\RouteServiceProvider;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Redirect;
use Session;
use URL;
use Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:customer')->except('logout');
    }

    public function showCustomerLoginForm(Request $request)
    {
        if($request->exists('day')){
            $day = DeliveryDay::where('name',$request->day)->where('status',1)->first();
        }else {
            $day = DeliveryDay::where('status',1)->first();
        }
        if($day !== null){
            $day = $day->name;
        }
        return view('customer.login', ['url' => 'customer',
        'day' => $day,]);
    }

    public function showAdminLoginForm()
    {
        return view('admin.login', ['url' => 'admin']);
    }

    public function adminLogin(Request $request)
    {
        $validator = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/admin');
        }else{
            $validator['email'] = 'Email and password does not match';
            $validator['password'] = '';
        }
        return back()->withInput($request->only('email', 'remember'))->withErrors($validator);
    }

    public function customerLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|regex:/[0-9]{10}/|digits:10',
            'password' => 'required|min:8',
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Invalid Login details');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if (Auth::guard('customer')->attempt(['phone' => $request->phone, 'password' => $request->password])) {
            return redirect()->back();
        }
        Session::flash('error', 'phone and password mismatch');
        return redirect()->back()->withErrors($validator)->withInput();
    }

    public function customerRegister(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'nullable|email|unique:customers,email',
                'phone' => 'required|numeric|digits:10|unique:customers,phone',
                'password' => 'required|min:8',
                'confirm_password' => 'required|same:password',
            ]);

        if ($validator->fails()) {
            Session::flash('error', 'Something wrong');
            return Redirect::to(URL::previous() . "#reg")->withInput($request->all())->withErrors($validator);
        }
        $data = $request->all();
        return view('customer.verify' )->with('data', $data);

    }

    public function customerCreate(Request $request)
    {
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $email = $request->email;
        $phone = $request->phone;
        $password = bcrypt($request->password);

        $user = customer::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' => $phone,
            'password' => $password,
        ]);

        if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
            Session::flash('success', 'Your profile registered');
            return redirect('/');
        }
        Session::flash('success', 'Your profile registered');
        return redirect('/');
    }

    public function forgetPassword()
    {
        return view('customer.forget-password');
    }

    public function forgetPasswordVerify(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'phone' => 'required|numeric|digits:10',
                'new_password' => 'required|min:8',
                'confirm_password' => 'required|same:new_password',
            ]);
        if ($validator->fails()) {
            Session::flash('error', 'validation failed');
            return redirect()->back()->withErrors($validator);
        }
        $user = customer::where('phone', $request->phone)->first();
        if ($user == null) {
            Session::flash('error', 'Invalid user Phone number');
            return redirect()->back()->withErrors($validator);
        }
        $data = $request->all();

        return view('customer.forget-verify')->with('data', $data);
    }
    public function forgetPasswordSubmit(Request $request)
    {
        $user = customer::where('phone', $request->phone)->first();
        $user->password = bcrypt($request->password);
        $user->save();
        Session::flash('success', 'Password updated');
        return redirect('/');
    }
}
