@foreach ($products as $item)
<li><a href="{{url('/admin/product/'.$item->id)}}">{{$item->name}}</a></li>
@endforeach
@foreach ($categories as $item)
<li><a href="{{url('/admin/category/edit/'.$item->id)}}">{{$item->name}}</a></li>
@endforeach
@foreach ($customers as $item)
<li><a href="{{url('/admin/customer/detail/'.$item->id)}}">{{$item->first_name.' '.$item->last_name}}</a></li>
@endforeach
@foreach ($districts as $item)
<li><a href="{{url('/admin/district/edit/'.$item->id)}}">{{$item->name}}</a></li>
@endforeach
@foreach ($delivery_boys as $item)
<li><a href="{{url('/admin/delivery-boy/detail/'.$item->id)}}">{{$item->name}}</a></li>
@endforeach
@if (count($products) == 0 && count($categories) == 0 && count($customers) == 0 && count($districts) == 0 && count($categories) == 0)
    <li class="empty">not found</li>
@endif