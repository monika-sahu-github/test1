 <?php 
    $examId = $_GET['id'];
    $date = $_GET['date_time'];
    $dateArr = explode("-", $date);
    $y = $dateArr[2];
    $m = $dateArr[1];
    $d = $dateArr[0];
    $selExam = $conn->query("SELECT * FROM subject_quehead WHERE id='$examId' ")->fetch(PDO::FETCH_ASSOC); 
    $exam_session = $_GET['session'];
    $totExam = $conn->query("SELECT COUNT(*) as allque FROM exam_answers WHERE sub_subjecthead_id='$examId' and axmne_id = '$exmneId' and exam_session = '$exam_session' ")->fetch(PDO::FETCH_ASSOC); 
$examne_id =  $_SESSION['examineeSession']['exmne_id'];
// $selQuest = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id WHERE eqt.sub_subjecthead_id='$examId' AND ea.axmne_id='$exmneId' AND ea.is_finel_sub='1' order by eqt_id asc");
    
    // $selQuest = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id WHERE eqt.sub_subjecthead_id='$examId' AND ea.axmne_id='$exmneId' AND ea.is_finel_sub='1' and YEAR(ea.exans_created)='$y' and MONTH(ea.exans_created)='$m' and DAY(ea.exans_created)='$d' and ea.exam_session = '$exam_session' order by eqt_id asc");
   // echo "SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id WHERE eqt.sub_subjecthead_id='$examId' AND ea.axmne_id='$exmneId' AND ea.is_finel_sub='1' and ea.exam_session = '$exam_session' order by eqt_id asc";
if(isset($_REQUEST['correct'])){
        $selQuest = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id AND eqt.exam_answer_id = ea.exam_answer_id  WHERE ea.axmne_id='$exmneId' AND ea.sub_subjecthead_id='$examId' AND ea.is_finel_sub='1' and ea.exam_session = '$exam_session' order by eqt_id asc ");
    }
    else if(isset($_REQUEST['wrong'])){
         $selQuest = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id AND eqt.exam_answer_id != ea.exam_answer_id  WHERE ea.axmne_id='$exmneId' AND ea.sub_subjecthead_id='$examId' AND ea.is_finel_sub='1' and ea.exam_session = '$exam_session' order by eqt_id asc ");
    }
    else{ 
    $condition = '';
if(isset($_REQUEST['filter']) ){
       $condition = "and ea.answer_status = ".$_REQUEST['filter'];
      }
if(isset($_REQUEST['filter1']) and isset($_REQUEST['filter2'])  ){
       $condition = "and (ea.answer_status=".$_REQUEST['filter1']." OR ea.answer_status =".$_REQUEST['filter2'].")";
      }

    $selQuest = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id WHERE eqt.sub_subjecthead_id='$examId' AND ea.axmne_id='$exmneId' AND ea.is_finel_sub='1' and ea.exam_session = '$exam_session' $condition order by ea.exans_id asc"); 
    }
    
    // echo "SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id WHERE eqt.sub_subjecthead_id='$examId' AND ea.axmne_id='$exmneId' AND ea.is_finel_sub='1' and ea.exam_session = '$exam_session' $condition order by ea.exans_id asc";
    
$count = $selQuest->rowCount();
$i = 1;

$time_in_12_hour_format  = date("g:i A", strtotime($_REQUEST['date_time']));
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
        /*border: 1px solid #90939c !important;*/
    }
    .bg-premium-dark {
    background-image: linear-gradient(to right, #8e15158c 0%, #29b3e8 100%) !important;
}
.card{
    border-radius: 0px !important;
}
#main_maincard{
    width:100%;
}
.alert-feedback{
background-color: white;
border-color: #cec9c9;
}
@media only screen and (max-width: 600px) {
p{
  width: 100% !important;
}
table 
{
    table-layout:fixed;
    width:100%;
}
}
div.change:hover{
    background-color: lightblue;
}
b{
    font-size: 12px !important;
}

</style>
<div class="app-main__outer">
<div class="app-main__inner">
    <div id="refreshData">
    <div class="col-md-12">
        <div class="app-page-title" style="padding: 10px;">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div>
                        <b><p style="font-size: 14px;"><?php echo $selExam['quehead']; ?></p></b><b><p style="font-size: 14px;"> <?php echo date('d-m-Y',strtotime($_REQUEST['date_time']))." ".$time_in_12_hour_format; ?></p></b>
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
                    <a href="#" class="anchr-tagcolor">Result</a><a href="#" class="anchr-tagcolor">All Results</a><a href="home.php?page=all_results&source=menu" class="anchr-tagcolor">Practice Test Result</a><a href="home.php?page=result_date&id=<?php echo $examId; ?>&source=menu"><?php echo $selExam['quehead']; ?></a><a href="#" class="anchr-tagcolor">Result</a>
                <?php }else{?>
    <a href="home.php?page=dashboard" class="anchr-tagcolor">Dashboard</a><a href="home.php?page=all_results&source=dashboard" class="anchr-tagcolor">Practice Test Result</a><a href="home.php?page=result_date&id=<?php echo $examId; ?>&source=dashboard"><?php echo $selExam['quehead']; ?></a><a href="home.php?page=result&id=<?php echo $examId; ?>&date_time=<?php echo $date; ?>&session=<php? echo $exam_session; ?>&source=dashboard" class="anchr-tagcolor">Result</a> 
<?php }?>
</div>

 <style>
