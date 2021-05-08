@extends('admin.layouts.master')

@section('title')
    Edit District
@endsection

@section('content')
<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body"><div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          <div class="mr-md-3 mr-xl-5">
            <h2>Edit District #{{$district->id}}</h2>
          </div>
          <div class="d-flex">
            <i class="mdi mdi-home text-muted hover-cursor"></i>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin/districts">districts list&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a href="#">edit district</a></p>
          </div>
        </div>
      </div>
      <form class="form-inline" method="POST" action="/admin/district/update/{{$district->id}}">
        @csrf
        <label class="sr-only" for="inlineFormInputName2">District</label>
        <input type="text" class="form-control form-control-sm mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="District" name="district" value="{{$district->name}}">
      
        <label class="sr-only" for="inlineFormInputGroupUsername2">Status</label>
        <select class="form-control form-control-sm mb-2 mr-sm-2" name="status">
            <option value="0" {{$district->status === 0 ? 'selected' : ''}}>OFF</option>
            <option value="1" {{$district->status === 1 ? 'selected' : ''}}>ON</option>
          </select>
        <button type="submit" class="btn btn-sm btn-primary mb-2">Update</button>
      </form>
      <form action="/admin/district/delete/{{$district->id}}" method="post">
        @csrf
      <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-inverse-danger btn-icon float-right"><i class="mdi mdi-delete-forever"></i></button>
      </form>
      </div>
    </div>
  </div>
@endsection