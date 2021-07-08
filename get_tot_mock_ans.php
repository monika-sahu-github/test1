<?php
 include("conn.php");
 session_start();
     function getvalfield($conn,$table,$field,$where)
    { //echo "SELECT $field FROM $table WHERE $where";
        $stmt = $conn->prepare("SELECT $field FROM $table WHERE $where"); 
        $stmt->execute(); 
        $row = $stmt->fetch(); 
        return $row[0];
    }   
    $examne_id =  $_SESSION['examineeSession']['exmne_id'];
    $examId =  $_POST['exam_id'];
    $y = date('Y'); 
    $m = date('m');
    $d = date('d'); 
 
    $tot_skip = getvalfield($conn,"exam_answers","count(*)","axmne_id = '$examne_id' and exam_id = '$examId' and answer_status = 2 and is_finel_sub = 0 and mock_type = 'scheduled'");
    //echo "axmne_id = '$examne_id' and exam_id = '$examId' and answer_status = 2 and is_finel_sub = 0 and mock_type = 'scheduled'";
    //echo "select count(*) from exam_answers where axmne_id = '$examne_id' and exam_id = '$examId' and answer_status = 2 and YEAR(exans_created)='$y' and MONTH(exans_created)='$m' and DAY(exans_created)='$d' and exam_session = '$exam_session'";
    
    $tot_not_att = getvalfield($conn,"exam_answers","count(*)","axmne_id = '$examne_id' and exam_id = '$examId' and (answer_status = 3 OR answer_status = 0) and is_finel_sub = 0 and mock_type = 'scheduled'");
    
    
    $tot_att = getvalfield($conn,"exam_answers","count(*)","axmne_id = '$examne_id' and exam_id = '$examId' and answer_status = 1 and is_finel_sub = 0 and mock_type = 'scheduled'");
//echo "axmne_id = '$examne_id' and exam_id = '$examId' and is_finel_sub = 0";
echo $tot_skip."||".$tot_not_att."||".$tot_att;
                              // $examtime = getvalfield($conn,"exam_answers","examtime","axmne_id = '$exmneId' and exam_id = '$examId'");
  
 ?>
