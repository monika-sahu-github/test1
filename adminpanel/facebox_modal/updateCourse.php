
<?php 
  include("../../conn.php");
  $ex_id = $_GET['id'];
 
  $selCourse = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$ex_id' ")->fetch(PDO::FETCH_ASSOC);

 ?>

<fieldset style="width:543px;" >
	<legend><i class="facebox-header"><i class="edit large icon"></i>&nbsp;Update Subject Name ( <?php echo strtoupper($selCourse['ex_title']); ?> )</i></legend>
  <div class="col-md-12 mt-4">
<form method="post" id="updateCourseFrm">
  <div class="form-group">
      <legend>Course Type</legend>
    <select name="type" class="form-control">
      <option  value="">Select</option>
      <option <?php if($selCourse['type']==0){ echo "selected"; } ?> value="0">Practice Test</option>
      <option <?php if($selCourse['type']==1){ echo "selected"; } ?> value="1">Mock Test</option>
    </select>
  </div>
     <div class="form-group">
      <legend>Subject Name</legend>
    <input type="hidden" name="ex_id" value="<?php echo $ex_id; ?>">
    <input type="" name="newCourseName" class="form-control" required="" value="<?php echo $selCourse['ex_title']; ?>" >
  </div>

   <div class="form-group">
      <legend>Subject Caption</legend>
    
    <input type="text" name="exam_logo" class="form-control" required="" value="<?php echo $selCourse['exam_logo']; ?>" >
  </div>

  <div class="form-group" align="right">
    <button type="submit" class="btn btn-sm btn-primary">Update Now</button>
  </div>
</form>
  </div>
</fieldset>







