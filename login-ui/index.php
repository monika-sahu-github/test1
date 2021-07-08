<!DOCTYPE html>
<html lang="en">
<head>
	<title>ACHIEVERS ONE</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="login-ui/image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="login-ui/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="login-ui/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="login-ui/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="offline.css">
	<link rel="stylesheet" type="text/css" href="login-ui/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="login-ui/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="login-ui/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="login-ui/vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="login-ui/css/util.css">
	<link rel="stylesheet" type="text/css" href="login-ui/css/main.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

</head>
<body> 
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<!-- <div class="login100-form-title" style="background-image: url(login-ui/images/bg-01.jpg);"> -->
					<div class="login100-form-title" style="background-image: radial-gradient(circle 248px at center, #16d9e3 0%, #30c7ec 47%, #46aef7 100%) !important;">
					<span class="login100-form-title-1">
						ACHIEVERS ONE
					</span>
					<br><span style="color: white;"><?php if(!isset($_REQUEST['registration'])){ echo "Login"; } else { echo "Registration"; } ?></span>
				</div>
				<!-- Start header -->
    <!-- <header class="top-header">
        <nav class="navbar header-nav navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt="image"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-wd" aria-controls="navbar-wd" aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbar-wd">
                    <ul class="navbar-nav">
                        <li><a class="nav-link active" href="/frontend/index.html">Home</a></li>
                        <li><a class="nav-link" href="/frontend/about.html">About</a></li>
                        <li><a class="nav-link" href="/frontend/courses.html">Courses</a></li>
                        <li><a class="nav-link" href="/frontend/news.html">News</a></li>
						<li><a class="nav-link" href="/achievers.nxgsolutions.in/index.php?registration=1">Register</a></li>
						<li><a class="nav-link" href="index.php">Login</a></li>
                    </ul>
                </div>
                <div class="search-box">
                    <input type="text" class="search-txt" placeholder="Search">
                    <a class="search-btn">
                        <img src="images/search_icon.png" alt="#" />
                    </a>
                </div>
            </div>
        </nav>
    </header> -->
    <!-- End header -->
