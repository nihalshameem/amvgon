@extends('admin.layouts.master')

@section('title')
    Runner Salary Detail List
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap">
          <div class="d-flex align-items-end flex-wrap">
            <div class="mr-md-3 mr-xl-5">
              <h2>Runner Salary Detail List</h2>
            </div>
            <div class="d-flex">
              <i class="mdi mdi-home text-muted hover-cursor"></i>
              <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-muted mb-0 hover-cursor"><a  href="/admin/delivery-salaries">runner-salary list&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a  href="/admin/delivery-salaries">runner-salary detail list</a></p>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Sl. No.</th>
                <th>Order ID</th>
                <th>Distance</th>
                <th>Amount</th>
                <th>Order Total</th>
                <th>Edit</th>
              </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
              @if (!$details->isEmpty())
              @foreach ($details as $item)
              <tr>
                <td>{{$no++}}</td>
                <td>{{$item->delivery_id}}</td>
                <td>{{$item->distance}} km</td>
                <td>₹ {{$item->salary}}</td>
                <td>₹ {{$item->order_total}}</td>
                <td>
                    <a href="/admin/delivery-salary/{{$item->id}}" type="button" class="btn btn-sm btn-inverse-dark"><i class="mdi mdi-pencil"></i></a>
                </td>
              </tr>
          @endforeach
              @else
                  <td colspan="10">No data</td>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection