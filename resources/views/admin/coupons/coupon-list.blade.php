@extends('admin.layouts.master')

@section('title')
    Coupons
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap">
          <div class="d-flex align-items-end flex-wrap">
            <div class="mr-md-3 mr-xl-5">
              <h2>Coupons List</h2>
            </div>
            <div class="d-flex">
              <i class="mdi mdi-home text-muted hover-cursor"></i>
              <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a  href="/admin/coupons">coupons list</a></p>
            </div>
          </div>
          <div class="d-flex justify-content-between align-items-end flex-wrap">
            <button href="" type="button" class="btn btn-light bg-white btn-icon mr-3 mt-2 mt-xl-0">
              <a href="/admin/coupon/add"> <i class="mdi mdi-plus text-muted"></i></a>
            </button>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Sl. no</th>
                <th>Image</th>
                <th>Name</th>
                <th>Code</th>
                <th>Discount</th>
                <th>Expire</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = $coupons->perPage() * ($coupons->currentPage() - 1) + 1; ?>
              @if (!$coupons->isEmpty())
              @foreach ($coupons as $coupon)
              <tr>
                <td>{{$no++}}</td>
                <td><img src="{{asset($coupon->image)}}" alt=""></td>
                <td>{{$coupon->name}}</td>
                <td>{{$coupon->code}}</td>
                <td>{{$coupon->discount}} %</td>
                <td>{{date('l j F Y', strtotime($coupon->end_date))}}</td>
                <td>
                  <a href="/admin/coupon/{{$coupon->id}}" type="button" class="btn btn-sm btn-inverse-dark"><i class="mdi mdi-pencil btn-icon-append"></i> </a>
              </td>
              
              </tr>
          @endforeach
              @else
                  <td colspan="10">No data</td>
              @endif
              
            </tbody>
          </table>
          @if ($coupons->lastPage() > 1)
          <div class="btn-group" role="group" aria-label="Basic example">
          </div>
          @endif
          <div class="btn-group mt-4" role="group" aria-label="Basic example">
            <a href="{{ $coupons->url($coupons->currentPage()-1) }}" type="button" class="btn btn-outline-secondary {{ ($coupons->currentPage() == 1) ? ' disabled' : '' }}"><</a>
            @for ($i = 1; $i <= $coupons->lastPage(); $i++)
            <a href="{{ $coupons->url($i) }}" type="button" class="btn btn-outline-secondary{{ ($coupons->currentPage() == $i) ? ' active' : '' }}">{{ $i }}</a>
            @endfor
            <a href="{{ $coupons->url($coupons->currentPage()+1) }}" type="button" class="btn btn-outline-secondary{{ ($coupons->currentPage() == $coupons->lastPage()) ? ' disabled' : '' }}">></a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection