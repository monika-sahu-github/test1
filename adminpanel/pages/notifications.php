<?php
$tablename = "notifications";
 $id1 = "";
 $not_title = "";
 $t_link = "";
 $descri_ption = "";

if(isset($_REQUEST["id"])){
  $id1 = $_REQUEST["id"];
  echo "<h2><cenetr>",$id1,"</cenetr></h2>";
  $selquery = $conn->query("select * from $tablename WHERE id = '$id1' ");
  $row = $selquery->fetch(PDO::FETCH_ASSOC);
  $not_title = $row["title"];
  $t_link = $row["target_link"];
  $descri_ption = $row["description"];
}
if(isset($_POST["save"])){
  $not_title = $_POST["title_name"];
  $t_link = $_POST["link"];
  $descri_ption = $_POST["description"];
  $id1 = $_POST["id"];

   if($id1==""){
  $sql = $conn->query("select * from $tablename WHERE id = '$id1' and title = '$not_title'");
   $num = $sql->rowCount();
   if($num>0){
     echo "<script>
alert('Notification Already Exist!');
window.location.href='home.php?page=notifications';
</script>";
   }
    else {
  if($insQuest = $conn->query("INSERT INTO notifications(title,target_link,description) VALUES('$not_title','$t_link','$descri_ption') ")){

    echo "<script>
alert('Notification Added!');
window.location.href='home.php?page=notifications';
</script>";

  }}}
  else {
   if($conn->query("UPDATE notifications SET id='$id1', title='$not_title' WHERE id = '$id1'")){

    echo "<script>
alert('Notification Updated!');
window.location.href='home.php?page=notifications';
</script>";

  }
}
 }?>

<div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div>Notifications</div>
                    </div>
                </div>
            </div>        

            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">Add Notification
                    </div>
                    <div class="table-responsive">
   <form class="" id="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $id1; ?>">
     <div class="modal-content">
      <div class="">
        <div class="col-md-4">
          <div class="form-group">
            <label>Title</label>
            
            <input type="text" name="title_name" value="<?php echo $not_title; ?>" id="title" class="form-control" required="" >
          
          </div>
        </div>
      </div>
      <div class="">
        <div class="col-md-4">
          <div class="form-group">
            <label>Target Link</label>
            <input type="text" name="link"  value="<?php echo $t_link; ?>" id="tlink" class="form-control" required="" >
          </div>
        </div>
      </div>
      <div class="">
        <div class="col-md-4">
          <div class="form-group">
            <label>Description</label>
            <input type="text" name="description"  value="<?php echo $descri_ption; ?>" id="desc" class="form-control" required="">
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
                    <div class="card-header">Notification List
                    </div>
                    <div class="table-responsive">
      <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="example" >
                            <thead>
                            <tr>
                                <th class="text-left pl-4">Title</th>
                                <th>Target Link</th>
                                <th>Description</th>
                                
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
                              <?php 
                                $selCourse = $conn->query("SELECT * FROM notifications WHERE 1 ORDER BY id DESC ");
                                if($selCourse->rowCount() > 0)
                                { 
                                    while ($row = $selCourse->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <tr>
                                            <td class="pl-4">
                                                <?php echo $row['title']; ?>
                                              </td>
                                              <td><?php echo $row['target_link']; ?></td>
                                              <td><?php echo $row['description']; ?></td>
                                               <td class="text-center">
                                          
                                              <a href="home.php?page=notifications&id=<?php echo $row['id']; ?>" type="button" class="btn btn-primary btn-sm">Edit</a>
                                             
                                            </td>
                                        </tr>
                                      <?php } }else
                                { ?>
                                    <tr>
                                      <td colspan="5">
                                        <h3 class="p-3">No Notification Found</h3>
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