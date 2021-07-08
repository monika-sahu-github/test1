<?php 
$_SESSION["exam_session"] = rand(11111,99999);
$decryption=openssl_decrypt ($_REQUEST['exam_type'], $ciphering,  
$key, $options, $iv);  
$type = $decryption;
$examtype = '';
if($type==0){
    $examtype = "Practice Test";
} else if($type==1){
   $examtype = "Mock Test"; 
} 
$question_head_id=openssl_decrypt ($_REQUEST['question_head_id'], $ciphering,  
$key, $options, $iv);
$quehead1 = $cmn->getvalfield($conn,"main_subject","ex_title","ex_id='$question_head_id'");
///////////////////////////////////////////////////////////////////////////////////////
$queheadid=openssl_decrypt ($_REQUEST['queheadid'], $ciphering,  
$key, $options, $iv);

// function $cmn->getvalfield($conn,$table,$field,$where)
// { //echo "SELECT $field FROM $table WHERE $where";
// $stmt = $conn->prepare("SELECT $field FROM $table WHERE $where"); 
// $stmt->execute();  
// $row = $stmt->fetch();
// return $row[0]; 
// }   
$exam_id = $cmn->getvalfield($conn,"subject_quehead","exam_id","id='$queheadid'");
$typeenc = openssl_encrypt($exam_id, $ciphering, 
$key, $options, $iv);
$quehead = $cmn->getvalfield($conn,"subject_quehead","quehead","id='$queheadid'");
  
$selQuestion = $conn->query("SELECT * FROM exam_question_tbl WHERE sub_subjecthead_id='$queheadid' ")->fetch(PDO::FETCH_ASSOC);

//session_start();
//session_destroy();
$sql_dhirajj = "SELECT * FROM exam_question_tbl WHERE sub_subjecthead_id=$queheadid and eqt_id not in( select que_id from exam_que_for_match_tbl where examinee_id = '$examne_id' and sub_id='$queheadid' and is_finel_sub = 1)  ";

$result3 = $conn->query($sql_dhirajj);
   //$result3 = "select count()";
     $num2  = $result3->rowCount();

    //echo $match_max_que_id.">'$queheadid'";
     if($num2>=5){}else {
        $conn->query("DELETE FROM exam_que_for_match_tbl WHERE sub_id = '$queheadid' and examinee_id = '$examne_id'");
$sql_dhiraj11 = "SELECT * FROM exam_question_tbl WHERE sub_subjecthead_id=$queheadid and eqt_id not in( select que_id from exam_que_for_match_tbl where examinee_id = '$examne_id' and sub_id='$queheadid' and is_finel_sub = 1)  ";

$result3 = $conn->query($sql_dhiraj11);
   //$result3 = "select count()";
     $num2  = $result3->rowCount();
 }
 ?>
    <script src="ckeditor/ckeditor.js"></script>
    <script src="ckeditor/samples/js/sample.js"></script>
    <style>
    .attdiv{
        width: 22px;
    height: 22px;
    }
    .revidiv{
        width: 22px;
    height: 22px;
    }
    .skipdiv{
        width: 22px;
    height: 22px;
    }
    .sug{
        font-size:8px;
    }
    .box{
        float:right;
        /*overflow: hidden;*/
         
    } 
    /* Add padding and border to inner content
    for better animation effect */
    .box-inner{
        width: 400px;
        padding: 10px;
        /*border: 1px solid #fcc7a4;*/
    }
    .qtip {
  display: inline-block;
  position: relative;
  cursor: pointer;
  color: #3bb4e5;
  border-bottom: 0.05em dotted #3bb4e5;
  box-sizing: border-box;
  font-style: normal;
  transition:all .25s ease-in-out
}
.qtip:hover {color:#069;border-bottom:0.05em dotted #069}
/*the tip*/
.qtip:before {
  content: attr(data-tip);
  font-size: 17px;
  position: absolute;
  z-index: 1;
  background: rgb(53 82 118);
    border: 1px solid #355276;
  color: #fff;
  line-height: 1.2em;
  padding: 0.5em;
  font-style: normal;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
  min-width: 100px;
  text-align: center;
  opacity: 0;
  visibility: hidden;
  transition: all .3s ease-in-out;
  text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.5);
  font-family: sans-serif;
  letter-spacing: 0;
  font-weight: 600
}
.qtip:after {
  width: 0;
  height: 0;
  border-style: solid;
  content: '';
  z-index: 1;
  position: absolute;
  opacity: 0;
  visibility: hidden;
  transition: all .3s ease-in-out
}
.qtip:hover:before,
.qtip:hover:after {
  visibility: visible;
  opacity: 1
}
/*top*/
.qtip.tip-top:before {
  top: 0;
  left: 50%;
  transform: translate(-50%, calc(-100% - 8px));
  box-sizing: border-box;
  border-radius: 3px;
  /*width: 460px;*/
}
.qtip.tip-top:after {
  border-width: 8px 8px 0 8px;
  border-color: rgb(53 82 118) transparent transparent transparent;
  top: -9px;
  left: 50%;
  transform: translate(-50%, 0);
}
/*left*/
.qtip.tip-left:before {
  left: 0;
  top: 50%;
  transform: translate(calc(-100% - 8px), -50%);
  box-sizing: border-box;
  border-radius: 3px;
}
.qtip.tip-left:after {
  border-width: 8px 0 8px 8px;
  border-color: transparent transparent transparent rgba(10, 20, 30, 0.85);
  left: -8px;
  top: 50%;
  transform: translate(0, -50%);
}
</style>

