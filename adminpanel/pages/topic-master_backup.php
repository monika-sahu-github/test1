<?php
$page_title = "TOPIC MASTER";
$table_name = "topic_master";
$key = "id";
$exam = "";
$type = "";
$subject = "";
$topic_name = "";
$create_date = date('Y-m-d');
$subject_id = "";
$id = "";
if(isset($_REQUEST["id"])){
  $id = $_REQUEST["id"];
  $selquery = $conn->query("select * from $table_name WHERE id = '$id' ");
  $row = $selquery->fetch(PDO::FETCH_ASSOC);
  $topic_name = $row["topic_name"];
  $exam = $row["exam_id"];
   
  $subject_id = $row["subject_id"];
 
}
if(isset($_POST["save"])){
  
  $subject = $_POST["subject"];
  $topic_name = $_POST["topic_name"];
  $id = $_POST["id"];
  if($id==""){
  $sql = $conn->query("select * from $table_name WHERE topic_name = '$topic_name' and subject_id = '$subject'");
   $num = $sql->rowCount();
   if($num>0){
     echo "<script>
alert('Topic Already Exist!');
window.location.href='home.php?page=topic-master';
</script>";
   }
    else {
  if($conn->query("INSERT INTO $table_name (subject_id, topic_name, create_date) values('$subject', '$topic_name', '$create_date') ")){

    echo "<script>
alert('Topic Added!');
window.location.href='home.php?page=topic-master';
</script>";

  }
} } else {

    if($conn->query("UPDATE $table_name SET subject_id='$subject', topic_name='$topic_name', create_date='$create_date' WHERE id = '$id' ")){

    echo "<script>
alert('Topic Updated!');
window.location.href='home.php?page=topic-master';
</script>";

  }

}

}

 ?>
<div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div><?php echo $page_title; ?></div>
                    </div>
                </div>
            </div>        

            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">Add Topic
                    </div>
                    <div class="table-responsive">
                        <form class="" id="" method="post" enctype="multipart/form-data" >
                              <input type="hidden" name="id" value="<?php echo $id; ?>">
     <div class="modal-content"> 
     
       
      <div class="modal-body">
        <div class="col-md-12">
         <fieldset>
           

              <div class="form-group">
                <label class="col-sm-2 control-label"><b>Subject Name</b></label>
                <div  class="col-sm-4" >
                <select name="subject" required="" id="subject" class="form-control" >
                  <?php  $sql = $conn->query("SELECT * FROM subject_quehead  WHERE 1 ORDER BY id DESC ");
 ?>
<option  value="">Select</option>
 <?php
while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
?>
    <option <?php if($subject_id==$row["id"]){ echo "selected"; } ?> value="<?php echo $row["id"] ?>" ><?php echo $row["quehead"]; ?></option>
<?php } ?>
                </select>
                  
                </div>
            </div>

             <div class="form-group">
                <label class="col-sm-2 control-label"><b>Topic Name</b></label>
                <div  class="col-sm-4" >
                <input  type="text" required="" value="<?php echo $topic_name; ?>" name="topic_name" id="topic_name" class="form-control" >
                  
                  
                </div>
            </div>
 

          </fieldset>
        </div>
      </div>
      <div class="modal-footer">
        
        <button type="submit" name="save" value="Save" class="btn btn-primary">Save</button>
      </div>
      
    </div>
   </form>
    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">Topic List
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="example">
                            <thead>
                            <tr>
                                <th class="text-left" >Sno</th>
                                <th class="text-left" >Topic Name</th>
                                 <th class="text-left ">Subject Name</th>
                               <th class="text-left ">Exam Name</th>
                               <th class="text-left" >Test Type</th>
                               
                                
                                <th class="text-center" width="20%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php 
                                $selExam = $conn->query("SELECT * FROM $table_name ORDER BY id DESC ");
                                if($selExam->rowCount() > 0)
                                {  $i=1;
                                    while ($selExamRow = $selExam->fetch(PDO::FETCH_ASSOC)) {

                                        if($selExamRow['type']==0){
                                            $examtype = "Practice Test";
                                        } else {
                                            $examtype = "Mock Test";
                                        }
                                        $exam_name = getvalfield($conn,"exam_tbl","ex_title","ex_id = $selExamRow[exam_id]");
                                        $subject_name = getvalfield($conn,"subject_quehead","quehead","id = $selExamRow[subject_id]");

                                     ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $selExamRow["topic_name"]; ?></td>
                                           <td><?php echo $subject_name;  ?></td>
                                            <td>
                                                <?php echo $exam_name;
                                                ?>
                                            </td>
                                            <td><?php echo $examtype; ?></td>
                                            
                                            <td class="text-center">
                                             <!-- <a href="manage-exam.php?id=<?php echo $selExamRow['id']; ?>" type="button" class="btn btn-primary btn-sm">Manage</a> -->
                                              <a href="home.php?page=topic-master&id=<?php echo $selExamRow['id']; ?>" type="button" class="btn btn-primary btn-sm">Edit</a>
                                             <!-- <button type="button" id="deleteExam" data-id='<?php echo $selExamRow['id']; ?>'  class="btn btn-danger btn-sm">Delete</button> -->
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
                    </div>
                </div>
            </div>
      </div>

<script type="text/javascript">
  function get_subject(id,type,subject_id){
   if(id==undefined && type==undefined){
  exam = $("#exam").val();
  type = $("#type").val();
  subject_id = "";
} else {
  exam = id;
  type = type;
}
//alert("ok");
   if(exam!="" && type!=""){
     $.ajax({ 
type: "POST",
url: "get_subject.php", 
data: "exam="+exam+'&type='+type+'&subject_id='+subject_id,
success: function(data) {
  //alert(data);
 $("#subject").html(data);

}});}
}
</script>
<?php if(isset($_REQUEST["id"])){ ?>
<script type="text/javascript">
  get_subject('<?php  echo $exam; ?>','<?php echo $type; ?>','<?php echo $subject_id; ?>');
</script>
<?php } ?>      
         
