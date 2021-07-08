<?php
 $page_name = "Dashboard"; 

  ?>

   <?php 

    // if(isset($_POST['filter'])){

    // if(isset($_POST['from'], $_POST['to'])){

    //   $from_date1 = $_POST['from'];

    //   $to_date1= $_POST['to'];

    //        }} ?>

<style type="text/css">

  .wrapper {

  width: 320px;

  height: 300px;

  /*border: 1px solid black;  for demonstration purposes*/

}

    .w3-card{

        display: flex;

        flex-direction: row;

    }

    body{

    margin-top:20px;

    color: #1a202c;

    text-align: left;

    background-color: #e2e8f0;    

}

.main-body {

    padding: 15px;

}

.card {

    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);

}



.card {

    position: relative;

    display: flex;

    flex-direction: column;

    min-width: 0;

    word-wrap: break-word;

    background-color: #fff;

    background-clip: border-box;

    border: 0 solid rgba(0,0,0,.125);

    border-radius: .25rem;

}

@media only screen and (max-width: 600px) {

 

}

.card-body {

    flex: 1 1 auto;

    min-height: 1px;

    padding: 1rem;

}



.gutters-sm {

    margin-right: -8px;

    margin-left: -8px;

}



.gutters-sm>.col, .gutters-sm>[class*=col-] {

    padding-right: 8px;

    padding-left: 8px;

}

.mb-3, .my-3 {

    margin-bottom: 1rem!important;

}



.bg-gray-300 {

    background-color: #e2e8f0;

}

.h-100 {

    height: 100%!important;

}

.shadow-none {

    box-shadow: none!important;

}

    

</style>

<link rel="stylesheet" media="screen and (min-width: 900px)" href="widescreen.css">

<link rel="stylesheet" media="screen and (max-width: 600px)" href="smallscreen.css">

<script src="https://d3js.org/d3.v4.js"></script>

<script src="https://d3js.org/d3-scale-chromatic.v1.min.js"></script>

 <?php  

 $from_date = date('Y-m-d', strtotime('-6 days'));

 $to_date = date('Y-m-d');

if(isset($_POST['filter'])){

  $from_date = $_POST['from_date'];

  $to_date = $_POST['to_date'];

}

?>

<div class="app-main__outer">

        <div class="app-main__inner">

            <div class="app-page-title">

                <div class="page-title-wrapper">

                    <div class="page-title-heading">

                        <!--<div>Profile Page</div> -->

                        <div>Dashboard 

            <!-- <label for="from">From</label>

            <input type="text" onkeyup="fromto()" id="from" name="from">

            <label for="to">to</label>

            <input type="text" onkeyup="fromto()" id="to" name="to"> -->

