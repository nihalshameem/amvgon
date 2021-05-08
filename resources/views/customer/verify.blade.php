<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Phone Number Verification</title>
    
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <style>
        @font-face {
    font-family: "nunito";
    src: url({{asset('fonts/Nunito/Nunito-Regular.ttf')}}) format("truetype");
    font-weight: 300;
    font-style: normal;
}
body{
    margin: 0;
    padding: 0;
    font-family: 'nunito';
}
        .container {
  position: relative;
}

.child {
  position: absolute;
  top: 50px;
  left: 50%;
  transform: translate(-50%, 0%);
}
form.auth,.verify {
    background: #e1dfdf;
    padding: 10px;
    border-radius: 5px;
    text-align: center;
}
input#number {
    background: transparent;
}
.auth input {
    margin: 10px -3px;
    height: 30px;
    text-align: center;
    border-color: transparent;
    border-radius: 5px;
}
.auth button {
    width: 100%;
    padding: 10px 0;
    border-radius: 5px;
    border-color: transparent;
    color: #fff;
    background: #4554e7;
    margin: 10px 0;
    cursor: pointer;
}
.auth button:hover,.auth button:focus{
    background: #717def;
}
    </style>
</head>
<body>
    <div class="container">
        <div class="child">
            <form class="auth">
                <input type="text" id="number" value="+91{{$data['phone']}}" readonly>
                <div id="recaptcha-container"></div>
                <button type="button" onclick="phoneAuth();">SendCode</button>
            </form><br>
            <h1>Enter Verification code</h1>
            <form class="auth">
                <input type="text" id="verificationCode" placeholder="Enter verification code">
                <button type="button" onclick="codeverify();">Verify code</button>
            
            </form>
        </div>
      </div>


<form action="{{url('/create/customer')}}" method="post" id="createCus" enctype="multipart/form-data" style="display: none">
@csrf
{{ method_field('POST') }}
<input type="text" name="first_name" value="{{$data['first_name']}}">
<input type="text" name="last_name" value="{{$data['last_name']}}">
<input type="text" name="phone" value="{{$data['phone']}}">
<input type="text" name="email" value="{{$data['email']}}">
<input type="text" name="password" value="{{$data['password']}}">

</form>
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>

<script>
// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
var firebaseConfig = {
apiKey: "AIzaSyAv8mMjkVVEbJ7igJwLQaPoigm8Zo3T6Ek",
authDomain: "otptesting-658c7.firebaseapp.com",
databaseURL: "https://otptesting-658c7.firebaseio.com",
projectId: "otptesting-658c7",
storageBucket: "otptesting-658c7.appspot.com",
messagingSenderId: "64772672387",
appId: "1:64772672387:web:d06dafe74b8840038884b6",
measurementId: "G-0C397E9GE8"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
</script>
<script src="{{asset('/js/verify.js')}}" type="text/javascript"></script>
</body>
</html>