<?php
	include('../conn.php');
	include("../lib/getval.php");
  $cmn = new TestCommandRun();
	
	
	if($_POST['action']=="add"){
	    
	    
	$topic_name = $_POST['topic_name'];
	$mainsub_id = $_POST['mainsub_id'];
$sql = $conn->query("select * from subject_quehead WHERE main_subject_id = '$mainsub_id' and quehead = '$topic_name'");
   $num = $sql->rowCount();
   if($num>0){
     echo "Topic Already Exists";
   }
    else {
	if($conn->query("INSERT INTO subject_quehead (main_subject_id,exam_id, quehead) values('$mainsub_id ', '$mainsub_id ', '$topic_name')")){
		
		echo "Added Successfully";

	}
	else{
		echo "fail";
	}
}
   }
  
   
   if($_POST['action']=="list"){
	    
	    ?>
	    
	    <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="example">
                            <thead>
                            <tr>
                                <th>Sno</th>
                                 <th class="text-left ">Topic Name</th>
                               <th class="text-left ">Subject Name</th>
                               <!-- <th class="text-center" width="20%">Action</th> -->

                                <td class="text-center" width="30%"><b>Action</b></td>
                                
                            </tr>
                            </thead>
                            <tbody>
                              <?php 
                                $selExam = $conn->query("SELECT * FROM subject_quehead WHERE status ='0' ORDER BY id DESC ");
                                if($selExam->rowCount() > 0)
                                {   $i=1;
                                    while ($selExamRow = $selExam->fetch(PDO::FETCH_ASSOC)) {

                                        if($selExamRow['type']==0){
                                            $examtype = "Practice Test";
                                        } else {
                                            $examtype = "Mock Test";
                                        }
                                        $exam_name = $cmn->getvalfield($conn,"main_subject","ex_title","ex_id = $selExamRow[main_subject_id]");

                                     ?>
                                        <tr id="row<?php echo $selExamRow['id'];  ?>" >
                                            <td><?php echo $i++; ?></td>
                                           <td><?php echo $selExamRow['quehead'];  ?></td>
                                            <td>
                                                <?php echo $exam_name;
                                                ?>
                                            </td>
                                            <td class="text-center">
                                             
                                             <a href="home.php?page=sub-topic-master&sub_id=<?php echo $selExamRow['main_subject_id']; ?>&top_id=<?php echo $selExamRow['id']; ?>" class="btn btn-success">Add Subtopic</a>
                                               <a href="home.php?page=subject-master&id=<?php echo $selExamRow['id']; ?>" type="button" class="btn btn-primary">Edit</a> 
                                              
                                               <button class="btn btn-danger" onclick="delete_topic('<?php echo $selExamRow['id']; ?>');" style="color: white;" >Delete</button>
                                               
                                            </td>
                                        </tr>

                                    <?php }
                                }
                                else
                                { ?>
                                    <tr>
                                      <td colspan="5">
                                        <h3 class="p-3">No Subject Found</h3>
                                      </td>
                                    </tr>
                                <?php }
                               ?>
                            </tbody>
                        </table>
	    <?php

	
	
	
   }
   
     if($_POST['action']=="update"){
         
         $topic_name = $_POST['topic_name'];
         $mainsub_id = $_POST['mainsub_id'];
         $id = $_POST['id'];
	if($conn->query("UPDATE subject_quehead set main_subject_id='$mainsub_id',exam_id='$mainsub_id', quehead='$topic_name' where id='$id'")){
		
		echo "success";

	}
	else{
		echo "fail";
	}
         
     }
   
   
?>