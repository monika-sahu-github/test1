<?php 
session_start();

if(!isset($_SESSION['admin']['adminnakalogin']) == true) header("location:index.php");
 include("../conn.php");
    
 

  ?> 

<?php include("includes/header.php"); ?>  
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
    if(isset($_REQUEST["update"])){ 

    // $cat_tagArr=$_REQUEST["categorytag"];
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

    $level = $_REQUEST['dificulty_level'];
    
    $topic_id = $_REQUEST['topic_id'];
    $sub_topic_id = $_REQUEST['sub_topic_id'];
    $category_id = $_REQUEST['category_id'];
    $sub_category_id = $_REQUEST['sub_category_id'];

    $main_subject_id = $_REQUEST['main_subject_id'];

    $sub_subjecthead_id = $_REQUEST["sub_subjecthead_id"];
    $eqt_id = $_REQUEST["eqt_id"];
    $explanation = addslashes($_REQUEST["explanation"]);
    $exam_question = addslashes($_REQUEST["exam_question"]);
    $choice_A1 = $_REQUEST["choice_A1"];
    $choice_B1 = $_REQUEST["choice_B1"];
    $choice_C1 = $_REQUEST["choice_C1"];
    $choice_D1 = $_REQUEST["choice_D1"];
    $correctAnswer = $_REQUEST["correctAnswer"];
    $create_date = date('Y-m-d');

    $updQuest = $conn->query("UPDATE exam_question_tbl SET exam_question= '$exam_question',explanation='$explanation',create_date='$create_date', topic_id='$topic_id', sub_topic_id='$sub_topic_id', category_id='$category_id', sub_category_id='$sub_category_id', dificulty_level='$level' WHERE eqt_id = '$eqt_id'"); 
    // $updQuest = $conn->query("UPDATE exam_question_tbl SET exam_question= '$exam_question',explanation='$explanation',create_date='$create_date', topic_id='$topic_id', sub_topic_id='$sub_topic_id', category_id='$category_tag', sub_category_id='$sub_cat_tag', dificulty_level='$level' WHERE eqt_id = '$eqt_id'"); 
    //echo "dd";die;
    if($updQuest){
    $is_rightA=0;
    $is_rightB=0;
    $is_rightC=0;
    $is_rightD=0;
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


    /////////////////////////////graphic A//////////////////////////////
// $file_size2 = round($_FILES["graphic_A"]["size"],2) / 1024;
// $quality1 = 6;
// if($file_size2 < 400)
// $quality1 = 40;
// elseif($file_size2 > 400 && $file_size2 < 5120)
// $quality1 = 20;
// $data2="";
// $graphic_A = $ans_image2 = $_FILES["graphic_A"]["name"];
// if($ans_image2 !="")
// $graphic_A = fileupload_imgcompress('graphic_A',"jpg,jpeg,png", $location."/",$quality1);
/////////////////////////////graphic B//////////////////////////////////////////////////
// $file_size2 = round($_FILES["graphic_b"]["size"],2) / 1024;
// $quality1 = 6;
// if($file_size2 < 400)
// $quality1 = 40;
// elseif($file_size2 > 400 && $file_size2 < 5120)
// $quality1 = 20;
// $data2="";
// $graphic_b = $ans_image2 = $_FILES["graphic_b"]["name"];
// if($ans_image2 !="")
// $graphic_b = fileupload_imgcompress('graphic_b',"jpg,jpeg,png", $location."/",$quality1); 
///////////////////////////graphic C///////////////////////////////////////////
// $file_size2 = round($_FILES["graphic_c"]["size"],2) / 1024;
// $quality1 = 6;
// if($file_size2 < 400)
// $quality1 = 40;
// elseif($file_size2 > 400 && $file_size2 < 5120)
// $quality1 = 20;
// $data2="";
// $graphic_c = $ans_image2 = $_FILES["graphic_c"]["name"];
// if($ans_image2 !="")
// $graphic_c = fileupload_imgcompress('graphic_c',"jpg,jpeg,png", $location."/",$quality1); 
/////////////////////////graphic D/////////////////////////////////////////////
// $file_size2 = round($_FILES["graphic_d"]["size"],2) / 1024;
// $quality1 = 6;
// if($file_size2 < 400)
// $quality1 = 40;
// elseif($file_size2 > 400 && $file_size2 < 5120)
// $quality1 = 20;
// $data2="";
// $graphic_d = $ans_image2 = $_FILES["graphic_d"]["name"];
// if($ans_image2 !="")
// $graphic_d = fileupload_imgcompress('graphic_d',"jpg,jpeg,png", $location."/",$quality1);
//echo "UPDATE exam_answers_option SET graphic='$graphic_A' WHERE eqt_id = '$eqt_id' AND quehead_id = '$sub_subjecthead_id' AND atod = 'A'";die;
// if($graphic_A!=''){
//   $conn->query("UPDATE exam_answers_option SET graphic='$graphic_A' WHERE eqt_id = '$eqt_id' AND quehead_id = '$sub_subjecthead_id' AND atod = 'A'");
// }
// if($graphic_b!=''){
//   $conn->query("UPDATE exam_answers_option SET graphic='$graphic_b' WHERE eqt_id = '$eqt_id' AND quehead_id = '$sub_subjecthead_id' AND atod = 'B'");
// }
// if($graphic_c!=''){
//   $conn->query("UPDATE exam_answers_option SET graphic='$graphic_c' WHERE eqt_id = '$eqt_id' AND quehead_id = '$sub_subjecthead_id' AND atod = 'C'");
// }
// if($graphic_d!=''){
//   $conn->query("UPDATE exam_answers_option SET graphic='$graphic_d' WHERE eqt_id = '$eqt_id' AND quehead_id = '$sub_subjecthead_id' AND atod = 'D'");
// }



    $conn->query("UPDATE exam_answers_option SET answer='$choice_A1',is_right='$is_rightA' WHERE eqt_id = '$eqt_id' AND quehead_id = '$sub_subjecthead_id' AND atod = 'A'");
    $l1 = $cmn->getvalfield($conn,"exam_answers_option","id","eqt_id = '$eqt_id' AND quehead_id = '$sub_subjecthead_id' AND atod = 'A'");
    $conn->query("UPDATE exam_answers_option SET answer='$choice_B1',is_right='$is_rightB' WHERE eqt_id = '$eqt_id' AND quehead_id = '$sub_subjecthead_id' AND atod = 'B'");
    $l2 = $cmn->getvalfield($conn,"exam_answers_option","id","eqt_id = '$eqt_id' AND quehead_id = '$sub_subjecthead_id' AND atod = 'B'");
    $conn->query("UPDATE exam_answers_option SET answer='$choice_C1',is_right='$is_rightC' WHERE eqt_id = '$eqt_id' AND quehead_id = '$sub_subjecthead_id' AND atod = 'C'");
    $l3 = $cmn->getvalfield($conn,"exam_answers_option","id","eqt_id = '$eqt_id' AND quehead_id = '$sub_subjecthead_id' AND atod = 'C'");
    $conn->query("UPDATE exam_answers_option SET answer='$choice_D1',is_right='$is_rightD' WHERE eqt_id = '$eqt_id' AND quehead_id = '$sub_subjecthead_id' AND atod = 'D'");
    $l4 = $cmn->getvalfield($conn,"exam_answers_option","id","eqt_id = '$eqt_id' AND quehead_id = '$sub_subjecthead_id' AND atod = 'D'");
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


     $conn->query("update exam_question_tbl set exam_answer = '$exam_answer', exam_answer_id = '$exam_answer_id' WHERE eqt_id = '$eqt_id' ");

     echo "<script>
alert('Question Updated Succesfully!');
window.location.href='home.php?page=question-list&id=".$main_subject_id."';
</script>";
    }
}
?>
<!-- MAO NI ANG HEADER -->


    
<!-- UI THEME DIRI -->
<?php include("includes/ui-theme.php"); ?>
<script src="../ckeditor/ckeditor.js"></script>
<script src="../ckeditor/samples/js/sample.js"></script>
 
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
<div class="app-main">
<!-- sidebar diri  -->

