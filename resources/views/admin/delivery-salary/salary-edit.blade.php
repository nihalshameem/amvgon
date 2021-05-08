@extends('admin.layouts.master')

@section('title')
    Edit Runner Salary
@endsection

@section('content')
<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body"><div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          <div class="mr-md-3 mr-xl-5">
            <h2>Edit Runner Salary #{{$charge->id}}</h2>
          </div>
          <div class="d-flex">
            <i class="mdi mdi-home text-muted hover-cursor"></i>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin/delivery-salaries">runner-salary list&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a href="#">edit runner-salary</a></p>
          </div>
        </div>
      </div>
        <form class="form-sample" method="POST" action="/admin/delivery-salary/update/{{$charge->id}}" enctype="multipart/form-data">
            @csrf
          <p class="card-description">
            General
          </p>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Order ID</label>
                <div class="col-sm-9">
                    <select class="form-control form-control-sm @error('order_id') is-invalid @enderror" name="order_id">
                      @foreach ($orders as $item)
                          <option value="{{$item->id}}" {{$item->id == $charge->order_id ? 'selected' : ''}}>{{$item->id}}</option>
                      @endforeach
                    </select>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Runner</label>
                <div class="col-sm-9">
                  <select class="form-control form-control-sm @error('delivery_id') is-invalid @enderror" name="delivery_id">
                    @foreach ($delivery as $item)
                        <option value="{{$item->id}}" {{$item->id == $charge->delivery_id ? 'selected' : ''}}>{{$item->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Distance(km)</label>
                <div class="col-sm-9">
                  <input type="number" class="form-control form-control-sm @error('distance') is-invalid @enderror" name="distance" value="{{ $charge->distance }}"/>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3">Salary(₹)</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control form-control-sm @error('salary') is-invalid @enderror" name="salary" value="{{ $charge->salary }}"/>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mr-2">Submit</button>
          <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
        </form>
        <form action="/admin/delivery-salary/delete/{{$charge->id}}" method="post">
          @csrf
          <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-inverse-danger btn-icon-text float-right"><i class="mdi mdi-delete-forever"></i>Delete</button>
        </form>
      </div>
    </div>
  </div>
@endsection