<style type="text/css">
    .widget-heading{
        font-size: 25px;
    }
    h2{
        color: white;
    background: #375176;
    text-align: center;
    border-radius: 3px;
    padding: 8px;
    }
</style>
<style type="text/css">
        .anchr-tagcolor{
            color: #a6aaad;
            text-decoration: none;
        }
        .anchr-tagcolor:hover{
            color: white;
            text-decoration: none;
        }
        .spanclr{
           color: #a6aaad; 
        }
        .spanclr:hover{ 
            color: white;
        }
        .arrow{
           color: #a6aaad; 
        }
        #hiddenPanel {position:fixed; top:0; right:-200px; width:200px; background-color:grey; height:250px;}
#close-bar { position:absolute; left:-20px; background:red; color:white; width:20px; height:250px;}
.swal2-title{ color: white !important;padding: 15px;
    border-radius: 4px;  }

    @media only screen and (max-width: 600px) {
   #examtime{
    
    margin-top: 10px !important;
    width: 100%;
   }
   #select_no_of_question{
    width: 100% !important;
    padding: 20px !important;
   }
   #fflgdiv{
    width: 100% !important;
   }
   #allbtndiv{
    padding-right: 6px !important;
   }
   #timerdiv{
  width: 100% !important;
}
.bubblediv{
    width: 90% !important;
    margin-left: 67px;
}
}

#timer{

}
#timerdiv{
  margin-left: 30px;
   /* background: #355276;*/
    display: none;text-align: center;
    border-radius: 4px;
    padding: 1px;
}
.stbtn{
  width: 100%;
}
#leavnow{
  border: 1px solid #bdc0c1;
    color: black !important;
    padding: -6px;
    width: 134px;
    text-align: center;
    background: #e0e3ec;
    float: right;
    font-weight: 900;
}
 #flagdiv3{
display: none;
  }
  #flagdiv{
display: block;
  }
@media only screen and (max-width: 600px) {
  #flagdiv3{
display: block;
 
    padding: 5px;
  }
  #flagdiv{
display: none !important;
  }

  .stbtn {
    margin-top: 10px;
  }
  .btn-div{
    padding: 20px;
  }
  #leavnow{
  margin-left: 0px;
  margin-top: 23px;
}
#canclebtn{
margin-left: -0px !important;
    margin-top: 10px;
}
#gotres{
  margin-left: 0px !important;
}
#noquesel{
  width: 100% !important;
}
}
input[type="radio"]{
  width: 37px;
    height: 19px;
}
.sug{
  padding-right: 4px !important;
    padding-left: 2px !important;
}
.tip {
    
    text-decoration: none
}
.tip:hover {
    /*cursor: help;*/
    position: relative
}
.tip div {
    display: none
}
.tip:hover div {
    border: #c0c0c0 1px dotted;
    padding: 5px 20px 5px 5px;
    display: block;
    z-index: 100;
    background: #f1f4f6;
    color: black;
   /*background: white;*/
   text-align: left;
    left: -311px;
    margin: 10px;
    width: 295px;
    position: absolute;
    top: -158px;
    text-decoration: none;
    
}
#next_que{
  background-color: #d92550 !important;
  border: 1px solid #d92550 !important;
}
#next_que:hover{
  background-color: #e26584 !important;
  border: 1px solid #e26584 !important;
} 
#skip{
  padding-left: 7px;
}
    </style>
<style type="text/css">
.boxed label {
  display: inline-block;
  width: 73px;
    height: 30px;
    font-size: 18px;
    text-align: center;
    border-radius: 40px;
  padding: 0px;
  border: solid 2px #484676;
  transition: all 0.3s;
  background: #474575;
  color: white;
  cursor: pointer;
}

.boxed input[type="radio"] {
  display: none;
}

.boxed input[type="radio"]:checked + label {
border: solid 2px #ff9933;
    /* background: #9a6f06; */
    background: #ff9933;
}
h5{
  text-decoration: underline;
}
#fflgdiv{
height: 357px;
    overflow-y: scroll;
    overflow-x: hidden;
}
ol{
    margin-left: 32px;
}
ol {
  counter-reset: list;
}
ol > li {
  list-style: none;
}
ol > li:before {
  content: "(" counter(list, lower-alpha) ") ";
  counter-increment: list;
}
 .selq_div{
/* width: 50%; */
    background: #fdfdfd;
    border-radius: 20px;
    color: black;
    font-size: 16px;
    /* font-weight: 700; */
    padding: 17px;
    border: 1px solid #90939c;
 }
 .swatch-holderi{
  width: 22px !important;
    height: 22px !important;
 }
 .instruction_div{
  font-size: 15px !important;
 }
 #leavnow{
  display: none;
 }
 #start_exam{
  font-size: 15px;
    width: 100px;
 }
 .timemin{
    background: #6d6c6c;
    color: white;
    padding: 5px;
    border-radius: 5px;
 }
 #queandflagdiv{
  margin-top: 15px;
 }
 #allbtndiv{
  margin-top: 15px;
 }
 #showquestion{

    height: 415px; 
    overflow-x: hidden;
    overflow-y: scroll;
    display: none;
    margin-top: 25px;
}.qus_div{
  margin-top: -24px;
}
</style>    
<script type="text/javascript">

//$( document ).ready(function() {
    
//});
</script>
 
<div class="app-main__outer">
 <div id="refreshData">
    <div class="app-main__inner">    
<!-- <div class="row">

         <div class="breadcrumb">   <a href="home.php" class="anchr-tagcolor">Dashboard</a><a href="home.php?page=examination_test_type&exam_type=<?php echo $_REQUEST['exam_type']; ?>" class="anchr-tagcolor"><?php echo $examtype; ?></a>

    <a href="home.php?page=get_subject_quehead&exam_type=<?php echo $_REQUEST['exam_type']; ?>&question_head_id=<?php echo $_REQUEST['question_head_id']; ?>" class="anchr-tagcolor"><?php echo $quehead1; ?></a>

    <a href="#" class="spanclr"><?php echo $quehead; ?></a></div>
</div> -->

  <div class="row">
         <div class="breadcrumb">   
          <input type="hidden" name="src1" value="<?php echo $_GET['source']; ?>">
                <?php $val1 = $_GET['source']; 
                if($val1 == 'menu'){?>
                  <a href="#" class="anchr-tagcolor">Exam</a><a href="#" class="anchr-tagcolor">All Exams</a>
                  <a href="home.php?page=examination_test_type&source=<?php echo $val1; ?>&exam_type=<?php echo $_REQUEST['exam_type']; ?>" class="anchr-tagcolor"><?php echo $examtype; ?></a><a href="home.php?page=get_subject_quehead&exam_type=<?php echo $_REQUEST['exam_type']; ?>&source=<?php echo $val1; ?>&question_head_id=<?php echo $_REQUEST['question_head_id']; ?>" class="anchr-tagcolor"><?php echo $quehead1; ?></a><a href="#" class="spanclr"><?php echo $quehead; ?></a>
                <?php }else{?>
          <a href="home.php" class="anchr-tagcolor">Dashboard</a><a href="home.php?page=examination_test_type&source=<?php echo $val1; ?>&exam_type=<?php echo $_REQUEST['exam_type']; ?>" class="anchr-tagcolor"><?php echo $examtype; ?></a><a href="home.php?page=get_subject_quehead&source=<?php echo $val1; ?>&exam_type=<?php echo $_REQUEST['exam_type']; ?>&question_head_id=<?php echo $_REQUEST['question_head_id']; ?>" class="anchr-tagcolor"><?php echo $quehead1; ?></a><a href="#" class="spanclr"><?php echo $quehead; ?></a><?php }?></div>
