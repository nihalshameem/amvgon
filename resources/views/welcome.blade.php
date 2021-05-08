@extends('customer.layouts.master')

@section('title')
    Home
@endsection

@section('content')

<!------ Include the above in your HEAD tag ---------->

<section class="slide-wrapper">
    {{-- <div class="container"> --}}
	    <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                @for($i = 0; $i < count($banners); $i++)
                <li data-target="#myCarousel" data-slide-to="{{$i}}" class="{{ $i == 0 ? ' active' : '' }}"></li>
               @endfor
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                @foreach ($banners as $key => $banner)
                <div class="carousel-item {{ $key == 0 ? ' active' : ''  }}">
                    <div class="fill">
                        <img src="{{asset($banner->image)}}" alt="">
                    </div>
                </div>
                @endforeach
            </div>
        

        </div>
    {{-- </div> --}}
</section>

<div class="row" style="margin: 0;">
    <div class="col-lg-2 col-md-3 hidden-sm-down home-side" style="background: #d7d7d7;">
        <div class="sider">
            <h5 class="side-heading">All categories</h5>
            <ul class="side-list">
                    <li class="nav-item"><a href="{{url('categories/functions')}}"><i class="mdi mdi-chevron-right"></i>Functions</a></li>
                    <li class="nav-item"><a href="{{url('categories/hotels')}}"><i class="mdi mdi-chevron-right"></i>Hotels</a></li>
            </ul>
            <h5 class="side-heading" {{count($allHots) == 0 ? 'hidden':''}}>Hot products</h5>
            <ul class="side-list">
                @foreach ($allHots as $allhot)
                    <li class="nav-item"><a href="{{url('product/'.$allhot->id)}}"><i class="mdi mdi-chevron-right"></i>{{$allhot->name}}</a></li>
                @endforeach
            </ul>
            <h5 class="side-heading" {{count($sideCombos) == 0 ? 'hidden':''}}>Combo Offers</h5>
            <ul class="side-list">
                @foreach ($sideCombos as $sideCombo)
                    <li class="nav-item"><a href="{{url('combo/'.$sideCombo->id)}}"><i class="mdi mdi-chevron-right"></i>{{$sideCombo->name}}</a></li>
                @endforeach
            </ul>
            <h5 class="side-heading" {{$sideRandoms == null ? 'hidden':''}}>Some Products</h5>
            <ul class="side-list">
                @foreach ($sideRandoms as $sideRandom)
                    <li class="nav-item"><a href="{{url('product/'.$sideRandom->id)}}"><i class="mdi mdi-chevron-right"></i>{{$sideRandom->name}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-lg-10 col-md-9">
        <div class="container blocks" {{count($hotProducts) > 0 ? '':'hidden'}}>
            <h3 class="heading">hot products</h3>
            <div class="row equaller">
                @foreach ($hotProducts as $hot)
                <div class="col-lg-3 col-md-5 mx-auto">
                    <div class="box {{$hot->type == '3' ? 'hot' : ''}}">
                        <div class="img-div"><img src="{{asset($hot->image)}}" alt=""></div>
                        <h4><a href="{{url('product/'.$hot->id.'?day='.$day)}}">{{$hot->name}}</a></h4>
                        <form action="">
                            <input type="text" class="spid" value="{{$hot->id}}" hidden>
                             <div class="radio">
                                <label><input type="radio" class="price_type" name="price_type" value="excellent" data-qty="{{$hot->excellent_min_qty}}">Excellent:{{$hot->excellent_price * 10}} <small class="text-success">Rupees for {{$hot->excellent_min_qty*1000}} grams</small><span class="offer" {{$hot->excellent_discount == 0 ? 'hidden': ''}}>{{$hot->excellent_discount}}%</span></label>
                            </div>
                           
                            <div class="radio">
                                <label><input type="radio" class="price_type" name="price_type" value="standard" data-qty="{{$hot->standard_min_qty}}">Standard:{{$hot->standard_price * 10}} <small class="text-success">Rupees for {{$hot->standard_min_qty*1000}} grams</small><span class="offer" {{$hot->standard_discount == 0 ? 'hidden': ''}}>{{$hot->standard_discount}}%</span></label>
                            </div>
                             <div class="radio">
                                <label><input type="radio" class="price_type" name="price_type" value="normal" data-qty="{{$hot->min_qty}}" checked>Normal:{{$hot->price * 10}} <small class="text-success">Rupees for {{$hot->min_qty*1000}} grams</small><span class="offer" {{$hot->discount == 0 ? 'hidden': ''}}>{{$hot->discount}}%</span></label>
                            </div>
                           
                        </form>
                        <button class="btn btn-cus btn-sm" onclick="beforeCart($(this).parent())"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
                    </div>
                </div>
                @endforeach
            </div>
            <a href="{{url('/products?day='.$day)}}" class="nav-item more">See more <i class="mdi mdi-arrow-right"></i></a>
        </div>
        <div class="container blocks mb-3" {{count($combos) > 0 ? '':'hidden'}}>
            <h3 class="heading">combos</h3>
        <div class="row equaller">
            @foreach ($combos as $combo)
            <div class="col-lg-3 col-md-5 mx-auto">
                <div class="box">
                    <div class="img-div"><img src="{{asset($combo->image)}}" alt=""></div>
                    <h4><a href="{{url('/combo/'.$combo->id)}}">{{$combo->name}}</a></h4>
                    <div class="radio">
                        <label>
                            @foreach ($combo->details as $key=> $d)
                            {{$key >= 1 ? ' + ': ''}}{{$d->product->name}} (per {{$combo->remin_qty}} g)
                        @endforeach
                        </label>
                        <label for=""><b>Price:</b>{{$combo->combo_price * 10}} <small class="text-success">Rupess for per {{$combo->remin_qty}} grams</small> <span class="offer" {{$combo->discount == 0 ? 'hidden': ''}}>{{$combo->discount}}%</span></label>
                    </div>
                    <button class="btn btn-cus btn-sm" onclick="beforeCartCombo({{$combo->id}},{{$combo->remin_qty}})"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
                </div>
            </div>
            @endforeach
        </div>
        <a href="{{url('/products?day='.$day)}}" class="nav-item more">See more <i class="mdi mdi-arrow-right"></i></a>
        </div>
        <div class="container blocks mb-3" {{count($products) > 0 ? '':'hidden'}}>
            <h3 class="heading">products</h3>
        <div class="row equaller">
            @foreach ($products as $product)
            <div class="col-lg-3 col-md-5 mx-auto">
                <div class="box {{$product->type == '3' ? 'hot' : ''}}">
                    <div class="img-div"><img src="{{asset($product->image)}}" alt=""></div>
                    <h4><a href="{{url('product/'.$product->id.'?day='.$day)}}">{{$product->name}}</a></h4>
                    <form action="">
                        <input type="text" class="spid" value="{{$product->id}}" hidden>
                         <div class="radio">
                            <label><input type="radio" class="price_type" name="price_type" value="excellent" data-qty="{{$product->excellent_min_qty}}">Excellent:{{$product->excellent_price * 10}} <small class="text-success">Rupees for {{$product->excellent_min_qty*1000}} grams</small><span class="offer" {{$product->excellent_discount == 0 ? 'hidden': ''}}>{{$product->excellent_discount}}%</span></label>
                        </div>
                       
                        <div class="radio">
                            <label><input type="radio" class="price_type" name="price_type" value="standard" data-qty="{{$product->standard_min_qty}}">Standard:{{$product->standard_price * 10}} <small class="text-success">Rupees for {{$product->standard_min_qty*1000}} grams</small><span class="offer" {{$product->standard_discount == 0 ? 'hidden': ''}}>{{$product->standard_discount}}%</span></label>
                        </div>
                         <div class="radio">
                            <label><input type="radio" class="price_type" name="price_type" value="normal" data-qty="{{$product->min_qty}}" checked>Normal:{{$product->price * 10}} <small class="text-success">Rupees for {{$product->min_qty*1000}} grams</small><span class="offer" {{$product->discount == 0 ? 'hidden': ''}}>{{$product->discount}}%</span></label>
                        </div>
                       
                    </form>
                    <button class="btn btn-cus btn-sm" onclick="beforeCart($(this).parent())"><i class="mdi mdi-cart-outline"></i> Add To Cart</button>
                </div>
            </div>
            @endforeach
        </div>
        <a href="{{url('/products?day='.$day)}}" class="nav-item more">See more <i class="mdi mdi-arrow-right"></i></a>
        </div>
    </div>
</div>
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