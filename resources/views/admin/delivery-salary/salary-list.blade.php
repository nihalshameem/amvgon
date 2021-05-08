@extends('admin.layouts.master')

@section('title')
    Runner Salary List
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap">
          <div class="d-flex align-items-end flex-wrap">
            <div class="mr-md-3 mr-xl-5">
              <h2>Runner Salary</h2>
            </div>
            <div class="d-flex">
              <i class="mdi mdi-home text-muted hover-cursor"></i>
              <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a  href="/admin/delivery-salaries">runner-salary list</a></p>
            </div>
          </div>
          <div class="d-flex justify-content-between align-items-end flex-wrap">
            <a class="btn btn-dark mr-3 mt-2 mt-xl-0" href="/admin/paid-salary">Paid List</a>
          </div>
        </div>
        <form class="form-inline" method="POST" action="/admin/delivery-charge/update">
            @csrf
              <b class="form-control-sm"  for="">Runner Charge:</b>
            <label class="form-control-sm"  for="price">Price(₹)</label>
            <input type="number" class="form-control form-control-sm mb-2 mr-sm-2" id="price" name="price" value="{{$default->price}}">
          
            <label class="form-control-sm"  for="distance">Distance(km)</label>
            <input type="number" class="form-control form-control-sm mb-2 mr-sm-2" id="distance" name="distance" value="{{$default->distance}}" step="any">
            <button type="submit" class="btn btn-sm btn-primary mb-2">Update</button>
          </form>
          <form class="form-inline" method="POST" action="/admin/delivery-boy/bonus">
              @csrf
              <b class="form-control-sm"  for="">Bonus:</b>
            
              <label class="form-control-sm"  for="amount">Amount(₹)</label>
              <input type="number" class="form-control form-control-sm mb-2 mr-sm-2" id="amount" name="bonus" value="{{$bonus}}" step="any" min="0">
              <button type="submit" class="btn btn-sm btn-success mb-2">Submit</button>
            </form>
            <form class="form-inline" method="POST" action="/admin/weekly-incentive/update">
                @csrf
                  <b class="form-control-sm"  for="">Weekly Incentive:</b>
                <label class="form-control-sm"  for="price">Price(₹)</label>
                <input type="number" class="form-control form-control-sm mb-2 mr-sm-2" id="price" name="incentive_price" value="{{$weekly_incentive->price}}">
                <button type="submit" class="btn btn-sm btn-primary mb-2">Update</button>
              </form>
              <form class="form-inline" method="POST" action="/admin/delivery-boy/amount-incentive">
                  @csrf
                  <b class="form-control-sm"  for="">Amount Incentive:</b>
                
                  <label class="form-control-sm"  for="incentive_percent">Incentive(%)</label>
                  <input type="number" class="form-control form-control-sm mb-2 mr-sm-2" id="incentive_percent" name="incentive_percent" value="{{$amount_incentive_percent}}" step="1" min="0" max="100">
                  <button type="submit" class="btn btn-sm btn-success mb-2">Submit</button>
                </form>
                <form class="form-inline" method="POST" action="/admin/delivery-boy/order-incentive">
                    @csrf
                    <b class="form-control-sm"  for="">Order Incentive:</b>
                    <label class="form-control-sm"  for="oiprice">Amount</label>
                    <input type="number" class="form-control form-control-sm mb-2 mr-sm-2" id="oiprice" name="oiprice" value="{{$order_incentive_amount}}" min="0" required><small> per order </small>
                    <button type="submit" class="ml-1 btn btn-sm btn-primary mb-2">Update</button>
                  </form>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Sl. No.</th>
                <th>Name(ID)</th>
                <th>Purchase Amount</th>
                <th>Distance</th>
                <th>Runner Charges</th>
                <th>Amount Incentive</th>
                <th>Weekly Incentive</th>
                <th>Order Incentive</th>
                <th>Bounus</th>
                <th>Total(₹)</th>
                <th>Detail List</th>
                <th>Payment</th>
              </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
              @if (!$delivery_boys->isEmpty())
              @foreach ($delivery_boys as $item)
              @if ($item->total_order !== 0)
              <tr>
                <td>{{$no++}}</td>
                <td>{{$item->name}}({{$item->id}})</td>
                <td>{{$item->order_amount}}</td>
                <td>{{$item->distance}} km</td>
                <td>{{$item->distance_amount}}</td>
                <td>{{$item->amount_incentive_amount}}({{$amount_incentive_percent}}%)</td>
                <td>{{$item->weekly_incentive}}</td>
                <td>{{$item->order_incentive}}</td>
                <td>{{$item->boy_bonus}}</td>
                <td>{{$item->total}}</td>
                <td>
                    <a href="/admin/delivery-salary/detail-list/{{$item->id}}" type="button" class="btn btn-sm btn-inverse-dark"><i class="mdi mdi-format-list-bulleted"></i></a>
                </td>
                <td>
                    <a href="/admin/delivery-salary/pay/{{$item->id}}" type="button" class="btn btn-sm btn-inverse-primary">Pay</a>
                </td>
              </tr>
              @endif
              
          @endforeach
              @else
                  <td colspan="10">No data</td>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection