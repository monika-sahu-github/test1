 <?php
 include("../conn.php");
 session_start();
     function getvalfield($conn,$table,$field,$where)
    { //echo "SELECT $field FROM $table WHERE $where";
        $stmt = $conn->prepare("SELECT $field FROM $table WHERE $where"); 
        $stmt->execute(); 
        $row = $stmt->fetch(); 
        return $row[0];
    }   
$exam = $_REQUEST["exam"]; 
$type = $_REQUEST["type"];
$subject_id = "";
if(isset($_REQUEST["subject_id"])){
	$subject_id = $_REQUEST["subject_id"];
} 
//echo "SELECT * FROM subject_quehead  WHERE exam_id = '$exam' and type = '$type' ORDER BY id DESC ";
 $sql = $conn->query("SELECT * FROM subject_quehead  WHERE exam_id = '$exam' and type = '$type' ORDER BY id DESC ");
 ?>
<option  value="">Select</option>
 <?php
while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
?>
    <option <?php if($subject_id==$row["id"]){ echo "selected"; } ?> value="<?php echo $row["id"] ?>" ><?php echo $row["quehead"]; ?></option>
<?php } ?>
