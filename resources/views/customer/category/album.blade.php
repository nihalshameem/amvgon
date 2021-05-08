@extends('customer.layouts.master')

@section('title')
    {{$title}}
@endsection

@section('content')
<style>
    .special{
        padding: 10px;
        border: 0.5px solid #d5d5d5;
        text-align: center;
        margin: 5px 0 5px 0;
    }
    .special img{
        width: 100%;
    }
    .special h5{
        margin-top: 12px;
        text-transform: capitalize;
    }
</style>
    <div class="container mt-5 mb-3">
        <h3 class="heading">{{$title}}</h3>
        @if (count($lists) == 0)
            <i>No {{$title}} available.</i>
        @endif
        @foreach ($lists as $item)
        <div class="special">
            <img src="{{asset($item->image)}}" alt="image">
            <h5>{{$item->name}}</h5>
        </div>
        @endforeach
    </div>
@endsection