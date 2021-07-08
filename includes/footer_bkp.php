
    </div>





        </div>
    </div>
</body>
<HTML>

<!-- <script src="http://maps.google.com/maps/api/js?sensor=true"></script> -->
<script type="text/javascript" src="./assets/scripts/main.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/myjs.js"></script>
<?php if($page=="mock_test"){
  ?>

<script type="text/javascript" src="js/ajax_mock.js"></script>
  <?php } else if($page=="mock_on_test"){
    ?>
    <script type="text/javascript" src="js/ajax_mock_on.js"></script>
    <?php
  } else {
    ?>

<script type="text/javascript" src="js/ajax.js"></script>
    <?php
  }

?>
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
  jQuery( function(){ 
 var pie = document.getElementById("my_Piechart").getContext('2d');
var myChart = new Chart(pie, {
  type: 'pie',
  data: {
    id :  <?php   $sql= "SELECT * FROM main_subject";

            $result = $conn->prepare($sql);
            $result->execute();
            
                echo "[";
                   while($row = $result->fetch(PDO::FETCH_ASSOC)){
                        $total =0;
                        $main_subject = $row['ex_title'];
                        $main_subject_id = $row['ex_id']; 
                    $sql1= "SELECT * FROM subject_quehead WHERE exam_id ='$main_subject_id'";
                    $result1 = $conn->prepare($sql1);
                    $result1->execute();
                    while($row = $result1->fetch(PDO::FETCH_ASSOC)){
                          $subject_id = $row['id'];
                          $totques = $conn->query("SELECT * FROM exam_question_tbl sqt INNER JOIN subject_quehead sqh ON  sqt.sub_subjecthead_id = sqh.id WHERE sqt.sub_subjecthead_id ='$subject_id' "); 
                          $score1 = $totques->rowCount();
                          $total = $total + $score1; }
                          if($total != 0 and $main_subject != 'SSC'){
                    echo $main_subject_id,", ";}}
                    echo "],";?>
    labels: <?php $sql= "SELECT * FROM main_subject";

            $result = $conn->prepare($sql);
            $result->execute();
            
                echo "[";

                   while($row = $result->fetch(PDO::FETCH_ASSOC)){
                        $total =0;
                        $main_subject = $row['ex_title'];
                        $main_subject_id = $row['ex_id']; 
                    $sql1= "SELECT * FROM subject_quehead WHERE exam_id ='$main_subject_id'";
                    $result1 = $conn->prepare($sql1);
                    $result1->execute();
                    while($row = $result1->fetch(PDO::FETCH_ASSOC)){
                          $subject_id = $row['id'];
                          $totques = $conn->query("SELECT * FROM exam_question_tbl sqt INNER JOIN subject_quehead sqh ON  sqt.sub_subjecthead_id = sqh.id WHERE sqt.sub_subjecthead_id ='$subject_id' "); 
                          $score1 = $totques->rowCount();
                          $total = $total + $score1; }
                          if($total != 0 and $main_subject != 'SSC'){
                            $string1 = $main_subject;
                        $newest = str_replace(' ', '', $string1);
                        $newstring = preg_replace('/-+/', '', $newest);
                    echo "'".$newstring."'",", ";}}
                    echo "],";
                    ?> 
    datasets: [{
      backgroundColor: [
        "#2ecc71",
        "#3498db",
        "#95a5a6",
        "#9b59b6",
        "#f1c40f",
        "#e74c3c",
        "#34495e"
      ],
       data: <?php $sql= "SELECT * FROM main_subject";

            $result = $conn->prepare($sql);
            $result->execute();
            
                echo "[";

                   while($row = $result->fetch(PDO::FETCH_ASSOC)){
                        $total =0;
                        $main_subject = $row['ex_title'];
                        $main_subject_id = $row['ex_id']; 
                    $sql1= "SELECT * FROM subject_quehead WHERE exam_id ='$main_subject_id'";
                    $result1 = $conn->prepare($sql1);
                    $result1->execute();
                    while($row = $result1->fetch(PDO::FETCH_ASSOC)){
                          $subject_id = $row['id'];
                          $totques = $conn->query("SELECT * FROM exam_question_tbl sqt INNER JOIN subject_quehead sqh ON  sqt.sub_subjecthead_id = sqh.id WHERE sqt.sub_subjecthead_id ='$subject_id' "); 
                          $score1 = $totques->rowCount();
                          $total = $total + $score1; }
                          if($total != 0 and $main_subject != 'SSC'){
                           // $string1 = $main_subject;
                        //$newest = str_replace(' ', '', $string1);
                       // $newstring = preg_replace('/-+/', '', $newest);
                    echo $total,", ";}}
                    echo "],";
                    ?> //[12, 19, 3, 17, 28, 24, 7]
    }]
    
       },
       options: {
        legend: {
            display: true,
            position: 'left',
        }
    }
      
    }); 
}); $("#my_Piechart").click(
        function(e){  
         // alert('No'); 
          //var e = my_Piechart.getElementsAtEvent(e);

          //if(e.length > 0){ 
           // alert('yes');
          //}
          //var url = "home.php?page=dashboard&subject1=" + activePoints[0].labels;
                           // alert(url);
          //window.location.href='home.php?page=dashboard&subject1='+ activePoints[0].id + '&subject2=' + activePoints[0].labels;
          //}
       // )
})
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.1/Chart.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>  
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
<?php if(isset($_POST['filter'])){
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
}?>

 <script type="text/javascript">
      var densityCanvas = document.getElementById("densityChart");

      Chart.defaults.global.defaultFontFamily = "Lato";
      Chart.defaults.global.defaultFontSize = 18;

      var densityData = {
          label: 'Percentage(%):',
           
          data: [
            <?php  
            $sql= "SELECT * FROM main_subject";

            $result = $conn->prepare($sql);
            $result->execute();       
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                        $total1 =0; $total2=0;
                        $main_subject = $row['ex_title'];
                        $main_subject_id = $row['ex_id']; 
                    $sql1= "SELECT * FROM subject_quehead WHERE exam_id ='$main_subject_id'";
                    $result1 = $conn->prepare($sql1);
                    $result1->execute();
                    while($row = $result1->fetch(PDO::FETCH_ASSOC)){
                          $subject_id = $row['id'];

    $totExam = $conn->query("SELECT COUNT(*) as allque FROM exam_answers 
              WHERE sub_subjecthead_id='$subject_id' and axmne_id = '$examnee_id' and DATE(exans_created) BETWEEN '$from_date' AND  '$to_date'
                ")->fetch(PDO::FETCH_ASSOC); 
      $over  = $totExam['allque']; 
          $selScore = $conn->query(
          "SELECT * FROM exam_question_tbl eqt INNER JOIN
          exam_answers ea ON eqt.eqt_id = ea.quest_id 
          AND eqt.exam_answer_id = ea.exam_answer_id  
          WHERE ea.axmne_id='$examnee_id' 
          AND ea.sub_subjecthead_id='$subject_id' 
          AND ea.is_finel_sub='1' and DATE(ea.exans_created) BETWEEN '$from_date' AND  '$to_date' 
          order by eqt_id asc ");
        $score = $selScore->rowCount();
        $total1 = $total1 + $over;
        $total2 = $total2 + $score; }
        if($total1 != 0 AND $total2 !=0){ 
        $ans = round($total2 / $total1 * 100,2);
        echo $ans,","; } }
         ?>

          ],
           backgroundColor: 'rgba(0, 99, 132, 0.6)',
            //borderColor: 'rgba(0, 99, 132, 1)',
           
        };

      var barChart = new Chart(densityCanvas, {
          type: 'bar',
          data: {
          labels: [
  <?php       
    $sql= "SELECT * FROM main_subject";

            $result = $conn->prepare($sql);
            $result->execute();       
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                        $total1 =0; $total2=0;
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
         $total1 = $total1 + $score1; }
          if($total1 != 0){
            echo "'".$main_subject."',";
        } 
      } ?>

          ],
          datasets: [densityData]
          },
          options: {
    scales: {
           xAxes: [{
      barPercentage: 1,
      categoryPercentage: 0.6,
      ticks: {
              fontSize: 8,
              fontStyle: 'bold'
            },
        //labelFontSize: 0.03,
    }],
        yAxes: [{
            ticks: {
                beginAtZero: true,
                stepSize: 10
            },
        }]
    }
}

        });
