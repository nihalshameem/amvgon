<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex justify-content-center">
<div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
  <a class="navbar-brand brand-logo" href="{{url('/admin')}}"><img src="{{asset($store->image)}}" alt="logo"/></a>
  <a class="navbar-brand brand-logo-mini" href="{{url('/admin')}}"><img src="{{asset('images/logo/logo1.jpeg')}}" alt="logo"/></a>
  <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
    <span class="mdi mdi-sort-variant"></span>
  </button>
</div>  
</div>
<div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
<ul class="navbar-nav mr-lg-4 w-100">
  <li class="nav-item nav-search d-none d-lg-block w-100">
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text" id="search">
          <i class="mdi mdi-magnify"></i>
        </span>
      </div>
      <input type="text" class="form-control" placeholder="Search now" aria-label="search" aria-describedby="search">
    <div class="block">
            <ul class="search-list">
               <li class="empty">not found</li>
            </ul>
         </div>
    </div>
  </li>
</ul>
<ul class="navbar-nav navbar-nav-right">
  <li class="nav-item dropdown mr-4">
    <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown" id="notificationDropdown" href="#" data-toggle="dropdown">
      <i class="mdi mdi-bell mx-0"></i>
      <span class="count"></span>
    </a>
    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown" id="noti-drop">
      
      
    </div>
  </li>
  <li class="nav-item nav-profile dropdown">
    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
      <img src="{{asset(auth()->user()->image)}}" alt="profile"/>
      <span class="nav-profile-name">{{auth()->user()->name}}</span>
    </a>
    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
      <a href="/admin/profile" class="dropdown-item">
        <i class="mdi mdi-settings text-primary"></i>
        Settings
      </a>
      <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
        <i class="mdi mdi-logout text-primary"></i>
        Logout
      </a>
    </div>
  </li>
</ul>
<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
  <span class="mdi mdi-menu"></span>
</button>
</div>
</nav>
{{-- <script type="text/javascript">
    var path = "{{ route('autocomplete') }}";
    $('input.typeahead').typeahead({
        source:  function (query, process) {
        return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        }
    });
</script> --}}