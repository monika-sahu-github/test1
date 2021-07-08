<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.0/css/fontawesome.min.css">
<?php  
 $page_name="My Account";

if(isset($_POST['update'])){ 
$tmpFilePath = $_FILES['image']['tmp_name'];

  //Make sure we have a file path
  if ($tmpFilePath != ""){

    //Setup our new file path
    // list($width,$height) = getimagesize($tmpFilePath);
    //   $nwidth = 300; //$width/4;
    //   $nheight = 200; //$height/4;
    //   $newimage = imagecreatetruecolor($nwidth, $nheight);
    //   $source = imagecreatefromjpeg($tmpFilePath);
    //   imagecopyresized($newimage, $source, 0, 0, 0, 0, $nwidth, $nheight, $width, $height);
    //   $file_name = time().'.jpg';
    //    $newFilePath = imagejpeg($newimage,"./uploads/" . $file_name); 
     $newFilePath = "./uploads/" . $_FILES['image']['name'];
    //echo $newFilePath;
    //Upload the file into the temp dir
    if(move_uploaded_file($tmpFilePath, $newFilePath)) {

    }
  }
        
   $sql = "UPDATE examinee_tbl set image='$newFilePath' where exmne_id='$examnee_id'"; 
      $stmt= $conn->prepare($sql);
    $stmt->execute();
    //echo "Successfully submitted";
    ?>
    <script type="text/javascript">
     Swal.fire({
            title: '',
            text: "Image uploaded Successfully!",
            icon: 'success',
            confirmButtonText: 'OK'
        })
    </script>

<?php  } ?>
<?php
if(isset($_POST['edit'])){


 
  $fname = $_POST['full_name'];
  //echo $fname; die();
  $phone10 =$_POST['phone'];
  //echo $phone10;
  $state10 = $_POST['state'];
  //echo $state10;
  $gender10 = $_POST['gender'];
  $dob10 = $_POST['dob']; 
  extract($_POST); 

   
   $sql = "UPDATE examinee_tbl set exmne_fullname='$fname', exmne_phoneno='$phone10', exmne_state='$state10', exmne_gender = '$gender10', exmne_birthdate = '$dob10' where exmne_id='$examnee_id'"; 
   //echo $sql; die();
    $stmt= $conn->prepare($sql);
    $stmt->execute();
    ?>
     <script type="text/javascript">
     Swal.fire({
            title: '',
            text: "Profile updated Successfully!",
            icon: 'success',
            confirmButtonText: 'OK'
        })
    </script>
<?php } ?>
<?php
$msg="";
    if(isset($_POST['Send'])){
$verify_mail = "SELECT * from examinee_tbl WHERE exmne_id = $examnee_id";
                             $result1 = $conn->prepare($verify_mail);
                             $result1->execute();
                             $row1 = $result1->fetch(PDO::FETCH_ASSOC);
                             
        $mail_id = $row1['exmne_email'];
        $name = $row1['exmne_fullname'];
        $date_ofbirth = $row1['exmne_birthdate']; 
        $to_email = $mail_id;
        $var1 = base64_encode($mail_id);
        $var2 = base64_encode($name);
        //$var3 = base64_encode($date_ofbirh);
    $subject = 'Verify Email id';
    $message = "Dear $name,
Please click the following link for verifying and activation on your account
Click the link: https://achievers.nxgsolutions.in/home.php?page=user_verified&value1='$var1'&value2='$var2'";
$headers = 'From: achieversone@nxgsolution.in';
if(mail($to_email,$subject,$message,$headers)){ 
$msg = "<span style='color:green;' >Please check you mail id and verified you mail.</span>";
} else {
  //echo "<p style='color:red;'><center><b>mail not sent</b></center></p>";
  }

        
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
.profile-pic-div{
  object-fit: cover; 
  height: 50px; 
  width: 80px;
  position: absolute;
  border-radius: 30%;
  overflow: hidden;
  border-color: 1px green;
}
#img{
  display: none;
}
#uploadBtn{
  height: 20px;
  width: 100%;
  position: absolute;
  bottom: 50%;
  text-align: center;
  background: rgba(0, 0, 0, 0.7);
  color: wheat;
  line-height: 20px;
  font-family: sans-serif;
  font-size: 15px;
  cursor: pointer;
}
    
