<?php 
 include("../../conn.php");
 
 extract($_POST);
//echo "SELECT * FROM subject_quehead WHERE quehead='$examTitle' and type = '$exam_typee' and exam_id = '$courseSelected' ";
 $selCourse = $conn->query("SELECT * FROM subject_quehead WHERE quehead='$examTitle' and type = '$exam_typee' and exam_id = '$courseSelected' ");
  if($selCourse->rowCount() > 0)
 {
	$res = array("res" => "exist", "quehead" => $examTitle);
 }
 else
 {   
  	$cur_date = date('Y-m-d');
    $insExam = $conn->query("INSERT INTO subject_quehead(quehead,exam_id,type,examQuestDipLimit,Create_date) VALUES('$examTitle','$courseSelected','$exam_typee','$examQuestTime','$cur_date') ");
	if($insExam)
	{
		$res = array("res" => "success", "examTitle" => $examTitle);
	}
	else
	{
		$res = array("res" => "failed", "examTitle" => $examTitle);
	}
	//$var = "INSERT INTO subject_quehead(quehead,exam_id,type,examQuestDipLimit,Create_date) VALUES('$examTitle','$courseSelected','$exam_typee','$examQuestTime','$cur_date') ";
//$res = array("res" => $var);

 }
 echo json_encode($res);
 ?>