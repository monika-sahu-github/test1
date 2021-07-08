<?php 
include("conn.php");
session_start();
 function getvalfield($conn,$table,$field,$where)
{ //echo "SELECT $field FROM $table WHERE $where";
$stmt = $conn->prepare("SELECT $field FROM $table WHERE $where"); 
$stmt->execute(); 
$row = $stmt->fetch(); 
return $row[0];
}$exam_id = $_REQUEST["exam_id"]; 
 $examne_id =  $_SESSION['examineeSession']['exmne_id'];
 $exam_time = getvalfield($conn,"exam_tbl","ex_created","ex_id = '$exam_id'");
 $sqlf = "SELECT * FROM test_table WHERE test_id = '$exam_id' and test_type = 'on_demand'";
$flag_que = $conn->query($sqlf);
$flag_que_num = $flag_que->rowCount(); 
$a=array();
while ($flagArr_row = $flag_que->fetch(PDO::FETCH_ASSOC)) {
  array_push($a,$flagArr_row["question_id"]);
}
print_r($a);
$_SESSION["quesession_array"] = $a;
?>