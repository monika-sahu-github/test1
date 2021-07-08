<?php 
  // $ds4td = $_GET['ds4td'];
   //$exam_id=openssl_decrypt($_REQUEST['ds4td'], $ciphering,  
//$key, $options, $iv);
$exam_id = 0;
    $selExam = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$exam_id' ")->fetch(PDO::FETCH_ASSOC); 
 //echo "SELECT * FROM exam_answers WHERE axmne_id='$exmneId' AND is_finel_sub='1' group by exam_id desc";    
    $selQuest = $conn->query("SELECT * FROM exam_answers WHERE axmne_id='$exmneId' AND is_finel_sub='1' group by exam_id  order by exans_id desc");
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
                        <?php if(empty($selExam)){ 
                            return 0;
                        }else{
                            echo $selExam['ex_title']; } ?>
                          <div class="page-title-subheading">
                            <?php //echo $selExam['ex_description']; ?>
                          </div>

                    </div>
                </div>
            </div>
        </div>  

        <div class="row col-md-12">
          <h1 class="text-primary">RESULT</h1>
        </div>
        <div class="row" >
                    <div class="col-md-12" >
 <?php $count; if($count>0){ 
     $ii = 1;
 while ($selExamRow = $selQuest->fetch(PDO::FETCH_ASSOC)) {
$exans_created = $selExamRow['exans_created'];
// $date = $exans_created;
// $dateArr = explode("-",$date);
// $y = $dateArr[0];
// $m=$dateArr[1];
// $d=$dateArr[2];
$exam_name = $cmn->getvalfield($conn,"exam_tbl","ex_title","ex_id = '$selExamRow[exam_id]'");
//$sel_exam_timewise = $conn->query("SELECT * FROM exam_answers WHERE exam_id='$exam_id' AND axmne_id='$exmneId' AND is_finel_sub='1' and YEAR(exans_created)='$y' and MONTH(exans_created)='$m' and DAY(exans_created)='$d' group by exam_session order by exans_id desc");
 ?>        <a href="home.php?page=mock_results&sdoifrdgdfHJH=<?php echo openssl_encrypt($selExamRow['exam_id'], $ciphering, 
$key, $options, $iv); ?>&SDJFOI9SDF=<?php echo openssl_encrypt($selExamRow['exans_created'], $ciphering, 
$key, $options, $iv); ?>">
           <div class="col-md-3 float-left">
            <div class="card mb-3 widget-content bg-happy-green">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading"><h5><?php echo $exam_name; ?></h5></div>
                        <div class="widget-subheading" style="text-align: center;">Date -  <?php echo date('d-M-Y',strtotime($selExamRow['exans_created'])); ?></div>
                        
                        </div>
                        <div class="widget-content-right">
                        <div class="widget-numbers text-white">
                          
                        </div>
                    </div>
                    <center>
                        <?php if($ii==1){ ?><span id="rece" style="float: unset !important;margin-left: 0px !important;padding: 4px !important;" >Recent Exam</span><?php } ?></center>
                </div>
            </div>
            </div> </a>
           
 <?php $ii++; } } else { ?>
                    <h5 style="color: red;">Exam Not Attempt!</h5>
                 <?php }   ?>
            </div>
</div> 
        </div>
</div>
</div>
</div>
