<?php
$mainsub_id = "";
$type="";
$topic_name = "";
$msg ="";
$id="";
$create_date = date('Y-m-d');
$action="ADD";
if(isset($_REQUEST["id"])){
    
    $action="UPDATE";
  $id = $_REQUEST["id"];
  $selquery = $conn->query("select * from subject_quehead WHERE id = '$id' and status='0' ");
  $row = $selquery->fetch(PDO::FETCH_ASSOC);
  $topic_name = $row["quehead"];
  $mainsub_id  = $row["main_subject_id"];
  } ?>
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
                    <div class="card-header"><?php echo $action; ?> Topic
                    &nbsp;
                    <?php if($action == "UPDATE") {?>
                    
                    <a href="home.php?page=subject-master">Add New</a>
                    
                    <?php } ?>
                    </div>
                    <div class="table-responsive">
                      
                             
     
    
        <div class="col-md-12">
            
         <fieldset>
           
            <div class="form-group">
                <label class="col-sm-2 control-label"><b>Select Subject </b></label>
                 <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                <div  class="col-sm-4" >
                <select name="exam" id="subject" class="form-control" placeholder="" autocomplete="off">
                    <option value="">Select Subject</option>
                    <?php  $query = $conn->query("SELECT * FROM main_subject WHERE status='0' ORDER BY ex_id DESC"); 
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
      <div class="col-md-12">
          <div>
      
        
        <?php if(isset($_REQUEST["id"])){ ?>
        <button name="save" id="updatebtn" class="btn btn-success" onclick="uo=update()">Update</button>
        
         <button name="save" id="savebtn" class="btn btn-primary" onclick="uo=add_subject()">Add As New</button>
        
        <?php } else { ?>
        <button name="save" id="savebtn" class="btn btn-success" onclick="add_subject()">Add</button>
        <?php } ?>
        </div>
      </div>
      <div class="col-md-12">
          &nbsp;
          </div>
      </div>
      
   

                    </div>
                </div>
            </div>
            
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="container">
                    <div class="card-header">List of Topics
                    </div>
                    <div class="table-responsive" id="list_div">
                         Loading Data...
                    </div>
                </div>
            </div>
            </div>
      
        
</div>
<script type="text/javascript">
  topic_name = document.getElementById('topic').value;
topic_name.addEventListener("keydown", function (e) {
    if (e.keyCode === 13) {
    document.getElementById("savebtn").click();
    }
    
});

  function add_subject(){
      
     
      
    mainsub_id = document.getElementById('subject').value;
    topic_name = document.getElementById('topic').value;
    
    if(mainsub_id!="" && topic_name !="")
    {
         document.getElementById('savebtn').disabled=true;
       document.getElementById('savebtn').innerHTML="Please Wait";
      
    

    $.ajax({
      type: "POST",
      url: "add_subject.php",
      data: 'action=add&topic_name='+topic_name+'&mainsub_id='+mainsub_id,
      success: function(data){
        if(data!=""){
          alert(data);
          document.getElementById('topic').value = '';
          get_list();
           document.getElementById('savebtn').disabled=false;
            document.getElementById('savebtn').innerHTML="Add";
            document.getElementById('topic').focus();
        }else{
          alert('Failed!'+topic_name+mainsub_id);
        }
      }
    });
    }
    else
    {
        alert('Some fields are blank');
    }

  }
</script>
<script type="text/javascript">
function get_list(){
    
    
    $.ajax({
      type: "POST",
      url: "add_subject.php",
      data:'action=list',
      success: function(data){
       
       //alert(data);
          document.getElementById('list_div').innerHTML=data;
          
       
      }
    });

  }
  get_list();
</script>
<script type="text/javascript">

  function update(){
    
       mainsub_id = document.getElementById('subject').value;
    topic_name = document.getElementById('topic').value;
     id = document.getElementById('id').value;
    
     if(mainsub_id!="" && topic_name !="")
    {
        document.getElementById('updatebtn').disabled=true;
       document.getElementById('updatebtn').innerHTML="Please Wait";
      
    $.ajax({
      type: "POST",
      url: "add_subject.php",
      data:'action=update&topic_name='+topic_name+'&mainsub_id='+mainsub_id+'&id='+id,
      success: function(data){
        if(data=="success"){
          alert('Updated Successfully!');
          get_list();
           document.getElementById('updatebtn').disabled=false;
            document.getElementById('updatebtn').innerHTML="Update";
        }else{
          alert('Failed!'+topic_id);
        }
      }
    });
    }
    else
    {
        alert('Some field is blank');
    }

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
//window.location.href = 'home.php?page=subject-master';
    
    document.getElementById('row'+topic_id).style.display="none";

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
         
