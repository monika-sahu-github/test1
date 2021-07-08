<?php include '../conn.php'; 
$sub_category_id = $_POST["sub_category_id"];
if($conn->query("UPDATE sub_category_master SET status ='1' WHERE id = '$sub_category_id'")){
		echo "success";
}else {
	echo "fail";
}
?>