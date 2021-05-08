@extends('admin.layouts.master')

@section('title')
    Admin Profile
@endsection

@section('content')
<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body"><div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          <div class="mr-md-3 mr-xl-5">
            <h2>Profile</h2>
          </div>
          <div class="d-flex">
            <i class="mdi mdi-home text-muted hover-cursor"></i>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a  href="/admin/products">profile</a></p>
          </div>
        </div>
      </div>
        <form class="form-sample" method="POST" action="/admin/profile/update" enctype="multipart/form-data">
            @csrf
          <p class="card-description">
            General
          </p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Logo</label>
                <div class="col-sm-9">
                    <div class="input-group col-xs-12">
                        <input type="file" name="image" class="file-upload-default">
                        <input type="text" class="form-control form-control-sm file-upload-info" disabled="" placeholder="Upload Image">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-sm btn-primary" type="button">Upload</button>
                        </span>
                      </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Preview</label>
                <div class="col-sm-9">
                  <img width="50" src="{{asset($admin->image)}}" alt="">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-3">Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" value="{{ $admin->name }}"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Email</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ $admin->email }}"/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-3">Phone</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control form-control-sm @error('phone') is-invalid @enderror" name="phone" value="{{ $admin->phone }}"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-3">Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" value=""/>
                    </div>
                </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mr-2">Submit</button>
          <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
        </form>
      </div>
    </div>
  </div>
@endsection