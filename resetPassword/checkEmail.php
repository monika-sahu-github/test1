
<?php
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

include ("../conn.php");
session_start();
$message = '';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<?php
$msgg = "";			
if(isset($_POST['Send'])){

	
	if(empty($_POST['email'])){
		$message = '<div> Email address is required.</div>';
		echo $message;
	}
	else{
		$email2 = $_POST['email'];
$selAcc = $conn->query("SELECT * FROM examinee_tbl WHERE exmne_email= '$email2'");
$selAcc->fetch(PDO::FETCH_ASSOC);
		 $nnn = $selAcc->rowCount();
		if($selAcc->rowCount() > 0){
$var1 = base64_encode($email2);
$to_email = $email2;
$subject = 'Passward Reset';
$message = "If you requested a password reset for '.$email2.', click the button below. If you didn't make this request, ignore this email. Click on this to reset password - link:http://achievers.nxgsolutions.in/resetPassword/checkEmail.php?email1='.$var1.'
";
$headers = 'From: achieversone@nxgsolution.in';
 
//if(1==1){
 if(mail($to_email,$subject,$message,$headers)){
    
$msgg  = 2;
  }else {
    //echo "mail not send";die;
    echo "<script>window.location.href='checkEmail.php?error=2'</script>";?>
  
<?php }

    	}
    	else{ 
            // echo "<h2><center><b>";
            // echo "Email address not found in our record";
            // echo "</b></center></h2>";
            echo "<script>window.location.href='checkEmail.php?error=1'</script>";
            }
    }
}
$msg = "";
if(isset($_REQUEST["error"])){
	$error = $_REQUEST["error"];
	if($error==1){
	$msg = "Email address not found in our record";
   }else if($error==2){
    $msg = "mail not send";
   }
}  
$message1 = '';
if(isset($_POST['submit'])){
	include("conn.php");
	$var2 = $_POST['email'];
	$email1 = base64_decode($var2);

	//echo "<h2>",$email1,"</h2>";
    $password = $_POST['password'];
    //echo "<h2>",$password,"</h2>";
    extract($_POST);

    $data = [
   	'exmne_password' => $password,
    'exmne_email' =>  $email1,
   	];
    $sql = "UPDATE examinee_tbl SET exmne_password=:exmne_password WHERE exmne_email=:exmne_email";
    $stmt= $conn->prepare($sql);
    $stmt->execute($data);
    //print_r($data);
    ?><?php $message1 = '';
    $message1 = '<div> <h5>Your password has changed successfully please <a href="http://achievers.nxgsolutions.in/" style="color:blue;text-decoration:underline;" ><b>Click Here</b></a> to login.
			</h5></div>';
    
}
    ?>

 

<!DOCTYPE html>
<html lang="en">
<head>
	<title>ACHIEVERS ONE</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="../login-ui/image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="../login-ui/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../login-ui/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../login-ui/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="offline.css">
	<link rel="stylesheet" type="text/css" href="../login-ui/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="../login-ui/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="../login-ui/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="../login-ui/vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="../login-ui/css/util.css">
	<link rel="stylesheet" type="text/css" href="../login-ui/css/main.css">
	<style>
		.wrap-login10{
			width: 90%;
  			background: #fff;
  			border-radius: 10px;
  			overflow: hidden;
  			position: relative;
  			padding:  0 0 500px 0;
		}

	</style>
