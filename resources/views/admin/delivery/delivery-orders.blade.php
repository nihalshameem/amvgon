@extends('admin.layouts.master')

@section('title')
    Delivery Boy Orders
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap">
          <div class="d-flex align-items-end flex-wrap">
            <div class="mr-md-3 mr-xl-5">
              <h2>Delivery Boy Order List</h2>
            </div>
            <div class="d-flex">
              <i class="mdi mdi-home text-muted hover-cursor"></i>
              <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin/delivery-boys">delivery boys list&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a  href="/admin/delivery-boy/orders/{{$delivery->id}}">delivery boys order list</a></p>
        </div>
      </div>
      <div class="d-flex justify-content-between align-items-end flex-wrap">
        <a href="{{url('admin/invoice/all/'.$delivery->id)}}" target="_blank"  type="button" class="btn btn-dark btn-sm">
          Print All
        </a>
      </div>
    </div>
            <div class="container table-responsive">
                @php
                    $no = 1;
                @endphp
                @foreach ($orders as $item)
                    <h4 class="mt-4">Order {{$no++}} 
                        <button data-toggle="modal" data-target="#printInfo{{$item->id}}" class="float-right mb-2 btn btn-sm btn-dark">Print</button>
                    </h4>
                    <table class="table table-sm table-dark text-center">
                        <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>Customer Id</th>
                                <th>Order Status</th>
                                <th>Price</th>
                                <th>Shipping Charge</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->customer_id}}</td>
                                <td>{{$item->order_status}}</td>
                                <td>{{number_format((float)$item->price, 2, '.', '')}}</td>
                                <td>{{$item->shipping_amount}}</td>
                                <td>{{$item->total}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Qty(Kg)</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item->details as $detail)
                                <tr>
                                    <td>{{$detail->product_id}}</td>
                                    <td>{{$detail->name}}</td>
                                    <td>{{$detail->price_type}}</td>
                                    <td>{{$detail->price}}</td>
                                    <td>{{$detail->qty}}</td>
                                    <td>{{$detail->total_price}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endforeach
            </div>
        </div>
      </div>
    </div>
    <div id="printf" hidden>

    </div>
    @foreach ($orders as $item)
  
    <!-- Modal -->
    <div class="modal " id="printInfo{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Print Info #{{$item->id}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <input type="text" class="OrderID" value="{{$item->id}}" style="display:none">
              <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            {{-- <td><i class="mdi mdi-check"></i></td> --}}
                            <th>ID</th>
                            <th>Product</th>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($item->details as $detail)
                            <tr class="tr">
                                <td hidden><input type="checkbox" name="detail_id" value="{{$detail->id}}" class="print-check" checked></td>
                                <td>{{$detail->product_id}}</td>
                                <td>{{$detail->name}}</td>
                                <td>{{$detail->price_type}}</td>
                                <td><input type="number" name="" id="" class=" price" value="{{$detail->total_price}}" disabled></td>
                                <td><input type="number" name="" id="" class=" qty" value="{{$detail->qty}}" disabled></td>
                            </tr>
                        @endforeach
                        <tr>
                            {{-- <td></td> --}}
                            <td></td>
                            <th>Total</th>
                            <td></td>
                            <td><input type="number" class="total_price " disabled name="" value="{{$item->price}}"></td>
                            <td><input type="number" class="total_qty " disabled name="" value="{{number_format((float)$item->qty, 2, '.', '')}}"></td>
                        </tr>
                    </tbody>
                </table>
              </div>
          </div>
          <div class="modal-footer">
            <button class="invoicer btn btn-sm btn-primary" onclick="invoice($(this).parent().closest('.modal-content'))">Print</button>
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
    @endforeach
@endsection