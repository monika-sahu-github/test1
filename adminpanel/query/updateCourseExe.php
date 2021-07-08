<?php
 include("../../conn.php");
 extract($_POST);


$newCourseName = strtoupper($newCourseName);
$updCourse = $conn->query("UPDATE exam_tbl SET ex_title='$newCourseName', type='$type', exam_logo = '$exam_logo' WHERE ex_id='$ex_id' ");
if($updCourse)
{
	   $res = array("res" => "success", "newCourseName" => $newCourseName);
}
else
{
	   $res = array("res" => "failed");
}



 echo json_encode($res);	
?>