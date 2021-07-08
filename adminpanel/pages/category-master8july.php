<?php

$page_title = "CATEGORY MASTER";
$pagee = "category-master";
$table_name = "category_master";
$key = "id";
$create_date = date('Y-m-d');
$id = "";
$exam ="";
$exam_id = "";
$type = "";
$category_name = "";
$sub_topic_id = "";
$subject_id = "";

if(isset($_REQUEST["id"])){
  $id = $_REQUEST["id"];
  $selquery = $conn->query("select * from $table_name WHERE id = '$id' ");
  $row = $selquery->fetch(PDO::FETCH_ASSOC);
  $category_name = $row["category_name"];
  $exam = $row["exam_id"];
   
  $subject_id = $row["subject_id"];
 
}
if(isset($_POST["save"])){
  
  $subject = $_POST["subject"];
   $category_name = $_POST["category_name"];
  $id = $_POST["id"];
  if($id==""){
  $sql = $conn->query("select * from $table_name WHERE category_name = '$category_name' and topic_id='$subject'");
   $num = $sql->rowCount();
   if($num>0){
     echo "<script>
alert('Category Already Exist!');
window.location.href='home.php?page=$pagee';
</script>";
   }
    else {
  if($conn->query("INSERT INTO $table_name (topic_id, category_name, create_date) values('$subject', '$category_name', '$create_date') ")){

    echo "<script>
alert('Category Added!');
window.location.href='home.php?page=$pagee';
</script>";

  }
} } else {

    if($conn->query("UPDATE $table_name SET topic_id='$subject', category_name='$category_name', create_date='$create_date' WHERE id = '$id' ")){

    echo "<script>
alert('Category Updated!');
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
                    <div class="card-header">Add Category
                    </div>
                    <div class="table-responsive">
                        <form class="" id="" method="post" enctype="multipart/form-data" >
                              <input type="hidden" name="id" value="<?php echo $id; ?>">
     <div class="modal-content"> 
     
       
      <div class="modal-body">
        <div class="col-md-12">
         <fieldset>
         	<div class="form-group">
                <label class="col-sm-2 control-label"><b>Topic Name</b></label>
                <div  class="col-sm-4" >
                <select name="subject" required="" id="subject" class="form-control" >
                  <?php  $sql = $conn->query("SELECT * FROM subject_quehead WHERE status ='0' ORDER BY id DESC ");
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
                <label class="col-sm-2 control-label"><b>Category Name</b></label>
                <div  class="col-sm-4" >
                <input  type="text" required="" value="<?php echo $category_name; ?>" name="category_name" id="topic_name" class="form-control" >
                  
                  
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
                    <div class="card-header">Category List
                    </div>
                    <div class="table-responsive">
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
                                $selExam = $conn->query("SELECT * FROM $table_name WHERE status ='0' ORDER BY id DESC ");
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
                    </div>
                </div>
            </div>
      </div>
<script type="text/javascript">
   function delete_category(category_id){
    
if(confirm("Do you want to delete this question!")){

     $.ajax({ 
    
type: "POST",
url: "delete_category.php", 
data: 'category_id='+category_id,
success: function(data) {
 //alert(data);
 data = data.trim("");
 if(data=="success"){
  //alert("Deleted Successfully");
  Swal.fire({
  title: "Deleted Successfully!",
  text: "",
  icon: "success",
  button: "OK",
});
window.location.href = 'home.php?page=category-master';

 } else {
 Swal.fire(
        "Something's went wrong!",
         'Somethings went wrong',
        'error'
      )
 }

 
}});

}else {
  return false;
}

 }
</script>
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