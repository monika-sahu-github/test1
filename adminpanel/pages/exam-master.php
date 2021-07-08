<?php
$exam_name = "";
$exam_mock_logo="";
$exam_datetime = "";
$questions="";
$id="";
$msg="";
if(isset($_REQUEST["id"])){
  $id = $_REQUEST["id"];
  $selquery = $conn->query("select * from main_subject WHERE ex_id = '$id' ");
  $row = $selquery->fetch(PDO::FETCH_ASSOC);
  $exam_name = $row["ex_title"];
  $exam_mock_logo = $row["exam_logo"];
  // $exam_datetime = $row["exam_datetime"];
  // $questions = $row["questions"];

}
if(isset($_POST["save"])){
  $ex_title = $_POST["exam_name"];
  $exam_mock_logo = $_POST["exam_mock_logo"];
  // $exam_datetime = $_POST["exam_datetime"];
  // $questions = $_POST["questions"];
  //echo "INSERT INTO subject_quehead (exam_id, type, quehead) values('$exam_id','$type', '$subject') ";die;
  $id = $_POST["id"];
  if($id==""){
  $sql = $conn->query("select * from main_subject WHERE ex_title = '$ex_title'");
   $num = $sql->rowCount();
   if($num>0){
     echo "<script>
alert('Subject Already Exist!');
window.location.href='home.php?page=exam-master';
</script>";
   }
    else {
  if($insQuest = $conn->query("INSERT INTO main_subject(ex_title,type,exam_logo) VALUES('$ex_title','1','$exam_mock_logo') ")){

    echo "<script>
alert('Subject Added!');
window.location.href='home.php?page=exam-master';
</script>";
 
  }
} } else {
  //echo "UPDATE main_subject set ex_title = '$ex_title',type='0',exam_logo='$exam_mock_logo' WHERE ex_id='$id'";die;
  if($insQuest = $conn->query("UPDATE main_subject set ex_title = '$ex_title',type='0',exam_logo='$exam_mock_logo' WHERE ex_id='$id'")){

    echo "<script>
alert('Subject Updated!');
window.location.href='home.php?page=exam-master';
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
                        <div>Subject Master</div>
                    </div>
                </div>
            </div>        

            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">Add Subject
                    </div>
                    <div class="table-responsive">
   <form class="refreshFrm" id="" action="" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
     <div class="modal-content">
      <div class="">
        <div class="col-md-4">
          <div class="form-group">
            <label><b>Subject Name</b></label>
            <input type="text" name="exam_name" value="<?php echo $exam_name; ?>" class="form-control" placeholder="Enter Subject Name" required="" autocomplete="off">
            <!-- id="exam_name"  -->
          </div>
        </div>
      </div>
      <div class="">
        <div class="col-md-4">
          <div class="form-group">
            <label><b>Subject Caption</b></label>
            <input type="text" name="exam_mock_logo"  value="<?php echo $exam_mock_logo;  ?>" class="form-control" placeholder="Enter Subject Caption" required="" autocomplete="off">
            <!-- id="exam_mock_logo" -->
          </div>
        </div>
      </div>
       
      <div class="modal-footer">

        <input type="submit" name="save" value="Save" class="btn btn-primary">
      </div>
    </div>
        
   </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">Subject List
                    </div>
                    <div class="table-responsive">
      <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="example" >
                            <thead>
                            <tr>
                                <th>Sno</th>
                                <th class="text-left pl-4">Subject Name</th>
                                <th>Caption</th>
                                
                                <td class="text-center"><b>Update</b></td>
                                <td class="text-center"><b>Delete</b></td>
                            </tr>
                            </thead>
                            <tbody>
                              <?php 
                                $select_main = $conn->query("SELECT * FROM main_subject WHERE status ='0' ORDER BY ex_id DESC ");
                                if($select_main->rowCount() > 0)
                                {   $i=1;
                                    while ($rowm = $select_main->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <tr>
                                          <td> <?php echo $i++; ?></td>
                                            <td class="pl-4">
                                                <?php echo $rowm['ex_title']; ?>
                                            </td>
                                            
                                             <td><?php echo $rowm["exam_logo"]; ?></td>
                                            <td class="text-center">
                                                <a class="btn btn-primary btn-sm" href="home.php?page=exam-master&id=<?php echo $rowm["ex_id"]; ?>">Update</a>
                                                 
                                            </td>
                                            <td class="text-center">
                                              <button class="btn btn-danger btn-sm" onclick="delete_subject('<?php echo $rowm["ex_id"]; ?>');" style="color: white;" >Delete</button>
                                            </td>
                                        </tr>

                                    <?php }
                                }
                                else
                                { ?>
                                    <tr>
                                      <td colspan="2">
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
 function delete_subject(subject_id){

if(confirm("Do you want to delete this question!")){

     $.ajax({ 
   
type: "POST",
url: "delete_subject.php", 
data: 'subject_id='+subject_id,
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
window.location.href ='home.php?page=exam-master';

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