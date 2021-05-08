@extends('admin.layouts.master')

@section('title')
    Runner
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap">
          <div class="d-flex align-items-end flex-wrap">
            <div class="mr-md-3 mr-xl-5">
              <h2>Runners List</h2>
            </div>
            <div class="d-flex">
              <i class="mdi mdi-home text-muted hover-cursor"></i>
              <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a  href="/admin/delivery-boys">runners list</a></p>
            </div>
          </div>
          <div class="d-flex justify-content-between align-items-end flex-wrap">
            <button href="" type="button" class="btn btn-light bg-white btn-icon mr-3 mt-2 mt-xl-0">
              <a href="/admin/delivery-boy/add"> <i class="mdi mdi-plus text-muted"></i></a>
            </button>
          </div>
        </div>
        <form class="form-inline mt-3 float-left" method="POST" action="/admin/delivery-boy/search" enctype="multipart/form-data">
          @csrf
          <label class="sr-only" for="inlineFormInputName2">Category</label>
          <input type="text" class="form-control form-control-sm mb-2 mr-sm-2 " id="inlineFormInputName2" placeholder="Search..." name="deilvery_search" value="{{ $deilvery_search }}">
          <button type="submit" class="btn btn-sm btn-primary mb-2"><i class="mdi mdi-magnify"></i></button>
        </form>
        <a href="/admin/delivery-boys/get-cash/list" class="btn btn-sm btn-success float-right mt-3">Finished Orders</a>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Sl. no</th>
                <th>Image</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Password</th>
                <th>Location</th>
                <th>Details</th>
                <th>Orders</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = $delivery->perPage() * ($delivery->currentPage() - 1) + 1; ?>
              @foreach ($delivery as $dlvy)
                  <tr>
                    <td>{{$no++}}</td>
                    <td><img src="{{asset($dlvy->image)}}" alt=""></td>
                    <td>{{$dlvy->name}}</td>
                    <td>{{$dlvy->phone}}</td>
                    <td>{{$dlvy->show_password}}</td>
                    <td><a href="{{url('https://www.google.com/maps?q='.$dlvy->latitude.','.$dlvy->longitude)}}" target="_balnk" type="button"class="btn btn-sm btn-inverse-primary"><i class="mdi mdi-google-maps"></i></a></td>
                    <td>
                      <a href="/admin/delivery-boy/detail/{{$dlvy->id}}" type="button" class="btn btn-sm btn-inverse-dark"><i class="mdi mdi-eye"></i></a>
                  </td>
                  <td>
                    <a href="/admin/delivery-boy/orders/{{$dlvy->id}}" type="button" class="btn btn-sm btn-warning"><i class="mdi mdi-package-variant"></i></a>
                </td>
                  </tr>
              @endforeach
              @if ($delivery->isEmpty())
                  <tr>
                    <td colspan="10">No data</td>
                  </tr>
              @endif
            </tbody>
          </table>
          @if ($delivery->lastPage() > 1)
          <div class="btn-group" role="group" aria-label="Basic example">
          </div>
          @endif
          <div class="btn-group mt-4" role="group" aria-label="Basic example">
            <a href="{{ $delivery->url($delivery->currentPage()-1) }}" type="button" class="btn btn-outline-secondary {{ ($delivery->currentPage() == 1) ? ' disabled' : '' }}"><</a>
            @for ($i = 1; $i <= $delivery->lastPage(); $i++)
            <a href="{{ $delivery->url($i) }}" type="button" class="btn btn-outline-secondary{{ ($delivery->currentPage() == $i) ? ' active' : '' }}">{{ $i }}</a>
            @endfor
            <a href="{{ $delivery->url($delivery->currentPage()+1) }}" type="button" class="btn btn-outline-secondary{{ ($delivery->currentPage() == $delivery->lastPage()) ? ' disabled' : '' }}">></a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection