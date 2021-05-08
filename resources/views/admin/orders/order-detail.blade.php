@extends('admin.layouts.master')

@section('title')
    Order Details
@endsection

@section('content')
<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body"><div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          <div class="mr-md-3 mr-xl-5">
            <h2>Order Details#{{ $order->id }}</h2>
          </div>
          <div class="d-flex">
            <i class="mdi mdi-home text-muted hover-cursor"></i>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin">orders list&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a  href="/admin/products">order details</a></p>
          </div>
        </div>
        <div class="d-flex justify-content-between align-items-end flex-wrap">
          <button data-toggle="modal" data-target="#printInfo{{$order->id}}" type="button" class="btn btn-dark btn-sm mr-3 mt-2 mt-xl-0">Print
          </button>
        </div>
      </div>
        <form class="form-sample" method="POST" action="/admin/order/update/{{ $order->id }}" enctype="multipart/form-data">
            @csrf
          <p class="card-description">
            Order detail
          </p>
          <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-3 mt-2">Price</label>
                    <div class="col-sm-9">
                        <input type="number" class="order-d form-control form-control-sm @error('name') is-invalid @enderror" name="price" id="order_price" value="{{ $order->price }}" readonly/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 mt-2">Quantity</label>
                <div class="col-sm-9">
                    <input type="number" class="order-d form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ $order->qty }}" readonly/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-3 mt-2">Shipping Amount</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control form-control-sm @error('name') is-invalid @enderror" name="shipping_amount" id="order_ship" value="{{ $order->shipping_amount }}" min="0"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 mt-2">Total</label>
                <div class="col-sm-9">
                    <input type="text" class="order-d form-control form-control-sm @error('email') is-invalid @enderror" name="total" id="order_total" value="{{ $order->total }}" readonly/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 mt-2">Payment Method</label>
                <div class="col-sm-9">
                  <select class="form-control form-control-sm @error('payment_method') is-invalid @enderror" name="payment_method">
                    @foreach ($payment_method as $method)
                        <option value="{{$method->id}}" {{ $order->payment_method === $method->id ? 'selected' : '' }}>{{$method->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 mt-2">Payment status</label>
                <div class="col-sm-9">
                    <select class="form-control form-control-sm @error('payment_status') is-invalid @enderror" name="payment_status">
                      @foreach ($payment_status as $ps)
                      <option value="{{$ps->id}}" {{ $order->payment_status === $ps->id ? 'selected' : '' }}>{{$ps->name}}</option>
                      @endforeach
                      </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 mt-2">Runner</label>
                <div class="col-sm-9">
                  <select class="form-control form-control-sm @error('payment_method') is-invalid @enderror" name="delivery">
                    <option value="" {{ $order->delivery === null ? 'selected' : '' }}>Not Set</option>
                    @foreach ($delivery as $item)
                        <option value="{{$item->id}}" {{ $order->delivery == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 mt-2">Order status</label>
                <div class="col-sm-9">
                    <select class="form-control form-control-sm @error('payment_status') is-invalid @enderror" name="order_status">
                      @foreach ($order_status as $os)
                      <option value="{{$os->id}}" {{ $order->order_status == $os->id ? 'selected' : '' }}>{{$os->name}}</option>
                      @endforeach
                      </select>
                </div>
              </div>
            </div>
          </div>
          <p class="card-description">
            Delivery details
          </p>
          <div class="row">
            {{-- <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-3 mt-2">Delivery start</label>
                    <div class="col-sm-9">
                        <input type="text" class="order-d form-control form-control-sm" name="delivery_start" value="{{ $order->start_time == null ? 'not set':$order->start_time }}" readonly/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 mt-2">Delivery End</label>
                <div class="col-sm-9">
                    <input type="text" class="order-d form-control form-control-sm" value="{{ $order->end_time == null ? 'not set':$order->end_time }}" readonly/>
                </div>
              </div>
            </div> --}}
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 mt-2">Delivery Date</label>
                <div class="col-sm-9">
                    <input type="text" class="order-d form-control form-control-sm" value="{{ date('l j F Y', strtotime($order->delivery_date)) }}" readonly/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
              <div class="col-md-6">
            <p class="card-description">
              product list
            </p>
                <table class="table tabel-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order_details as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->qty}}</td>
                                <td>{{$item->total_price}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
              <div class="col-md-6">
                <p class="card-description">
                  Address detail
                </p>
                  <div class="row">
                    <div class="col-md-6">
                      @if ($customer !== null)
                      <address>
                        <p class="font-weight-bold">{{$customer->first_name}} {{$customer->last_name}}</p>
                        <p>
                            {{$order->door_no}}, {{$order->village}},
                        </p>
                        <p>
                            {{$order->district}}-{{$order->pincode}}
                        </p>
                        <p>
                            {{$order->state}}, {{$order->country}}
                        </p>
                      </address>
                      @else
                      <address>
                                  <p class="font-weight-bold text-danger">User not found</p>
                                </address>
                      @endif
                    </div>
                    <div class="col-md-6">
                      <address class="text-primary">
                        <p class="font-weight-bold">
                          E-mail
                        </p>
                        <p class="mb-2">
                            {{$order->email}}
                        </p>
                        <p class="font-weight-bold">
                          Phone
                        </p>
                        <p>
                            {{$order->phone}}
                        </p>
                      </address>
                    </div>
                  </div>
              </div>
          </div>
          <button type="submit" class="btn btn-primary mr-2">Submit</button>
          <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
        </form>
      </div>
    </div>
  </div>
  <div id="printf"></div>
  
  <!-- Modal -->
  <div class="modal " id="printInfo{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Print Info #{{$order->id}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="text" class="OrderID" value="{{$order->id}}" style="display:none">
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
                      @foreach ($order_details as $detail)
                          <tr class="tr">
                              <td hidden><input type="checkbox" name="detail_id" value="{{$detail->id}}" class="print-check" checked></td>
                              <td>{{$detail->product_id}}</td>
                              <td>{{$detail->name}}</td>
                              <td>{{$detail->price_type}}</td>
                              <td><input type="number" name="" id="" class="form-control form-control-sm price" value="{{$detail->total_price}}" disabled></td>
                              <td><input type="number" name="" id="" class="form-control form-control-sm qty" value="{{$detail->qty}}" disabled></td>
                          </tr>
                      @endforeach
                      <tr>
                          {{-- <td></td> --}}
                          <td></td>
                          <th>Total</th>
                          <td></td>
                          <td><input type="number" class="total_price form-control form-control-sm" disabled name="" value="{{$order->price}}"></td>
                          <td><input type="number" class="total_qty form-control " disabled name="" value="{{number_format((float)$order->qty, 2, '.', '')}}"></td>
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
@endsection