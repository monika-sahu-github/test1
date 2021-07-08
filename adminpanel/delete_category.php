<?php include '../conn.php'; 
$category_id = $_POST["category_id"];
if($conn->query("UPDATE category_master SET status ='1' WHERE id = '$category_id'")){
		echo "success";
}else {
	echo "fail";
}
?>