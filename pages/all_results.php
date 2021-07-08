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
                    <div>Practice Test Results
                        <?php //echo $selExam['quehead']; ?>
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
                    <a href="#" class="anchr-tagcolor">Result</a><a href="#" class="anchr-tagcolor">All Results</a><a href="home.php?page=all_results&source=menu" class="anchr-tagcolor"><?php echo "Practice Test Results"; ?></a>
                <?php }else{?>
            <a href="home.php?page=dashboard" class="anchr-tagcolor">Dashboard</a><a href="home.php?page=all_results&source=dashboard" class="anchr-tagcolor"><?php echo "Practice Test Results"; ?></a><?php } ?>
    </div> <div class="" style="background: white;border: 3px solid #375176;padding: 0px;">
        <div class="row col-md-12 mb-3"></div>
        <div class="row" >
                    <div class="col-md-12" >
<?php 

$selExamm = $conn->query("SELECT * FROM subject_quehead WHERE 1 ORDER BY id DESC ");
//echo ">>>".$selExamm->rowCount();
if($selExamm->rowCount() > 0)
{ 
while ($selExamRow = $selExamm->fetch(PDO::FETCH_ASSOC)) {
$queheadid = $selExamRow['id'];
$nummm = $cmn->getvalfield($conn,"exam_answers","count(*)","axmne_id = '$exmneId' and sub_subjecthead_id = '$queheadid' and is_finel_sub = 1"); 
if($nummm>0){               
?>      <a href="home.php?page=result_date&id=<?php echo $selExamRow['id']; ?>&source=<?php echo $val1; ?>">
        <div class="col-md-4 float-left">
            <div class="card mb-3 widget-content bg-happy-green">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading"><h5>  <?php echo $selExamRow['quehead']; ?></h5>
                            Score:
                            <?php $totExam = $conn->query("SELECT COUNT(*) as allque FROM exam_answers  WHERE sub_subjecthead_id='$queheadid' and axmne_id = '$exmneId'")->fetch(PDO::FETCH_ASSOC);
                $over  = $totExam['allque']; 
            if($over>0){
                            $selScore = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id 
                                AND eqt.exam_answer_id = ea.exam_answer_id  
                                WHERE ea.axmne_id='$exmneId' AND ea.sub_subjecthead_id='$queheadid' AND ea.is_finel_sub='1' order by eqt_id asc ");
        $score = $selScore->rowCount();
        $ans = round($score / $over * 100,2);
        echo $ans," %";
        } ?>
                        </div>
                        <div class="widget-subheading" style="color: transparent;">/</div>
                        </div>
                        <div class="widget-content-right">
                        <div class="widget-numbers text-white">
                             
                        </div>
                    </div>
                </div>
            </div>
            </div></a>
<?php   } } } else { ?>
                    <h5 style="color: red;">Exam Not Attempt!</h5>
                 <?php }   ?>
            </div>
</div> </div>
        </div>
</div>
</div>
</div>
