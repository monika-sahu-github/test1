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
    $y = date('Y'); 
    $m = date('m');
    $d = date('d'); 
$cur_date = date('Y-m-d');
    $examne_id =  $_SESSION['examineeSession']['exmne_id'];
    $queheadid =  $_POST['queheadid'];
    $examtime = $_POST['examtime'];
    //$exam_session = getvalfield($conn,"exam_answers","max(exam_session)","axmne_id = '$examne_id'");
    $exam_session = $_SESSION["exam_session"];
    $impque = $_POST["impque"];
    $queArr = explode(",", $impque);
    //print_r($queArr);
         foreach ($queArr as $value) {
        $eqt_id = $value;
        $answer = '';
        $answers = '';
        if($value!=""){
         $numm = getvalfield($conn,"exam_answers","count(*)","axmne_id = '$examne_id' and quest_id = '$value' and is_finel_sub = 0");
         if($numm==0){
          $sql = "INSERT INTO `exam_answers`(`axmne_id`,`sub_subjecthead_id`, `quest_id`, `exans_answer`,`ans_explatnaion`, `answer_status`, `exans_created`, `exam_session`) VALUES ('$examne_id','$queheadid','$eqt_id','$answer','$answers','3','$cur_date', '$exam_session')";

            $sql_match = "INSERT INTO `exam_que_for_match_tbl`(`sub_id`, `que_id`, `examinee_id`, `create_date`) VALUES ('$queheadid','$eqt_id','$examne_id','$cur_date')";
         $conn->query($sql);
         $conn->query($sql_match);
         } }
      }

    echo $sql33 = "update exam_answers set is_finel_sub = '1', examtime = '$examtime' where sub_subjecthead_id='$queheadid' and axmne_id = '$examne_id' and exam_session = '$exam_session'";

    $sql331 = "update exam_answers set exam_answer_id = '0' where sub_subjecthead_id='$queheadid' and axmne_id = '$examne_id' and exam_session = '$exam_session' and answer_status = 2 and is_finel_sub = 0";
   // $conn->query($sql331);
    $sql333 = "update exam_que_for_match_tbl set is_finel_sub = '1' where sub_id='$queheadid' and examinee_id = '$examne_id'";
 // $sql33 = "update exam_answers set is_finel_sub = '1', examtime = '$examtime' where sub_subjecthead_id='$queheadid' and axmne_id = '$examne_id' and answer_status = 2 and YEAR(exans_created)='$y' and MONTH(exans_created)='$m' and DAY(exans_created)='$d'";
    //if($conn->query($sql331)){
      $conn->query($sql33);
      $conn->query($sql333);
    //}
   // $sql33 = "update exam_answers set is_finel_sub = '1', examtime = '$examtime' where sub_subjecthead_id='$queheadid' and axmne_id = '$examne_id' and exam_session = '$exam_session'";
 // $sql33 = "update exam_answers set is_finel_sub = '1', examtime = '$examtime' where sub_subjecthead_id='$queheadid' and axmne_id = '$examne_id' and answer_status = 2 and YEAR(exans_created)='$y' and MONTH(exans_created)='$m' and DAY(exans_created)='$d'";
      //$conn->query($sql33);
  
 ?>
