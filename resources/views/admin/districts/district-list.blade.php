@extends('admin.layouts.master')

@section('title')
    Districts
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap">
          <div class="d-flex align-items-end flex-wrap">
            <div class="mr-md-3 mr-xl-5">
              <h2>districts List</h2>
            </div>
            <div class="d-flex">
              <i class="mdi mdi-home text-muted hover-cursor"></i>
              <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a  href="/admin/districts">district list</a></p>
            </div>
          </div>
        </div>
        <form class="form-inline" method="POST" action="/admin/district/add/submit">
            @csrf
            <label class="sr-only" for="inlineFormInputName2">District</label>
            <input type="text" class="form-control form-control-sm mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="District" name="district">
          
            <label class="sr-only" for="inlineFormInputGroupUsername2">Status</label>
            <select class="form-control form-control-sm mb-2 mr-sm-2" name="status">
                <option value="0">OFF</option>
                <option value="1">ON</option>
              </select>
            <button type="submit" class="btn btn-sm btn-primary mb-2">Add</button>
          </form>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>District ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Edit</th>
              </tr>
            </thead>
            <tbody>
              @if (!$districts->isEmpty())
              @foreach ($districts as $district)
              <tr>
                <td>{{$district->id}}</td>
                <td>{{$district->name}}</td>
                <td>
                    @switch($district->status)
                        @case(0)
                        <button type="button" class="btn btn-sm btn-danger btn-rounded btn-fw" disabled>OFF</button>
                            @break
                        @case(1)
                        <button type="button" class="btn btn-sm btn-success btn-rounded btn-fw" disabled>ON</button>
                            @break
                        @default
                            
                    @endswitch
                </td>
                <td>
                    <a href="/admin/district/edit/{{$district->id}}" type="button" class="btn btn-sm btn-inverse-dark"><i class="mdi mdi-pencil"></i></a>
                </td>
              </tr>
          @endforeach
              @else
                  <td colspan="10">No districts</td>
              @endif
            </tbody>
          </table>
          @if ($districts->lastPage() > 1)
          <div class="btn-group" role="group" aria-label="Basic example">
          </div>
          @endif
          <div class="btn-group mt-4" role="group" aria-label="Basic example">
            <a href="{{ $districts->url($districts->currentPage()-1) }}" type="button" class="btn btn-outline-secondary {{ ($districts->currentPage() == 1) ? ' disabled' : '' }}"><</a>
            @for ($i = 1; $i <= $districts->lastPage(); $i++)
            <a href="{{ $districts->url($i) }}" type="button" class="btn btn-outline-secondary{{ ($districts->currentPage() == $i) ? ' active' : '' }}">{{ $i }}</a>
            @endfor
            <a href="{{ $districts->url($districts->currentPage()+1) }}" type="button" class="btn btn-outline-secondary{{ ($districts->currentPage() == $districts->lastPage()) ? ' disabled' : '' }}">></a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection