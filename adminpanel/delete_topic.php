<?php include '../conn.php'; 
$topic_id = $_POST["topic_id"];
if($conn->query("UPDATE subject_quehead SET status ='1' WHERE id = '$topic_id'")){
		echo "success";
}else {
	echo "fail";
}
?>