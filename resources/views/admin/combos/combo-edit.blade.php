@extends('admin.layouts.master')

@section('title')
    Edit Combo Offer
@endsection

@section('content')
<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body"><div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          <div class="mr-md-3 mr-xl-5">
            <h2>Edit #{{$combo->id}}</h2>
          </div>
          <div class="d-flex">
            <i class="mdi mdi-home text-muted hover-cursor"></i>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin/combo-offers">combo-offer list&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a href="/admin/combo-offer/edit">edit combo</a></p>
          </div>
        </div>
      </div>
        <form class="form-sample" method="POST" action="/admin/combo-offer/update/{{$combo->id}}" enctype="multipart/form-data">
            @csrf
          <p class="card-description">
            General
          </p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" value="{{ $combo->name }}"/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Discount</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control form-control-sm @error('discount') is-invalid @enderror" name="discount" id="discount" min="0" max="100" value="{{ $combo->discount }}"/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">No. of Products</label>
                <div class="col-sm-9">
                  <select class="form-control form-control-sm" name="product_count" id="pCount">
                    <option value="2" {{$combo->product_count == 2 ? 'selected':''}}>2</option>
                    <option value="3" {{$combo->product_count == 3 ? 'selected':''}}>3</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Expiry Date</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control form-control-sm @error('expiry_date') is-invalid @enderror" name="expiry_date" id="expiry_date" min="0" value="{{date('Y-m-d', strtotime($combo->expiry_date))}}"/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
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
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Preview</label>
                <div class="col-sm-9">
                  <img id="blah" src="{{asset($combo->image)}}" alt="" alt="preview" width="50">
                </div>
              </div>
            </div>
          </div>
          <p class="card-description">
            Product Details
          </p>
          <div class="row" id="c1">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Product - 1</label>
                <input type="text" name="detail0" value="{{$combo->detail_id[0]}}" hidden>
                <div class="col-sm-9">
                  <select class="form-control form-control-sm @error('product_id0') is-invalid @enderror" name="product_id0">
                    <option value="" disabled selected>Choose one</option>
                    @foreach ($products as $item)
                        <option value="{{$item->id}}"{{$combo->product_id[0] == $item->id ? 'selected':''}}>{{$item->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Price type</label>
                <div class="col-sm-9">
                    <select class="form-control form-control-sm @error('type0') is-invalid @enderror" name="type0">
                      <option value="" disabled selected>Choose one</option>
                        <option value="normal"{{$combo->type[0] == 'normal' ? 'selected':''}}>normal</option>
                        <option value="standard"{{$combo->type[0] == 'standard' ? 'selected':''}}>standard</option>
                        <option value="excellent"{{$combo->type[0] == 'excellent' ? 'selected':''}}>excellent</option>
                    </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row" id="c2">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Product - 2</label>
                <input type="text" name="detail1" value="{{$combo->detail_id[1]}}" hidden>
                <div class="col-sm-9">
                  <select class="form-control form-control-sm @error('product_id1') is-invalid @enderror" name="product_id1">
                    <option value="" disabled selected>Choose one</option>
                    @foreach ($products as $item)
                        <option value="{{$item->id}}"{{$combo->product_id[1] == $item->id ? 'selected':''}}>{{$item->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Price type</label>
                <div class="col-sm-9">
                    <select class="form-control form-control-sm @error('type1') is-invalid @enderror" name="type1">
                        <option value="" disabled selected>Choose one</option>
                          <option value="normal"{{$combo->type[1] == 'normal' ? 'selected':''}}>normal</option>
                          <option value="standard"{{$combo->type[1] == 'standard' ? 'selected':''}}>standard</option>
                          <option value="excellent"{{$combo->type[1] == 'excellent' ? 'selected':''}}>excellent</option>
                    </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row" id="c3" {{$combo->product_count == 3 ? '':'hidden'}}>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Product - 3</label>
                <input type="text" name="detail2" value="{{$combo->detail_id[2]}}" hidden>
                <div class="col-sm-9">
                  <select class="form-control form-control-sm" name="product_id2">
                    <option value="" disabled selected>Choose one</option>
                    @foreach ($products as $item)
                        <option value="{{$item->id}}"{{$combo->product_id[2] == $item->id ? 'selected':''}}>{{$item->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Price type</label>
                <div class="col-sm-9">
                    <select class="form-control form-control-sm" name="type2">
                        <option value="" disabled selected>Choose one</option>
                          <option value="normal"{{$combo->type[2] == 'normal' ? 'selected':''}}>normal</option>
                          <option value="standard"{{$combo->type[2] == 'standard' ? 'selected':''}}>standard</option>
                          <option value="excellent"{{$combo->type[2] == 'excellent' ? 'selected':''}}>excellent</option>
                    </select>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mr-2" >Submit</button>
          <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
        </form>
        <form action="/admin/combo-offer/delete/{{$combo->id}}" method="post">
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