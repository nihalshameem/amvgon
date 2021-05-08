@extends('admin.layouts.master')

@section('title')
    Edit Customer care
@endsection

@section('content')
<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body"><div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          <div class="mr-md-3 mr-xl-5">
            <h2>Edit Customer care #{{$care->id}}</h2>
          </div>
          <div class="d-flex">
            <i class="mdi mdi-home text-muted hover-cursor"></i>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin/districts">districts list&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a href="#">edit category</a></p>
          </div>
        </div>
      </div>
      @if ($errors->has('name'))
               <span class="invalid feedback text-danger"role="alert">
               {{ $errors->first('name') }}
               </span>
    @endif
      @if ($errors->has('phone'))
               <span class="invalid feedback text-danger"role="alert">
               {{ $errors->first('phone') }}
               </span>
    @endif
      <form class="form-inline mt-3" method="POST" action="/admin/customer-care/update/{{$care->id}}" enctype="multipart/form-data">
        @csrf
        <label class="sr-only" for="inlineFormInputname">Name</label>
        <input type="text" class="form-control form-control-sm mb-2 mr-sm-2" id="inlineFormInputname" placeholder="Name" name="name" value="{{$care->name}}">
        <label class="sr-only" for="inlineFormInputphone">Phone</label>
        <input type="text" class="form-control form-control-sm mb-2 mr-sm-2" id="inlineFormInputphone" placeholder="Phone" name="phone" value="{{$care->phone}}">
        <label class="sr-only" for="inlineFormInputUsecase">Usecase</label>
        <select class="form-control form-control-sm mb-2 mr-sm-2 @error('usecase') is-invalid @enderror" id="inlineFormInputUsecase" placeholder="Usecase" name="usecase">
          <option value="customer" {{$care->usecase == 'customer'?'selected':''}}>Customer</option>
          <option value="delivery-boy" {{$care->usecase == 'delivery-boy'?'selected':''}}>DeliveryBoy</option>
        </select>
        <button type="submit" class="btn btn-sm btn-primary mb-2">Update</button>
      </form>
      <form action="/admin/customer-care/delete/{{$care->id}}" method="post">
        @csrf
      <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-inverse-danger btn-icon float-right">
              <i class="mdi mdi-delete-forever"></i>
            </button>
      </form>
      </div>
    </div>
  </div>
@endsection