/* width */
::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px #ccc; 
  border-radius: 20px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: gray; 
  border-radius: 20px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: blue; 
}
</style><div class="col-md-12">
    <div class="row">
        <div class="col-md-8 mb-3 float-left">
            <div class="clear-fix">&nbsp;</div>
            <div>
                <!-- style="max-height:800px; overflow-y: scroll;" -->
          <div class="main-card mb-3 card" id="main_maincard" style="padding: 0.1rem !important;     border: 1px solid #90939c;">

                <div class="card-body mb-3">
                    <?php if($count>0){ ?>
                  <h5 class="card-title mb-3">Your Answers</h5>
              <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
                    <?php 
                      while ($selQuestRow = $selQuest->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr>
                          <td>
                            <b><p><?php echo $i++; ?>) <?php echo $selQuestRow['exam_question']; ?></p></b>
                             Answers : <br><br>
                              <!-- <?php 
                                if($selQuestRow['exam_answer'] != $selQuestRow['exans_answer'])
                                { ?>
                                  <span style="color:red"><?php echo $selQuestRow['exans_answer']; ?></span>
                                <?PHP }
                                else
                                { ?>
                                  <span class="text-success"><?php echo $selQuestRow['exans_answer']; ?></span>
                                <?php }
                               ?> -->
                                         <?php $numm = 1; 
                        //foreach ($exam_chArr as $value) {
                                         $explanation = $selQuestRow['explanation'];
                                         //echo $selected_ans = $selQuestRow['exam_answer_id'];
                                         $queheadid = $examId;
                                         $eqt_id = $selQuestRow['eqt_id'];
                                         $selected_ans = $cmn->getvalfield($conn,"exam_question_tbl","exam_answer_id","eqt_id='$eqt_id'");
                                         $selected = 'checked';
                                         $option_sql = "select id as id, answer as answer from exam_answers_option where quehead_id='$queheadid' and eqt_id = '$eqt_id'";
                                         $exans_answer = $cmn->getvalfield($conn,"exam_answers","exam_answer_id","quest_id='$eqt_id' and axmne_id = '$exmneId' and sub_subjecthead_id = '$queheadid' and exam_session = '$exam_session'");
                                        if($selected_ans==$exans_answer && $selected_ans!=0 && $exans_answer!=0){
                                            $bootc = 'success';
                                            $txt = 'Correct!'; 
                                             $imgg = 'rightimg3.png'; 
                                        } else if($exans_answer!=0){
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

                        if($selected_ans==$exam_chArr['id']){ 
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
                        } else  if($exans_answer==$exam_chArr['id'] && $exans_answer!=0){
                            //echo "ok";
                          $backgroundd = 'background: #c93335';
                          $color = 'color: white';
                          $img = 'wrongimg.jpg';
                        
                        }  if($exans_answer==0){
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
    <!-- <input type="radio" <?php if($exans_answer==$exam_chArr['answer']){ echo "checked"; }  ?> name="answers<?php echo $eqt_id; ?>" required="" value="<?php echo $exam_chArr['answer']; ?>"> -->
    <!-- <span style="border: 1px solid #00000040;border-radius: 2px;
    padding: 3px;"><?php echo $x; ?></span> -->
    (<?php echo $x; ?>)
     <?php echo $exam_chArr['answer']; ?><span style="float: right;" > <img style="height: 17px;
    margin-top: -4px;" src="<?php echo $img;  ?>"></span></p>
                       <?php $numm++; $x++; } if($exans_answer!=0){  ?>

<!--                            <div class="alert alert-<?php echo $bootc; ?>">
    <img style="height: 30px;
    margin-top: -4px;" src="<?php echo $imgg;  ?>"> <strong><?php echo $txt;  ?></strong>
  </div> --> 
 
<div class="panel-group" id="accordionn<?php echo $eqt_id; ?>">
  <div class="panel panel-default">
    <a data-toggle="collapse" style="text-decoration: none;" data-parent="#accordion<?php echo $eqt_id; ?>" href="#collapseOnee<?php echo $eqt_id; ?>">
    <div class="panel-heading alert alert-<?php echo $bootc; ?>">
      <h4 class="panel-title">
        
          <img style="height: 30px;
    margin-top: -4px;" src="<?php echo $imgg;  ?>"> <strong style="font-size: 12px;<?php if($txt=='Incorrect!'){ ?>color: #71132a!important;<?php  } else {?>color: #1e6641 !important;<?php } ?>"><?php echo $txt;  ?></strong>
        
      </h4>
    </div>
    </a>
   
  </div>
</div>
<?php if($explanation!=""){ ?>
<br>
<div class="panel-group" id="accordion<?php echo $eqt_id; ?>">
  <div class="panel panel-default">
    <a data-toggle="collapse" style="text-decoration: none;" data-parent="#accordion<?php echo $eqt_id; ?>" href="#collapseOne<?php echo $eqt_id; ?>">
   <!--  <div class="panel-heading " style="background: #16aaff;color: white;padding: 4px;border-radius: 5px;
    ">
      <h4 class="panel-title">
        
 <strong style="font-size: 12px;"><?php echo "Explanation ";  ?></strong>
        
      </h4>
    </div> -->
    </a>
    <div id="collapseOnex<?php echo $eqt_id; ?>" style="display: block;" class="panel-collapse collapse alert alert-info">
      <div class="panel-body">
      <strong>  Explanation :</strong><br><?php echo $explanation; ?>
      </div>
    </div>
  </div>
</div>


<?php } } else { ?>
<div class="panel-group" id="accordionc<?php echo $eqt_id; ?>">
  <div class="panel panel-default">
    <a data-toggle="collapse" style="text-decoration: none;" data-parent="#accordion<?php echo $eqt_id; ?>" href="#collapseOnee<?php echo $eqt_id; ?>">
    <div class="panel-heading " style="background: #69c6911f;color: black;padding: 4px;border-radius: 5px;
    ">
      <h4 class="panel-title">
        
          <img style="height: 30px;
    margin-top: -4px;" src="<?php echo $imgg;  ?>"> <strong style="font-size: 12px;"><?php echo "Not Attempted";  ?></strong>
        
      </h4>
    </div>
    </a>
  </div>
</div>
<?php if($explanation!=""){ ?>
<br>
<div class="panel-group" id="accordion<?php echo $eqt_id; ?>">
  <div class="panel panel-default">
    <a data-toggle="collapse" style="text-decoration: none;" data-parent="#accordion<?php echo $eqt_id; ?>" href="#collapseOne<?php echo $eqt_id; ?>">
   <!--  <div class="panel-heading " style="background: #16aaff;color: white;padding: 4px;border-radius: 5px;
    ">
      <h4 class="panel-title">
        
          <img style="height: 30px;
    margin-top: -4px;" src="<?php echo $imgg;  ?>"> <strong style="font-size: 12px;"><?php echo "Explanation ";  ?></strong>
        
      </h4>
    </div> -->
    </a>
    <div id="collapseOnex<?php echo $eqt_id; ?>" style="display: block;" class="panel-collapse collapse alert alert-info">
      <div class="panel-body">
      <strong>  Explanation :</strong> <?php echo $explanation; ?>
      </div>
    </div>
  </div>
</div>
<?php } } ?>
  <div class="panel-group" id="accordion<?php echo $eqt_id; ?>">
  <div class="panel panel-default">
    <a data-toggle="collapse" style="text-decoration: none;" data-parent="#accordion<?php echo $eqt_id; ?>" href="#collapseOnexz<?php echo $eqt_id; ?>">
     <div class="panel-heading " style="background-color: #d8d8d8;
    border-color: #cec9c9;color: black;padding: 4px;border-radius: 5px;
    ">
      <h4 class="panel-title">
        
       <strong style="font-size: 12px;"><?php echo "Feedback ";  ?></strong>
        
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
<!--   <div class="alert alert-info" style="height: 175px;
    overflow-y: scroll;" >
    <strong>Explanation - </strong> <?php echo $explanation; ?>
  </div> -->
                          </td>
                        </tr>
                      <?php }
                     ?>
                   </table>
                 <?php } else { ?>
                    <h5 style="color: red;">Exam Not Attempted!</h5>
                 <?php }   ?>
                </div>
            </div></div>
        </div>
        <div class="col-md-4">
            <div class="col-md-12 clear-fix">&nbsp;</div>
            <div  class="col-md-12" style="background: white;border: 3px solid #375176;">
            <div class="mb-3"></div>
            <div class="col-md-12 card mb-3">
                <div class="card mb-3"><center><h5>Score</h5></center></div>
            
            <?php
            $examtime = $cmn->getvalfield($conn,"exam_answers","examtime","axmne_id = '$exmneId' and sub_subjecthead_id = '$examId' and exam_session = '$exam_session'"); 
            $selScore = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id AND eqt.exam_answer_id = ea.exam_answer_id  WHERE ea.axmne_id='$exmneId' AND ea.sub_subjecthead_id='$examId' AND ea.is_finel_sub='1' and ea.exam_session = '$exam_session' order by eqt_id asc ");
            $value = $selScore->rowCount();
            $over  = $totExam['allque'];
            if($over>0){
                                    $score = $selScore->rowCount();
                                    $ans = round($score / $over * 100,2);
            ?>
              <div class="row mb-3"><div class="col-md-4 card" style="background-color: lightblue;"><?php echo "<b>","$ans"; echo "%","</b>"; } ?></div>
              <div class="col-md-8 card"><b><?php echo $value; ?> / <?php echo $over,""; ?></b></div></div>
                <!-- <center><h6><b style="background-color: yellow;"> 
                  </b></h6></center>-->
            
             <div class="row mb-3"> <div class="col-md-5 card" style="background-color: lightblue;"><b><?php echo $examtime; ?></b></div> <div class="col-md-7">Total Time Duration </div>
             <!-- <center><b style="background-color: yellow;"></b></center></div> -->
           </div>
             <?php 
                               $tot_skip = $cmn->getvalfield($conn,"exam_answers","count(*)","axmne_id = '$exmneId' and sub_subjecthead_id = '$examId' and answer_status = 2 and exam_session = '$exam_session'");
                               $tot_not_att = $cmn->getvalfield($conn,"exam_answers","count(*)","axmne_id = '$exmneId' and sub_subjecthead_id = '$examId' and (answer_status = 3 OR answer_status = 0) and exam_session = '$exam_session'");
                               $tot_att = $cmn->getvalfield($conn,"exam_answers","count(*)","axmne_id = '$exmneId' and sub_subjecthead_id = '$examId' and answer_status = 1 and exam_session = '$exam_session'");
                              $total = $totExam['allque'];
                             ?>
            <a <?php if($total > 0){?> href="home.php?page=result&id=<?php echo $examId;?>&date_time=<?php echo $date;?>&session=<?php echo $exam_session;?>&source=<?php echo $val1; ?>"<?php }else{?>href=""<?php } ?>>
            <div class="row mb-3">
            <div class="col-md-4 card <?php if($total > 0){?>change<?php }else{} ?>" style="background-color: lightgrey;"><h4><b><?php echo $total; ?></b></h4></div></a><div class="col-md-8 mb-3">Total Answers</div></div>

            <?php
                             $selScore = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id AND eqt.exam_answer_id = ea.exam_answer_id  WHERE ea.axmne_id='$exmneId' AND ea.sub_subjecthead_id='$examId' AND ea.is_finel_sub='1' and ea.exam_session = '$exam_session' order by eqt_id asc ");
                             $value = $selScore->rowCount(); 
                             ?>
            <a <?php if($value > 0){?>href="home.php?page=result&id=<?php echo $examId;?>&date_time=<?php echo $date;?>&session=<?php echo $exam_session;?>&correct=1&source=<?php echo $val1; ?>"<?php }else{?>href=""<?php } ?>>
           
            <div class="col-md-4 card mb-3"><h4><b><?php echo $value; ?></b></h4></div></a>
            <div class="col-md-8 card <?php if($value > 0){?>change<?php }else{}?> mb-3">Correct Answers</div>

            <?php
                             $selScore = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id AND eqt.exam_answer_id = ea.exam_answer_id  WHERE ea.axmne_id='$exmneId' AND ea.sub_subjecthead_id='$examId' AND ea.is_finel_sub='1' and ea.exam_session = '$exam_session' order by eqt_id asc ");
 
                             $marks = $selScore->rowCount();
                             $over  = $totExam['allque'];
                             $wrong_ans = $over - $marks; ?>
            <a <?php if($wrong_ans >0){?>href="home.php?page=result&id=<?php echo $examId;?>&date_time=<?php echo $date;?>&session=<?php echo $exam_session;?>&wrong=1&source=<?php echo $val1; ?>"<?php }else{?>href=""<?php } ?>>
            <div class="col-md-12 card card-panel <?php if($wrong_ans > 0){?>change<?php }else{}?> mb-3">Wrong Answers
            <div class="col-md-6"><?php echo $wrong_ans; ?></div></div></a>

            <a <?php if($tot_att >0){?>href="home.php?page=result&id=<?php echo $examId; ?>&date_time=<?php echo  $date; ?>&session=<?php echo $exam_session; ?>&filter=1&source=<?php echo $val1; ?>"<?php }else{?>href=""<?php } ?>>
            <div class="col-md-12 card card-panel <?php if($tot_att > 0){ ?>change<?php }else{}?> mb-3">Attempted Answers
            <div class="col-md-6"><?php echo $tot_att;?></div></div></a>

            <a <?php if($tot_not_att > 0){?>href="home.php?page=result&id=<?php echo $examId; ?>&date_time=<?php echo  $date; ?>&session=<?php echo $exam_session; ?>&filter1=3&filter2=0&source=<?php echo $val1; ?>"<?php }else{ ?>href=""<?php }?>>
            <div class="col-md-12 card card-panel <?php if($tot_not_att > 0){?>change<?php }else{}?> mb-3">Not Attempted Answers
            <div class="col-md-6"></div><?php echo $tot_not_att;?></div></a>

            <a <?php if($tot_skip >0){?>href="home.php?page=result&id=<?php echo $examId; ?>&date_time=<?php echo  $date; ?>&session=<?php echo $exam_session;?>&filter=2&source=<?php echo $val1; ?>"<?php }else{ ?>href=""<?php }?>>
            <div class="col-md-12 card card-panel <?php if($tot_skip > 0){?>change<?php }else{}?> mb-3">Skipped Answers
            <div class="col-md-6"><?php echo $tot_skip;  ?></div></div></a>

        </div></div></div>
    </div>
</div>
</div>
</div>
</div>