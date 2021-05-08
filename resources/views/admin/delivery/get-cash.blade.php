@extends('admin.layouts.master')

@section('title')
    Cash From Runners
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap">
          <div class="d-flex align-items-end flex-wrap">
            <div class="mr-md-3 mr-xl-5">
              <h2>Cash from Runners List</h2>
            </div>
            <div class="d-flex">
              <i class="mdi mdi-home text-muted hover-cursor"></i>
              <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin/delivery-boys">runners list&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a  href="/admin/delivery-boys/get-cash/list">cash from runners list</a></p>
            </div>
          </div>
          <div class="d-flex justify-content-between align-items-end flex-wrap">
            <button href="" type="button" class="btn btn-light bg-white btn-icon mr-3 mt-2 mt-xl-0">
              <a href="/admin/delivery-boy/add"> <i class="mdi mdi-plus text-muted"></i></a>
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
                <th>Order Total</th>
                <th>Cash</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1 ?>
              @foreach ($delivery_boys as $boy)
              @if ($boy->order_total > 0)
              <tr>
                <td>{{$no++}}</td>
                <td><img src="{{asset($boy->image)}}" alt=""></td>
                <td>{{$boy->name}}</td>
                <td>{{$boy->order_total}}</td>
              <td>
                <a href="/admin/delivery-boy/get-cash/{{$boy->id}}" type="button" class="btn btn-sm btn-inverse-success">Get Cash</a>
            </td>
              </tr>
              @endif
              @endforeach
              @if ($delivery_boys->isEmpty())
                  <tr>
                    <td colspan="10">No data</td>
                  </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection