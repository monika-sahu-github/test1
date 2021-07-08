<?php include '../conn.php'; 
$sub_topic_id = $_POST["subtopic_id"];
if($conn->query("UPDATE sub_topic_master SET status ='1' WHERE id = '$sub_topic_id'  ")){
	echo "success";
}else {
	echo "fail";
}
?>