</style>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php 
 $sql= "SELECT * FROM examinee_tbl WHERE exmne_id = $examnee_id";
            $result = $conn->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll(PDO::FETCH_ASSOC);
            foreach($rows as $row){
                ?>
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
 
     <div class="" style="background: white;border: 3px solid #375176;padding: 0px;">

      <div class="col-md-3 col-xl-3">
                </div>
<div class="w3-container">
  <div class="row gutters-sm">
<div class="col-sm-4">
  <?php if(!isset($_GET["value2"])){ ?> 
<form enctype="multipart/form-data" name="editprofile" action="home.php?page=myprofile" method="post"> 
            <div class="">
              <div class="card">
                <div class="card-body" style="padding: 36px;">
                  <div class="d-flex flex-column align-items-center text-center">
                    <?php if($row['image'] != ''){?>
                     <div class=""></div> 
                    <img src="<?php  printf("{$row['image']} "); ?>"class="rounded-circle" style= "height:150px; width: 150px;">
                    <!-- <span><i name="image" id="img" class='fas fa-pencil-alt' style='font-size:24px;color:black; padding-top: 30px;'></i></span> -->
                  <?php }else{?>
                    <img src="./uploads/dummy.png" class="" style= "">
                    <?php } ?>
                      
                        <input type="file" id="img" name="image" style="" required/>
                        <label for="img" id="uploadBtn">Browse</label>
                        <br>
                      <input type="submit" name="update" value="Save" class="btn btn-success"/>
                  
                    <div class="mt-3">
                      <h4><?php  printf("{$row['exmne_fullname']} "); ?></h4>
                      <p class="text-secondary mb-1"><?php  printf("{$row['exmne_email']} "); ?></p>
                      <p class="text-muted font-size-sm"><?php echo  $row['exmne_state']; ?></p>
                                            
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </form>
  </div>
  <div class="col-sm-8">
<form enctype="multipart/form-data" name="editprofile" action="home.php?page=myprofile" method="post">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="text" onkeyup="fakeinput()" name="full_name" id="fname1" class="form-control" value="<?php  printf("{$row['exmne_fullname']} "); ?>" />
                      <input type="hidden" onkeyup="fakeinput()" name="full_name2"id="fname2" class="form-control" value="<?php  printf("{$row['exmne_fullname']} "); ?>" />

                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <form action="" method="post">
                      <?php  printf("{$row['exmne_email']} "," ");?>
                      <?php $verify = "SELECT verify_status from examinee_tbl WHERE exmne_id = $examnee_id";
                             $result = $conn->prepare($verify);
                             $result->execute();
                             $status = $result->fetch(PDO::FETCH_ASSOC);
                             foreach($status as $wor){
                              if($wor == 0 & $msg==""){ ?>
                      <input type="submit" class="btn btn-info" id="Send" name="Send" value="Verify" >
                      <?php }else{ if($msg==""){ echo "(verified)"; } } } echo "<br>".$msg;?></form>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Date Of Birth</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="date" name="dob" id="dob1" onchange="fakeinput()" value="<?php echo date('Y-m-d',strtotime($row['exmne_birthdate'])); ?>"/>
                      <input type="hidden" id="dob2" onchange="fakeinput()" name="dob2" class="form-control" value="<?php echo date('Y-m-d',strtotime($row['exmne_birthdate'])); ?>"/>
                      <?php  //printf("{$row['exmne_birthdate']} "); ?>
                      <!-- <input class="input100" type="date" name="dob" placeholder="Enter Birthday"> -->
                    </div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Gender</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="text" name="gender" id="gender1" onkeyup="fakeinput(),myFunction('gender1')" class="form-control" value="<?php echo  $row['exmne_gender']; ?>"/>
                      <input type="hidden" id="gender2" onkeyup="fakeinput()" name="gender2" class="form-control" value="<?php echo $row['exmne_gender']; ?>"/>
                      <?php //echo  $row['exmne_gender']; ?>
                    </div>
                  </div>
                   <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">State</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="text" name="state" id="state1" onkeyup="fakeinput()" class="form-control" value="<?php echo  $row['exmne_state']; ?>"/>
                      <input type="hidden" id="state2" onkeyup="fakeinput()" name="state2" class="form-control" value="<?php echo  $row['exmne_state']; ?>"/>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Mobile</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                     <input type="text" id="phone1" onkeyup="fakeinput()" name="phone" class="form-control" value="<?php echo  $row["exmne_phoneno"]; ?>" />
                      <input type="hidden" id="phone2" onkeyup="fakeinput()" name="phone2" class="form-control" value="<?php echo  $row["exmne_phoneno"]; ?>" />
                    </div>
                  </div>
                  <hr>
              <?php } ?>

                  <div class="row">
                    <div class="col-sm-3"></div>
                  <div class="text-center">
                  <input type="submit" name="edit" id="edit1" disabled="" value="Update" class="btn btn-success"/>
                </div>
                </div>

                </div>
              </div>
                    </div>
                  </div>
                </div>
             

             </div>
            </div>
        </div>

</div>
</form>
<?php } ?>
</div>


</div>


        
</div>

</div>
<script>
    $(document).ready(function() {
    $('#Send').click(function(e) {  
      $('#Send').val("Loading...");
    });
});
</script>
<script type="text/javascript">
   function fakeinput(){
    var f1 = $('#fname1').val();
    var f2 = $('#fname2').val();
    var s1 = $('#state1').val();
    var s2 = $('#state2').val();
    var p1 = $('#phone1').val();
    var p2 = $('#phone2').val();
    var g1 = $('#gender1').val();
    var g2 = $('#gender2').val();
    var d1 = $('#dob1').val();
    var d2 = $('#dob2').val();
        if (f1 != f2) {
        document.getElementById("edit1").disabled = false;
        } else if(p1 != p2){
            document.getElementById("edit1").disabled = false;

        }else if(g1 != g2){
            document.getElementById("edit1").disabled = false;

        }else if(d1 != d2){
            document.getElementById("edit1").disabled = false;

        } else if(s1 != s2){
          document.getElementById("edit1").disabled = false;

        }
        else{
          document.getElementById("edit1").disabled = true;  
        }
    }
</script>
<script type="text/javascript">
  function myFunction(value) {
    var x = document.getElementById(value);
    x.value = x.value.toUpperCase();
  }
</script>