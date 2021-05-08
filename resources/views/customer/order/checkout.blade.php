@extends('customer.layouts.master')

@section('title')
    Checkout
@endsection

@section('content')
    <div class="container mt-5 mb-3">
        <table class="table table-striped checkout-table">
            <thead>
                <tr class="text-center">
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carts as $cart)
                    <tr class="text-center">
                        <td><img src="{{asset($cart->image)}}" alt="" width="50"></td>
                        <td>{{$cart->name}}</td>
                        <td>{{$cart->price}}</td>
                        <td class="totalQty">{{$cart->qty * 1000}} G</td>
                    </tr>
                @endforeach
                @foreach ($combos as $combo)
                    <tr class="text-center">
                        <td><img src="{{asset($combo->image)}}" alt="" width="50"></td>
                        <td>{{$combo->name}}</td>
                        <td>{{$combo->combo_total}}</td>
                        <td class="totalQty">{{($combo->qty * $combo->product_count)*1000}} G</td>
                    </tr>
                @endforeach
                    <tr class="text-center">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="totalQty">{{$total_qty}} KG</td>
                    </tr>
                @if (count($carts) == 0)
                    <tr>
                        <td colspan="10">No carts</td>
                    </tr>
                @endif
            </tbody>
        </table>
        @if (count($carts) > 0 || count($combos) > 0)
            <div class="checkout-block">
            <form action="{{url('/customer/order/add')}}" method="post" enctype="multipart/form-data" id="orderForm">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="side-heading">
                            Address
                        </h5>
                        <input type="text" name='address_id' value="{{$address->id}}" hidden>
                        <h5>{{$address->door_no.','.$address->village.','.$district->name.'-'.$address->pincode}}</h5>
                        <h5 class="side-heading">
                            Total Quantity
                        </h5>
                        <label><input type="text" class="form-control" value="{{$total_qty}}" name="total_qty" readonly style="width:50%;display:inherit"><span> KG</span></label>
                        <h5 class="side-heading">
                            Delivery Details
                        </h5>
                        <div class="form-group row">
                            <label for="" class="col-md-3">Date:</label>
                            <div class="col-md-9">
                                <input type="date" class="form-control" value="{{$delivery_date}}" name="delivery_date" readonly>
                            </div>
                        </div>
                        <div {{$start_time == null ? 'hidden':''}}>
                            <div class="form-group row">
                                <label for="" class="col-md-3">From:</label>
                                <div class="col-md-9">
                                    <input type="time" class="form-control" value="{{$start_time}}" name="start_time" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-md-3">To:</label>
                                <div class="col-md-9">
                                    <input type="time" class="form-control" value="{{$end_time}}" name="end_time" readonly>
                                </div>
                            </div>
                        </div>
                        {{-- <p class="text-success" {{$delivery_date == date('yy-m-d') ? '':'hidden'}}>Will be delivered with 4 hours from ordered time</p> --}}
                    </div>
                    <div class="col-md-6">
                        <h5 class="side-heading">Payment Type</h5>
                        <input type="text" name='payment_method' value="{{$payment_method->id}}" hidden>
                <h5>{{$payment_method->name}}</h5>
                <h5 class="side-heading">Total Amount</h5>
                <div class="form-group row">
                    <label for="" class="col-md-6">Price</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" value="{{$price}}" name="price" readonly>
                    </div>
                </div>
                <div class="form-group row" hidden>
                    <label for="" class="col-md-6">Coupon Discount(-)</label>
                    <div class="col-md-4">
                        <label><input type="text" class="form-control" value="{{$coupon_price}}" name="coupon" readonly style="width:50%;display:inherit"><span> ({{$coupon_discount}}%)</span></label>
                    </div>
                </div>
                <div class="form-group row" {{$start_time == null ? 'hidden':''}}>
                    <label for="" class="col-md-6">Custom Delivery</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" value="{{$delivery_charge}}" name="time_charge" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-6">Shipping Amount</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" value="{{$shipping_amount}}" name="shipping_amount" readonly>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label for="" class="col-md-6">Total</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" value="{{$total}}" name="total" readonly>
                    </div>
                </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <input type="text" value="1" name="payment_status" hidden>
                        <input type="text" value="{{auth()->user()->id}}" name="customer_id" hidden>
                        <button type="button" class="btn btn-lg btn-cus mt-3" id="order-now">Order Now <i class="mdi mdi-arrow-right"></i></button>
                    </div>
                </div>
            </form>
        </div>
        @endif
        
            <a href="{{ url()->previous() }}" class="btn btn-sm btn-default mt-2"><i class="mdi mdi-chevron-double-left"></i> Go Back</a>
            <div class="card-body text-center" hidden>
                <form action="{{ route('payment') }}" method="POST" id="paymentForm">
                    @csrf
                    <input type="text" name='address_id' value="{{$address->id}}" hidden>
                    <input type="number" class="form-control" name='total_qty' value="{{$total_qty}}" readonly>
                    <input type="text" name='payment_method' value="{{$payment_method->id}}" hidden>
                    <input type="text" class="form-control" value="{{$price}}" name="price" readonly>
                    <input type="text" class="form-control" value="{{$shipping_amount}}" name="shipping_amount" readonly>
                    <input type="text" class="form-control" value="{{$total}}" name="total" readonly>
                    <input type="text" value="2" name="payment_status" hidden>
                    <input type="text" value="{{auth()->user()->id}}" name="customer_id" hidden>
                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                            data-key="{{ env('RAZOR_KEY') }}"
                            data-amount="{{$total * 100}}"
                            data-buttontext="Pay"
                            data-name="AMVEGON"
                            data-description="online payment"
                            data-prefill.name="name"
                            data-prefill.email="email"
                            data-theme.color="#ff7529">
                    </script>
                </form>
                    <script>
                      (function(){
                        var d=document; var x=!d.getElementById('razorpay-embed-btn-js')
                        if(x){ var s=d.createElement('script'); s.defer=!0;s.id='razorpay-embed-btn-js';
                        s.src='https://cdn.razorpay.com/static/embed_btn/bundle.js';d.body.appendChild(s);} else{var rzp=window['__rzp__'];
                        rzp && rzp.init && rzp.init()}})();
                    </script>
                  </div>
                      
            </div>
    </div>
<style>
    .form-control:read-only{
        border-color: transparent;
        background: transparent;
    }
</style>
 <script>
     $(document).ready(function(){
         $(window).keydown(function(event){
             if(event.keyCode == 13) {
                 event.preventDefault();
                 return false;
             }
         });
         $('#order-now').click(function(){
            let paymentMethod = $('input[name="payment_method"]').val();
            if(paymentMethod == '1'){
                $('#orderForm').submit();
            }else{
                var token = $('meta[name="csrf-token"]').attr("content");
                $('#paymentForm').submit();
            }
         })
     });
 </script>
@endsection