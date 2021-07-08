<?php
$page_title = "SUB TOPIC MASTER";
$pagee = "sub-topic-master";
$table_name = "sub_topic_master";
$key = "id";
$create_date = date('Y-m-d');
$id = "";

$exam_id = "";
$type = "";
$topic_id = "";
$sub_topic_name = "";
if (isset($_REQUEST["id"])) {
  $id = $_REQUEST["id"];
  $sql = $conn->query("select * from $table_name WHERE id = '$id'");
   //$num = $sql->rowCount();
  $rows = $sql->fetch(PDO::FETCH_ASSOC);
  $topic_id = $rows["topic_id"];
  $sub_topic_name = $rows["sub_topic_name"];
}
if(isset($_REQUEST["save"])){
  
  
  $topic_id = $_REQUEST["topic_id"];
  $sub_topic_name = $_REQUEST["sub_topic_name"];
  //ECHO "select * from $table_name WHERE exam_id = '$exam_id' and type = '$type' and subject_id = '$subject' and topic_id = '$topic_id' and sub_topic_name = '$sub_topic_name'";die;
  $id = $_REQUEST["id"];
  if($id==""){
  $sql = $conn->query("select * from $table_name WHERE topic_id = '$topic_id' and sub_topic_name = '$sub_topic_name'");
   $num = $sql->rowCount();
   if($num>0){
     echo "<script>
alert('Sub Topic Already Exist!');
window.location.href='home.php?page=$pagee';
</script>";
   }
    else {
      ///echo "INSERT INTO $table_name (sub_topic_name,exam_id, type, subject_id, topic_id, create_date) values('$sub_topic_name','$exam_id','$type', '$subject', '$topic_id', '$create_date') ";die;
  if($insQuest = $conn->query("INSERT INTO $table_name (sub_topic_name, topic_id, create_date) values('$sub_topic_name', '$topic_id', '$create_date') ")){

    echo "<script>
alert('Sub Topic Added!');
window.location.href='home.php?page=$pagee';
</script>";

  }
}
}else {
   if($insQuest = $conn->query("UPDATE $table_name SET sub_topic_name='$sub_topic_name', topic_id='$topic_id', create_date='$create_date' WHERE id = '$id'")){

    echo "<script>
alert('Sub Topic Updated!');
window.location.href='home.php?page=$pagee';
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
                    <div class="card-header">Add Sub Topic
                    </div>
                    <div class="table-responsive">
                        <form class="" id="" method="post" enctype="multipart/form-data" >
                              <input type="hidden" name="id" value="<?php echo $id; ?>">
     <div class="modal-content"> 
     
       
      <div class="modal-body">
        <div class="col-md-12">
         <fieldset>
         
             <div class="form-group">
                <label class="col-sm-2 control-label"><b>Select Topic</b></label>
                <div  class="col-sm-4" >
                <select name="topic_id" id="topic_id" required="" class="form-control" >
                 <?php  $sql = $conn->query("SELECT * FROM topic_master  WHERE 1 ORDER BY id DESC ");
 ?>
<option  value="">Select</option>
 <?php
while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
    $subject = getvalfield($conn,"subject_quehead","quehead","id = $row[subject_id]");
?>
    <option <?php if($topic_id==$row["id"]){ echo "selected";  } ?> value="<?php echo $row["id"] ?>" ><?php echo $row["topic_name"]."(".$subject.")"; ?></option>
<?php } ?>
                  </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label"><b>Sub Topic Name</b></label>
                <div  class="col-sm-4" >
                <input type="text" name="sub_topic_name" value="<?php echo $sub_topic_name; ?>" id="sub_topic_name" required="" class="form-control" >
                  
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
                    <div class="card-header">Sub Topic List
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="example">
                            <thead>
                            <tr> 
                                <th class="text-left" >Sno</th>
                                <th class="text-left">Sub Topic Name</th>
                                <th class="text-left" >Topic Name</th>
                               <th class="text-center" width="20%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php 
                                $selExam = $conn->query("SELECT * FROM $table_name ORDER BY id DESC ");
                                if($selExam->rowCount() > 0)
                                {  $i=1;
                                    while ($selExamRow = $selExam->fetch(PDO::FETCH_ASSOC)) {
                                        $subject_id = getvalfield($conn,"topic_master","subject_id","id = $selExamRow[topic_id]");
                                        $subject = getvalfield($conn,"subject_quehead","quehead","id = $subject_id");

                                        if($selExamRow['type']==0){
                                            $examtype = "Practice Test";
                                        } else {
                                            $examtype = "Mock Test";
                                        }
                                        $exam_name = getvalfield($conn,"exam_tbl","ex_title","ex_id = $selExamRow[exam_id]");
                                        $subject_name = getvalfield($conn,"subject_quehead","quehead","id = $selExamRow[subject_id]");
                                        $topic_name = getvalfield($conn,"topic_master","topic_name","id = $selExamRow[topic_id]");

                                     ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                          <td><?php echo $selExamRow["sub_topic_name"];  ?></td>
                                            <td><?php echo $topic_name."(".$subject.")"; ?></td>
                                           
                                            
                                            <td class="text-center">
                                             <!-- <a href="manage-exam.php?id=<?php echo $selExamRow['id']; ?>" type="button" class="btn btn-primary btn-sm">Manage</a> -->
                                              <a href="home.php?page=<?php echo $pagee; ?>&id=<?php echo $selExamRow['id']; ?>" type="button" class="btn btn-primary btn-sm">Edit</a>
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
  function get_topic(){
      exam = $("#exam").val();
  type = $("#type").val();
  subject = $("#subject").val();
   if(exam!="" && type!="" && subject!=""){
     $.ajax({ 
   
type: "POST",
url: "get_topic.php", 
data: "exam="+exam+'&type='+type+'&subject='+subject,
success: function(data) {
// alert(data);
$("#topic_id").html(data);

}});}
  }
  function get_subject(exam_id,type){
    
   if(exam_id==undefined && type==undefined){
  exam = $("#exam").val();
  type = $("#type").val();
  } else {
    exam = exam_id;
    type = type;
  } 
   if(exam!="" && type!=""){
     
$.ajax({ 
type: "POST",
url: "get_subject.php", 
data: "exam="+exam+'&type='+type,
success: function(data) {
  
$("#subject").html(data);
}});

}

}
</script>      
         
<?php 
if(isset($_REQUEST["id"])){
  ?>
<script type="text/javascript">
  get_subject('<?php echo $exam_id; ?>','<?php echo $type; ?>');
// get_subject();
</script>
<?php }
 ?>