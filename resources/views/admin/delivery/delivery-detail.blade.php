@extends('admin.layouts.master')

@section('title')
    Runner boy Details
@endsection

@section('content')
<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body"><div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          <div class="mr-md-3 mr-xl-5">
            <h2>Runner #{{$delivery->id}}</h2>
          </div>
          <div class="d-flex">
            <i class="mdi mdi-home text-muted hover-cursor"></i>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin/delivery-boys">runners list&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a href="/admin/delivery-boys/detail/{{$delivery->id}}">add runner details</a></p>
          </div>
        </div>
        <div class="d-flex justify-content-between align-items-end flex-wrap">
          <button class="btn btn-sm btn-warning btn-icon mr-1" disabled>{{$delivery->rating}}</button>
            <button id="edit-btn" class="btn btn-sm btn-inverse-dark btn-icon mr-1">
                <i class="mdi mdi-pencil"></i>
              </button>
        </div>
      </div>
        <form class="form-sample" method="POST" action="/admin/delivery-boy/update/{{$delivery->id}}" enctype="multipart/form-data" id="delivery-form">
            @csrf
          <p class="card-description">
            General
          </p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" value="{{ $delivery->name }}" disabled/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Image</label>
                <div class="col-sm-9">
                    <img src="{{asset($delivery->image)}}" alt="preview" id="preview" width="70">
                  <div class="input-group col-xs-12" id="image" hidden>
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
                    <input type="text" class="form-control form-control-sm @error('phone') is-invalid @enderror" name="phone" value="{{ $delivery->phone }}" disabled/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Password</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" value="{{ $delivery->show_password }}" disabled/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Vehicle Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm @error('vehicle_name') is-invalid @enderror" name="vehicle_name" value="{{ $delivery->vehicle_name }}" disabled/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Vehicle No.</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm @error('vehicle_number') is-invalid @enderror" name="vehicle_number" value="{{ $delivery->vehicle_number }}" disabled/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">license</label>
                <div class="col-sm-9">
                    <a target="_blank" href="{{asset($delivery->license)}}" class="btn btn-sm btn-primary" id="prv-li">Open</a>
                    <div class="input-group col-xs-12" id="license" hidden>
                        <input type="file" name="license" class="file-upload-default-license">
                        <input type="text" class="form-control form-control-sm file-upload-info" disabled="" placeholder="Upload File">
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
                    <a target="_blank" href="{{asset($delivery->rc_book)}}" class="btn btn-sm btn-primary" id="prv-rc">Open</a>
                    <div class="input-group col-xs-12" id="rcbook" hidden>
                        <input type="file" name="rc_book" class="file-upload-default-rcbook">
                        <input type="text" class="form-control form-control-sm file-upload-info" disabled="" placeholder="Upload File">
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
                  <input type="text" class="form-control form-control-sm @error('door_no') is-invalid @enderror" name="door_no" value="{{ $delivery->door_no }}" disabled/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Village</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm @error('village') is-invalid @enderror" name="village" value="{{ $delivery->village }}" disabled/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">District</label>
                <div class="col-sm-9">
                  <select class="form-control form-control-sm @error('district') is-invalid @enderror" name="district" disabled>
                    @foreach ($districts as $district)
                        <option value="{{$district->id}}" {{$district->id == $delivery->district ? 'selected' : ''}}>{{$district->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Pincode</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm @error('pincode') is-invalid @enderror" name="pincode" value="{{ $delivery->pincode }}" disabled/>
                </div>
              </div>
            </div>
          </div>
          <div id="submit-btn" hidden>
            <button type="submit" class="btn btn-primary mr-2">Update</button>
            <button type="button" class="btn btn-light" id="cancel">Cancel</button>
          </div>
        </form>
        <form action="/admin/delivery-boy/delete/{{$delivery->id}}" method="post">
          @csrf
        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-inverse-danger btn-icon-text float-right"><i class="mdi mdi-delete-forever"></i>Delete</button>
        </form>
      </div>
    </div>
  </div>
  <script>
      $(document).ready(function(){
          $('#edit-btn').on('click',function(){
              $('#delivery-form .form-control').attr('disabled',false);
              $('#image').attr('hidden',false);
              $('#preview').attr('hidden',true);
              $('#license').attr('hidden',false);
              $('#prv-li').attr('hidden',true);
              $('#rcbook').attr('hidden',false);
              $('#prv-rc').attr('hidden',true);
              $('#submit-btn').attr('hidden',false);
              $(this).css('display','none');
          })
          $('#cancel').on('click',function(){
              $('#delivery-form .form-control').attr('disabled',true);
              $('#image').attr('hidden',true);
              $('#preview').attr('hidden',false);
              $('#license').attr('hidden',true);
              $('#prv-li').attr('hidden',false);
              $('#rcbook').attr('hidden',true);
              $('#prv-rc').attr('hidden',false);
              $('#submit-btn').attr('hidden',true);
              $('#edit-btn').css('display','block');
          })
      });
  </script>
@endsection