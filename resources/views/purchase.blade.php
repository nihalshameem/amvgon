
        <style>
            .ticket-body{
                margin: 0;
                padding: 0;
            }
            .ticket  {
    font-size: 10px!important;
    font-family: monospace;
    letter-spacing: 1px;
}

.ticket td,
.ticket th,
.ticket tr,
.ticket table {
    border-top: 1px solid black;
    border-collapse: collapse;
    font-size: 7px!important;
    font-weight: bold;
}

td.description,
th.description {
    width: 75px;
    max-width: 75px;
}

.ticket td.quantity,
.ticket th.quantity {
    width: 70px;
    max-width: 70px;
    word-break: break-all;
}

.ticket td.price,
.ticket th.price {
    width: 40px;
    max-width: 40px;
    word-break: break-all;
}

.ticket .centered {
    text-align: center;
    text-transform: capitalize;
    align-content: center;
}

.ticket {
    width: 190px;
    max-width: 190px;
}

.ticket img {
    max-width: inherit;
    width: inherit;
}

@media print {
    .hidden-print,
    .hidden-print * {
        display: none !important;
    }
}
        </style>
        <div class="ticket" id="res">
            <p class="centered">AMVGON
                <br>PURCHASE RECEIPT
                <br>{{$date}}</p>
            <table style="margin-top: -10px">
                <thead>
                    <tr>
                        <th class="description">Products</th>
                        <th class="price">Type</th>
                        <th class="quantity">Q.</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($normal_products->sortBy('id') as $tnp)
                    @if ($tnp->total_qty !== 0)
                    <tr>
                      <td>{{$tnp->name}}</td>
                      <td>{{$tnp->price_type}}</td>
                      <td class="qty">{{$tnp->total_qty < 1 ? ($tnp->total_qty * 1000) : $tnp->total_qty}} {{$tnp->total_qty < 1 ? 'g': 'kg'}}</td>
                    </tr>
                    @endif
                @endforeach
                @foreach ($standard_products->sortBy('id') as $tsp)
                    @if ($tsp->total_qty !== 0)
                    <tr>
                      <td>{{$tsp->name}}</td> 
                      <td>{{$tsp->price_type}}</td>
                      <td class="qty">{{$tsp->total_qty < 1 ? ($tsp->total_qty * 1000) : $tsp->total_qty}} {{$tsp->total_qty < 1 ? 'g': 'kg'}}</td>
                    </tr>
                    @endif
                @endforeach
                @foreach ($excellent_products->sortBy('id') as $tep)
                    @if ($tep->total_qty !== 0)
                    <tr>
                      <td>{{$tep->name}}</td>
                      <td>{{$tep->price_type}}</td>
                      <td class="qty">{{$tep->total_qty < 1 ? ($tep->total_qty * 1000) : $tep->total_qty}} {{$tep->total_qty < 1 ? 'g': 'kg'}}</td>
                    </tr>
                    @endif
                @endforeach
                    <tr>
                        <td class="description">TOTAL</td>
                        <td class="quantity"></td>
                        <td class="price" id="totalQty">{{$full_total < 1 ? ($full_total * 1000) : $full_total}} {{$full_total < 1 ? 'g': 'kg'}}</td>
                    </tr>
                </tbody>
            </table>
            <p class="centered">http://www.amvgon.com/</p>
        </div>