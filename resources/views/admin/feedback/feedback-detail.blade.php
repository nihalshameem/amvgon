@extends('admin.layouts.master')

@section('title')
    Feedback Details
@endsection

@section('content')
<div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body"><div class="d-flex justify-content-between flex-wrap">
        <div class="d-flex align-items-end flex-wrap">
          <div class="mr-md-3 mr-xl-5">
            <h2>Feedback Details#{{$feedback->id}}</h2>
          </div>
          <div class="d-flex">
            <i class="mdi mdi-home text-muted hover-cursor"></i>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin/feedback">feedback list&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a href="/admin/feedback/detail/{{$feedback->id}}">add delivery-boy details</a></p>
          </div>
        </div>
      </div>
      <div class="row mt-5">
          <div class="col-md-6">
              <table class="table">
                  <tbody>
                      <tr>
                          <td><b>Name</b></td>
                          <td>{{$feedback->name}}</td>
                      </tr>
                      <tr>
                          <td><b>Email</b></td>
                          <td>{{$feedback->email}}</td>
                      </tr>
                      <tr>
                          <td><b>Phone</b></td>
                          <td>{{$feedback->phone}}</td>
                      </tr>
                  </tbody>
              </table>
          </div>
          <div class="col-md-6">
              <label for=""><b>Message:</b></label>
              <p>{{$feedback->message}}</p>
          </div>
      </div>
      <form action="/admin/feedback/delete/{{$feedback->id}}" method="post">
        @csrf
      <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-inverse-danger btn-icon-text float-right"><i class="mdi mdi-delete-forever"></i>Delete</button>
      </form>
      </div>
    </div>
  </div>
@endsection