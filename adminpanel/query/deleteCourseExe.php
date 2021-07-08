<?php 
 include("../../conn.php");


extract($_POST);

$delCourse = $conn->query("DELETE  FROM exam_tbl WHERE ex_id='$id'  ");
if($delCourse)
{
	$res = array("res" => "success");
}
else
{
	$res = array("res" => "failed");
}



	echo json_encode($res);
 ?>