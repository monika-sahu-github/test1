<?php include '../conn.php'; 
$subject_id = $_POST["subject_id"];
if($conn->query("UPDATE main_subject SET status ='1' WHERE ex_id='$subject_id'")){
	echo "success";
}else {
	echo "fail";
}
?>
