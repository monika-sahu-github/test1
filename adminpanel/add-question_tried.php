<?php 
session_start();
//include("../lib/getval.php");
if(!isset($_SESSION['admin']['adminnakalogin']) == true) header("location:index.php");
?><?php include("../conn.php");
    
 // $cmn = new TestCommandRun();
 ?>


<?php
    function getmixedno($totalchar)
    {
    $abc= array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "1", "2", "3", "4", "5", "6", "7", "8", "9");
    $mixedno = "";
    for($i=1; $i<=$totalchar; $i++)
    {
    $mixedno .= $abc[rand(0,33)];
    }
    return $mixedno;
    }
function fileupload_imgcompress($controlname,$extention, $uploadfolder, $quality)
    {
    $uploadfolder = trim($uploadfolder,"/");
    if(isset($_FILES[$controlname]['tmp_name']))
    {
    if($_FILES[$controlname]['error']!=4)
    {
    //$date = new DateTime();
    $timestamp = date('U');
    $swatch = date('B');
    $now = $timestamp.$swatch;
   
    $fname=$_FILES[$controlname]['name'];
    $tm="oc";
    $tm.= $now.strtolower(getmixedno(1));
    $ext = pathinfo($fname, PATHINFO_EXTENSION);
    $ext = strtolower($ext);
    $fname=$tm.".".$ext;
   
    $arrext = explode(",",$extention);
    if(in_array($ext,$arrext))
    {
       $source_url = $_FILES[$controlname]['tmp_name'];
       $info = getimagesize($source_url);
                    if ($info['mime'] == 'image/jpeg')
                    {
                        $image = imagecreatefromjpeg($source_url);
                         imagejpeg($image, "$uploadfolder/$fname", 50);
                    }
                    elseif ($info['mime'] == 'image/png')
                    {
                        $image = imagecreatefrompng($source_url);
                        imagepng($image, "$uploadfolder/$fname", 3);
                    }
                   
     
   
    return $fname;
   
    }
    else
    return 0;
    }
    }
    else
    return 0;
    }
$location = "upload";
    if (!is_dir($location)) {
        mkdir($location);
    } 
