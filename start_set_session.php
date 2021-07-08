<?php 
include("conn.php");
session_start();
$val = $_REQUEST["val"];
$queheadid = $_REQUEST["queheadid"];
 $hard = round(($val/100)*20);
 $medium = round(($val/100)*40);
 $easy = round(($val/100)*40); 
 $examne_id =  $_SESSION['examineeSession']['exmne_id'];
$sql_easy = "(SELECT * FROM `exam_question_tbl` WHERE `dificulty_level` = 1 AND `sub_subjecthead_id` = '$queheadid' and eqt_id not in( select que_id from exam_que_for_match_tbl where examinee_id = '$examne_id' and sub_id='$queheadid' and is_finel_sub = 1) LIMIT $easy)";
$result_easy = $conn->query($sql_easy);
$easy_num = $result_easy->rowCount();
$sql2_easy = "";
 $easy."-".$easy_num; 
if($easy_num<$easy){ 
	$easy2 = $easy-$easy_num;
$sql2_easy = " UNION (select * from exam_question_tbl WHERE dificulty_level = 1 and sub_subjecthead_id=$queheadid LIMIT $easy2) ";
}
$sql_medium = "(SELECT * FROM `exam_question_tbl` WHERE `dificulty_level` = 2 AND `sub_subjecthead_id` = '$queheadid' and eqt_id not in( select que_id from exam_que_for_match_tbl where examinee_id = '$examne_id' and sub_id='$queheadid' and is_finel_sub = 1) LIMIT $medium)";
$result_medium = $conn->query($sql_medium);
$medium_num = $result_medium->rowCount();
$sql2_medium = "";
if($medium_num<$medium){
	$medium2 = $medium-$medium_num;
$sql2_medium = " UNION (select * from exam_question_tbl WHERE dificulty_level = 2 and sub_subjecthead_id=$queheadid LIMIT $medium2) ";
}
$sql_hard = "(SELECT * FROM `exam_question_tbl` WHERE `dificulty_level` = 3 AND `sub_subjecthead_id` = '$queheadid' and eqt_id not in( select que_id from exam_que_for_match_tbl where examinee_id = '$examne_id' and sub_id='$queheadid' and is_finel_sub = 1) LIMIT $hard)";
$result_hard = $conn->query($sql_hard);
$hard_num = $result_hard->rowCount();
$sql2_hard = "";
if($hard_num<$hard){
	$hard2 = $hard-$hard_num;
$sql2_hard = " UNION (select * from exam_question_tbl WHERE dificulty_level = 3 and sub_subjecthead_id=$queheadid LIMIT $hard2) ";
}
echo $sqlf  = $sql_easy.$sql2_easy.' UNION '.$sql_medium.$sql2_medium.' UNION '.$sql_hard.$sql2_hard;
$flag_que = $conn->query($sqlf);
$flag_que_num = $flag_que->rowCount(); 
$a=array();
while ($flagArr_row = $flag_que->fetch(PDO::FETCH_ASSOC)) {
  array_push($a,$flagArr_row["eqt_id"]);
}
print_r($a);
$_SESSION["quesession_array"] = $a;
?>