<?php 
include("../../conn.php");
extract($_POST);
$course_name = strtoupper($exam_name);
$selCourse = $conn->query("SELECT * FROM exam_tbl WHERE ex_title='$course_name' and type = '1' ");
if($selCourse->rowCount() > 0)
 {
	$res = array("res" => "exist", "course_name" => $course_name);
 }
 else
 {
    
	$insCourse = $conn->query("INSERT INTO exam_tbl(ex_title,type,exam_logo,exam_datetime,questions) VALUES('$course_name','1','$exam_mock_logo','$exam_datetime','$questions') ");
	if($insCourse)
	{
		$res = array("res" => "success", "course_name" => $course_name, "type" => 1, "exam_logo" => $exam_mock_logo, "exam_datetime" => $exam_datetime, "questions" => $questions);
	}
	else
	{
		$res = array("res" => "success", "course_name" => $course_name, "type" => 1, "exam_logo" => $exam_mock_logo, "exam_datetime" => $exam_datetime, "questions" => $questions);
	}
 }
echo json_encode($res);
 ?>