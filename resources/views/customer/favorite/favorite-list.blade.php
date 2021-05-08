@extends('customer.layouts.master')

@section('title')
    Favorites
@endsection

@section('content')
    <div class="container mt-5 mb-3">
        <h3 class="heading">Favorites</h3>
        <table class="table table-striped">
            <thead>
                <tr class="text-center">
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($favorites as $fav)
                    <tr class="text-center">
                        <td><img src="{{asset($fav->image)}}" alt="" width="50"></td>
                        <td><a href="{{url('/product/'.$fav->product_id)}}">{{$fav->name}}</a></td>
                        <td>{{$fav->category_name}}</td>
                        <td><a href="{{url('/favorite/delete/'.$fav->id)}}" data-toggle="tooltip" data-placement="top" title="Delete from favorite" class="text-danger"><i class="mdi mdi-close"></i></a></td>
                    </tr>
                @endforeach
                @if (count($favorites) == 0)
                    <tr>
                        <td colspan="10">No favorites</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-default mt-2"><i class="mdi mdi-chevron-double-left"></i> Go Back</a>
        <form action="{{url('/customer/favorite/clear')}}" method="post" id="favClear" hidden>
            @csrf
        </form>
        <button type="submit" form="favClear" class="btn btn-sm btn-danger float-right">Clear all</button>
    </div>
@endsection