@extends('customer.layouts.master')

@section('title')
    Orders
@endsection

@section('content')
    <div class="container mt-5 mb-3">
        <h3 class="heading">Orders</h3>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr class="text-center">
                        <th>Order ID</th>
                        <th>Qty(KG)</th>
                        <th>Price</th>
                        <th>Payment</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order )
                    @if ($order->order_status != 4)
                        <tr class="text-center" data-toggle="modal" id="getOrderDetail" data-target="#orderDetailModal" class="btn btn-sm btn-info" data-url="{{ url('/customer/order',['id'=>$order->id])}}">
                            <td>{{$order->id}}</td>
                            <td>{{$order->qty}}</td>
                            <td>₹ {{$order->total}}</td>
                            <td>
                                <span class="text-{{$order->payment_status == 'paid' ? 'success':'danger'}}">{{$order->payment_status}}</span>
                                {{-- @if ($order->payment_status == 'unpaid')
                                    <a href="" class="pay" data-toggle="tooltip" title="click to pay online" data-placement="top">Pay</a>
                                @endif --}}
                            </td>
                            <td>
                                @switch($order->order_status)
                                    @case(1)
                                        <p class="text-info">{{$order->status}}</p>
                                        @break
                                    @case(2)
                                        <p class="text-primary">{{$order->status}}</p>
                                        @break
                                    @case(3)
                                        <p class="text-success">{{$order->status}}</p>
                                        @break
                                    @case(4)
                                        <p class="text-danger">{{$order->status}}</p>
                                        @break
                                    @case(5)
                                        <p class="text-info">{{$order->status}}</p>
                                        @break
                                    @default
                                        
                                @endswitch
                            </td>
                        </tr>
                    @endif
                        
                    @endforeach
                    @if (count($orders) == 0)
                        <tr>
                            <td colspan="10">No orders</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-default mt-2"><i class="mdi mdi-chevron-double-left"></i> Go Back</a>
    </div>
    {{-- order details modal --}}
<div class="modal fade" id="orderDetailModal" role="dialog">
    <div class="modal-dialog modal-lg">
       <!-- Modal content-->
       <div class="modal-content message-modal">
       </div>
    </div>
 </div>
 <script>
    // edit address ajax
    $(document).on('click', '#getOrderDetail', function(e){
        $('.pre-loader').show();
        e.preventDefault();
        var url = $(this).data('url');
        $('.message-modal').html(''); 
        $('#modal-loader').show();     
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data){
            $('.pre-loader').hide();
            $('.message-modal').html('');    
            $('.message-modal').html(data); // load response 
            $('#modal-loader').hide();        // hide ajax loader   
        })
        .fail(function(){
            $('.pre-loader').hide();
            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#modal-loader').hide();
        });
    });
 </script>
@endsection