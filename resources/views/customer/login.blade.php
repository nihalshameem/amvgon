@extends('customer.layouts.master')
@section('title')
Customer | Login/Register
@endsection
@section('content')
@php
$store = App\Models\Store::find(1);
@endphp
<div class="container">
   <div class="row">
      <div class="col-lg-5 col-md-7 mx-auto">
         <form action="{{url('/login/customer/submit')}}" method="post" class="auth-class" id="cus-login">
            @csrf
            <img src="{{$store->image}}" alt="" class="auth-logo">
            <h5>Login Here</h5>
            <div class="form-group">
               <label for="exampleInputEmail1" class="sr-only">Email address</label>
               <input type="text" class="form-control form-control-sm @error('phone') is-invalid @enderror" id="exampleInputEmail1" placeholder="Phone Number" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
               @if ($errors->has('phone'))
               <span class="invalid feedback"role="alert">
               {{ $errors->first('phone') }}.
               </span>
               @endif
            </div>
            <div class="form-group">
               <label for="exampleInputPassword1" class="sr-only">Password</label>
               <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" id="exampleInputPassword1" placeholder="Password" name="password" required autocomplete="current-password">
               @if ($errors->has('password'))
               <span class="invalid feedback"role="alert">
               {{ $errors->first('password') }}.
               </span>
               @endif
            </div>
            <div>
               <p id="reg-btn">Register Now?</p>
            </div>
            <div class="text-left">
               <button type="submit" class="btn btn-primary mr-2">Login</button> <a href="{{('/forget-password/customer')}}">Foget password?</a>
            </div>
         </form>
         <form action="{{url('/register/customer/submit')}}" method="post" class="auth-class" id="cus-reg" style="display: none">
            @csrf
            <img src="{{$store->image}}" alt="" class="auth-logo">
            <h5>Register here</h5>
            <div class="form-group">
               <label for="" class="sr-only">First Name</label>
               <input type="text" class="form-control form-control-sm @error('first_name') is-invalid @enderror" placeholder="First Name" name="first_name" value="{{ old('first_name') }}" autofocus>
               @if ($errors->has('first_name'))
               <span class="invalid feedback"role="alert">
               {{ $errors->first('first_name') }}.
               </span>
               @endif
            </div>
            <div class="form-group">
               <label for="" class="sr-only">Last Name</label>
               <input type="text" class="form-control form-control-sm @error('last_name') is-invalid @enderror" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}" >
               @if ($errors->has('last_name'))
               <span class="invalid feedback"role="alert">
               {{ $errors->first('last_name') }}.
               </span>
               @endif
            </div>
            <div class="form-group">
               <label for="" class="sr-only">Email</label>
               <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" placeholder="Email Address" name="email" value="{{ old('email') }}">
               @if ($errors->has('email'))
               <span class="invalid feedback"role="alert">
               {{ $errors->first('email') }}.
               </span>
               @endif
            </div>
            <div class="form-group">
               <label for="" class="sr-only">Phone</label>
               <input type="number" class="form-control form-control-sm @error('phone') is-invalid @enderror" placeholder="Phone" name="phone" value="{{ old('phone') }}" >
               @if ($errors->has('phone'))
               <span class="invalid feedback"role="alert">
               {{ $errors->first('phone') }}.
               </span>
               @endif
            </div>
            <div class="form-group">
               <label for="" class="sr-only">Password</label>
               <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" placeholder="Password" name="password">
               @if ($errors->has('phone'))
               <span class="invalid feedback"role="alert">
               {{ $errors->first('phone') }}.
               </span>
               @endif
            </div>
            <div class="form-group">
               <label for="" class="sr-only">Confirm Password</label>
               <input type="password" class="form-control form-control-sm @error('confirm_password') is-invalid @enderror" placeholder="Confirm Password" name="confirm_password">
               @if ($errors->has('confirm_password'))
               <span class="invalid feedback"role="alert">
               {{ $errors->first('confirm_password') }}.
               </span>
               @endif
            </div>
            <div>
               <p id="login-btn">Alredy Registered?</p>
            </div>
            <div class="text-left">
               <button type="submit" class="btn btn-primary mr-2">Signup</button>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection