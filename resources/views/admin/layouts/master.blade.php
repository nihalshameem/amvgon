<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Amazing | Admin | @yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-grid.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-reboot.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    
    <script src="{{asset('js/jquery.min.js')}}"></script>
</head>
<body class="admin-body">
    @php
    $store = App\Models\Store::find(1)
@endphp
    <div class="container-scroller">
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
        @include('admin.layouts.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('admin.layouts.sidebar')
            <div class="main-panel">
                <div class="page-loader">
                    <img src="{{asset('/images/admin-pl.gif')}}" alt="">
                </div>
                @yield('content')
                @include('admin.layouts.footer')
            </div>
        </div>
        
    </div>

    {{-- js --}}
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/vendor.bundle.base.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('js/template.js')}}"></script>
    <script src="{{asset('js/data-table.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables2.js')}}"></script>
    <script src="{{asset('js/dataTables.bootstrap42.js')}}"></script>
    <script src="{{asset('js/file-upload.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>
    @if(Request::url() === url('/admin'))
        <script src="{{asset('js/Chart.min.js')}}"></script>
        <script src="{{asset('js/off-canvas.js')}}"></script>
        <script src="{{asset('js/dashboard.js')}}"></script>
    @endif
</body>
</html>