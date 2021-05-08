<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\api\customer;
use App\Models\Category;
use App\Models\Delivery;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\PaymentStatus;
use App\Models\Product;
use App\Models\DeliveryDay;
use App\Models\ShippingCharge;
use App\Models\Store;
use Illuminate\Http\Request;
use Session;
use Validator;

class Admincontroller extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $admin = auth()->user();
        $customers = count(customer::all());
        $delivery = count(Delivery::all());
        $year = now()->year;
        $current_month = now()->month;
        $order_count = Order::count();
        $order_sum = Order::sum('total');
        $delivers = $sales = [];
        $d_count;
        $today_status = DeliveryDay::find(1);
        $tomorrow_status = DeliveryDay::find(2);
        for ($i = 1; $i <= $current_month; $i++) {
            $d_count = Order::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $i)->where('order_status', 3)->count();
            if($d_count !== 0){
                $delivers[$i] = $d_count / $order_count * 100;
            }else{
                $delivers[$i] = 0;
            }
            $s_count = Order::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $i)->where('order_status', 3)->sum('total');
            if($s_count !== 0){
                $sales[$i] = $s_count / $order_sum * 100;
            }else{
                $sales[$i] = 0;
            }
        }
        $income = Order::where('order_status', 3)->sum('total');
        $pending = Order::where('order_status', 1)->orWhere('order_status', 2)->orWhere('order_status', 5)->sum('total');
        $total = $income + $pending;
        $gplay = new \Nelexa\GPlay\GPlayApps($defaultLocale = 'en_US', $defaultCountry = 'us');
        $appInfo = $gplay->getAppInfo('com.smsprogramerz.amvgon');
        $download_count = $appInfo->getInstalls();
        return view('admin.home', [
            'admin' => $admin,
            'customers' => $customers,
            'delivery' => $delivery,
            'income' => $income,
            'pending' => $pending,
            'total' => $total,
            'delivers' => $delivers,
            'sales' => $sales,
            'download_count' => $download_count,
            'today_status' => $today_status,
            'tomorrow_status' => $tomorrow_status,
            'shipping_charge' => ShippingCharge::find(1)->shipping_charge,
        ]);
    }

    public function shippingCharge(Request $request){
        $shipping = ShippingCharge::find(1);
        $shipping->shipping_charge = $request->shipping_charge;
        $shipping->save();
        Session::flash('success','Shipping charge updated');
        return redirect('/admin');
    }
    public function pushNotification(){
        return view('admin.layouts.notification');
    }
    public function read(Request $request)
    {
        $notificationId = $request->id;

        $userUnreadNotification = auth()->user()
            ->unreadNotifications
            ->where('id', $notificationId)
            ->first();

        if ($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
        }
        return response()->json(['success' => 1]);
    }
    public function allRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json(['success' => 1]);
    }
    public function searchResult(Request $request)
    {
        $name = $request->value;
        $products = Product::where('name', 'LIKE', '%' . $name . '%')->get();
        $categories = Category::where('name', 'LIKE', '%' . $name . '%')->get();
        $districts = District::where('name', 'LIKE', '%' . $name . '%')->get();
        $delivery_boys = Delivery::where('name', 'LIKE', '%' . $name . '%')->get();
        $customers = customer::where('first_name', 'LIKE', '%' . $name . '%')->orWhere('last_name', 'LIKE', '%' . $name . '%')->get();
        return view('admin.layouts.search', [
            'products' => $products,
            'categories' => $categories,
            'customers' => $customers,
            'districts' => $districts,
            'delivery_boys' => $delivery_boys,
        ]);
    }

    public function storeInfo(){
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $store = Store::find(1);
        return view('admin.store.store-info')->with('store',$store);
    }

    public function storeUpdate(Request $request){
        if(auth()->user()->role !== 'SuperAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $store = Store::find(1);
        $validator = Validator::make($request->all(), [
            'name'   => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3000',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'door_no' => 'required|string',
            'village' => 'required|string',
            'district' => 'required|string',
            'pincode' => 'required|max:20',
            'state' => 'required|string',
            'country' => 'required|string',
        ]);
        if ($validator->fails()) {  
            Session::flash('error','Fill required fields');
            return back()->withErrors($validator);

         }  

         if ($request->hasFile('image')) {
        \File::delete(public_path($store->image));
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();

            $destinationPath = public_path('/images/logo/');
            $filename = $store->id.'.'.$ext;

            $file->move($destinationPath, $filename);
            $filename = '/images/logo/'.$filename;
        }else{
            $filename = $store->image;
        }

        

        $store->name = $request->name;
        $store->image = $filename;
        $store->email = $request->email;
        $store->phone = $request->phone;
        $store->door_no = $request->door_no;
        $store->village = $request->village;
        $store->district = $request->district;
        $store->pincode = $request->pincode;
        $store->state = $request->state;
        $store->country = $request->country;
        $store->delivery = $request->delivery;
        $store->save();

        Session::flash('success','Store Updated');
        return redirect('/admin');
    }

    public function profileForm(){
        $admin = Admin::find(auth()->user()->id);
        return view('admin.profile.profile')->with('admin',$admin);
    }

    public function profileUpdate(Request $request){
        $admin = Admin::find(auth()->user()->id);

        $validator = Validator::make($request->all(), [
            'name'   => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3000',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'password' => 'nullable|min:4|max:8',
        ]);
        if ($validator->fails()) {  
            Session::flash('error','Validation failed');
            return back()->withErrors($validator);

         }  

         if ($request->hasFile('image')) {
        \File::delete(public_path($admin->image));
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();

            $destinationPath = public_path('/images/profile/');
            $filename = $admin->id.'.'.$ext;

            $file->move($destinationPath, $filename);
            $filename = '/images/profile/'.$filename;
        }else{
            $filename = $admin->image;
        }

        

        $admin->name = $request->name;
        $admin->image = $filename;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        if(!empty($request->input('password'))){
            $admin->password = bcrypt($request->password);
        }
        
        $admin->save();
        Session::flash('success','Profile updated');
        return redirect('/admin');
    }

    public function auto(Request $request)
    {
        $store = Store::find(1);
        $store->delivery = $request->value;
        $store->save();
        return response()->json(['success' => 1]);
    }

    public function autoOrderRequest(){
        $orders = Order::where('delivery', null)->where('delivery_date',date('Y-m-d'))->where('order_status','!=',3)->where('order_status','!=',4)->get();
        foreach($orders as $order){
            $delivery_boys = Delivery::where('status',1)->get();
            $closest = null;
            $search = $order->pincode;
            foreach ($delivery_boys as $bkey => $boy) {
                $delivery_orders = Order::where('delivery',$boy->id)->get();
                foreach($delivery_orders as $key => $do){
                    if($do->order_status == 3){
                        $delivery_orders->forget($key);
                    }else if($do->order_status == 4){
                        $delivery_orders->forget($key);
                    }
                }
                if(count($delivery_orders) >= 7){
                    continue;
                }
                if ($closest === null || abs($search - $closest) > abs($boy->pincode - $search)) {
                    $closest = $boy->id;
                }
            }
            if($closest !== null){
                $set_delivery_boy = Order::find($order->id);
                if($set_delivery_boy->delivery_date == date('Y-m-d')){
                    $set_delivery_boy->delivery = $closest;
                    $set_delivery_boy->save();
                    app('App\Http\Controllers\PushNotification')->send_notification_delivery($closest, 'New Order', 'Your new order',$order->id,null);
                }
            }
        }
        return response()->json(['success' => 1]);
    }

    public function purchaseList(){
        $today_normal = [];
        $today_standard = [];
        $today_excellent = [];
        $tomorrow_normal = [];
        $tomorrow_standard = [];
        $tomorrow_excellent = [];
        $today_normal_products = Product::all();
        $today_standard_products =  Product::all();
        $today_excellent_products =  Product::all();
        $tomorrow_normal_products = Product::all();
        $tomorrow_standard_products =  Product::all();
        $tomorrow_excellent_products =  Product::all();
        $products = Product::all();
        $todays = Order::where('order_status','!=',3)->where('order_status','!=',4)->where('delivery_date',\Carbon\Carbon::now()->format('Y-m-d'))->get();
        $tomorrows = Order::where('order_status','!=',3)->where('order_status','!=',4)->where('delivery_date',\Carbon\Carbon::tomorrow()->format('Y-m-d'))->get();
        foreach($todays as $key => $today){
            $details = OrderDetail::where('order_id',$today->id)->get();
            foreach($details as $detail){
                if($detail->price_type == 'normal'){
                    $today_normal[] = $detail;
                }elseif($detail->price_type == 'standard'){
                    $today_standard[] = $detail;
                }else{
                    $today_excellent[] = $detail;
                }
            }
        }
        foreach($tomorrows as $tomorrow){
            $tdetails = OrderDetail::where('order_id',$tomorrow->id)->get();
            foreach($tdetails as $tdetail){
                if($tdetail->price_type == 'normal'){
                    $tomorrow_normal[] = $tdetail;
                }elseif($tdetail->price_type == 'standard'){
                    $tomorrow_standard[] = $tdetail;
                }else{
                    $tomorrow_excellent[] = $tdetail;
                }
            }
        }
        foreach($today_normal_products as $tnp){
            $tnp->total_qty = 0;
            foreach($today_normal as $tn){
                $tnp->price_type = $tn->price_type;
                if($tn->product_id == $tnp->id){
                    $tnp->total_qty += $tn->qty;
                }
            }
        }
        foreach($today_standard_products as $tsp){
            $tsp->total_qty = 0;
            foreach($today_standard as $ts){
                $tsp->price_type = $ts->price_type;
                if($ts->product_id == $tsp->id){
                    $tsp->total_qty += $ts->qty;
                }
            }
        }
        foreach($today_excellent_products as $tep){
            $tep->total_qty = 0;
            foreach($today_excellent as $te){
                $tep->price_type = $te->price_type;
                if($te->product_id == $tep->id){
                    $tep->total_qty += $te->qty;
                }
            }
        }
        foreach($tomorrow_normal_products as $ttnp){
            $ttnp->total_qty = 0;
            foreach($tomorrow_normal as $ttn){
                $ttnp->price_type = $ttn->price_type;
                if($ttn->product_id == $ttnp->id){
                    $ttnp->total_qty += $ttn->qty;
                }
            }
        }
        foreach($tomorrow_standard_products as $ttsp){
            $ttsp->total_qty = 0;
            foreach($tomorrow_standard as $tts){
                $ttsp->price_type = $tts->price_type;
                if($tts->product_id == $ttsp->id){
                    $ttsp->total_qty += $tts->qty;
                }
            }
        }
        foreach($tomorrow_excellent_products as $ttep){
            $ttep->total_qty = 0;
            foreach($tomorrow_excellent as $tte){
                $ttep->price_type = $tte->price_type;
                if($tte->product_id == $ttep->id){
                    $ttep->total_qty += $tte->qty;
                }
            }
        }
        return view('admin.orders.purchase',[
            'today_normal' => $today_normal,
            'today_normal_products' => $today_normal_products,
            'today_standard_products' => $today_standard_products,
            'today_excellent_products' => $today_excellent_products,
            'tomorrow_normal_products' => $tomorrow_normal_products,
            'tomorrow_standard_products' => $tomorrow_standard_products,
            'tomorrow_excellent_products' => $tomorrow_excellent_products,
            'today_standard' => $today_standard,
            'today_excellent' => $today_excellent,
            'tomorrow_normal' => $tomorrow_normal,
            'tomorrow_standard' => $tomorrow_standard,
            'tomorrow_excellent' => $tomorrow_excellent,
            'products' => $products,
        ]);
    }

    public function invoice(Request $request){
        $order = Order::find($request->order_id);
        $order->customer_name = customer::find($order->customer_id)->first_name;
        $order->district = District::find($order->district)->name;
        $order_details = [];
        $detailId = $request->detailId;
        for ($i=0; $i <  count((array)$detailId); $i++) { 
            $order_details[$i] = OrderDetail::find($request->detailId[$i]);
        }
        return view('invoice',[
            'order' => $order,
            'order_details' => $order_details,
            'total_price' => $request->total_price,
            'total_qty' => $request->total_qty,
        ]);
    }

    public function purchaseBill($date){
        $normal = [];
        $standard = [];
        $excellent = [];
        $normal_products = Product::all();
        $standard_products =  Product::all();
        $excellent_products =  Product::all();
        $products = Product::all();
        if($date == 'today'){
            $todays = Order::where('order_status','!=',3)->where('order_status','!=',4)->where('delivery_date','=',date('Y-m-d'))->get();
        }else{
            $todays = Order::where('order_status','!=',3)->where('order_status','!=',4)->where('delivery_date','=',date('Y-m-d',strtotime('tomorrow')))->get();
        }
        foreach($todays as $today){
            $details = OrderDetail::where('order_id',$today->id)->get();
            foreach($details as $detail){
                if($detail->price_type == 'normal'){
                    $normal[] = $detail;
                }elseif($detail->price_type == 'standard'){
                    $standard[] = $detail;
                }else{
                    $excellent[] = $detail;
                }
            }
        }
        foreach($normal_products as $tnp){
            $tnp->total_qty = 0;
            foreach($normal as $tn){
                $tnp->price_type = $tn->price_type;
                if($tn->product_id == $tnp->id){
                    $tnp->total_qty += $tn->qty;
                }
            }
        }
        foreach($standard_products as $tsp){
            $tsp->total_qty = 0;
            foreach($standard as $ts){
                $tsp->price_type = $ts->price_type;
                if($ts->product_id == $tsp->id){
                    $tsp->total_qty += $ts->qty;
                }
            }
        }
        foreach($excellent_products as $tep){
            $tep->total_qty = 0;
            foreach($excellent as $te){
                $tep->price_type = $te->price_type;
                if($te->product_id == $tep->id){
                    $tep->total_qty += $te->qty;
                }
            }
        }
        $full_total = $normal_products->sum('total_qty') + $standard_products->sum('total_qty') + $excellent_products->sum('total_qty');
        return view('purchase',[
            'normal' => $normal,
            'normal_products' => $normal_products,
            'standard_products' => $standard_products,
            'excellent_products' => $excellent_products,
            'standard' => $standard,
            'excellent' => $excellent,
            'products' => $products,
            'date' => $date,
            'full_total' => $full_total,
        ]);
    }

    public function invoiceAll($id){
        $orders = Order::where('delivery',$id)->where('order_status','!=',3)->where('order_status','!=',4)->get();
        foreach($orders as $o){
            $customer = customer::find($o->customer_id);
            if ($customer !== null) {
                $o->customer_name = $customer->first_name;
            } else {
                $o->customer_name = null;
            }
            
            $o->details = OrderDetail::where('order_id',$o->id)->get();
            foreach($o->details as $d){
                $d->qty = number_format((float)$d->qty, 2, '.', '');
            }
            $o->qty = number_format((float)$o->qty, 2, '.', '');
        }
        return view('invoice-all',[
            'orders' => $orders,
        ]);
    }

    public function printOrder(Request $request){
        $orders = [];
        $orderId = $request->orderId;
        for ($i=0; $i <  count((array)$orderId); $i++) { 
            $orders[$i] = Order::find($request->orderId[$i]);
        }
        foreach($orders as $o){
            $customer = customer::find($o->customer_id);
            if ($customer !== null) {
                $o->customer_name = $customer->first_name;
            } else {
                $o->customer_name = null;
            }
            
            $o->details = OrderDetail::where('order_id',$o->id)->get();
            foreach($o->details as $d){
                $d->qty = number_format((float)$d->qty, 2, '.', '');
            }
            $o->qty = number_format((float)$o->qty, 2, '.', '');
        }
        return view('print-order',[
            'orders' => $orders,
        ]);
    }
}
