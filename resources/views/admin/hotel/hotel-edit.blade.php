@extends('admin.layouts.master')

@section('title')
    Edit Hotel
@endsection

@section('content')
<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body"><div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          <div class="mr-md-3 mr-xl-5">
            <h2>Edit Hotel #{{$hotel->id}}</h2>
          </div>
          <div class="d-flex">
            <i class="mdi mdi-home text-muted hover-cursor"></i>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin/hotels">hotels list&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a href="#">edit hotel</a></p>
          </div>
        </div>
      </div>
      <form class="form-inline mt-3" method="POST" action="/admin/hotel/update/{{$hotel->id}}" enctype="multipart/form-data">
        @csrf
        <label class="sr-only" for="inlineFormInputName2">Name</label>
        <input type="text" class="form-control form-control-sm mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Name" name="name" value="{{$hotel->name}}">
      
        <div class=" mb-2 mr-sm-2">
            <div class="form-group row">
              <label class="sr-only">Image</label>
              <div class="col-sm-12">
                  <div class="input-group col-xs-12">
                      <input type="file" name="image" class="file-upload-default">
                      <input type="text" class="form-control form-control-sm file-upload-info @error('image') is-invalid @enderror" disabled="" placeholder="Upload Image">
                      <span class="input-group-append">
                        <button class="file-upload-browse btn btn-sm btn-primary" type="button">Upload</button>
                      </span>
                    </div>
              </div>
            </div>
          </div>
        <button type="submit" class="btn btn-sm btn-primary mb-2">Update</button>
      </form>
      <form action="/admin/hotel/delete/{{$hotel->id}}" method="post">
        @csrf
      <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-inverse-danger btn-icon float-right">
              <i class="mdi mdi-delete-forever"></i>
            </button>
      </form>
      </div>
    </div>
  </div>
@endsection