var densityCanvas1 = document.getElementById("densityChart1");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;
var densityData1 = {
  label: 'Total Questions',
  data: [
        <?php
          $sql= "SELECT * FROM main_subject";

            $result = $conn->prepare($sql);
            $result->execute();       
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                        $total1 =0; $total2=0;
                        $main_subject = $row['ex_title'];
                        $main_subject_id = $row['ex_id']; 
                    $sql1= "SELECT * FROM subject_quehead WHERE exam_id ='$main_subject_id'";
                    $result1 = $conn->prepare($sql1);
                    $result1->execute();
                    while($row = $result1->fetch(PDO::FETCH_ASSOC)){
                          $subject_id = $row['id'];
          $totExam = $conn->query("SELECT COUNT(*) as allque FROM exam_answers 
              WHERE sub_subjecthead_id='$subject_id' and axmne_id = '$examnee_id' and DATE(exans_created) BETWEEN '$from_date' AND  '$to_date' 
                ")->fetch(PDO::FETCH_ASSOC);
          $over  = $totExam['allque'];
          $total1= $total1 + $over; }
          if($total1 != 0){
                echo $total1,",";
            }
          }
        ?>
  ],
  backgroundColor: 'rgba(0, 99, 132, 0.6)',
  //borderColor: 'rgba(0, 99, 132, 1)',
  yAxisID: "y-axis-density"
};
 
var gravityData1 = {
  label: 'Total Correct Answers',
  data: [
         <?php        
    $sql= "SELECT * FROM main_subject";

            $result = $conn->prepare($sql);
            $result->execute();       
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                        $total1 =0; $total2=0;
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
        $total1 = $total1 + $score1; }
        //echo $total1.",";}
        if($total1 != 0){  
                    echo $total1.","; 
        }
      } ?>
  ],
  backgroundColor: 'rgba(99, 132, 0, 0.6)',
  //borderColor: 'rgba(99, 132, 0, 1)',
  yAxisID: "y-axis-gravity"
};
 
var planetData1 = {
  labels: [
   <?php        
    $result = $conn->prepare($sql);
            $result->execute();       
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                        $total1 =0; $total2=0;
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
         $total1 = $total1 + $score1; }
          if($total1 != 0){
            echo "'".$main_subject."',";
        }
      } ?>
  ],
  datasets: [densityData1, gravityData1]
};
 
var chartOptions1 = {
  scales: {
    xAxes: [{
      barPercentage: 1,
      categoryPercentage: 0.6,
       ticks: {
              fontSize: 8,
              fontStyle: 'bold',
            },
    }],
    yAxes: [{
      id: "y-axis-density" , 
            ticks: {
                                beginAtZero: true,
                                steps: 10,
                                stepSize: 50
                                
                            }
    }, {
      id: "y-axis-gravity" ,
      display: false, 
            ticks: {
                                beginAtZero: false,
                                steps: 10,
                                stepValue: 5,
                                max: 500
                            }
    }]
  }
};
 