</div>

    <div class="row" style="background: white;border: 3px solid #375176;padding: 0px;">
<input type="hidden" name="cntquee" id="cntquee" value="ll" >
<div class="col-sm-12">
</div> 

 <div class="col-md-12 col-xl-12" style="padding-top: 15px;padding-bottom: 20px;">
    <input type="hidden" name="eqt_id" id="eqt_id">
    <input type="hidden" name="cntque" id="cntque">
    <input type="hidden" name="cntque2" id="cntque2" value="1" >
    <input type="hidden" name="exam_comp" id="exam_comp" value="" >
    <input type="hidden"  name="answers"> 
    <input type="hidden"  name="exam_id" id="exam_id" value="<?php echo $exam_id; ?>"> 
    <input type="hidden" name="examne_id" id="examne_id" value="<?php ?>" >
    <input type="hidden" name="for_previous_id" id="for_previous_id" >
    <input type="hidden" name="queheadid" id="queheadid" value="<?php echo $queheadid; ?>" >
    <input type="hidden" name="impque" id="impque">
    <?php  $sql2 = "select * from exam_question_tbl where sub_subjecthead_id='$queheadid'";
    $result2 = $conn->query($sql2);
    
    $match_maxid1 = $cmn->getvalfield($conn,"exam_que_for_match_tbl","max(id)","sub_id = '$queheadid' and examinee_id = '$examne_id' and is_finel_sub = 1");
      $match_max_que_id = $cmn->getvalfield($conn,"exam_que_for_match_tbl","que_id","id = '$match_maxid1'");
    $max_que_id = $cmn->getvalfield($conn,"exam_question_tbl","max(eqt_id)","sub_subjecthead_id='$queheadid'");
    $sql_easy = "(SELECT * FROM `exam_question_tbl` WHERE `dificulty_level` = 1 AND `sub_subjecthead_id` = '$queheadid')";
$sql_medium = "(SELECT * FROM `exam_question_tbl` WHERE `dificulty_level` = 2 AND `sub_subjecthead_id` = '$queheadid')";
$sql_hard = "(SELECT * FROM `exam_question_tbl` WHERE `dificulty_level` = 3 AND `sub_subjecthead_id` = '$queheadid')";
$sqlf  = $sql_easy.' UNION '.$sql_medium.' UNION '.$sql_hard;
$sql_dhiraj = "SELECT * FROM exam_question_tbl WHERE sub_subjecthead_id=$queheadid and eqt_id not in( select que_id from exam_que_for_match_tbl where examinee_id = '$examne_id' and sub_id='$queheadid')  ";
$result3 = $conn->query($sql_dhiraj);

     $num2  = $result3->rowCount();
    ?>

    <!-- </div> -->
    <div class="row" id="queandtimediv" style="padding-left: 10px;">
      <div class="col-sm-10">
         <h5 id="ins_tag"><b>Instructions :</b></h5>
        <div class="col-sm-4 tim-que-sec">
    <span style="background-color: #ff9933;
    font-size: 15px;color: white;
    padding: 0px;
    padding-left: 35px;
    border-radius: 3px; display: none;" id="showquestion_att">Question</span>
    
     </div><div class="col-sm-4 tim-que-sec">
      <div id="timerdiv">Time Left - <span id="timer" style="display: none;"></span>  <span id="minutes" class="timemin"></span> : <span id="seconds" class="timemin" ></span></div>
    <input type="text" readonly="" name="examtime" id="examtime" > 
     </div>
       </div><div class="col-sm-2"><a href="home.php" class="btn btn-danger qtip tip-top" data-tip="Quit Test" id="leavnow">Quit Test</a> </div></div>

           <!-- <div style="    width: 50%;
    background: #f7b924;
    border-radius: 3px;
    color: white;font-size: 21px;font-weight: 700;
    padding: 4px;"  id="select_no_of_question"> -->

    <div class="container" id="select_no_of_question">
     
          <div class="instruction_div"> 
     1. The Questions Palette going to be displayed on the RHS of the screen will show the status of each question using one of the following patterns:<br>
     <div class="swatch-holder bg-success swatch-holderi" data-class="bg-success header-text-dark">
                                        </div> You have answered a question<br>
                                        <div class="swatch-holder bg-warning swatch-holderi" data-class="bg-warning header-text-dark">
                                        </div>  You have skipped a question.<br>
                                        <div class="swatch-holder bg-danger swatch-holderi" data-class="bg-danger header-text-light">
                                        </div>  You have not answered a question.
    <br><br>
    2. To answer a question, do the following:<br><br>
    <ol type="a"><li>Click on any question number in the Question Palette at the RHS of the screen to directly go to that question.Please <b>Note</b> this will <b>not</b> submit/save your answer to your current question.</li><br><li>Check on <b>Save &amp; Next</b> to save your answer for the current question and then go to the next question.</li><br><li>Click on <b>Mark for Review <span class="hide-on-railway">&amp; Next</span></b> to flag it to review it later and to go to the next question.</li></ol>
    </div>
    
<div class="selq_div"  id="noquesel">

     <label>Select No. of Questions
      <br><br>
      <form class="boxed">
    <?php if($num2>=5){ ?> 
    <input type="radio" name="no_of_que" id="no_of_que5" value="5" required="" > 
     <label for="no_of_que5">5</label>
    <?php } if($num2>=10){ ?>
    <input type="radio" required="" id="no_of_que10" name="no_of_que" value="10" required="" >
    <label for="no_of_que10">10</label>
    <?php } if($num2>=20){ ?>
    <input type="radio" name="no_of_que" id="no_of_que20" value="20" required="" >
    <label for="no_of_que20">20</label>
    <?php } ?> 
    <?php if($num2>=30){ ?>
    <input type="radio" name="no_of_que" id="no_of_que30" value="30" required="" >
    <label for="no_of_que30">30</label>
    <?php  } ?>
    <?php if($num2>=40){ ?>
    <input type="radio" name="no_of_que" id="no_of_que40" value="40" required="" >
    <label for="no_of_que40">40</label>
    <?php  } ?>
    <?php if($num2>=50){ ?>
    <input type="radio" name="no_of_que" id="no_of_que50" value="50" required="" >
    <label for="no_of_que50">50</label>
    <?php  } ?>
    <?php if($num2>=80){ ?>
    <input type="radio" name="no_of_que" id="no_of_que80" value="80" required="" >
    <label for="no_of_que80">80</label>
    <?php  } ?>
    <?php if($num2>=100){ ?>
    <input type="radio" name="no_of_que" id="no_of_que100" value="100" required="" >
    <label for="no_of_que100">100</label>
    <?php  } ?>

    </label><br><br>
    
    <div id="time-select">
      <span>Time Bound - </span>
      <input type="radio" name="timebond" id="timebond1" checked="" value="1"><label for="timebond1">Yes</label> <input type="radio" name="timebond" id="timebond2" value="0"> <label for="timebond2">No</label>
    </div>
    </form>
  </div>                
            </div>        <!-- <div class="row" id="showquestion"> 

                  
              </div> -->
              
              <div class="row" id="queandflagdiv" >
                     <div class="col-sm-1" style="text-align: right;">  </div>
                      <div class="col-sm-8 qus_div">

                        <label id="currentqueno"  style="display: none"></label>
                         <div  id="showquestion">
                             
                         </div> 
 
                      </div>
                      <div class="col-sm-3" id="flagdiv"></div>
              </div>
            <div class="row" id="start_button" >
                 <div class="col-sm-1"></div>
                <div class="col-sm-9">
                  <center>
                  <?php $verify = "SELECT verify_status from examinee_tbl WHERE exmne_id = $examne_id";
                             $result = $conn->prepare($verify);
                             $result->execute();
                             $status = $result->fetch(PDO::FETCH_ASSOC);
                             $verify_status=$status["verify_status"];
                            // foreach($status as $verify_status){
                if($verify_status == 0){?>
                        <input id="duplicate" class="btn btn-warning" type="button" name="start_exam" value="Start Exam" ><?php } else{ ?>
                        <input id="start_exam" class="btn btn-warning" type="button" name="start_exam" value="Start" ><?php }//}?></center></div>
                    </div>
              <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-8" id="allbtndiv" style="padding-right: 35px;">
                
                    <div class="row" id="allbutton" style="display: none;">
    <div class="row btn-div">
    <div class="col-sm-3"><input id="previous_que" onclick="" class="btn btn-info stbtn" type="button" name="previous" value="Previous" ></div>
   <div class="col-sm-3" >
       <input id="skip" style="" onclick="" class="btn btn-warning stbtn" type="button" name="skip" value="Review Letter & Next" >
    </div>
    <div class="col-sm-3" style="" >
      <input type="submit" id="save_and_next" style="padding-left: 35px;
    padding-right: 35px;" name="submit" class="btn btn-success stbtn" value="Save & Next">
    </div>
        <div class="col-sm-3" >
      <input id="next_que" onclick="" style="padding-left: 25px;
    padding-right: 25px;" class="btn btn-info stbtn" type="button" name="question" value="Skip & Next" >
     </div>
    </div>
</div>

</div></div>
<div id="flagdiv3" >
<div class="row" id="flagdiv2">

</div>
</div>
                </div>
               
                <div class="col-md-6 col-xl-4">
    
                </div>

            </div>
      <br>
        <div class="row" id="finelysub" style="background: white;border: 3px solid #375176;padding: 20px;display: none;">
            <input type="submit" id="mainsubmit" style="" name="submit" class="btn btn-warning" value="Submit Your Exam">
        </div>
        </div>
         
    </div>
<script src="jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
    function timer(se){
     //alert("ok"); 
 var mm = Math.floor(se / 60);
 var ss = Math.floor(se % 60);
//alert(mm+'-'+ss); 
 if(mm < 10)
  mm = '0'+mm;
 if(ss < 10)
  ss = '0'+ss;
 se --;
 
 document.getElementById("timer").innerHTML = mm + ":" + ss;
 document.getElementById("minutes").innerHTML =mm;
 document.getElementById("seconds").innerHTML = ss;
// document.getElementById("ans_fix_time").value = mm + ":" + ss;
 
 if(ss >= 0 && mm >= 0){
     
 ssee = window.setTimeout('timer('+se+');','1000');

 }else{
  clearInterval(ssee);
  examtimeend();
 
 } } 
</script> 
<?php //include 'exam_js.php'; ?>
<script>
$('input[name="no_of_que"]').click(function(){
    no_of_que = $("input[name='no_of_que']:checked").val();
    if(no_of_que!='' && no_of_que!=undefined){
     $("#cntque").val(no_of_que);
    } else {
   
    }
});

