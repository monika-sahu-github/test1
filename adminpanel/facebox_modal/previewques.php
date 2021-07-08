<?php echo "<h3>Question Preview</h3>"; 
 include("../../conn.php");

   include("../../lib/getval.php");
  $cmn = new TestCommandRun();
	$eqt_id = $_GET["id"];
?>
<div class="" style="background: white;border: 3px solid #375176;padding: 0px;">
<div class="col-md-12 col-xl-12" style="padding-top: 15px;padding-bottom: 20px;">
	<div class="col-md-2"></div>
	<div class="col-md-10">
	<?php 
	$question = $cmn->getvalfield($conn,"exam_question_tbl","exam_question","eqt_id = '$eqt_id'");
	echo $question;

	 $optionsRow = $conn->query("SELECT answer FROM exam_answers_option WHERE eqt_id = '$eqt_id' ");
	 $i='a';
    while ($row = $optionsRow->fetch(PDO::FETCH_ASSOC)) { 
    	$values = $row['answer'];  	?>
    	<input type="radio" name="ans" style="padding-right: 20px;">&nbsp;(<?php echo $i; ?>)
    	<?php echo $values,"<br>"; echo "<br>";  ?>
  	<?php
  		$i++; }
	?>
			</div>
	</div>
</div>