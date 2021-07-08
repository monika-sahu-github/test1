<?php

   $sub_id = $exId = $_GET['id'];

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
//$location = "upload";
    //if (!is_dir($location)) {
    //    mkdir($location);
    //}
   $selExam = $conn->query("SELECT * FROM main_subject WHERE ex_id='$exId' ");
    $selExamRow = $selExam->fetch(PDO::FETCH_ASSOC);

    //$exam_id = $selExamRow['ex_id'];

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
//echo "UPDATE exam_answers_option SET graphic='$graphic_A' WHERE eqt_id = '$eqt_id' AND quehead_id = '$sub_subjecthead_id' AND atod = 'A'";die;
if($graphic_A!=''){
  $conn->query("UPDATE exam_answers_option SET graphic='$graphic_A' WHERE eqt_id = '$eqt_id' AND quehead_id = '$sub_subjecthead_id' AND atod = 'A'");
}
if($graphic_b!=''){
  $conn->query("UPDATE exam_answers_option SET graphic='$graphic_b' WHERE eqt_id = '$eqt_id' AND quehead_id = '$sub_subjecthead_id' AND atod = 'B'");
}
if($graphic_c!=''){
  $conn->query("UPDATE exam_answers_option SET graphic='$graphic_c' WHERE eqt_id = '$eqt_id' AND quehead_id = '$sub_subjecthead_id' AND atod = 'C'");
}
if($graphic_d!=''){
  $conn->query("UPDATE exam_answers_option SET graphic='$graphic_d' WHERE eqt_id = '$eqt_id' AND quehead_id = '$sub_subjecthead_id' AND atod = 'D'");
}



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
<style type="text/css">
  .main-card{
    padding: 20px;
  }
  #facebox{
    margin-left: -157px;
  }
</style>
<div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div>Subject - <?php echo $selExamRow['ex_title']; ?></div> 
                    </div>
                </div>
            </div>        
            
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">Question List
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="example">
                            <thead>
                            <tr> 
                                <th class="text-left ">Sno</th>
                               <th class="text-left ">Quesion ID</th>
                               <th class="text-left">Dificulty Level</th>
                                <th class="text-left ">Answer</th>

                                <th class="text-center" width="20%">Preview</th>
                                <th class="text-center" width="20%">View</th>
                                <th class="text-left" width="20%">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php //echo "SELECT * FROM exam_question_tbl WHERE sub_subjecthead_id = $sub_id ORDER BY eqt_id DESC ";
                              $i=1;
                              $dificulty_level="";
                                $selExam = $conn->query("SELECT * FROM exam_question_tbl WHERE main_subject_id = $sub_id AND status ='0' ORDER BY eqt_id DESC ");
                                if($selExam->rowCount() > 0)
                                {
                                    while ($selExamRow = $selExam->fetch(PDO::FETCH_ASSOC)) {
                                      if($selExamRow["dificulty_level"]=='1'){
                                        $dificulty_level = "Beginner";
                                      } else if($selExamRow["dificulty_level"]=='2'){
                                        $dificulty_level  = "Intermediate";
                                      } else if($selExamRow["dificulty_level"]=='3'){
                                        $dificulty_level = "Advanced";
                                      }else if($selExamRow["dificulty_level"]=='4'){
                                        $dificulty_level = "Basic";
                                      }
                                     ?>
                                        <tr><td><?php echo $i++;  ?></td>
                                            <td><?php echo $selExamRow['exam_question'];?></td>
                                            <td><?php echo $dificulty_level; ?></td>
                                            <td><?php echo $selExamRow['exam_answer']; ?></td>
                                            <td class="text-center">
                                              <a rel="facebox" style="text-decoration: none;" class="btn btn-primary btn-sm" href="facebox_modal/previewques.php?id=<?php echo $selExamRow['eqt_id']; ?>">Preview</a>
                                            </td>
                                           <td class="text-center"> 
                                           <!-- <a href="home.php?page=edit-exam?id=<?php echo $selExamRow['eqt_id']; ?>" type="button" class="btn btn-primary btn-sm">Edit</a> --> 
                                           <!-- <button class="btn btn-primary" onclick="updateQues()">Edit</button> -->
                                           <a class="btn btn-primary" href="update_question.php?id=<?php echo $selExamRow['eqt_id']; ?>">Edit</a>
                                           <!-- <a rel="facebox" style="text-decoration: none;" class="btn btn-primary btn-sm" href="facebox_modal/updateQuestion2.php?id=<?php echo $selExamRow['eqt_id']; ?>" id="updateCourse">Edit</a> -->
                                             </td>
                                             <td>
                                               <button class="btn btn-danger" onclick="delete_que('<?php echo $selExamRow["eqt_id"] ?>');" style="color: white;" >Delete</button>
                                             </td>
                                        </tr>

                                    <?php }
                                }
                                else
                                { ?>
                                    <tr>
                                      <td colspan="5">
                                        <h3 class="p-3">No Question Found</h3>
                                      </td>
                                    </tr>
                                <?php }
                               ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
      
        
</div>
<script type="text/javascript">
  function updateQues(){
   $(".chosen-select").chosen(); 
    
  }
</script>
<script type="text/javascript">
 function delete_que(que_id){
  sub_id = <?php echo $sub_id; ?>;
if(confirm("Do you want to delete this question!")){

     $.ajax({ 
   
type: "POST",
url: "delete_question.php", 
data: 'que_id='+que_id,
success: function(data) {
 //alert(data);
 data = data.trim("");
 if(data=="success"){
  //alert("Deleted Successfully");
  Swal.fire({
  title: "Deleted Successfully!",
  text: "",
  icon: "success",
  button: "OK",
});
window.location.href = 'home.php?page=question-list&id='+sub_id;

 } else {
 Swal.fire(
        "Something's went wrong!",
         'Somethings went wrong',
        'error'
      )
 }

 
}});

}else {
  return false;
}
 }
     function get_sub_topic(topic_id){
         if(topic_id==undefined || topic_id==""){
  topic_id = $("#topic_id").val();

}
   if(topic_id!=""){
     $.ajax({ 
   
type: "POST",
url: "get_sub_topic.php", 
data: 'topic_id='+topic_id,
success: function(data) {
// alert(data);
$("#sub_topic_id").html(data);

}});
   }
  }
 
        function get_category(sub_topic_id){
if(sub_topic_id==undefined || sub_topic_id==""){
  sub_topic_id = $("#sub_topic_id").val();}
   if(sub_topic_id!=""){
     $.ajax({ 
   
type: "POST",
url: "get_category.php", 
data: 'sub_topic_id='+sub_topic_id,
success: function(data) {
// alert(data);
$("#category_id").html(data);

}});}
  }


  function get_sub_category(category_id){
    if(category_id==undefined || category_id==""){
      category_id = $("#category_id").val();
    }
   if(category_id!=""){
     $.ajax({ 
   
type: "POST",
url: "get_sub_category.php", 
data: 'category_id='+category_id,
success: function(data) {
// alert(data);
$("#sub_category_id").html(data);

}});}
  }


</script>  
<script src="js/chosen.jquery.js" type="text/javascript"></script>
<script src="js/chosen.jquery.min.js" type="text/javascript"></script>
      <script type="text/javascript">
  //document.getElementById('output').innerHTML = location.search;
$(".chosen-select").chosen();
 </script>        
