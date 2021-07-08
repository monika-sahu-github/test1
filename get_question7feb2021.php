
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
    $exam_id = $_REQUEST['exam_id'];
    if($cntque==''){
   // echo "Session Expired.";
    } else {
        $_SESSION['cntque']=$cntque;
    }
     
    if($eqt_id==''){
      $eqt_id = 0;
    }
    $cur_time = date('H:i');
    //$cur_date = date('Y-m-d h:i:s');
    date_default_timezone_set('Asia/Calcutta');
$cur_date = date( 'Y-m-d H:i:s', time () );
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
    $y = date('Y'); 
    $d = date('d');
    $m = date('m');
    //echo ">>>".$_POST['for_previous_id'];
         //$exam_session = getvalfield($conn,"exam_answers","max(exam_session)","axmne_id = '$examne_id' and is_finel_sub = 1")+1;
         $exam_session = $_SESSION["exam_session"];
     //$exam_session2 = getvalfield($conn,"exam_answers","max(exam_session)","axmne_id = '$examne_id'");
      $match_maxid1 = getvalfield($conn,"exam_que_for_match_tbl","max(id)","sub_id = '$queheadid' and examinee_id = '$examne_id' and is_finel_sub = 1");
      $match_maxid = getvalfield($conn,"exam_que_for_match_tbl","que_id","id = '$match_maxid1'");
      $max_que_id = getvalfield($conn,"exam_question_tbl","max(eqt_id)","sub_subjecthead_id='$queheadid'");
         if($eqt_id!='' && $eqt_id!=0 && $examne_id!='' && $type!='previous' && $selected!='selected'){
      $sql33 = "select * from exam_answers where sub_subjecthead_id='$queheadid' and axmne_id = '$examne_id' and quest_id = '$eqt_id' and YEAR(exans_created)='$y' and MONTH(exans_created)='$m' and DAY(exans_created)='$d' and exam_session='$exam_session' and is_finel_sub <> 1";
    $result33 = $conn->query($sql33);
    $num33 = $result33->rowCount();

    $quebank_maxid = getvalfield($conn,"exam_question_tbl","max(eqt_id)","sub_subjecthead_id = '$queheadid' ");
    
    $match_count_plus = 0;
    if($quebank_maxid==$eqt_id){
    $match_count_plus = 1;
    }
    $match_count = getvalfield($conn,"exam_que_for_match_tbl","max(num)","sub_id='$queheadid' and examinee_id = '$examne_id'");
    if($num33>0){
      $answer_status_for_chk = getvalfield($conn,"exam_answers","answer_status","quest_id='$eqt_id' and axmne_id = '$examne_id' and sub_subjecthead_id = '$queheadid' and exam_session = '$exam_session'");
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
      if($answer_status==2){
        $answer = "";
      }
      $sql33 = "update exam_answers set exam_answer_id = '$answer', answer_status = '$answer_status', exans_created = '$cur_date' where sub_subjecthead_id='$queheadid' and axmne_id = '$examne_id' and quest_id = '$eqt_id' and YEAR(exans_created)='$y' and MONTH(exans_created)='$m' and DAY(exans_created)='$d' and exam_session = '$exam_session'";
      $conn->query($sql33);
      $ffff = 1;
    } else {
 
             $sql = "INSERT INTO `exam_answers`(`axmne_id`,`sub_subjecthead_id`, `quest_id`, `exam_answer_id`,`ans_explatnaion`, `answer_status`, `exans_created`, `exam_session`) VALUES ('$examne_id','$queheadid','$eqt_id','$answer','$answers','$answer_status','$cur_date', '$exam_session')";
            $sql_match = "INSERT INTO `exam_que_for_match_tbl`(`exam_id`, `sub_id`, `que_id`, `examinee_id`, `num`, `create_date`) VALUES ('$exam_id','$queheadid','$eqt_id','$examne_id','$match_count','$cur_date')";
         $conn->query($sql);
         $conn->query($sql_match);
         $ffff = 2;
         }
        
         }
  $cntque2 = $_POST['cntque2'];       
  $cnt_num = 1;
  $num3 = 1;
  if($selected!='selected'){
 if($type=='previous'){
   //$eqt_id = $_REQUEST['eqt_id']-1;
  //$eqt_id = $_REQUEST['for_previous_id'];
  if($cntque>=$cntque2){
   $num3 = $cntque2-$cnt_num;
 }
 } else if($eqt_id!='') {
  // $eqt_id = $_REQUEST['eqt_id']+1;
  $eqt_id = $_REQUEST['eqt_id'];
  
  //if($cntque>$cntque2 || $cntque==$cntque2){
  if($cntque>=$cntque2){
   $num3 = $cntque2+$cnt_num;
   if($cntque==$cntque2){
    $num3 = $cntque2;
   }
 }

 }else {
  
 //    if($cntque<$cntque2){
 //   $num3 = $cntque2+$cnt_num;
 // }
 }  } else {
    $num3 = $_POST['que_numm'];
 }
 // if($cntquee=='ll'){
 //    $crt = "ORDER by eqt_id asc limit $_SESSION[cntque]";
 // } else {
 //    $crt = "and eqt_id = '$eqt_id'";
 // } 
 $crt = '';
  if($cntquee=='ll'){
    $crt = "ORDER by eqt_id asc limit $_SESSION[cntque]";
 } else if($type=='next' || $type=='skip' || $type=='save_and_next'){

     $crt = " and `eqt_id` > '$eqt_id' ORDER BY `eqt_id` ASC LIMIT 1";

 } else if($type=='previous'){
     $crt = " and `eqt_id` < '$eqt_id' ORDER BY `eqt_id` DESC LIMIT 1";
 }    //echo "ok".$crt; 
