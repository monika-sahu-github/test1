<?php
$mainsub_id = "";
$type="";
$topic_name = "";
$msg ="";
$id="";
$create_date = date('Y-m-d');

if(isset($_REQUEST["id"])){
  $id = $_REQUEST["id"];
  $selquery = $conn->query("select * from subject_quehead WHERE id = '$id' and status='0' ");
  $row = $selquery->fetch(PDO::FETCH_ASSOC);
  $topic_name = $row["quehead"];
  $mainsub_id  = $row["main_subject_id"];

   
}
// if(isset($_POST["save"])){
  
//   $mainsub_id  = $_POST["exam"];
//   $subject = $_POST["subject"];
  
//   $id = $_POST["id"];
//   if($id==""){
//   $sql = $conn->query("select * from subject_quehead WHERE exam_id = '$mainsub_id ' and quehead = '$subject' and status='0'");
//    $num = $sql->rowCount();
//    if($num>0){
//      echo "<script>
// alert('Topic Already Exist!');
// window.location.href='home.php?page=subject-master';
// </script>";
//    }
//     else {
//   if($conn->query("INSERT INTO subject_quehead (main_subject_id,exam_id, quehead) values('$mainsub_id ', '$mainsub_id ', '$subject') ")){

    

//     echo "<script>
// alert('Topic Added!');
// window.location.href='home.php?page=subject-master';
// </script>";

//   }
// } } else {
//    if($conn->query("UPDATE subject_quehead SET exam_id='$mainsub_id ', quehead='$subject' WHERE id = '$id'")){


//     echo "<script>
// alert('Topic Updated!');
// window.location.href='home.php?page=subject-master';
// </script>";

//   }
// }

// }

 ?>
<div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div>Topic Master</div>
                    </div>
                </div>
            </div>        

            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">Add Topic
                    </div>
                    <div class="table-responsive">
                        <!-- <form class="" id="" method="post" enctype="multipart/form-data" > -->
                          <input type="hidden" name="id" value="<?php echo $id; ?>">    
     <div class="modal-content"> 
     
       
      <div class="modal-body">
        <div class="col-md-12">
         <fieldset>
           
            <div class="form-group">
                <label class="col-sm-2 control-label"><b>Select Subject </b></label>
                <div  class="col-sm-4" >
                <select name="exam" id="subject" class="form-control" placeholder="" autocomplete="off">
                    <option value="">Select Subject</option>
                    <?php  $query = $conn->query("SELECT * FROM main_subject ORDER BY ex_id DESC"); 
                    while($row = $query->fetch(PDO::FETCH_ASSOC)){
                     ?>
                    <option <?php if($mainsub_id==$row["ex_id"]){ echo "selected"; } ?> value="<?php echo $row["ex_id"]; ?>" ><?php echo $row["ex_title"]; ?></option>
                    <?php }
                      ?>
                </select> 
                </div>
            </div>

              <div class="form-group">
                <label class="col-sm-2 control-label"><b>Topic Name</b></label>
                <div  class="col-sm-4" >
                <input type="text" name="subject" id="topic" value="<?php echo $topic_name; ?>" class="form-control" placeholder="Enter Topic Name" autocomplete="off">
                  
                </div>
            </div>
 

          </fieldset>
        </div>
      </div>
      <div class="modal-footer">
        
        <button name="save" value="Save" class="btn btn-primary" onclick="add_subject()">Save</button>
      </div>
      </div>
      
   <!-- </form> -->

                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">List of Topics
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="example">
                            <thead>
                            <tr>
                                <th>Sno</th>
                                 <th class="text-left ">Topic Name</th>
                               <th class="text-left ">Subject Name</th>
                               <!-- <th class="text-center" width="20%">Action</th> -->

                                <td class="text-center"><b>Update</b></td>
                                <td><b>Delete</b></td>
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
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                           <td><?php echo $selExamRow['quehead'];  ?></td>
                                            <td>
                                                <?php echo $exam_name;
                                                ?>
                                            </td>
                                            <td class="text-center">
                                             
                                              <!-- <a href="home.php?page=subject-master&id=<?php echo $selExamRow['id']; ?>" type="button" class="btn btn-primary">Edit</a> -->
                                              <button class="btn btn-primary" onclick="update('<?php echo $selExamRow['id']; ?>')" style="color: white;">Edit</button>
                                             
                                            </td>
                                            <td>
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
                    </div>
                </div>
            </div>
      
        
</div>
<script type="text/javascript">
  function add_subject(){
    mainsub_id = document.getElementById('subject').value;
    topic_name = document.getElementById('topic').value;

    $.ajax({
      type: "POST",
      url: "add_subject.php",
      data: 'topic_name='+topic_name+'&mainsub_id='+mainsub_id,
      success: function(data){
        if(data=="success"){
          alert('Added Successfully');
          document.getElementById('topic').value = '';
        }else{
          alert('Failed!'+topic_name+mainsub_id);
        }
      }
    });

  }
</script>
<script type="text/javascript">
  function update(topic_id){
    $.ajax({
      type: "POST",
      url: "add_subject.php",
      data:'id='+topic_id,
      success: function(data){
        if(data=="success"){
          alert('Added Successfully!');
        }else{
          alert('Failed!'+topic_id);
        }
      }
    })

  }
</script>

<script type="text/javascript">
   function delete_topic(topic_id){

if(confirm("Do you want to delete this question!")){

     $.ajax({ 
    
type: "POST",
url: "delete_topic.php", 
data: 'topic_id='+topic_id,
success: function(data) {
 data = data.trim("");
 if(data=="success"){
  Swal.fire({
  title: "Deleted Successfully!",
  text: "",
  icon: "success",
  button: "OK",
});
window.location.href = 'home.php?page=subject-master';

 } else {
 Swal.fire(
        "Something went wrong!",
         'Something went wrong',
        'error'
      )
 }

 
}});

}else {
  return false;
}

 }
</script>
         
