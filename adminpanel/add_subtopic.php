<?php include '../conn.php'; 
include("../lib/getval.php");
  $cmn = new TestCommandRun();
	if($_POST['action']=="add"){
	    
	    
	$subtopic_name = $_POST['subtop_name'];
	$topic_id = $_POST['topic_id'];
	$mainsub_id = $_POST['mainsub_id'];
	$create_date = date('Y-m-d');

$sql = $conn->query("select * from sub_topic_master WHERE topic_id = '$topic_id' and sub_topic_name = '$subtopic_name'");
   $num = $sql->rowCount();
   if($num>0){
     echo "Subtopic Already Exists";
   }
    else {
	if($conn->query("INSERT INTO sub_topic_master (topic_id, sub_topic_name, create_date, subject_id) values('$topic_id', '$subtopic_name', '$create_date', '$mainsub_id')")){
		
		echo "Added Successfully";

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
                                <th class="text-left" > Sub Topic Name</th>
                                 <th class="text-left ">Topic Name</th>
                                 
                                <th class="text-center" width="30%">Action</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                              <?php 
                                $selExam = $conn->query("SELECT * FROM sub_topic_master WHERE status ='0' ORDER BY id DESC ");
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
                                            <td><?php echo $selExamRow["sub_topic_name"]; ?></td>
                                           <td><?php echo $subject_name;  ?></td>
                                          
                                            <td class="text-center">
                                             

                                              <a href="home.php?page=<?php echo "sub-topic-master"; ?>&id=<?php echo $selExamRow['id']; ?>" type="button" class="btn btn-primary">Edit</a>
                                             
                                            	<button class="btn btn-danger" onclick="delete_subtopic('<?php echo $selExamRow['id']; ?>');" style="color: white;" >Delete</button>
                                            </td>
                                        </tr>

                                    <?php }
                                }
                                else
                                { ?>
                                    <tr>
                                      <td colspan="5">
                                        <h3 class="p-3">No Topic Found</h3>
                                      </td>
                                    </tr>
                                <?php }
                               ?>
                            </tbody>
                        </table>

   	<?php
   			}
if($_POST['action']=="update"){
         
         	$subtopic_name = $_POST['subtopic_name'];
			$topic_id = $_POST['topic_id'];
			$mainsub_id = $_POST['mainsub_id'];
         	$id = $_POST['id'];
         	$create_date = date('Y-m-d');

	if($conn->query("UPDATE sub_topic_master set topic_id='$topic_id', sub_topic_name='$subtopic_name', create_date='$create_date', subject_id='$mainsub_id' where id='$id'")){
		
		echo "Successfully Updated";

	}
	else{
		echo "";
	}
         
     }
?>
