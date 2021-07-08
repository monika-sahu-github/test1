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
    $examId =  $_POST['queheadid'];
    $y = date('Y'); 
    $m = date('m');
    $d = date('d'); 
    
    $exans_id = getvalfield($conn,"exam_answers","max(exans_id)","axmne_id = '$examne_id' and sub_subjecthead_id = '$examId' and is_finel_sub = 1");

    $exam_session = getvalfield($conn,"exam_answers","max(exam_session)","axmne_id = '$examne_id' and sub_subjecthead_id = '$examId' and is_finel_sub = 1 and exans_id = '$exans_id'");
 
    $tot_skip = getvalfield($conn,"exam_answers","count(*)","axmne_id = '$examne_id' and sub_subjecthead_id = '$examId' and answer_status = 2 and exam_session = '$exam_session'");
    
    //echo "select count(*) from exam_answers where axmne_id = '$examne_id' and sub_subjecthead_id = '$examId' and answer_status = 2 and YEAR(exans_created)='$y' and MONTH(exans_created)='$m' and DAY(exans_created)='$d' and exam_session = '$exam_session'";
    // echo  $sql = "update exam_answers set answer_status = 3 where axmne_id = '$examne_id' and sub_subjecthead_id = '$examId' and answer_status = 0 and exam_session = '$exam_session'";
//     if(isset($_REQUEST["examend"])){ 
//     $sql = "update exam_answers set answer_status = 3 where axmne_id = '$examne_id' and sub_subjecthead_id = '$examId' and answer_status = 0 and exam_session = '$exam_session'";
//     $stmt= $conn->prepare($sql);
//     $stmt->execute(); 
// }
    $tot_not_att = getvalfield($conn,"exam_answers","count(*)","axmne_id = '$examne_id' and sub_subjecthead_id = '$examId' and (answer_status = 3 OR answer_status = 0) and exam_session = '$exam_session'");
    
    
    $tot_att = getvalfield($conn,"exam_answers","count(*)","axmne_id = '$examne_id' and sub_subjecthead_id = '$examId' and answer_status = 1 and exam_session = '$exam_session'");
//echo "axmne_id = '$examne_id' and sub_subjecthead_id = '$examId' and is_finel_sub = 0";
echo $tot_skip."||".$tot_not_att."||".$tot_att;
                              // $examtime = getvalfield($conn,"exam_answers","examtime","axmne_id = '$exmneId' and sub_subjecthead_id = '$examId'");
  
 ?>
