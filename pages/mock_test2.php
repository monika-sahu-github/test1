<?php
$examtype ='Mock Test';
$encryption = openssl_encrypt($simple_string, $ciphering, 
$key, $options, $iv); 
$simple_string2 = "1"; 
$ciphering = "AES-128-CTR";
//$decryption_iv = '1234567891011121'; 
$decryption_key = "OnLineTest";
$iv_length = openssl_cipher_iv_length($ciphering); 
$options = 0; 
$encryption2 = openssl_encrypt($simple_string2, $ciphering, 
$key, $options, $iv); 
$tot_practice = $cmn->getvalfield($conn,"exam_tbl","count(*)","type=0");
$tot_moc = $cmn->getvalfield($conn,"exam_tbl","count(*)","type=1");
$exam_type = "";
if(isset($_REQUEST["exam_type"])){
    $exam_type =    $_REQUEST["exam_type"];
    if($exam_type=="scheduled-test"){
        $exam_type = "scheduled";
        $exam_type2 = "Scheduled";
    }else if($exam_type=="on-demand"){
        $exam_type = "on_demand";
        $exam_type2 = "On Demand";
    }
}
?>
<style type="text/css">
    .table-strip{
       /* background-image: linear-gradient( 
-20deg
 , #2b5876 0%, #4e4376 100%) !important;*/
    /*color: white;*/
    /*-moz-border-radius: 10px;*/
   /* -webkit-border-radius: 10px;*/
    }
    .res-row{
        /*background: #f7c490;
    color: #325376;*/
    }
    .container{
        padding: 5px;
   /* background: #325376;*/
    border-radius: 15px;
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
                        <div><?php echo $exam_type2; ?> 
                        </div>
                    </div>
                     
                 </div>
            </div> 
             <div class="breadcrumb">   
                <input type="hidden" name="src1" value="<?php echo $_GET['source']; ?>">
                <?php $val1 = $_GET['source']; 
                if($val1 == 'menu'){?>
                <a href="#" class="anchr-tagcolor">Exam</a><a href="#" class="anchr-tagcolor">All Exams</a><a href="home.php?page=mock&source=<?php echo $val1; ?>" class="spanclr"><?php echo $examtype; ?></a><a href="#"><?php echo $exam_type; ?></a></div>
            <br><br>
                <?php }else{?>
                <a href="home.php?page=dashboard" class="anchr-tagcolor">Dashboard</a><a href="home.php?page=mock&source=<?php echo $val1; ?>" class="spanclr"><?php echo $examtype; ?></a><a href="#"><?php echo $exam_type; ?></a></div>
            <br><br><?php }?>
            <div class="" style="background: white;border: 3px solid #375176;">
            <?php if($exam_type==""){ ?>
<center> <h1> 404</h1> <BR> PAGE NOT FOUND</BR></center>
            <?php }else { ?>           
             <div class="row" style="padding: 20px;">
                <div class="container">
               <?php
 date_default_timezone_set("Asia/Calcutta");              
 $cur_date = date('Y-m-d');
 $cur_time = date('H:i:s');
 //echo "SELECT * FROM exam_tbl WHERE 1 and ex_id in (select test_id FROM  test_table WHERE test_type = '$exam_type' order by test_id asc)";
$selExam = $conn->query("SELECT * FROM exam_tbl WHERE 1 and ex_id in (select test_id FROM  test_table WHERE test_type = '$exam_type') order by ex_id DESC");
if($selExam->rowCount() > 0)
{  ?>
                            <table class="table table-strip">
                    <thead style="background: #fd7e14;">
                        <tr>
                            <th>Test</th>
                            <?php if($exam_type=="scheduled"){ ?>
                            <th>Date</th> <?php } ?>
                            <th>Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php    //echo "??".$selExam->rowCount();
                            $cur_time = date('H:i:s');
                            while ($selExamRow = $selExam->fetch(PDO::FETCH_ASSOC)) { 
                                //$schedule_date = $selExamRow["schedule_date"];
                                $ex_id = $selExamRow["ex_id"];
                                $date = $cmn->getvalfield($conn,"test_table","schedule_date","test_id = '$ex_id' and test_type = '$exam_type'");
                                 $schedule_time = $cmn->getvalfield($conn,"test_table","schedule_time","test_id = '$ex_id' and test_type = '$exam_type'"); 
                                 $plus_ten1 = strtotime("+10 minutes", strtotime($schedule_time));
                                 $plus_ten2 = date('H:i:s', $plus_ten1);

                                $its_done = $cmn->getvalfield($conn,"exam_answers","count(*)","exam_id = '$ex_id' and is_mock = 1 and is_finel_sub =1");
                                if($exam_type=="scheduled"){
                                $is_scheduled = $cmn->getvalfield($conn,"test_table","count(*)","test_id = '$ex_id' and schedule_date>='$cur_date' and test_type = '$exam_type' and test_id not in (select test_id from exam_answers where exam_id='$ex_id' and axmne_id = '$exmneId')");}else {
                                    $is_scheduled = $cmn->getvalfield($conn,"test_table","count(*)","test_id = '$ex_id' and test_type = '$exam_type' and test_id not in (select test_id from exam_answers where exam_id='$ex_id' and axmne_id = '$exmneId')");
                                } 
                                //echo "test_id = '$ex_id' and test_type = '$exam_type' and test_id not in (select test_id from exam_answers where exam_id='$ex_id' and axmne_id = '$exmneId')";
                                $ans = 0;
                                $status = "";
                                //echo $plus_ten2;
                                if($is_scheduled>0){

                                    if($cur_time>$plus_ten2 && $exam_type=="scheduled"){
                                       $status = 3;
                                    }else{
                                    $status = 1; }
                                }else if($its_done>0){
                                    $totExam = $conn->query("SELECT COUNT(*) as allque FROM exam_answers WHERE exam_id='$ex_id' and axmne_id = '$exmneId' and is_mock = '1' ")->fetch(PDO::FETCH_ASSOC); 
                                    $over  = $totExam['allque'];
                                    $selScore = $conn->query("SELECT * FROM exam_question_tbl eqt INNER JOIN exam_answers ea ON eqt.eqt_id = ea.quest_id AND eqt.exam_answer_id = ea.exam_answer_id  WHERE ea.axmne_id='$exmneId' AND ea.exam_id='$ex_id' AND ea.is_finel_sub='1' and ea.is_mock = '1' order by eqt_id asc ");
                                    $score = $selScore->rowCount();
                                    $ans = 0;
                                    if($score>0 && $over>0){
                                    $ans = round($score / $over * 100,2);}
                                    $status = 2;
                                    
                                } else {
                                    $status = 3;

                                }
                                //echo "???".$status;
                              ?>
                <tr class="res-row">
                    <td><?php echo $selExamRow['ex_title']; ?></td>
                    <?php if($exam_type=="scheduled"){ ?>
                    <td><?php echo date('d-M-Y',strtotime($date))." ".$schedule_time; ?></td><?php } ?>
                    <td><?php  if($status==1){ 
                                 if($exam_type=="on_demand"){
                        ?>
                        <a href="home.php?page=mock_on_test&mskfjonkdsf=<?php echo openssl_encrypt($selExamRow['ex_id'], $ciphering, 
$key, $options, $iv); ?>&exam_type=on-demand-test" style="text-decoration: none;">Not Attempted</a>      
                        <?php }else  { ?> 
                        <!-- <a href="home.php?page=mock_test&mskfjonkdsf=<?php echo openssl_encrypt($selExamRow['ex_id'], $ciphering, 
$key, $options, $iv); ?>&exam_type=scheduled-test" style="text-decoration: none;"> Scheduled</a> -->
<a href="home.php?page=mock_test&mskfjonkdsf=<?php echo openssl_encrypt($selExamRow['ex_id'], $ciphering, 
$key, $options, $iv); ?>&exam_type=scheduled-test" style="text-decoration: none;"> Scheduled</a>
                        <?php } 
                    } else if($status==2) { if($exam_type=="on_demand"){ 
                    //echo ">>".$exam_id = $cmn->getvalfield($conn,"exam_answers","exam_id","axmne_id='$exmneId' AND is_finel_sub='1' ");
                    $exam_id = $ex_id;
                    $exans_created = $cmn->getvalfield($conn,"exam_answers","exans_created","axmne_id='$exmneId' and exam_id = '$exam_id' AND is_finel_sub='1' ");
                     ?>
                    <a href="home.php?page=mock_results&sdoifrdgdfHJH=<?php echo openssl_encrypt($exam_id, $ciphering, 
$key, $options, $iv); ?>&SDJFOI9SDF=<?php echo openssl_encrypt($exans_created, $ciphering, 
$key, $options, $iv); ?>" > <?php echo $ans." Percentile"; ?> </a><?php } else{ ?><?php } } else if($status==3){ echo "Exam Exipired!"; } ?>
             

                           </td>
                </tr>
                <?php 
            } ?></tbody>
                </table>
            <?php
                 }  else {?>

                    <center><h1 style="text-align: center;color: white;">Exam Comming Soon!</h1></center>

                 <?php  }
                 ?>
            </div> 
      <?php } ?></div></div>
        
        </div>
         
    </div>
