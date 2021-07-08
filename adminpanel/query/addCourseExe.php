<?php 
 include("../../conn.php");
 
 extract($_POST);

$course_name = strtoupper($course_name);
 $selCourse = $conn->query("SELECT * FROM exam_tbl WHERE ex_title='$course_name' and type = '$exam_type' ");

 if($selCourse->rowCount() > 0)
 {
	$res = array("res" => "exist", "course_name" => $course_name);
 }
 else
 {
    
	$insCourse = $conn->query("INSERT INTO exam_tbl(ex_title,type,exam_logo) VALUES('$course_name','$exam_type','$exam_logo') ");
	if($insCourse)
	{
		$res = array("res" => "success", "course_name" => $course_name, "type" => $exam_type, "exam_logo" => $exam_logo);
	}
	else
	{
		$res = array("res" => "failed", "course_name" => $course_name, "type" => $exam_type, "exam_logo" => $exam_logo);
	}


 }




 echo json_encode($res);
 ?>