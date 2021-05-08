@extends('customer.layouts.master')
@section('title')
Profile
@endsection
@section('content')
<div class="container mt-4 mb-3">
   <div class="row">
      {{-- <div class="col-md-6">
         <div class="pro-img">
            <img src="{{asset($customer->image)}}" alt="">
         </div>
      </div> --}}
      <div class="col-md-6 mx-auto">
         <div class="row profile-block">
            <div class="col-xs-6">
               <h5>First Name:</h5>
               <h5>Last Name:</h5>
               <h5>Email:</h5>
               <h5>Phone:</h5>
            </div>
            <div class="col-xs-6">
               <h6>{{$customer->first_name}}</h6>
               <h6>{{$customer->last_name}}</h6>
               <h6>{{$customer->email}}</h6>
               <h6>{{$customer->phone}}</h6>
            </div>
            <div class="col-md-12 text-right">
               <button class="btn btn-sm btn-dark btn-rounded" data-toggle="modal" data-target="#updateModal"><i class="mdi mdi-pencil"></i></button>
            </div>
         </div>
      </div>
   </div>
   <hr>
   <h3 class="heading">address List <button class="btn btn-sm btn-primary float-right btn-rounded" data-toggle="modal" data-target="#addAddressModal" style="display: {{count($addresses) == 4 ? 'none' : 'block'}}"><i class="mdi mdi-plus"></i></button></h3>
   <div class="table-responsive">
      <table class="table table-striped">
         <thead>
            <th>Door no & Street</th>
            <th>Village</th>
            <th>District</th>
            <th>Pincode</th>
            <th>Action</th>
         </thead>
         <tbody>
            @foreach ($addresses as $address)
            <tr>
               <td>{{$address->door_no}}</td>
               <td>{{$address->village}}</td>
               <td>{{$address->district}}</td>
               <td>{{$address->pincode}}</td>
               <td>
                  <a data-toggle="modal" id="getAddress" data-target="#addressEdit" class="btn btn-sm btn-info btn-rounded mb-2" data-url="{{ url('/customer/address',['id'=>$address->id])}}" href="#."><i class="mdi mdi-pencil"></i></a>
                  <a href="{{url('/customer/address/delete/'.$address->id)}}" type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger btn-rounded mb-2">
                  <i class="mdi mdi-delete-forever"></i>
                  </a>
               </td>
            </tr>
            @endforeach
            @if(count($addresses) == 0)
            <tr>
               <td colspan="10">Please add your address using the plus icon</td>
            </tr>
            @endif
         </tbody>
      </table>
   </div>
</div>
<!-- Edit profile modal -->
<div id="updateModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Edit Profile</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <form action="{{url('/customer/profile/update')}}" method="post" id="profileUpdate" enctype="multipart/form-data">
               @csrf
               <div class="form-group row">
                  <label for="" class="col-md-3">First Name</label>
                  <div class="col-md-9">
                     <input type="text" class="form-control form-control-sm @error('first_name') is-invalid @enderror" name="first_name" value="{{$customer->first_name}}" required>
                     @if ($errors->has('first_name'))
                     <span class="invalid feedback"role="alert">
                     {{ $errors->first('first_name') }}.
                     </span>
                     @endif
                  </div>
               </div>
               <div class="form-group row">
                  <label for="" class="col-md-3">Last Name</label>
                  <div class="col-md-9">
                     <input type="text" class="form-control form-control-sm @error('last_name') is-invalid @enderror" name="last_name" value="{{$customer->last_name}}" required>
                     @if ($errors->has('last_name'))
                     <span class="invalid feedback"role="alert">
                     {{ $errors->first('last_name') }}.
                     </span>
                     @endif
                  </div>
               </div>
               <div class="form-group row">
                  <label for="" class="col-md-3">Email</label>
                  <div class="col-md-9">
                     <input type="text" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{$customer->email}}" required>
                     @if ($errors->has('email'))
                     <span class="invalid feedback"role="alert">
                     {{ $errors->first('email') }}.
                     </span>
                     @endif
                  </div>
               </div>
               <div class="form-group row">
                  <label for="" class="col-md-3">Phone</label>
                  <div class="col-md-9">
                     <input type="text" class="form-control form-control-sm @error('phone') is-invalid @enderror" name="phone" value="{{$customer->phone}}" readonly required>
                     @if ($errors->has('phone'))
                     <span class="invalid feedback"role="alert">
                     {{ $errors->first('phone') }}.
                     </span>
                     @endif
                  </div>
               </div>
               <div class="form-group row">
                  <label for="" class="col-md-3">Image</label>
                  <div class="col-md-9">
                     <input type="file" class="form-control-file form-control-sm @error('image') is-invalid @enderror" name="image">
                     @if ($errors->has('image'))
                     <span class="invalid feedback"role="alert">
                     {{ $errors->first('image') }}.
                     </span>
                     @endif
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="submit" form="profileUpdate" class="btn btn-sm btn-cus">Update</button>
            <button class="btn btn-sm btn-info" id="change-btn">Change Password</button>
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
         </div>
      </div>
   </div>
