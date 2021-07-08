 <?php 
$examId=$exam_id=openssl_decrypt($_REQUEST['sdoifrdgdfHJH'], $ciphering,  
$key, $options, $iv);
$schedule_date=openssl_decrypt($_REQUEST['SDJFOI9SDF'], $ciphering,  
$key, $options, $iv);
    $selExam = $conn->query("SELECT * FROM exam_tbl WHERE ex_id='$exam_id' ")->fetch(PDO::FETCH_ASSOC); 
   $totExam = $conn->query("SELECT COUNT(*) as allque FROM exam_answers WHERE exam_id='$exam_id' and axmne_id = '$exmneId' ")->fetch(PDO::FETCH_ASSOC); 
    $selQuest = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id WHERE ea.exam_id='$exam_id' AND ea.axmne_id='$exmneId' AND ea.is_finel_sub='1' order by ea.exans_id asc"); 
    $count = $selQuest->rowCount();
    //$schedule_date = $cmn->getvalfield($conn,"test_table","schedule_date","exam_id =");
$i = 1;
$examne_id =  $_SESSION['examineeSession']['exmne_id'];
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
#main_maincard{
    width:100%;
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
                        <strong><?php echo $selExam['ex_title'];?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <strong><?php echo " Date - ".date("d-M-Y g:i A", strtotime($schedule_date)); ?></b></strong>
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
            <div class="col-md-4 float-left">
            <div class="card mb-3 widget-content bg-night-fade">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading"><h5>Score</h5></div>
                        <div class="widget-subheading" style="color: transparent;">/</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white">
                            <?php
                                //$selScore = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id AND eqt.exam_answer_id = ea.exam_answer_id  WHERE ea.axmne_id='$exmneId' AND ea.exam_id='$exam_id' AND ea.is_finel_sub='1' and ea.answer_status = 1 order by eqt_id asc ");
                                $selScore = $conn->query("SELECT eqt_id FROM exam_question_tbl WHERE eqt_id in (SELECT quest_id FROM exam_answers WHERE exam_id = '$exam_id' AND axmne_id = '$exmneId' and is_finel_sub = 1 AND answer_status=1 AND is_mock = 1)");
                                
                                 $selScore = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id AND eqt.exam_answer_id = ea.exam_answer_id  WHERE ea.axmne_id='$exmneId' AND ea.exam_id='$exam_id' AND ea.is_finel_sub='1' and ea.answer_status = 1 order by eqt_id asc ");
                                 $score = $selScore->rowCount();
                            ?>
                            <span style="font-size: 25px;">
                                <?php //echo $selScore->rowCount(); 
                                echo $score; ?>
                                <?php 
                                    $over  = $totExam['allque'];
                                 ?> / <?php echo $over; ?>
                            </span> 
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <div class="col-md-4 float-left">
            <div class="card mb-3 widget-content bg-happy-green">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading"><h5>Percentage</h5></div>
                        <div class="widget-subheading" style="color: transparent;">/</div>
                        </div>
                        <div class="widget-content-right">
                        <div class="widget-numbers text-white">
                            <?php  if($over>0){
                                //echo "SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id AND eqt.exam_answer_id = ea.exam_answer_id  WHERE ea.axmne_id='$exmneId' AND ea.exam_id='$exam_id' AND ea.is_finel_sub='1' and ea.answer_status = 1 order by eqt_id asc ";
                                $selScore = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id AND eqt.exam_answer_id = ea.exam_answer_id  WHERE ea.axmne_id='$exmneId' AND ea.exam_id='$exam_id' AND ea.is_finel_sub='1' and ea.answer_status = 1 order by eqt_id asc ");
                            
                            ?>
                            <span style="font-size: 25px;" >
                                <?php 
                                    $score = $selScore->rowCount();
                                    $ans = round($score / $over * 100,2);
                                    echo "$ans";
                                    echo "%";
                                    }
                                 ?>
                            </span> 
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <div class="col-md-4 float-left"> 
            <div class="card mb-3 widget-content bg-premium-dark">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading"><h5></h5></div>
                        <div class="widget-subheading" style="color: transparent;">/</div>
                        </div>
                        <div class="widget-content-right" style="">
                            <?php 
                               $tot_skip = $cmn->getvalfield($conn,"exam_answers","count(*)","axmne_id = '$exmneId' and exam_id = '$exam_id' and answer_status = 2");
                               $tot_not_att = $cmn->getvalfield($conn,"exam_answers","count(*)","axmne_id = '$exmneId' and exam_id = '$exam_id' and (answer_status = 3 OR answer_status = 0)");
                               $tot_att = $cmn->getvalfield($conn,"exam_answers","count(*)","axmne_id = '$exmneId' and exam_id = '$exam_id' and answer_status = 1");
                               $examtime = $cmn->getvalfield($conn,"exam_answers","examtime","axmne_id = '$exmneId' and exam_id = '$exam_id'");
                             ?>
                            <table class="table table-borderless table-condensed" style="margin-top: -56px;" >
                                <thead><tr><th>Skipped</th><th>Not Attempted</th><th>Attempted</th></tr></thead>
                                <tbody>
                                    <tr><td><?php echo $tot_skip;  ?></td><td><?php echo $tot_not_att;  ?></td><td><?php echo $tot_att;  ?></td></tr>
                                </tbody>
                            </table>
                            Total Time Duration  - <?php echo $examtime; ?>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        </div>
        <div class="row col-md-12 float-left">
          <div class="main-card mb-3 card" id="main_maincard">
                <div class="card-body">
                    <?php if($count>0){ ?>
                  <h5 class="card-title">Your Answer's</h5>
              <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
                    <?php 
                      while ($selQuestRow = $selQuest->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <td>
                            <b><p><?php echo $i++; ?>) <?php echo $selQuestRow['exam_question']; ?></p></b>
                             Answers : <br><br>
                                         <?php $numm = 1; 
                        //foreach ($exam_chArr as $value) {
                                         $explanation = $selQuestRow['explanation'];
                                         //echo $selected_ans = $selQuestRow['exam_answer_id'];
                                         $queheadid = $exam_id;
                                        $eqt_id = $selQuestRow['eqt_id'];
                                         $selected_ans = $cmn->getvalfield($conn,"exam_question_tbl","exam_answer_id","eqt_id='$eqt_id'");
                                         $selected = 'checked';
                                         $option_sql = "select id as id, answer as answer from exam_answers_option where eqt_id = '$eqt_id'";
                                         $exans_answer = $cmn->getvalfield($conn,"exam_answers","exam_answer_id","quest_id='$eqt_id' and axmne_id = '$exmneId' and exam_id = '$queheadid' and is_mock =1");
                                         $answer_status = $cmn->getvalfield($conn,"exam_answers","answer_status","quest_id='$eqt_id' and axmne_id = '$exmneId' and exam_id = '$queheadid' and is_mock =1");
                                        if($selected_ans==$exans_answer && $selected_ans!=0 && $exans_answer!=0 && $answer_status==1){
                                            $bootc = 'success';
                                            $txt = 'Correct!'; 
                                             $imgg = 'rightimg3.png'; 
                                        } else if($selected_ans!=$exans_answer && $selected_ans!=0 && $exans_answer!=0 && $answer_status==1){
                                            $bootc = 'danger';
                                            $txt = 'Incorrect!'; 
                                            $imgg = 'wrng2.png'; 
                                        } else {
                                            $bootc = '';
                                            $txt = ''; 
                                            $imgg = ''; 
                                        }

    $option_result = $conn->query($option_sql); $x = 'a'; 
                        while ($exam_chArr = $option_result->fetch(PDO::FETCH_ASSOC)) {
                            $backgroundd = '';
                            $color = '';
                            $img = '';
                             
                        //    if($exans_answer!=$exam_chArr['answer'] && $exans_answer!=''){
                        //      $backgrounddcc = 'background: #98a79526';
                        // //$bootc = 'success';
                        //   $colorcc = 'color: black';
                        //   $imgcc = 'rightimg2.png';
                        //   //$txt = 'Correct!';
                        //    }

                        if($selected_ans==$exam_chArr['id'] && $answer_status==1){ 
                          $is_right = $cmn->getvalfield($conn,"exam_answers_option","is_right","id='$selected_ans'");
                          if($is_right!=0){
                        $backgroundd = 'background: #22b14c';
                        //$bootc = 'success';
                          $color = 'color: white';
                          $img = 'rightimg.png';
                          }
                          if($txt=='Incorrect!'){
                            $backgroundd = 'background: #69c6911f';
                        //$bootc = 'success';
                          $color = 'color: black';
                          $img = 'rightimg2.png';
                          }
                          //$txt = 'Correct!';
                        } else  if($exans_answer==$exam_chArr['id'] && $exans_answer!=0 && $answer_status==1){
                            //echo "ok";
                          $backgroundd = 'background: #c93335';
                          $color = 'color: white';
                          $img = 'wrongimg.jpg';
                        
                        }  if($exans_answer==0 || $answer_status == 2 || $answer_status == 3){
                            if($selected_ans==$exam_chArr['id'] && $selected_ans!=0){ 
                        $backgroundd = 'background: #69c6911f';
                        //$bootc = 'success';
                          $color = 'color: black';
                          $img = 'rightimg2.png';
                          //$txt = 'Correct!';
                        }
                        } 
                        
 
                        ?>
                            <p style="<?php echo $backgroundd.";".$color; ?>;padding: 4px;border-radius: 5px;
    " >
    <!-- <span style="border: 1px solid #00000040;border-radius: 2px;
    padding: 3px;"><?php echo $x; ?></span> -->
    (<?php echo $x; ?>) 
    <?php echo $exam_chArr['answer']; ?><span style="float: right;" > <img style="height: 17px;
    margin-top: -4px;" src="<?php echo $img;  ?>"></span></p>
                       <?php $numm++; $x++; } if($answer_status==1){  ?>
<div class="panel-group" id="accordionn<?php echo $eqt_id; ?>">
  <div class="panel panel-default">
    <a data-toggle="collapse" style="text-decoration: none;" data-parent="#accordionn<?php echo $eqt_id; ?>" href="#collapseOnee<?php echo $eqt_id; ?>">
    <div class="panel-heading alert alert-<?php echo $bootc; ?>">
      <h4 class="panel-title">
        
          <img style="height: 30px;
    margin-top: -4px;" src="<?php echo $imgg;  ?>"> <strong style="font-size: 15px;<?php if($txt=='Incorrect!'){ ?>color: #71132a!important;<?php  } else {?>color: #1e6641 !important;<?php } ?>"><?php echo $txt;  ?></strong>
        
      </h4>
    </div>
    </a>
    <?php if($explanation!=""){ ?>
    <div id="collapseOneae<?php echo $eqt_id; ?>" class="panel-collapsse collapsse alert alert-info">
      <div class="panel-body">
      <strong>Explanation - </strong> <?php echo $explanation; ?>
      </div>
    </div>
<?php } ?>
  </div>
</div>

<?php } else { ?>
<div class="panel-group" id="accordionn<?php echo $eqt_id; ?>">
  <div class="panel panel-default">
    <a data-toggle="collapse" style="text-decoration: none;" data-parent="#accordionnn<?php echo $eqt_id; ?>" href="#collapseOnee<?php echo $eqt_id; ?>">
    <div class="panel-heading " style="background: #69c6911f;color: black;padding: 4px;border-radius: 5px;
    ">
      <h4 class="panel-title">
        
         <!--  <img style="height: 30px;
    margin-top: -4px;" src="<?php echo $imgg;  ?>"> --> 
    <strong style="font-size: 15px;"><?php echo "Not Attempted";  ?></strong>
        
      </h4>
    </div>
    </a> 
    <?php if($explanation!=""){ ?> 
    <div id="collapseOneea<?php echo $eqt_id; ?>" class="panel-collapse collapsse alert alert-info">
      <div class="panel-body">
      <strong>Explanation - </strong> <?php echo $explanation; ?>
      </div>
    </div>
<?php } ?>

<?php } ?>  
  <div class="panel-group" id="accordion<?php echo $eqt_id; ?>">
  <div class="panel panel-default">
    <a data-toggle="collapse" style="text-decoration: none;" data-parent="#accordion<?php echo $eqt_id; ?>" href="#collapseOnexz<?php echo $eqt_id; ?>">
     <div class="panel-heading " style="background-color: #d8d8d8;
    border-color: #cec9c9;color: black;padding: 4px;border-radius: 5px;
    ">
      <h4 class="panel-title">
        
       <strong style="font-size: 15px;"><?php echo "Feedback ";  ?></strong>
        
      </h4>
    </div> 
    </a>
    <div id="collapseOnexz<?php echo $eqt_id; ?>" style=" " class="panel-collapse collapse alert alert-feedback">
      <div class="panel-body">
        <?php 
             $feedback = $cmn->getvalfield($conn,"question_feedback","feedback","question_id = '$eqt_id' and sub_id = '$examId' and examne_id = '$examne_id'");
        ?>
      <textarea class="form-control" id="feedback<?php echo $eqt_id; ?>" value="<?php echo $feedback; ?>"><?php echo $feedback; ?></textarea><br>
      <input type="submit" name="submit" class="btn btn-success" id="submit<?php echo $eqt_id; ?>" onclick="send_feed(<?php echo $eqt_id; ?>,<?php echo $examId; ?>);" >
      </div>
    </div>
  </div> 
</div>
  </div>
</div>

                          </td>
                        </tr>
                      <?php }
                     ?>
                   </table>
                 <?php } else { ?>
                    <h5 style="color: red;">Exam Not Attempt!</h5>
                 <?php }   ?>
                </div>
            </div>
        </div>


    </div>


    </div>
</div>
