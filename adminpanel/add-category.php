<?php
	include '../conn.php'; 
include("../lib/getval.php");
  $cmn = new TestCommandRun();
	if($_POST['action']=="add"){
		$category_name = $_POST['category_name'];
	$topic_id = $_POST['topic_id'];
	$mainsub_id = $_POST['mainsub_id'];
	$create_date = date('Y-m-d');

$sql = $conn->query("select * from category_master WHERE topic_id = '$topic_id' and category_name = '$category_name'");
   $num = $sql->rowCount();
   if($num>0){
     echo "Subtopic Already Exists";
   }
    else {
	if($conn->query("INSERT INTO category_master (topic_id, category_name, create_date, subject_id) values('$topic_id', '$category_name', '$create_date', '$mainsub_id')")){
		
		echo "Added Succefully";

	}
	else{
		echo "";
	}
}
   }
   if($_POST['action']=="list"){

?>
<table class="align-middle mb-0 table table-borderless table-striped table-hover" id="example">
                            <thead>
                            <tr>
                                <th class="text-left" >Sno</th>
                                <th class="text-left" >Category Name</th>
                                 <th class="text-left ">Topic Name</th>
                                 
                                <th class="text-center" width="20%">Action</th>
                                <th class="text">Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php 
                                $selExam = $conn->query("SELECT * FROM category_master WHERE status ='0' ORDER BY id DESC ");
                                if($selExam->rowCount() > 0)
                                {  $i=1;
                                    while ($selExamRow = $selExam->fetch(PDO::FETCH_ASSOC)) {

                                        if($selExamRow['type']==0){
                                            $examtype = "Practice Test";
                                        } else {
                                            $examtype = "Mock Test";
                                        }
                                        
                                        
                                         $subject_name = $cmn->getvalfield($conn,"subject_quehead","quehead","id = $selExamRow[topic_id]");

                                     ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $selExamRow["category_name"]; ?></td>
                                           <td><?php echo $subject_name;  ?></td>
                                          
                                            <td class="text-center">
                                             
                                              <a href="home.php?page=<?php echo $pagee; ?>&id=<?php echo $selExamRow['id']; ?>" type="button" class="btn btn-primary btn-sm">Edit</a>
                                             
                                            </td>
                                            <td>
                                              <button class="btn btn-danger" onclick="delete_category('<?php echo $selExamRow['id']; ?>');" style="color: white;" >Delete</button>
                                            </td>
                                        </tr>

                                    <?php }
                                }
                                else
                                { ?>
                                    <tr>
                                      <td colspan="5">
                                        <h3 class="p-3">No Result Found</h3>
                                      </td>
                                    </tr>
                                <?php }
                               ?>
                            </tbody>
                        </table>
<?php } 
	if($_POST['action']=="update"){
         
         	$category_name = $_POST['category_name'];
			$topic_id = $_POST['topic_id'];
			$mainsub_id = $_POST['mainsub_id'];
         	$id = $_POST['id'];
         	$create_date = date('Y-m-d');

	if($conn->query("UPDATE category_master set topic_id='$topic_id', category_name='$category_name', create_date='$create_date', subject_id='$mainsub_id' where id='$id'")){
		
		echo "Successfully Updated";

	}
	else{
		echo "";
	}
         
     }
?>