<?php include("includes/sidebar.php"); ?>
<?php 


   $eqt_id = $id = $_GET['id'];
  
  
  $selQueRow = $conn->query("SELECT * FROM exam_question_tbl WHERE eqt_id='$id' AND status='0'")->fetch(PDO::FETCH_ASSOC);
 

  $level = $selQueRow['dificulty_level'];
  $topic_id = $selQueRow["topic_id"];
    $sub_topic_id = $selQueRow["sub_topic_id"];

    $category_id = $selQueRow["category_id"];

    $sub_category_id = $selQueRow["sub_category_id"];
    
    
    

  $exam_question = $selQueRow['exam_question'];
  $exam_answer = $selQueRow['exam_answer'];
  $exam_answer_id = $selQueRow['exam_answer_id'];
  $explanation = $selQueRow['explanation'];
  $exam_answer = $selQueRow['exam_answer'];

  $main_subject_id = $selQueRow['main_subject_id'];
  $sub_subjecthead_id =$selQueRow['sub_subjecthead_id'];

  
  $choice_A1 = $cmn->getvalfield($conn,"exam_answers_option","answer","eqt_id = '$eqt_id' and quehead_id = '$sub_subjecthead_id' and atod = 'A'");
   $choice_A1_id = $cmn->getvalfield($conn,"exam_answers_option","id","eqt_id = '$eqt_id' and quehead_id = '$sub_subjecthead_id' and atod = 'A'");
  $choice_B1 = $cmn->getvalfield($conn,"exam_answers_option","answer","eqt_id = '$eqt_id' and quehead_id = '$sub_subjecthead_id' and atod = 'B'");
   $choice_B1_id = $cmn->getvalfield($conn,"exam_answers_option","id","eqt_id = '$eqt_id' and quehead_id = '$sub_subjecthead_id' and atod = 'B'");
  $choice_C1 = $cmn->getvalfield($conn,"exam_answers_option","answer","eqt_id = '$eqt_id' and quehead_id = '$sub_subjecthead_id' and atod = 'C'");
  $choice_C1_id = $cmn->getvalfield($conn,"exam_answers_option","id","eqt_id = '$eqt_id' and quehead_id = '$sub_subjecthead_id' and atod = 'C'");
  $choice_D1 = $cmn->getvalfield($conn,"exam_answers_option","answer","eqt_id = '$eqt_id' and quehead_id = '$sub_subjecthead_id' and atod = 'D'");
  $choice_D1_id = $cmn->getvalfield($conn,"exam_answers_option","id","eqt_id = '$eqt_id' and quehead_id = '$sub_subjecthead_id' and atod = 'D'");

  $isRight_A1 = $cmn->getvalfield($conn,"exam_answers_option","is_right","eqt_id = '$eqt_id' and quehead_id = '$sub_subjecthead_id' and atod = 'A'");
  $isRight_B1 = $cmn->getvalfield($conn,"exam_answers_option","is_right","eqt_id = '$eqt_id' and quehead_id = '$sub_subjecthead_id' and atod = 'B'");
  $isRight_C1 = $cmn->getvalfield($conn,"exam_answers_option","is_right","eqt_id = '$eqt_id' and quehead_id = '$sub_subjecthead_id' and atod = 'C'");
  $isRight_D1 = $cmn->getvalfield($conn,"exam_answers_option","is_right","eqt_id = '$eqt_id' and quehead_id = '$sub_subjecthead_id' and atod = 'D'");

 ?>
 <?php
      $sub_topic_name = $cmn->getvalfield($conn,"sub_topic_master","sub_topic_name","id =$sub_topic_id and topic_id = '$topic_id'");
 ?>
 
      <?php 
       $subject_name1 = $cmn->getvalfield($conn,"main_subject","ex_title","ex_id='$main_subject_id'");
 ?>
 
