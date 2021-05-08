@extends('admin.layouts.master')

@section('title')
    Add Product
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
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin/products">products list&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a href="/admin/products">add product</a></p>
          </div>
        </div>
      </div>
        <form class="form-sample" method="POST" action="/admin/products/add/submit" enctype="multipart/form-data">
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
                <label class="col-sm-3">Category</label>
                <div class="col-sm-9">
                  <select class="form-control form-control-sm @error('category') is-invalid @enderror" name="category">
                    <option value="Regular">Regular</option>
                    @foreach ($category as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3">Type</label>
                <div class="col-sm-9">
                  <select class="form-control form-control-sm @error('type') is-invalid @enderror" name="type">
                    @foreach ($product_type as $type)
                        <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Description</label>
                <div class="col-sm-9">
                    <textarea class="form-control form-control-sm @error('description') is-invalid @enderror" id="exampleTextarea1" rows="4" name="description">{{ old('description') }}</textarea>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Active</label>
                <div class="col-sm-9">
                  <select class="form-control form-control-sm" name="active">
                    <option value="1">ON</option>
                    <option value="0">OFF</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <p class="card-description">
            Normal Pricing
          </p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Cost</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control form-control-sm @error('cost') is-invalid @enderror" name="cost" id="cost" min="1" value="{{ old('cost') }}"/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Discount</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control form-control-sm @error('discount') is-invalid @enderror" name="discount" id="discount" value="0" min="0"/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Price</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" id="price"/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Stock</label>
                <div class="col-sm-5">
                  <input type="number" class="form-control form-control-sm stock @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock') }}" step="0.1" min="0"/>
                </div>
                <div class="col-md-4">
                  <select name="unit" class="form-control form-control-sm unit" readonly>
                    <option value="kg" selected>kg</option>
                    {{-- <option value="piece">piece</option> --}}
                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Minimum Qty</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control form-control-sm stock @error('min_qty') is-invalid @enderror" name="min_qty" value="{{ old('min_qty') }}" step="0.1" min="0"/>
                </div>
              </div>
            </div>
          </div>
          <p class="card-description">
            Standard Pricing
          </p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Cost</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control form-control-sm" name="standard_cost" id="standard_cost" min="1" value="{{ old('standard_cost') }}"/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Discount</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control form-control-sm" name="standard_discount" id="standard_discount" value="0" min="0"/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Price</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm" name="standard_price" value="{{ old('standard_price') }}" id="standard_price"/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Stock</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control form-control-sm stock @error('standard_stock') is-invalid @enderror" name="standard_stock" value="{{ old('standard_stock') }}" step="0.1" min="0"/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Minimum Qty</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control form-control-sm stock @error('standard_min_qty') is-invalid @enderror" name="standard_min_qty" value="{{ old('standard_min_qty') }}" step="0.1" min="0"/>
                </div>
              </div>
            </div>
          </div>
          <p class="card-description">
            Excellent Pricing
          </p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Cost</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control form-control-sm" name="excellent_cost" id="excellent_cost" min="1" value="{{ old('excellent_cost') }}"/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Discount</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control form-control-sm" name="excellent_discount" id="excellent_discount" value="0" min="0"/>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Price</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control form-control-sm" name="excellent_price" value="{{ old('excellent_price') }}" id="excellent_price"/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Stock</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control form-control-sm stock @error('excellent_stock') is-invalid @enderror" name="excellent_stock" value="{{ old('excellent_stock') }}" step="0.1" min="0"/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Minimum Qty</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control form-control-sm stock @error('excellent_min_qty') is-invalid @enderror" name="excellent_min_qty" value="{{ old('excellent_min_qty') }}" step="0.1" min="0"/>
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