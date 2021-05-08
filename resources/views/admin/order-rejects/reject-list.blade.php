@extends('admin.layouts.master')

@section('title')
    Reject List
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap">
          <div class="d-flex align-items-end flex-wrap">
            <div class="mr-md-3 mr-xl-5">
              <h2>Rejects List</h2>
            </div>
            <div class="d-flex">
              <i class="mdi mdi-home text-muted hover-cursor"></i>
              <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a  href="/admin/rejects">rejects list</a></p>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Sl. no</th>
                <th>Order ID</th>
                <th>Delivery Boy</th>
                <th>Phone</th>
                <th>Details</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = $rejects->perPage() * ($rejects->currentPage() - 1) + 1; ?>
              @foreach ($rejects as $item)
                  <tr>
                    <td>{{$no++}}</td>
                    <td>{{$item->order_id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->phone}}</td>
                    <td>
                      <a href="/admin/reject/{{$item->id}}" type="button" class="btn btn-sm btn-inverse-dark"><i class="mdi mdi-eye btn-icon-append"></i>                          
                    </a>
                  </td>
                  
                  </tr>
              @endforeach
              @if (count($rejects) == 0)
                  <tr>
                    <td colspan="10">no data</td>
                  </tr>
              @endif
            </tbody>
          </table>
          @if ($rejects->lastPage() > 1)
          <div class="btn-group" role="group" aria-label="Basic example">
          </div>
          @endif
          <div class="btn-group mt-4" role="group" aria-label="Basic example">
            <a href="{{ $rejects->url($rejects->currentPage()-1) }}" type="button" class="btn btn-outline-secondary {{ ($rejects->currentPage() == 1) ? ' disabled' : '' }}"><</a>
            @for ($i = 1; $i <= $rejects->lastPage(); $i++)
            <a href="{{ $rejects->url($i) }}" type="button" class="btn btn-outline-secondary{{ ($rejects->currentPage() == $i) ? ' active' : '' }}">{{ $i }}</a>
            @endfor
            <a href="{{ $rejects->url($rejects->currentPage()+1) }}" type="button" class="btn btn-outline-secondary{{ ($rejects->currentPage() == $rejects->lastPage()) ? ' disabled' : '' }}">></a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection