@extends('admin.layouts.master')

@section('title')
    Banners
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap">
          <div class="d-flex align-items-end flex-wrap">
            <div class="mr-md-3 mr-xl-5">
              <h2>Banners List</h2>
            </div>
            <div class="d-flex">
              <i class="mdi mdi-home text-muted hover-cursor"></i>
              <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a  href="/admin/banners">banners list</a></p>
            </div>
          </div>
          <div class="d-flex justify-content-between align-items-end flex-wrap">
            <button href="" type="button" class="btn btn-light bg-white btn-icon mr-3 mt-2 mt-xl-0">
              <a href="/admin/banner/add"> <i class="mdi mdi-plus text-muted"></i></a>
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
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = $banners->perPage() * ($banners->currentPage() - 1) + 1; ?>
              @if (!$banners->isEmpty())
              @foreach ($banners as $banner)
              <tr>
                <td>{{$no++}}</td>
                <td><img src="{{asset($banner->image)}}" alt=""></td>
                <td>{{$banner->name}}</td>
                <td>
                  @switch($banner->status)
                      @case(1)
                          <button type="button" class="btn btn-sm btn-success btn-rounded btn-fw" disabled>ON</button>
                          @break
                      @case(0)
                          <button type="button" class="btn btn-sm btn-danger btn-rounded btn-fw" disabled>OFF</button>
                          @break
                      @default
                          
                  @endswitch
                </td>
                <td>
                  <a href="/admin/banner/{{$banner->id}}" type="button" class="btn btn-sm btn-inverse-dark"><i class="mdi mdi-pencil btn-icon-append"></i> </a>
              </td>
              
              </tr>
          @endforeach
              @else
                  <td colspan="10">No data</td>
              @endif
              
            </tbody>
          </table>
          @if ($banners->lastPage() > 1)
          <div class="btn-group" role="group" aria-label="Basic example">
          </div>
          @endif
          <div class="btn-group mt-4" role="group" aria-label="Basic example">
            <a href="{{ $banners->url($banners->currentPage()-1) }}" type="button" class="btn btn-outline-secondary {{ ($banners->currentPage() == 1) ? ' disabled' : '' }}"><</a>
            @for ($i = 1; $i <= $banners->lastPage(); $i++)
            <a href="{{ $banners->url($i) }}" type="button" class="btn btn-outline-secondary{{ ($banners->currentPage() == $i) ? ' active' : '' }}">{{ $i }}</a>
            @endfor
            <a href="{{ $banners->url($banners->currentPage()+1) }}" type="button" class="btn btn-outline-secondary{{ ($banners->currentPage() == $banners->lastPage()) ? ' disabled' : '' }}">></a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection