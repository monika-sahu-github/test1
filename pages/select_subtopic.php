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

$_SESSION["is_subtopic"]="yes";

$question_head_id=openssl_decrypt ($_REQUEST['question_head_id'], $ciphering,  

$key, $options, $iv);

//echo $_REQUEST['topic_id'];

$topic_id = "";

if(isset($_REQUEST['topic_id'])){

    $topic_id = $_REQUEST["topic_id"];

}

$topic_id=openssl_decrypt($topic_id, $ciphering, $key, $options, $iv);

 

// function $cmn->getvalfield($conn,$table,$field,$where)

// { 

// $stmt = $conn->prepare("SELECT $field FROM $table WHERE $where"); 

// $stmt->execute(); 

// $row = $stmt->fetch();

// return $row[0];

// }  

//echo "???".$topic_id;

$quehead = $cmn->getvalfield($conn,"main_subject","ex_title","ex_id='$question_head_id'");

$topic_name = $cmn->getvalfield($conn,"subject_quehead","quehead","id='$topic_id'");

$exam_logo = $cmn->getvalfield($conn,"main_subject","exam_logo","ex_id='$question_head_id'");



//echo "SELECT sub_topic_master.id as id, sub_topic_master.sub_topic_name as quehead, count(*) as ctt FROM sub_topic_master as subque INNER JOIN exam_question_tbl as examtbl ON subque.id=examtbl.sub_topic_id GROUP by examtbl.sub_subjecthead_id ORDER BY ctt DESC";

//echo "SELECT subque.id as id, subque.sub_topic_name as sub_topic_name, count(*) as ctt FROM sub_topic_master as subque INNER JOIN exam_question_tbl as examtbl ON subque.id=examtbl.sub_topic_id and subque.topic_id  = '$topic_id' GROUP by examtbl.sub_topic_id ORDER BY ctt DESC";

$selExam = $conn->query("SELECT subque.id as id, subque.sub_topic_name as sub_topic_name, count(*) as ctt FROM sub_topic_master as subque INNER JOIN exam_question_tbl as examtbl ON subque.id=examtbl.sub_topic_id and subque.topic_id  = '$topic_id' GROUP by examtbl.sub_topic_id ORDER BY ctt DESC"); 

 ?>

