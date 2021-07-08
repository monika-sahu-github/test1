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
if($eqt_id==''){
$eqt_id = 0;
}
$cur_time = date('H:i');
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
 $match_maxid1 = getvalfield($conn,"exam_que_for_match_tbl","max(id)","exam_id = '$exam_id' and examinee_id = '$examne_id' and is_finel_sub = 1");
 $match_maxid = getvalfield($conn,"exam_que_for_match_tbl","max(que_id)","sub_id = '$queheadid' and examinee_id = '$examne_id' and is_finel_sub = 1");
 $max_que_id = getvalfield($conn,"exam_question_tbl","max(eqt_id)","sub_subjecthead_id='$queheadid'"); 

if($eqt_id!='' && $eqt_id!=0 && $examne_id!='' && $type!='previous' && $selected!='selected'){
  $sql33 = "select * from exam_answers where exam_id='$exam_id' and axmne_id = '$examne_id' and quest_id = '$eqt_id' and YEAR(exans_created)='$y' and MONTH(exans_created)='$m' and DAY(exans_created)='$d' and is_mock = 1 and is_finel_sub <> 1";
$result33 = $conn->query($sql33); 
$num33 = $result33->rowCount();
$quebank_maxid = getvalfield($conn,"test_table","max(question_id)","exam_id = '$exam_id' ");
$match_count_plus = 0;
if($quebank_maxid==$eqt_id){
$match_count_plus = 1;
}
$match_count = getvalfield($conn,"exam_que_for_match_tbl","max(num)","exam_id='$exam_id' and examinee_id = '$examne_id'");
if($num33>0){
$answer_status_for_chk = getvalfield($conn,"exam_answers","answer_status","quest_id='$eqt_id' and axmne_id = '$examne_id' and exam_id = '$exam_id'");
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
if($_REQUEST["check_status"]==1){
  $answer_status = 3;
}
$sql33 = "update exam_answers set exam_answer_id = '$answer', answer_status = '$answer_status', exans_created = '$cur_date' where exam_id='$exam_id' and axmne_id = '$examne_id' and quest_id = '$eqt_id' and YEAR(exans_created)='$y' and MONTH(exans_created)='$m' and DAY(exans_created)='$d'";
$conn->query($sql33);
$ffff = 1;
} else {

$sql = "INSERT INTO `exam_answers`(`axmne_id`,`exam_id`, `quest_id`, `exam_answer_id`,`ans_explatnaion`, `answer_status`, `exans_created`) VALUES ('$examne_id','$exam_id','$eqt_id','$answer','$answers','$answer_status','$cur_date')";
$sql_match = "INSERT INTO `exam_que_for_match_tbl`(`exam_id`, `exam_id`, `que_id`, `examinee_id`, `num`, `create_date`) VALUES ('$exam_id','$exam_id','$eqt_id','$examne_id','$match_count','$cur_date')";
$conn->query($sql);
$conn->query($sql_match);
$ffff = 2;
}
        
}
$cntque2 = $_POST['cntque2'];       
$cnt_num = 1;
$num3 = 1;
echo $cntque.">=".$cntque2;
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
//echo "????".$num3;
// if($cntquee=='ll'){
// $crt = "ORDER by eqt_id asc limit $_SESSION[cntque]";
// } else 
if($type=='next' || $type=='skip' || $type=='save_and_next'){

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
$sql2 = "select * from test_table where exam_id='$exam_id'";
$result2 = $conn->query($sql2);
 $a = $_SESSION["quesession_array"];
 $num2 = count($a); 
print_r($a);
$cn = 1;
$c2 = $cntque2-1;
if($type=='previous'){
$c3 = $c2-$cn;
// } else if($type=="save_and_next" || $type=="next" || $type=="skip"){
} else if($type=="next" || $type=="skip"){
  if($cntque==$cntque2){
$c3 = $cntque2-1;
}  else {
  $c3 = $c2+$cn;
}
} else {
  $c3 = $c2;
}

if($type=="save_and_next"){
  $c3 = $cntque2-1;
    $num3 = $num3-1;
  //echo $eqt_id."???????????".$c3;
}
if($selected=='selected'){
 $selc_no = $num3-1;
$eqt_id = $a[$selc_no];
}else {
$eqt_id = $a[$c3];
}

///////////////For select new question answer select///////////////
if( $type!='previous' && ($selected=='selected' || $exam_comp=='done')){
$sql = "select * from exam_question_tbl where eqt_id = '$eqt_id'";

$result = $conn->query($sql);
$num = $result->rowCount();
$ffff = 2;  
}else {
$ffff = 2;
$maxcrt = "";
if($max_que_id>$match_maxid){
$maxcrt = "and question_id > '$match_maxid'";
} 
// $sql = "select * from exam_question_tbl where sub_subjecthead_id='$queheadid' and exam_status = 'active' $maxcrt $crt";
echo $sql = "select * from exam_question_tbl where eqt_id = '$eqt_id'";
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

$answer_status = getvalfield($conn,"exam_answers","answer_status","quest_id='$eqt_id' and axmne_id = '$examne_id' and exam_id = '$exam_id' and YEAR(exans_created)='$y' and MONTH(exans_created)='$m' and DAY(exans_created)='$d' and is_finel_sub<>1");
$selected = '';
$selected_ans = '';
if($answer_status==1 || $answer_status==2){
$selected_ans = getvalfield($conn,"exam_answers","exam_answer_id","quest_id='$eqt_id' and axmne_id = '$examne_id' and exam_id = '$exam_id' and YEAR(exans_created)='$y' and MONTH(exans_created)='$m' and DAY(exans_created)='$d' and is_finel_sub<>1");
$selected = 'checked';
}
$option_sql = "select answer as answer, id as id from exam_answers_option where eqt_id = '$eqt_id'";
$option_result = $conn->query($option_sql);
?> 
<b><?php echo $num3;  ?>. </b>|||<p><b><?php echo $question; ?></b></p>
<?php $numm = 1; 
$x = 'a'; 
$i=1;
while ($exam_chArr = $option_result->fetch(PDO::FETCH_ASSOC)) {
?><p  onclick="return set_option('<?php echo $i; ?>');" style="cursor: pointer;<?php if($selected_ans==$exam_chArr['id']){ ?>background: rgb(242, 249, 255);border: 1px solid rgb(212, 223, 232); <?php }  ?>" id="pt<?php echo $i; ?>"><input id='op<?php echo $i; ?>' style="cursor: pointer;" onclick="return set_option('<?php echo $i; ?>');" type="radio" <?php if($selected_ans==$exam_chArr['id']){ echo $selected; }  ?> name="answers" required="" value="<?php echo htmlspecialchars_decode($exam_chArr['id']); ?>" >(<?php echo $x; ?>) <?php echo htmlspecialchars_decode($exam_chArr['answer']); ?></p>
<?php $numm++; $x++; $i++;} ?>
|||<?php echo $eqt_id."|||".$num2."|||".$num3."|||".$for_previous_id."|||".$num3;  } else { echo "not found |||".$exam_id."|||".$num2."|||".$num3;
} ?>|||<?php if($ffff==1 || $ffff==2){ ?>
  <!-- <button type="button" style="padding: revert !important;" onclick="showdiv('1');" id="kkk" class="slide-toggle btn btn-warning kkk"><b>>></b></button> -->
<!-- <div id="showmark" class="col-sm-10" style="margin-top: -30px;
margin-left: 40px;" >
<div id="sv" class="sug">
<div class="swatch-holder bg-success switch-header-cs-class qtip tip-top" data-tip="
Saved" data-class="bg-primary header-text-light">
</div><br><b>Saved<b></div>
<div id="mark" class=" sug">
<div class="swatch-holder bg-warning switch-header-cs-class qtip tip-top" data-tip="Mark For Review" data-class="bg-primary header-text-light">
</div><br><b>Review<b></div>
<div id="nxt" class=" sug" id="na">
<div class="swatch-holder bg-danger switch-header-cs-class qtip tip-top" data-tip="Not Attempted" data-class="bg-primary header-text-light">
</div><br><b>NA<b></div>   </div>  -->                <br>
<div class="box" style="width: 100%;">
<div class="box-innerss" id="fflgdiv" style="">
<div class="row" id="allq">
<?php           
$n = 5;  
$i = 1;  
$implode = "";
//print_r($a);
$ii=0;$Arr_cnt = count($a);
for ($ii=0; $ii<$Arr_cnt; $ii++)
{ 
$queheadidd = $a[$ii];
$chk_num = getvalfield($conn,"exam_answers","count(*)","axmne_id = '$examne_id' and exam_id = '$exam_id' and quest_id = '$queheadidd' and is_mock='1' and is_finel_sub = 0");
if($chk_num==0){
$sql = "INSERT INTO `exam_answers`(`axmne_id`,`exam_id`, `quest_id`, `exam_answer_id`,`ans_explatnaion`, `answer_status`, `exans_created`,`is_mock`,`mock_type`) VALUES ('$examne_id','$exam_id','$queheadidd','$answer','$answers','','$cur_date','1','on_demand')"; 
$conn->query($sql);
 }
$implode .= ",".$queheadidd;

$nn = $i%6;
$quehead = getvalfield($conn,"exam_question_tbl","exam_question","eqt_id='$queheadidd'");
$answer_status = getvalfield($conn,"exam_answers","answer_status","quest_id='$queheadidd' and axmne_id = '$examne_id' and exam_id = '$exam_id' and is_finel_sub<>1");
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
<!-- <span style="text-decoration: none; cursor:pointer; " <?php //if($status==0){ ?>onclick="get_question(<?php echo $i ?>,<?php echo $queheadidd; ?>,'selected','');" <?php //} ?>><div class="swatch-holder <?php echo $color; ?> switch-header-cs-class tip"  data-tip='' data-class="bg-primary header-text-light" <?php //echo $qqid; ?> >
<center style="color: white;" ><?php echo $i; ?><div title="<?php echo $quehead; ?>" ></div></center></div> </span> -->
<?php $i++; } ?></div>
        </div>
    </div><?php } 
    echo "|||".$implode;
    //} 
    // else{ unset($_SESSION["cntque"]); echo "not found |||"." "."|||".$num2."|||".$num3; } 
  
 ?>
