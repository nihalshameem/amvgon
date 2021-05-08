@extends('admin.layouts.master')

@section('title')
    Reject details
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap">
          <div class="d-flex align-items-end flex-wrap">
            <div class="mr-md-3 mr-xl-5">
              <h2>Rejects Details</h2>
            </div>
            <div class="d-flex">
              <i class="mdi mdi-home text-muted hover-cursor"></i>
              <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
              <p class="text-muted mb-0 hover-cursor"><a  href="/admin/rejects">&nbsp;/&nbsp;rejects list&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a  href="/admin/reject/{{$reject->id}}">reject details</a></p>
            </div>
          </div>
        </div>
        <div class="container">
            <p class="card-decription">Order details</p>
            <div class="row">
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <td><b>Order ID</b></td>
                            <td>{{$order->id}}</td>
                        </tr>
                        <tr>
                            <td><b>Quantity</b></td>
                            <td>{{$order->qty}}</td>
                        </tr>
                        <tr>
                            <td><b>Total Price</b></td>
                            <td>{{$order->total}}</td>
                        </tr>
                        <tr>
                            <td><b>Payment Method</b></td>
                            <td>{{$order->payment_method}}</td>
                        </tr>
                        <tr>
                            <td><b>Payment Status</b></td>
                            <td>{{$order->payment_status}}</td>
                        </tr>
                        <tr>
                            <td><b>Order Status</b></td>
                            <td>{{$order->order_status}}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <td><b>First Name</b></td>
                            <td>{{$reject->first_name}}</td>
                        </tr>
                        <tr>
                            <td><b>Last Name</b></td>
                            <td>{{$reject->last_name}}</td>
                        </tr>
                        <tr>
                            <td><b>Door no. & Village</b></td>
                            <td>{{$order->door_no.' '.$order->village}}</td>
                        </tr>
                        <tr>
                            <td><b>District</b></td>
                            <td>{{$order->district.' - '.$order->pincode}}</td>
                        </tr>
                        <tr>
                            <td><b>Phone</b></td>
                            <td>{{$order->phone}}</td>
                        </tr>
                        <tr>
                            <td><b>Email</b></td>
                            <td>{{$order->email}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <p class="card-decription">Delivery boy details</p>
            <div class="row">
                <div class="col-md-4">
                    <img src="{{asset($delivery->image)}}" alt="{{$delivery->id}}" width="100">
                </div>
                <div class="col-md-8">
                    <table class="table">
                        <tr>
                            <td><b>Name</b></td>
                            <td>{{$delivery->name}}</td>
                        </tr>
                        <tr>
                            <td><b>Door no. & Village</b></td>
                            <td>{{$delivery->door_no.' '.$delivery->village}}</td>
                        </tr>
                        <tr>
                            <td><b>District</b></td>
                            <td>{{$delivery->district.' - '.$delivery->pincode}}</td>
                        </tr>
                        <tr>
                            <td><b>Phone</b></td>
                            <td>{{$delivery->phone}}</td>
                        </tr>
                        <tr>
                            <td><b>Vehicle Name</b></td>
                            <td>{{$delivery->vehicle_name}}</td>
                        </tr>
                        <tr>
                            <td><b>Vehicle Number</b></td>
                            <td>{{$delivery->vehicle_number}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <form action="/admin/reject/delete/{{$reject->id}}" method="post">
          @csrf
        <button type="submit" onclick="return confirm('Are you sure?')" class="btn float-right btn-sm btn-inverse-danger btn-icon-text"><i class="mdi mdi-delete-forever"></i>Delete</button>
        </form>
      </div>
    </div>
  </div>
@endsection