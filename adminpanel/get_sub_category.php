 <?php
 include("../conn.php");
 
$topic_id = $_REQUEST["topic_id"];

 $sql = $conn->query("SELECT * FROM sub_category_master  WHERE topic_id = '$topic_id' ORDER BY id DESC ");
 ?>
<option  value="">Select</option>
 <?php
while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
?>
    <option value="<?php echo $row["id"] ?>" ><?php echo $row["sub_category_name"]; ?></option>
<?php } ?>
