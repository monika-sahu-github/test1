<h1>NOTIFICATIONS</h1>
<?php 
	session_start();
  include("conn.php");
  include("query/selectData.php");

$examne_id =  $_SESSION['examineeSession']['exmne_id'];

  //////////////////////////REMOVE INCOMPEXAM///////////////
//$conn->query("DELETE FROM exam_answers WHERE axmne_id='$examne_id' AND is_finel_sub=0");
//$conn->query("DELETE FROM exam_que_for_match_tbl WHERE examinee_id='$examne_id' AND is_finel_sub=0");
 ?>
 <?php
 if(isset($_GET['id'])){
 	$id1 = $_GET['id'];
 	$sql = $conn->query("INSERT INTO read_status SET notification_id = '$id1', user_id = '$examne_id' ");
 	//$conn->prepare($sql);
 	$sql->execute();

 	$sql1=$conn->query("SELECT * FROM `notifications` WHERE `id` = '$id1'");
 	$sql1->execute();
 	 $result = $sql1->fetchAll();
              if(count($result)>0){ 
              	//echo $result;
              	foreach($result as $i){
              		echo $i['title'],"</br>", $i['description'];
                  header("location:".$i['target_link']);
              	}
              }else{
              echo "<center>","No Records yet.","</center>";
            }
 }
 ?>
 <br/>
 <a href="home.php">Back</a>
