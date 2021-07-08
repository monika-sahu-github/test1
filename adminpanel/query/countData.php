<?php 
$selExam = $conn->query("SELECT COUNT(ex_id) as totExam FROM exam_tbl ")->fetch(PDO::FETCH_ASSOC);
$selCourse = $conn->query("SELECT COUNT(ex_id) as totCourse FROM exam_tbl ")->fetch(PDO::FETCH_ASSOC);
?>