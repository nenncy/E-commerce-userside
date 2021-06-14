<?php

   session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Enter your email</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
  </head>
<body>
  
<?php
include 'dbconnection.php';
$emailErr =" ";


   
  if(isset($_POST['signup'])){
      $email=mysqli_real_escape_string($con,$_POST['email']);
      error_reporting(0);
      if(empty($email)){
        $emailErr="Please enter Email";
 
      }
      elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $emailErr="Enter valid email";
      
      }
      $emailquery="select * from registration where email='$email' ";
      $query=mysqli_query($con,$emailquery);
      
      $emailcount=mysqli_num_rows($query);
      
      if($emailcount>  0)
      {
           $userdata = mysqli_fetch_array($query);

           $username = $userdata['username'];
           $token = $userdata['token'];

            $subject="Password Reset";
            $body="Hi, $username. Click to Reset your password
             http://localhost/loginSystem/reset_password.php?token=$token";
            $headers="From: nencyvpatel3010@gmail.com";
            if(mail($email,$subject,$body,$headers))
            {
              $_SESSION['msg']="Check your mail Reset Your password $email";
                      header("Location:login.php");

            }
            else{
              echo "Email sending failed";
            }

        }else{
            echo "No email found";
        }

    }
    


?>
  
           <section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
          <h2>Recover your account!</h2>
					<div class="login-form"><!--login form-->
						<h5>Enter your Registered Email Id here</h5>
						<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="text" name="email"  autoComplete="off" placeholder="Your Email" class="form-control"></input>
		
            <button type="submit" name="signup"  autoComplete="off"  class="btn btn-default">Send Mail</button>
						</form>
					</div><!--/login form-->
				</div>
    
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>