?>
<!-- MAO NI ANG HEADER -->
<?php if(isset($_REQUEST["add_now"])){
    
    

    //   $cat_tagArr=$_REQUEST["categorytag"];
    //   if($cat_tagArr != ''){
    //   $category_tag = implode(',', $cat_tagArr);
    // }else{
    //   $category_tag = '0';
    // }

    //   $sub_cat_tagArr=$_REQUEST["subcattag"];
    //   if($sub_cat_tagArr != ''){
    //   $sub_cat_tag = implode(',', $sub_cat_tagArr);
    // }else{
    //   $sub_cat_tag = '0';
    // }
    
    $main_subject_id = $_REQUEST["main_subject_id"];

    $topic_id = $_REQUEST["topic_id"];
    $sub_topic_id = $_REQUEST["sub_topic_id"];
    $category_id = $_REQUEST["category_id"];
    $sub_category_id = $_REQUEST["sub_category_id"];
    $level = $_REQUEST["level"];

    $sub_subjecthead_id = $_REQUEST["topic_id"];
    $main_subject_id = $_REQUEST["main_subject_id"];

    $explanation = addslashes($_REQUEST["explanation"]);
    $exam_question = addslashes($_REQUEST["exam_question"]);
    $choice_A1 = $_REQUEST["choice_A1"];
    $choice_B1 = $_REQUEST["choice_B1"];
    $choice_C1 = $_REQUEST["choice_C1"];
    $choice_D1 = $_REQUEST["choice_D1"];
    $correctAnswer = $_REQUEST["correctAnswer"];
    $create_date = date('Y-m-d');

    // echo "INSERT INTO exam_question_tbl(exam_id,sub_subjecthead_id,main_subject_id,topic_id,sub_topic_id,category_id,sub_category_id,exam_question,explanation,create_date,dificulty_level) VALUES('$topic_id','$topic_id','$main_subject_id','$topic_id','$sub_topic_id','$category_id','$sub_category_id','$exam_question','$explanation','$create_date','$level') "; die;

      $insQuest = $conn->query("INSERT INTO exam_question_tbl(exam_id,sub_subjecthead_id,main_subject_id,topic_id,sub_topic_id,category_id,sub_category_id,exam_question,explanation,create_date,dificulty_level) VALUES('$topic_id','$topic_id','$main_subject_id','$topic_id','$sub_topic_id','$category_id','$sub_category_id','$exam_question','$explanation','$create_date','$level') ");
  $last_q_id = $conn->lastInsertId();
    if($insQuest)
  {   $is_rightA=0;
    $is_rightB=0;
    $is_rightC=0;
    $is_rightD=0;
    $exam_answer = '';
    if($correctAnswer=="A"){ 
             $is_rightA=1;
             $exam_answer = $choice_A1;
    } else if($correctAnswer=="B"){
      $is_rightB=1;
      $exam_answer = $choice_B1;
    } else if($correctAnswer=="C"){
      $is_rightC=1;
      $exam_answer = $choice_C1;
    } else if($correctAnswer=="D"){
      $is_rightD=1;
      $exam_answer = $choice_D1;
    }

    //  $graphic_A = $_FILES["graphic_A"]["name"]; 
    // $tempname = $_FILES["graphic_A"]["tmp_name"];     
    //     $folder = "upload/".$graphic_A; 
    // move_uploaded_file($tempname, $folder); 
/////////////////////////////graphic A//////////////////////////////
$file_size2 = round($_FILES["graphic_A"]["size"],2) / 1024;
$quality1 = 6;
if($file_size2 < 400)
$quality1 = 40;
elseif($file_size2 > 400 && $file_size2 < 5120)
$quality1 = 20;
$data2="";
$graphic_A = $ans_image2 = $_FILES["graphic_A"]["name"];
if($ans_image2 !="")
$graphic_A = fileupload_imgcompress('graphic_A',"jpg,jpeg,png", $location."/",$quality1);
/////////////////////////////graphic B//////////////////////////////////////////////////
$file_size2 = round($_FILES["graphic_b"]["size"],2) / 1024;
$quality1 = 6;
if($file_size2 < 400)
$quality1 = 40;
elseif($file_size2 > 400 && $file_size2 < 5120)
$quality1 = 20;
$data2="";
$graphic_b = $ans_image2 = $_FILES["graphic_b"]["name"];
if($ans_image2 !="")
$graphic_b = fileupload_imgcompress('graphic_b',"jpg,jpeg,png", $location."/",$quality1); 
///////////////////////////graphic C///////////////////////////////////////////
$file_size2 = round($_FILES["graphic_c"]["size"],2) / 1024;
$quality1 = 6;
if($file_size2 < 400)
$quality1 = 40;
elseif($file_size2 > 400 && $file_size2 < 5120)
$quality1 = 20;
$data2="";
$graphic_c = $ans_image2 = $_FILES["graphic_c"]["name"];
if($ans_image2 !="")
$graphic_c = fileupload_imgcompress('graphic_c',"jpg,jpeg,png", $location."/",$quality1); 
/////////////////////////graphic D/////////////////////////////////////////////
$file_size2 = round($_FILES["graphic_d"]["size"],2) / 1024;
$quality1 = 6;
if($file_size2 < 400)
$quality1 = 40;
elseif($file_size2 > 400 && $file_size2 < 5120)
$quality1 = 20;
$data2="";
$graphic_d = $ans_image2 = $_FILES["graphic_d"]["name"];
if($ans_image2 !="")
$graphic_d = fileupload_imgcompress('graphic_d',"jpg,jpeg,png", $location."/",$quality1);


  $conn->query("INSERT INTO exam_answers_option(quehead_id,eqt_id,answer,is_right,create_date,atod,graphic) VALUES('$sub_subjecthead_id','$last_q_id','$choice_A1','$is_rightA','$create_date','A','$graphic_A')");
   $l1 = $conn->lastInsertId();
     $conn->query("INSERT INTO exam_answers_option(quehead_id,eqt_id,answer,is_right,create_date,atod,graphic) VALUES('$sub_subjecthead_id','$last_q_id','$choice_B1','$is_rightB','$create_date','B','$graphic_b')");
     $l2 = $conn->lastInsertId();
     $conn->query("INSERT INTO exam_answers_option(quehead_id,eqt_id,answer,is_right,create_date,atod,graphic) VALUES('$sub_subjecthead_id','$last_q_id','$choice_C1','$is_rightC','$create_date','C','$graphic_c')");
     $l3 = $conn->lastInsertId();
   $conn->query("INSERT INTO exam_answers_option(quehead_id,eqt_id,answer,is_right,create_date,atod,graphic) VALUES('$sub_subjecthead_id','$last_q_id','$choice_D1','$is_rightD','$create_date','D','$graphic_d')");
   $l4 = $conn->lastInsertId();
   $exam_answer_id = '';
   if($correctAnswer=="A"){
            $exam_answer_id=$l1;  
    } else if($correctAnswer=="B"){
       $exam_answer_id=$l2; 
    } else if($correctAnswer=="C"){
       $exam_answer_id=$l3; 
    } else if($correctAnswer=="D"){
      $exam_answer_id=$l4;  
    }

   $conn->query("update exam_question_tbl set exam_answer = '$exam_answer', exam_answer_id = '$exam_answer_id' WHERE eqt_id = '$last_q_id' ");
     //$res = array("res" => "success");
   //echo "ok";die;
?>
<script>
window.location.href='add-question.php?msg=success&id=<?php echo $main_subject_id; ?>';
</script>
<?php
}
  else
  { ?>
    <script>
window.location.href='add-question.php?msg=fail&id=<?php echo $main_subject_id; ?>';
</script>
 <?php }
}
$mmsg="";
if(isset($_REQUEST["msg"])){
  $mmsg = "<span style='color:green;margin-left: 27px;'>Question Added!</span>";
}

 ?>

