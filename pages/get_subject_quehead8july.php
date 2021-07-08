<?php
$decryption=openssl_decrypt ($_REQUEST['exam_type'], $ciphering,  
$key, $options, $iv);  
$type = $decryption;
$examtype = '';
if($type==0){
    $examtype = "Practice Test";
} else if($type==1){
   $examtype = "Mock Test"; 
}

$question_head_id=openssl_decrypt ($_REQUEST['question_head_id'], $ciphering,  
$key, $options, $iv);

// function $cmn->getvalfield($conn,$table,$field,$where)
// {
// $stmt = $conn->prepare("SELECT $field FROM $table WHERE $where"); 
// $stmt->execute(); 
// $row = $stmt->fetch();
// return $row[0];
// } 
$quehead = $cmn->getvalfield($conn,"main_subject","ex_title","ex_id='$question_head_id'");
$exam_logo = $cmn->getvalfield($conn,"main_subject","exam_logo","ex_id='$question_head_id'");

//$selExam = $conn->query("SELECT * FROM subject_quehead WHERE main_subject_id='$question_head_id' ORDER BY id DESC "); 
// select de.order_id as order_id, de.cust_name as cust_name, de.create_date as create_date, de.dispatch_type as dispatch_type, de.tracking_no as tracking_no, de.portal as portal, de.is_cancel as is_cancel, de.is_profession as is_profession, ordd.courier as courier from dispatch_entry de INNER JOIN order_details as ordd ON de.order_id = ordd.order_id AND DATE(de.create_date) BETWEEN '2021-05-01' AND '2021-05-31' GROUP BY de.order_id
//echo "SELECT subque.id as id, subque.quehead as quehead, count(examtbl.*) as ctt FROM subject_quehead as  subque INNER JOIN exam_question_tbl as examtbl ON subque.main_subject_id=examtbl.sub_subjecthead_id and subque.main_subject_id='$question_head_id' GROUP by examtbl.sub_subjecthead_id ORDER BY examtbl.ctt DESC ";
$selExam = $conn->query("SELECT subque.id as id, subque.quehead as quehead, count(*) as ctt FROM subject_quehead as subque INNER JOIN exam_question_tbl as examtbl ON subque.id=examtbl.sub_subjecthead_id and subque.main_subject_id='$question_head_id' GROUP by examtbl.sub_subjecthead_id ORDER BY ctt DESC"); 
 ?>
<style type="text/css">
    .widget-heading{
        font-size: 25px;
    }
    h2{
        color: white;
        text-align: center;
    }
    .exam_headdiv{
        <?php if($type==0){ ?>
        background: linear-gradient(-20deg, #2b5876 0%, #4e4376 100%) !important;
    <?php } else { ?>
        background-image: radial-gradient(circle 248px at center, #16d9e3 0%, #30c7ec 47%, #46aef7 100%) !important;
    <?php  } ?>
    }
</style>
<div class="app-main__outer">
 <div id="refreshData">
    <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div>Topic(Question)

                        </div>
                    </div>
                     
                 </div>
            </div>        
   <div class="breadcrumb">
    <input type="hidden" name="src1" value="<?php echo $_GET['source']; ?>">
                <?php $val1 = $_GET['source']; 
                if($val1 == 'menu'){?>
                    <a href="#" class="anchr-tagcolor">Exam</a><a href="#" class="anchr-tagcolor">All Exams</a><a href="home.php?page=examination_test_type&source=<?php echo $val1; ?>&exam_type=<?php echo $_REQUEST['exam_type']; ?>" class="anchr-tagcolor"><?php echo $examtype; ?></a><a  href="#"><?php echo $quehead; ?></a></div><br><br>
                <?php }else{?>
    <a href="home.php?page=dashboard" class="anchr-tagcolor">Dashboard</a><a href="home.php?page=examination_test_type&source=<?php echo $val1; ?>&exam_type=<?php echo $_REQUEST['exam_type']; ?>" class="anchr-tagcolor"><?php echo $examtype; ?></a><a  href="#"><?php echo $quehead; ?></a></div><br><br><?php }?>
 <div class="" style="background: white;border: 3px solid #375176;padding: 0px;">
    <div class="col-md-12 mb-3"></div> 
    <div class="row">
  <div class="col-md-2 mb-3"></div>       
 <div class="col-md-10 col-xl-6">
                    <a href="#" id="" style="text-decoration: none;">
                    <div class="card mb-3 widget-content exam_headdiv">

                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading" style="font-size: 20px"><?php echo $quehead; ?></div>
                               <center>
                                   <i class="fa fa-<?php echo $exam_logo; ?>" aria-hidden="true" style="font-size: 30px"></i>
                               </center>
                            </div>
                           
                        </div>
                    </div>
                    </a>

                </div>
    </div>
        <?php if($selExam->rowCount() > 0){ ?>   
    <div class="row" style="padding-left: 20px;" >
        <h4 style="text-align: right; ">Choose a Topic</h4> 
    </div><?php } ?> 
    <div class="row" style="padding: 20px;">

               
                
                    <?php 
                       if($selExam->rowCount() > 0)
                        {      //echo "??".$selExam->rowCount();?>
                         
                           <?php while ($selExamRow = $selExam->fetch(PDO::FETCH_ASSOC)) {
                            $tot_que = $cmn->getvalfield($conn,"exam_question_tbl","count(*)","sub_subjecthead_id = '$selExamRow[id]'");
                    ?>
                    <div class="col-md-3 col-xl-4">
                    <a href="home.php?page=start_exam&exam_type=<?php echo $_REQUEST['exam_type']; ?>&source=<?php echo $val1; ?>&question_head_id=<?php echo $_REQUEST['question_head_id']; ?>&queheadid=<?php echo openssl_encrypt($selExamRow['id'], $ciphering, 
$key, $options, $iv); ?>" id="practicetest">
                    <div class="card mb-3 widget-content exam_headdiv" style="width: 100%;height: 0px;">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading" style="font-size: 20px;"><?php echo $selExamRow['quehead']."<br>(".$tot_que.")"; ?></div>
                            </div>
                           
                        </div>
                    </div>
                    </a></div>
                <?php } } else { ?>
                    <a href="#" id="practicetest">
                    <div class="card mb-3 widget-content exam_headdiv" style="width: 500px;height: 0px;">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">No Topics are Available!</div>
                            </div>
                           
                        </div>
                    </div>
                    </a>
                <?php  } ?>
                
            </div></div>
      
        
        </div>
         
    </div>