function showdiv(k){
    var element = document.getElementsByClassName('toggle_btn');
    if(k % 2 == 0) {
    $(".toggle_btn").html(">>");
    $(".toggle_btn").attr('data-tip', 'Hide');
    //$("#kkk").style.left = null;
    $(".toggle_btn").animate({left: '0%'});
        $(".toggle_btn").animate({right: '0px'});
 //document.getElementsByClassName('showmark').style.display='block';
 $(".showmark").css("display", "block");
        document.getElementById('showmark').style.display='block';
        document.getElementById('flagdiv').style.border = '1px solid #65839d3d';
        document.getElementById('flagdiv').style.background = 'rgba(147, 208, 255, 0.07)';
        document.getElementById('flagdiv').style.padding = '5px';


        document.getElementById('flagdiv2').style.border = '1px solid #65839d3d';
        document.getElementById('flagdiv2').style.background = 'rgba(147, 208, 255, 0.07)';
        document.getElementById('flagdiv2').style.padding = '5px';
        //document.getElementById('fflgdiv').style.display='block';

    } else{
      $(".toggle_btn").html("<<");
     $(".toggle_btn").attr('data-tip', 'Show');
$(".showmark").css("display", "none");
     $(".toggle_btn").animate({left: '86%'});
        
     document.getElementById('flagdiv').style.border = '';
     document.getElementById('flagdiv').style.background = '';
     document.getElementById('flagdiv').style.padding = '0px';

     document.getElementById('flagdiv2').style.border = '';
     document.getElementById('flagdiv2').style.background = '';
     document.getElementById('flagdiv2').style.padding = '0px';

    }
      $(".box").animate({
                width: "toggle"
            });
    $(".toggle_btn").removeAttr('onclick');
    $(".toggle_btn").unbind('click')    
    $('.toggle_btn').click(function() {showdiv(++k)});
}
</script>
<script type="text/javascript">
window.onbeforeunload = function() {
return "You have some unsaved changesss"; 
     
};

</script>
<script type="text/javascript">
  var elem = document.getElementById('body'); elem.webkitRequestFullscreen();
  function openFullscreen() {

  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.mozRequestFullScreen) { /* Firefox */
    elem.mozRequestFullScreen();
  } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE/Edge */
    elem.msRequestFullscreen();
  }
}


function closeFullscreen() {
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.mozCancelFullScreen) { /* Firefox */
    document.mozCancelFullScreen();
  } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) { /* IE/Edge */
    document.msExitFullscreen();
  }
}
</script>
<script type="text/javascript">
                        function set_option(w)
                        { 
                           if (document.getElementById('op'+w).checked) {
                            
                             document.getElementById('op'+w).checked=false;
                             document.getElementById('pt'+w).style.background='';
                           //document.getElementById('pt'+w).style.width='520px';
                           document.getElementById('pt'+w).style.border='';
                          }else {
                          document.getElementById('op'+w).checked=true;
                          document.getElementById('pt'+w).style.background='#f2f9ff';
                           //document.getElementById('pt'+w).style.width='520px';
                           document.getElementById('pt'+w).style.border='1px solid #d4dfe8';

                           if(w==1){
                            document.getElementById('op2').checked=false;
                            document.getElementById('op3').checked=false;
                            document.getElementById('op4').checked=false;
                          document.getElementById('pt3').style.background='white';
                          document.getElementById('pt2').style.background='white';
                          document.getElementById('pt4').style.background='white';

                          document.getElementById('pt3').style.border='white';
                          document.getElementById('pt2').style.border='white';
                          document.getElementById('pt4').style.border='white';
                          // document.getElementById('pt'+w).style.width='520px';

                           } else if(w==2){
                            document.getElementById('op1').checked=false;
                            document.getElementById('op3').checked=false;
                            document.getElementById('op4').checked=false;
                          document.getElementById('pt3').style.background='white';
                          document.getElementById('pt1').style.background='white';
                          document.getElementById('pt4').style.background='white';

                          document.getElementById('pt3').style.border='white';
                          document.getElementById('pt1').style.border='white';
                          document.getElementById('pt4').style.border='white';

                           } else if(w==3){
                            document.getElementById('op1').checked=false;
                            document.getElementById('op2').checked=false;
                            document.getElementById('op4').checked=false;
                          document.getElementById('pt2').style.background='white';
                          document.getElementById('pt1').style.background='white';
                          document.getElementById('pt4').style.background='white';

                          document.getElementById('pt2').style.border='white';
                          document.getElementById('pt1').style.border='white';
                          document.getElementById('pt4').style.border='white';
                           } else if(w==4){
                            document.getElementById('op1').checked=false;
                            document.getElementById('op2').checked=false;
                            document.getElementById('op3').checked=false;
                          document.getElementById('pt2').style.background='white';
                          document.getElementById('pt1').style.background='white';
                          document.getElementById('pt3').style.background='white';

                          document.getElementById('pt2').style.border='white';
                          document.getElementById('pt1').style.border='white';
                          document.getElementById('pt3').style.border='white';
                           }

                        } }
                      </script>
