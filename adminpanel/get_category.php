 <?php
 include("../conn.php");
 //session_start();
     
 
$topic_id = $_REQUEST["topic_id"];

 $sql = $conn->query("SELECT * FROM category_master  WHERE topic_id = '$topic_id' ORDER BY id DESC ");
 ?>
<option  value="">Select</option>
 <?php
while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
?>
    <option value="<?php echo $row["id"] ?>" ><?php echo $row["category_name"]; ?></option>
<?php } ?>
