<?php 
session_start();
if(!isset($_SESSION['examineeSession']['examineenakalogin']) == true) header("location:index.php");
$examnee_id = $_SESSION['examineeSession']['exmne_id'];
 unset($_SESSION['quesession_array']);
 ?>
<?php include("conn.php"); ?>
<!-- MAO NI ANG HEADER -->
<?php  @$page = $_GET['page'];
  

include("includes/header.php"); ?>      

<!-- UI THEME DIRI -->
<?php  //include("includes/ui-theme.php"); ?>

<div class="app-main">
<!-- sidebar diri  -->
<?php  
if($page != 'start_exam'){

  include("includes/sidebar.php"); } ?>
<!-- Condition If unza nga page gi click -->
<?php 
     //echo "???".$page;die;
if($page != '')
   {
     if($page == "exam")
     {
       include("pages/exam1.php");
     }
     else if($page == "all_results")
     { //echo ">>>>>";die;
       include("pages/all_results.php");
     }
     else if($page == "mock_on_test")
     { //echo ">>>>>";die;
       include("pages/mock_on_test.php");
     }
     else if($page == "mock")
     {
       include("pages/mocktest.php");
     }
     else if($page == "mock-test")
     {
       include("pages/mock_test2.php");
     }
      else if($page == "mock_test")
     {
       include("pages/mock_test.php");
     }
     else if($page == "mock_result")
     {
       include("pages/mock_result.php");
     }
      else if($page == "mock_results")
     {
       include("pages/mock_results.php");
     }
      else if($page == "result_date")
     {
       include("pages/result_date.php");
     }
     else if($page == "result")
     {
       include("pages/result.php");
     }
     else if($page == "myscores")
     {
       include("pages/myscores.php");
     }
     else if($page == "examination_test_type")
     {
       include("pages/examination_test_type.php");
     }
     else if($page == "get_subject_quehead")
     {
       include("pages/get_subject_quehead.php");
     }
     else if($page == "get_subjecthead_que")
     {
       include("pages/get_subjecthead_que.php");

     }
     else if($page == "start_exam")
     {
        include("pages/start_exam.php");

     }
     else if($page == "gotresult")
     {  //echo "fdsfsdffs";
       include("pages/gotresult.php");

     } else if($page == "result_session"){
       include("pages/result_session.php");
     } else if($page == "dashboard"){
       include("pages/dashboard.php");
     }else if($page == "all_notifications"){
       include("pages/all_notifications.php");
     }
     else if($page == "change_pass"){
       include("pages/change_pass.php");
     }
     else if($page == "my_account"){
       include("pages/my_account.php");
     }
     else if($page == "myprofile"){
        include("pages/myprofile.php");
     }
     else if($page == "dashboard_test"){
        include("pages/dashboard_test.php");
     }
      else if($page == "user_verified"){
        include("pages/userverified.php");
     }
     
   }
   // Else ang home nga page mo display
   else
   { //echo "ffffffffffffffffffffffffffffffffff";
     include("pages/home.php"); 
   }

//echo $page;
 ?> 


<!-- MAO NI IYA FOOTER -->
<?php include("includes/footer.php"); ?>

<?php include("includes/modals.php"); ?>


