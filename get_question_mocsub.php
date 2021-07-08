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
    $exam_id =  $_POST['exam_id'];
    $examtime = $_POST['examtime'];
    $exam_session = $_SESSION["exam_session"];
    $impque = $_POST["impque"];
    $queArr = explode(",", $impque);

     $sql33 = "update exam_answers set is_finel_sub = '1', examtime = '$examtime' where exam_id='$exam_id' and axmne_id = '$examne_id' and mock_type = 'scheduled'";

    //$sql331 = "update exam_answers set exam_answer_id = '0' where exam_id='$exam_id' and axmne_id = '$examne_id' and answer_status = 2 and is_finel_sub = 0 and mock_type = 'scheduled'";
   // $conn->query($sql331);
    $sql333 = "update exam_que_for_match_tbl set is_finel_sub = '1' where exam_id='$exam_id' and examinee_id = '$examne_id'";
 // $sql33 = "update exam_answers set is_finel_sub = '1', examtime = '$examtime' where sub_subjecthead_id='$queheadid' and axmne_id = '$examne_id' and answer_status = 2 and YEAR(exans_created)='$y' and MONTH(exans_created)='$m' and DAY(exans_created)='$d'";
    //if($conn->query($sql331)){
      $conn->query($sql33);
      $conn->query($sql333);
    //}
   // $sql33 = "update exam_answers set is_finel_sub = '1', examtime = '$examtime' where sub_subjecthead_id='$queheadid' and axmne_id = '$examne_id' and exam_session = '$exam_session'";
 // $sql33 = "update exam_answers set is_finel_sub = '1', examtime = '$examtime' where sub_subjecthead_id='$queheadid' and axmne_id = '$examne_id' and answer_status = 2 and YEAR(exans_created)='$y' and MONTH(exans_created)='$m' and DAY(exans_created)='$d'";
      //$conn->query($sql33);
  
 ?>
