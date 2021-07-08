<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.0/css/fontawesome.min.css">
<?php  
 $page_name="My Account";

if(isset($_POST['ok'])){
    $id = $_POST['verified'];
 extract($_POST); 
 $sql = "UPDATE examinee_tbl set verify_status = '1' where exmne_id='$examnee_id'"; 
   //echo $sql; die();
    $stmt= $conn->prepare($sql);
    $stmt->execute();
 
?><script type="text/javascript"> 
     Swal.fire({
            title: '',
            text: "Email verified Successfully!",
            icon: 'success',
            confirmButtonText: 'OK'
        })
    </script>
<?php }

$var11 = $_GET['value1']; $var12 = base64_decode($var11); 
if(isset($_GET['value1'])){
   $sql = "UPDATE examinee_tbl set verify_status = '1' where exmne_email='$var12'"; 
   //echo $sql; die();
    $stmt= $conn->prepare($sql);
    $stmt->execute();  
}
?>
 
<style type="text/css">

    .w3-card{
        display: flex;
        flex-direction: row;
    }
    body{
    margin-top:20px;
    color: #1a202c;
    text-align: left;
    background-color: #e2e8f0;    
}

#img{
      margin-left: 225px;
}
@media only screen and (max-width: 600px) {
  #img{
        padding-left: -8px !important;
        margin-left: 0px !important; 
  }
}
.rounded-circle{
  border-color: red;
}
.main-body {
    padding: 15px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    /*margin-right: -8px;*/
    /*margin-left: -8px;*/
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    /*padding-right: 8px;*/
    /*padding-left: 8px;*/
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}
    
</style>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <!--<div>Profile Page</div> -->
                        <div>My Account</div>
                    </div>
                </div>
            </div>  
            <div class="breadcrumb">  <a href="home.php?page=dashboard" class="anchr-tagcolor">Dashboard</a><a href="home.php?page=myprofile" class="anchr-tagcolor"><?php echo $page_name; ?></a>
    </div>
 
     <div class="row" style="background: white;border: 3px solid #375176;padding: 0px;">
 
<div class="w3-container"> 
  <div class="row gutters-sm">
<div class="col-sm-12">
<form method="post">
    <input type="hidden" name="verified" value="<?php echo $_GET['value2']; ?>">
            <p style="color:green">
            <?php 
            echo "<div> Your email address ( "; echo $var12; echo ") verified successfully.</div>"; ?> </p>
            <a class="btn btn-info" href="home.php?page=myprofile" name="ok">OK</a><br><br>
</form>
</div>


</div>


        
</div>

</div>
