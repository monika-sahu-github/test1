 <?php
 $decryption=openssl_decrypt ($_REQUEST['exam_type'], $ciphering,  
$key, $options, $iv);  
$type = $decryption;
$examtype = '';
if($type==0){
    $examtype = "Practice Test";
} else if($type==1){
   $examtype = "Mock Test"; 
}
$question_head_id=openssl_decrypt ($_REQUEST['question_head_id'], $ciphering,  
$key, $options, $iv);
$quehead1 = getvalfield($conn,"exam_tbl","ex_title","ex_id='$question_head_id'");
///////////////////////////////////////////////////////////////////////////////////////
$queheadid=openssl_decrypt ($_REQUEST['queheadid'], $ciphering,  
$key, $options, $iv); 

// function getvalfield($conn,$table,$field,$where)
// { //echo "SELECT $field FROM $table WHERE $where";
// $stmt = $conn->prepare("SELECT $field FROM $table WHERE $where"); 
// $stmt->execute(); 
// $row = $stmt->fetch();
// return $row[0];
// }  
$exam_id = getvalfield($conn,"subject_quehead","exam_id","id='$queheadid'");
$typeenc = openssl_encrypt($exam_id, $ciphering, 
$key, $options, $iv);
$quehead = getvalfield($conn,"subject_quehead","quehead","id='$queheadid'");
$selQuestion = $conn->query("SELECT * FROM exam_question_tbl WHERE sub_subjecthead_id='$queheadid' ")->fetch(PDO::FETCH_ASSOC);
//$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
    $examne_id =  $_SESSION['examineeSession']['exmne_id'];
     $sql2 = "select * from exam_question_tbl where sub_subjecthead_id='$queheadid'";
     $result2 = $conn->query($sql2);
     $tot_que  = $result2->rowCount();
     $match_maxid1 = getvalfield($conn,"exam_que_for_match_tbl","max(id)","sub_id = '$queheadid' and examinee_id = '$examne_id' and is_finel_sub = 1");
     $match_max_que_id = getvalfield($conn,"exam_que_for_match_tbl","que_id","id = '$match_maxid1'");
//$match_max_que_id = getvalfield($conn,"exam_que_for_match_tbl","max(que_id)","sub_id='$queheadid' and examinee_id = '$examne_id' and is_finel_sub = 1"); 
    $max_que_id = getvalfield($conn,"exam_question_tbl","max(eqt_id)","sub_subjecthead_id='$queheadid'");
    // if(($match_max_que_id==$max_que_id) || ($match_max_que_id=="")){
    //  $num2 = $result2->rowCount();
    // } else {
    //  $num2 = getvalfield($conn,"exam_question_tbl","count(*)","sub_subjecthead_id='$queheadid' and eqt_id>'$match_max_que_id'");
    // }
    $match_maxid = getvalfield($conn,"exam_que_for_match_tbl","que_id","id = '$match_maxid1'");
    $maxcrt = "";
     if($max_que_id!=$match_maxid){
      $maxcrt = "and eqt_id > '$match_maxid'";
     }
$sql_easy = "(SELECT * FROM `exam_question_tbl` WHERE `dificulty_level` = 1 AND `sub_subjecthead_id` = '$queheadid' )";
$sql_medium = "(SELECT * FROM `exam_question_tbl` WHERE `dificulty_level` = 2 AND `sub_subjecthead_id` = '$queheadid' )";
$sql_hard = "(SELECT * FROM `exam_question_tbl` WHERE `dificulty_level` = 3 AND `sub_subjecthead_id` = '$queheadid')";
$sqlf  = $sql_easy.' UNION '.$sql_medium.' UNION '.$sql_hard;

$sql_dhiraj = "SELECT * FROM exam_question_tbl WHERE sub_subjecthead_id=$queheadid and eqt_id not in( select que_id from exam_que_for_match_tbl where examinee_id = '$examne_id' and sub_id='$queheadid' and is_finel_sub = 1)  ";

$result3 = $conn->query($sql_dhiraj);
   //$result3 = "select count()";
     $num2  = $result3->rowCount();

    //echo $match_max_que_id.">'$queheadid'";
     if($num2>=5){}else {
        $conn->query("DELETE FROM exam_que_for_match_tbl WHERE sub_id = '$queheadid' and examinee_id = '$examne_id'");
$sql_dhiraj = "SELECT * FROM exam_question_tbl WHERE sub_subjecthead_id=$queheadid and eqt_id not in( select que_id from exam_que_for_match_tbl where examinee_id = '$examne_id' and sub_id='$queheadid' and is_finel_sub = 1)  ";

$result3 = $conn->query($sql_dhiraj);
   //$result3 = "select count()";
     $num2  = $result3->rowCount();
 }
    ?>
    <script src="ckeditor/ckeditor.js"></script>
    <script src="ckeditor/samples/js/sample.js"></script>
    <style>
    .box{
        float:right;
        overflow: hidden;
         
    }
    /* Add padding and border to inner content
    for better animation effect */
    .box-inner{
        width: 400px;
        padding: 10px;
        border: 1px solid #fcc7a4;
    }
</style>

<style type="text/css">
    .widget-heading{
        font-size: 25px;
    }
    h2{
        color: white;
    background: #375176;
    text-align: center;
    border-radius: 3px;
    padding: 8px;
    }
