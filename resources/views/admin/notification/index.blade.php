@extends('admin.layouts.master')

@section('title')
    Send Notification
@endsection

@section('content')
<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          <div class="mr-md-3 mr-xl-5">
            <h2>Send Notification</h2>
          </div>
          <div class="d-flex">
            <i class="mdi mdi-home text-muted hover-cursor"></i>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a  href="/admin/send-notification">send-notification</a></p>
          </div>
        </div>
      </div>
        <form class="form-sample mt-3" method="POST" action="/admin/send-notification/submit" enctype="multipart/form-data">
            @csrf
          <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-sm-3">Title</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm @error('title') is-invalid @enderror" name="title"/>
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
                  <label class="col-sm-3">Body</label>
                  <div class="col-sm-9">
                    <textarea name="body" id="" cols="30" rows="5" class="form-control form-control-sm  @error('body') is-invalid @enderror"></textarea>
                  </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3">Preview</label>
                  <div class="col-sm-9">
                      <img id="blah" src="" alt="" alt="preview" width="50">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3">Product</label>
                  <div class="col-sm-9">
                    <select class="form-control form-control-s" name="product_id">
                        <option value="" disabled selected>Choose one</option>
                      @foreach ($products as $item)
                          <option value="{{$item->id}}">{{$item->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3">To</label>
                  <div class="col-sm-9">
                    <select class="form-control form-control-sm @error('status') is-invalid @enderror" name="to">
                        <option value="customer">Customers</option>
                        <option value="delivery">Delivery Boys</option>
                    </select>
                  </div>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
            </div>
          </div>
          <button type="submit" class="btn btn-primary mr-2">Submit</button>
          <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
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