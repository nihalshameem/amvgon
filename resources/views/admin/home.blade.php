@extends('admin.layouts.master')

@section('title')
Dashboard    
@endsection

@section('content')
<script>
  $(window).on('load',function(){ 
    $('.nav li.active').removeClass('active');
    $('.nav li:first-child').addClass('active');
  })
</script>
@php
    $store = App\Models\Store::find(1);
@endphp
<script>
  console.log('user='+{{auth()->user()->id}});
</script>
            <div class="content-wrapper">
              <div class="row">
                <div class="col-md-12 grid-margin">
                  <div class="d-flex justify-content-between flex-wrap">
                    <div class="d-flex align-items-end flex-wrap">
                      <div class="mr-md-3 mr-xl-5">
                        <h2>Welcome back,{{auth()->user()->name}} </h2>
                        <p class="mb-md-0">Here is your admin panel.</p>
                      </div>
                      <div class="d-flex">
                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                        <p class="text-primary mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard</p>
                      </div>
                    </div>
                    @if (auth()->user()->role == 'SuperAdmin' || auth()->user()->role == 'OrderAdmin')
                    <div class="d-flex justify-content-between align-items-end flex-wrap">
                      <h5 style="margin: 0 15px 15px 0;">Automatic Delivery </h5>
                      <label class="switch">
                        <input type="checkbox" checked>
                        <span class="auto {{$store->delivery == 'auto' ? 'checked':''}}" id="auto"></span>
                      </label>
                    </div>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body dashboard-tabs p-0">
                      <ul class="nav nav-tabs px-4" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                        </li>
                        @if (auth()->user()->role == 'SuperAdmin')
                        <li class="nav-item">
                          <a class="nav-link" id="amount-tab" data-toggle="tab" href="#amount" role="tab" aria-controls="amount" aria-selected="true">Revenue</a>
                        </li>
                        @endif
                      </ul>
                      <div class="tab-content py-0 px-0">
                        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                          <div class="d-flex flex-wrap justify-content-xl-between">
                            @if (auth()->user()->role == 'SuperAdmin')
                            <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                              <i class="mdi mdi-currency-inr mr-3 icon-lg text-danger"></i>
                              <div class="d-flex flex-column justify-content-around">
                                <small class="mb-1 text-muted">Revenue</small>
                                <h5 class="mr-2 mb-0" >₹{{$income}}</h5>
                              </div>
                            </div>
                            @endif
                            <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                              <i class="mdi mdi-account-multiple mr-3 icon-lg text-primary"></i>
                              <div class="d-flex flex-column justify-content-around">
                                <small class="mb-1 text-muted">Total users</small>
                                <h5 class="mr-2 mb-0">{{$customers}}</h5>
                              </div>
                            </div>
                            <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                              <i class="mdi mdi-download mr-3 icon-lg text-warning"></i>
                              <div class="d-flex flex-column justify-content-around">
                                <small class="mb-1 text-muted">App Downloads</small>
                                <h5 class="mr-2 mb-0" >{{$download_count}}</h5>
                              </div>
                            </div>
                            <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                              <i class="mdi mdi-truck-delivery mr-3 icon-lg text-info"></i>
                              <div class="d-flex flex-column justify-content-around">
                                <small class="mb-1 text-muted">Runners</small>
                                <h5 class="mr-2 mb-0">{{$delivery}}</h5>
                              </div>
                            </div>
                            <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                              <i class="mdi mdi-marker-check mr-3 icon-lg text-primary"></i>
                              <div class="d-flex flex-column justify-content-around">
                                <a class="btn btn-dark btn-sm mr-3 mt-2 mt-xl-0" href="/admin/products/update-price">Update price</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        @if (auth()->user()->role == 'SuperAdmin')
                        <div class="tab-pane fade" id="amount" role="tabpanel" aria-labelledby="amount-tab">
                          <div class="d-flex flex-wrap justify-content-xl-between">
                            <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                              <i class="mdi mdi-cash-multiple mr-3 icon-lg text-success"></i>
                              <div class="d-flex flex-column justify-content-around">
                                <small class="mb-1 text-muted">Income</small>
                                <h5 class="mr-2 mb-0">₹ {{$income}}</h5>
                              </div>
                            </div>
                            <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                              <i class="mdi mdi-camera-timer mr-3 icon-lg text-dark"></i>
                              <div class="d-flex flex-column justify-content-around">
                                <small class="mb-1 text-muted">Pending</small>
                                <h5 class="mr-2 mb-0">₹ {{$pending}}</h5>
                              </div>
                            </div>
                            <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                              <i class="mdi mdi-chart-areaspline mr-3 icon-lg text-primary"></i>
                              <div class="d-flex flex-column justify-content-around">
                                <small class="mb-1 text-muted">Total</small>
                                <h5 class="mr-2 mb-0">₹ {{$total}}</h5>
                              </div>
                            </div>
                          </div>
                        </div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <ul id="chartd" hidden>
                @foreach ($delivers as $chart)
                    <li>{{$chart}}</li>
                @endforeach
              </ul>
              <ul id="sales" hidden>
                @foreach ($sales as $sale)
                    <li>{{$sale}}</li>
                @endforeach
              </ul>
              @if (auth()->user()->role == 'SuperAdmin')
              <div class="row">
                <div class="col-md-7 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <p class="card-title">Sales Analysis</p>
                      <div id="cash-deposits-chart-legend" class="d-flex justify-content-center pt-3"></div>
                      <canvas id="cash-deposits-chart"></canvas>
                    </div>
                  </div>
                </div>
                <div class="col-md-5 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <p class="card-title">Delivery Days</p>
                      <div class="form-group row">
                        <div class="col-sm-10 font-weight-bold">Today ({{date('h:i a', strtotime($today_status->start))}} - {{date('h:i a', strtotime($today_status->end))}})</div>
                        <div class="col-sm-2">
                          <label class="switch">
                            <input type="checkbox" checked>
                            <span class="deliveryDay auto  {{$today_status->status == '1' ? 'checked':''}}" data-id="{{$today_status->id}}"></span>
                          </label>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-sm-10 font-weight-bold">Tomorrow ({{date('h:i a', strtotime($tomorrow_status->start))}} - {{date('h:i a', strtotime($tomorrow_status->end))}})</div>
                        <div class="col-sm-2">
                          <label class="switch">
                            <input type="checkbox" checked>
                            <span class="deliveryDay auto  {{$tomorrow_status->status == '1' ? 'checked':''}}" data-id="{{$tomorrow_status->id}}"></span>
                          </label>
                        </div>
                      </div>
                      <a href="/admin/delivery-day/setting" class="btn btn-sm btn-success">Settings</a>
                      <p class="card-title mt-3">Shipping Charge</p>
                      <form class="form-inline mt-3" method="POST" action="/admin/shipping-charge/update" enctype="multipart/form-data">
                        @csrf
                        <label class="mb-2 mr-2" for="inlineFormInputName2">Amount :</label>
                        <input type="number" min="0" class="form-control form-control-sm mb-2 mr-sm-2" id="inlineFormInputName2" name="shipping_charge" value="{{ $shipping_charge }}" required>
                        <button type="submit" class="btn btn-sm btn-primary mb-2">Update</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              @endif
            </div>
            <!-- content-wrapper ends -->
