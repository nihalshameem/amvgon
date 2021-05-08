@extends('admin.layouts.master')

@section('title')
    Products
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap">
          <div class="d-flex align-items-end flex-wrap">
            <div class="mr-md-3 mr-xl-5">
              <h2>Products List</h2>
            </div>
            <div class="d-flex">
              <i class="mdi mdi-home text-muted hover-cursor"></i>
              <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a  href="/admin/products">products list</a></p>
            </div>
          </div>
          <div class="d-flex justify-content-between align-items-end flex-wrap">
            <button href="" type="button" class="btn btn-light bg-white btn-icon mr-3 mt-2 mt-xl-0">
              <a href="/admin/products/add"> <i class="mdi mdi-plus text-muted"></i></a>
            </button>
            <a class="btn btn-dark mr-3 mt-2 mt-xl-0" href="/admin/products/update-price">Update price</a>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Sl. no</th>
                <th>Image</th>
                <th>Name</th>
                <th>Active</th>
                <th>Price(E/S/N)</th>
                <th>Excellent Stock</th>
                <th>Standard Stock</th>
                <th>Normal Stock</th>
                <th>Edit</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = $products->perPage() * ($products->currentPage() - 1) + 1; ?>
              @foreach ($products as $product)
                  <tr class="{{($product->stock <= 10 ||$product->standard_stock <= 10 ||$product->excellent_stock <= 10) ? 'low-qty' : '' }}">
                    <td>{{$no++}}</td>
                    <td><img src="{{asset($product->image)}}" alt=""></td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->active == 1 ? 'ON':'OFF'}}</td>
                    <td>{{$product->excellent_price}}/{{$product->standard_price}}/{{$product->price}}</td>
                    <td>{{$product->excellent_stock.' '.$product->unit}}</td>
                    <td>{{$product->standard_stock.' '.$product->unit}}</td>
                    <td>{{$product->stock.' '.$product->unit}}</td>
                    <td>
                      <a href="/admin/product/{{$product->id}}" type="button" class="btn btn-sm btn-inverse-dark">
                      <i class="mdi mdi-pencil"></i>                          
                    </a>
                  </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
          @if ($products->lastPage() > 1)
          <div class="btn-group" role="group" aria-label="Basic example">
          </div>
          @endif
          <div class="btn-group mt-4" role="group" aria-label="Basic example">
            <a href="{{ $products->url($products->currentPage()-1) }}" type="button" class="btn btn-outline-secondary {{ ($products->currentPage() == 1) ? ' disabled' : '' }}"><</a>
            @for ($i = 1; $i <= $products->lastPage(); $i++)
            <a href="{{ $products->url($i) }}" type="button" class="btn btn-outline-secondary{{ ($products->currentPage() == $i) ? ' active' : '' }}">{{ $i }}</a>
            @endfor
            <a href="{{ $products->url($products->currentPage()+1) }}" type="button" class="btn btn-outline-secondary{{ ($products->currentPage() == $products->lastPage()) ? ' disabled' : '' }}">></a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection