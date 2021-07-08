 <?php
 include("../conn.php");
$topic_id = $_REQUEST["topic_id"];
//echo "SELECT * FROM sub_topic_master  WHERE  topic_id = '$topic_id' ORDER BY id DESC ";
$sql = $conn->query("SELECT * FROM sub_topic_master  WHERE  topic_id = '$topic_id' ORDER BY id DESC ");
 ?>
    <select name="sub_topic_id" class="form-control chosen-select" id="sub_topic_id" style="">
<option  value="">Select</option>
 <?php
while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
?>
    <option value="<?php echo $row["id"] ?>" ><?php echo $row["sub_topic_name"]; ?></option>
<?php } ?>
</select>
