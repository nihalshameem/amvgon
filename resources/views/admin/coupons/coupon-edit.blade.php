@extends('admin.layouts.master')

@section('title')
    Edit Coupon
@endsection

@section('content')
<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          <div class="mr-md-3 mr-xl-5">
            <h2>Edit Coupon #{{$coupon->id}}</h2>
          </div>
          <div class="d-flex">
            <i class="mdi mdi-home text-muted hover-cursor"></i>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin/coupons">coupons&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a  href="/admin/coupon/{{$coupon->id}}">edit coupon</a></p>
          </div>
        </div>
      </div>
        <form class="form-sample mt-3" method="POST" action="/admin/coupon/update/{{$coupon->id}}" enctype="multipart/form-data">
            @csrf
          <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-3">Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" value="{{ $coupon->name }}"/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Image</label>
                <div class="col-sm-9">
                    <div class="input-group col-xs-12">
                        <input type="file" name="image" class="file-upload-default" id="imgInp" >
                        <input type="text" class="form-control form-control-sm file-upload-info  @error('image') is-invalid @enderror" disabled="" placeholder="Upload Image">
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
                  <label class="col-sm-3">Code</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control form-control-sm @error('code') is-invalid @enderror" name="code" value="{{ $coupon->code }}"/>
                  </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3">Preview</label>
                  <div class="col-sm-9">
                      <img id="blah" src="{{asset($coupon->image)}}" alt="" alt="preview" width="50">
                  </div>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3">Min Price</label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control form-control-sm @error('min_price') is-invalid @enderror" name="min_price" value="{{ $coupon->min_price }}"/>
                  </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3">Max Price</label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control form-control-sm @error('max_price') is-invalid @enderror" name="max_price" value="{{ $coupon->max_price }}"/>
                  </div>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3">Discount</label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control form-control-sm @error('discount') is-invalid @enderror" name="discount" value="{{ $coupon->discount }}"/>
                  </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3">Start Date</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control form-control-sm @error('start_date') is-invalid @enderror" name="start_date" value="{{ $coupon->start_date }}"/>
                  </div>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3">End Date</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control form-control-sm @error('end_date') is-invalid @enderror" name="end_date" value="{{ $coupon->end_date }}"/>
                  </div>
                </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mr-2">Submit</button>
          <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
        </form>
        <form action="/admin/coupon/delete/{{$coupon->id}}" method="post">
          @csrf
        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-inverse-danger btn-icon-text float-right"><i class="mdi mdi-delete-forever"></i>Delete</button>
        </form>
      </div>
    </div>
  </div>
<script>
    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function(){
    readURL(this);
});
</script>
@endsection