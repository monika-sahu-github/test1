 <?php 
    $examId = $_GET['id'];
    $selExam = $conn->query("SELECT * FROM subject_quehead WHERE id='$examId' ")->fetch(PDO::FETCH_ASSOC); 

    $totExam = $conn->query("SELECT COUNT(*) as allque FROM exam_answers WHERE sub_subjecthead_id='$examId' and axmne_id = '$exmneId' ")->fetch(PDO::FETCH_ASSOC); 

// $selQuest = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id WHERE eqt.sub_subjecthead_id='$examId' AND ea.axmne_id='$exmneId' AND ea.is_finel_sub='1' order by eqt_id asc");
    //echo "SELECT * FROM exam_answers sub_subjecthead_id='$examId' AND ea.axmne_id='$exmneId' AND is_finel_sub='1' group by exans_created asc";die;
    $date = $_GET["date"];
    $dateArr = explode("-",$date);
    $d = $dateArr[0];
    $m=$dateArr[1];
    $y=$dateArr[2];
    $exans_created = date('Y-m-d',strtotime($_GET["date"]));

    $selQuest = $conn->query("SELECT * FROM exam_answers WHERE sub_subjecthead_id='$examId' AND axmne_id='$exmneId' AND is_finel_sub='1' and YEAR(exans_created)='$y' and MONTH(exans_created)='$m' and DAY(exans_created)='$d' group by exam_session asc");
    //echo "SELECT * FROM exam_answers WHERE sub_subjecthead_id='$examId' AND axmne_id='$exmneId' AND is_finel_sub='1' group by exans_created asc";
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
        padding: 2rem !important;
    }
    .bg-premium-dark {
    background-image: linear-gradient(to right, #8e15158c 0%, #29b3e8 100%) !important;
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

        <div class="row col-md-12">
          <h1 class="text-primary">RESULTS <?php echo $_GET["date"]; ?></h1>
        </div>
        <div class="row" >
                    <div class="col-md-12" >
 <?php $count; if($count>0){ 
    $n=1;
 while ($selExamRow = $selQuest->fetch(PDO::FETCH_ASSOC)) {
  ?>
           <a href="home.php?page=result&id=<?php echo $selExamRow['sub_subjecthead_id']; ?>&date=<?php echo date('d-m-Y',strtotime($selExamRow['exans_created'])); ?>&session=<?php echo $selExamRow['exam_session']; ?>"> 
            <div class="col-md-4 float-left">
            <div class="card mb-3 widget-content bg-happy-green">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading"><h5>Session</h5></div>
                        <div class="widget-subheading" style="color: transparent;">/</div>
                        </div>
                        <div class="widget-content-right">
                        <div class="widget-numbers text-white">
                   
                            <span style="font-size: 25px;" >
                               <?php echo $n++; ?>
                            </span> 
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </a>
 <?php } } else { ?>
                    <h5 style="color: red;">Exam Not Attempted!</h5>
                 <?php }   ?>
            </div>





        </div> 
        </div>
<!--         <div class="row col-md-12 float-left">
          <div class="main-card mb-3 card">
                <div class="card-body">
                    <?php //if($count>0){ ?>
                  <h5 class="card-title">Your Answer's</h5>

                 <?php //} else { ?>
                    <h5 style="color: red;">Exam Not Attempt!</h5>
                 <?php //}   ?>
                </div>
            </div>
        </div> -->


    </div>


    </div>
</div>
