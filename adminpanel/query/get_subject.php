<?php 
session_start();
include("../../conn.php");
$id = $_POST['id'];
$selSub = $conn->query("SELECT * FROM exam_tbl WHERE type='$id'");
if($selSub->rowCount() > 0)
{  
while ($selSubRow = $selSub->fetch(PDO::FETCH_ASSOC)) 
{ ?>
<option value="<?php echo $selSubRow['ex_id'];  ?>"><?php echo $selSubRow['ex_title'];  ?></option>
<?php } } ?>