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
?>
<style type="text/css">
    .widget-heading{
        font-size: 25px;
    }
    h2{
        color: white;
        text-align: center;
    }
    .anchroid{
        text-decoration: none;
    }
    .exam_headdiv{
        <?php if($type==0){ ?>
        background: linear-gradient(-20deg, #2b5876 0%, #4e4376 100%) !important;
    <?php } else { ?>
        background-image: radial-gradient(circle 248px at center, #16d9e3 0%, #30c7ec 47%, #46aef7 100%) !important;
    <?php  } ?>
    }
    .sho_tot_que{
        color: yellow;
    }
</style> 
<div class="app-main__outer">
 <div id="refreshData">
    <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-university">
                            </i>
                        </div>
                        <div>Subjects(Question)
                            <!-- <div class="page-title-subheading">This is an example dashboard created using build-in elements and components.
                            </div> -->
                        </div>
                    </div>
                     
                 </div>
            </div>    <div class="breadcrumb">   
                <input type="hidden" name="src1" value="<?php echo $_GET['source']; ?>">
                <?php $val1 = $_GET['source']; 
                if($val1 == 'menu'){?>
                <a href="#" class="anchr-tagcolor">Exam</a><a href="#" class="anchr-tagcolor">All Exams</a><a href="#" class="spanclr"><?php echo $examtype; ?></a></div>
            <br><br>
                <?php }else{?>
                <a href="home.php?page=dashboard" class="anchr-tagcolor">Dashboard</a><a href="#" class="spanclr"><?php echo $examtype; ?></a></div>
            <br><br><?php }?>
            <div class="" style="background: white;border: 3px solid #375176;padding: 0px;"> 
            <div class="row" style="padding: 20px;">

<div class="col-sm-12">
     <!-- <h2>Practice Test</h2><br><br>  -->
</div>       <?php
        
// Select and tanang exam depende sa course nga ni login 
//echo "SELECT * FROM main_subject WHERE type='$type' ORDER BY ex_id DESC ";
//echo "SELECT * FROM main_subject WHERE type='$type' ORDER BY (SELECT * FROM subject_quehead WHERE 1 and (SELECT * FROM exam_question_tbl sqt INNER JOIN subject_quehead sqh ON  sqt.sub_subjecthead_id = sqh.id WHERE sqt.sub_subjecthead_id =sqh.id) DESC ";
$selExam = $conn->query("SELECT * FROM main_subject WHERE status = 0 ORDER BY ex_id asc ");

                       if($selExam->rowCount() > 0)
                        {      //echo "??".$selExam->rowCount();
                            while ($selExamRow = $selExam->fetch(PDO::FETCH_ASSOC)) {
                                //$tot_que = "";

                                 $tot_que = $cmn->getvalfield($conn,"exam_question_tbl","count(*)","main_subject_id = '$selExamRow[ex_id]'");

                                $main_subject_id = $selExamRow["ex_id"];
                                   $sql1= "SELECT * FROM subject_quehead WHERE main_subject_id ='$main_subject_id'";
        $result1 = $conn->prepare($sql1);
        $result1->execute();
        $total = 0; 
    while($row = $result1->fetch(PDO::FETCH_ASSOC)){
    $subject_id = $row['id'];
    $totques = $conn->query("SELECT * FROM exam_question_tbl sqt INNER JOIN subject_quehead sqh ON  sqt.sub_subjecthead_id = sqh.id WHERE sqt.sub_subjecthead_id ='$subject_id' "); 
    $score1 = $totques->rowCount();
    $total = $total + $score1; }
    //echo $score1; 
    if($total != 0){
    
     ?>
            <div class="col-md-6 col-xl-4">
                    <a href="home.php?page=get_subject_quehead&exam_type=<?php echo $_REQUEST['exam_type']; ?>&source=<?php echo $val1;?>&question_head_id=<?php echo openssl_encrypt($selExamRow['ex_id'], $ciphering, 
$key, $options, $iv); ?>" style="text-decoration: none;" class="anchroid">
                    <div class="card mb-3 widget-content exam_headdiv" style="">

                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading"><?php echo $selExamRow['ex_title']."<br><span class='sho_tot_que'>(".$total.")</span>"; ?></div>
                               <center>
                                   <i class="fa fa-<?php echo $selExamRow['exam_logo']; ?>" aria-hidden="true" style="font-size: 70px"></i>
                               </center>
                            </div>
                           
                        </div>
                    </div>
                    </a>
                </div><?php 
            }
                 } }
                 ?>
               <!--  <div class="col-md-6 col-xl-4">
                    <a href="#" id="" class="anchroid">
                    <div class="card mb-3 widget-content" style="background: #89939a;">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">Goegraphy</div>
                               <center>
                                   <i class="fa fa-globe" aria-hidden="true" style="font-size: 70px"></i>
                               </center>
                            </div>
                           
                        </div>
                    </div>
                    </a>
                </div> -->
               <!--  <div class="col-md-6 col-xl-4">
                    <a href="#" id="practicetest" class="anchroid">
                    <div class="card mb-3 widget-content" style="background: #89939a;">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">General Study</div>
                               <center>
                                   <i class="fa fa-edit" aria-hidden="true" style="font-size: 70px"></i>
                               </center>
                            </div>
                           
                        </div>
                    </div>
                    </a>
                </div> -->
                
               
                <!-- <div class="col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-grow-early">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">Total Examinee</div>
                                <div class="widget-subheading" style="color:transparent;">.</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white"><span>46%</span></div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-premium-dark">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">Products Sold</div>
                                <div class="widget-subheading">Revenue streams</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-warning"><span>$14M</span></div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div></div>
      
        
        </div>
         
    </div>
