@foreach ($products as $item)
<li><a class="search-link" href="{{url('product/'.$item->id)}}">{{$item->name}}</a></li>
@endforeach
@foreach ($combos as $item)
<li><a class="search-link" href="{{url('combo/'.$item->id)}}">{{$item->name}}</a></li>
@endforeach
@if (count($products) == 0 && count($combos) == 0)
    <li class="empty">not fount</li>
@endif