</div>

                    </div>

                </div>

            </div>







      <!-- <div class="col-md-3 col-xl-3"></div> -->

  <?php if(!isset($_REQUEST['subject1'])){ ?>

<form  action="" method="post">

  <!-- <input type="hidden" name="page" value="Dashboard"> -->

    <!-- <div class="col-md-6 col-xl-6" >&nbsp;</div> -->

    <div class="row gutters-sm">

      <!-- <label for="from">From</label>  -->

    <!-- <input type="text" id="from" name="from"/>  -->

    <!-- <label for="to">to</label>  -->

    <!-- <input type="text" id="to" name="to"/>  -->

            <div class="col-md-6 mb-3">

              <div class="card">

                <div class="card-body" style="max-height: 400px;">

<?php $totSubjects = $conn->query("SELECT COUNT(*) as allsub FROM subject_quehead  

                ")->fetch(PDO::FETCH_ASSOC); 

                $sub_count = $totSubjects['allsub']; ?>

      

        <?php $totQues = $conn->query("SELECT COUNT(*) as allques FROM exam_question_tbl WHERE sub_subjecthead_id != 11 AND sub_subjecthead_id != 12")->fetch(PDO::FETCH_ASSOC); 

                $ques_count = $totQues['allques']; ?>

        <div><center><b>Total No. of Questions :<?php echo " ",$ques_count;?></b></center></div>

        <div class="row"><div class=""></div>

    <!-- <div class="col-md-12"> -->

        <div class="col-md-12 wrapper">

            <!-- <div id="chartContainer" style="height: 400px; width: 100%;"></div> -->

            <!-- <div id="my_dataviz"></div> -->

           <canvas id="my_Piechart"></canvas>

          </div><div class=""></div>

        </div>

    <!-- </div> -->

                </div>

            </div>

        </div>



          <div class="col-md-6 mb-3">

              <div class="card">

                <div class="card-body" style="padding: 31px; max-height: 400px;">

 <div class="col-md-12">

      <div class="col-md-12 shadow-none p-1 mb-6" style="background-color: #dee2e6; border-radius: 43px;">

        <h2 style="text-align: center;">

          <b>All Subjects</b></h2>

          </div></div>

          <div><br></div>

                 <?php 

               $sql= "SELECT * FROM main_subject";



            $result = $conn->prepare($sql);

            $result->execute();      

            while($row = $result->fetch(PDO::FETCH_ASSOC)){

                        $total =0;

                        $main_subject = $row['ex_title'];

                        $main_subject_id = $row['ex_id']; 

                    $sql1= "SELECT * FROM subject_quehead WHERE exam_id ='$main_subject_id'";

                    $result1 = $conn->prepare($sql1);

                    $result1->execute();

                    while($row = $result1->fetch(PDO::FETCH_ASSOC)){ 

                      $subject_id = $row['id'];

    $selScore = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea 

            ON eqt.eqt_id = ea.quest_id AND eqt.exam_answer_id = ea.exam_answer_id 

       WHERE ea.axmne_id='$examnee_id' AND ea.sub_subjecthead_id='$subject_id,' 

       AND ea.is_finel_sub='1' and DATE(ea.exans_created) BETWEEN '$from_date' AND  '$to_date' 

       order by eqt_id asc ");

 

        $score1 = $selScore->rowCount(); 

        $total = $total + $score1; }

        if($total != 0){  ?>

          <a  class="btn btn-outline-info" href="home.php?page=dashboard&subject1=<?php echo $main_subject_id; ?>&subject2=<?php echo $main_subject; ?>">

            <?php echo "<b>",$main_subject,"</b>";

             } ?>

        </a>

      <?php  

      }   ?> 



        <div ><br><br><br></div> 

         <div class="row">

            

          <div class="col-sm-6">

             <a href="home.php?page=examination_test_type&exam_type=<?php echo $encryption; ?>&source=dashboard" id="practicetest">

                    <div class="card mb-3 widget-content bg-midnight-bloom">

                        <div class="widget-content-wrapper text-white">

                            <div class="widget-content-left">

                                <div class="widget-heading">Practice Test</div></div>

                                <!-- <div class="widget-subheading" style="">Total Subjects</div>

                            </div> 

                           <div class="widget-content-right"> 

                                <div class="widget-numbers text-white"><span><?php echo $tot_practice; ?></span></div>

                            </div>-->

                        </div>

                    </div>

                    </a>

          </div>

          

          <div class="col-sm-6">

            <a href="home.php?page=mock&source=dashboard" id="mocktest">

                    <div class="card mb-3 widget-content bg-arielle-smile">

                        <div class="widget-content-wrapper text-white">

                            <div class="widget-content-left">

                                <div class="widget-heading">Mock Test</div></div>

                               <!--  <div class="widget-subheading" style="">Total Tests</div>



                            </div>

                            <div class="widget-content-right"> 

                                <div class="widget-numbers text-white"><span><?php echo $tot_moc; ?></span></div>

                            </div> -->

                        </div>

                    </div>

                </a>

          </div>

        </div>

      



                </div>

            </div>

        </div>

    </div>

        <div class="row gutters-sm"><div class="col-md-6 mb-3">

                        <div class="card">

                <div class="card-body">

                  <p style="font-size: unset;"><b>Select date range to view Performance :</b></p><div class="row">

          <!-- <div class="col-md-2"> -->

            <div class="col-md-5 mb-3">

              

              From Date:<input type="date" name="from_date" class="form-control" value="<?php echo $from_date; ?>">

          </div>

        <div class="col-md-5 mb-3">To Date:<input type="date" name="to_date" class="form-control" value="<?php echo $to_date; ?>"/>

          </div><div><br>

            <input class="btn btn-primary" type="submit" name="filter" value="Filter"/>

          </div>

        </div>

        <div class="row"><div class="col-md-2"></div><div class="col-md-10">

          <p><?php 

          $totExam = $conn->query("SELECT COUNT(*) as allque FROM exam_answers 

              WHERE axmne_id = '$examnee_id' and DATE(exans_created) BETWEEN '$from_date' AND  '$to_date' 

                ")->fetch(PDO::FETCH_ASSOC);

          $over  = $totExam['allque'];

          if($over != 0){

          

          ?></p></div></div>

        </div></div></div></div>

         <div class="row gutters-sm">

            <div class="col-md-4 mb-3">

              <div class="card">

                <div class="card-body">



                 <div class="panel panel-default">

                <div class="panel-heading">

        <h4><b>Attempted Questions</b></h4>

        </div>

          <div class="panel-body">

            <canvas id="densityChart1" width="600" height="800"></canvas>

          </div>

        </div>

   



                </div>

            </div>

        </div>



           <div class="col-md-4 mb-3">

              <div class="card">

                <div class="card-body">



                    <div class="panel panel-default">

                    <div class="panel-heading">

              <h4><b>Obtained Score</b></h4>

            </div>

          <div class="panel-body">

            <canvas id="densityChart" width="600" height="800"></canvas>

          </div>

        </div>  



                </div>

            </div>

        </div>

           <div class="col-md-4 mb-3">

              <div class="card">

                <div class="card-body">



                    <div class="panel panel-default">

                <div class="panel-heading">

                    <h4><b>Total Questions</b></h4>

                </div>

                <div class="panel-body">

                  <canvas id="ctx" width="600" height="800"></canvas>  

                </div>

              </div>



                </div>

            </div>

        </div>

    </div><?php }else{

                echo "<h5><b style='color:red;'>No Data Available!</b></h5>";

            }?>

</form>

<?php

}else{

?>



<form action="" method="post"> 

  <div class="col-md-6 col-xl-6" ><br>

</div>   

    <div class="row gutters-sm">

            <div class="col-md-6 mb-3">

              <div class="card">

                <div class="card-body">

                           <input type="hidden" name="subject" value="<?php echo $_GET['subject1']; ?>"> 

            <input type="hidden" name="subjects" value="<?php echo $_GET['subject2']; ?>">

    <?php $var11 = $_GET['subject2']; $var12 = $_GET['subject1']; $sql2= "SELECT * FROM main_subject WHERE ex_id=$var12";

        $result2 = $conn->prepare($sql2);$result2->execute();

        ?> 

          <div><center><b>Total No. Of Questions :

        <?php

        $ques_count =0;

        $sql3= "SELECT * FROM main_subject WHERE ex_id=$var12";

        $result3 = $conn->prepare($sql3);

        $result3->execute();

        while($row = $result3->fetch(PDO::FETCH_ASSOC)){ 

              $main_subject_id = $row['ex_id'];

              $sql= "SELECT * FROM subject_quehead WHERE exam_id=$main_subject_id";

              $result = $conn->prepare($sql);$result->execute();

              while($row = $result->fetch(PDO::FETCH_ASSOC)){ 

                    $subject_id = $row['id'];

        $totQues = $conn->query("SELECT COUNT(*) as allques FROM exam_question_tbl WHERE sub_subjecthead_id = '$subject_id' 

                ")->fetch(PDO::FETCH_ASSOC); 

                $ques_count = $ques_count + $totQues['allques']; } 

                  //echo $ques_count; }

                 echo $ques_count; } ?> </b></center></div>

                <!-- <div class="col-md-12"> --> <div class="row"><div class="col-md-3"></div>

                     <div class="col-md-6 wrapper">

                          <!-- <div id="chartContainer1" style="height: 400px; width: 100%;"></div> -->

                      <!-- <div id="my_dataviz1"></div> -->

                       <canvas id="my_Piechart1"></canvas> </div><div class="col-md-3"></div></div>

                     </div>

                    </div>

                    </div>

                

        <div class="col-md-6 mb-3">

              <div class="card">

                <div class="card-body" style="padding: 30px;">

                    <div class="col-md-12">

          <div class="row">

      <!-- <div class="col-sm-6 shadow-none p-1 mb-6" style="background-color: #dee2e6; border-radius: 12px;"> -->

        <div class="col-md-12 shadow-none p-1 mb-6" style="background-color: #dee2e6; border-radius: 43px;">

        <h4 style="text-align: center; font-size: xx-large;">

          <center><b><?php echo $var11;?></b></center></h4>



      </div>

      <div><br><br><br></div>

    </div><div><br><br></div>

          <!-- <center> -->

            <a class="btn btn-outline-info" href="home.php?page=dashboard"><b>Overall</b></a>

          <!-- </center> -->

          <!-- <div><br></div>  -->

                            <?php 

               $sql= "SELECT * FROM main_subject";



            $result = $conn->prepare($sql);

            $result->execute();      

            while($row = $result->fetch(PDO::FETCH_ASSOC)){

                        $total =0;

                        $main_subject = $row['ex_title'];

                        $main_subject_id = $row['ex_id']; 

                    $sql1= "SELECT * FROM subject_quehead WHERE exam_id ='$main_subject_id'";

                    $result1 = $conn->prepare($sql1);

                    $result1->execute();

                    while($row = $result1->fetch(PDO::FETCH_ASSOC)){ 

                      $subject_id = $row['id'];

    $selScore = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea 

            ON eqt.eqt_id = ea.quest_id AND eqt.exam_answer_id = ea.exam_answer_id 

       WHERE ea.axmne_id='$examnee_id' AND ea.sub_subjecthead_id='$subject_id,' 

       AND ea.is_finel_sub='1' and DATE(ea.exans_created) BETWEEN '$from_date' AND  '$to_date'

       order by eqt_id asc ");

 

        $score1 = $selScore->rowCount(); 

        $total = $total + $score1; }

        if( $total !=0 ){if($var11 == $main_subject){  ?>

          <a  class="btn btn-outline-success" href="home.php?page=dashboard&subject1=<?php echo $main_subject_id; ?>&subject2=<?php echo $main_subject; ?>">

            <?php echo "<b>",$main_subject,"</b>"; } else{ ?></a>

            <a  class="btn btn-outline-info" href="home.php?page=dashboard&subject1=<?php echo $main_subject_id; ?>&subject2=<?php echo $main_subject; ?>">

            <?php echo "<b>",$main_subject,"</b>"; } } ?>

        </a> 

      <?php 

      } ?>

               <div><br><br></div> 

         <div class="row">

            

          <div class="col-sm-6">

             <a href="home.php?page=examination_test_type&exam_type=<?php echo $encryption; ?>&source=dashboard" id="practicetest">

                    <div class="card mb-3 widget-content bg-midnight-bloom">

                        <div class="widget-content-wrapper text-white">

                            <div class="widget-content-left">

                                <div class="widget-heading">Practice Test</div></div>

                                <!-- <div class="widget-subheading" style="">Total Subjects</div>

                            </div> 

                           <div class="widget-content-right"> 

                                <div class="widget-numbers text-white"><span><?php echo $tot_practice; ?></span></div>

                            </div>-->

                        </div>

                    </div>

                    </a>

          </div>

          

          <div class="col-sm-6">

            <a href="home.php?page=mock&source=dashboard" id="mocktest">

                    <div class="card mb-3 widget-content bg-arielle-smile">

                        <div class="widget-content-wrapper text-white">

                            <div class="widget-content-left">

                                <div class="widget-heading">Mock Test</div></div>

                               <!--  <div class="widget-subheading" style="">Total Tests</div>



                            </div>

                            <div class="widget-content-right"> 

                                <div class="widget-numbers text-white"><span><?php echo $tot_moc; ?></span></div>

                            </div> -->

                        </div>

                    </div>

                </a>

          </div>

        </div>

           </div>   

                </div>

            </div>

        </div>

</div>

          <div class="row gutters-sm"><div class="col-md-6 mb-3">

                        <div class="card">

                <div class="card-body">

                  <p style="font-size: unset;"><b>Select date range to view Performance :</b></p>

                  <div class="row">

          <!-- <div class="col-md-2"> -->

            <div class="col-md-5 mb-3">

              From Date:<input type="date" name="from_date" class="form-control" value="<?php echo $from_date; ?>">

          </div>

        <div class="col-md-5 mb-3">To Date:<input type="date" name="to_date" class="form-control" value="<?php echo $to_date; ?>"/>

          </div><div><br>

            <input class="btn btn-primary" type="submit" name="filter" value="Filter"/>

          </div>

        </div>

        <div class="row"><div class="col-md-2"></div><div class="col-md-10">

          <p><?php 

          $totExam = $conn->query("SELECT COUNT(*) as allque FROM exam_answers 

              WHERE axmne_id = '$examnee_id' and DATE(exans_created) BETWEEN '$from_date' AND  '$to_date' 

                ")->fetch(PDO::FETCH_ASSOC);

          $over  = $totExam['allque'];

          if($over != 0){

          ?></p></div></div>

        </div></div></div></div>

    <div class="row gutters-sm">

            <div class="col-md-4 mb-3">

              <div class="card">

                <div class="card-body">



                      <div class="panel panel-default">

                <div class="panel-heading">

                    <h3><b>Attempted Questions</b></h3>

                </div>

                    <div class="panel-body">

                        <canvas id="densityChart11" width="600" height="800"></canvas> 

                    </div>

                </div>

                </div>

            </div>

        </div>

           <div class="col-md-4 mb-3">

              <div class="card">

                <div class="card-body">



                     <div class="panel panel-default">

                        <div class="panel-heading">

                            <h3><b>Obtained Score</b></h3>

                        </div>

                        <div class="panel-body">

                            <canvas id="densityChart12" width="600" height="800"></canvas> 

                         </div>

                    </div>



                </div>

            </div>

        </div> 

           <div class="col-md-4 mb-3">

              <div class="card">

                <div class="card-body">



                      <div class="panel panel-default">

                        <div class="panel-heading">

                             <h3><b>Total Questions</b></h3>

                        </div>

                    <div class="panel-body">

                        <canvas id="ctx1" width="600" height="800"></canvas>  

                    </div>

                    </div>



                </div>

            </div>

        </div>   





    </div> <?php }else{

                echo "<h5><b style='color:red;'>No Data Available!</b></h5>";

            }?>

</form>



<?php

}

?>

</div>  