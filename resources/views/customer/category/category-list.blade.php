@extends('customer.layouts.master')

@section('title')
    Categories
@endsection

@section('content')
    <div class="container mt-5 mb-3">
        <h3 class="heading">all categories</h3>
        <div class="row equaller">
            <div class="col-md-3">
                <div class="box">
                    <div><img src="{{asset('/images/category/root.png')}}" alt=""></div>
                    <h4><a href="{{url('/category/Regular')}}">Regular</a></h4>
                </div>
            </div>
            @foreach ($categories as $category)
                <div class="col-md-3">
                    <div class="box">
                        <div><img src="{{asset($category->image)}}" alt=""></div>
                        <h4><a href="{{url('/category/'.$category->id)}}">{{$category->name}}</a></h4>
                    </div>
                </div>
            @endforeach
        </div>
        @if ($categories->lastPage() > 1)
          <div class="btn-group" role="group" aria-label="Basic example">
          </div>
          @endif
          <div class="btn-group mt-4" role="group" aria-label="Basic example">
            <a href="{{ $categories->url($categories->currentPage()-1) }}" type="button" class="btn btn-outline-secondary {{ ($categories->currentPage() == 1) ? ' disabled' : '' }}"><i class="mdi mdi-chevron-left"></i></a>
            @for ($i = 1; $i <= $categories->lastPage(); $i++)
            <a href="{{ $categories->url($i) }}" type="button" class="btn btn-outline-secondary{{ ($categories->currentPage() == $i) ? ' active' : '' }}">{{ $i }}</a>
            @endfor
            <a href="{{ $categories->url($categories->currentPage()+1) }}" type="button" class="btn btn-outline-secondary{{ ($categories->currentPage() == $categories->lastPage()) ? ' disabled' : '' }}"><i class="mdi mdi-chevron-right"></i></a>
          </div>
    </div>
@endsection