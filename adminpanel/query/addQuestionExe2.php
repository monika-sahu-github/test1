<?php 
include("../../conn.php");
extract($_POST);
$create_date = date('Y-m-d');
//$selQuest = $conn->query("SELECT * FROM exam_question_tbl WHERE exam_id='$examId' AND exam_question='$question' ");
// if($selQuest->rowCount() > 0) 
// {
//   $res = array("res" => "exist", "msg" => $question);
// }
// else
// {    
 //

    if($action=='add'){
 	$insQuest = $conn->query("INSERT INTO exam_question_tbl(exam_id,sub_subjecthead_id,exam_question,explanation,create_date) VALUES('$exam_id','$sub_subjecthead_id','$exam_question','$explanation','$create_date') ");
 	$last_q_id = $conn->lastInsertId();
    if($insQuest)
	{   $is_rightA=0;
		$is_rightB=0;
		$is_rightC=0;
		$is_rightD=0;
		$exam_answer = '';
		if($correctAnswer=="A"){ 
             $is_rightA=1;
             $exam_answer = $choice_A1;
		} else if($correctAnswer=="B"){
			$is_rightB=1;
			$exam_answer = $choice_B1;
		} else if($correctAnswer=="C"){
			$is_rightC=1;
			$exam_answer = $choice_C1;
		} else if($correctAnswer=="D"){
			$is_rightD=1;
			$exam_answer = $choice_D1;
		}

		 $graphic_A = $_FILES["graphic_A"]["name"]; 
    $tempname = $_FILES["graphic_A"]["tmp_name"];     
        $folder = "upload/".$graphic_A; 
    move_uploaded_file($tempname, $folder);
    
	$conn->query("INSERT INTO exam_answers_option(quehead_id,eqt_id,answer,is_right,create_date,atod) VALUES('$sub_subjecthead_id','$last_q_id','$choice_A1','$is_rightA','$create_date','A')");
	 $l1 = $conn->lastInsertId();
		 $conn->query("INSERT INTO exam_answers_option(quehead_id,eqt_id,answer,is_right,create_date,atod) VALUES('$sub_subjecthead_id','$last_q_id','$choice_B1','$is_rightB','$create_date','B')");
		 $l2 = $conn->lastInsertId();
		 $conn->query("INSERT INTO exam_answers_option(quehead_id,eqt_id,answer,is_right,create_date,atod) VALUES('$sub_subjecthead_id','$last_q_id','$choice_C1','$is_rightC','$create_date','C')");
		 $l3 = $conn->lastInsertId();
	 $conn->query("INSERT INTO exam_answers_option(quehead_id,eqt_id,answer,is_right,create_date,atod) VALUES('$sub_subjecthead_id','$last_q_id','$choice_D1','$is_rightD','$create_date','D')");
	 $l4 = $conn->lastInsertId();
	 $exam_answer_id = '';
	 if($correctAnswer=="A"){
            $exam_answer_id=$l1;  
		} else if($correctAnswer=="B"){
			 $exam_answer_id=$l2; 
		} else if($correctAnswer=="C"){
			 $exam_answer_id=$l3; 
		} else if($correctAnswer=="D"){
			$exam_answer_id=$l4;  
		}

	 $conn->query("update exam_question_tbl set exam_answer = '$exam_answer', exam_answer_id = '$exam_answer_id' WHERE eqt_id = '$last_q_id' ");
     $res = array("res" => "success");
	}
	else
	{ 
       $res = array("res" => "failed");
	}  
} else if($action=='update'){
	 $insQuest = $conn->query("INSERT INTO exam_question_tbl(exam_id,sub_subjecthead_id,exam_question,explanation,create_date) VALUES('$exam_id','$sub_subjecthead_id','$exam_question','$explanation','$create_date') ");
 	$last_q_id = $conn->lastInsertId();
    if($insQuest)
	{   $is_rightA=0;
		$is_rightB=0;
		$is_rightC=0;
		$is_rightD=0;
		$exam_answer = '';
		if($correctAnswer=="A"){ 
             $is_rightA=1;
             $exam_answer = $choice_A1;
		} else if($correctAnswer=="B"){
			$is_rightB=1;
			$exam_answer = $choice_B1;
		} else if($correctAnswer=="C"){
			$is_rightC=1;
			$exam_answer = $choice_C1;
		} else if($correctAnswer=="D"){
			$is_rightD=1;
			$exam_answer = $choice_D1;
		}
	$conn->query("INSERT INTO exam_answers_option(quehead_id,eqt_id,answer,is_right,create_date) VALUES('$sub_subjecthead_id','$last_q_id','$choice_A1','$is_rightA','$create_date')");
	 $l1 = $conn->lastInsertId();
		 $conn->query("INSERT INTO exam_answers_option(quehead_id,eqt_id,answer,is_right,create_date) VALUES('$sub_subjecthead_id','$last_q_id','$choice_B1','$is_rightB','$create_date')");
		 $l2 = $conn->lastInsertId();
		 $conn->query("INSERT INTO exam_answers_option(quehead_id,eqt_id,answer,is_right,create_date) VALUES('$sub_subjecthead_id','$last_q_id','$choice_C1','$is_rightC','$create_date')");
		 $l3 = $conn->lastInsertId();
	 $conn->query("INSERT INTO exam_answers_option(quehead_id,eqt_id,answer,is_right,create_date) VALUES('$sub_subjecthead_id','$last_q_id','$choice_D1','$is_rightD','$create_date')");
	 $l4 = $conn->lastInsertId();
	 $exam_answer_id = '';
	 if($correctAnswer=="A"){
            $exam_answer_id=$l1;  
		} else if($correctAnswer=="B"){
			 $exam_answer_id=$l2; 
		} else if($correctAnswer=="C"){
			 $exam_answer_id=$l3; 
		} else if($correctAnswer=="D"){
			$exam_answer_id=$l4;  
		}

	 $conn->query("update exam_question_tbl set exam_answer = '$exam_answer', exam_answer_id = '$exam_answer_id' WHERE eqt_id = '$last_q_id' ");
     $res = array("res" => $graphic_A);
	}
	else
	{
       $res = array("res" => $graphic_A);
	} 
}
echo json_encode($res);
 ?>