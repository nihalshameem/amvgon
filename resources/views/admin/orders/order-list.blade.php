@extends('admin.layouts.master')

@section('title')
    Orders
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap">
          <div class="d-flex align-items-end flex-wrap">
            <div class="mr-md-3 mr-xl-5">
              <h2>Orders List</h2>
            </div>
            <div class="d-flex">
              <i class="mdi mdi-home text-muted hover-cursor"></i>
              <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a  href="/admin/orders">orders list</a></p>
            </div>
          </div>
          <div class="d-flex justify-content-between align-items-end flex-wrap">
            <button data-toggle="modal" data-target="#printOrder" type="button" class="btn btn-dark btn-sm mr-3 mt-2 mt-xl-0">Print all</button>
          </div>
        </div>
        <form class="form-inline mt-3" method="POST" action="/admin/order/search" enctype="multipart/form-data">
          @csrf
          <label class="sr-only" for="inlineFormInputName2">Category</label>
          <input type="text" class="form-control form-control-sm mb-2 mr-sm-2 " id="inlineFormInputName2" placeholder="Search..." name="order_search" value="{{ $order_search }}">
          <button type="submit" class="btn btn-sm btn-primary mb-2"><i class="mdi mdi-magnify"></i></button>
        </form>
        <form class="form-inline mt-3" method="POST" action="/admin/order/filter" enctype="multipart/form-data">
          @csrf
          <label class="" for="">Start date</label>
          <input type="date" class="form-control form-control-sm mb-2 mr-sm-2 " id="" name="start_date" value="{{$start_date}}">
          <label class="" for="">End date</label>
          <input type="date" class="form-control form-control-sm mb-2 mr-sm-2 " id="" name="end_date" value="{{$end_date}}">
          <button type="submit" class="btn btn-sm btn-primary mb-2"><i class="mdi mdi-filter-outline"></i></button>
        </form>
        <div class="row mt-5">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body dashboard-tabs order-tabs p-0">
                  <ul class="nav nav-tabs px-4" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">Pending</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="packing-tab" data-toggle="tab" href="#packing" role="tab" aria-controls="packing" aria-selected="false">Packing</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="ontheway-tab" data-toggle="tab" href="#ontheway" role="tab" aria-controls="ontheway" aria-selected="false">On the way</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="success-tab" data-toggle="tab" href="#success" role="tab" aria-controls="success" aria-selected="false">Success</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="cancelled-tab" data-toggle="tab" href="#cancelled" role="tab" aria-controls="cancelled" aria-selected="false">Cancelled</a>
                    </li>
                  </ul>
                  <div class="tab-content py-0 px-0">
                    <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Order ID</th>
                              <th>Quantity</th>
                              <th>Total</th>
                              <th>Payment Method</th>
                              <th>Payment status</th>
                              <th>Order Status</th>
                              <th>Phone</th>
                              <th>Date</th>
                              <th>Details</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($orders as $order)
                            @if ($order->order_status == 'pending')
                            <tr>
                              <td>{{$order->id}}</td>
                              <td>{{$order->qty}}</td>
                              <td>{{$order->total}}</td>
                              <td>{{$order->payment_method}}</td>
                              <td>{{$order->payment_status}}</td>
                              <td>{{$order->order_status}}</td>
                              <td>{{$order->phone}}</td>
                              <td>{{$order->created_at}}</td>
                              <td>
                                <form action="{{url('/admin/order/'.$order->id)}}" method="get" id="orderView{{$order->id}}" hidden></form>
                                <button class="btn btn-sm btn-inverse-dark" form="orderView{{$order->id}}"><i class="mdi mdi-eye"></i></button>                         
                              </a>
                            </td>
                            
                            </tr>
                            @endif
                        @endforeach
                            @if(count($orders) == 0)
                                <td colspan="10">No orders</td>
                            @endif
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="packing" role="tabpanel" aria-labelledby="packing-tab">
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Order ID</th>
                              <th>Quantity</th>
                              <th>Total</th>
                              <th>Payment Method</th>
                              <th>Payment status</th>
                              <th>Order Status</th>
                              <th>Phone</th>
                              <th>Date</th>
                              <th>Details</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($orders as $order)
                            @if ($order->order_status == 'packing')
                            <tr>
                              <td>{{$order->id}}</td>
                              <td>{{$order->qty}}</td>
                              <td>{{$order->total}}</td>
                              <td>{{$order->payment_method}}</td>
                              <td>{{$order->payment_status}}</td>
                              <td>{{$order->order_status}}</td>
                              <td>{{$order->phone}}</td>
                              <td>{{$order->created_at}}</td>
                              <td>
                                <form action="{{url('/admin/order/'.$order->id)}}" method="get" id="orderView{{$order->id}}" hidden></form>
                                <button class="btn btn-sm btn-inverse-dark" form="orderView{{$order->id}}"><i class="mdi mdi-eye"></i></button>                         
                              </a>
                            </td>
                            
                            </tr>
                            @endif
                        @endforeach
                            @if(count($orders) == 0)
                                <td colspan="10">No orders</td>
                            @endif
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="ontheway" role="tabpanel" aria-labelledby="ontheway-tab">
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Order ID</th>
                              <th>Quantity</th>
                              <th>Total</th>
                              <th>Payment Method</th>
                              <th>Payment status</th>
                              <th>Order Status</th>
                              <th>Phone</th>
                              <th>Date</th>
                              <th>Details</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($orders as $order)
                            @if ($order->order_status == 'on the way')
                            <tr>
                              <td>{{$order->id}}</td>
                              <td>{{$order->qty}}</td>
                              <td>{{$order->total}}</td>
                              <td>{{$order->payment_method}}</td>
                              <td>{{$order->payment_status}}</td>
                              <td>{{$order->order_status}}</td>
                              <td>{{$order->phone}}</td>
                              <td>{{$order->created_at}}</td>
                              <td>
                                <form action="{{url('/admin/order/'.$order->id)}}" method="get" id="orderView{{$order->id}}" hidden></form>
                                <button class="btn btn-sm btn-inverse-dark" form="orderView{{$order->id}}"><i class="mdi mdi-eye"></i></button>                         
                              </a>
                            </td>
                            
                            </tr>
                            @endif
                        @endforeach
                            @if(count($orders) == 0)
                                <td colspan="10">No orders</td>
                            @endif
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="success" role="tabpanel" aria-labelledby="success-tab">
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Order ID</th>
                              <th>Quantity</th>
                              <th>Total</th>
                              <th>Payment Method</th>
                              <th>Payment status</th>
                              <th>Order Status</th>
                              <th>Phone</th>
                              <th>Date</th>
                              <th>Details</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($orders as $order)
                            @if ($order->order_status == 'success')
                            <tr>
                              <td>{{$order->id}}</td>
                              <td>{{$order->qty}}</td>
                              <td>{{$order->total}}</td>
                              <td>{{$order->payment_method}}</td>
                              <td>{{$order->payment_status}}</td>
                              <td>{{$order->order_status}}</td>
                              <td>{{$order->phone}}</td>
                              <td>{{$order->created_at}}</td>
                              <td>
                                <form action="{{url('/admin/order/'.$order->id)}}" method="get" id="orderView{{$order->id}}" hidden></form>
                                <button class="btn btn-sm btn-inverse-dark" form="orderView{{$order->id}}"><i class="mdi mdi-eye"></i></button>                         
                              </a>
                            </td>
                            
                            </tr>
                            @endif
                        @endforeach
                            @if(count($orders) == 0)
                                <td colspan="10">No orders</td>
                            @endif
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="cancelled-tab">
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Order ID</th>
                              <th>Quantity</th>
                              <th>Total</th>
                              <th>Payment Method</th>
                              <th>Payment status</th>
                              <th>Order Status</th>
                              <th>Phone</th>
                              <th>Date</th>
                              <th>Details</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($orders as $order)
                            @if ($order->order_status == 'cancelled')
                            <tr>
                              <td>{{$order->id}}</td>
                              <td>{{$order->qty}}</td>
                              <td>{{$order->total}}</td>
                              <td>{{$order->payment_method}}</td>
                              <td>{{$order->payment_status}}</td>
                              <td>{{$order->order_status}}</td>
                              <td>{{$order->phone}}</td>
                              <td>{{$order->created_at}}</td>
                              <td>
                                <form action="{{url('/admin/order/'.$order->id)}}" method="get" id="orderView{{$order->id}}" hidden></form>
                                <button class="btn btn-sm btn-inverse-dark" form="orderView{{$order->id}}"><i class="mdi mdi-eye"></i></button>                         
                              </a>
                            </td>
                            
                            </tr>
                            @endif
                        @endforeach
                            @if(count($orders) == 0)
                                <td colspan="10">No orders</td>
                            @endif
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal " id="printOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Print Orders</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
              <table class="table">
                  <thead>
                      <tr>
                          <td><i class="mdi mdi-check"></i></td>
                          <th>ID</th>
                          <th>Customer</th>
                          <th>Qty</th>
                          <th>Total</th>
                          <th>Delivery date</th>
                          <th>Order Date</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($print_orders as $item)
                          <tr class="tr">
                              <td><input type="checkbox" name="detail_id" value="{{$item->id}}" class="print-check" checked></td>
                              <td>{{$item->id}}</td>
                              <td>{{$item->customer_name}}</td>
                              <td>{{$item->qty}}</td>
                              <td>{{$item->total}}</td>
                              <td>{{$item->delivery_date}}</td>
                              <td>{{date('Y-m-d',strtotime($item->created_at))}}</td>
                          </tr>
                      @endforeach
                  </tbody>
              </table>
            </div>
        </div>
        <div class="modal-footer">
          <button class="invoicer btn btn-sm btn-primary" onclick="printOrder($(this).parent().closest('.modal-content'))">Print</button>
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
@endsection