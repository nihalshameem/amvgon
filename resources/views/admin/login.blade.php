<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Amazing | Admin | Login</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <style>
      .page-loader{
        right: 50%;
        display: none;
      }
    </style>
</head>
<body class="admin-body">
  <div class="page-loader">
    <img src="{{asset('/images/admin-pl.gif')}}" alt="">
</div>
    <div class="container-scroller">
      <div class="card login offset-md-3 col-md-6 mt-5">
        <div class="card-body">
          <h4 class="card-title text-center">admin login</h4>
          <form class="forms-sample" id="adminLogin" method="POST" action="/login/admin/submit">
            @csrf
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" id="exampleInputEmail1" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
              @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" id="exampleInputPassword1" placeholder="Password" name="password" required autocomplete="current-password">
              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
          </form>
        </div>
    </div>
    </div>
    

    {{-- js --}}
    
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script>
      $( "#adminLogin" ).submit(function( ) {
        $('.page-loader').show();
        $(':input[type="submit"]').prop('disabled', true);
      });
    </script>
</body>
</html>