<?php include("includes/header.php"); ?>      
<!-- UI THEME DIRI -->
<?php include("includes/ui-theme.php"); ?>
<script src="../ckeditor/ckeditor.js"></script>
<script src="../ckeditor/samples/js/sample.js"></script>
  <script>
    function get_sub_topic(){
         
  topic_id = $("#topic_id").val();
  
  //alert(topic_id);
  
   if(topic_id!=""){
     $.ajax({ 
   
type: "POST",
url: "get_sub_topic.php", 
data: 'topic_id='+topic_id,
success: function(data) {
//alert(data);
$("#sub_topic_id").html(data);

}});}
  }

</script>
<link rel="stylesheet" href="css/chosen.css">
 <style type="text/css">
  @media only screen and (max-width: 600px) {
  #resetdiv{
    margin-top: 10px;
  }
}
#output {
  padding: 0px;
   
}
.chosen-container-multi{
  width: 100% !important;
}
.search-choice-close{
  color: black !important;
}
 </style>
 <!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<div class="app-main">
<!-- sidebar diri  -->

<?php include("includes/sidebar.php"); ?>
<?php 
$topic_name ="";
$topic_id = "";
$topic_id = "";
$subject_name="";
if(isset($_GET['id'])){
   $subject_id = $_GET['id'];
   $subject_name1 = $cmn->getvalfield($conn,"main_subject","ex_title","ex_id='$subject_id'");

$subject_name = $cmn->getvalfield($conn,"main_subject","ex_title","ex_id='$subject_id'");

}
 ?>
    
