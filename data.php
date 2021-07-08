<?php
header('Content-Type: application/json');
 include("conn.php");
//$conn = mysqli_connect("localhost","root","","phpsamples");
// if ($conn) {
// 	echo "Connected";
// }else {
//    echo "NOt Connected";
// }

// $sqlQuery = "SELECT student_id,student_name,marks FROM tbl_marks ORDER BY student_id";

// $result = mysqli_query($conn,$sqlQuery);

$result = $conn->query("SELECT * FROM tbl_marks WHERE 1 ");
// //$result = $selAcc->fetch(PDO::FETCH_ASSOC);
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

//mysqli_close($conn);
//print_r($data);
echo json_encode($data);
 //echo "okkk";
?>