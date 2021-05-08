@if (auth()->user()->role == 'SuperAdmin')
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="/admin">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/admin/order/purchase-list">
        <i class="mdi mdi-basket menu-icon"></i>
        <span class="menu-title">Purchase List</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/admin/storeInfo">
        <i class="mdi mdi-store menu-icon"></i>
        <span class="menu-title">Store Info</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/admin/categories">
        <i class="mdi mdi-library-books menu-icon"></i>
        <span class="menu-title">Categories</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/admin/products">
        <i class="mdi mdi-shopping menu-icon"></i>
        <span class="menu-title">Products</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/admin/functions">
        <i class="mdi mdi-alpha-f menu-icon"></i>
        <span class="menu-title">Functions</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/admin/hotels">
        <i class="mdi mdi-store menu-icon"></i>
        <span class="menu-title">Hotels</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/admin/orders">
        <i class="mdi mdi-cart menu-icon"></i>
        <span class="menu-title">Orders</span>
      </a>
    </li>
    {{-- <li class="nav-item">
      <a class="nav-link" href="/admin/rejects">
        <i class="mdi mdi-cart-off menu-icon"></i>
        <span class="menu-title">Order Rejects</span>
      </a>
    </li> --}}
    <li class="nav-item">
      <a class="nav-link" href="/admin/banners">
        <i class="mdi mdi-animation menu-icon"></i>
        <span class="menu-title">Banners</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/admin/offer-banners">
        <i class="mdi mdi-vector-arrange-below menu-icon"></i>
        <span class="menu-title">Offer Banners</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/admin/combo-offers">
        <i class="mdi mdi-plus-circle-multiple-outline menu-icon"></i>
        <span class="menu-title">Combo Offer</span>
      </a>
    </li>
    {{-- <li class="nav-item">
      <a class="nav-link" href="/admin/coupons">
        <i class="mdi mdi-barcode-scan menu-icon"></i>
        <span class="menu-title">Coupons</span>
      </a>
    </li> --}}
    <li class="nav-item">
      <a class="nav-link" href="/admin/customers">
        <i class="mdi mdi-account-outline menu-icon"></i>
        <span class="menu-title">Customers</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/admin/delivery-boys">
        <i class="mdi mdi-truck-delivery menu-icon"></i>
        <span class="menu-title">Runners</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/admin/delivery-salaries">
        <i class="mdi mdi-motorbike menu-icon"></i>
        <span class="menu-title">Runner Salary</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/admin/send-notification">
        <i class="mdi mdi-message-text-outline menu-icon"></i>
        <span class="menu-title">Send Notification</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/admin/feedback">
        <i class="mdi mdi-email menu-icon"></i>
        <span class="menu-title">FeedBack</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/admin/customer-cares">
        <i class="mdi mdi-headset menu-icon"></i>
        <span class="menu-title">Customer Cares</span>
      </a>
    </li>
  </ul>
</nav>
@elseif (auth()->user()->role == 'DeliveryAdmin')
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="/admin">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/admin/delivery-boys">
        <i class="mdi mdi-truck-delivery menu-icon"></i>
        <span class="menu-title">Runners</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/admin/delivery-salaries">
        <i class="mdi mdi-motorbike menu-icon"></i>
        <span class="menu-title">Runner Salary</span>
      </a>
    </li>
  </ul>
</nav>
@else
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="/admin">
        <i class="mdi mdi-home menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/admin/order/purchase-list">
        <i class="mdi mdi-basket menu-icon"></i>
        <span class="menu-title">Purchase List</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="/admin/orders">
        <i class="mdi mdi-cart menu-icon"></i>
        <span class="menu-title">Orders</span>
      </a>
    </li>
  </ul>
</nav>
@endif