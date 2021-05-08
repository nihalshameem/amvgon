@extends('customer.layouts.master')

@section('title')
    Combo | Details
@endsection

@section('content')
    <div class="container mt-5 mb-3">
        <div class="row">
            <div class="col-md-6">
                <img src="{{$combo->image}}" alt="" class="single-img">
            </div>
            <div class="col-md-6">
                <div class="product-details">
                    <form action="{{('/customer/cart/add/combo/'.$combo->id)}}" method="post" id="addCart">
                        @csrf
                        <input type="text" name="day" value="{{$day}}" hidden>
                        <table class="table" style="width: 100%">
                            <tbody>
                                <tr>
                                    <td><h5>Combo Name :</h5></td>
                                    <td><p>{{$combo->name}}</p>
                                        <input type="hidden" id="typer" value="{{$combo->unit}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td><h5>Products :</h5></td>
                                    <td>
                                        @foreach ($combo_details as $detail)
                                        <div class="radio form-inline">
                                            <label>{{$detail->product->name}}: <span>₹</span><input type="text" class="product_price" value="{{($combo->min_qty / 1000) * $detail->price * 10}}" disabled ></label>
                                            <input type="text" class="original_price" value="{{ $detail->price * 10}}" hidden>
                                        </div>
                                            
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td><h5>Discount :</h5></td>
                                    <td><span id="discount">{{$combo->discount}}</span> %</td>
                                </tr>
                                <tr>
                                    <td><h5>Price :</h5></td>
                                    <td>
                                        <label><span>₹ </span><input type="text" id="total_price" value="" disabled></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td><h5>Quantity :</h5></td>
                                    <td>
                                        @foreach ($combo_details as $detail)
                                        <div class="form-inline">
                                            <input type="number" name="qty" class="form-control form-control-sm qty" min="{{$combo->min_qty}}" class="form-control form-control-sm" value="{{$combo->min_qty}}" required step="50"> <span>g</span>
                                        </div><br>
                                        @endforeach
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col-sm-12 text-center mt-3">
                    <button class="btn btn-cus" type="submit" form="addCart"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
                </div>
                    </form>
                </div>
            </div>
        </div>
        <hr>
        <h5 class="side-heading mt-5">Combo Details</h5>
        <div class="table responsive">
            <table class="table">
                <thead>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Min Qty</th>
                    <th>Price</th>
                </thead>
                <tbody>
                    @foreach ($combo_details as $detail)
                        <tr>
                            <td><img src="{{$detail->product->image}}" alt="" width="100"></td>
                            <td><a href="{{url('product/'.$detail->product->id)}}">{{$detail->product->name}}</a></td>
                            <td>{{$detail->type}}</td>
                            @if ($detail->type == 'normal')
                            <td>{{$detail->product->min_qty * 1000}} G</td>
                            <td>{{$detail->product->min_qty * $detail->product->price * 10}}</td>
                            @elseif($detail->type == 'standard')
                            <td>{{$detail->product->standard_min_qty * 1000}} G</td>
                            <td>{{$detail->product->standard_min_qty * $detail->product->standard_price * 10}}</td>
                            @else
                            <td>{{$detail->product->excellent_min_qty * 1000}} G</td>
                            <td>{{$detail->product->excellent_min_qty * $detail->product->excellent_price * 10}}</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <hr>
        <h5 class="side-heading mt-5">Related Combos</h5>
        <div class="row equaller">
            @foreach ($relateds as $relate)
            <div class="col-lg-3 col-md-5 mx-auto">
                <div class="box">
                    <div class="img-div"><img src="{{asset($relate->image)}}" alt=""></div>
                    <h4><a href="{{url('combo/'.$relate->id.'?day='.$day)}}">{{$relate->name}}</a></h4>
                    <div class="radio">
                        <label>
                            @foreach ($relate->details as $key=> $d)
                            {{$key >= 1 ? ' + ': ''}}{{$d->product->name}} (per {{$relate->remin_qty}} g)
                        @endforeach
                        </label>
                        <label for=""><b>Price:</b>{{$relate->combo_price * 10}} <small class="text-success">Rupess for per {{$relate->remin_qty}} grams</small> <span class="offer" {{$relate->discount == 0 ? 'hidden': ''}}>{{$relate->discount}}%</span></label>
                    </div>
                    <button class="btn btn-cus btn-sm" onclick="beforeCartCombo({{$relate->id}},{{$relate->remin_qty}})"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
                </div>
            </div>
                @endforeach
        </div>
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-default mt-2"><i class="mdi mdi-chevron-double-left"></i> Go Back</a>
    </div>
<script>
    $(document).ready(function(){
        var allprice = $('.original_price').map(function(){return $(this).val();}).get();
        function comboPrice(){
            let sum = 0;
            $('.product_price').each(function(){
                sum += +$(this).val();
            });
            sum = sum - (sum * $('#discount').text() / 100);
            sum = sum.toFixed(2);
            $('#total_price').val(sum);
        }
        comboPrice();
        $('.qty').change(function(){
            let qty = $(this).val();
            $('.qty').val(qty);
            for(i=0;i<=allprice.length;i++){
                $('.product_price').eq(i).val((qty /1000) * allprice[i])
            }
        comboPrice();
        })
    })
</script>
<!-- Before cart combo Modal -->
<div class="modal fade" id="beforeCartComboModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Select Quantity</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
            <form class="form-inline mt-3" id="beforeCartComboForm">
            <input type="number" class="form-control form-control-sm mb-2 mr-sm-2 "   id="cepq" step="50" required>
            <label class="ml-1" for="inlineFormInputName2">grams</label>
            <input type="text" id="cepid" hidden>
            </form>
            
        </div>
        <div class="modal-footer">
          <button type="submit" form="beforeCartComboForm" class="btn btn-sm btn-cus"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
          <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
@endsection