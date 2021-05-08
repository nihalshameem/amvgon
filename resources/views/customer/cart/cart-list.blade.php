@extends('customer.layouts.master')

@section('title')
    Carts
@endsection

@section('content')
    <div class="container mt-5 mb-3">
        
        <h3 class="heading">Carts</h3>
        <div class="table-responsive">
            <table class="table table-striped cart-table">
                <thead>
                    <tr class="text-center">
                        <th>Image</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Price(₹)</th>
                        <th>Qty(G)</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody {{$day == null ? 'hidden' : ''}}>
                    @foreach ($carts as $cart)
                        <tr class="text-center">
                            <td><img src="{{asset($cart->image)}}" alt="" width="50"></td>
                            <td><a href="{{url('product/'.$cart->id.'?day='.$day)}}">{{$cart->name}}</a></td>
                            <td>{{$cart->price_type}}</td>
                            <td><input type="text" name="price" id="price-{{$cart->cart_id}}" class="form-control form-control-sm" value="{{$cart->total * 10}}" disabled></td>
                            <td><input type="number" name="qty" step="50" data-id="{{$cart->cart_id}}"  id="qty-{{$cart->cart_id}}" class="form-control form-control-sm" value="{{$cart->qty * 1000}}" min="{{$cart->minqty}}" width="20" onchange="updateCart($(this),$(this).val())">
                                <small class="text-danger" id="overflow-{{$cart->cart_id}}" {{$cart->day == 'tomorrow' ? 'hidden':''}}>{{$cart->overflow}}</small>
                            </td>
                            <td><a href="{{url('/customer/cart/delete/'.$cart->cart_id)}}" data-toggle="tooltip" data-placement="top" title="Delete from cart" class="text-danger"><i class="mdi mdi-close"></i></a></td>
                        </tr>
                    @endforeach
                    @foreach ($combos as $combo)
                        <tr class="text-center">
                            <td><img src="{{asset($combo->image)}}" alt="" width="50"></td>
                            <td><a href="{{url('combo/'.$combo->id)}}">{{$combo->name}}</a></td>
                            <td></td>
                            <td><input type="text" name="price" id="price-{{$combo->cart_id}}" class="form-control form-control-sm" value="{{$combo->combo_total * 10}}" disabled></td>
                            <td><input type="number" name="qty" step="50" data-id="{{$combo->cart_id}}"  id="qty-{{$combo->cart_id}}" class="form-control form-control-sm" value="{{$combo->qty * 1000}}" min="{{$combo->remin_qty}}" width="20" onchange="updateCart($(this),$(this).val())">
                                <small class="text-danger" id="overflow-{{$combo->cart_id}}" {{$combo->day == 'tomorrow' ? 'hidden':''}}>{{$combo->overflow}}</small>
                            </td>
                            <td><a href="{{url('/customer/cart/delete/'.$combo->cart_id)}}" data-toggle="tooltip" data-placement="top" title="Delete from cart" class="text-danger"><i class="mdi mdi-close"></i></a></td>
                        </tr>
                    @endforeach
                    <tr {{(count($carts) == 0 && count($combos) == 0) ? 'hidden':''}}>
                        <td><b>Total(₹):</b></td>
                        <td></td>
                        <td></td>
                        <td><input type="text" class="form-control form-control-sm" value="{{$final_amount * 10}}" id="final-amount" readonly></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @if (count($carts) == 0 && count($combos) == 0)
                        <tr>
                            <td colspan="10">No carts</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <form action="{{url('/customer/cart/clear')}}" method="post" id="cartClear" hidden>
            @csrf
        </form>
        <div {{$day == null ? 'hidden' : ''}}>
            <button type="submit" form="cartClear" class="btn btn-sm btn-danger float-right" style="display: {{count($carts) > 0 ? 'block' : 'none'}}">Clear all</button>
        </div>
        @if (count($carts) > 0 || count($combos) > 0)
            <div class="checkout-block" {{$day == null ? 'hidden' : ''}}>
            <form action="{{url('/customer/checkout')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="side-heading">
                            Select Address
                            @if (count($addresses) < 4)
                            <a data-toggle="modal" data-target="#addAddressModal" class="btn btn-sm btn-default float-right" data-url="{{ url('/customer/address/add')}}" href="#"><i class="mdi mdi-plus"></i></a>
                            @endif
                        </h5>
               @foreach ($addresses as $key => $address)
               <div class="radio">
                <label><input type="radio" name="address_id" {{ $key == 0 ? 'checked' : ''  }} value="{{$address->id}}"> {{$address->door_no}}, {{$address->village}},{{$address->district}}-{{$address->pincode}}</label>
              </div>
               @endforeach
               @if (count($addresses) < 1)
               <small class="text-danger"><i>please add address to continue..</i></small>
               @endif
                    </div>
                    <div class="col-md-6">
                        <h5 class="side-heading">Select Payment Type</h5>
                        {{-- @foreach ($payment_methods as $key => $payment_method)
               <div class="radio">
                <label><input type="radio" name="payment_method" {{ $key == 0 ? 'checked' : ''  }} value="{{$payment_method->id}}"> {{$payment_method->name}}</label>
              </div>
               @endforeach --}}
               <div class="radio">
                <label><input type="radio" name="payment_method" value="1" checked> Cash On Delivery</label>
              </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row ml-2" id="custom-delivery" hidden>
                            <div class="col-4">
                                <div class="radio">
                                    <label for=""><input type="radio" name="delivery_date" value="{{date('yy-m-d')}}" id="delivery-today" checked> Today</label>
                                </div>
                                <div class="radio">
                                    <label for=""><input type="radio" name="delivery_date" value="{{date('yy-m-d',strtotime('tomorrow'))}}"> Tomorrow</label>
                                </div>
                            </div>
                            <div class="col-8">
                                <label for="">From: <input type="time" name="delivery_start" value="09:00" class="form-control form-control-sm"></label>
                                <label for="">To: <input type="time" name="delivery_end" value="20:00" class="form-control form-control-sm"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" hidden>
                        <h5 class="side-headin">Coupon Code</h5>
                        <div class="form-inline">
                            <input type="text" class="form-control form-control-sm" name="coupon">
                        <button type="button" id="couponCheck" class="btn btn-sm btn-danger"  disabled>Check</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @if (count($addresses) > 0)
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-lg btn-cus mt-3">Checkout <i class="mdi mdi-arrow-right"></i></button>
                    </div>
                    @endif
                </div>
            </form>
        </div>
        @endif
        
            <a href="{{ url()->previous() }}" class="btn btn-sm btn-default mt-2"><i class="mdi mdi-chevron-double-left"></i> Go Back</a>
    </div>

