<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.0/css/fontawesome.min.css">

<style type="text/css">

  .a {

    position: absolute;

    right: 30px;

    transform: translate(0, -6px);

    top: 19%;

    cursor: pointer;



  }

    .b {

    position: absolute;

    right: 30px;

    transform: translate(0, -6px);

    top: 44%;

    cursor: pointer;



  }

     .c {

    position: absolute;

    right: 30px;

    transform: translate(0, -6px);

    top: 69%;

    cursor: pointer;



  }

  .fas{

    font-size: 16px;

    /*color: #5a5555;*/

  }

</style>

 <?php

 

 $page_name="Change password";

  $flag=0;

                                if(isset($_POST['Submit']))

                                {

                                    $password = $_POST['password'];

                                    

                                    $new_password = $_POST['new_pass'];

                                    

                                    extract($_POST);

                                    

                                    

                                    $selAcc = $conn->query("SELECT * FROM examinee_tbl WHERE exmne_id= '$examnee_id' AND exmne_password= '$password' ");

                                    $selAcc->fetch(PDO::FETCH_ASSOC);

                                    if($selAcc->rowCount() > 0){ 

                                        

                                        

                                         $sql = "UPDATE examinee_tbl SET exmne_password='".$new_password."' WHERE exmne_id=".$examnee_id;

                                        $stmt= $conn->prepare($sql);

                                        $stmt->execute($data);

                                        

                                        $flag=2;

                                    }

                                    else

                                    {

                                        $flag=1;

                                    }

                                    unset($_POST['Submit']);

                                }



    ?>

    <script src="ckeditor/ckeditor.js"></script>

    <script src="ckeditor/samples/js/sample.js"></script>







<div class="app-main__outer">

 <div id="refreshData">

    <div class="app-main__inner">

            <div class="app-page-title">

                <div class="page-title-wrapper">

                    <div class="page-title-heading">

                        <!-- <div class="page-title-icon">

                            <i class="fa fa-university">

                            </i>

                        </div> -->

                        <div>Change Password

                            <!-- <div class="page-title-subheading">This is an example dashboard created using build-in elements and components.

                            </div> -->

                        </div>

                    </div>

                     

                 </div>

            </div>    <div class="breadcrumb">  <a href="home.php?page=dashboard" class="anchr-tagcolor">Dashboard</a><a href="home.php?page=change_pass" class="anchr-tagcolor"><?php echo $page_name; ?></a>

    </div>



             <div class="row" style="background: white;border: 3px solid #375176;padding: 0px;">



      <div class="col-md-3 col-xl-3">

    

                </div>

               <div class="col-md-6 col-xl-6" >

                      &nbsp;

                                <?php

                                

                                    if($flag==1){ 

                                           

                                           ?>

                                           <div class="alert alert-danger">

                                                <strong>Failed!</strong> Please enter valid password.

                                                </div>

                                           <?php

                                            }

                                             if($flag==2){ 

                                           

                                           ?>

                                           <div class="alert alert-success">

                                                <strong></strong> Your password has been changed successfully.

                                                </div>

                                           <?php

                                            }

                                            

                                            if($flag==0 or $flag==1)

                                            {

                                

                                ?>

                   

                

                   <form method="POST">

                         

                        <div class="form-group">

                            <label for="email">Current Password:</label>

                            <input type="password" class="form-control"  name="password" id="o_password" required placeholder="Enter current password">

                            <span class="a"><i class="fas fa-eye" aria-hidden="true" id="eye1" onclick="toggle()"></i></span>

                         </div>

                         

                         

                         <div class="form-group">

                            <label for="email">New Password:</label>

                            <input type="password" name="new_pass" id="password" placeholder="Enter new password" class="form-control" required>

                            <span class="b">

                              <i class="fas fa-eye" id="eye2" aria-hidden="true" onclick="toggle1()"></i>

                            </span>

                         </div>

                         <div class="form-group">

                            <label for="email">Re Enter New Password:</label>

                            <input type="password" name="pass2" id="confirm_password" placeholder="Re-Enter new password" class="form-control" required>

                            <span class="c">

                              <i class="fas fa-eye" id="eye3" aria-hidden="true" onclick="toggle2()"></i>

                            </span>

                         </div>

                         <div class="form-group">

                         <span id='message'></span>

                          

                          </div>

                          

                            <div class="form-group">

                          <button type="submit" id="subreg" name="Submit" class="btn btn-success" value="Change password">Submit</button></div></div>

                          

                          </div>

                          

                   </form>

        <?php } ?>

              

                </div>

               

                <div class="col-md-3 col-xl-3">

    

                </div>

            

            </div>

      

        

        </div>

         

    </div>

 



<!-- <script src="login-ui/vendor/jquery/jquery-3.2.1.min.js"></script>

    <script src="login-ui/vendor/animsition/js/animsition.min.js"></script>

    <script src="login-ui/vendor/bootstrap/js/popper.js"></script>

    <script src="login-ui/vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="login-ui/vendor/select2/select2.min.js"></script>

    <script src="login-ui/vendor/daterangepicker/moment.min.js"></script>

    <script src="login-ui/vendor/daterangepicker/daterangepicker.js"></script>

    <script src="login-ui/vendor/countdowntime/countdowntime.js"></script>

    <script src="login-ui/js/main.js"></script> -->

<script>

 var state = false;

 var state1 = false;

 var state2 = false;

  function toggle(){

    if(state){

      document.getElementById("o_password").setAttribute("type","password");

      document.getElementById("eye1").style.color='#5a5555';

      state = false;

    }

    else{

        document.getElementById("o_password").setAttribute("type","text");

      document.getElementById("eye1").style.color='#9c9393';

      state = true;

      }

    }

    function toggle1(){

      if(state1){

      document.getElementById("password").setAttribute("type","password");

      document.getElementById("eye2").style.color='#5a5555';

      state1 = false;

    }

     else{

         document.getElementById("password").setAttribute("type","text");

      document.getElementById("eye2").style.color='#9c9393';

      state1 = true;

      }

    }

    function toggle2(){

    if(state2){

      document.getElementById("confirm_password").setAttribute("type","password");

      document.getElementById("eye3").style.color='#5a5555';

      state2 = false;

    }

    else{

      document.getElementById("confirm_password").setAttribute("type","text");

      document.getElementById("eye3").style.color='#9c9393';

      state2 = true;

      }

     

      

    }

  

</script>

<script>

    function showdiv(){

         $(".box").animate({

                width: "toggle"

            });

     }

</script>

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

<script type="text/javascript">

   



function openwindow(){

window_height = screen.height;

window_width =  screen.width;

let params = 'minimizable=no,scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width='+window_width+',height='+window_height+',left=-1000,top=-1000';



open('home.php?page=start_exam&exam_type=<?php echo $_REQUEST['exam_type']; ?>&question_head_id=<?php echo $_REQUEST['question_head_id']; ?>&queheadid=<?php echo $_REQUEST['queheadid']; ?>', 'test', params);

}

</script>

