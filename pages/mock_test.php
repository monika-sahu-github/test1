<?php 
$type = "";
$examtype = '';
$exam_id2 = $_REQUEST['mskfjonkdsf'];
$exam_id=openssl_decrypt($_REQUEST['mskfjonkdsf'], $ciphering,  
$key, $options, $iv);
 date_default_timezone_set('Asia/Calcutta');
$conn->query("DELETE FROM exam_que_for_match_tbl WHERE exam_id = '$exam_id' and examinee_id = '$examne_id'");

//echo "select * FROM exam_answers WHERE exam_id = '$exam_id' and axmne_id = '$examne_id'";
$query = $conn->query("select * FROM exam_answers WHERE exam_id = '$exam_id' and axmne_id = '$examne_id' and mock_type = 'scheduled'");
$is_attempted_exam = $query->rowCount();

$sql_dhiraj = "SELECT * FROM exam_question_tbl WHERE sub_subjecthead_id=$queheadid and eqt_id not in( select que_id from exam_que_for_match_tbl where examinee_id = '$examne_id' and exam_id='$exam_id' and is_finel_sub = 1)  ";
$quehead = $cmn->getvalfield($conn,"exam_tbl","ex_title","ex_id='$exam_id'");
$exam_type = "";
if(isset($_REQUEST["exam_type"])){
    $exam_type =    $_REQUEST["exam_type"];
    if($exam_type=="scheduled-test"){
        $exam_type = "scheduled";
        $exam_type2 = "Scheduled";
    }else if($exam_type=="on-demand-test"){
        $exam_type = "on_demand";
        $exam_type2 = "On Demand";
    }
}
$extime = $cmn->getvalfield($conn,"test_table","schedule_time","test_id='$exam_id' and test_type = '$exam_type'");
$end_time = $cmn->getvalfield($conn,"test_table","end_time","test_id='$exam_id' and test_type = '$exam_type'");
$cur_date = date('Y-m-d');

$exam_date = $schedule_date = $cmn->getvalfield($conn,"test_table","schedule_date","test_id='$exam_id' and test_type = '$exam_type'");
$st_time = date('H:i:s',strtotime($extime));
 $ed_timt = date('H:i:s',strtotime($end_time));

$cur_time = date('H:i:s');
 function newtime($time,$minute=10){
    $time=strtotime($time);
    $m=date("i",$time)*1;
    $h=date("h",$time)*1;
    $minutee = date("i",$minute)*1;
    if($m>=$minute){
        //$h=$h-1;
        $minute=$minutee-10;
    }
    if($m<$minutee){
        $h=$h-1;
    }
    return date("h:i",strtotime($h.":".$minute));
}
//echo $st_time;
$plus_ten1 = strtotime("+10 minutes", strtotime($st_time));
$plus_ten2 = date('H:i:s', $plus_ten1);

$hhlf_timee = strtotime("-10 minutes", strtotime($st_time));
$half_an_hour = $hhlf_time=date('H:i:s', $hhlf_timee);

//$end_timee = strtotime("+10 minutes", strtotime($end_time));
//echo "???".$before_end_exam=date('H:i:s', $end_timee);

$_SESSION['START_TIME_SESSION'] = strtotime($st_time)-strtotime($cur_time);
$_SESSION['END_TIME_SESSION'] = strtotime($ed_timt)-strtotime($cur_time);
//$exam_time = date('H:i:s',strtotime($extime));
 ?>
    <script src="ckeditor/ckeditor.js"></script>
    <script src="ckeditor/samples/js/sample.js"></script>
    <style>
    .box{
        float:right;
    } 
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
            color: red;
            text-decoration: none;
        }
        .spanclr{
           color: #a6aaad; 
        }
        .spanclr:hover{ 
            color: red;
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
}

#timer{

}
#timerdiv{
  margin-left: 30px;
    background: #355276;
    color: white; display: none;text-align: center;
    width: 110px;
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
@media only screen and (max-width: 600px) {
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
}
input[type="radio"]{
  width: 37px;
    height: 19px;
}
.sug{
  padding-right: 1px !important;
    padding-left: 1px !important;
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
    left: -583px;
    margin: 10px;
    width: 565px;
    position: absolute;
    top: -158px;
    text-decoration: none
}
#flagdiv{
  display: none;
}
#exam_no_schedule_divv{
  padding: 80px;
    background: #325376;
    color: white;
    width: 100%;
    font-size: x-large;text-align: center;
}
.table-strip{
  background: #3f6ad8;
    color: white;
}
#start_exam{float: right;}
.achievers-exam-div{
  background: white;border: 3px solid #375176;padding: 0px;
}
    </style>
<div class="app-main__outer">
 <div id="refreshData">
    <div class="app-main__inner">   
<div class="row">
<span class="arrow" >MOCK TEST - </span><span class="spanclr"><?php echo $quehead; ?> SCHEDULED</span>
</div>
    <div class="row achievers-exam-div" id="achievers-exam-div">
<?php //echo $exam_date ."==". $cur_date ."&&". $hhlf_time."<=".$cur_time ."&&". $ed_timt.">=".$cur_time;
 if($exam_date == $cur_date && $half_an_hour<=$cur_time && $ed_timt>=$cur_time){ 
     if($is_attempted_exam>0){ ?>
    <div class="page" id="exam_no_schedule_divv" style="">
    <div class="question-area">
        
        <h3 style="font-weight: 600;color:white;">Finished Your Exam!</h3>
    </div>
</div>
     <?php } else if($cur_time>$plus_ten2){
?>
<div class="page" id="exam_no_schedule_divv" style="">
    <div class="question-area">
        
        <h3 style="font-weight: 600;color:white;">Sorry you can't get an exam.</h3>
        <p>because you are late for exam</p>
    </div>
</div>
<?php
     } else {
  ?>
  <div class="col-sm-6">
<center><span id="showdiv_datetime" style="background: #3f6ad8;padding: 3px;font-size: 10px;border-radius: 5px;
    color: white;"><b>
        Exam Date : <?php echo date('d-m-Y',strtotime($exam_date)); ?> &nbsp; 
        Start Time : <?php echo $st_time; ?> &nbsp;&nbsp;End Time: <?php echo $end_time; ?></b></span></center></div>
        <div class="col-sm-4"> 
    <center style="margin-top: 3px;" ><div id="start_timer_div" style="font-size: 40px;<?php if($exam_date == $cur_date && $st_time<=$cur_time && $ed_timt>=$cur_time){ ?>display:none;<?php } ?>
    background: #3f6ad8;border-radius: 5px;
    color: white;
    width: 112px;
    padding: 0px;">
          <p style="font-size: 11px !important;
    margin-bottom: -10px;">Exam Start After</p><span id="timeri"></span>
      </div>
                <div  id="time_left_div" style="font-size: 40px; background: #e41803;border-radius: 5px;display: none;
    color: white;">
<p style="font-size: 11px !important;font-weight: 900;border-radius: 5px;
    margin-bottom: -10px;">Exam End After - <span id="timeri2"></span>
</p></div>
    </center></div><div class="col-sm-2"><a href="home.php" class="btn btn-danger qtip tip-top" data-tip="Quit Test" id="leavnow">Quit Test</a> </div> 

<input type="hidden" name="cntquee" id="cntquee" value="ll" >

<div class="col-md-12 col-xl-12" id="exam_schedule" style="padding-top: 15px;padding-bottom: 20px;">
  <input type="hidden" name="exam_time" id="exam_time" value="<?php echo $exam_time; ?>">
    <input type="hidden" name="eqt_id" id="eqt_id">
    <input type="hidden" name="cntque" id="cntque">
    <input type="hidden" name="cntque2" id="cntque2" value="1" >
    <input type="hidden" name="exam_comp" id="exam_comp" value="" >
    <input type="hidden"  name="answers"> 
    <input type="hidden"  name="exam_id" id="exam_id" value="<?php echo $exam_id; ?>">
    <input type="hidden"  name="exam_id2" id="exam_id2" value="<?php echo $exam_id2; ?>"> 
    <input type="hidden" name="examne_id" id="examne_id" value="<?php ?>" >
    <input type="hidden" name="for_previous_id" id="for_previous_id" >
    <input type="hidden" name="queheadid" id="queheadid" value="<?php echo $queheadid; ?>" >
    <input type="hidden" name="impque" id="impque">
    <div class="row" id="queandtimediv" style="padding-left: 10px;">
      <div class="col-sm-10">
        <div class="col-sm-5 tim-que-sec">
    <span style="background-color: rgb(240 173 78);
    font-size: 20px;color: white;
    padding: 20px;font-weight: 700;
    border-radius: 3px; display: none;" id="showquestion_att">Question</span>
    
     </div><div class="col-sm-4 tim-que-sec">
      <div id="timerdiv">Remaining Time <br><span id="timer"></span></div>
    <input type="text" readonly="" name="examtime" id="examtime" > 
     </div>
       </div></div>
               <div class="col-sm-12" id="instruct_div">
  <label style="text-decoration: underline;">Instruction</label>
  <table class="table table-strip" >
    <tr><td>1.</td><td>This exam has 100 questions with duration of 2 hours (120 mins). </td></tr>
    <tr><td>2.</td><td>Total mark 200. There will be negative marking. </td></tr>
    <tr><td>3.</td><td>Each question will be …..  . </td></tr>
  </table>
</div><br><br>
              <div class="row" id="queandflagdiv" >
                     <div class="col-sm-1" style="text-align: right;">  </div>
                      <div class="col-sm-8" style="margin-top: -15px;">

                        <label id="currentqueno"  style="display: none"></label>
                         <div  id="showquestion"></div> 

                      </div>
                      <div class="col-sm-3" id="flagdiv"></div>
              </div>
 
             <div id="showeditor" style="display: none;"><div id="editor">
           
        </div></div><br> <br>
            <div class="row" id="start_button" >
                  

                <div class="col-sm-12"> 
                        <!-- <input id="start_exam" class="btn btn-success" type="button" name="start_exam" value="Start Exam" > -->
                             <!--  <a style="padding-left: 40px;<?php if($exam_date == $cur_date && $st_time<=$cur_time && $ed_timt>=$cur_time){ ?><?php } else { ?>display:none;<?php } ?>
    " id ="dynamic_image" href="#">
        <img  src="img/start.gif" id="start_exam" style="height: 210px !important;float: right;
    width: 280px !important;"></a>
    
    <img id ="static_image" src="img/start_static.gif" style="margin-left: 40px;height: 210px !important;float: right;
    width: 280px !important;<?php if($exam_date == $cur_date && $st_time<=$cur_time && $ed_timt>=$cur_time){ ?>display:none;<?php } ?>"> -->
    <div id="dynamic_image">
  <input type="submit" <?php if($exam_date == $cur_date && $st_time<=$cur_time && $ed_timt>=$cur_time){ ?><?php } else { ?>disabled=""<?php } ?> value="Start Test" name="start_exam" id="start_exam" class="btn btn-warning">
</div>
</div>
                    </div>
              <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-8" id="allbtndiv" style="padding-right: 35px;">
                
                    <div class="row" id="allbutton" style="display: none;">
    <div class="row btn-div">
    <div class="col-sm-3"><input id="previous_que" onclick="" class="btn btn-info stbtn" type="button" name="previous" value="<< Previous" ></div>
   <div class="col-sm-3" style="display: none !important;">
       <input id="skip"  onclick="" class="btn btn-warning stbtn" type="button" name="skip" value="Mark For Review" >
    </div>
    <div class="col-sm-3" >
      <input type="submit" id="save_and_next" style="padding-left: 35px;
    padding-right: 35px;" name="submit" class="btn btn-success stbtn" value="Save">
    </div>
        <div class="col-sm-3" >
      <input id="next_que" onclick="" style="padding-left: 25px;
    padding-right: 25px;" class="btn btn-info stbtn" type="button" name="question" value="Next >>" >
     </div>
    </div>
</div>

</div></div>
                </div>
               
                <div class="col-md-6 col-xl-4">
    
                </div>
          <?php } } else {
$time1 = new DateTime($exam_date." ".$st_time);
$time2 = new DateTime($cur_date." ".$cur_time);
$timediff = $time1->diff($time2);
//echo $timediff->format('%y year %m month %d days %h hour %i minute %s second')."<br/>";
  ?>

        <!--     <div class="page" id="exam_no_schedule_divv" style="">
    <div class="question-area">
        
        <h3 style="font-weight: 600;color:red;">Exam Not Schedule!</h3>
    </div>
</div> -->
<div class="page" id="exam_no_schedule_divv" style="">
    <div class="question-area">
        <div >Scheduled Test on <?php echo date('d-M-Y',strtotime($exam_date)); ?></div><br>
<span id="daytime">Test will start in <?php echo $timediff->format('%d Days: %h hours: %i minutes')."<br/>"; ?></span>

    </div>
</div>

          <?php } ?>    <div class="page" id="exam_no_schedule_div" style="display:none;">
    <div class="question-area">
        
        <h1 style="font-weight: 600;color:white;">Exam End!</h1>
    </div>
