 <?php 
    $examId = $_GET['id'];
    $selExam = $conn->query("SELECT * FROM subject_quehead WHERE id='$examId' ")->fetch(PDO::FETCH_ASSOC); 
    $totExam = $conn->query("SELECT COUNT(*) as allque FROM exam_answers WHERE sub_subjecthead_id='$examId' and axmne_id = '$exmneId' ")->fetch(PDO::FETCH_ASSOC);
    $selQuest = $conn->query("SELECT * FROM exam_answers WHERE sub_subjecthead_id='$examId' AND axmne_id='$exmneId' AND is_finel_sub='1' group by CAST(exans_created AS DATE) desc");
$count = $selQuest->rowCount();
$i = 1;
 ?>
<style type="text/css">
    .alert-success{
        color: #1e6641 !important;
    }
    .alert-danger{
        color: #71132a!important;
    }
    .alert{
        margin-bottom: 0rem !important;
    }
    .widget-content{
        padding: 1rem !important;
    }
    .bg-premium-dark {
    background-image: linear-gradient(to right, #8e15158c 0%, #29b3e8 100%) !important;
    }
    #showtimedatewise{
    background: linear-gradient(to bottom, #f7ab00 0%, #f3c8b0 100%);
    font-size: 12px;
    
    padding: 10px;
    border-radius: 11px;
    
    text-align: center;
    color: white;
    text-decoration: none;
    }
    a {
        text-decoration: none;
    }
    #rece{
color: #fffefe;
    margin-left: 15px;
   
    background: #2000a0;
    border-radius: 9px;
    padding: 0px;
     float: left;
    font-weight: bolder;
    font-size: 10px;
    z-index: 1;
    position: inherit;
    }
</style>
<div class="app-main__outer">
<div class="app-main__inner">
    <div id="refreshData">
    <div class="col-md-12">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div>
                        <?php echo $selExam['quehead']; ?>
                          <div class="page-title-subheading">
                            <?php //echo $selExam['ex_description']; ?>
                          </div>

                    </div>
                </div>
            </div>
        </div>  
        <div class="breadcrumb">
            <input type="hidden" name="src1" value="<?php echo $_GET['source']; ?>">
                <?php $val1 = $_GET['source']; 
                if($val1 == 'menu'){?>
                    <a href="#" class="anchr-tagcolor">Result</a><a href="#" class="anchr-tagcolor">All Results</a><a href="home.php?page=all_results&source=menu" class="anchr-tagcolor">Practice Test Result</a><a href="#"><?php echo $selExam['quehead']; ?></a>
                <?php }else{?>
            <a href="home.php?page=dashboard" class="anchr-tagcolor">Dashboard</a><a href="home.php?page=all_results&source=dashboard" class="anchr-tagcolor">Practice Test Result</a><a href="#"><?php echo $selExam['quehead']; ?></a> <?php } ?>
         </div>
         <div class="" style="background: white;border: 3px solid #375176;padding: 0px;">
        <div class="row col-md-12 mb-3">
          <!-- <h1 class="text-primary">RESULT</h1> -->
        </div>
        <div class="row" >
                    <div class="col-md-12" >
 <?php $count; if($count>0){ 
     $ii = 1;
 while ($selExamRow = $selQuest->fetch(PDO::FETCH_ASSOC)) {
$exans_created = $selExamRow['exans_created'];
$date = $exans_created;
$dateArr = explode("-",$date);
$y = $dateArr[0];
$m=$dateArr[1];
$d=$dateArr[2];
$sel_exam_timewise = $conn->query("SELECT * FROM exam_answers WHERE sub_subjecthead_id='$examId' AND axmne_id='$exmneId' AND is_finel_sub='1' and YEAR(exans_created)='$y' and MONTH(exans_created)='$m' and DAY(exans_created)='$d' group by exam_session order by exans_id desc");
 ?>  
           <div class="col-md-6 float-left">
            <div class="card mb-3 widget-content bg-happy-green">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading"><h5>Date -  <?php echo date('d-m-Y',strtotime($selExamRow['exans_created'])); ?></h5>Score :
                        <?php 
                             $sel_exam_timewise1 = $conn->query("SELECT * FROM exam_answers WHERE sub_subjecthead_id='$examId' AND axmne_id='$exmneId' AND is_finel_sub='1' and YEAR(exans_created)='$y' and MONTH(exans_created)='$m' and DAY(exans_created)='$d' group by exam_session order by exans_id desc");
                                $total = $total_over = $result1 = 0;

                              while ($selExamTimeRow = $sel_exam_timewise1->fetch(PDO::FETCH_ASSOC)) { 
                                
                                $exam_session = $selExamTimeRow['exam_session']; 
                                $examId = $selExamTimeRow['sub_subjecthead_id'];
                                $selScore = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id AND eqt.exam_answer_id = ea.exam_answer_id  WHERE ea.axmne_id='$exmneId' AND ea.sub_subjecthead_id='$examId' AND ea.is_finel_sub='1' and ea.exam_session = '$exam_session' order by eqt_id asc ");
                                 $totExam = $conn->query("SELECT COUNT(*) as allque FROM exam_answers WHERE sub_subjecthead_id='$examId' and axmne_id = '$exmneId' and exam_session = '$exam_session' ")->fetch(PDO::FETCH_ASSOC); 
                                 $over = $totExam['allque']; //$a = $selScore['sub_subjecthead_id']; echo $a;
                                 $total_over = $total_over + $over;
                                $number = $selScore->rowCount();
                                $total = $total + $number; 
                               // while($examId == $totExam['sub_subjecthead_id']){
                                 //   $result1 = $result1 + $total;
                                //}
                                    } 
                                     $percent = round($total / $total_over * 100,2); 
                                     echo $percent;
                                 ?>%</div>
                        <div class="widget-subheading" style="color: transparent;">/</div>
                        </div>
                        <div class="widget-content-right">
                        <div class="widget-numbers text-white">
                        <?php $n=3;$i=1;  while ($selExamTimeRow = $sel_exam_timewise->fetch(PDO::FETCH_ASSOC)) { $mod =$i%$n;
                            $time_in_12_hour_format  = date("g:i A", strtotime($selExamTimeRow['exans_created']));
 
                            ?>   <div class="col-sm-4" style="float:left;" ><a href="home.php?page=result&id=<?php echo $selExamTimeRow['sub_subjecthead_id']; ?>&date_time=<?php echo $selExamTimeRow['exans_created']; ?>&session=<?php echo $selExamTimeRow['exam_session']; ?>&source=<?php echo $val1; ?>" style="text-decoration: none; margin:1px;">
                           
                                <div id="showtimedatewise">
                              <?php echo $time_in_12_hour_format; ?><?php if($i==1 && $ii==1){ ?><div ><span id="rece">Recent Exam</span></div><?php } ?></div>
                            </a>
                            </div>
                            <?php if($mod==0){ ?>&nbsp;<br><br><?php } ?>
                        <?php $i++;} ?>    
                        </div>
                    </div>
                </div>
            </div>
            </div>
           
 <?php $ii++; } } else { ?>
                    <h5 style="color: red;">Exam Not Attempt!</h5>
                 <?php }   ?>
            </div>
</div> 
        </div>
</div>
</div>
</div>