</div>
<!-- password change modal -->
<div id="changePassModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Edit Profile</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <form action="{{url('/customer/change-password')}}" method="post" id="changePass" enctype="multipart/form-data">
               @csrf
               <div class="form-group row">
                  <label for="" class="col-md-4">Old Password</label>
                  <div class="col-md-8">
                     <input type="password" class="form-control form-control-sm @error('old_password') is-invalid @enderror" name="old_password" required>
                     @if ($errors->has('old_password'))
                     <span class="invalid feedback"role="alert">
                     {{ $errors->first('old_password') }}.
                     </span>
                     @endif
                  </div>
               </div>
               <div class="form-group row">
                  <label for="" class="col-md-4">New Password</label>
                  <div class="col-md-8">
                     <input type="password" class="form-control form-control-sm @error('new_password') is-invalid @enderror" name="new_password" required>
                     @if ($errors->has('new_password'))
                     <span class="invalid feedback"role="alert">
                     {{ $errors->first('new_password') }}.
                     </span>
                     @endif
                  </div>
               </div>
               <div class="form-group row">
                  <label for="" class="col-md-4">Confirm Password</label>
                  <div class="col-md-8">
                     <input type="password" class="form-control form-control-sm @error('confirm_password') is-invalid @enderror" name="confirm_password" required>
                     @if ($errors->has('confirm_password'))
                     <span class="invalid feedback"role="alert">
                     {{ $errors->first('confirm_password') }}.
                     </span>
                     @endif
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="submit" form="changePass" class="btn btn-sm btn-cus">Change</button>
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
         </div>
      </div>
   </div>
</div>
<!-- add address modal -->
<div id="addAddressModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title">Add Address</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <div class="modal-body">
            <form action="{{url('/customer/address/add')}}" method="post" id="addAddress" enctype="multipart/form-data">
               @csrf
               <div class="form-group row">
                  <label for="" class="col-md-3">Door no. & Street</label>
                  <div class="col-md-9">
                     <input type="text" class="form-control form-control-sm @error('door_no') is-invalid @enderror" name="door_no" required>
                     @if ($errors->has('door_no'))
                     <span class="invalid feedback"role="alert">
                     {{ $errors->first('door_no') }}.
                     </span>
                     @endif
                  </div>
               </div>
               <div class="form-group row">
                  <label for="" class="col-md-3">Village</label>
                  <div class="col-md-9">
                     <input type="text" class="form-control form-control-sm @error('village') is-invalid @enderror" name="village" required>
                     @if ($errors->has('village'))
                     <span class="invalid feedback"role="alert">
                     {{ $errors->first('village') }}.
                     </span>
                     @endif
                  </div>
               </div>
               <div class="form-group row">
                  <label for="" class="col-md-3">District</label>
                  <div class="col-md-9">
                     <select name="district" class="form-control form-control-sm">
                        @foreach ($districts as $district)
                        <option value="{{$district->id}}">{{$district->name}}</option>
                        @endforeach
                     </select>
                     @if ($errors->has('district'))
                     <span class="invalid feedback"role="alert">
                     {{ $errors->first('district') }}.
                     </span>
                     @endif
                  </div>
               </div>
               <div class="form-group row">
                  <label for="" class="col-md-3">Pincode</label>
                  <div class="col-md-9">
                     <input type="number" class="form-control form-control-sm @error('pincode') is-invalid @enderror" name="pincode" required>
                     @if ($errors->has('pincode'))
                     <span class="invalid feedback"role="alert">
                     {{ $errors->first('pincode') }}.
                     </span>
                     @endif
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="submit" form="addAddress" class="btn btn-sm btn-primary">Add</button>
            <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
         </div>
      </div>
   </div>
</div>
{{-- Edit Address --}}
<div class="modal fade" id="addressEdit" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content message-modal">
      </div>
   </div>
</div>
<script>
   // edit address ajax
   $(document).on('click', '#getAddress', function(e){
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
          // console.log(data);  
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
@if(!empty(Session::get('error_code')) && Session::get('error_code') == 5)
<script>
$(function() {
    $('#updateModal').modal('show');
});
</script>
@endif
@if(!empty(Session::get('error_code')) && Session::get('error_code') == 6)
<script>
$(function() {
    $('#changePassModal').modal('show');
});
</script>
@endif
@endsection