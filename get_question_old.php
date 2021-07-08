<?php
 include("conn.php");
 session_start();
 function getvalfield($conn,$table,$field,$where)
{ //echo "SELECT $field FROM $table WHERE $where";
$stmt = $conn->prepare("SELECT $field FROM $table WHERE $where"); 
$stmt->execute(); 
$row = $stmt->fetch(); 
return $row[0];
}   
    $examne_id =  $_SESSION['examineeSession']['exmne_id'];
    $queheadid =  $_REQUEST['queheadid'];
    $eqt_id = trim($_POST['eqt_id']," ");
    $answer = $_POST['answer'];
    $answers = $_POST['answers'];
    $selected = $_POST['selected'];
    $cntque = $_POST['cntque'];
    $cntquee = $_POST['cntquee'];
    $exam_comp = $_REQUEST['exam_comp'];
    if($cntque==''){
   // echo "Session Expired.";
    } else {
        $_SESSION['cntque']=$cntque;
    }
     
    if($eqt_id==''){
      $eqt_id = 0;
    }
    $cur_time = date('H:i');
    $cur_date = date('Y-m-d H:i:s');
    $type = $_REQUEST['type'];
    $answer_status = 0;
    if($type=='save_and_next'){
      $answer_status = 1;
    }else if($type=='skip'){
      $answer_status = 2;
    }else if($type=='next'){
      $answer_status = 3;
    }
    $seq = "RAND()"; 
    if($answer=='undefined'){
      $answer = '';
    }   
///////////////For question answer submitted///////////////
    $ffff = '';
         if($eqt_id!='' && $eqt_id!=0 && $examne_id!='' && $type!='previous' && $selected!='selected'){
            
    $sql33 = "select * from exam_answers where sub_subjecthead_id='$queheadid' and axmne_id = '$examne_id' and quest_id = '$eqt_id'";
    $result33 = $conn->query($sql33);
    $num33 = $result33->rowCount();
    
    if($num33>0){
      $answer_status_for_chk = getvalfield($conn,"exam_answers","answer_status","quest_id='$eqt_id' and axmne_id = '$examne_id' and sub_subjecthead_id = '$queheadid'");
      if($answer_status_for_chk==1){
        if($type=='skip'){
         $answer_status = 2;
        }  else {
         $answer_status = 1;
        }
        
      } else if($answer_status_for_chk==2){
        if($type=='save_and_next'){
        $answer_status = 1;
      } else {
       $answer_status = 2;
      }
      }

      $sql33 = "update exam_answers set exans_answer = '$answer', answer_status = '$answer_status', exans_created = '$cur_date' where sub_subjecthead_id='$queheadid' and axmne_id = '$examne_id' and quest_id = '$eqt_id' ";
      $conn->query($sql33);
      $ffff = 1;
    } else {

            $sql = "INSERT INTO `exam_answers`(`axmne_id`,`sub_subjecthead_id`, `quest_id`, `exans_answer`,`ans_explatnaion`, `answer_status`, `exans_created`) VALUES ('$examne_id','$queheadid','$eqt_id','$answer','$answers','$answer_status','$cur_date')";
         $conn->query($sql);
         $ffff = 2;
         }
        
         }
  $cntque2 = $_POST['cntque2'];       
  $cnt_num = 1;
  $num3 = 1;
  if($selected!='selected'){
 if($type=='previous'){
  $eqt_id = $_REQUEST['eqt_id']-1;
  if($cntque>=$cntque2){
   $num3 = $cntque2-$cnt_num;
 }
 } else if($eqt_id!='') {
  $eqt_id = $_REQUEST['eqt_id']+1;
  
  if($cntque>$cntque2 || $cntque==$cntque2){
   $num3 = $cntque2+$cnt_num;
 }

 }else {
  
 //    if($cntque<$cntque2){
 //   $num3 = $cntque2+$cnt_num;
 // }
 }  } else {
    $num3 = $_POST['que_numm'];
 }
 if($cntquee=='ll'){
    $crt = "ORDER by eqt_id asc limit $_SESSION[cntque]";
 } else {
    $crt = "and eqt_id = '$eqt_id'";
 }    
///////////////For select new question answer select///////////////
    if($selected=='selected' || $exam_comp=='done'){
    $sql = "select * from exam_question_tbl where sub_subjecthead_id='$queheadid' and exam_status = 'active' and eqt_id = '$eqt_id'";
    $result = $conn->query($sql);
    $num = $result->rowCount();
    $ffff = 2;  
    }else {
      $ffff = 2;
     // $sql = "select * from exam_question_tbl where sub_subjecthead_id='$queheadid' and exam_status = 'active' and eqt_id not in (select quest_id from exam_answers where sub_subjecthead_id='$queheadid' and axmne_id = '$examne_id') ORDER by eqt_id desc limit $_SESSION[cntque]";

    $sql = "select * from exam_question_tbl where sub_subjecthead_id='$queheadid' and exam_status = 'active' $crt";
    $result = $conn->query($sql);
    $num = $result->rowCount();
}
///////////////For NO. of all question///////////////
    $sql2 = "select * from exam_question_tbl where sub_subjecthead_id='$queheadid' limit $_SESSION[cntque] ";
    $result2 = $conn->query($sql2);
    $num2 = $result2->rowCount();
//////////count question attand////////////    
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $eqt_id = $row['eqt_id'];
    $question = $row['exam_question'];
    $sub_subjecthead_id = $row['sub_subjecthead_id'];
    $exam_ch = $row['exam_ch'];
