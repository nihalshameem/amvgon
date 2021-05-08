<div class="modal-header">
    <h4 class="modal-title">Order Detail #{{$order->id}}</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
 </div>
 <div class="modal-body">
    <div class="popupMessageContainer table-responsive">
           <table class="table">
               <thead>
                   <tr>
                       <th>Product</th>
                       <th>Price</th>
                       <th></th>
                       <th>Qty</th>
                       <th>Total</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach ($orderDetails as $detail)
                   <tr>
                    <td>{{$detail->name}}</td>
                    <td>{{$detail->price}}</td>
                    <td>X</td>
                    <td>{{$detail->qty}}</td>
                    <td>{{$detail->total_price}}</td>
                </tr>
                   @endforeach
                <tr>
                    <td><b>Product Total:</b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{$order->price}}</td>
                </tr>
                <tr>
                    <td><b>Shipping:</b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{$order->shipping_amount}}</td>
                </tr>
                {{-- <tr>
                    <td><b>Coupon Discount(-):</b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{$order->coupon}}</td>
                </tr> --}}
                <tr>
                    <td><b>Customer Delivery charge:</b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{$order->time_charge}}</td>
                </tr>
                <tr>
                    <td><b>Total:</b></td>
                    <td></td>
                    <td></td>
                    <td>{{$order->qty}}</td>
                    <td>{{$order->total}}</td>
                </tr>
               </tbody>
           </table>
    </div>
    <div class="modal-footer">
        <form action="{{('/customer/order/cancel/'.$order->id)}}" method="post" id="OrderCancel">
            @csrf
        </form>
       <button type="submit" class="btn btn-sm btn-danger" form="OrderCancel"  onclick="return confirm('Are you sure?')">Cancel Order</button>
       <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">close</button>
    </div>
 </div>