///////////////For select new question answer select///////////////
    if( $type!='previous' && ($selected=='selected' || $exam_comp=='done')){
   // echo $sql = "select * from exam_question_tbl where sub_subjecthead_id='$queheadid' and exam_status = 'active' and eqt_id = '$eqt_id'";
       $sql = "select * from exam_question_tbl where sub_subjecthead_id='$queheadid' and exam_status = 'active' and eqt_id = '$eqt_id'";

    $result = $conn->query($sql);
    $num = $result->rowCount();
    $ffff = 2;  
    }else {
      $ffff = 2;
     // $sql = "select * from exam_question_tbl where sub_subjecthead_id='$queheadid' and exam_status = 'active' and eqt_id not in (select quest_id from exam_answers where sub_subjecthead_id='$queheadid' and axmne_id = '$examne_id') ORDER by eqt_id desc limit $_SESSION[cntque]"; 
     
     $maxcrt = "";
     if($max_que_id!=$match_maxid){
      $maxcrt = "and eqt_id > '$match_maxid'";
     } 
      $sql = "select * from exam_question_tbl where sub_subjecthead_id='$queheadid' and exam_status = 'active' $maxcrt $crt";
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
//echo "????".$for_previous_id;
if(($exam_comp=='done' && $type=='save_and_next') || ($exam_comp=='done' && $type=='skip')){
  //$num = 0;
}  //echo "<".$hh.">";|| ($exam_comp=='done' && $type!='save_and_next')
    if($num>0){ 

    $answer_status = getvalfield($conn,"exam_answers","answer_status","quest_id='$eqt_id' and axmne_id = '$examne_id' and sub_subjecthead_id = '$sub_subjecthead_id' and YEAR(exans_created)='$y' and MONTH(exans_created)='$m' and DAY(exans_created)='$d' and exam_session = '$exam_session' and is_finel_sub<>1");
    $selected = '';
    $selected_ans = '';
    if($answer_status==1){
      $selected_ans = getvalfield($conn,"exam_answers","exam_answer_id","quest_id='$eqt_id' and axmne_id = '$examne_id' and sub_subjecthead_id = '$sub_subjecthead_id' and YEAR(exans_created)='$y' and MONTH(exans_created)='$m' and DAY(exans_created)='$d' and exam_session = '$exam_session' and is_finel_sub<>1");
      $selected = 'checked';
    }
      $option_sql = "select answer as answer, id as id from exam_answers_option where quehead_id='$queheadid' and eqt_id = '$eqt_id'";
    $option_result = $conn->query($option_sql);
    //$exam_chArr = $option_result->fetch(PDO::FETCH_ASSOC);
    //print_r($exam_chArr);
      ?> 
<b><?php echo $num3;  ?>. </b>|||<p><b><?php echo $question; ?></b></p>
                        <?php $numm = 1; 
                        //foreach ($exam_chArr as $value) {
                        $x = 'a'; 
                        $i=1;
                        while ($exam_chArr = $option_result->fetch(PDO::FETCH_ASSOC)) {
                         
                        ?><p  onclick="return set_option('<?php echo $i; ?>');" style="cursor: pointer;<?php if($selected_ans==$exam_chArr['id']){ ?>background: rgb(242, 249, 255);border: 1px solid rgb(212, 223, 232); <?php }  ?>" id="pt<?php echo $i; ?>"><input id='op<?php echo $i; ?>' type="radio" <?php if($selected_ans==$exam_chArr['id']){ echo $selected; }  ?> name="answers" required="" value="<?php echo htmlspecialchars_decode($exam_chArr['id']); ?>" >(<?php echo $x; ?>) <?php echo htmlspecialchars_decode($exam_chArr['answer']); ?></p>
                       <?php $numm++; $x++; $i++;} ?>

                      
|||<?php echo $eqt_id."|||".$num2."|||".$num3."|||".$for_previous_id."|||".$num3;  } else { echo "not found |||".$queheadid."|||".$num2."|||".$num3;
    } ?>|||<?php if($ffff==1 || $ffff==2){ ?><div class="col-sm-1"><button type="button" style="padding: revert !important;" onclick="showdiv('1');" id="kkk" class="slide-toggle btn btn-warning kkk"><b>>></b></button></div>
                      <div id="showmark" class="col-sm-10" style="margin-top: -30px;
    margin-left: 60px;" >
                     <div id="sv" class="col-sm-4 sug">
                      <div class="swatch-holder bg-success switch-header-cs-class qtip tip-top" data-tip="
                      Saved" data-class="bg-primary header-text-light">
                                        </div><b>Saved<b></div>
                                        <div id="mark" class="col-sm-4 sug">
                <div class="swatch-holder bg-warning switch-header-cs-class qtip tip-top" data-tip="Mark For Review" data-class="bg-primary header-text-light">
                                        </div><b>Review<b></div>
                                        <div id="nxt" class="col-sm-4 sug">
                <div class="swatch-holder bg-danger switch-header-cs-class qtip tip-top" data-tip="Not Attempted" data-class="bg-primary header-text-light">
                                        </div><b>NA<b></div>   </div>                 <br>
    <div class="box" style="width: 100%;">
        <div class="box-inner" id="fflgdiv" style="    padding: 15px;width: 330px;">
          <div class="row">
            <?php 
            // $flag_que = $conn->query("SELECT * FROM flag_history WHERE exam_id='$queheadid' and examinee_id = '$examne_id' ORDER BY id DESC ");
            $maxcrt = "";
     if($max_que_id!=$match_maxid){
      $maxcrt = "and eqt_id > '$match_maxid'";
     }
//echo "select * from exam_question_tbl where sub_subjecthead_id='$queheadid' and exam_status = 'active' $maxcrt ORDER by eqt_id asc limit $_SESSION[cntque]";     
$flag_que = $conn->query("select * from exam_question_tbl where sub_subjecthead_id='$queheadid' and exam_status = 'active' $maxcrt ORDER by eqt_id asc limit $_SESSION[cntque]");
$n = 5;  $flag_que_num = $flag_que->rowCount(); 
$i = 1;  
$implode = "";
           while ($flag_querow = $flag_que->fetch(PDO::FETCH_ASSOC)) { 
             $queheadidd = $flag_querow['eqt_id'];
            //$quest_id = $flag_querow['quest_id'];
                // $status = "";
                // $color = "dark";
                // if($status==1){
                //     $color = "success";
                // }
    $chk_num = getvalfield($conn,"exam_answers","count(*)","sub_subjecthead_id='$queheadid' and axmne_id = '$examne_id' and quest_id = '$queheadidd' and exam_session='$exam_session' and is_finel_sub <> 1");
    
if($chk_num==0){
             $sql = "INSERT INTO `exam_answers`(`axmne_id`,`sub_subjecthead_id`, `quest_id`, `exam_answer_id`,`ans_explatnaion`, `answer_status`, `exans_created`, `exam_session`) VALUES ('$examne_id','$queheadid','$queheadidd','$answer','$answers','','$cur_date', '$exam_session')"; 
          $match_count = getvalfield($conn,"exam_que_for_match_tbl","max(num)","sub_id='$queheadid' and examinee_id = '$examne_id'");
          $sql_match = "INSERT INTO `exam_que_for_match_tbl`(`exam_id`, `sub_id`, `que_id`, `examinee_id`, `num`, `create_date`) VALUES ('$exam_id','$queheadid','$queheadidd','$examne_id','$match_count','$cur_date')";
         $conn->query($sql);
         $conn->query($sql_match); }
         
         
         
             $implode .= ",".$queheadidd;
                $qqid = '';
                if($flag_que_num==$i) {
                  $qqid = "id = 'lqid'";
                }
            $nn = $i%6;
            $quehead = getvalfield($conn,"exam_question_tbl","exam_question","eqt_id='$queheadidd'");
           $answer_status = getvalfield($conn,"exam_answers","answer_status","quest_id='$queheadidd' and axmne_id = '$examne_id' and sub_subjecthead_id = '$queheadid' and exam_session = '$exam_session' and is_finel_sub<>1");
            if($answer_status==1){
              $color = "bg-success";
            }else if($answer_status==2){
              $color = 'bg-warning';
            } else if($answer_status==3){
              $color = 'bg-danger';
            } else {
              $color = 'bg-heavy-rain';
            }
            $quehead = str_replace("&nbsp;","",$quehead);
            //$quehead = str_replace(" ","",$quehead);
            //$quehead = preg_replace('/\s+/', '', $quehead);
            $quehead = preg_replace('/\s+\r+\n+/', ' ', $quehead);
            $quehead = strip_tags($quehead);
            //$quehead = htmlentities($quehead);
            //
?>          
<span style="text-decoration: none; cursor:pointer; " <?php //if($status==0){ ?>onclick="get_question(<?php echo $i ?>,<?php echo $queheadidd; ?>,'selected','');" <?php //} ?>><div class="swatch-holder <?php echo $color; ?> switch-header-cs-class "  title='<?php echo $quehead; ?>' data-class="bg-primary header-text-light" <?php echo $qqid; ?> >
                                        <center style="color: white;" ><?php echo $i; ?></center></div> </span><?php //if($i==0){?></br><?php //}   ?>
                                        <?php $i++; } ?></div>
        </div>
    </div><?php } echo "|||".$implode;
    //} 
    // else{ unset($_SESSION["cntque"]); echo "not found |||"." "."|||".$num2."|||".$num3; } 
  
 ?>