<div class="row" style="padding: 50px;">
	<div class="col-sm-4" style="background-image: url(login-ui/images/bg2.jpg);height: 550px;"></div><hr>
	<div class="col-sm-8">
		<?php if(!isset($_REQUEST['registration'])){ ?>
		<form method="post" id="examineeLoginFrm" class="login100-form validate-form">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
						<span class="label-input100">Email</span>
						<input class="input100" type="text" name="username" placeholder="Enter email">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" placeholder="Enter password">
						<span class="focus-input100"></span>
					</div>


					<div class="container-login100-form-btn" align="right">
						<button type="submit" class="login100-form-btn">
							Login
						</button><br><br>
					</div>
					<div class="container-login100-form-btn" align="right">
						<?php if(!isset($_REQUEST['registration'])){ ?>
						<a href="resetPassword\checkEmail.php?step1=1" style="color: blue;text-decoration: underline; margin-right: 20px;" >Forgot Password</a>
						
						<a href="index.php?registration=1" style="color: blue;text-decoration: underline; margin-right: 20px;">Registration</a><?php } else { ?>
					    <a href="index.php" style="color: blue;text-decoration: underline; margin-right: 20px;">Login</a>
						<?php } ?>
					</div> 
				</form> 
			<?php } else { ?>
             <form method="post" name="form1" id="examineeRegFrm" class="login100-form validate-form">
             	<?php date_default_timezone_set('Asia/Kolkata'); echo date('Y-m-d H:i:s'); ?><span style="color: red; font-size: 12px;">Mandatory fields are marked with an astrisk (*)</span>
             	<div class="wrap-input100 validate-input m-b-26" data-validate="Name is required">
						<span class="label-input100">Name<span style="color: red; font-size: larger;"> *</span></span>
						<input class="input100" type="text" name="name" placeholder="Enter Name">
						<span class="focus-input100"></span>
					</div>
					<!-- <div class="wrap-input100 validate-input m-b-26" data-validate="Birthday is required"> -->
                <div class="wrap-input100  m-b-26">
						<span class="label-input100">DOB</span>
						<input class="input100" type="date" name="dob" placeholder="Enter Birthday">
						<span class="focus-input100"></span>
					</div>
					<!-- <div class="wrap-input100 validate-input m-b-26" data-validate="Gender is required" > -->
					<div class="wrap-input100  m-b-26">
						<span class="label-input100">Gender</span>
						<!-- <input class="input100" type="date" name="dob" placeholder="Enter Gender"> -->
						<!-- <select name="gender" class="form-control" data-validate="Gender is required"> -->
							<select name="gender" class="form-control">
							<option value="">Select</option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
						<span class="focus-input100"></span>
					</div>
					<!-- <div class="wrap-input100 validate-input m-b-26" data-validate="State is required"> -->
						<div class="wrap-input100  m-b-26"> 
						<span class="label-input100">State</span>
						<input class="input100" type="text" id = "state" name="state" placeholder="Enter State">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-26" data-validate="Email is required">
						<span class="label-input100">Email<span style="color: red; font-size: larger;"> *</span></span>
						<input class="input100" type="text" name="email" placeholder="Enter email">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-26" data-validate="Phone Number is required">
						<span class="label-input100">Phone Number<span style="color: red; font-size: larger;"> *</span></span>
						<input class="input100" id = "phoneno" type="tel" name="phoneno" placeholder="Enter Phone Number" onchange="phoneNumberCheck()" >
						<span id='msg' class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Password<span style="color: red; font-size: larger;"> *</span></span>
						<input class="input100" type="password" id="password" name="pass" placeholder="Enter password">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
						<span class="label-input100">Confirm Password<span style="color: red; font-size: larger;"> *</span></span>
						<input class="input100" type="password" id="confirm_password"  name="confirm_pass" placeholder="Enter password">
						<span class="focus-input100"></span>

					</div>
					<span id='message'></span>


					<div class="container-login100-form-btn" align="right">
						<button type="submit" id="subreg" class="login100-form-btn" >
							Submit
						</button><br><br>
					</div>
					<div class="container-login100-form-btn" align="right">
						
						<?php if(!isset($_REQUEST['registration'])){
							 $conn->query("INSERT INTO notifications SET title ='Welcome To ACHIEVERS ONE', target_link ='home.php?page=examination_test_type&exam_type=Rg==' ");
						 ?>
						<a href="index.php?registration=1" style="color: blue;text-decoration: underline; margin-right: 20px;">Registration</a><?php } else { 
							?>
						<a href="resetPassword\checkEmail.php?step1=1" style="color: blue;text-decoration: underline; margin-right: 20px;" >Forgot Password</a>
						<a href="index.php" style="color: blue;text-decoration: underline; margin-right: 20px;">Login</a>
						<?php } ?>
					</div>
				</form>
		<?php	} ?>
	</div>
</div>
				
			</div>
		</div>
	</div>
	
	<script src="login-ui/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="login-ui/vendor/animsition/js/animsition.min.js"></script>
	<script src="login-ui/vendor/bootstrap/js/popper.js"></script>
	<script src="login-ui/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="login-ui/vendor/select2/select2.min.js"></script>
	<script src="login-ui/vendor/daterangepicker/moment.min.js"></script>
	<script src="login-ui/vendor/daterangepicker/daterangepicker.js"></script>
	<script src="login-ui/vendor/countdowntime/countdowntime.js"></script>
	<script src="login-ui/js/main.js"></script>
<script type="text/javascript">
	$('#password, #confirm_password').on('keyup', function () {
  if ($('#password').val() == $('#confirm_password').val()) {
  	document.getElementById("subreg").disabled = false;
  	$("#subreg").removeAttr("disabled"); 
    $('#message').html('Matching').css('color', 'green');

  } else{ 
    $('#message').html('Not Matching').css('color', 'red');
    document.getElementById("subreg").disabled = true;
}
});
</script>
<script>
function phoneNumberCheck(){
 	var phone1 = /^\d{10}$/;
 	if(phoneno.value.match(phone1)){
 		$('#msg').html('').css('color', 'green');
  		return true;
 	}
 	else
 	{
 		 $('#msg').html('Not Correct Input').css('color', 'red');
 		 phoneno.value ="";
 		 return false;
 	}
}
</script>
</body>
</html>