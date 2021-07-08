<?php
 include("conn.php");
 session_start();   
    $examne_id =  $_SESSION['examineeSession']['exmne_id'];
    $create_date = date('Y-m-d H:i:s');
    if(isset($_REQUEST["feedback"])){ 
        $feedback = $_REQUEST["feedback"];
        $question_id = $_REQUEST["que_id"];
        $sub_id = $_REQUEST["sub_id"];
    $sql = "INSERT into question_feedback (question_id,sub_id,feedback,examne_id,create_date) values('$question_id','$sub_id','$feedback','$examne_id','$create_date')";
    $stmt= $conn->prepare($sql);
    if($stmt->execute()){
        echo "success";
    } else {
        echo "fail";
    }
}
    
 ?>
