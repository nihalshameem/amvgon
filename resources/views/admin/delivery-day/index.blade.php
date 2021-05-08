@extends('admin.layouts.master')

@section('title')
    Customer
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap">
          <div class="d-flex align-items-end flex-wrap">
            <div class="mr-md-3 mr-xl-5">
              <h2>Delivery Days</h2>
            </div>
            <div class="d-flex">
              <i class="mdi mdi-home text-muted hover-cursor"></i>
              <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a  href="/admin/delivery-day/setting">Delivery days</a></p>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Day</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($delivery_days as $item)
                  <tr>
                    <form action="{{url('/admin/delivery-day/update/'.$item->id)}}" method="post">
                        @csrf
                        <td>{{$item->name}}</td>
                    <td><input type="time" name="start" class="form-control form-control-sm" value="{{date('H:i', strtotime($item->start))}}" required></td>
                    <td><input type="time" name="end" class="form-control form-control-sm" value="{{date('H:i', strtotime($item->end))}}" required></td>
                    <td>
                        <select name="status" id="" class="form-control form-control-sm">
                            <option value="1" {{$item->status == 1 ? 'selected':''}}>ON</option>
                            <option value="0" {{$item->status == 0 ? 'selected':''}}>OFF</option>
                        </select>
                    </td>
                    <td>
                      <button type="submit" class="btn btn-sm btn-primary">Update</button>
                  </td>
                    </form>
                  
                  </tr>
              @endforeach
              @if ($delivery_days->isEmpty())
                  <tr>
                    <td colspan="10">No data</td>
                  </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection