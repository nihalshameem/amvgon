@extends('customer.layouts.master')

@section('title')
    Forget Password
@endsection

@section('content')
    <div class="container mt-5 mb-3">
        <h3 class="heading">Forget Password</h3>
        <form action="{{('/forget-password/customer/verify')}}" method="post" class="forget">
            @csrf
            <div class="form-group row">
                <label for="" class="col-md-3">Phone Number:</label>
                <div class="col-md-4">
                    <input type="number" name="phone" id="" class="form-control @error('phone') is-invalid @enderror">
                    @if ($errors->has('phone'))
               <span class="invalid feedback"role="alert">
               {{ $errors->first('phone') }}.
               </span>
               @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-md-3">New Password:</label>
                <div class="col-md-4">
                    <input type="password" name="new_password" id="" class="form-control @error('new_password') is-invalid @enderror">
                    @if ($errors->has('new_password'))
               <span class="invalid feedback"role="alert">
               {{ $errors->first('new_password') }}.
               </span>
               @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-md-3">Confirm Password:</label>
                <div class="col-md-4">
                    <input type="password" name="confirm_password" id="" class="form-control @error('confirm_password') is-invalid @enderror">
                    @if ($errors->has('confirm_password'))
               <span class="invalid feedback"role="alert">
               {{ $errors->first('confirm_password') }}.
               </span>
               @endif
                </div>
            </div>
            <button type="submit" class="btn btn-warning">Submit</button>
        </form>
    </div>
@endsection