@extends('admin.layouts.master')

@section('title')
    Purchase List
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
            <p class="text-primary mb-0 hover-cursor"><a  href="/admin/order/purchase-list">purchase list</a></p>
            </div>
          </div>
          <div class="d-flex justify-content-between align-items-end flex-wrap">
            <button onclick="purchase('tomorrow')" type="button" class="btn btn-dark btn-sm mr-3 mt-2 mt-xl-0">Print
            </button>
          </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body dashboard-tabs order-tabs p-0">
                  <ul class="nav nav-tabs px-4" role="tablist">
                    {{-- <li class="nav-item">
                      <a class="nav-link" id="today-tab" data-toggle="tab" href="#today" role="tab" aria-controls="today" aria-selected="true" data-date='today'>Today</a>
                    </li> --}}
                    <li class="nav-item active">
                      <a class="nav-link" id="tomorrow-tab" data-toggle="tab" href="#tomorrow" role="tab" aria-controls="tomorrow" aria-selected="false"data-date='tomorrow'>Tomorrow</a>
                    </li>
                  </ul>
                  <div class="tab-content py-0 px-0">
                    <div class="tab-pane fade" id="today" role="tabpanel" aria-labelledby="today-tab">
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Sl.No</th>
                              <th>Product ID</th>
                              {{-- <th>Order ID</th> --}}
                              <th>Image</th>
                              <th>Name</th>
                              <th>Type</th>
                              <th>Qty</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $no =1; ?>
                            @foreach ($today_normal_products->sortBy('id') as $tnp)
                                @if ($tnp->total_qty !== 0)
                                <tr>
                                  <td>{{$no++}}</td>
                                  <td>{{$tnp->id}}</td>
                                  <td><img src="{{asset($tnp->image)}}" alt=""></td>
                                  <td>{{$tnp->name}}</td>                                  <td>{{$tnp->price_type}}</td>
                                  <td>{{$tnp->total_qty}}</td>
                                </tr>
                                @endif
                            @endforeach
                            @foreach ($today_standard_products->sortBy('id') as $tsp)
                                @if ($tsp->total_qty !== 0)
                                <tr>
                                  <td>{{$no++}}</td>
                                  <td>{{$tsp->id}}</td>
                                  <td><img src="{{asset($tsp->image)}}" alt=""></td>
                                  <td>{{$tsp->name}}</td>                                  <td>{{$tsp->price_type}}</td>
                                  <td>{{$tsp->total_qty}}</td>
                                </tr>
                                @endif
                            @endforeach
                            @foreach ($today_excellent_products->sortBy('id') as $tep)
                                @if ($tep->total_qty !== 0)
                                <tr>
                                  <td>{{$no++}}</td>
                                  <td>{{$tep->id}}</td>
                                  <td><img src="{{asset($tep->image)}}" alt=""></td>
                                  <td>{{$tep->name}}</td>                                  <td>{{$tep->price_type}}</td>
                                  <td>{{$tep->total_qty}}</td>
                                </tr>
                                @endif
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="tab-pane fade active show" id="tomorrow" role="tabpanel" aria-labelledby="tomorrow-tab">
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Sl.No</th>
                              <th>Product ID</th>
                              <th>Image</th>
                              <th>Name</th>
                              <th>Type</th>
                              <th>Qty</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $no =1; ?>
                            @foreach ($tomorrow_normal_products->sortBy('id') as $ttnp)
                                @if ($ttnp->total_qty !== 0)
                                <tr>
                                  <td>{{$no++}}</td>
                                  <td>{{$ttnp->id}}</td>
                                  <td><img src="{{asset($ttnp->image)}}" alt=""></td>
                                  <td>{{$ttnp->name}}</td>                                  <td>{{$ttnp->price_type}}</td>
                                  <td>{{$ttnp->total_qty}}</td>
                                </tr>
                                @endif
                            @endforeach
                            @foreach ($tomorrow_standard_products->sortBy('id') as $ttsp)
                                @if ($ttsp->total_qty !== 0)
                                <tr>
                                  <td>{{$no++}}</td>
                                  <td>{{$ttsp->id}}</td>
                                  <td><img src="{{asset($ttsp->image)}}" alt=""></td>
                                  <td>{{$ttsp->name}}</td>                                  <td>{{$ttsp->price_type}}</td>
                                  <td>{{$ttsp->total_qty}}</td>
                                </tr>
                                @endif
                            @endforeach
                            @foreach ($tomorrow_excellent_products->sortBy('id') as $ttep)
                                @if ($ttep->total_qty !== 0)
                                <tr>
                                  <td>{{$no++}}</td>
                                  <td>{{$ttep->id}}</td>
                                  <td><img src="{{asset($ttep->image)}}" alt=""></td>
                                  <td>{{$ttep->name}}</td>                                  <td>{{$ttep->price_type}}</td>
                                  <td>{{$ttep->total_qty}}</td>
                                </tr>
                                @endif
                            @endforeach
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
  <div id="printf" hidden></div>
@endsection