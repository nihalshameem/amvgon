@extends('admin.layouts.master')

@section('title')
    Store Information
@endsection

@section('content')
<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body"><div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          <div class="mr-md-3 mr-xl-5">
            <h2>Store Info</h2>
          </div>
          <div class="d-flex">
            <i class="mdi mdi-home text-muted hover-cursor"></i>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a  href="/admin/products">store info</a></p>
          </div>
        </div>
      </div>
        <form class="form-sample" method="POST" action="/admin/storeInfo/update" enctype="multipart/form-data">
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
                  <img width="50" src="{{asset($store->image)}}" alt="">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-3">Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" value="{{ $store->name }}"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Email</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ $store->email }}"/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-3">Phone</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control form-control-sm @error('phone') is-invalid @enderror" name="phone" value="{{ $store->phone }}"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-3">Delivery</label>
                    <div class="col-sm-9">
                        <select name="delivery" id="" class="form-control form-control-sm">
                          <option value="auto" {{$store->delivery == 'auto' ? 'selected':''}}>auto</option>
                          <option value="manual" {{$store->delivery == 'manual' ? 'selected':''}}>manual</option>
                        </select>
                    </div>
                </div>
            </div>
          </div>
          <p class="card-description">
            Address
          </p>
          <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-3">Door no. & Street</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm @error('door_no') is-invalid @enderror" name="door_no" value="{{ $store->door_no }}"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-3">Village</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm @error('village') is-invalid @enderror" name="village" value="{{ $store->village }}"/>
                    </div>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-3">District</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm @error('district') is-invalid @enderror" name="district" value="{{ $store->district }}"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-3">Pincode</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm @error('pincode') is-invalid @enderror" name="pincode" value="{{ $store->pincode }}"/>
                    </div>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-3">State</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm @error('state') is-invalid @enderror" name="state" value="{{ $store->state }}"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-3">Country</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm @error('country') is-invalid @enderror" name="country" value="{{ $store->country }}"/>
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