<style type="text/css">

    .widget-heading{

        font-size: 25px;

    }

    h2{

        color: white;

        text-align: center;

    }

    .exam_headdiv{

        <?php if($type==0){ ?>

        background: linear-gradient(-20deg, #2b5876 0%, #4e4376 100%) !important;

    <?php } else { ?>

        background-image: radial-gradient(circle 248px at center, #16d9e3 0%, #30c7ec 47%, #46aef7 100%) !important;

    <?php  } ?>

    }

</style>
<?php echo "HEllo"; ?>
<div class="app-main__outer">

 <div id="refreshData">

    <div class="app-main__inner">

            <div class="app-page-title">

                <div class="page-title-wrapper">

                    <div class="page-title-heading">

                        <div>Sub Topic(Question)



                        </div>

                    </div>

                     

                 </div>

            </div>        

   <div class="breadcrumb">

    <input type="hidden" name="src1" value="<?php echo $_GET['source']; ?>">

                <?php $val1="";

                if(isset($_REQUEST['source'])){

                $val1 = $_GET['source']; 

                } 

                if($val1 == 'menu'){ ?>     

                    <a href="#" class="anchr-tagcolor">Exam</a><a href="#" class="anchr-tagcolor">All Exams</a><a href="home.php?page=examination_test_type&source=<?php echo $val1; ?>&exam_type=<?php echo $_REQUEST['exam_type']; ?>" class="anchr-tagcolor"><?php echo $examtype; ?></a><a  href="#"><?php echo $quehead; ?></a><a  href="#"><?php echo $quehead; ?></a><a  href="#"><?php echo $topic_name; ?></a><a  href="#"><?php echo $quehead; ?></a><a  href="#"><?php echo ""; ?></a></div><br><br>

                <?php }else{?>

    <a href="home.php?page=dashboard" class="anchr-tagcolor">Dashboard</a><a href="home.php?page=examination_test_type&source=<?php echo $val1; ?>&exam_type=<?php echo $_REQUEST['exam_type']; ?>" class="anchr-tagcolor"><?php echo $examtype; ?></a><a  href="home.php?page=get_subject_quehead&exam_type=<?php echo $_REQUEST['exam_type']; ?>&question_head_id=<?php echo $_REQUEST['question_head_id']; ?>"><?php echo $quehead; ?></a><a  href="#"><?php echo $topic_name; ?></a></div><br><br><?php }?>

 <div class="" style="background: white;border: 3px solid #375176;padding: 0px;">

    <div class="col-md-12 mb-3"></div> 

    <div class="row">

  <div class="col-md-2 mb-3"></div>       

 <div class="col-md-10 col-xl-6">

                    <a href="#" id="" style="text-decoration: none;">

                    <div class="card mb-3 widget-content exam_headdiv">



                        <div class="widget-content-wrapper text-white">

                            <div class="widget-content-left">

                                <div class="widget-heading" style="font-size: 20px"><?php echo $topic_name; ?></div>

                               <center>

                                   <i class="fa fa-<?php echo $exam_logo; ?>" aria-hidden="true" style="font-size: 30px"></i>

                               </center>

                            </div>

                           

                        </div>

                    </div>

                    </a>



                </div>

    </div>

        <?php if($selExam->rowCount() > 0){ ?>   

    <div class="row" style="padding-left: 20px;" >

        <h4 style="text-align: right; ">Choose a Sub Topic</h4> 

    </div><?php } ?> 

    <div class="row" style="padding: 20px;">



               

                

                    <?php 

//$queheadid=openssl_decrypt ($_REQUEST['queheadid'], $ciphering,$key, $options, $iv);

$question_head_id=openssl_decrypt ($_REQUEST['question_head_id'], $ciphering,$key, $options, $iv);

$queheadid=openssl_decrypt ($_REQUEST['queheadid'], $ciphering,$key, $options, $iv);

                       if($selExam->rowCount() > 0) 

                        {      //echo "??".$selExam->rowCount();?>

                         

                           <?php while ($selExamRow = $selExam->fetch(PDO::FETCH_ASSOC)) {

                            $id = $selExamRow['id'];



                    ?>

                    <div class="col-md-3 col-xl-4">

                        <?php 

                          //if($get_sub_topic_query->rowCount() > 0)

                        //{   ?>

                 <?php      // } else {

?>

                    <a href="home.php?page=start_exam&exam_type=<?php echo $_REQUEST['exam_type']; ?>&source=<?php echo $val1; ?>&question_head_id=<?php echo openssl_encrypt($question_head_id, $ciphering, 

$key, $options, $iv); ?>&queheadid=<?php echo openssl_encrypt($queheadid, $ciphering, 

$key, $options, $iv); ?>&subtopic_id=<?php echo openssl_encrypt($id, $ciphering, 

$key, $options, $iv); ?>&is_subtopic=<?php echo openssl_encrypt('yes', $ciphering, 

$key, $options, $iv); ?>" id="practicetest">

                    <div class="card mb-3 widget-content exam_headdiv" style="width: 100%;height: 0px;">

                        <div class="widget-content-wrapper text-white">

                            <div class="widget-content-left">

                                <div class="widget-heading" style="font-size: 20px;"><?php echo $selExamRow['sub_topic_name']."<br>(".$selExamRow["ctt"].")"; ?></div>

                            </div>

                           

                        </div>

                    </div>

                    </a><?php //} ?>

                </div>

                <?php } } else { ?>

                    <a href="#" id="practicetest">

                    <div class="card mb-3 widget-content exam_headdiv" style="width: 500px;height: 0px;">

                        <div class="widget-content-wrapper text-white">

                            <div class="widget-content-left">

                                <div class="widget-heading">No Topics are Available!</div>

                            </div>

                           

                        </div>

                    </div>

                    </a>

                <?php  } ?>

                

            </div></div>

      

        

        </div>

         

    </div>

