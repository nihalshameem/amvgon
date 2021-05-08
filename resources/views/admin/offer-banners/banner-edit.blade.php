@extends('admin.layouts.master')

@section('title')
    Offer Banner Edit
@endsection

@section('content')
<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          <div class="mr-md-3 mr-xl-5">
            <h2>Edit Offer Banner #{{$banner->id}}</h2>
          </div>
          <div class="d-flex">
            <i class="mdi mdi-home text-muted hover-cursor"></i>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin">banners&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a  href="/admin/products">edit offer-banner</a></p>
          </div>
        </div>
      </div>
        <form class="form-sample mt-3" method="POST" action="/admin/offer-banner/edit/{{$banner->id}}" enctype="multipart/form-data">
            @csrf
          <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-3">Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" value="{{$banner->name}}"/>
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
                  <label class="col-sm-3">Status</label>
                  <div class="col-sm-9">
                    <select class="form-control form-control-sm @error('status') is-invalid @enderror" name="status">
                      <option value="0" {{ $banner->status === 0 ? 'selected' : '' }}>OFF</option>
                      <option value="1" {{ $banner->status === 1 ? 'selected' : '' }}>ON</option>
                    </select>
                  </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3">Preview</label>
                  <div class="col-sm-9">
                      <img id="blah" src="{{asset($banner->image)}}" alt="" alt="preview" width="50">
                  </div>
                </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mr-2">Submit</button>
          <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
        </form>
        <form action="/admin/offer-banner/detele/{{$banner->id}}" method="post">
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