</head>
<body>
	<?php if(!isset($_GET["email1"])){ ?>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login10">
				<!-- <div class="login100-form-title" style="background-image: url(login-ui/images/bg-01.jpg);"> -->
					<div class="login100-form-title" style="background-image: radial-gradient(circle 248px at center, #16d9e3 0%, #30c7ec 47%, #46aef7 100%) !important;">
					<span class="login100-form-title-1">
						ACHIEVERS ONE
					</span>
					<br><span style="color: white;"><?php if(!isset($_REQUEST['registration'])){ echo "Forget Password"; } else { echo "Registration"; } ?></span>
					
				</div>
				<div class="row" style="padding: 50px;">
	<div class="col-sm-4" style="background-image: url(../login-ui/images/bg2.jpg);height: 550px;"></div><hr><div class="col-sm-8">
	 <?php //if(isset($_GET["step1"])){ ?> 
		<form method="POST" class="login100-form validate-form">
			<p style="color:black">Enter the email address associated with your Achievers One account.
 						</p>
		<div class="wrap-input100 validate-input m-b-26" data-validate="Registered Email address is required">
						<span class="label-input100">Email</span>
						<input class="input100" required="" type="text" name="email" placeholder="Enter email">
						<span class="focus-input100"></span>
					</div> 
					<span style="color: red;" ><?php echo $msg; ?></span><br><br>
					<div class="container-login100-form-btn" align="right">
						<button type="submit" class="login100-form-btn" name="Send">
							Submit
						</button>
						<div class="container-login100-form-btn" align="right">
							<div class="container-login100-form-btn" align="right">
						<?php if(!isset($_REQUEST['registration'])){ ?>
						<a href="http://achievers.nxgsolutions.in/" style="color: blue;text-decoration: underline;" >Login</a>&nbsp; &nbsp;
						
						<a href="http://achievers.nxgsolutions.in/index.php?registration=1" style="color: blue;text-decoration: underline;">Registration</a><?php } else { ?>
					     
						<?php } ?>
					</div> 
					</div>
					</div>
</div>
</form><?php //} ?> <?php } else{ 
				
				//echo $var2;
				//$message = '<div> Your email address('.$var2.') is verified successfully.</div>';
				//echo $message; 
				//} else { echo " email value can't determined";}  ?>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login10">
				<!-- <div class="login100-form-title" style="background-image: url(login-ui/images/bg-01.jpg);"> -->
					<div class="login100-form-title" style="background-image: radial-gradient(circle 248px at center, #16d9e3 0%, #30c7ec 47%, #46aef7 100%) !important;">
					<span class="login100-form-title-1">
						ACHIEVERS ONE
					</span>
					<br><span style="color: white;"><?php if(!isset($_REQUEST['registration'])){ echo "Forgot Password"; } else { echo "Registration"; } ?></span>
					
				</div>
				<div class="row" style="padding: 50px;">
	<div class="col-sm-4" style="background-image: url(login-ui/images/bg2.jpg);height: 550px;"></div><hr><div class="col-sm-8">
<?php if($message1!=""){?>
<p><?php echo $message1; ?></p>
<?php } else {?>	    
<form method="POST" class="login100-form validate-form">
						<input type="hidden" name="email" value="<?php echo $_GET['email1']; ?>">
						<p style="color:red">
 						<?php $var1 = $_GET['email1']; $var2 = base64_decode($var1); echo "<div> Your email address( "; echo $var2; echo ") is verified successfully.</div>"; ?> </p>
 						<div class="wrap-input100 validate-input m-b-26" data-validate="New Password is required">
						<span class="label-input100">New Password</span>
						<input class="input100" type="password" id="password" name="password" placeholder="Enter Password">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-26" data-validate=" Confirm New Password is required">
						<span class="label-input100">Confirm New Password</span>
						<input class="input100" type="password" id="confirm_password" name="password2" placeholder="Enter Password">
						<span class="focus-input100"></span>
					</div>
			<span id='message'></span>
				<div class="container-login100-form-btn" align="right">
						<button type="submit" id="updt" class="login100-form-btn" name="submit">
							Submit
						</button>
						<div class="container-login100-form-btn" align="right">
						<?php if(!isset($_REQUEST['registration'])){ ?>
						<a href="../index.php" style="color: blue;text-decoration: underline;">Login</a>&nbsp; &nbsp;
						
						<a href="../index.php?registration=1" style="color: blue;text-decoration: underline;">Registration</a><?php } else { ?>
					    <a href="index.php" style="color: blue;text-decoration: underline;">Login</a>
						<?php } ?>
					</div>
					</div>	
			</div>
</form> <?php } }?> 

<script src="login-ui/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="login-ui/vendor/animsition/js/animsition.min.js"></script>
	<script src="login-ui/vendor/bootstrap/js/popper.js"></script>
	<script src="login-ui/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="login-ui/vendor/select2/select2.min.js"></script>
	<script src="login-ui/vendor/daterangepicker/moment.min.js"></script>
	<script src="login-ui/vendor/daterangepicker/daterangepicker.js"></script>
	<script src="login-ui/vendor/countdowntime/countdowntime.js"></script>
	<script src="login-ui/js/main.js"></script>
	<?php if($msgg == 2){ ?>
    	<script type="text/javascript">
    		
    	  swal({
            title: 'Mail Sent!',
            text: "(1) Please check the inbox of the associated email.\n (2) You already completed this action, please check your inbox.(including Spam folder).\n (3) Received email within 5 minutes.",
            icon: 'success',
            allowOutsideClick: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK!'
        })
    </script>
	<?php } ?>
	<script type="text/javascript">
	$('#password, #confirm_password').on('keyup', function () {
  if ($('#password').val() == $('#confirm_password').val()) {
  	document.getElementById("updt").disabled = false;
//   	$("#updt").removeAttr("disabled"); 
    $('#message').html('Matching').css('color', 'green');

  } else{ 
    $('#message').html('Not Matching').css('color', 'red');
    document.getElementById("updt").disabled = true;
}
});
</script>
</body>
</html>