<div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                     <div class="page-title-heading">
                        <div> Add Question
                            <div class="page-title-subheading">
                              Add Question for <b><?php echo $subject_name1; ?></b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
            
            <div class="col-md-12">
            <div id="refreshData">
            <div class="row">
                  <div class="col-md-12">
                      <div class="main-card mb-3 card">
                          <div class="card-header">
                            <i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>Question Information 
                          </div> <br>
                            <?php echo $mmsg; ?>
                          <div class="card-body">  
                            <form class="refreshFrm" id="addQuestionFrm2v" method="post" enctype="multipart/form-data" >
                              <input type="hidden" name="action" value="add">
     <div class="modal-content"> 
      <div class="modal-header">
  
        <p class="modal-title" id="exampleModalLabel">Subject: <b><?php echo $subject_name1; ?></b></p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
       
       
       <?php  ?>
       <input type="hidden" name="main_subject_id" id="subject_id2" value="<?php echo $subject_id; ?>">
      <div class="modal-body">
        
        
         
        
        <div class="col-md-12">
          

             <div class="col-md-12">
                    <div class="col-sm-6">
            <label ><b>Difficulty Level</b></label>
            <select name="level" class="form-control chosen-select" required="" >
              <option value="">Select</option> 
              <option value="1">Beginner</option>
              <option value="2">Intermediate</option>
              <option value="3">Advanced</option>
              <option value="4">Basic</option>
            </select>
           
          </div>
        </div>
             <div class="col-md-12" style="">
                    <div class="col-sm-6">
            <label ><b>Topic</b></label>
            <select name="topic_id" class="form-control chosen-select" id="topic_id" onchange="get_sub_topic()">
              <!-- onchange="get_category();"  -->
              <?php  $sql = $conn->query("SELECT * FROM subject_quehead  WHERE main_subject_id = '$subject_id' ORDER BY id DESC ");
 ?>
              <option value="">Select</option> 
              <?php
while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
?>
    <option value="<?php echo $row["id"] ?>" ><?php echo $row["quehead"]; ?></option>
<?php } ?>
            </select>
           
          </div>
        </div>
        
        <div class="col-md-12">
                    <div class="col-sm-6">
            <label ><b>Sub Topic</b></label>
            <div id="sub_div">
            <select name="sub_topic_id" class="form-control chosen-select" id="sub_topic_id" style="">
              <!-- onchange="get_category();"  -->
              
              <option value="">Select</option> 
            </select>
           </div>
          </div>
        </div>
         
        <div class="col-md-12">
        <div class="col-sm-6">
              <label><b>Category</b></label>
               
                <select name="category_id" class="form-control chosen-select" id="category_id" >
                <option value="">Select</option> 
                 
               </select>
            </div>
          </div>
            <input type="button" onclick="changeLook();">Change</button>
            
          <div class="col-md-12">
        <div class="col-sm-6">
              <label><b>Sub category</b></label>
               
                <select name="sub_category_id " class="form-control chosen-select" id="sub_category_id" >
                <option value="">Select</option> 
                 
               </select>
            </div>
          </div>

         
        <!-- <div class="form-group">
              <label>Sub Category Tag</label>
               <select data-placeholder="Select Tags" id="tag" name="subcattag[]" multiple class="chosen-select">
                <?php  $sql = $conn->query("SELECT * FROM sub_category_master  WHERE topic_id = '$topic_id' AND status='0' ORDER BY id DESC ");
                  while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                ?>
                 <option value="<?php echo $row["id"]; ?>"><?php echo $row["sub_category_name"]; ?></option> 
                 <?php } ?>
               </select>
            </div> -->
            <div class="form-group">
            <label><b>Question</b></label>
            
            
                <textarea name="exam_question" id="editor11" rows="10" cols="80">
               
            </textarea>
            <script>
                CKEDITOR.replace( 'editor11' );
            </script>
          </div>
           <div class="form-group">
            <label><b>Explanation</b></label>
            
            <!-- <input type="" name="question" id="question" class="form-control" placeholder="Input question" autocomplete="off"> -->
                <textarea name="explanation" id="editor2" rows="10" cols="80">
               
            </textarea>
            <script>
                CKEDITOR.replace( 'editor2' );
            </script>
          </div>


          <fieldset>
            <legend>Input word for Options</legend>
            <div class="form-group">
                <label>Option A</label>
                <input type="" name="choice_A1" id="choice_A1" class="form-control" placeholder="Input Option A" autocomplete="off">
                Graphic <input type="checkbox" name="option_A_chk" id="option_A_chk">
               <span id="up1" style="display: none;">Upload File : <input type="file"  name="graphic_A" id="graphic_A"></span> 
            </div>

            <div class="form-group">
                <label>Option B</label>
                <input type="" name="choice_B1" id="choice_B1" class="form-control" placeholder="Input Option B" autocomplete="off">
                Graphic <input type="checkbox" name="option_B_chk" id="option_B_chk">
                <span id="up2" style="display: none;">Upload File : <input type="file"  name="graphic_b" id="graphic_b"></span> 
            </div>

            <div class="form-group">
                <label>Option C</label>
                <input type="" name="choice_C1" id="choice_C1" class="form-control" placeholder="Input Option C" autocomplete="off">
                Graphic <input type="checkbox" name="option_C_chk" id="option_C_chk">
                <span id="up3" style="display: none;">Upload File : <input type="file"  name="graphic_c" id="graphic_c"></span> 
            </div>
 
            <div class="form-group">
                <label>Option D</label>
                <input type="" name="choice_D1" id="choice_D1" class="form-control" placeholder="Input Option D" autocomplete="off">
                Graphic <input type="checkbox" name="option_D_chk" id="option_D_chk">
                <span id="up4" style="display: none;">Upload File : <input type="file"  name="graphic_d" id="graphic_d"></span> 
            </div>

            <div class="form-group">
                <label>Correct Answer</label>
                <!-- <input type="" name="correctAnswer" id="" class="form-control" placeholder="Input correct answer" autocomplete="off"> -->
                <select name="correctAnswer" id="correctAnswer" class="form-control" >
                  <option value="" >Select</option>
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                  <option value="D">D</option>
                </select>
            </div>

          </fieldset>

          
          
        </div>
      </div>
      <div class="modal-footer">
        <a href="home.php?page=manage-exam" class="btn btn-dark" data-dismiss="modal">Close</a>
        <button type="submit" name="add_now" class="btn btn-primary">Add Now</button>
      </div>
      
    </div>
   </form>
