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
$sub_topic_id = $_REQUEST['subtopic_id'];
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
$match_maxid = getvalfield($conn,"exam_que_for_match_tbl","max(que_id)","sub_id = '$queheadid' and examinee_id = '$examne_id' and is_finel_sub = 1");
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
//echo ">>>".$num33;
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
//$answer = "";
}
if($type=="next" && $answer==""){
$answer_status = 3;
}
  $sql33 = "update exam_answers set exam_answer_id = '$answer', answer_status = '$answer_status', exans_created = '$cur_date' where sub_subjecthead_id='$queheadid' and sub_topic_id='$sub_topic_id' and axmne_id = '$examne_id' and quest_id = '$eqt_id' and YEAR(exans_created)='$y' and MONTH(exans_created)='$m' and DAY(exans_created)='$d' and exam_session = '$exam_session'";

$conn->query($sql33);
$ffff = 1;
} else {
 
$sql = "INSERT INTO `exam_answers`(`axmne_id`,`sub_subjecthead_id`, `quest_id`, `exam_answer_id`,`ans_explatnaion`, `answer_status`, `exans_created`, `exam_session`,`sub_topic_id`) VALUES ('$examne_id','$queheadid','$eqt_id','$answer','$answers','$answer_status','$cur_date', '$exam_session','$sub_topic_id')";
$sql_match = "INSERT INTO `exam_que_for_match_tbl`(`exam_id`, `sub_id`, `que_id`, `examinee_id`, `num`, `create_date`,`sub_topic_id`) VALUES ('$exam_id','$queheadid','$eqt_id','$examne_id','$match_count','$cur_date','$sub_topic_id')";
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

}  } else {
$num3 = $_POST['que_numm'];
} 
$crt = '';
if($cntquee=='ll'){
$crt = "ORDER by eqt_id asc limit $_SESSION[cntque]";
} else if($type=='next' || $type=='skip' || $type=='save_and_next'){

$crt = " and `eqt_id` > '$eqt_id' ORDER BY `eqt_id` ASC LIMIT 1";

} else if($type=='previous'){
$crt = " and `eqt_id` < '$eqt_id' ORDER BY `eqt_id` DESC LIMIT 1";
}    //echo "ok".$crt; 
//////////////////// FLAG /////////////////////////////////////////////////
$maxcrt = "";
if($match_maxid<$max_que_id){
$maxcrt = "and eqt_id > '$match_maxid'";
}
///////////////For NO. of all question///////////////
$sql2 = "select * from exam_question_tbl where sub_subjecthead_id='$queheadid' limit $_SESSION[cntque] ";
$result2 = $conn->query($sql2);
//    $num2 = $result2->rowCount();
 ///////////////////////////////// HARD ////////////////////////////   
 // $hard = round(($num2/100)*20);
 // $medium = round(($num2/100)*40);
 // $easy = round(($num2/100)*40); 
 //$flag_que = $conn->query("select * from exam_question_tbl where sub_subjecthead_id='$queheadid' and exam_status = 'active' $maxcrt ORDER by eqt_id asc limit $_SESSION[cntque]");
// $sql_easy = "(SELECT * FROM `exam_question_tbl` WHERE `dificulty_level` = 1 AND `sub_subjecthead_id` = '$queheadid' and sub_subjecthead_id=$queheadid and eqt_id not in( select que_id from exam_que_for_match_tbl where examinee_id = '$examne_id' and sub_id='$queheadid') LIMIT $easy)";
// $sql_medium = "(SELECT * FROM `exam_question_tbl` WHERE `dificulty_level` = 2 AND `sub_subjecthead_id` = '$queheadid' and sub_subjecthead_id=$queheadid and eqt_id not in( select que_id from exam_que_for_match_tbl where examinee_id = '$examne_id' and sub_id='$queheadid') LIMIT $medium)";
// $sql_hard = "(SELECT * FROM `exam_question_tbl` WHERE `dificulty_level` = 3 AND `sub_subjecthead_id` = '$queheadid' and sub_subjecthead_id=$queheadid and eqt_id not in( select que_id from exam_que_for_match_tbl where examinee_id = '$examne_id' and sub_id='$queheadid') LIMIT $hard)";
// $sqlf  = $sql_easy.' UNION '.$sql_medium.' UNION '.$sql_hard;
// $flag_que = $conn->query($sqlf);
// $num2 = $flag_que->rowCount();
// ///$flagArr_row = $flag_que->fetch(PDO::FETCH_ASSOC);
// $a=array();
// while ($flagArr_row = $flag_que->fetch(PDO::FETCH_ASSOC)) {
//   array_push($a,$flagArr_row["eqt_id"]);
// }
 $a = $_SESSION["quesession_array"];
 $num2 = count($a);
