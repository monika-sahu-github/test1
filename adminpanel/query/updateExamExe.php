<?php 
 include("../../conn.php");
 
 extract($_POST);


 $updExam = $conn->query("UPDATE subject_quehead SET quehead='$examTitle', exam_id='$courseSelected', type='$exam_typee', examQuestDipLimit='$examQuestTime' WHERE  id='$examId' ");

 if($updExam)
 {
   $res = array("res" => "success", "msg" => $examTitle);
 }
 else
 {
   $res = array("res" => "failed");
 }

 echo json_encode($res);
 ?>