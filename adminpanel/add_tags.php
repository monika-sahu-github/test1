<?php
	$tablename = 'add_tags';
	$tag_title = "";
	if(isset($_REQUEST["id"])){
  $id1 = $_REQUEST["id"];
  echo "<h2><cenetr>",$id1,"</cenetr></h2>";
  $selquery = $conn->query("select * from $tablename WHERE id = '$id1' ");
  $row = $selquery->fetch(PDO::FETCH_ASSOC);
  $tag_title = $row["tag_name"];
 $create_date = $row["create_date"];
}
if(isset($_POST["save"])){
  $tag_title = $_POST["tagname"];
  $id1 = $_POST["id"];

   if($id1==""){
  $sql = $conn->query("select * from $tablename WHERE id = '$id1' and tag_name = '$tag_title'");
   $num = $sql->rowCount();
   if($num>0){
     echo "<script>
alert('Tag Name Already Exist!');
window.location.href='home.php?page=add_tags';
</script>";
   }
    else {
  if($insQuest = $conn->query("INSERT INTO add_tags(tag_name) VALUES('$tag_title') ")){

    echo "<script>
alert('New Tag Added!');
window.location.href='home.php?page=add_tags';
</script>";

  }}}
  else {
   if($conn->query("UPDATE add_tags SET id='$id1', tag_name='$tag_title' WHERE id = '$id1'")){

    echo "<script>
alert('Tag Name Updated!');
window.location.href='home.php?page=add_tags';
</script>";

  }
}
 }
?>
 <style type="text/css">
 	@media only screen and (max-width: 600px) {
  #resetdiv{
  	margin-top: 10px;
  }
}
#output {
  padding: 0px;
   
}
.chosen-container-multi{
	width: 100% !important;
}
.search-choice-close{
	color: black !important;
}
 </style>
 <link rel="stylesheet" href="css/chosen.css">
<div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div>ADD TAGS</div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">Add Tags</div>
                     <div class="table-responsive">
   <form class="" id="" method="post" enctype="multipart/form-data">
   	    <div class="">
        <div class="col-md-4">
          <div class="form-group">
            <label>Tag Name</label>
            
            <input type="text" name="tagname" value="<?php echo $tag_title; ?>" id="tag" class="form-control" required="" >
          
          </div>
        </div>
      </div>
      <!-- 	<select multiple data-placeholder="Add tools"> -->
      	<select data-placeholder="Select Tag" id="tag" name="tag[]" multiple class="chosen-select">
    <option>Sketch</option>
    <option selected>Framer X</option>
    <option>Photoshop</option>
    <option>Principle</option>
    <option>Invision</option>
</select>

<!-- dribbble -->
 
            <!-- <label  class="form-label select-label">Multiple Select</label> -->
             <?php 
                                //$selCourse = $conn->query("SELECT * FROM add_tags WHERE 1 ORDER BY id DESC ");
                                //if($selCourse->rowCount() > 0)
                                //{  ?>
            <!-- <select class="select" multiple> -->
  				<!-- <option value=""> -->
  				<?php 
  				//while ($row = $selCourse->fetch(PDO::FETCH_ASSOC)) {
  					//echo $row['tag_name']; ?>
  					<!-- </option> --><?php //} }?>
  			<!-- </select> -->
          
      

       <div class="modal-footer">
        <input type="submit" name="save" value="Save" class="btn btn-primary">
      </div>
   </form></div>
                </div>
            </div>
           <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">Tag List
                    </div>
                    <div class="table-responsive">
      <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="example" >
                            <thead>
                            <tr>
                                <th class="text-left pl-4">Tag Name</th>
                                <th class="text-left pl-4">Create Date</th>
                                
                                
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
                              <?php 
                                $selCourse = $conn->query("SELECT * FROM add_tags WHERE status='0' ORDER BY id DESC ");
                                if($selCourse->rowCount() > 0)
                                { 
                                    while ($row = $selCourse->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <tr>
                                            <td class="pl-4">
                                                <?php echo $row['tag_name']; ?>
                                              </td>
                                              <td><?php echo $row['create_date']; ?></td>
                                              
                                               <td class="text-center">
                                          
                                              <a href="home.php?page=add_tags&id=<?php echo $row['id']; ?>" type="button" class="btn btn-primary btn-sm">Edit</a>
                                             
                                            </td>
                                        </tr>
                                      <?php } }else
                                { ?>
                                    <tr>
                                      <td colspan="5">
                                        <h3 class="p-3">No Tags Found</h3>
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
<script type="text/javascript" src="multiselect/jquery-ui.min.js"></script>
<script type="text/javascript" src="multiselect/jquery.multiselect.js"></script>
<script type="text/javascript" src="multiselect/jquery.multiselect.filter.js"></script>

<script src="js/chosen.jquery.js" type="text/javascript"></script>
 <script type="text/javascript">
 	//document.getElementById('output').innerHTML = location.search;
$(".chosen-select").chosen();
 </script>