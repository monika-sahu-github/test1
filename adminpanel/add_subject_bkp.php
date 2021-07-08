<?php
	include('../conn.php');
	//if(isset($_POST['topic_name']) & isset($_POST['mainsub_id'])){
	$topic_name = $_POST['topic_name'];
	$mainsub_id = $_POST['mainsub_id'];

?>
<?php 
	if($conn->query("INSERT INTO subject_quehead (main_subject_id,exam_id, quehead) values('$mainsub_id ', '$mainsub_id ', '$topic_name')")){
		
		echo "success";

	}else{
		echo "fail";
	}
//}
?>