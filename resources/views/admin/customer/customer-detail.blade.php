@extends('admin.layouts.master')

@section('title')
    Customer Details
@endsection

@section('content')
<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body"><div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          <div class="mr-md-3 mr-xl-5">
            <h2>Customer Details#{{$customer->id}}</h2>
          </div>
          <div class="d-flex">
            <i class="mdi mdi-home text-muted hover-cursor"></i>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin/customers">customer list&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a href="/admin/customer/detail/{{$customer->id}}">customer details</a></p>
          </div>
        </div>
        <div class="d-flex justify-content-between align-items-end flex-wrap">
          <form action="/admin/customer/delete/{{$customer->id}}" method="post" id="pd-{{$customer->id}}" hidden>
            @csrf
          </form>
          <button type="submit" form="pd-{{$customer->id}}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-inverse-danger btn-icon">
                  <i class="mdi mdi-delete-forever"></i>
                </button>
        </div>
      </div>
      <p class="card-description mt-5">
        General
      </p>
      <div class="row">
        <div class="col-md-6 text-center">
            <img src="{{asset($customer->image)}}" alt="" width="250">
        </div>
          <div class="col-md-6">
              <table class="table">
                  <tbody>
                      <tr>
                          <td><b>First Name</b></td>
                          <td>{{$customer->first_name}}</td>
                      </tr>
                      <tr>
                          <td><b>Last Name</b></td>
                          <td>{{$customer->last_name}}</td>
                      </tr>
                      <tr>
                          <td><b>Email</b></td>
                          <td>{{$customer->email}}</td>
                      </tr>
                      <tr>
                          <td><b>Phone</b></td>
                          <td>{{$customer->phone}}</td>
                      </tr>
                  </tbody>
              </table>
          </div>
      </div>
      <p class="card-description mt-3">
            address details
          </p>
      <table class="table">
          <thead>
              <tr>
                  <th>Door no & Street</th>
                  <th>Village</th>
                  <th>District</th>
                  <th>Pincode</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($addresses as $address)
                  <tr>
                      <td>{{$address->door_no}}</td>
                      <td>{{$address->village}}</td>
                      <td>{{$address->district}}</td>
                      <td>{{$address->pincode}}</td>
                  </tr>
              @endforeach
          </tbody>
      </table>
      <p class="card-description mt-3">
            order list
          </p>
      <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Order Status</th>
                <th>Payment Status</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->qty}}</td>
                    <td>{{$order->total}}</td>
                    <td>{{$order->order_status}}</td>
                    <td>{{$order->payment_status}}</td>
                    <td>
                        <form action="/admin/order/{{$order->id}}" method="get" id="view-{{$order->id}}" hidden>
                        @csrf
                      </form>
                      <button type="submit" form="view-{{$order->id}}" class="btn btn-sm btn-inverse-dark btn-icon">
                              <i class="mdi mdi-eye"></i>
                            </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
      </div>
    </div>
  </div>
@endsection