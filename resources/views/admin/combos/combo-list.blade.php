@extends('admin.layouts.master')

@section('title')
    Combo Offers
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap">
          <div class="d-flex align-items-end flex-wrap">
            <div class="mr-md-3 mr-xl-5">
              <h2>Combo Offers List</h2>
            </div>
            <div class="d-flex">
              <i class="mdi mdi-home text-muted hover-cursor"></i>
              <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a  href="/admin/combo-offers">combo offers list</a></p>
            </div>
          </div>
          <div class="d-flex justify-content-between align-items-end flex-wrap">
            <button href="" type="button" class="btn btn-light bg-white btn-icon mr-3 mt-2 mt-xl-0">
              <a href="/admin/combo-offer/add"> <i class="mdi mdi-plus text-muted"></i></a>
            </button>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Sl. no</th>
                <th>Name</th>
                <th>No. of products</th>
                <th>Discount</th>
                <th>Expiry date</th>
                <th>Edit</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = $combos->perPage() * ($combos->currentPage() - 1) + 1; ?>
              @foreach ($combos as $combo)
                  <tr>
                    <td>{{$no++}}</td>
                    <td>{{$combo->name}}</td>
                    <td>{{$combo->product_count}}</td>
                    <td>{{$combo->discount}}</td>
                    <td>{{date('j F, Y', strtotime($combo->expiry_date))}}</td>
                    <td>
                      <a href="/admin/combo-offer/{{$combo->id}}" type="button" class="btn btn-sm btn-inverse-dark"><i class="mdi mdi-pencil"></i>  </a>
                  </td>
                  </tr>
              @endforeach
              @if (count($combos) == 0)
                  <tr>
                      <td colspan="10">no combo offers</td>
                  </tr>
              @endif
            </tbody>
          </table>
          @if ($combos->lastPage() > 1)
          <div class="btn-group" role="group" aria-label="Basic example">
          </div>
          @endif
          <div class="btn-group mt-4" role="group" aria-label="Basic example">
            <a href="{{ $combos->url($combos->currentPage()-1) }}" type="button" class="btn btn-outline-secondary {{ ($combos->currentPage() == 1) ? ' disabled' : '' }}"><</a>
            @for ($i = 1; $i <= $combos->lastPage(); $i++)
            <a href="{{ $combos->url($i) }}" type="button" class="btn btn-outline-secondary{{ ($combos->currentPage() == $i) ? ' active' : '' }}">{{ $i }}</a>
            @endfor
            <a href="{{ $combos->url($combos->currentPage()+1) }}" type="button" class="btn btn-outline-secondary{{ ($combos->currentPage() == $combos->lastPage()) ? ' disabled' : '' }}">></a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection