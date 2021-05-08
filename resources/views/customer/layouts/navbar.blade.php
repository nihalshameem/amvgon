@php
$navcats = App\Models\Category::all()->take(6);
$days = App\Models\DeliveryDay::where('status',1)->get();
if ($day == null) {
   $day = 'null';
}elseif ($day == 'today') {
   $day = 'today';
}else {
   $day = 'tomorrow';
}
@endphp
<nav class="navbar navbar-expand-lg">
   <a class="navbar-brand" href="{{ url('/') }}">
   <img src="{{ asset($store->image) }}" alt="_logo">
   </a>
   <button class="navbar-toggler" type="button" id="mobileBtn">
   <i class="mdi mdi-menu"></i>
   </button>
   <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
         <li
            class="nav-item {{ (Request::segment(1) === null || Request::segment(1) === 'today' || Request::segment(1) === 'tomorrow') ? 'active' : null }}">
            <a class="nav-link" href="{{ url('/') }}">Home</a>
         </li>
         <li
            class="nav-item {{ Request::segment(1) === 'products' ? 'active' : null }}">
            <a class="nav-link" href="{{ url('/products?day='.$day) }}">Products</a>
         </li>
         <li
            class="nav-item dropdown {{ Request::segment(1) === 'categories' ? 'active' : null }}">
            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
            Categories
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
               <a class="dropdown-item" href="{{ url('/categories/functions') }}">Function</a>
               <a class="dropdown-item" href="{{ url('/categories/hotels') }}">Hotel</a>
            </div>
         </li>
         @guest('customer')
         @else
         <li
            class="nav-item {{ Request::segment(2) === 'orders' ? 'active' : null }}">
            <a class="nav-link" href="{{ url('/customer/orders') }}">Orders</a>
         </li>
         <li
            class="nav-item {{ Request::segment(2) === 'carts' ? 'active' : null }}">
            <a class="nav-link" href="{{ url('/customer/carts?day='.$day) }}">Carts</a>
         </li>
         @endguest
         <li class="lap-day">
            <select name="" id="daySelect" class="form-control form-control-sm mt-2" {{ Request::segment(1) === 'login' ? 'hidden' : '' }}>
               @foreach ($days as $d)
                  <option value="{{$d->name}}" {{$day == $d->name ? 'selected': ''}}>{{$d->name}}</option>
               @endforeach
               @if ($days == null)
                   <option value=""></option>
               @endif
            </select>
         </li>
      </ul>
      <div class="form-inline justify-content-center nav-search" style="text-align: center;">
         <i class="mdi mdi-magnify"></i>
         <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
         <div class="block">
            <ul class="search-list">
               <li class="empty">not found</li>
            </ul>
         </div>
         {{-- <button class="btn btn-cus-outline my-2 my-sm-0" type="button"><i class="mdi mdi-magnify"></i></button> --}}
      </div>
      <ul class="navbar-nav">
         @guest('customer')
         <li class="nav-item">
            <a class="nav-link" href="{{ url('/login/customer') }}">Login/Register</a>
         </li>
         @else
         <li class="nav-item dropdown">
            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
            <img src="{{auth('customer')->user()->image}}" alt="" class="nav-img">
            {{ auth('customer')->user()->first_name }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
               <a class="dropdown-item" href="{{ url('/customer') }}">Profile</a>
               <div class="dropdown-divider"></div>
               <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
               {{ __('Logout') }}
               </a>
               <form id="logout-form" action="{{ route('logout') }}" method="POST"
                  class="d-none">
                  @csrf
               </form>
            </div>
         </li>
         @endguest
      </ul>
   </div>
</nav>