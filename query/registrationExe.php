<?php 
session_start();
 include("../conn.php");
 

extract($_POST);


$selAcc = $conn->query("SELECT * FROM examinee_tbl WHERE exmne_email='$email' ");
$selAccRow = $selAcc->fetch(PDO::FETCH_ASSOC);

$res = '';
if($selAcc->rowCount() > 0)
{

  $res = array("res" => "already");

}
else
{
	date_default_timezone_set('Asia/Kolkata');
 $create_date = date('Y-m-d h:i:s');
$insAns = $conn->query("INSERT INTO `examinee_tbl`(`exmne_fullname`, `exmne_gender`, `exmne_birthdate`, `exmne_email`, `exmne_password`, `exmne_state`, `exmne_phoneno`, `create_date`) VALUES ('$name','$gender','$dob','$email','$pass','$state','$phoneno','$create_date')");
if($insAns)
{ 
  
  $res = array("res" => "success");

  $selAcc = $conn->query("SELECT * FROM examinee_tbl WHERE exmne_email='$email' AND exmne_password='$pass'  ");
$selAccRow = $selAcc->fetch(PDO::FETCH_ASSOC);
if($selAcc->rowCount() > 0)
{
  $_SESSION['examineeSession'] = array(
  	 'exmne_id' => $selAccRow['exmne_id'],
  	 'examineenakalogin' => true
  );
  $res = array("res" => "success");
}
else
{
  $res = array("res" => "invalid");
}

}
else
{
  $res = array("res" => "invalid");
}

}


 echo json_encode($res);
 ?>