</style>
<style type="text/css">
        .anchr-tagcolor{
            color: #a6aaad;
            text-decoration: none;
        }
        .anchr-tagcolor:hover{
            color: white;
            text-decoration: none;
        }
        .spanclr{
           color: #a6aaad; 
        }
        .spanclr:hover{ 
            color: white;
        }
        .arrow{
           color: #a6aaad; 
        }
    </style>
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
                        <div>General Instructions
                            <!-- <div class="page-title-subheading">This is an example dashboard created using build-in elements and components.
                            </div> -->
                        </div>
                    </div>
                     
                 </div>
            </div>    <div class="breadcrumb">  <a href="home.php" class="anchr-tagcolor">Dashboard</a><a href="home.php?page=examination_test_type&exam_type=<?php echo $_REQUEST['exam_type']; ?>" class="anchr-tagcolor"><?php echo $examtype; ?></a>

    <a href="home.php?page=get_subject_quehead&exam_type=<?php echo $_REQUEST['exam_type']; ?>&question_head_id=<?php echo $_REQUEST['question_head_id']; ?>" class="anchr-tagcolor"><?php echo $quehead1; ?></a>

    <a href="#" class="spanclr"><?php echo $quehead; ?></a> </div>

    <div class="row" style="background: white;border: 3px solid #375176;padding: 0px;">

<div class="col-sm-12">
     <!-- <h2><a href="home.php">Dashboard</a> -> <a href="home.php?page=get_subject_quehead&question_head_id=<?php echo $typeenc; ?>" style="color: white;text-decoration: none;"><?php echo $quehead; ?></a> -> Ancient History</h2><br><br> -->
</div> 

 <div class="col-md-12 col-xl-12" style="padding-top: 15px;padding-bottom: 20px;">
    <input type="hidden" name="eqt_id" id="eqt_id">
    <input type="hidden"  name="answers"> 
    <div id="unwanted">
        <?php if($num2>=5){ ?>
    <span style="background-color: rgb(240 173 78);
    font-size: 20px;width: 190px;
    padding: 4px;color: white;font-weight: 700;
    border-radius: 3px;" id="show_tot_question_div">Total Questions <?php echo $num2."/".$tot_que; ?></span> <br><br> 
    <div> 
     1. The Question Palette displayed on the right side of screen will show the status of each question using one of the following symbols:<br>
     <div class="swatch-holder bg-success" data-class="bg-success header-text-dark">
                                        </div> You have answer the question<br>
                                        <div class="swatch-holder bg-warning" data-class="bg-warning header-text-dark">
                                        </div>  You have skip this question.<br>
                                        <div class="swatch-holder bg-danger" data-class="bg-danger header-text-light">
                                        </div>  You have not answered the question.
    <br>
    2. To answer a question, do the following:<br>
    <ol><li>Click on the question number in the Question Palette at the left of your screen to go to that numbered question directly. Note that using this option does NOT submit your answer to the current question.</li><li>Check on <b>Save &amp; Next</b> to save your answer for the current question and then go to the next question.</li><li>Click on <b>Mark for Review <span class="hide-on-railway">&amp; Next</span></b> to save your answer for the current question and also mark it for review <span class="hide-on-railway">, and then go to the next question.</span></li></ol>
    </div>
    <?php } else { ?>
     <h4 style="color: red;">No Question are Available! It`s comming soon.</h4><br>
    <?php } ?>
</div>
    <span style="background-color: #80808038;
    font-size: 11px;width: 100px;
    padding: 4px;
    border-radius: 3px; display: none;" id="showquestion_att">Question</span>
                    <div class="row" id="showquestion"> 

                  
              </div>
 
             <div id="showeditor" style="display: none;"><div id="editor">
           
        </div></div><br>
              <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
<!-- <input id="next" onclick="get_question()" class="btn btn-success" type="button" name="question" value="Start Exam" > -->
<?php if($num2>0){ ?>
 <a href="home.php?page=start_exam&exam_type=<?php echo $_REQUEST['exam_type']; ?>&question_head_id=<?php echo $_REQUEST['question_head_id']; ?>&queheadid=<?php echo $_REQUEST['queheadid']; ?>" class="btn btn-success" >Next</a>
<!-- <a href="#" onclick="openwindow();"  class="btn btn-success" >Next</a> -->
<?php }   ?>
</div></div>
                </div>
               
                <div class="col-md-6 col-xl-4">
    
                </div>
            
            </div>
      
        
        </div>
         
    </div>
 
<?php //include 'exam_js.php'; ?>
<script>
    function showdiv(){
         $(".box").animate({
                width: "toggle"
            });
     }
</script>
<script type="text/javascript">
   

function openwindow(){
window_height = screen.height;
window_width =  screen.width;
let params = 'minimizable=no,scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width='+window_width+',height='+window_height+',left=-1000,top=-1000';

open('home.php?page=start_exam&exam_type=<?php echo $_REQUEST['exam_type']; ?>&question_head_id=<?php echo $_REQUEST['question_head_id']; ?>&queheadid=<?php echo $_REQUEST['queheadid']; ?>', 'test', params);
}
</script>
</script>