//print_r($a);
$cn = 1;
$c2 = $cntque2-1;
if($type=='previous'){
$c3 = $c2-$cn;
} else if($type=="save_and_next" || $type=="next" || $type=="skip"){
  if($cntque==$cntque2){
$c3 = $cntque2-1;
} else {
  $c3 = $c2+$cn;
}
} else {
  $c3 = $c2;
}
if($selected=='selected'){
  $selc_no = $num3-1;
$eqt_id = $a[$selc_no];
}else {
$eqt_id = $a[$c3];
}
///////////////For select new question answer select///////////////
if( $type!='previous' && ($selected=='selected' || $exam_comp=='done')){
$sql = "select * from exam_question_tbl where sub_subjecthead_id='$queheadid' and exam_status = 'active' and eqt_id = '$eqt_id'";

$result = $conn->query($sql);
$num = $result->rowCount();
$ffff = 2;  
}else {
$ffff = 2;
$maxcrt = "";
if($max_que_id>$match_maxid){
$maxcrt = "and eqt_id > '$match_maxid'";
} 
// $sql = "select * from exam_question_tbl where sub_subjecthead_id='$queheadid' and exam_status = 'active' $maxcrt $crt";
$sql = "select * from exam_question_tbl where sub_subjecthead_id='$queheadid' and exam_status = 'active' and eqt_id = '$eqt_id'";
$result = $conn->query($sql);
$num = $result->rowCount();
}

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
if($answer_status==1 || $answer_status==2){
$selected_ans = getvalfield($conn,"exam_answers","exam_answer_id","quest_id='$eqt_id' and axmne_id = '$examne_id' and sub_subjecthead_id = '$sub_subjecthead_id' and YEAR(exans_created)='$y' and MONTH(exans_created)='$m' and DAY(exans_created)='$d' and exam_session = '$exam_session' and is_finel_sub<>1");
$selected = 'checked';
}
$option_sql = "select answer as answer, id as id from exam_answers_option where quehead_id='$queheadid' and eqt_id = '$eqt_id'";
$option_result = $conn->query($option_sql);
?> 
<b><?php echo $num3;  ?>. </b>|||<div class="container" id="question_div"><p><b><?php echo $question; ?></b></p></div>
<?php $numm = 1; 
//foreach ($exam_chArr as $value) {
$x = 'a'; 
$i=1;
while ($exam_chArr = $option_result->fetch(PDO::FETCH_ASSOC)) {
?><p  onclick="return set_option('<?php echo $i; ?>');" style="cursor: pointer;<?php if($selected_ans==$exam_chArr['id']){ ?>background: rgb(242, 249, 255);border: 1px solid rgb(212, 223, 232); <?php }  ?>" id="pt<?php echo $i; ?>"><input id='op<?php echo $i; ?>' type="radio" style="cursor: pointer;" onclick="return set_option('<?php echo $i; ?>');" <?php if($selected_ans==$exam_chArr['id']){ echo $selected; }  ?> name="answers" required="" value="<?php echo htmlspecialchars_decode($exam_chArr['id']); ?>" >(<?php echo $x; ?>) <?php echo htmlspecialchars_decode($exam_chArr['answer']); ?></p>
<?php $numm++; $x++; $i++;} ?>
|||<?php echo $eqt_id."|||".$num2."|||".$num3."|||".$for_previous_id."|||".$num3;  } else { echo "not found |||".$queheadid."|||".$num2."|||".$num3;
} ?>|||<?php if($ffff==1 || $ffff==2){ ?><button type="button" style="padding: revert !important;" onclick="showdiv('1');" data-tip="
Hide" id="kkk"  class="slide-toggle btn btn-warning kkk qtip tip-top toggle_btn"><b>>></b></button>
<div id="showmark" class="col-sm-10 showmark" style="margin-top: -30px;
margin-left: 40px;" >
<div id="sv" class="sug">
<div class="swatch-holder bg-success switch-header-cs-class qtip tip-top attdiv" data-tip="
Attempted" data-class="bg-primary header-text-light">
</div><br><b>Attempted <?php //echo $_REQUEST["que_numm"]; ?><b></div>
<div id="mark" class=" sug">
<div class="swatch-holder bg-warning switch-header-cs-class qtip tip-top revidiv" data-tip="Mark For Review" data-class="bg-primary header-text-light">
</div><br><b>Reviewed<b></div>
<div id="nxt" class=" sug" id="na">
<div class="swatch-holder bg-danger switch-header-cs-class qtip tip-top skipdiv" data-tip="Not Attempted" data-class="bg-primary header-text-light">
</div><br><b>Skipped<b></div>   </div>                 <br>
    <style type="text/css">

a.dfn-hover {
  color: #333;
  text-decoration: none;
}

/** Code for hover info **/

dfn {
  
  
  padding: 0 0.4em;
  
  font-style: normal;
  position: relative;
  
}
dfn::after {
  content: attr(data-info);
  display: inline;
  position: absolute;
  top: 22px; left: 6px;
  opacity: 0;
  width: 230px;
  font-size: 13px;
  font-weight: 700;
  line-height: 1.5em;
  padding: 0.5em 0.8em;
  background: rgb(48 85 118);
  color: #fff;
  pointer-events: none; /* This prevents the box from apearing when hovered. */
  transition: opacity 250ms, top 250ms;
}
dfn::before {
  content: '';
  display: block;
  position: absolute;
  top: 12px; left: 11px;
  opacity: 0;
  width: 0; height: 0;
  border: solid transparent 5px;
  border-bottom-color: rgb(48 85 118);
  transition: opacity 250ms, top 250ms;
}
dfn:hover {z-index: 2;} /* Keeps the info boxes on top of other elements */
dfn:hover::after,
dfn:hover::before {opacity: 1;}
dfn:hover::after {top: 42px;}
dfn:hover::before {top: 32px;}
  </style>
<div class="box bubblediv" style="width: 100%;">
<div class="box-innerss" id="fflgdiv">
<div class="row" id="allq">
<?php
    function closetags ( $html )
        {
        #put all opened tags into an array
        preg_match_all ( "#<([a-z]+)( .*)?(?!/)>#iU", $html, $result );
        $openedtags = $result[1];

        #put all closed tags into an array
        preg_match_all ( "#</([a-z]+)>#iU", $html, $result );
        $closedtags = $result[1];
        $len_opened = count ( $openedtags );

        # all tags are closed
        if( count ( $closedtags ) == $len_opened )
        {
            return $html;
        }
        $openedtags = array_reverse ( $openedtags );

        # close tags
        for( $i = 0; $i < $len_opened; $i++ )
        {
            if ( !in_array ( $openedtags[$i], $closedtags ) )
            {
                $html .= "</" . $openedtags[$i] . ">";
            }
            else
            {
                unset ( $closedtags[array_search ( $openedtags[$i], $closedtags)] );
            }
        } }

// $sql_easy = "(SELECT * FROM `exam_question_tbl` WHERE `dificulty_level` = 1 AND `sub_subjecthead_id` = '$queheadid' and sub_subjecthead_id=$queheadid and eqt_id not in( select que_id from exam_que_for_match_tbl where examinee_id = '$examne_id' and sub_id='$queheadid') LIMIT $easy)";
// $sql_medium = "(SELECT * FROM `exam_question_tbl` WHERE `dificulty_level` = 2 AND `sub_subjecthead_id` = '$queheadid' and sub_subjecthead_id=$queheadid and eqt_id not in( select que_id from exam_que_for_match_tbl where examinee_id = '$examne_id' and sub_id='$queheadid') LIMIT $medium)";
// $sql_hard = "(SELECT * FROM `exam_question_tbl` WHERE `dificulty_level` = 3 AND `sub_subjecthead_id` = '$queheadid' and sub_subjecthead_id=$queheadid and eqt_id not in( select que_id from exam_que_for_match_tbl where examinee_id = '$examne_id' and sub_id='$queheadid') LIMIT $hard)";

//  $sqlf  = $sql_easy.' UNION '.$sql_medium.' UNION '.$sql_hard;

// $flag_que = $conn->query($sqlf);
// $flag_que_num = $flag_que->rowCount();   
$flag_que_num = "";         
$n = 5;  
$i = 1;  
$implode = "";
//print_r($a);
// while ($flag_querow = $flag_que->fetch(PDO::FETCH_ASSOC)) { 
$ii=0;$Arr_cnt = count($a);
for ($ii=0; $ii<$Arr_cnt; $ii++)
{

$queheadidd = $a[$ii];

$chk_num = getvalfield($conn,"exam_answers","count(*)","sub_subjecthead_id='$queheadid' and axmne_id = '$examne_id' and quest_id = '$queheadidd' and exam_session='$exam_session' and is_finel_sub = 0");
//echo "sub_subjecthead_id='$queheadid' and axmne_id = '$examne_id' and quest_id = '$queheadidd' and exam_session='$exam_session' and is_finel_sub = 0";
if($chk_num==0){
 $sql = "INSERT INTO `exam_answers`(`axmne_id`,`sub_subjecthead_id`, `quest_id`, `exam_answer_id`,`ans_explatnaion`, `answer_status`, `exans_created`, `exam_session`,`sub_topic_id`) VALUES ('$examne_id','$queheadid','$queheadidd','$answer','$answers','','$cur_date', '$exam_session','$sub_topic_id')"; 
$match_count = getvalfield($conn,"exam_que_for_match_tbl","max(num)","sub_id='$queheadid' and examinee_id = '$examne_id'");
$sql_match = "INSERT INTO `exam_que_for_match_tbl`(`exam_id`, `sub_id`, `que_id`, `examinee_id`, `num`, `create_date`,`sub_topic_id`) VALUES ('$exam_id','$queheadid','$queheadidd','$examne_id','$match_count','$cur_date','$sub_topic_id')";
$conn->query($sql);
$conn->query($sql_match); }
$implode .= ",".$queheadidd;
$qqid = '';
if($flag_que_num==$i) {
$qqid = "id = 'lqid'";
}
$nn = $i%6;
$quehead = getvalfield($conn,"exam_question_tbl","exam_question","eqt_id='$queheadidd'");
$dificulty_level = getvalfield($conn,"exam_question_tbl","dificulty_level","eqt_id='$queheadidd'");
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
//$quehead = str_replace("&nbsp;","",$quehead);
//$quehead = str_replace(" ","",$quehead);
//  $quehead = preg_replace('/\s+/', '', $quehead);
$quehead = preg_replace('/\s+\r+\n+/', ' ', $quehead);
$quehead = strip_tags($quehead);
//$quehead = htmlentities($quehead);
//
//$quehead = html_entity_decode($quehead);
//$quehead = closetags($quehead);
?>          
<span style="text-decoration: none; cursor:pointer; " <?php //if($status==0){ ?>onclick="get_question(<?php echo $i ?>,<?php echo $queheadidd; ?>,'selected','');" <?php //} ?>><div class="swatch-holder <?php echo $color; ?> switch-header-cs-class tip" data-class="bg-primary header-text-light" >
<center style="color: white;" ><dfn data-info="<?php echo $quehead; ?>"><?php echo $i; ?></dfn></center></div> </span><?php //if($i==0){?></br><?php //}   ?>
<?php $i++; } ?></div>
        </div>
    </div><?php } 
    echo "|||".$implode;
    //} 
    // else{ unset($_SESSION["cntque"]); echo "not found |||"." "."|||".$num2."|||".$num3; } 
  
 ?>

