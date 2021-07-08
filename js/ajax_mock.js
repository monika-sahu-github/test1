function start_set_mocksession(exam_id,exam_time){
$.ajax({ 
        type: "POST",
        url: "start_set_mocksession.php",  
        data: "exam_id="+exam_id,
        success: function(data) {
          //alert(data);
        }});
}

  var time;
  var t2;
time = 0;
    startTimer = function() {
        //alert('ok');
 clearTimeout(t2);
  clearInterval(t2);

t2 = setInterval((function() {
    var hour, min, sec, str;
    time++;
    sec = time % 60;
    min = (time - sec) / 60 % 60;
    hour = (time - sec - (min * 60)) / 3600;
    count = hour + ':' + ('0' + min).slice(-2) + ':' + ('0' + sec).slice(-2);
    $('.responseTime').text(count);
    document.getElementById('examtime').value = count
    }), 1000);
   };

function myStopFunction() {
 
  clearTimeout(t2);
  clearInterval(t2);
  //document.getElementById('examtime').value = "00:00";
    
}

$('#save_and_next').click(function(){
 
    answer = $('input[name="answers"]:checked').val();
     //alert(answer);
    if(answer=='' || answer == undefined){
        Swal.fire('','Please choose at least one option.')
      //alert('Please choose at least one option.');
    } else { 
 get_question('','','','save_and_next');
}
}); 
$('#skip').click(function(){
 get_question('','','','skip');
}); 
$('#previous_que').click(function(){

      get_question('','','','previous');
    
}); 

$('#next_que').click(function(){

      get_question('','','','next');
    
}); 
$('#start_exam').click(function(){
 if (document.documentElement.webkitRequestFullscreen) {
    document.documentElement.webkitRequestFullscreen();
}     
document.getElementById('showdiv_datetime').style.display="none";
document.getElementById('instruct_div').style.display="none"; 
document.getElementById('start_button').style.display="none";
      exam_time = document.getElementById('exam_time').value;   
      exam_id = document.getElementById('exam_id').value;
      start_set_mocksession(exam_id,exam_time);   
      cntque2 = document.getElementById('cntque2').value;
      cntquee = document.getElementById('cntquee').value;
      //alert("okk");
    // if(cntque=='' && cntquee=='ll'){
    //  cntque = 0;
    // Swal.fire('','Please Select No. Of Question.')
    
   // } else{
 Swal.fire({
    title: 'Loading...',
    allowEscapeKey: false,
    allowOutsideClick: false,
    timer: 3000,
    onOpen: () => {
      swal.showLoading();
    }
  }).then(
    () => {
get_question();
 document.getElementById('start_exam').style.display='none';
//document.getElementById('examtime').style.display="none";
    },
  )
//}
});