<div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                     <div class="page-title-heading">
                        <div> Edit Question
                            <div class="page-title-subheading">
                              Edit Question for <b><?php echo $subject_name1; ?></b>
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
                            
                          <div class="card-body">  
                            <form class="refreshFrm" id="" method="post" enctype="" >
                              <input type="hidden" name="action" value="add">
     <div class="modal-content"> 
      <div class="modal-header">
  
        <p class="modal-title" id="exampleModalLabel">Subject: <b><?php echo $subject_name1; ?></b></p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
       
       
       <input type="hidden" name="eqt_id" value="<?php echo $eqt_id; ?>">
       <input type="hidden" name="main_subject_id" id="subject_id2" value="<?php echo $main_subject_id; ?>">
      <input type="hidden" name="sub_subjecthead_id" id="sub_subjecthead_id" value="<?php echo $sub_subjecthead_id; ?>">
      <div class="modal-body">
        
        
         
        
        <div class="col-md-12">
          

            <div class="col-md-12">
                    <div class="col-sm-6">
            <label ><b>Difficulty Level</b></label>
            <select name="dificulty_level" class="form-control">
              
              <option <?php if($level == '1'){ echo "selected"; }?> value="1">Beginner</option>
              <option <?php if($level == '2'){ echo "selected"; }?> value="2">Intermediate</option>
              <option <?php if($level == '3'){ echo "selected"; }?> value="3">Advanced</option>
              <option <?php if($level == '4'){ echo "selected"; }?> value="4">Basic</option>
            </select>
           
          </div>
        </div>
             <div class="col-md-12" style="">
                    <div class="col-sm-6">
            <label ><b>Topic</b></label>
            <select name="topic_id" class="form-control" id="topic_id" onchange="get_sub_topic()">
              <?php  $sql = $conn->query("SELECT * FROM subject_quehead  WHERE main_subject_id = '$main_subject_id' ORDER BY id DESC ");
 ?>
              
              <?php