<!-- password change modal -->
<div id="addAddressModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
       <!-- Modal content-->
       <div class="modal-content">
          <div class="modal-header">
             <h4 class="modal-title">Add Address</h4>
             <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
             <form action="{{url('/customer/address/add')}}" method="post" id="addAddress" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                   <label for="" class="col-md-3">Door no. & Street</label>
                   <div class="col-md-9">
                      <input type="text" class="form-control form-control-sm @error('door_no') is-invalid @enderror" name="door_no" required>
                      @if ($errors->has('door_no'))
                      <span class="invalid feedback"role="alert">
                      {{ $errors->first('door_no') }}.
                      </span>
                      @endif
                   </div>
                </div>
                <div class="form-group row">
                   <label for="" class="col-md-3">Village</label>
                   <div class="col-md-9">
                      <input type="text" class="form-control form-control-sm @error('village') is-invalid @enderror" name="village" required>
                      @if ($errors->has('village'))
                      <span class="invalid feedback"role="alert">
                      {{ $errors->first('village') }}.
                      </span>
                      @endif
                   </div>
                </div>
                <div class="form-group row">
                   <label for="" class="col-md-3">District</label>
                   <div class="col-md-9">
                      <select name="district" class="form-control form-control-sm">
                         @foreach ($districts as $district)
                         <option value="{{$district->id}}">{{$district->name}}</option>
                         @endforeach
                      </select>
                      @if ($errors->has('district'))
                      <span class="invalid feedback"role="alert">
                      {{ $errors->first('district') }}.
                      </span>
                      @endif
                   </div>
                </div>
                <div class="form-group row">
                   <label for="" class="col-md-3">Pincode</label>
                   <div class="col-md-9">
                      <input type="number" class="form-control form-control-sm @error('pincode') is-invalid @enderror" name="pincode" required>
                      @if ($errors->has('pincode'))
                      <span class="invalid feedback"role="alert">
                      {{ $errors->first('pincode') }}.
                      </span>
                      @endif
                   </div>
                </div>
             </form>
          </div>
          <div class="modal-footer">
             <button type="submit" form="addAddress" class="btn btn-sm btn-primary">Add</button>
             <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
          </div>
       </div>
    </div>
 </div>
 <script>
     $(document).ready(function(){
         $(window).keydown(function(event){
             if(event.keyCode == 13) {
                 event.preventDefault();
                 return false;
             }
         });
     });
 </script>
@endsection