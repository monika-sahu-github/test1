 <?php
//  $decryption=openssl_decrypt ($_REQUEST['exam_type'], $ciphering,  
// $key, $options, $iv);  
// $type = $decryption;
// $examtype = '';
// if($type==0){
//     $examtype = "Practice Test";
// } else if($type==1){
//    $examtype = "Mock Test"; 
// }
// $question_head_id=openssl_decrypt ($_REQUEST['question_head_id'], $ciphering,  
// $key, $options, $iv);
// $quehead1 = getvalfield($conn,"exam_tbl","ex_title","ex_id='$question_head_id'");
// ///////////////////////////////////////////////////////////////////////////////////////
// $queheadid=openssl_decrypt ($_REQUEST['queheadid'], $ciphering,  
// $key, $options, $iv);

// function getvalfield($conn,$table,$field,$where)
// { //echo "SELECT $field FROM $table WHERE $where";
// $stmt = $conn->prepare("SELECT $field FROM $table WHERE $where"); 
// $stmt->execute(); 
// $row = $stmt->fetch();
// return $row[0];
// }  
// $exam_id = getvalfield($conn,"subject_quehead","exam_id","id='$queheadid'");
// $typeenc = openssl_encrypt($exam_id, $ciphering, 
// $key, $options, $iv);
// $quehead = getvalfield($conn,"subject_quehead","quehead","id='$queheadid'");
  
// $selQuestion = $conn->query("SELECT * FROM exam_question_tbl WHERE sub_subjecthead_id='$queheadid' ")->fetch(PDO::FETCH_ASSOC);

//$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
 ?>
    <script src="ckeditor/ckeditor.js"></script>
    <script src="ckeditor/samples/js/sample.js"></script>
    <style>
    .box{
        float:right;
        overflow: hidden;
         
    }
    /* Add padding and border to inner content
    for better animation effect */
    .box-inner{
        width: 400px;
        padding: 10px;
        border: 1px solid #fcc7a4;
    }
</style>

<style type="text/css">
    .widget-heading{
        font-size: 25px;
    }
    h2{
        color: white;
    background: #375176;
    text-align: center;
    border-radius: 3px;
    padding: 8px;
    }
</style>
<style type="text/css">
        .anchr-tagcolor{
            color: #a6aaad;
            text-decoration: none;
        }
        .anchr-tagcolor:hover{
            color: red;
            text-decoration: none;
        }
        .spanclr{
           color: #a6aaad; 
        }
        .spanclr:hover{ 
            color: red;
        }
        .arrow{
           color: #a6aaad; 
        }
    </style>
<div class="app-main__outer">
 <div id="refreshData">
    <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <!-- <div class="page-title-icon">
                            <i class="fa fa-university">
                            </i>
                        </div> -->
                        <div>Go To Result
                            <!-- <div class="page-title-subheading">This is an example dashboard created using build-in elements and components.
                            </div> -->
                        </div>
                    </div>
                     
                 </div>
            </div>      <a href="home.php" class="anchr-tagcolor">Dashboard</a>
    <span class="arrow" ></span><span class="spanclr"><?php //echo $quehead; ?></span> 

    <div class="row" style="background: white;border: 3px solid #375176;padding: 0px;">

<div class="col-sm-12">
     <!-- <h2><a href="home.php">Dashboard</a> -> <a href="home.php?page=get_subject_quehead&question_head_id=<?php echo $typeenc; ?>" style="color: white;text-decoration: none;"><?php echo $quehead; ?></a> -> Ancient History</h2><br><br> -->
</div> 

 <div class="col-md-12 col-xl-12" style="padding-top: 15px;padding-bottom: 20px;">
<div class="row" id="showquestion"> 

                  
              </div>

              <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-4">
<a href="home.php?page=result&id=<?php echo $_REQUEST['id']; ?>" style="margin-left: 100px;" class="btn btn-info" >Go To Result</a>
</div></div>
                </div>
               
                <div class="col-md-6 col-xl-4">
    
                </div>
            
            </div>
      
        
        </div>
         
    </div>
 
<?php //include 'exam_js.php'; ?>
<script>
    function showdiv(){
         $(".box").animate({
                width: "toggle"
            });
     }
</script>
<script type="text/javascript">
   

function openwindow(){
    alert('ok');
window_height = screen.height;
window_width =  screen.width;
let params = 'minimizable=no,scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width='+window_width+',height='+window_height+',left=-1000,top=-1000';

open('home.php?page=start_exam&exam_type=<?php echo $_REQUEST['exam_type']; ?>&question_head_id=<?php echo $_REQUEST['question_head_id']; ?>&queheadid=<?php echo $_REQUEST['queheadid']; ?>', 'test', params);
}
</script>
</script>