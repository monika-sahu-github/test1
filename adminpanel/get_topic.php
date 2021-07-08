 <?php
 include("../conn.php");
 //session_start();
      

$subject = $_POST["subject_id"];
//echo "SELECT * FROM topic_master  WHERE exam_id = '$exam' and type = '$type' and subject_id = '$subject' ORDER BY id DESC ";

 $sql = $conn->query("SELECT * FROM subject_quehead  WHERE  main_subject_id = '$subject' ORDER BY id DESC ");
 ?> <select name="subject" required="" id="subject" class="form-control" >
<option  value="">Select</option>
 <?php
while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
?>
    <option value="<?php echo $row["id"] ?>" ><?php echo $row["quehead"]; ?></option>

<?php } ?></select>