var barChart1 = new Chart(densityCanvas1, {
  type: 'bar',
  data: planetData1,
  options: chartOptions1
});
      //}
  </script>
  <script type="text/javascript">
    var chart = new Chart(ctx, {
   type: 'bar',
  
   data: {
      labels: ['ATTEMPTED','SKIPPED', 'NOT ATTEMPTED', 'OVERALL'], 
      datasets: [
        <?php
     $sql= "SELECT * FROM main_subject";

            $result = $conn->prepare($sql);
            $result->execute();       
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                        $tot_skip1 = $tot_att1 = $tot_notatt1=0;
                        $main_subject = $row['ex_title'];
                        $main_subject_id = $row['ex_id']; 
                    $sql1= "SELECT * FROM subject_quehead WHERE exam_id ='$main_subject_id'";
                    $result1 = $conn->prepare($sql1);
                    $result1->execute();
                    while($row = $result1->fetch(PDO::FETCH_ASSOC)){
                          $subject_id = $row['id'];
          $tot_att = $conn->query("SELECT COUNT(*) as allatt FROM exam_answers WHERE   sub_subjecthead_id = '$subject_id' and axmne_id = '$examnee_id' and answer_status = 1 and DATE(exans_created) BETWEEN '$from_date' AND  '$to_date' ")->fetch(PDO::FETCH_ASSOC);
          $totatt = $tot_att['allatt'];
          $tot_skip = $conn->query("SELECT COUNT(*) as allskip FROM exam_answers WHERE sub_subjecthead_id='$subject_id' and axmne_id = '$examnee_id' and answer_status = 2 and DATE(exans_created) BETWEEN '$from_date' AND  '$to_date'")->fetch(PDO::FETCH_ASSOC); 
          $totskip = $tot_skip['allskip'];
          $tot_not_att = $conn->query("SELECT COUNT(*) as allnotatt FROM exam_answers WHERE sub_subjecthead_id = '$subject_id' and axmne_id = '$examnee_id' and DATE(exans_created) BETWEEN '$from_date' AND  '$to_date' and (answer_status = 3 OR answer_status = 0) ")->fetch(PDO::FETCH_ASSOC); 
            $totnotatt =$tot_not_att['allnotatt'];
            $tot_skip1 = $tot_skip1 + $totskip;
            $tot_att1 = $tot_att1 + $totatt;
            $tot_notatt1 = $tot_notatt1 + $totnotatt; }
            $overall = $tot_skip1 + $tot_notatt1+ $tot_att1;
            $rand = str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
        if($overall !=0){
            echo "{ label: ","'".$main_subject."',";
            echo "data: [".$tot_att1.",".$tot_skip1.",".$tot_notatt1.",".$overall."],";
            echo "backgroundColor:","'","#".$rand."'","},";} }  ?>
        ]
   },
   options: {
      responsive: true,
      legend: {
          minWidth: 100,
          minHeight: 200,
         position: 'top' // place legend on the right side of chart
      },
      scales: {
         xAxes: [{
            stacked: true,// this should be set to make the bars stacked
            ticks: {
              fontSize: 12
            },
         }],
         yAxes: [{
            stacked: true,
            ticks: {
                                beginAtZero: true,
                                stepSize: 100 }, // this also..
         }]
      }
   } 
}); 
  </script>
  <?php //} ?>
  
  <script type="text/javascript">

      var densityCanvas12 = document.getElementById("densityChart12");

      Chart.defaults.global.defaultFontFamily = "Lato";
      Chart.defaults.global.defaultFontSize = 18;

      var densityData12 = {
          label: 'Percentage(%):',
          data: [
            <?php         
        $sql3= "SELECT * FROM main_subject WHERE ex_id=$var12";
        $result3 = $conn->prepare($sql3);
        $result3->execute();
        while($row = $result3->fetch(PDO::FETCH_ASSOC)){ 
              $main_subject_id = $row['ex_id'];
              $sql= "SELECT * FROM subject_quehead WHERE exam_id=$main_subject_id";
              $result = $conn->prepare($sql);$result->execute();
              while($row = $result->fetch(PDO::FETCH_ASSOC)){ 
                    $subject_id = $row['id'];

    $totExam = $conn->query("SELECT COUNT(*) as allque FROM exam_answers 
              WHERE sub_subjecthead_id='$subject_id' and axmne_id = '$examnee_id'  and DATE(exans_created) BETWEEN '$from_date' AND  '$to_date'
                ")->fetch(PDO::FETCH_ASSOC); 

    $selScore = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea 
            ON eqt.eqt_id = ea.quest_id AND eqt.exam_answer_id = ea.exam_answer_id 
       WHERE ea.axmne_id='$examnee_id' AND ea.sub_subjecthead_id='$subject_id,' 
       AND ea.is_finel_sub='1'  and DATE(ea.exans_created) BETWEEN '$from_date' AND  '$to_date'
       order by eqt_id asc ");

    $score1 = $selScore->rowCount(); 
    $over  = $totExam['allque']; 

     if($over>0){
                    
        $ans = round($score1 / $over * 100,2);
        echo $ans,",";
        //echo "%";
        }
   } }?>

          ],
           backgroundColor: 'rgba(0, 99, 132, 0.6)',
            //borderColor: 'rgba(0, 99, 132, 1)',
           
        };


      var barChart = new Chart(densityCanvas12, {
          type: 'bar',
          data: {
          labels: [
  <?php       
    $sql3= "SELECT * FROM main_subject WHERE ex_id=$var12";
        $result3 = $conn->prepare($sql3);
        $result3->execute();
        while($row = $result3->fetch(PDO::FETCH_ASSOC)){ 
              $main_subject_id = $row['ex_id'];
              $sql= "SELECT * FROM subject_quehead WHERE exam_id='$main_subject_id'";
              $result = $conn->prepare($sql);$result->execute();
              while($row = $result->fetch(PDO::FETCH_ASSOC)){ 
                    $subject_id = $row['id'];
        $selScore = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea 
            ON eqt.eqt_id = ea.quest_id AND eqt.exam_answer_id = ea.exam_answer_id 
       WHERE ea.axmne_id='$examnee_id' AND ea.sub_subjecthead_id='$subject_id,' 
       AND ea.is_finel_sub='1'  and DATE(ea.exans_created) BETWEEN '$from_date' AND  '$to_date'
       order by eqt_id asc ");
 
        $score1 = $selScore->rowCount(); 
        if($score1 != 0){  
            echo "'",$row['quehead'],"',";
        }
      } } ?>

          ],
          datasets: [densityData12]
          },
          options: {
    scales: {
        xAxes: [{
      barPercentage: 1,
      categoryPercentage: 0.6,
      ticks: {
              fontSize: 8,
              fontStyle: 'bold'
            },
        //labelFontSize: 0.03,
    }],

        yAxes: [{
            ticks: {
                beginAtZero: true,
                stepSize: 10
            }
        }]
    }
}
        });

var densityCanvas11 = document.getElementById("densityChart11");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;
var densityData11 = {
  label: 'Total Questions',
  data: [
        <?php
          $sql3= "SELECT * FROM main_subject WHERE ex_id=$var12";
        $result3 = $conn->prepare($sql3);
        $result3->execute();
        while($row = $result3->fetch(PDO::FETCH_ASSOC)){
              $total =0; 
              $main_subject_id = $row['ex_id'];
              $sql= "SELECT * FROM subject_quehead WHERE exam_id='$main_subject_id' ";
              $result = $conn->prepare($sql);$result->execute();
              while($row = $result->fetch(PDO::FETCH_ASSOC)){ 
                    $subject_id = $row['id'];
                    $totques = $conn->query("SELECT * FROM exam_question_tbl sqt INNER JOIN subject_quehead sqh ON  sqt.sub_subjecthead_id = sqh.id WHERE sqt.sub_subjecthead_id ='$subject_id' "); 
                          $score1 = $totques->rowCount();
          $totExam = $conn->query("SELECT COUNT(*) as allque FROM exam_answers 
              WHERE sub_subjecthead_id='$subject_id' and axmne_id = '$examnee_id'  and DATE(exans_created) BETWEEN '$from_date' AND  '$to_date' 
                ")->fetch(PDO::FETCH_ASSOC);
          $over  = $totExam['allque'];
          if($over != 0){
                echo $over,",";
            }
           } }
        ?>
  ],
  backgroundColor: 'rgba(0, 99, 132, 0.6)',
  //borderColor: 'rgba(0, 99, 132, 1)',
  yAxisID: "y-axis-density"
};
 
var gravityData11 = {
  label: 'Total Correct Answers',
  data: [
         <?php        
   $sql3= "SELECT * FROM main_subject WHERE ex_id=$var12";
        $total =0;
        $result3 = $conn->prepare($sql3);
        $result3->execute();
        while($row = $result3->fetch(PDO::FETCH_ASSOC)){ 
              $main_subject_id = $row['ex_id'];
              $sql= "SELECT * FROM subject_quehead WHERE exam_id=$main_subject_id";
              $result = $conn->prepare($sql);$result->execute();
              while($row = $result->fetch(PDO::FETCH_ASSOC)){ 
                    $subject_id = $row['id'];
        $selScore = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea 
            ON eqt.eqt_id = ea.quest_id AND eqt.exam_answer_id = ea.exam_answer_id 
       WHERE ea.axmne_id='$examnee_id' AND ea.sub_subjecthead_id='$subject_id,' 
       AND ea.is_finel_sub='1'  and DATE(ea.exans_created) BETWEEN '$from_date' AND  '$to_date'
       order by eqt_id asc ");
 
        $score1 = $selScore->rowCount(); 
        //$total = $total + $score1; }
        if($score1 != 0){  
                    echo $score1,","; 
        }
      } } ?>
  ],
  backgroundColor: 'rgba(99, 132, 0, 0.6)',
  //borderColor: 'rgba(99, 132, 0, 1)',
  yAxisID: "y-axis-gravity"
};
 
var planetData11 = {
  labels: [
   <?php        
    $sql3= "SELECT * FROM main_subject WHERE ex_id=$var12";
        $result3 = $conn->prepare($sql3);
        $result3->execute();
        while($row = $result3->fetch(PDO::FETCH_ASSOC)){ 
              $main_subject_id = $row['ex_id'];
              $sql= "SELECT * FROM subject_quehead WHERE exam_id=$main_subject_id";
              $result = $conn->prepare($sql);$result->execute();
              while($row = $result->fetch(PDO::FETCH_ASSOC)){ 
                    $subject_id = $row['id'];
        $selScore = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea 
            ON eqt.eqt_id = ea.quest_id AND eqt.exam_answer_id = ea.exam_answer_id 
       WHERE ea.axmne_id='$examnee_id' AND ea.sub_subjecthead_id='$subject_id,' 
       AND ea.is_finel_sub='1'  and DATE(ea.exans_created) BETWEEN '$from_date' AND  '$to_date'
       order by eqt_id asc ");
 
        $score1 = $selScore->rowCount(); 
        if($score1 != 0){  
            echo "'",$row['quehead'],"',";
        }
      } } ?>
  ],
  datasets: [densityData11, gravityData11]
};
 
var chartOptions11 = {
  scales: {
    xAxes: [{
      barPercentage: 1,
      categoryPercentage: 0.6,
      ticks: {
              fontSize: 8,
              fontStyle: 'bold',
            },
        //labelFontSize: 0.03,
    }],
    yAxes: [{
      id: "y-axis-density",
      ticks: {
                                beginAtZero: true,
                                steps: 10,
                                stepSize: 50,
                                
                            }
    }, {
      id: "y-axis-gravity",
       display: false,
            ticks: {
                                beginAtZero: false,
                                steps: 10,
                                stepValue: 5,
                                max: 500
                            }
    }]
  }
};
 
var barChart = new Chart(densityCanvas11, {
  type: 'bar',
  data: planetData11,
  options: chartOptions11
});
  </script>
  <script type="text/javascript">
    var chart = new Chart(ctx1, {
   type: 'bar',
   data: {
      labels: ['ATTEMPTED','SKIPPED', 'NOT ATTEMPTED', 'OVERALL'], 
      // responsible for how many bars are gonna show on the chart
      // create 12 datasets, since we have 12 items
      // data[0] = labels[0] (data for first bar - 'Standing costs') | data[1] = labels[1] (data for second bar - 'Running costs')
      // put 0, if there is no data for the particular bar
      datasets: [
        <?php
      $sql3= "SELECT * FROM main_subject WHERE ex_id=$var12";
        $result3 = $conn->prepare($sql3);
        $result3->execute();
        while($row = $result3->fetch(PDO::FETCH_ASSOC)){ 
              $main_subject_id = $row['ex_id'];
              $sql= "SELECT * FROM subject_quehead WHERE exam_id=$main_subject_id";
              $result = $conn->prepare($sql);$result->execute();
              while($row = $result->fetch(PDO::FETCH_ASSOC)){ 
                    $subject_id = $row['id'];
          $selScore = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea 
            ON eqt.eqt_id = ea.quest_id AND eqt.exam_answer_id = ea.exam_answer_id 
            WHERE ea.axmne_id='$examnee_id' AND ea.sub_subjecthead_id='$subject_id,' 
            AND ea.is_finel_sub='1'  and DATE(exans_created) BETWEEN '$from_date' AND  '$to_date'
            order by eqt_id asc ");
          $tot_attm = $conn->query("SELECT COUNT(*) as allattm FROM exam_answers WHERE sub_subjecthead_id='$subject_id' and axmne_id = '$examnee_id' and answer_status = 1  and DATE(exans_created) BETWEEN '$from_date' AND  '$to_date'")->fetch(PDO::FETCH_ASSOC); 
          $totattm = $tot_attm['allattm'];
          $tot_skip = $conn->query("SELECT COUNT(*) as allskip FROM exam_answers WHERE sub_subjecthead_id='$subject_id' and axmne_id = '$examnee_id' and answer_status = 2  and DATE(exans_created) BETWEEN '$from_date' AND  '$to_date'")->fetch(PDO::FETCH_ASSOC); 
          $totskip = $tot_skip['allskip'];
          $tot_not_att = $conn->query("SELECT COUNT(*) as allnotatt FROM exam_answers WHERE sub_subjecthead_id = '$subject_id' and axmne_id = '$examnee_id' and DATE(exans_created) BETWEEN '$from_date' AND  '$to_date' and (answer_status = 3 OR answer_status = 0) ")->fetch(PDO::FETCH_ASSOC); 
            $totnotatt =$tot_not_att['allnotatt'];
            $overall = $totskip + $totnotatt + $totattm;       
            $score1 = $selScore->rowCount();
            $rand = str_pad(dechex(rand(0x000000, 0xFFFFFF)), 6, 0, STR_PAD_LEFT);
        if($overall != 0){
            echo "{ label: ","'",$row['quehead'],"',";
            echo "data: [",$totattm,",",$totskip,",",$totnotatt,",",$overall,"],";
            echo "backgroundColor:","'","#".$rand,"'","},";} }  }?>
        ]
   },
   options: {
      responsive: true,
      legend: {
         position: 'top', // place legend on the right side of chart
      },
      scales: {
         xAxes: [{
            stacked: true, // this should be set to make the bars stacked
            ticks: {
              fontSize: 12
            },
         }],
         yAxes: [{
            stacked: true,
             ticks: {
                                beginAtZero: true,
                                stepSize: 100 }, // this also..
         }]
      }
   }
});
  </script> <?php //} ?>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">
 var draw = document.getElementById("my_Piechart1").getContext('2d');
var myChart = new Chart(draw, {
  type: 'pie',
  data: {
    labels: <?php $sql= "SELECT * FROM main_subject WHERE ex_id=$var12";

            $result2 = $conn->prepare($sql);
            $result2->execute();
            
                echo "[";

                  while($row = $result2->fetch(PDO::FETCH_ASSOC)){ 
                          $main_subject_id = $row['ex_id'];
$sql= "SELECT * FROM subject_quehead WHERE exam_id=$main_subject_id";

$result = $conn->prepare($sql);$result->execute();
while($row = $result->fetch(PDO::FETCH_ASSOC)){ 
                          $subject_id = $row['id']; 
                          $totques = $conn->query("SELECT * FROM exam_question_tbl sqt INNER JOIN subject_quehead sqh ON  sqt.sub_subjecthead_id = sqh.id WHERE sqt.sub_subjecthead_id ='$subject_id' "); 
                          $score1 = $totques->rowCount();
                          if($score1 != 0){ 
                        $string1 = $row['quehead'];
                        //$newest = str_replace(' ', '', $string1);
                        //$newstring = preg_replace('/-+/', '', $newest);
                    echo "'".$string1."'",", ";}} }
                    echo "],";
                    ?> 
    datasets: [{
      backgroundColor: [
        "#2ecc71",
        "#3498db",
        "#95a5a6",
        "#9b59b6",
        "#f1c40f",
        "#e74c3c",
        "#34495e"
      ],
       data:<?php $sql= "SELECT * FROM main_subject WHERE ex_id=$var12";

            $result2 = $conn->prepare($sql);
            $result2->execute();  
        echo "[";
       while($row = $result2->fetch(PDO::FETCH_ASSOC)){ 
                          $main_subject_id = $row['ex_id'];
$sql= "SELECT * FROM subject_quehead WHERE exam_id=$main_subject_id";

$result = $conn->prepare($sql);$result->execute();
while($row = $result->fetch(PDO::FETCH_ASSOC)){ 
                          $subject_id = $row['id']; 
                          $totques = $conn->query("SELECT * FROM exam_question_tbl sqt INNER JOIN subject_quehead sqh ON  sqt.sub_subjecthead_id = sqh.id WHERE sqt.sub_subjecthead_id ='$subject_id' "); 
                          $score1 = $totques->rowCount();
                          if($score1 != 0){ 
                    echo $score1,", ";}} } echo "]";
?>  
       //[12, 19, 3, 17, 28, 24, 7]
     
    }]
  },
});
</script>
  <script type="text/javascript">
    window.onload = function() {

    var options = {
       title: {
        text: <?php $totQues = $conn->query("SELECT COUNT(*) as allques FROM exam_question_tbl  
                ")->fetch(PDO::FETCH_ASSOC); 
                $ques_count = $totQues['allques']; ?>
        "Total Questions:<?php echo $ques_count;?>"
        },
        data: [{
          type: "pie",
          startAngle: 45,
          showInLegend: "true",
          legendText: "{labels}",
          indexLabel: "{labels} ({y})",
          yValueFormatString:"#,##0.#"%"",
            dataPoints: [
                  <?php 
                   while($row = $result->fetch(PDO::FETCH_ASSOC)){
                        $total =0;
                        $main_subject = $row['ex_title'];
                        $main_subject_id = $row['ex_id']; 
                    $sql1= "SELECT * FROM subject_quehead WHERE exam_id ='$main_subject_id'";
                    $result1 = $conn->prepare($sql1);
                    $result1->execute();
                    while($row = $result1->fetch(PDO::FETCH_ASSOC)){
                          $subject_id = $row['id'];
                          $totques = $conn->query("SELECT * FROM exam_question_tbl sqt INNER JOIN subject_quehead sqh ON  sqt.sub_subjecthead_id = sqh.id WHERE sqt.sub_subjecthead_id ='$subject_id' "); 
                          $score1 = $totques->rowCount();
                          $total = $total + $score1; }
                          if($total != 0){
                    echo "{ labels:","'".$main_subject."',"," y:",$total,",id:",$main_subject_id," }, ";}}?>
                ],
              click:  function onClick(e){
    //alert(e.dataPoint.id);   
    window.location.href='home.php?page=dashboard&subject1='+e.dataPoint.id+'&subject2='+e.dataPoint.labels;
  },
    
              }]
            };
    $("#chartContainer").CanvasJSChart(options);
 
    }
  </script>
<script src="https://d3js.org/d3.v4.js"></script>
<script src="https://d3js.org/d3-scale-chromatic.v1.min.js"></script>
<script>

// set the dimensions and margins of the graph
var width = 650
    height = 300
    margin = 40

// The radius of the pieplot is half the width or half the height (smallest one). I subtract a bit of margin.
var radius = Math.min(width, height) / 2,
outerRadius = radius -10;

// append the svg object to the div called 'my_dataviz'
var svg = d3.select("#my_dataviz1")
  .append("svg")
    .attr("width", width)
    .attr("height", height)
  .append("g")
    .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

    svg.append("g")
  .attr("class", "labels");
    svg.append("g")
  .attr("class", "lines");

// Create dummy data
var data = <?php echo "{ "; 
                        $sql= "SELECT * FROM main_subject WHERE ex_id=$var12";
        $result2 = $conn->prepare($sql);
        $result2->execute();
                          while($row = $result2->fetch(PDO::FETCH_ASSOC)){ 
                          $main_subject_id = $row['ex_id'];
$sql= "SELECT * FROM subject_quehead WHERE exam_id=$main_subject_id";

$result = $conn->prepare($sql);$result->execute();
while($row = $result->fetch(PDO::FETCH_ASSOC)){ 
                          $subject_id = $row['id']; 
                          $totques = $conn->query("SELECT * FROM exam_question_tbl sqt INNER JOIN subject_quehead sqh ON  sqt.sub_subjecthead_id = sqh.id WHERE sqt.sub_subjecthead_id ='$subject_id' "); 
                          $score1 = $totques->rowCount();
                          if($score1 != 0){ 
                        $string1 = $row['quehead'];
                        $newest = str_replace(' ', '', $string1);
                        $newstring = preg_replace('/-+/', '', $newest);
                        
                        //$s = ucfirst($string);
                        //$bar = ucwords(strtolower($s));
                    //echo $data = preg_replace('/\s+/', '', $bar);
                    echo $newstring,":",$score1,",";}} }
                    echo "}";

?>


//{a: 19, b: 20, c:30, d:8, e:12}

// set the color scale
var color = d3.scaleOrdinal()
  .domain(data)
  .range(d3.schemeSet2);

// Compute the position of each group on the pie:
var pie = d3.pie().padAngle(0.058)
  .value(function(d) {return d.value; })
var data_ready = pie(d3.entries(data))
// Now I know that group A goes from 0 degrees to x degrees and so on.

// shape helper to build arcs:
var arcGenerator = d3.arc()
.cornerRadius(8.97)
  .innerRadius(2.01)
  .outerRadius(radius)

// Build the pie chart: Basically, each part of the pie is a path that we build using the arc function.
svg
  .selectAll('mySlices')
  .data(data_ready)
  .enter()
  .append('path')
    .attr('d', arcGenerator)
    .attr('fill', function(d){ return(color(d.data.key)) })
    .attr("stroke", "white")
    .style("stroke-width", "2px")
    .style("opacity", 0.7)

// Now add the annotation. Use the centroid method to get the best coordinates
//svg
  //.selectAll('mySlices')
  //.data(data_ready)
  //.enter()
  //.append('text')
  //.text(function(d){ return d.data.key + "("+d.data.value+")"})
  //.attr("transform", function(d) { return "translate(" + arcGenerator.centroid(d) + ")";  })
  //.style("text-anchor", "middle")
  //.style("font-size", 12)
  // Add the polylines between chart and labels:
svg
  .selectAll('mySlices')
  .data(data_ready)
  .enter()
  .append('polyline')
    .attr("stroke", "black")
    .style("fill", "none")
    .attr("stroke-width", 1)
    .attr('points', function(d) {
      var posA = arcGenerator.centroid(d) // line insertion in the slice
      var posB = arcGenerator.centroid(d) // line break: we use the other arc generator that has been built only for that
      var posC = arcGenerator.centroid(d); // Label position = almost the same as posB
      var midangle = d.startAngle + (d.endAngle - d.startAngle) / 2 // we need the angle to see if the X position will be at the extreme right or extreme left
      posC[0] = radius* 0.95 * (midangle < Math.PI ? 1 : -1); // multiply by 1 or -1 to put it on the right or on the left
      return [posA, posB, posC]
    })
// Now add the annotation. Use the centroid method to get the best coordinates
svg
  .selectAll('mySlices')
  .data(data_ready)
  .enter()
  .append('text')
  .text(function(d){ console.log(d.data.key) ; return d.data.key + "("+d.data.value+")"})
  .attr("transform", function(d) { 
    var pos = arcGenerator.centroid(d);
        var midangle = d.startAngle + (d.endAngle - d.startAngle) / 2
        pos[0] = (radius) * 0.99 * (midangle < Math.PI ? 1 : -1);
        return 'translate(' + pos + ')';
    //return "translate(" + arcGenerator.centroid(d) + ")";  
    })
  .style('text-anchor', function(d) {
        var midangle = d.startAngle + (d.endAngle - d.startAngle) / 2
        return (midangle < Math.PI ? 'start' : 'end')
    //.style("text-anchor", "middle")
    //.style("font-size", 17)
    })



</script>
  <script type="text/javascript">
    var options1 = {
       title: {
        text: <?php $totSubjects = $conn->query("SELECT COUNT(*) as allsub FROM subject_quehead  
                ")->fetch(PDO::FETCH_ASSOC); 
                $sub_count = $totSubjects['allsub']; ?>
      
        "Total Questions:<?php
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
                 echo $ques_count; } ?>"
        },
        data: [{
          type: "pie",
          startAngle: 45,
          showInLegend: "true",
          legendText: "{labels}",
          indexLabel: "{labels} ({y})",
          yValueFormatString:"#,##0.#"%"",
            dataPoints: [
            <?php  while($row = $result2->fetch(PDO::FETCH_ASSOC)){ 
                          $main_subject_id = $row['ex_id'];
$sql= "SELECT * FROM subject_quehead WHERE exam_id=$main_subject_id";

$result = $conn->prepare($sql);$result->execute();
while($row = $result->fetch(PDO::FETCH_ASSOC)){ 
                          $subject_id = $row['id']; 
                          $totques = $conn->query("SELECT * FROM exam_question_tbl sqt INNER JOIN subject_quehead sqh ON  sqt.sub_subjecthead_id = sqh.id WHERE sqt.sub_subjecthead_id ='$subject_id' "); 
                          $score1 = $totques->rowCount();
                          if($score1 != 0){ 
                    echo "{ labels:","'".$row['quehead']."',"," y:",$score1,",id:",$subject_id," }, ";}} }
?>
                 
                ],
                click:  function onClick(e){
    //alert(e.dataPoint.id);   
    window.location.href='home.php?page=result_date&id='+e.dataPoint.id;
  },
              }]
            };
      $("#chartContainer1").CanvasJSChart(options1);
    
</script>