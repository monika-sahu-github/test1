<?php 
$exmneId = $_SESSION['examineeSession']['exmne_id'];

// Select Data sa nilogin nga examinee
$selExmneeData = $conn->query("SELECT * FROM examinee_tbl WHERE exmne_id='$exmneId' ")->fetch(PDO::FETCH_ASSOC);
$exmneCourse =  $selExmneeData['exmne_course'];
$type = '';
if(isset($_REQUEST['exam_type'])){
$type = $_REQUEST['exam_type'];   
}     
// Select and tanang exam depende sa course nga ni login 
$selExam = $conn->query("SELECT * FROM exam_tbl WHERE type='$type' ORDER BY ex_id DESC ");
$selExamm = $conn->query("SELECT * FROM subject_quehead WHERE 1 ORDER BY id DESC ");

  
//Select 

 ?>