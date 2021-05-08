<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\District;
use App\Models\GetCash;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\OrderDetail;
use App\Models\Store;
use Illuminate\Http\Request;
use Validator;
use Session;

class DeliveriesController extends Controller
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

    public function deliveryList()
    {
        if(auth()->user()->role !== 'SuperAdmin' && auth()->user()->role !== 'DeliveryAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $delivery = Delivery::paginate(15);
        return view('admin.delivery.delivery-list',[
            'delivery' => $delivery,
            'deilvery_search' => '',
        ]);
    }

    public function searchResult(Request $request){
        $value = $request->deilvery_search;
        $delivery = Delivery::where('name', 'LIKE', '%' . $value . '%')->orWhere('id', 'LIKE', '%' . $value . '%')->paginate(15);
        return view('admin.delivery.delivery-list', [
            'delivery' => $delivery,
            'deilvery_search' => $value,
        ]);
    }

    public function deliveryAddForm()
    {
        if(auth()->user()->role !== 'SuperAdmin' && auth()->user()->role !== 'DeliveryAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $districts = District::where('status', 1)->get();
        return view('admin.delivery.delivery-add')->with('districts', $districts);
    }

    public function deliveryAdd(Request $request)
    {
        if(auth()->user()->role !== 'SuperAdmin' && auth()->user()->role !== 'DeliveryAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5000',
            'phone' => 'required|numeric|digits:10|unique:deliveries,phone',
            'password' => 'required|min:8',
            'door_no' => 'required',
            'village' => 'required',
            'district' => 'required',
            'pincode' => 'required',
            'vehicle_name' => 'required',
            'vehicle_number' => 'required',
            'license' => 'required|mimes:jpeg,png,jpg',
            'rc_book' => 'required|mimes:jpeg,png,jpg',
        ]);
        if ($validator->fails()) {
            Session::flash('error','validation failed');
            return back()->withInput($request->all())->withErrors($validator);
        }

        $delivery = Delivery::create([
            'image' => 'nill',
            'name' => $request->name,
            'phone' => $request->phone,
            'show_password' => $request->password,
            'password' => bcrypt($request->password),
            'door_no' => $request->door_no,
            'village' => $request->village,
            'district' => $request->district,
            'pincode' => $request->pincode,
            'license' => 'nill',
            'rc_book' => 'nill',
            'vehicle_name' => $request->vehicle_name,
            'vehicle_number' => $request->vehicle_number,
        ]);

        // image
        $imageFile = $request->file('image');
        $imageExt = $imageFile->getClientOriginalExtension();
        $imageDestinationPath = public_path('/images/delivery/profile/');
        $imageFilename = $delivery->id . '.' . $imageExt;
        $imageFile->move($imageDestinationPath, $imageFilename);
        $imageFilename = '/images/delivery/profile/' . $imageFilename;

        // license
        $licenseFile = $request->file('license');
        $licenseExt = $licenseFile->getClientOriginalExtension();
        $licenseDestinationPath = public_path('/images/delivery/license/');
        $licenseFilename = $delivery->id . '.' . $licenseExt;
        $licenseFile->move($licenseDestinationPath, $licenseFilename);
        $licenseFilename = '/images/delivery/license/' . $licenseFilename;

        // rc_book
        $rc_bookFile = $request->file('rc_book');
        $rc_bookExt = $rc_bookFile->getClientOriginalExtension();
        $rc_bookDestinationPath = public_path('/images/delivery/rc_book/');
        $rc_bookFilename = $delivery->id . '.' . $rc_bookExt;
        $rc_bookFile->move($rc_bookDestinationPath, $rc_bookFilename);
        $rc_bookFilename = '/images/delivery/rc_book/' . $rc_bookFilename;

        $update = Delivery::find($delivery->id);
        $update->image = $imageFilename;
        $update->license = $licenseFilename;
        $update->rc_book = $rc_bookFilename;
        $update->save();
        Session::flash('success','Delivery boy added');
        return redirect('/admin/delivery-boys');
    }

    public function deliveryDetail($id)
    {
        if(auth()->user()->role !== 'SuperAdmin' && auth()->user()->role !== 'DeliveryAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $delivery = Delivery::find($id);
        $districts = District::all();
        return view('admin.delivery.delivery-detail')->with('delivery', $delivery)->with('districts', $districts);
    }

    public function deliveryOrder($id){
        if(auth()->user()->role !== 'SuperAdmin' && auth()->user()->role !== 'DeliveryAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $delivery = Delivery::find($id);
        $orders = Order::where('delivery',$id)->get();
        foreach($orders as $key => $item){
            if($item->order_status == 3){
                $orders->forget($key);
            }else if($item->order_status == 4){
                $orders->forget($key);
            }
            $item->details = OrderDetail::where('order_id',$item->id)->get();
            $item->order_status = OrderStatus::find($item->order_status)->name;
        }
        return view('admin.delivery.delivery-orders',[
            'delivery' => $delivery,
            'orders' => $orders,
        ]);
    }

    public function deliveryUpdate(Request $request, $id)
    {
        if(auth()->user()->role !== 'SuperAdmin' && auth()->user()->role !== 'DeliveryAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $delivery = Delivery::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg|max:5000',
            'phone' => 'required|numeric|digits:10|unique:deliveries,phone,' . $delivery->id,
            'password' => 'required|min:8',
            'door_no' => 'required',
            'village' => 'required',
            'district' => 'required',
            'pincode' => 'required',
            'vehicle_name' => 'required',
            'vehicle_number' => 'required',
            'license' => 'mimes:jpeg,png,jpg',
            'rc_book' => 'mimes:jpeg,png,jpg',
        ]);
        if ($validator->fails()) {
            Session::flash('error','Validation error: Values not changed');
            return back()->withErrors($validator);
        }

        if ($request->hasFile('image')) {
            \File::delete(public_path($delivery->image));

            $imageFile = $request->file('image');
            $imageExt = $imageFile->getClientOriginalExtension();
            $imageDestinationPath = public_path('/images/delivery/profile/');
            $imageFilename = $delivery->id . '.' . $imageExt;
            $imageFile->move($imageDestinationPath, $imageFilename);
            $imageFilename = '/images/delivery/profile/' . $imageFilename;
        } else {
            $imageFilename = $delivery->image;
        }

        if ($request->hasFile('license')) {
            \File::delete(public_path($delivery->license));

            $licenseFile = $request->file('license');
            $licenseExt = $licenseFile->getClientOriginalExtension();
            $licenseDestinationPath = public_path('/images/delivery/license/');
            $licenseFilename = $delivery->id . '.' . $licenseExt;
            $licenseFile->move($licenseDestinationPath, $licenseFilename);
            $licenseFilename = '/images/delivery/license/' . $licenseFilename;
        } else {
            $licenseFilename = $delivery->license;
        }

        if ($request->hasFile('rc_book')) {
            \File::delete(public_path($delivery->rc_book));

            $rc_bookFile = $request->file('rc_book');
            $rc_bookExt = $rc_bookFile->getClientOriginalExtension();
            $rc_bookDestinationPath = public_path('/images/delivery/rc_book/');
            $rc_bookFilename = $delivery->id . '.' . $rc_bookExt;
            $rc_bookFile->move($rc_bookDestinationPath, $rc_bookFilename);
            $rc_bookFilename = '/images/delivery/rc_book/' . $rc_bookFilename;
        } else {
            $rc_bookFilename = $delivery->rc_book;
        }

        $delivery->image = $imageFilename;
        $delivery->name = $request->name;
        $delivery->phone = $request->phone;
        $delivery->show_password = $request->password;
        $delivery->password = bcrypt($request->password);
        $delivery->door_no = $request->door_no;
        $delivery->village = $request->village;
        $delivery->district = $request->district;
        $delivery->pincode = $request->pincode;
        $delivery->vehicle_name = $request->vehicle_name;
        $delivery->vehicle_number = $request->vehicle_number;
        $delivery->license = $licenseFilename;
        $delivery->rc_book = $rc_bookFilename;
        $delivery->save();
        Session::flash('success','Delivery boy updated');
        return redirect('/admin/delivery-boys');
    }

    public function deliveryDelete($id){
        if(auth()->user()->role !== 'SuperAdmin' && auth()->user()->role !== 'DeliveryAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $delivery = Delivery::find($id);
        \File::delete(public_path($delivery->image));
        \File::delete(public_path($delivery->license));
        \File::delete(public_path($delivery->rc_book));
        $delivery->delete();
        Session::flash('success','Delivery boy deleted');
        return redirect('/admin/delivery-boys');
    }

    public function getCashList(){
        $delivery_boys = Delivery::all();
        foreach($delivery_boys as $boy){
            $boy->order_total = Order::where('delivery',$boy->id)->where('get_cash',0)->where('order_status',3)->sum('total');
        }
        return view('admin.delivery.get-cash',[
            'delivery_boys' => $delivery_boys,
        ]);
    }

    public function getCash($id){
        $orders = Order::where('delivery',$id)->where('get_cash',0)->where('order_status',3)->get();
        $order_total = Order::where('delivery',$id)->where('get_cash',0)->where('order_status',3)->sum('total');
        $store = Store::find(1);
        $adstring = $store->door_no.', '.$store->village.', '.$store->district.', '.$store->state.' '.$store->pincode.', '.$store->country;
        $adstring = str_replace(" ", "+", $adstring);
        $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?key=".env('MAP_KEY')."&address=" . $adstring . "&sensor=false");
        $json = json_decode($json);

        $store_latitude = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
        $store_longitude = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
        $boy_latitude = Delivery::find($id)->latitude;
        $boy_longitude = Delivery::find($id)->longitude;
        if($boy_latitude == null && $boy_longitude == null){
            Session::flash('error', 'Runner\'s last Location not found!');
            return redirect()->back();
        }
        foreach($orders as $o){
            $o->get_cash = 1;
            $o->save();
        }
        $theta = $store_longitude - $boy_longitude;
        $dist = sin(deg2rad($store_latitude)) * sin(deg2rad($boy_latitude)) +  cos(deg2rad($store_latitude)) * cos(deg2rad($boy_latitude)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $distance = number_format((float)$miles * 1.609344,'2','.','');

        GetCash::create([
            'delivery_id' => $id,
            'distance' => $distance,
        ]);
        app('App\Http\Controllers\PushNotification')->send_notification_delivery($id, 'Got Cash', 'Completed oreder amount '.$order_total.' collected from you.',null,null);
        Session::flash('success', 'Got cash from runner');
        return redirect('admin/delivery-boys/get-cash/list');
    }

}
