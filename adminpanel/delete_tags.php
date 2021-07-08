<?php include '../conn.php'; 
$tag_id = $_POST["tag_id"];
if($conn->query("UPDATE add_tags SET status ='1' WHERE id = '$tag_id'")){
		echo "success";
}else {
	echo "fail";
}
?>