//////////////////////for previous/////////////////////////////////////
if($_REQUEST['cntquee']!='lll'){
     $for_previous_id = $eqt_id;
} else {
     $for_previous_id = $eqt_id-1;
} 
$hh = '';
if($exam_comp=='done' && $type=='save_and_next'){
  $num = 0;
}  //echo "<".$hh.">";|| ($exam_comp=='done' && $type!='save_and_next')
    if($num>0){ 

    $answer_status = getvalfield($conn,"exam_answers","answer_status","quest_id='$eqt_id' and axmne_id = '$examne_id' and sub_subjecthead_id = '$sub_subjecthead_id'");
    $selected = '';
    $selected_ans = '';
    if($answer_status==1){
      $selected_ans = getvalfield($conn,"exam_answers","exans_answer","quest_id='$eqt_id' and axmne_id = '$examne_id' and sub_subjecthead_id = '$sub_subjecthead_id'");
      $selected = 'checked';
    }
      $option_sql = "select answer as answer from exam_answers_option where quehead_id='$queheadid' and eqt_id = '$eqt_id'";
    $option_result = $conn->query($option_sql);
    //$exam_chArr = $option_result->fetch(PDO::FETCH_ASSOC);
    //print_r($exam_chArr);
      ?> 
<b><?php echo $num3;  ?>. </b>|||<p><b><?php echo $question; ?></b></p>
                        <?php $numm = 1; 
                        //foreach ($exam_chArr as $value) {
                        $x = 'a'; 
                        while ($exam_chArr = $option_result->fetch(PDO::FETCH_ASSOC)) {
                        ?><p><input type="radio" <?php if($selected_ans==$exam_chArr['answer']){ echo $selected; }  ?> name="answers" required="" value="<?php echo htmlspecialchars_decode($exam_chArr['answer']); ?>">(<?php echo $x; ?>) <?php echo htmlspecialchars_decode($exam_chArr['answer']); ?></p>
                       <?php $numm++; $x++; } ?>
|||<?php echo $eqt_id."|||".$num2."|||".$num3."|||".$for_previous_id."|||".$num3;  } else { echo "not found |||".$queheadid."|||".$num2."|||".$num3;
    } ?>|||<?php if($ffff==1 || $ffff==2){ ?><button type="button" style="padding: revert !important;" onclick="showdiv('1');" id="kkk" class="slide-toggle btn btn-warning kkk"><b>>></b></button>
                      <div id="showmark" style="margin-top: -30px;
    margin-left: 60px;" >
                      <div class="swatch-holder bg-success switch-header-cs-class" title="Submit" data-class="bg-primary header-text-light">
                                        </div>
                <div class="swatch-holder bg-warning switch-header-cs-class" title="Skip" data-class="bg-primary header-text-light">
                                        </div>
                <div class="swatch-holder bg-danger switch-header-cs-class" title="Not Submitted" data-class="bg-primary header-text-light">
                                        </div>   </div>                 <br>
    <div class="box" style="width: 100%;">
        <div class="box-inner" id="fflgdiv" style="    padding: 15px;width: 240px;">
          <div class="row">
            <?php 
            // $flag_que = $conn->query("SELECT * FROM flag_history WHERE exam_id='$queheadid' and examinee_id = '$examne_id' ORDER BY id DESC ");
$flag_que = $conn->query("select * from exam_question_tbl where sub_subjecthead_id='$queheadid' and exam_status = 'active' ORDER by eqt_id asc limit $_SESSION[cntque]");
$n = 5;  $flag_que_num = $flag_que->rowCount();
$i = 1;  
           while ($flag_querow = $flag_que->fetch(PDO::FETCH_ASSOC)) { 
             $queheadidd = $flag_querow['eqt_id'];
            //$quest_id = $flag_querow['quest_id'];
                // $status = "";
                // $color = "dark";
                // if($status==1){
                //     $color = "success";
                // }
                $qqid = '';
                if($flag_que_num==$i) {
                  $qqid = "id = 'lqid'";
                }
            $nn = $i%6;
            $quehead = getvalfield($conn,"exam_question_tbl","exam_question","eqt_id='$queheadidd'");
            $answer_status = getvalfield($conn,"exam_answers","answer_status","quest_id='$queheadidd' and axmne_id = '$examne_id' and sub_subjecthead_id = '$queheadid'");
            if($answer_status==1){
              $color = "bg-success";
            }else if($answer_status==2){
              $color = 'bg-warning';
            } else if($answer_status==3){
              $color = 'bg-danger';
            } else {
              $color = 'bg-heavy-rain';
            }
?>          
<a href="#" style="text-decoration: none;" <?php //if($status==0){ ?>onclick="get_question(<?php echo $i ?>,<?php echo $queheadidd; ?>,'selected','');" <?php //} ?>><div class="swatch-holder <?php echo $color; ?> switch-header-cs-class" title="<?php echo strip_tags($quehead); ?>" data-class="bg-primary header-text-light" <?php echo $qqid; ?> >
                                        <center style="color: white;" ><?php echo $i; ?></center></div> </a><?php //if($i==0){?></br><?php //}   ?>
                                        <?php $i++; } ?></div>
        </div>
    </div><?php }
    //} 
    // else{ unset($_SESSION["cntque"]); echo "not found |||"." "."|||".$num2."|||".$num3; } 
  
 ?>