while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
?>
    <option <?php  if($topic_id == $row["id"]){ echo "selected"; }?> value="<?php echo $row["id"] ?>" ><?php echo $row["quehead"]; ?></option>
<?php } ?>
            </select>
           
          </div>
        </div>
        
        <div class="col-md-12">
                    <div class="col-sm-6">
            <label ><b>Sub Topic</b></label>
            <select name="sub_topic_id" class="form-control" id="sub_topic_id" style="">
              <!-- onchange="get_category();"  -->
              
              <option value="">Select</option> 
            </select>
           
          </div>
        </div>
         
        <div class="col-md-12">
        <div class="col-sm-6">
              <label><b>Category</b></label>
               
                <select name="category_id" class="form-control" id="category_id" >
                <option value="">Select</option> 
                 
               </select>
            </div>
          </div>

          <div class="col-md-12">
        <div class="col-sm-6">
              <label><b>Sub category</b></label>
               
                <select name="sub_category_id" class="form-control" id="sub_category_id" >
                <option value="">Select</option> 
                 
               </select>
            </div>
          </div>

            <div class="form-group">
            <label><b>Question</b></label>
            
            
                <textarea name="exam_question" id="editor11" rows="10" cols="80">
               <?php echo $exam_question; ?>
            </textarea>
            <script>
                CKEDITOR.replace( 'editor11' );
            </script>
          </div>
           <div class="form-group">
            <label><b>Explanation</b></label>
                <textarea name="explanation" id="editor2" rows="10" cols="80">
               <?php echo $explanation; ?>
            </textarea>
            <script>
                CKEDITOR.replace( 'editor2' );
            </script>
          </div>


          <fieldset>
            <legend>Input word for Options</legend>
            <div class="form-group">
                <label>Option A</label>
                <input type="" name="choice_A1" id="choice_A1" class="form-control" value="<?php echo $choice_A1; ?>" placeholder="Input Option A" autocomplete="off">
                Graphic <input type="checkbox" name="option_A_chk" id="option_A_chk">
               <span id="up1" style="display: none;">Upload File : <input type="file"  name="graphic_A" id="graphic_A"></span> 
            </div>

            <div class="form-group">
                <label>Option B</label>
                <input type="" name="choice_B1" id="choice_B1" class="form-control" value="<?php echo $choice_B1; ?>" placeholder="Input Option B" autocomplete="off">
                Graphic <input type="checkbox" name="option_B_chk" id="option_B_chk">
                <span id="up2" style="display: none;">Upload File : <input type="file"  name="graphic_b" id="graphic_b"></span> 
            </div>

            <div class="form-group">
                <label>Option C</label>
                <input type="" name="choice_C1" id="choice_C1" value="<?php echo $choice_C1; ?>" class="form-control" placeholder="Input Option C" autocomplete="off">
                Graphic <input type="checkbox" name="option_C_chk" id="option_C_chk">
                <span id="up3" style="display: none;">Upload File : <input type="file"  name="graphic_c" id="graphic_c"></span> 
            </div>
 
            <div class="form-group">
                <label>Option D</label>
                <input type="" name="choice_D1" id="choice_D1" value="<?php echo $choice_D1; ?>" class="form-control" placeholder="Input Option D" autocomplete="off">
                Graphic <input type="checkbox" name="option_D_chk" id="option_D_chk">
                <span id="up4" style="display: none;">Upload File : <input type="file"  name="graphic_d" id="graphic_d"></span> 
            </div>

            <div class="form-group">
                <label>Correct Answer</label>
                <!-- <input type="" name="correctAnswer" id="" class="form-control" placeholder="Input correct answer" autocomplete="off"> -->
                <select name="correctAnswer" id="correctAnswer" class="form-control" >
                   <option <?php if($isRight_A1=="1"){ echo "selected"; } ?> value="A">A</option>
                  <option <?php if($isRight_B1=="1"){ echo "selected"; } ?> value="B">B</option>
                  <option <?php if($isRight_C1=="1"){ echo "selected"; } ?> value="C">C</option>
                  <option <?php if($isRight_D1=="1"){ echo "selected"; } ?> value="D">D</option>
                </select>
            </div>

          </fieldset>

          
          
        </div>
      </div>
      <div class="modal-footer">
        <a href="home.php?page=manage-exam" class="btn btn-dark" data-dismiss="modal">Close</a>
        <button type="submit" name="update" class="btn btn-primary">Save Changes</button>
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
<script src="js/chosen.jquery.js" type="text/javascript"></script>
<script src="js/chosen.jquery.min.js" type="text/javascript"></script>
      <script type="text/javascript">
  //document.getElementById('output').innerHTML = location.search;
$(".chosen-select").chosen();
 </script> 
 <script type="text/javascript">
   function get_sub_topic(){
    topic_id = document.getElementById('topic_id').value;
    
    $.ajax ({
      type: "POST",
      url: "get_sub_topic.php",
      data: "topic_id="+topic_id,
      success: function(data){
  
        $('#sub_topic_id').html(data);
        get_category();
        get_sub_category();
        document.getElementById('sub_topic_id').value ='<?php echo $sub_topic_id; ?>';
        
       
        
          }
    });
    
  }
  
   function get_category(){

    topic_id = document.getElementById('topic_id').value;
    
    $.ajax ({
      type: "POST",
      url: "get_category.php",
      data: "topic_id="+topic_id,
      success: function(data){
        
        $('#category_id').html(data);
        document.getElementById('category_id').value ='<?php echo $category_id; ?>';
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
         document.getElementById('sub_category_id').value ='<?php echo $sub_category_id; ?>';
          }
    });
    
  }
  get_sub_topic();
 </script>   
     

  

<!-- MAO NI IYA FOOTER -->
<?php include("includes/footer.php"); ?>

<?php include("includes/modals.php"); ?>
