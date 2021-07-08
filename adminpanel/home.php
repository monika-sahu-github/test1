<?php 
session_start();

if(!isset($_SESSION['admin']['adminnakalogin']) == true) header("location:index.php");

 
 ?> 
<?php //include("../conn.php"); ?>
<!-- MAO NI ANG HEADER -->
<?php include("includes/header.php"); ?>      

<!-- UI THEME DIRI -->
<?php include("includes/ui-theme.php"); ?>
 
<div class="app-main">
<!-- sidebar diri  -->
<?php include("includes/sidebar.php"); ?>



<!-- Condition If unza nga page gi click -->
<?php 

   @$page = $_GET['page'];

//echo ">>>>".$page;die;

   if($page != '')
   {
     if($page == "add-course")
     {
     include("pages/add-course.php");
     }else if($page == "tag")
     {
      include("pages/add_tags.php");
     }
      else if($page == "exam-master")
     {
      include("pages/exam-master.php");
     }
     else if($page == "subject-master")
     {
      include("pages/subject-master.php");
     }
     else if($page == "category-master")
     {
      include("pages/category-master.php");
     }
      else if($page == "sub-category-master")
     {
      include("pages/sub-category-master.php");
     }
     else if($page == "topic-master")
     {
      include("pages/topic-master.php");
     }
     else if($page == "sub-topic-master")
     {
      include("pages/sub-topic-master.php");
     }
     else if($page == "manage-mock-test")
     {
      include("pages/manage-mock-test.php");
     }
     else if($page == "manage-course")
     {
     	include("pages/manage-course.php");
     }
     else if($page == "manage-exam")
     {
      include("pages/manage-exam.php");
     }
     else if($page == "manage-examinee")
     {
      include("pages/manage-examinee.php");
     }
     else if($page == "ranking-exam")
     {
      include("pages/ranking-exam.php");
     }
     else if($page == "feedbacks")
     {
      include("pages/feedbacks.php");
     }
     else if($page == "examinee-result")
     {
      include("pages/examinee-result.php");
     }
     else if($page == "question-list")
     {
      include("pages/question-list.php");
     }
      else if($page == "notifications")
     {
      include("pages/notifications.php");
     }
}
   // Else ang home nga page mo display
   else
   { 
     include("pages/home.php"); 
   }


 ?> 


<!-- MAO NI IYA FOOTER -->
<?php include("includes/footer.php"); ?>

<?php include("includes/modals.php"); ?>
