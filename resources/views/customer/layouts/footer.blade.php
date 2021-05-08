<footer>
    <div class="row">
        <div class="col-md-4 mx-auto">
            <img src="{{asset($store->image)}}" alt="">
            <h5>{{$store->name}}</h5>
            <a href="{{url('/')}}">{{url('/')}}</a>
        </div>
        <div class="col-md-4 mx-auto">
            <h4 class="side-heading">CONTACTS</h4>
            <ul>
                <li>{{$store->door_no}}, {{$store->village}}</li>
                <li>{{$store->district}}-{{$store->pincode}}</li>
                <li>{{$store->state}}</li>
                <li>{{$store->country}}</li>
                <li><b>Phone:</b> {{$store->phone}}</li>
                <li><b>Email:</b> {{$store->email}}</li>
            </ul>
        </div>
        <div class="col-md-4 mx-auto">
            <h4 class="side-heading">Quick Links</h4>
            <ul>
                <li class="nav-item"><a href="{{url('/')}}">Home</a></li>
                <li class="nav-item"><a href="{{url('/products')}}">Products</a></li>
                <li class="nav-item"><a href="{{url('/categories')}}">Categories</a></li>
                @guest
                    @else
                    <li class="nav-item"><a href="{{url('/profile')}}">Account</a></li>
                    <li class="nav-item"><a href="{{url('/orders')}}">Orders</a></li>
                    <li class="nav-item"><a href="{{url('/customer/feedback')}}">Feedback</a></li>
                @endguest
            </ul>
        </div>
    </div>
</footer>