
<?php
include("conn.php");
session_start();

if(!isset($_SESSION['examineeSession']['examineenakalogin']) == true) header("location:index.php");
$examnee_id = $_SESSION['examineeSession']['exmne_id'];

?>


<?php
if(isset($_POST['Submit'])){
    $password = $_POST['password'];
    extract($_POST);
    $selAcc = $conn->query("SELECT * FROM examinee_tbl WHERE exmne_id= '$examnee_id' AND exmne_password= '$password' ");
    $selAcc->fetch(PDO::FETCH_ASSOC);
    if($selAcc->rowCount() > 0){ 
        header("location:forgotpassword.php");
    }
    else{ 
            echo "<h2><center><b>";
            echo "Please enter valid Password";
            echo "</b></center></h2>";
            }
}
?>
<?php  include("includes/header.php"); ?> 
<?php  include("includes/sidebar.php"); ?>
<!doctype html> 
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>ACHIEVERS ONE
</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
     
    <!-- MAIN CSS NIYA -->
    <link href="./main.css" rel="stylesheet">
    <link href="css/sweetalert.css" rel="stylesheet">
    <style type="text/css"> 
        body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
            padding:120px 0;
         }
         label {
            font-weight:bold;
            width:300px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
            padding:0px 10px 5px 5px;
         }
        .anchr-tagcolor{
            color: #a6aaad;
            text-decoration: none;
        }
        .anchr-tagcolor:hover{
            color: red;
            text-decoration: none;
        }
        .spanclr{
           color: #a6aaad; 
        }
        .spanclr:hover{ 
            color: red;
        }
        .righarr{
            color: #a6aaad;
        }
    </style>
</head>
<body bgcolor="#FFFFFF">
    <form method="POST"><!-- onSubmit = "return checkPassword(this)"-->
    <div align="center">
        <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#2196f3; color:#FFFFFF; padding:20px 0 20px 10px;"><b>Change Password</b></div>
                
            <div style = "margin:30px">
    
   
    <label> old-password :</label><br>
    <input  type="password" name="password" id="password"  placeholder="Enter password" class = "box" required /><br>
    <label>Re-enter-password :</label><br>
    <input  type="password" name="pass2" id="confirm_password"   placeholder="Re-Enter password" class = "box" required/><br><br><span id='message'></span>
    <div class="container-login100-form-btn" align="right">
    <button type="submit" id="subreg" name="Submit">Submit</button></div></div></div></div>
    </form>
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
</body>
</html>
<?php include("includes/footer.php"); ?>

<?php include("includes/modals.php"); ?>