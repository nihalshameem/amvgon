@extends('customer.layouts.master')

@section('title')
    Product | Details
@endsection

@section('content')
    <div class="container mt-5 mb-3">
        <div class="row">
            <div class="col-md-6">
                <img src="{{$product->image}}" alt="" class="single-img">
            </div>
            <div class="col-md-6">
                <div class="product-details">
                    <form action="{{('/customer/cart/add/'.$product->id)}}" method="post" id="addCart">
                        @csrf
                        <input type="text" name="day" value="{{$day}}" hidden>
                        <table class="table" style="width: 100%">
                            <tbody>
                                <tr>
                                    <td><h5>Name :</h5></td>
                                    <td><p>{{$product->name}}</p>
                                        <input type="hidden" id="typer" value="{{$product->unit}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td><h5>Price :</h5></td>
                                    <td>
                                        
                                        <div class="radio form-inline">
                                            <label><input type="radio" name="price_type" value="excellent">Excellent: <input type="text" id="excellent" value="{{$product->excellent_price * 10}}" data-qty="{{$product->excellent_min_qty}}" disabled> <span class="offer" {{$product->excellent_discount == 0 ? 'hidden': ''}}>{{$product->excellent_discount}}%</span> <span> rupees for {{$product->low_qty * 1000}} grams</span></label>
                                        </div>
                                        <div class="radio form-inline">
                                            <label><input type="radio" name="price_type" value="standard">Standard: <span>₹</span><input type="text" id="standard" value="{{$product->standard_price * 10}}" data-qty="{{$product->standard_min_qty}}" disabled> <span class="offer" {{$product->standard_discount == 0 ? 'hidden': ''}}>{{$product->standard_discount}}%</span> <span> rupees for {{$product->low_qty * 1000}} grams</span></label>
                                        </div>
                                        <div class="radio form-inline">
                                            <label><input type="radio" name="price_type" value="normal" checked>Normal: <span>₹</span><input type="text" id="normal" value="{{$product->price * 10}}" data-qty="{{$product->min_qty}}" disabled > <span class="offer" {{$product->discount == 0 ? 'hidden': ''}}>{{$product->discount}}%</span> <span> rupees for {{$product->low_qty * 1000}} grams</span></label>
                                        </div>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td><h5>Quantity :</h5></td>
                                    <td>
                                        <div class="form-inline">
                                            <input type="number" name="qty" id="qty" min="{{$product->low_qty * 1000}}" class="form-control form-control-sm" value="{{$product->low_qty * 1000}}" required step="50"> <span>G</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><h5>Description :</h5></td>
                                    <td><p class="description">{{$product->description}}</p></td>
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
        <h5 class="side-heading mt-5">Related Products</h5>
        <div class="row equaller">
            @foreach ($relateds as $related)
            <div class="col-lg-3 col-md-5 mx-auto">
                <div class="box {{$related->type == '3' ? 'hot' : ''}}">
                    <div class="img-div"><img src="{{asset($related->image)}}" alt=""></div>
                    <h4><a href="{{url('product/'.$related->id.'?day='.$day)}}">{{$related->name}}</a></h4>
                    <form action="">
                        <input type="text" class="spid" value="{{$related->id}}" hidden>
                         <div class="radio">
                            <label><input type="radio" class="price_type" name="price_type" value="excellent" data-qty="{{$related->excellent_min_qty}}">Excellent:{{$related->excellent_price * 10}} <small class="text-success">Rupees for {{$related->excellent_min_qty*1000}} grams</small><span class="offer" {{$related->excellent_discount == 0 ? 'hidden': ''}}>{{$related->excellent_discount}}%</span></label>
                        </div>
                       
                        <div class="radio">
                            <label><input type="radio" class="price_type" name="price_type" value="standard" data-qty="{{$related->standard_min_qty}}">Standard:{{$related->standard_price * 10}} <small class="text-success">Rupees for {{$related->standard_min_qty*1000}} grams</small><span class="offer" {{$related->standard_discount == 0 ? 'hidden': ''}}>{{$related->standard_discount}}%</span></label>
                        </div>
                         <div class="radio">
                            <label><input type="radio" class="price_type" name="price_type" value="normal" data-qty="{{$related->min_qty}}" checked>Normal:{{$related->price * 10}} <small class="text-success">Rupees for {{$related->min_qty*1000}} grams</small><span class="offer" {{$related->discount == 0 ? 'hidden': ''}}>{{$related->discount}}%</span></label>
                        </div>
                       
                    </form>
                    <button class="btn btn-cus btn-sm" onclick="beforeCart($(this).parent())"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
                </div>
            </div>
                @endforeach
        </div>
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-default mt-2"><i class="mdi mdi-chevron-double-left"></i> Go Back</a>
    </div>
<script>
    $(document).ready(function(){
        var normal = $('#normal').val()
        var standard = $('#standard').val()
        var excellent = $('#excellent').val()
        $('#qty').change(function(){
        let qty = $(this).val();
        let normal_total = (qty/100) * normal;
        let standard_total = (qty/100) * standard;
        let excellent_total = (qty/100) * excellent;
        $('#normal').val(normal_total.toFixed(2));
        $('#standard').val(standard_total.toFixed(2));
        $('#excellent').val(excellent_total.toFixed(2));
    })
    })
</script>
<!-- Before cart Modal -->
<div class="modal fade" id="beforeCartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Cart</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
            <form class="form-inline mt-3" id="beforeCartForm">
            <input type="number" class="form-control form-control-sm mb-2 mr-sm-2 "  name="" id="sepq" step="50" required>
            <label class="ml-1" for="inlineFormInputName2">grams</label>
            <input type="text" id="sept" hidden>
            <input type="text" id="spid" hidden>
            </form>
            
        </div>
        <div class="modal-footer">
          <button type="submit" form="beforeCartForm" class="btn btn-sm btn-cus"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
          <button type="button" class="btn btn-sm btn-dark" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
@endsection