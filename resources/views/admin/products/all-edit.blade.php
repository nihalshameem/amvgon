@extends('admin.layouts.master')

@section('title')
    Upadate Products Price
@endsection

@section('content')
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="d-flex align-items-end flex-wrap">
                        <div class="mr-md-3 mr-xl-5">
                            <h2>Update Products Price</h2>
                        </div>
                        <div class="d-flex">
                            <i class="mdi mdi-home text-muted hover-cursor"></i>
                            <p class="text-muted mb-0 hover-cursor"><a href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a>
                            </p>
                            <p class="text-muted mb-0 hover-cursor"><a href="/admin/products">products list&nbsp;/&nbsp;</a>
                            </p>
                            <p class="text-primary mb-0 hover-cursor"><a href="/admin/products/update-price">update-price</a></p>
                        </div>
                    </div>
                </div>
                <form action="/admin/products/submit-all" method="POST">
                    @csrf

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Sl.No.</th>
                                    <th>Name</th>
                                    <th>Excellent Price</th>
                                    <th>Excellent Discount</th>
                                    <th>Excellent Stock</th>
                                    <th>Standard Price</th>
                                    <th>Standard Discount</th>
                                    <th>Standard Stock</th>
                                    <th>Normal Price</th>
                                    <th>Normal Discount</th>
                                    <th>Normal Stock</th>
                                    
                                    
                                </tr>
                            </thead>
    
                            <tbody>
                                @php
                                    $no = 1
                                @endphp
                                @foreach ($products as $product)
                                    <tr>
                                        <th scope="row">
                                            {{ $no++ }}
    
                                            <input type="hidden" name="products[{{ $product->getKey() }}][id]"
                                                value="{{ $product->getKey() }}">
                                        </th>
    
                                        <td>{{ $product->name }}</td>
    
                                       
                                        <td>
                                            <input class="form-control-sm" type="number" name="products[{{ $product->getKey() }}][excellent_price]"
                                                value="{{ old("products.{$product->getKey()}.excellent_price", $product->excellent_price) }}" step="any">
    
                                            @error("products.{$product->getKey()}.excellent_price")
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </td>
    
                                        <td>
                                            <input class="form-control-sm" type="number" name="products[{{ $product->getKey() }}][excellent_discount]"
                                                value="{{ old("products.{$product->getKey()}.excellent_discount", $product->excellent_discount) }}">
    
                                            @error("products.{$product->getKey()}.excellent_discount")
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </td>
    
                                        <td>
                                            <input class="form-control-sm" type="number" name="products[{{ $product->getKey() }}][excellent_stock]"
                                                value="{{ old("products.{$product->getKey()}.excellent_stock", $product->excellent_stock) }}" step="any">
    
                                            @error("products.{$product->getKey()}.excellent_stock")
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </td>
    
                                        <td>
                                            <input class="form-control-sm" type="number" name="products[{{ $product->getKey() }}][standard_price]"
                                                value="{{ old("products.{$product->getKey()}.standard_price", $product->standard_price) }}" step="any">
    
                                            @error("products.{$product->getKey()}.standard_price")
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </td>
    
                                        <td>
                                            <input class="form-control-sm" type="number" name="products[{{ $product->getKey() }}][standard_discount]"
                                                value="{{ old("products.{$product->getKey()}.standard_discount", $product->standard_discount) }}">
    
                                            @error("products.{$product->getKey()}.standard_discount")
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </td>
                                        
                                          <td>
                                            <input class="form-control-sm" type="number" name="products[{{ $product->getKey() }}][standard_stock]"
                                                value="{{ old("products.{$product->getKey()}.standard_stock", $product->standard_stock) }}" step="any">
    
                                            @error("products.{$product->getKey()}.standard_stock")
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </td>
     <td>
                                            <input class="form-control-sm" type="number" name="products[{{ $product->getKey() }}][price]"
                                                value="{{ old("products.{$product->getKey()}.price", $product->price) }}" step="any">
    
                                            @error("products.{$product->getKey()}.price")
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </td>
    
                                        <td>
                                            <input class="form-control-sm" type="number" name="products[{{ $product->getKey() }}][discount]"
                                                value="{{ old("products.{$product->getKey()}.discount", $product->discount) }}">
    
                                            @error("products.{$product->getKey()}.discount")
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </td>
                                        
                                        <td>
                                            <input class="form-control-sm" type="number" name="products[{{ $product->getKey() }}][stock]"
                                                value="{{ old("products.{$product->getKey()}.stock", $product->stock) }}" step="any">
    
                                            @error("products.{$product->getKey()}.stock")
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
    
                        <hr>
                    </div>
    
                        <button type="submit" class="btn btn-sm btn-primary">
                            Save
                        </button>
                </form>
            </div>
        </div>
    </div>
@endsection
