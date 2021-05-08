<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print All</title>
</head>
<body onload="window.print()" class="ticket-body">
    
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
width: 70px;
max-width: 70px;
}

.ticket td.quantity,
.ticket th.quantity {
width: 70px;
max-width: 70px;
word-break: break-all;
}

.ticket td.price,
.ticket th.price {
width: 45px;
max-width: 45px;
word-break: break-all;
}

.ticket .centered {
text-align: center;
text-transform: capitalize;
align-content: center;
}

.ticket {
width: 155px;
max-width: 155px;
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
    @foreach ($orders as $order)
    <div class="ticket">
        <p class="centered">AMVGON
            <br>ORDER RECEIPT
            <br>Order ID #{{$order->id}}
            <br>
            <b>Runner ID:</b>{{$order->delivery}} <br>
            <b>Customer Name:</b>{{($order->customer_name == null) ? 'user not found' : $order->customer_name}} <br>
            <b>Address:</b>{{$order->door_no}}<br>
            <b>Phone:</b>{{$order->phone}} <br>
        </p>
        <table style="margin-top: -10px">
            <thead>
                <tr>
                    <th class="description">Products</th>
                    <th class="price">Price</th>
                    <th class="quantity">Q.</th>
                    <th class="price">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->details as $item)
                <tr>
                    <td class="description">{{$item->name}}</td>
                    <td class="price">{{$item->price}}</td>
                    <td class="quantity">{{$item->qty < 1 ? ($item->qty * 1000) : $item->qty}} {{$item->qty < 1 ? 'g': 'kg'}}</td>
                    <td class="price">{{$item->total_price}}</td>
                </tr>
                @endforeach
                <tr>
                    <td class="description"><b>TOTAL</b></td>
                    <td class="price"></td>
                    <td class="quantity">{{$order->qty < 1 ? ($order->qty * 1000) : $order->qty}} {{$order->qty < 1 ? 'g': 'kg'}}</td>
                    <td class="price">{{number_format((float)$order->price,2,'.','')}}</td>
                </tr>
                <tr>
                    <td class="description"><b>DELIVERY</b></td>
                    <td class="price"></td>
                    <td class="quantity"></td>
                    <td class="price">{{$order->shipping_amount}}</td>
                </tr>
                <tr>
                    <td class="description"><b>APPROXIMATE VALUE</b></td>
                    <td class="price"></td>
                    <td class="quantity"></td>
                    <td class="price">{{number_format((float)$order->total,2,'.','')}}</td>
                </tr>
            </tbody>
        </table>
        <p class="centered">Thanks for your purchase!
            <br>http://www.amvgon.com/</p>
    </div>
    @endforeach
</body>
<script>
    document.addEventListener('DOMContentLoaded', (e)=>{
        print();
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {//expresion regular evalua navegador
        window.onfocus = function(){window.close();}
    } else {
        window.onafterprint = function(e){
        window.close();
        }
    }
});
</script>
</html>