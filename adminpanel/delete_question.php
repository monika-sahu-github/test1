<?php include '../conn.php'; 
$question_id = $_POST["que_id"];
if($conn->query("UPDATE exam_question_tbl SET status ='1' WHERE eqt_id = '$question_id'")){
	echo "success";
}else {
	echo "fail";
}
?>

