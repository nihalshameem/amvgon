<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AmountIncentive;
use App\Models\Bonus;
use App\Models\Delivery;
use App\Models\DeliveryCharge;
use App\Models\GetCash;
use App\Models\SalaryPaid;
use App\Models\DeliverySalary;
use App\Models\Order;
use App\Models\OrderIncentive;
use App\Models\WeeklyIncentive;
use Illuminate\Http\Request;
use Session;
use Validator;
use DatePeriod;
use DateTime;

class DeliverySalariesController extends Controller
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
    
    public function salaryList()
    {
        if(auth()->user()->role !== 'SuperAdmin' && auth()->user()->role !== 'DeliveryAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $weekly_incentive = WeeklyIncentive::find(1);
        $amount_incentive_percent = AmountIncentive::find(1)->percent;
        $order_incentive_amount = OrderIncentive::find(1)->price;
        $bonus = Bonus::find(1)->bonus;
        $delivery_boys = Delivery::all();
        $today = date('Y-m-d');
        foreach($delivery_boys as $boy){
            $last_payment = SalaryPaid::where('delivery_id',$boy->id)->orderBy('created_at','desc')->first();
            if($last_payment !== null){
            $last_payment = date('Y-m-d', strtotime(' +1 day', strtotime($last_payment->created_at)));
            }
            if($last_payment == null){
                $last_payment = DeliverySalary::where('delivery_id',$boy->id)->orderBy('created_at','asc')->first();
                if($last_payment !== null){
                    $last_payment = date('Y-m-d',strtotime($last_payment->created_at));
                }
            }
            if($last_payment !== null){
                $unpaidList = DeliverySalary::orderBy('created_at', 'desc')->whereDate('created_at','<=',$today)->whereDate('created_at','>=',$last_payment)->get();
                foreach ($unpaidList as $u) {
                    $u->date = date('Y-m-d',strtotime($u->created_at));
                }
                $unpaidList = $unpaidList->pluck('date');
                $startDate = \Carbon\Carbon::createFromFormat('Y-m-d', $last_payment);
                $endDate = \Carbon\Carbon::createFromFormat('Y-m-d', $today);
                $dateRange = \Carbon\CarbonPeriod::create($startDate, $endDate);
                $isavail = false;
                foreach($dateRange as $dr) { 
                    if($unpaidList->contains($dr->format('Y-m-d'))){
                        $isavail = true;
                    }else{
                        $isavail = false;
                        break;
                    }
                }
                if($isavail){
                    $boy->weekly_incentive = $weekly_incentive->price;
                }else{
                    $boy->weekly_incentive = 0;
                }
            }else{
                $boy->weekly_incentive = 0;
            }
        }
        foreach($delivery_boys as $boy){
            $boy->distance = DeliverySalary::where('delivery_id',$boy->id)->sum('distance');
            $get_cash = GetCash::where('delivery_id',$boy->id)->sum('distance');
            $boy->distance = $boy->distance + $get_cash;
            $boy->distance_amount = DeliverySalary::where('delivery_id',$boy->id)->sum('salary');
            $boy->distance_amount = $boy->distance_amount + ($get_cash * DeliveryCharge::find(1)->price);
            $boy->order_amount = DeliverySalary::where('delivery_id',$boy->id)->sum('order_total');
            $boy->amount_incentive_amount = number_format((float)($amount_incentive_percent/100)*$boy->order_amount, 2, '.', '');
            $boy->total_order = count(DeliverySalary::where('delivery_id',$boy->id)->get());
            if($boy->total_order > 350){
                $boy->boy_bonus = Bonus::find(1)->bonus;
            }else{
                $boy->boy_bonus = 0;
            }
            $boy->order_incentive = $boy->total_order * $order_incentive_amount;
            $boy->total = $boy->distance_amount + $boy->boy_bonus + $boy->weekly_incentive + $boy->amount_incentive_amount +  $boy->order_incentive;
        }
        $default = DeliveryCharge::find(1);
        return view('admin.delivery-salary.salary-list', [
            'default' => $default,
            'weekly_incentive' => $weekly_incentive,
            'order_incentive_amount' => $order_incentive_amount,
            'delivery_boys' => $delivery_boys,
            'bonus' => $bonus,
            'amount_incentive_percent' => $amount_incentive_percent,
        ]);
    }

    public function orderIncentiveUpdate(Request $request){
        if(auth()->user()->role !== 'SuperAdmin' && auth()->user()->role !== 'DeliveryAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $validator = Validator::make($request->all(), [
            'oiprice' => 'required|numeric',
        ]);
        $order_incentive = OrderIncentive::find(1);
        $order_incentive->price = $request->oiprice;
        $order_incentive->save();
        Session::flash('success', 'Order-Incentive updated');
        return redirect('admin/delivery-salaries');
    }

    public function salaryEdit($id)
    {
        if(auth()->user()->role !== 'SuperAdmin' && auth()->user()->role !== 'DeliveryAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $charge = DeliverySalary::find($id);
        $delivery = Delivery::all();
        $orders = Order::all();
        return view('admin.delivery-salary.salary-edit', [
            'charge' => $charge,
            'delivery' => $delivery,
            'orders' => $orders,
        ]);
    }

    public function salaryUpdate(Request $request, $id)
    {
        if(auth()->user()->role !== 'SuperAdmin' && auth()->user()->role !== 'DeliveryAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'delivery_id' => 'required',
            'distance' => 'required|numeric',
            'salary' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            Session::flash('error', 'Validation failed');
            return back()->withErrors($validator);
        }
        $charge = DeliverySalary::find($id);
        $charge->delivery_id = $request->delivery_id;
        $charge->order_id = $request->order_id;
        $charge->distance = $request->distance;
        $charge->salary = $request->salary;
        $charge->save();
        Session::flash('success', 'Runner-Salary updated');
        return redirect('admin/delivery-salaries');
    }

    public function weeklyIncentiveUpdate(Request $request)
    {
        if(auth()->user()->role !== 'SuperAdmin' && auth()->user()->role !== 'DeliveryAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $validator = Validator::make($request->all(), [
            'incentive_price' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            Session::flash('error', 'Validation failed');
            return back()->withErrors($validator);
        }
        $weekly_incentive_update = WeeklyIncentive::find(1);
        $weekly_incentive_update->price = $request->incentive_price;
        $weekly_incentive_update->save();
        Session::flash('success', 'Weekly-Incentive updated');
        return redirect('admin/delivery-salaries');
    }

    public function chargeUpdate(Request $request)
    {
        if(auth()->user()->role !== 'SuperAdmin' && auth()->user()->role !== 'DeliveryAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $validator = Validator::make($request->all(), [
            'distance' => 'required|numeric',
            'price' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            Session::flash('error', 'Validation failed');
            return back()->withErrors($validator);
        }
        $default = DeliveryCharge::find(1);
        $default->price = $request->price;
        $default->distance = $request->distance;
        $default->save();
        Session::flash('success', 'Default-Charges updated');
        return redirect('admin/delivery-salaries');
    }

    public function salaryDelete($id)
    {
        if(auth()->user()->role !== 'SuperAdmin' && auth()->user()->role !== 'DeliveryAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        DeliverySalary::find($id)->delete();
        Session::flash('success', 'Runner-Salary deleted');
        return redirect('admin/delivery-salaries');
    }

    public function paidSalary(){
        if(auth()->user()->role !== 'SuperAdmin' && auth()->user()->role !== 'DeliveryAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $paid_salaries = SalaryPaid::paginate(15);
        return view('admin.delivery-salary.salary-paid',[
            'paid_salaries' => $paid_salaries,
            'paid_search' => '',
        ]);
    }

    public function paidSearch(Request $request){
        $value = $request->paid_search;
        $paid_salaries = SalaryPaid::where('delivery_id', 'LIKE', '%' . $value . '%')->orderBy('created_at','desc')->paginate(15);
        return view('admin.delivery-salary.salary-paid', [
            'paid_salaries' => $paid_salaries,
            'paid_search' => $value,
        ]);
    }

    public function bonus(Request $request){
        if(auth()->user()->role !== 'SuperAdmin' && auth()->user()->role !== 'DeliveryAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $validator = Validator::make($request->all(), [
            'bonus' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            Session::flash('error', 'Validation failed');
            return back()->withErrors($validator);
        }
        $bonus = Bonus::find(1);
        $bonus->bonus = $request->bonus;
        $bonus->save();
        Session::flash('success', 'Bonus updated');
        return redirect('admin/delivery-salaries');
    }

    public function amountIncentive(Request $request){
        if(auth()->user()->role !== 'SuperAdmin' && auth()->user()->role !== 'DeliveryAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $validator = Validator::make($request->all(), [
            'incentive_percent' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            Session::flash('error', 'Validation failed');
            return back()->withErrors($validator);
        }
        $ai = AmountIncentive::find(1);
        $ai->percent = $request->incentive_percent;
        $ai->save();
        Session::flash('success', 'Amount Incentive Updated');
        return redirect('admin/delivery-salaries');
    }

    public function detailList($id)
    {
        if(auth()->user()->role !== 'SuperAdmin' && auth()->user()->role !== 'DeliveryAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $details = DeliverySalary::where('delivery_id',$id)->orderBy('created_at', 'desc')->get();
        return view('admin.delivery-salary.detail-list', [
            'details' => $details,
        ]);
    }

    public function salaryPay($id)
    {
        if(auth()->user()->role !== 'SuperAdmin' && auth()->user()->role !== 'DeliveryAdmin'){
            Session::flash('error','Access denied');
            return back();
        }
        $delivery_boy = Delivery::find($id);
        $amount_incentive = AmountIncentive::find(1)->percent;
        $weekly_incentive = WeeklyIncentive::find(1)->price;
        $order_count = DeliverySalary::where('delivery_id',$id)->count('order_id');
        if($order_count > 350){
            $bonus = Bonus::find(1)->bonus;
        }else{
            $bonus = 0;
        }
        $today = date('Y-m-d');
        $last_payment = SalaryPaid::where('delivery_id',$delivery_boy->id)->orderBy('created_at','desc')->first();
        if($last_payment !== null){
        $last_payment = date('Y-m-d', strtotime(' +1 day', strtotime($last_payment->created_at)));
        }
        if($last_payment == null){
            $last_payment = DeliverySalary::where('delivery_id',$delivery_boy->id)->orderBy('created_at','asc')->first();
            if($last_payment !== null){
                $last_payment = date('Y-m-d',strtotime($last_payment->created_at));
            }
        }
        if($last_payment !== null){
            $unpaidList = DeliverySalary::orderBy('created_at', 'desc')->whereDate('created_at','<=',$today)->whereDate('created_at','>=',$last_payment)->get();
            foreach ($unpaidList as $u) {
                $u->date = date('Y-m-d',strtotime($u->created_at));
            }
            $unpaidList = $unpaidList->pluck('date');
            $startDate = \Carbon\Carbon::createFromFormat('Y-m-d', $last_payment);
            $endDate = \Carbon\Carbon::createFromFormat('Y-m-d', $today);
            $dateRange = \Carbon\CarbonPeriod::create($startDate, $endDate);
            $isavail = false;
            foreach($dateRange as $dr) { 
                if($unpaidList->contains($dr->format('Y-m-d'))){
                    $isavail = true;
                }else{
                    $isavail = false;
                    break;
                }
            }
            if($isavail){
                $delivery_boy->weekly_incentive = $weekly_incentive;
            }else{
                $delivery_boy->weekly_incentive = 0;
            }
        }else{
            $delivery_boy->weekly_incentive = 0;
        }
        $start_date = Deliverysalary::orderBy('created_at','asc')->first()->created_at->format('Y-m-d');
        $distance = DeliverySalary::where('delivery_id',$id)->sum('distance');
        $get_cash = GetCash::where('delivery_id',$id)->sum('distance');
        $distance = $distance + $get_cash;
        $delivery_charge = DeliverySalary::where('delivery_id',$id)->sum('salary');
        $delivery_charge = $delivery_charge + ($get_cash * DeliveryCharge::find(1)->price);
        $order_total = DeliverySalary::where('delivery_id',$id)->sum('order_total');
        $amount_incentive_amount = number_format((float)($amount_incentive/100) * $order_total, 2, '.', '');
        $order_incentive = OrderIncentive::find(1)->price * $order_count;
        $total_amount = $delivery_charge + $bonus + $amount_incentive_amount + $delivery_boy->weekly_incentive + $order_incentive;
        
        $delivery_salaries = DeliverySalary::where('delivery_id',$id)->get();
        foreach($delivery_salaries as $c){
            $c->delete();
        }
        
        $cashList = GetCash::where('delivery_id',$id)->get();
        foreach($cashList as $cl){
            $cl->delete();
        }

        $salary_paid = SalaryPaid::create([
            'delivery_id' => $id,
            'order_count' => $order_count,
            'distance' => $distance,
            'delivery_charge' => $delivery_charge,
            'weekly_incentive' => $delivery_boy->weekly_incentive,
            'amount_incentive' => $amount_incentive_amount,
            'order_incentive' => $order_incentive,
            'bonus' => $bonus,
            'total_amount' => $total_amount,
            'start_date' => $start_date,
        ]);
        Session::flash('success','Paid to runner');
        return redirect('admin/delivery-salaries');
    }
}
