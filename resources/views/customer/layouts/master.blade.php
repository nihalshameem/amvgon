<!DOCTYPE html>
<html lang="en">
@php
    $store = App\Models\Store::find(1);
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$store->name}} | @yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-grid.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-reboot.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/customer.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    
    <script src="{{asset('js/jquery.min.js')}}"></script>
    
</head>
<body>
<div class="mob-day"></div>
    <div class="pre-loader">
        <div class="gooey">
            <span class="dot"></span>
            <div class="dots">
              <span></span>
              <span></span>
              <span></span>
            </div>
          </div>
    </div>
    @include('customer.layouts.navbar')
    @if(Session::has('success'))
    <div class="notification success">
        <p><i class="mdi mdi-check-circle"></i> {{ Session::get('success') }}</p>
    </div>
@endif

@if(Session::has('error'))
<div class="notification error">
<p><i class="mdi mdi-alert-octagon"></i> {{ Session::get('error') }}</p>
</div>
@endif
    @yield('content')

    @include('customer.layouts.footer')

    <button class="btn btn-sm btn-info" id="toTop" data-toggle="tooltip" data-placement="top" title="Scroll To Top"></button>
    {{-- js --}}
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/customer.js')}}"></script>
</body>
</html>