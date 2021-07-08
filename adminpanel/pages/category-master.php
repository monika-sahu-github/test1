<?php
$action="ADD";
$page_title = "CATEGORY MASTER";
$pagee = "category-master";
$table_name = "category_master";
$key = "id";
$create_date = date('Y-m-d');
$id = "";
$type = "";
$category_name = "";
$topic_id = "";
$mainsub_id  = "";

if(isset($_REQUEST["id"])){

  $action="UPDATE";
  $id = $_REQUEST["id"];
  $selquery = $conn->query("select * from $table_name WHERE id = '$id' ");
  $row = $selquery->fetch(PDO::FETCH_ASSOC);
  //$category_name = $row["category_name"];
  //$mainsub_id  = $row["subject_id"];
  //$topic_id = $row["topic_id"];
} ?>


<div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div><?php echo $pagee; ?></div>
                    </div>
                </div>
            </div>        

            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header"><?php echo $action; ?> CATEGORY
                    &nbsp;
                    <?php if($action == "UPDATE") {?>
                    
                    <a href="home.php?page=sub-topic-master">Add New</a>
                    
                    <?php } ?> 
                    </div>
                    <div class="table-responsive">
                        <form class="" id="" method="post" enctype="multipart/form-data" >
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
    <option <?php if($mainsub_id==$row["ex_id"]){ echo "selected"; } ?> value="<?php echo $row["ex_id"] ?>" ><?php echo $row["ex_title"];?></option><?php }?>

                </select>
                  
                </div>
            </div>

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
    <option <?php if($topic_id==$row["id"]){ echo "selected"; } ?> value="<?php echo $row["id"] ?>" ><?php echo $row["quehead"]; ?></option>
<?php } ?>
                </select>
                  
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"><b>Category Name</b></label>
                <div  class="col-sm-4" >
                <input  type="text" required="" value="<?php echo $category_name; ?>" name="category_name" id="category" class="form-control" >
                  
                  
                </div>
            </div>
 

          </fieldset>
        </div>
      </div>
      <div class="col-md-12">
        <div>

          <?php if(isset($_REQUEST["id"])){ ?>
        <button name="save" id="updatebtn" class="btn btn-success" onclick="uo=update()">Update</button>
        
         <button name="save" id="savebtn" class="btn btn-primary" onclick="uo=add_subtopic()">Add As New</button>
        
        <?php } else { ?>
        <button name="save" value="Save" id="savebtn" class="btn btn-primary" onclick="add_subtopic()">Add</button><?php }?>
        <div class="col-md-12">
          &nbsp;
          </div>
      </div>
      
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
                    <div class="table-responsive" id="list_div">
                        Loading Data...
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
                
              
            }
          });
        }else{
          alert('some field is blank!');
        }
      }
    </script>
<script type="text/javascript">
  function add_category(){
     mainsub_id = document.getElementById('mainsubject').value;
          topic_id = document.getElementById('subject').value;
          category_name = document.getElementById('category').value;

          if(mainsub_id!="" && topic_id !="" && category_name !="")
    {
          
       document.getElementById('savebtn').disabled=true;
       document.getElementById('savebtn').innerHTML="Please Wait";

          $.ajax({
            type: "POST",
            url: "add_category.php", 
            data: 'action=add&category_name='+category_name+'&topic_id='+topic_id+'&mainsub_id='+mainsub_id,
            success: function(data) {
              if(data!=""){
                alert(data);
                 document.getElementById('category').value = '';
                 get_list();
        
             document.getElementById('savebtn').disabled=false;
            document.getElementById('savebtn').innerHTML="Add";
            document.getElementById('category').focus();
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
</script>
<script>
        function get_list(){
    
    
    $.ajax({
      type: "POST",
      url: "add_category.php",
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
              category_name = document.getElementById('category').value;
              topic_id = document.getElementById('subject').value;
              mainsub_id = document.getElementById('mainsubject').value;
              id = document.getElementById('id').value;
              
              if(category_name!="" && topic_id !="" && mainsub_id !="")
              {
                document.getElementById('updatebtn').disabled=true;
                document.getElementById('updatebtn').innerHTML="Please Wait";
              
                $.ajax({
      type: "POST",
      url: "add_category.php",
      data:'action=update&category_name='+category_name+'&topic_id='+topic_id+'&mainsub_id='+mainsub_id+'&id='+id,
      success: function(data){
        
        if(data!=""){
          alert(data);
          get_list();
           document.getElementById('updatebtn').disabled=false;
            document.getElementById('updatebtn').innerHTML="Update";
        }else{
          alert('Failed!'+topic_id);
        }
      }
    });
              }else{
                alert('some field are blank');
              }
        }
      </script>
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
//window.location.href = 'home.php?page=category-master';
  document.getElementById('row'+category_id).style.display="none";

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