<script>
  $(".deliveryDay").click(function () {
            let t;
            let id = $(this).attr('data-id');
            let a = $('meta[name="csrf-token"]').attr("content");
            (t = $(this).hasClass("checked") ? "on" : "off"),
                $(".page-loader").show(),
                $.ajax({
                    url: "/admin/delivery-day/status",
                    type: "POST",
                    dataType: "json",
                    data: { _token: a, id: id },
                })
                    .done(function (a) {
                            if(t == 'on'){
                              $('span[data-id = '+id+']').removeClass('checked');
                            }else{
                              $('span[data-id = '+id+']').addClass('checked');
                            };
                            $(".page-loader").hide(),
                            $("body").append(
                                "<div class='notification success' style='top:55px'><p><i class='mdi mdi-alert-octagon'></i>success,Status Changed</p></div>"
                            ),
                            $(".notification").fadeIn(),
                            $(".notification")
                                .delay(3e3)
                                .fadeOut(300, function () {
                                    $(this).remove();
                                })
                    })
                    .fail(function () {
                        let a = $("body");
                        (data =
                            "<div class='notification error' style='top:55px'><p><i class='mdi mdi-alert-octagon'></i>Error,Something wrong</p></div>"),
                            a.append(data),
                            $(".notification").fadeIn(),
                            $(".notification")
                                .delay(3e3)
                                .fadeOut(300, function () {
                                    $(this).remove();
                                });
                    });
        })
</script>
@endsection