</div>
                      </div>
                   
                  </div></div>
              </div>  
            </div> 
            </div>
               
            </div>

 <script type="text/javascript">
   function get_sub_topic(){

    topic_id = document.getElementById('topic_id').value;
    
    $.ajax ({
      type: "POST",
      url: "get_sub_topic.php",
      data: "topic_id="+topic_id,
      success: function(data){
        
        $('#sub_div').html(data);
         
        get_category();
        get_sub_category();
       
      
          }
    });

          changeLook();
    
  }
 
   function get_category(){

    topic_id = document.getElementById('topic_id').value;
    
    $.ajax ({
      type: "POST",
      url: "get_category.php",
      data: "topic_id="+topic_id,
      success: function(data){
        
        $('#category_id').html(data);
          }
    });
    
  }
  function get_sub_category(){

    topic_id = document.getElementById('topic_id').value;
    
    $.ajax ({
      type: "POST",
      url: "get_sub_category.php",
      data: "topic_id="+topic_id,
      success: function(data){
        
        $('#sub_category_id').html(data);
          }
    });
    
  }
 </script>   
 <script src="js/classie.js"></script>
<script src="js/chosen.jquery.js" type="text/javascript"></script>
<!--<script src="js/chosen.jquery.min.js" type="text/javascript"></script>-->
<script type="text/javascript">
        // Chosen touch support.
    if ($('.chosen-select').length > 0) {
      $('.chosen-select').on('touchstart', function(e){
        e.stopPropagation(); e.preventDefault();
        // Trigger the mousedown event.
        $(this).trigger('mousedown');
      });
    }
    </script>
 <script>
 function changeLook()
{
  var config = {
      '.chosen-select' : {}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);}
}
changeLook();
</script>
    

<!-- MAO NI IYA FOOTER -->
<?php include("includes/footer.php"); ?>

<?php include("includes/modals.php"); ?>
