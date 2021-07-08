<?php 
 include("../../conn.php");


extract($_POST);

$delExam = $conn->query("DELETE  FROM subject_quehead WHERE id='$id'  ");
if($delExam)
{
	$res = array("res" => "success");
}
else
{
	$res = array("res" => "failed");
}


	echo json_encode($res);
 ?>