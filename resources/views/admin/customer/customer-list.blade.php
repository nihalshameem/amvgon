@extends('admin.layouts.master')

@section('title')
    Customer
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap">
          <div class="d-flex align-items-end flex-wrap">
            <div class="mr-md-3 mr-xl-5">
              <h2>Customers List</h2>
            </div>
            <div class="d-flex">
              <i class="mdi mdi-home text-muted hover-cursor"></i>
              <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a  href="/admin/customers">customer list</a></p>
            </div>
          </div>
        </div>
        <form class="form-inline mt-3" method="POST" action="/admin/customer/search" enctype="multipart/form-data">
          @csrf
          <label class="sr-only" for="inlineFormInputName2">Search</label>
          <input type="text" class="form-control form-control-sm mb-2 mr-sm-2 " id="inlineFormInputName2" placeholder="Search..." name="cus_search" value="{{ $cus_search }}">
          <button type="submit" class="btn btn-sm btn-primary mb-2"><i class="mdi mdi-magnify"></i></button>
        </form>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Image</th>
                <th>Name</th>
                <th>email</th>
                <th>phone</th>
                <th>Details</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($customers as $item)
                  <tr>
                    <td><img src="{{asset($item->image)}}" alt=""></td>
                    <td>{{$item->first_name}} {{$item->last_name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->phone}}</td>
                    <td>
                      <a href="/admin/customer/detail/{{$item->id}}" type="button" class="btn btn-sm btn-inverse-dark"><i class="mdi mdi-eye"></i></a>
                  </td>
                  
                  </tr>
              @endforeach
              @if ($customers->isEmpty())
                  <tr>
                    <td colspan="10">No data</td>
                  </tr>
              @endif
            </tbody>
          </table>
          @if ($customers->lastPage() > 1)
          <div class="btn-group" role="group" aria-label="Basic example">
          </div>
          @endif
          <div class="btn-group mt-4" role="group" aria-label="Basic example">
            <a href="{{ $customers->url($customers->currentPage()-1) }}" type="button" class="btn btn-outline-secondary {{ ($customers->currentPage() == 1) ? ' disabled' : '' }}"><</a>
            @for ($i = 1; $i <= $customers->lastPage(); $i++)
            <a href="{{ $customers->url($i) }}" type="button" class="btn btn-outline-secondary{{ ($customers->currentPage() == $i) ? ' active' : '' }}">{{ $i }}</a>
            @endfor
            <a href="{{ $customers->url($customers->currentPage()+1) }}" type="button" class="btn btn-outline-secondary{{ ($customers->currentPage() == $customers->lastPage()) ? ' disabled' : '' }}">></a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection