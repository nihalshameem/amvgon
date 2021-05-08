<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OTP Verification</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <style>
        .otp-block {
    width: 150px;
    position: absolute;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.otp-btn {
    width: 150px;
    position: absolute;
    top: 40%;
    margin-left: 2px;
    margin-top: 60px;
    left: 50%;
    transform: translate(-50%, -50%);
}
#otp-timer{
    color:#0000006b;
}
.otp-error {
    display: none;
    position: absolute;
    background: red;
    color: white;
    padding: 12px 22px;
    top: 0;
    right: 0;
    margin: 10px 10px 0 0;
}
    </style>
    {{-- {{ request()->input('first_name') }} --}}
    <form action="post">
        <div class="otp-block">
            <div id="otp-timer">Nill</div>
            <input type="number" name="otp" id="otp-input" class="form-control" placeholder="Enter OTP">
        </div>
        <div class="otp-btn">
            <input type="submit" value="Submit" class="btn btn-success">
            <input type="button" value="Resend" class="btn btn-primary" id="otp-resend" disabled>
        </div>
    </form>
    <div class="otp-error">
        OTP Not Valid
    </div>
    <form action="" method="post" id="register" style="display: none">
        <input type="text" name="first_name" value="{{ request()->input('first_name') }}">
            <input type="text" name="last_name" value="{{ request()->input('last_name') }}">
            <input type="text" name="email" value="{{ request()->input('email') }}">
            <input type="text" name="phone" value="{{ request()->input('phone') }}">
            <input type="text" name="password" value="{{ request()->input('password') }}">
    </form>

    <script>
        
        $(document).ready(function(){
            
        function otptimer(){
            // Set the date we're counting down to
        var countDownDate = new Date();
        countDownDate.setMinutes(countDownDate.getMinutes()+1);
        
        // Update the count down every 1 second
        var x = setInterval(function() {
        
          // Get today's date and time
          var now = new Date().getTime();
        
          // Find the distance between now and the count down date
          var distance = countDownDate - now;
        
          // Time calculations for days, hours, minutes and seconds
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
          // Display the result in the element with id="demo"
          document.getElementById("otp-timer").innerHTML = minutes + "m " + seconds + "s ";
        
          // If the count down is finished, write some text
          if (distance < 0) {
            clearInterval(x);
            document.getElementById("otp-timer").innerHTML = "EXPIRED";
            $('#otp-resend').attr('disabled',false);
            $('#otp-input').attr('disabled',true);
          }
        }, 1000);
        }
            otptimer();
            // Math.floor(1000 + Math.random() * 9000)
            // $(".otp-error").show().delay(5000).fadeOut();

            $( "#otp-resend" ).on( "click", function() {
                $('#otp-resend').attr('disabled',true);
            $('#otp-input').attr('disabled',false);
                otptimer();
});
        })
        </script>

<script>

</script>
</body>
</html>