</div>
            </div>
      <br>
        <div class="row" id="finelysub" style="background: white;border: 3px solid #375176;padding: 20px;display: none;">
            <input type="submit" id="mainsubmit" style="" name="submit" class="btn btn-warning" value="Submit Your Exam">
        </div>
        </div>
         
    </div>
    <input type="text" style="display:none;" readonly="" id="timeri2" >
<script src="jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
  timeri2('<?php echo $_SESSION['END_TIME_SESSION']; ?>');
      function timeri2(se){
      
 var mm = Math.floor(se / 60);
 var ss = Math.floor(se % 60);
 
 if(mm < 10)
  mm = '0'+mm;
 if(ss < 10)
  ss = '0'+ss;
 se --;
 
 document.getElementById("timeri2").value = mm + ":" + ss;
 document.getElementById("timeri2").innerHTML = mm + ":" + ss;
// document.getElementById("ans_fix_time").value = mm + ":" + ss;
 
 if(ss >= 0 && mm >= 0){
     
 ssee = window.setTimeout('timeri2('+se+');','1000');

 }else{
 
  clearInterval(ssee);
  examtimeend();
  document.getElementById("timeri2").innerHTML = "";
  document.getElementById("timeri2").value = "00:00:00";
  document.getElementById('exam_schedule').style.display = 'none';
  document.getElementById('time_left_div').style.display = 'none';
  document.getElementById('finelysub').style.display = "none";
  document.getElementById('showdiv_datetime').style.display = "none";
  document.getElementById('exam_no_schedule_div').style.display = 'block';
  
 }
 
 
}
</script>
<script type="text/javascript">
  <?php 
