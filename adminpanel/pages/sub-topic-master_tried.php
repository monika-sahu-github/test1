<link rel="stylesheet" href="css/chosen.css">
<?php 
$page_title = "SUB TOPIC MASTER";
$action="ADD";
$pagee = "sub-topic-master";
$table_name = "sub_topic_master";
$key = "id";
$exam = "";
$type = "";
$subject = "";
$sub_topic_name = "";
$create_date = date('Y-m-d');
$subject_id = "";
$topic_id = "";
$id = "";
if(isset($_REQUEST["id"])){

	$action="UPDATE";
  $id = $_REQUEST["id"];
  $selquery = $conn->query("select * from $table_name WHERE id = '$id' ");
  $row = $selquery->fetch(PDO::FETCH_ASSOC);

}
  ?>
  <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div><?php echo $action." ".$page_title; ?></div>
                    </div>
                </div>
            </div>        

            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    &nbsp;
                    <?php if($action == "UPDATE") {?>
                    
                    <a href="home.php?page=sub-topic-master">Add New</a>
                    
                    <?php } ?>
                    <div class="table-responsive">
                        
                              <input type="hidden" name="id" value="<?php echo $id; ?>">
     <div class="modal-content"> 
     
       
      <div class="modal-body">
        <div class="col-md-12">
         <fieldset>
          <div class="form-group">
                <label class="col-sm-2 control-label"><b>Subject Name </b></label>
                <div  class="col-sm-4" >
                <select name="mainsubject" required="" id="mainsubject" class="form-control"  onchange="get_topic()">
                	<option  value="">Select</option>
        <?php  
          $sql = $conn->query("SELECT * FROM main_subject WHERE status ='0' ORDER BY ex_id DESC");
  
          //$mainsub_id = $cmn->getvalfield($conn,"subject_quehead","main_subject_id","id='$topic_id'"); 

          ?>
<!-- <option  value="">Select</option> -->
 <?php
while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
?>
    <option <?php //if($mainsub_id==$row["ex_id"]){ echo "selected"; } ?> value="<?php echo $row["ex_id"] ?>" ><?php echo $row["ex_title"];?></option><?php }?>

                </select>
                  
                </div>
            </div>
          <div class="form-group">
                <label class="col-sm-2 control-label"><b>Topic Name</b></label>
                <div  class="col-sm-4" >
                	<div id="topic_div">
                <select name="subject" required="" id="subject" class="form-control" >
                  <?php  
                  $sql = $conn->query("SELECT * FROM subject_quehead WHERE status ='0' ORDER BY id DESC");
 ?>
<option  value="">Select</option>
 <?php
while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
?>
    <option <?php if($topic_id==$row["id"]){ echo "selected"; } ?> value="<?php echo $row["id"] ?>" ><?php echo $row["quehead"];?></option>
<?php } ?>
                </select>
                 </div> 
                </div>
            </div><?php //} ?>
            <div class="form-group">
                <label class="col-sm-2 control-label"><b>Sub Topic Name</b></label>
                <div  class="col-sm-4" >
                <input  type="text" required="" value="<?php echo $sub_topic_name; ?>" name="sub_topic_name" id="sub_topic" class="form-control" >
                  
                  
                </div>
            </div>
 

          </fieldset>
        </div>
      </div>
      <div class="col-md-12">
        <div>

        	<?php if(isset($_REQUEST["id"])){ ?>
        <button name="save" id="updatebtn" class="btn btn-success" onclick="uo=update()">Update</button>
        
         <button name="save" id="savebtn" class="btn btn-primary" onclick="uo=add_subject()">Add As New</button>
        
        <?php } else { ?>
        <button name="save" value="Save" id="savebtn" class="btn btn-primary" onclick="add_subtopic()">Add</button><?php }?>
        <div class="col-md-12">
          &nbsp;
          </div>
      </div>
      
    </div>

    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                	<div class="container">
                    <div class="card-header">List of Subtopics
                    </div>
                    <div class="table-responsive" id="list_div">
                       Loading Data...
                    </div>
                </div>
            </div>
      </div>
  </div>
  	<script type="text/javascript">
  		function get_topic(){
  			subject_id = document.getElementById('mainsubject').value;
  
  			if(subject_id !=""){

  				$.ajax({
  					type: "POST",
  					url: "get_topic.php",
  					data: 'subject_id='+subject_id,
  					success: function(data){
  						
  							
  							$('#topic_div').html(data);
  							changeLook();
  						
  					}
  				})
  			}else{
  				alert('some field is blank!');
  			}
  		}
  	</script>
      <script type="text/javascript">
      	 
        function add_subtopic(){
          
          mainsub_id = document.getElementById('mainsubject').value;
          topic_id = document.getElementById('subject').value;
          subtop_name = document.getElementById('sub_topic').value;
          if(mainsub_id!="" && topic_id !="" && subtop_name !="")
    {
          
    	document.getElementById('savebtn').disabled=true;
       document.getElementById('savebtn').innerHTML="Please Wait";

          $.ajax({
            type: "POST",
            url: "add_subtopic.php", 
            data: 'action=add&subtop_name='+subtop_name+'&topic_id='+topic_id+'&mainsub_id='+mainsub_id,
            success: function(data) {
              if(data=="success"){
  				alert("Added Successfully");
  			document.getElementById('sub_topic').value = '';
  			 get_list();
  			 changeLook();
  			document.getElementById('savebtn').disabled=false;
            document.getElementById('savebtn').innerHTML="Add";
            document.getElementById('sub_topic').focus();
}else{
  alert("Failed!");
}
            }

          });
      }else
    {
        alert('Some fields are blank');
    }
        }
    </script><script>
        function get_list(){
    
    
    $.ajax({
      type: "POST",
      url: "add_subtopic.php",
      data:'action=list',
      success: function(data){
       
       
          document.getElementById('list_div').innerHTML=data;
          
       
      }
    });

  }
  get_list();
      </script>
      <script type="text/javascript">
      	function update(){
      		subtopic_name = document.getElementById('subtop_name').value;
			topic_id = document.getElementById('topic_id');
			mainsub_id = document.getElementById('mainsub_id');
         	id = $_POST['id'];
      	}
      </script>
<script type="text/javascript">
   function delete_subtopic(subtop_id){
    
if(confirm("Do you want to delete this question!")){

     $.ajax({ 
    
type: "POST",
url: "delete_subtopic.php", 
data: 'subtopic_id='+subtop_id,
success: function(data) {
 data = data.trim("");
 if(data=="success"){
  //Delete Successfully
  Swal.fire({
  title: "Deleted Successfully!",
  text: "",
  icon: "success",
  button: "OK",
});
window.location.href = 'home.php?page=sub-topic-master';

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
<script src="js/classie.js"></script>
<script src="js/chosen.jquery.js" type="text/javascript"></script>
  <script type="text/javascript">
        // Chosen touch support.
    if ($('.chosen-select').length > 0) {
      $('.chosen-select').on('touchstart', function(e){
        e.stopPropagation(); e.preventDefault();
        // Trigger the mousedown event.
        $(this).trigger('mousedown');
      });
    }
    </script>
    <script>
 function changeLook()
{
  var vall = {
      '.chosen-select' : {},
    }
    for (var selector in vall) {
      $(selector).chosen(vall[selector]);}
}
changeLook();
</script>
