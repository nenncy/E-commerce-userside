<?php

  session_start();
  ob_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Reset your password</title>
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


     if(isset($_GET['token'])){

      $token = $_GET['token'];

      
      $password=mysqli_real_escape_string($con,$_POST['password']);
      $cpassword=mysqli_real_escape_string($con,$_POST['cpassword']);
     
      
    

      $pass=password_hash($password,PASSWORD_BCRYPT);
      $cpass=password_hash($cpassword,PASSWORD_BCRYPT);
       
        if($password === $cpassword){

            $updatequery = "update registration set password = '$pass' where  token = '$token' ";
            $iquery = mysqli_query($con , $updatequery);
         
          if($iquery)
          {
            
             $_SESSION['msg'] = "Your password has been updated";
             header('location:login.php');
              
          }
          else{

             $_SESSION['passmsg'] = "Your Password is not Updated";
             header('location:reset_password.php');
            
        
          }
        }
        else
        {
            $_SESSION['passmsg'] = "Password are not Matching";
            }
    }
    else{
        echo "token not found";
    }
}



?>
           

           <section id="form" ><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2><b>Reset Your password<b></h2>
              <h5>Enter your new Password here</h5>

                 <p>
                     <?php
                     if(isset($_SESSION['passmsg'])){
                         echo $_SESSION['passmsg'];
                     }else{
                        $_SESSION['passmsg'] = "";
                     }
                     ?>
                     </p>
						<Form method="POST" action = "">
                     
            <div class="form-group"> 
                        <label htmlFor="password"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="password"  autoComplete="off" placeholder="New Password" class="form-control" >
                            
                        </input>
                     
                     </div>
                     
                     <div class="form-group"> 
                        <label htmlFor="password"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="cpassword"  autoComplete="off" placeholder="Confirm password" class="form-control" >
                            
                        </input>
                     
                     </div>
                     <button type="submit" name="signup"  autoComplete="off"  class="btn btn-default">Change password</button>
                     
                    </Form>
					</div>
				</div>
    
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>