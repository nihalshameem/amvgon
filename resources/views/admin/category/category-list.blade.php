@extends('admin.layouts.master')

@section('title')
    Categories
@endsection

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap">
          <div class="d-flex align-items-end flex-wrap">
            <div class="mr-md-3 mr-xl-5">
              <h2>Categories List</h2>
            </div>
            <div class="d-flex">
              <i class="mdi mdi-home text-muted hover-cursor"></i>
              <p class="text-muted mb-0 hover-cursor"><a  href="/admin">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</a></p>
            <p class="text-primary mb-0 hover-cursor"><a  href="/admin/category">category list</a></p>
            </div>
          </div>
        </div>
        <form class="form-inline mt-3" method="POST" action="/admin/category/add" enctype="multipart/form-data">
            @csrf
            <label class="sr-only" for="inlineFormInputName2">Category</label>
            <input type="text" class="form-control form-control-sm mb-2 mr-sm-2 @error('category') is-invalid @enderror" id="inlineFormInputName2" placeholder="Category" name="category" value="{{ old('category') }}">
          
            
            <div class=" mb-2 mr-sm-2">
                <div class="form-group row">
                  <label class="sr-only">Image</label>
                  <div class="col-sm-12">
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
            <button type="submit" class="btn btn-sm btn-primary mb-2">Add</button>
          </form>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Category ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Edit</th>
              </tr>
            </thead>
            <tbody>
              @if (!$categories->isEmpty())
              @foreach ($categories as $category)
              <tr>
                <td>{{$category->id}}</td>
                <td><img src="{{asset($category->image)}}" alt=""></td>
                <td>{{$category->name}}</td>
                <td>
                    <form id="edit-{{$category->id}}" action="/admin/category/edit/{{$category->id}}" method="get">
                    </form hidden>
                    <button type="submit" form="edit-{{$category->id}}" class="btn btn-sm btn-inverse-dark btn-icon"><i class="mdi mdi-pencil"></i></button>
                </td>
              
              </tr>
          @endforeach
              @else
                  <td colspan="10">No categories</td>
              @endif
            </tbody>
          </table>
          @if ($categories->lastPage() > 1)
          <div class="btn-group" role="group" aria-label="Basic example">
          </div>
          @endif
          <div class="btn-group mt-4" role="group" aria-label="Basic example">
            <a href="{{ $categories->url($categories->currentPage()-1) }}" type="button" class="btn btn-outline-secondary {{ ($categories->currentPage() == 1) ? ' disabled' : '' }}"><</a>
            @for ($i = 1; $i <= $categories->lastPage(); $i++)
            <a href="{{ $categories->url($i) }}" type="button" class="btn btn-outline-secondary{{ ($categories->currentPage() == $i) ? ' active' : '' }}">{{ $i }}</a>
            @endfor
            <a href="{{ $categories->url($categories->currentPage()+1) }}" type="button" class="btn btn-outline-secondary{{ ($categories->currentPage() == $categories->lastPage()) ? ' disabled' : '' }}">></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  
@endsection