if($half_an_hour<=$cur_time && $ed_timt>=$cur_time){
    
    ?>

    timeri(<?php echo $_SESSION['START_TIME_SESSION']; ?>);
<?php }
?>
      function timeri(se){
      //alert(se);
 var mm = Math.floor(se / 60);
 var ss = Math.floor(se % 60);
 
 if(mm < 10)
  mm = '0'+mm;
 if(ss < 10)
  ss = '0'+ss;
 se --;
 
 document.getElementById("timeri").innerHTML = mm + ":" + ss;
// document.getElementById("ans_fix_time").value = mm + ":" + ss;
 
 if(ss >= 0 && mm >= 0){
     
 sse = window.setTimeout('timeri('+se+');','1000');

 }else{
 
  clearInterval(sse);
   
  document.getElementById('start_timer_div').style.display = 'none';
  document.getElementById('start_exam').disabled = false;
  //document.getElementById('dynamic_image').style.marginLeft  = '645px';
  
  
  
 }
 
 
}
</script>
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
   // alert('ok');
    no_of_que = $("input[name='no_of_que']:checked").val();
      //alert(no_of_que);
    if(no_of_que!='' && no_of_que!=undefined){
     $("#cntque").val(no_of_que);
    } else {
   
    }
});

function showdiv(k){
     
    var element = document.getElementById('kkk');
    document.getElementById("kkk").style.fontWeight = "900";
    if(k % 2 == 0) {
    document.getElementById('kkk').innerHTML = '>>';

    element.style.left = null;
        $(".slide-toggle").animate({right: '0px'});
        document.getElementById('showmark').style.display='block';
        document.getElementById('flagdiv').style.border = '1px solid #65839d3d';
        document.getElementById('flagdiv').style.background = 'rgba(147, 208, 255, 0.07)';
        document.getElementById('flagdiv').style.padding = '5px';
        //document.getElementById('fflgdiv').style.display='block';

    } else{
      document.getElementById('kkk').innerHTML = '<<';
      
     element.style.right = null;
     document.getElementById('showmark').style.display='none';

     $(".slide-toggle").animate({left: '86%'});
     //document.getElementById('fflgdiv').style.display='none';
     document.getElementById('flagdiv').style.border = '';
     document.getElementById('flagdiv').style.background = '';
     document.getElementById('flagdiv').style.padding = '0px';
    }
      $(".box").animate({
                width: "toggle"
            });
    $("#kkk").removeAttr('onclick');
    $("#kkk").unbind('click')   
    $('#kkk').click(function() {showdiv(++k)});
}
</script>
<script type="text/javascript">
// window.onbeforeunload = function() {
//   //alert("okk");
//   examtimeend();
// return "You have some unsaved changesss"; 
     
// };
$(function() {
    $(window).bind('beforeunload', function() {
        setTimeout(function() {
            setTimeout(function() {
               // $(document.body).css('background-color', 'red');
            }, 1000);
        },1);
        examtimeendd();
        return 'are you sure';
    });
}); 
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

                        }
                      </script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->