$('#mainsubmit').click(function(){
tot_att = '';
tot_not_att = '';
tot_skip = '';
exam_id = document.getElementById('exam_id').value;
$.ajax({ 
        type: "POST", 
        url: "get_tot_mock_ans.php",  
        data: "exam_id="+exam_id,
        success: function(data) {
        //alert(data);
        dataa = data.trim();
        dataArr = dataa.split("||");
        tot_skip = dataArr[0];
        tot_not_att = dataArr[1];
        tot_att = dataArr[2];
if(tot_skip==0 && tot_not_att==0 && tot_att==0){   
  Swal.fire({
  text: "You have not Attempted any Question!",
  type: "success",
  allowEscapeKey: false,
    allowOutsideClick: false,
})

} else{
Swal.fire({
  
  title: "Are you sure?",
  html: "<div>You want to submit the Exam!<br><br><div style='color:green;'>Total Attempt - "+tot_att+"</div><div style='color:#d29706;'>Mark For Review - "+tot_skip+"</div><div style='color:red;'>Total Not Attempt - "+tot_not_att+"</div></div>",
  //text: "Total Attampt - "+tot_att+,
  type: "info",
  showCancelButton: true,
  closeOnConfirm: false,
  allowEscapeKey: false,
  allowOutsideClick: false,
  showLoaderOnConfirm: true
}).then((result) => {
  if (result.value) {
    //const showLoading = function() {
    examne_id = document.getElementById('examne_id').value;
    examtime = document.getElementById('examtime').value;
    exam_id = document.getElementById('exam_id').value;
    exam_id2 = document.getElementById('exam_id2').value;
    if(examne_id==''){
      examne_id = 0;
    } 
    queheadid = document.getElementById('queheadid').value;
    if(queheadid==''){
      queheadid = 0;
    }
    impque = document.getElementById('impque').value;
        $.ajax({ 
        type: "POST",
        url: "get_question_mocsub.php", 
        data: "examne_id="+examne_id+"&exam_id="+exam_id+"&examtime="+examtime+'&impque='+impque,
        success: function(data) {
//alert(data); 
       
  Swal.fire({
    title: 'Your Exam Submitting...',
    allowEscapeKey: false,
    allowOutsideClick: false,
    timer: 2000,
    onOpen: () => {
      swal.showLoading();
    }
  }).then(
    () => {},
    (dismiss) => {
      if (dismiss === 'timer') {
        console.log('closed by timer!!!!');
        Swal.fire({ 
          title: 'Finished!',
          type: 'success',
          timer: 2000,
          showConfirmButton: false
        })
      }
    }
  )
//};
//showLoading();
setTimeout(function () {
//Swal.fire("Submitted!");
Swal.fire({ 
title: 'Submitted Successfully!',
type: 'success',
timer: 2000,
showConfirmButton: false
}) 
document.getElementById('flagdiv').style.display='none';
document.getElementById('currentqueno').style.display='none';
document.getElementById('save_and_next').style.display='none';
document.getElementById('skip').style.display='none';
document.getElementById('previous_que').style.display='none';
document.getElementById('next_que').style.display='none';
document.getElementById('showquestion_att').style.display='none';
document.getElementById('finelysub').style.display='none';
document.getElementById('examtime').style.display='none';
document.getElementById('showdiv_datetime').style.display='none';
document.getElementById('time_left_div').style.display='none';
document.getElementById('showquestion').innerHTML ="<h1 style='font-weight: 600;'>Your exam has been submitted</h1><span>Wish you a best for the results that are soon going to come.</span>";
document.getElementById('achievers-exam-div').style.background = "#325376";
document.getElementById('achievers-exam-div').style.color = "white";
document.getElementById('achievers-exam-div').style.border = "3px solid #375176";
document.getElementById('achievers-exam-div').style.fontWeight = '900';
document.getElementById('start_exam').style.display = 'none';
document.getElementById('timerdiv').style.display = 'none';
document.getElementById('allbutton').style.display='none';
}, 2000);
} 
});
} else {
}
}); 
} 
}
});

}); 
function examtimeendd(){
      impque = document.getElementById('impque').value;
      examne_id = document.getElementById('examne_id').value;
    examtime = document.getElementById('examtime').value;
    exam_id = document.getElementById('exam_id').value;
        $.ajax({ 
        type: "POST",
        url: "get_question_mocsub.php", 
        data: "examne_id="+examne_id+"&exam_id="+exam_id+"&examtime="+examtime+'&impque='+impque,
        success: function(data) {
document.getElementById('flagdiv').style.display='none';
document.getElementById('currentqueno').style.display='none';
document.getElementById('save_and_next').style.display='none';
document.getElementById('skip').style.display='none';
document.getElementById('previous_que').style.display='none';
document.getElementById('next_que').style.display='none';
document.getElementById('showquestion_att').style.display='none';
document.getElementById('finelysub').style.display='none';
document.getElementById('examtime').style.display='none';
document.getElementById('start_exam').style.display = 'none';
document.getElementById('timerdiv').style.display = 'none';
document.getElementById('examtime').style.display = "none";
document.getElementById('allbutton').style.display='none';
  }
     });
}
function examtimeend(){
  window.onbeforeunload = null;
  alert("ok");
  $("#timer").html("00:00:00");
  tot_att = '';
tot_not_att = '';
tot_skip = '';
queheadid = document.getElementById('queheadid').value;
exam_id = document.getElementById('exam_id').value;
    $.ajax({ 
        type: "POST",
        url: "get_tot_mock_ans.php",  
        //data: "examne_id="+examne_id+"&queheadid="+queheadid,
        data: "exam_id="+exam_id,
        success: function(data) {
        //alert(data);
        dataa = data.trim();
        dataArr = dataa.split("||");
        tot_skip = dataArr[0];
        tot_not_att = dataArr[1];
        tot_att = dataArr[2];
Swal.fire({ 
  
  title: "Your Exam Time Ended!",
  //text: "You won't to submit the Exam!",
  html: "<div>You have - <br><div style='color:green;'>Total Attempt - "+tot_att+"</div><div style='color:#d29706;'>Mark For Review - "+tot_skip+"</div><div style='color:red;'>Total Not Attempt - "+tot_not_att+"</div></div>",
  //text: "Total Attampt - "+tot_att+,
  type: "success",
  allowEscapeKey: false,
    allowOutsideClick: false,
    timer: 10000,
})
.then(() => {
  if (1==1) {
    //const showLoading = function() {
    examne_id = document.getElementById('examne_id').value;
    examtime = document.getElementById('examtime').value;
    if(examne_id==''){
      examne_id = 0;
    } 
    queheadid = document.getElementById('queheadid').value;
    if(queheadid==''){
      queheadid = 0;
    }
    impque = document.getElementById('impque').value;
        $.ajax({ 
        type: "POST",
        url: "get_question_mocsub.php", 
        data: "examne_id="+examne_id+"&exam_id="+exam_id+"&examtime="+examtime+'&impque='+impque,
        success: function(data) {
  Swal.fire({ 
    title: 'Your Exam Submitting...',
    allowEscapeKey: false,
    allowOutsideClick: false,
    timer: 2000,
    onOpen: () => {
      swal.showLoading();
    }
  }).then(
    () => {},
    (dismiss) => {
      if (dismiss === 'timer') {
        console.log('closed by timer!!!!');
        Swal.fire({ 
          title: 'Finished!',
          type: 'success',
          timer: 2000,
          showConfirmButton: false
        })
      }
    }
  )
//};
//showLoading();
  setTimeout(function () {
     
    Swal.fire({ 
          title: 'Submitted Successfully!',
          type: 'success',
          timer: 2000,
          showConfirmButton: false
        })                  
document.getElementById('flagdiv').style.display='none';
document.getElementById('currentqueno').style.display='none';
document.getElementById('save_and_next').style.display='none';
document.getElementById('skip').style.display='none';
document.getElementById('previous_que').style.display='none';
document.getElementById('next_que').style.display='none';
document.getElementById('showquestion_att').style.display='none';
document.getElementById('finelysub').style.display='none';
document.getElementById('examtime').style.display='none';
document.getElementById('showquestion').innerHTML ="<h1 style='font-weight: 600;'>Your exam has been submitted</h1><span>Wish you a best for the results that are soon going to come.</span>";
document.getElementById('achievers-exam-div').style.background = "#325376";
document.getElementById('achievers-exam-div').style.color = "white";
document.getElementById('achievers-exam-div').style.border = "3px solid #375176";
document.getElementById('achievers-exam-div').style.fontWeight = '900';
document.getElementById('start_exam').style.display = 'none';
document.getElementById('timerdiv').style.display = 'none';
document.getElementById('examtime').style.display = "none";
document.getElementById('allbutton').style.display='none';
}, 2000);
  }
     });
  } else {
  }
})
//} 
 }
     });

}
function get_question(que_numm,iid,selected,type){ 
     cntque = document.getElementById('cntque').value;
     cntque2 = document.getElementById('cntque2').value;
     cntquee = document.getElementById('cntquee').value; 
    queheadid = document.getElementById('queheadid').value;
    if(queheadid==''){
      queheadid = 0;
    } 

    for_previous_id = document.getElementById('for_previous_id').value;
    if(for_previous_id==''){
      for_previous_id = 0;
    } 
   if(iid!='' && iid!=undefined){
      eqt_id = iid;
      selected = selected;
    }else{
      selected = '';
    eqt_id = document.getElementById('eqt_id').value;
    }
    answer = $('input[name="answers"]:checked').val();
    if(answer==''){
      answer = 0;
    }
timebond = $("input:radio[name=timebond]:checked").val();     
exam_comp = document.getElementById('exam_comp').value;
exam_id = document.getElementById('exam_id').value;
   $.ajax({ 
type: "POST",
url: "get_mock_question.php", 
data: "queheadid="+queheadid+"&eqt_id="+eqt_id+"&answer="+answer+"&answers="+''+'&selected='+selected+'&cntque='+cntque+'&cntquee='+cntquee+'&type='+type+'&for_previous_id='+for_previous_id+'&cntque2='+cntque2+'&que_numm='+que_numm+'&exam_comp='+exam_comp+'&exam_id='+exam_id,
success: function(data) { 
dataa = data.trim();
dataArr = dataa.split("|||");
que_no = dataArr[0].trim(); 
que = dataArr[1].trim();
queid = dataArr[2].trim();
totque = dataArr[3].trim();
att_totque = dataArr[4].trim();;
for_previous_id = dataArr[5];
cntque2 = dataArr[6];
flg = dataArr[7];
implodque = dataArr[8];
//alert(que); 
document.getElementById('cntque').value=totque;
if(att_totque==totque){
document.getElementById('exam_comp').value = 'done';
} else if(att_totque>totque){
document.getElementById("next_que").disabled = true;
document.getElementById("skip").disabled = false;
document.getElementById("save_and_next").disabled = false;
 document.getElementById('exam_comp').value = '';  
} else {
document.getElementById('exam_comp').value = '';
} 
if(parseInt(att_totque)<parseInt(totque)){
document.getElementById("next_que").disabled = false;
document.getElementById("skip").disabled = false;
document.getElementById("save_and_next").disabled = false;
} 
if(cntque2==cntque){
document.getElementById("next_que").disabled = true;
} else { 
}
if(cntque2==1){
document.getElementById("previous_que").disabled = true;
} else {
document.getElementById("previous_que").disabled = false;
}
//alert(que_no);
if(que_no=='not found'){
  //alert("?????");
document.getElementById('flagdiv').innerHTML = att_totque;
} else{
//alert(que);
document.getElementById('currentqueno').innerHTML = que_no;
document.getElementById('showquestion').innerHTML = que;
document.getElementById('time_left_div').style.display="block";
document.getElementById('flagdiv').innerHTML = flg;
document.getElementById('cntquee').value = 'lll';
document.getElementById('eqt_id').value = queid;
$('#showeditor').attr("style", "display: none");
document.getElementById('showquestion_att').innerHTML = 'Question '+att_totque+' of '+totque;
document.getElementById('showquestion_att').style.display='block';
document.getElementById('allbutton').style.display='block';
document.getElementById('finelysub').style.display='block';
document.getElementById('showquestion').style.display="block";
document.getElementById('showquestion').style.display="block";
document.getElementById('start_button').style.display='none';
document.getElementById('start_timer_div').style.display='none';
document.getElementById('for_previous_id').value=for_previous_id;
document.getElementById('cntque2').value=att_totque;
document.getElementById('allbtndiv').style.display='block';
document.getElementById('impque').value=implodque;
document.getElementById('flagdiv').style.border = '1px solid #65839d3d';
document.getElementById('flagdiv').style.background = 'rgba(147, 208, 255, 0.07)';
document.getElementById('flagdiv').style.padding = '5px';
}
}

});    
//} 
}


