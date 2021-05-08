@extends('customer.layouts.master')

@section('title')
    Categories | Products
@endsection

@section('content')
    <div class="container mt-5 mb-3">
        <h3 class="heading">{{$category_name}}</h3>
        <div class="row equaller">
            @foreach ($products as $product)
            <div class="col-lg-3 col-md-5 mx-auto">
                <div class="box {{$product->type == '3' ? 'hot' : ''}}">
                    <div class="img-div"><img src="{{asset($product->image)}}" alt=""></div>
                    <h4><a href="{{url('/product/'.$product->id)}}">{{$product->name}}</a></h4>
                    <form action="">
                        <div class="radio">
                            <label><input type="radio" class="price_type" name="price_type" value="normal" checked>Normal: <span>₹</span>{{$product->price}}{{$product->unit == 'kg' ? '/100g':' piece'}} <span class="offer" {{$product->discount == 0 ? 'hidden': ''}}>{{$product->discount}}%</span></label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" class="price_type" name="price_type" value="standard">Standard: <span>₹</span>{{$product->standard_price}}{{$product->unit == 'kg' ? '/100g':' piece'}} <span class="offer" {{$product->standard_discount == 0 ? 'hidden': ''}}>{{$product->standard_discount}}%</span></label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" class="price_type" name="price_type" value="excellent">Excellent: <span>₹</span>{{$product->excellent_price}}{{$product->unit == 'kg' ? '/100g':' piece'}} <span class="offer" {{$product->excellent_discount == 0 ? 'hidden': ''}}>{{$product->excellent_discount}}%</span></label>
                        </div>
                    </form>
                    <button class="btn btn-cus btn-sm" onclick="addCart({{$product->id}},0.1,this.parentElement.querySelector('.price_type:checked').value,'single')"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
                </div>
            </div>
                @endforeach
        </div>
        @if ($products->lastPage() > 1)
          <div class="btn-group" role="group" aria-label="Basic example">
          </div>
          @endif
          <div class="btn-group mt-4" role="group" aria-label="Basic example">
            <a href="{{ $products->url($products->currentPage()-1) }}" type="button" class="btn btn-outline-secondary {{ ($products->currentPage() == 1) ? ' disabled' : '' }}"><i class="mdi mdi-chevron-left"></i></a>
            @for ($i = 1; $i <= $products->lastPage(); $i++)
            <a href="{{ $products->url($i) }}" type="button" class="btn btn-outline-secondary{{ ($products->currentPage() == $i) ? ' active' : '' }}">{{ $i }}</a>
            @endfor
            <a href="{{ $products->url($products->currentPage()+1) }}" type="button" class="btn btn-outline-secondary{{ ($products->currentPage() == $products->lastPage()) ? ' disabled' : '' }}"><i class="mdi mdi-chevron-right"></i></a>
          </div>
    </div>
@endsection