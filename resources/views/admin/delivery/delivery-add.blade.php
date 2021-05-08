@extends('admin.layouts.master')

@section('title')
    Add Runner
@endsection

@section('content')
<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body"><div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          <div class="mr-md-3 mr-xl-5">
            <h2>Add New</h2>
          </div>
          <div class="d-flex">
            <i class="mdi mdi-home text-muted hover-cursor"></i>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin/delivery-boys">runners list&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a href="/admin/delivery-boys/add">add runner</a></p>
          </div>
        </div>
      </div>
        <form class="form-sample" method="POST" action="/admin/delivery-boy/add/submit" enctype="multipart/form-data">
            @csrf
          <p class="card-description">
            General
          </p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Image</label>
                <div class="col-sm-9">
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
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Phone</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Password</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}"/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Vehicle Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm @error('vehicle_name') is-invalid @enderror" name="vehicle_name" value="{{ old('vehicle_name') }}"/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Vehicle No.</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm @error('vehicle_number') is-invalid @enderror" name="vehicle_number" value="{{ old('vehicle_number') }}"/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">license</label>
                <div class="col-sm-9">
                    <div class="input-group col-xs-12">
                        <input type="file" name="license" class="file-upload-default-license">
                        <input type="text" class="form-control form-control-sm file-upload-info @error('license') is-invalid @enderror" disabled="" placeholder="Upload File">
                        <span class="input-group-append">
                          <button class="file-upload-browse-license btn btn-sm btn-primary" type="button">Upload</button>
                        </span>
                    </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">RC Book</label>
                <div class="col-sm-9">
                    <div class="input-group col-xs-12">
                        <input type="file" name="rc_book" class="file-upload-default-rcbook">
                        <input type="text" class="form-control form-control-sm file-upload-info @error('rc_book') is-invalid @enderror" disabled="" placeholder="Upload File">
                        <span class="input-group-append">
                          <button class="file-upload-browse-rcbook btn btn-sm btn-primary" type="button">Upload</button>
                        </span>
                      </div>
                </div>
              </div>
            </div>
          </div>
          <p class="card-description">
            Address details
          </p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Door no. & Street</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm @error('door_no') is-invalid @enderror" name="door_no" value="{{ old('door_no') }}"/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Village</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm @error('village') is-invalid @enderror" name="village" value="{{ old('village') }}"/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">District</label>
                <div class="col-sm-9">
                  <select class="form-control form-control-sm @error('district') is-invalid @enderror" name="district">
                    @foreach ($districts as $district)
                        <option value="{{$district->id}}">{{$district->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Pincode</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm @error('pincode') is-invalid @enderror" name="pincode" value="{{ old('pincode') }}"/>
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