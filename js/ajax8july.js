function start_set_session(val,queheadid){

  $.ajax({   

        type: "POST",

        url: "start_set_session.php?val="+val+'&queheadid='+queheadid,  

        data: "queheadid="+queheadid,

        success: function(data) {

             

        }});

}

  function send_feed(que_id,sub_id){

       feedback = document.getElementById("feedback"+que_id).value;

        $.ajax({ 

        type: "POST",

        url: "save_feedback.php",  

        data: "feedback="+feedback+"&que_id="+que_id+"&sub_id="+sub_id,

        success: function(data) {

           if(data=="success"){

        Swal.fire({

            title: 'Success',

            text: "Your Feedback Submitted Successfully!",

            icon: 'success',

            allowOutsideClick: false,

            confirmButtonColor: '#3085d6',

            confirmButtonText: 'OK!'

        })

           }else {

             Swal.fire(

          'Wrong',

          'Something went wrong',

          'error'

           )

           }

        }});

  }

$(document).on("submit","#examineeLoginFrm", function(){

   $.post("query/loginExe.php", $(this).serialize(), function(data){

    alert("data");

      if(data.res == "invalid")

      {

        Swal.fire(

          'Invalid',

          'Please input valid email / password',

          'error'

        )

      } 

      else if(data.res == "success")

      {

        $('body').fadeOut();

        window.location.href='home.php?page=dashboard';

      }

   },'json');



   return false;

});

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

$(document).on("submit","#examineeRegFrm", function(){

  //alert('ok');

   $.post("query/registrationExe.php", $(this).serialize(), function(data){

    //alert(data.res);

      if(data.res == "invalid")

      {

        Swal.fire(

          'Something went wrong',

          'Please Re-enter form',

          'error'

        )

      }

      else if(data.res == "already")

      { 

        Swal.fire(

          'That Email Is Taken!',

          'Try another',

          'error'

        )

      }

      else if(data.res == "success")

      {  



        Swal.fire({ 

            title: 'Success',

            text: "your form successfully submitted!",

            icon: 'success',

            allowOutsideClick: false,

            confirmButtonColor: '#3085d6',

            confirmButtonText: 'OK!'

        }).then((result) => {

        //alert('fds');

        // $('body').fadeOut();

         // window.location.href='index.php';

         $('body').fadeOut();

        window.location.href='home.php?page=dashboard';

       });



      }

   },'json');



   return false;

});

// Submit Answer

$(document).on('submit', '#submitAnswerFrm', function(){

  var examAction = $('#examAction').val();



  if(examAction !== "")

  {

    Swal.fire({

    title: 'Time Out',

    text: "your time is over, please click ok",

    icon: 'warning',

    showCancelButton: false,

    allowOutsideClick: false,

    confirmButtonColor: '#3085d6',

    cancelButtonColor: '#d33',

    confirmButtonText: 'OK!'

}).then((result) => {

if (result.value) {



   $.post("query/submitAnswerExe.php", $(this).serialize(), function(data){



    if(data.res == "alreadyTaken")

    {

       Swal.fire(

         'Already Taken',

         "you already take this exam",

         'error'

       ) 

    }

    else if(data.res == "success")

    {

        Swal.fire({

            title: 'Success',

            text: "your answer successfully submitted!",

            icon: 'success',

            allowOutsideClick: false,

            confirmButtonColor: '#3085d6',

            confirmButtonText: 'OK!'

        }).then((result) => {

        if (result.value) {

          $('#submitAnswerFrm')[0].reset();

           var exam_id = $('#exam_id').val();

           window.location.href='home.php?page=result&id=' + exam_id;

        }



        });





    }

    else if(data.res == "failed")

    {

     Swal.fire(

         'Error',

         "Something;s went wrong",

         'error'

       ) 

    }



   },'json');



}

});

  }

  else

  {

      Swal.fire({

    title: 'Are you sure?',

    text: "you want to submit your answer now?",

    icon: 'warning',

    showCancelButton: true,

    allowOutsideClick: false,

    confirmButtonColor: '#3085d6',

    cancelButtonColor: '#d33',

    confirmButtonText: 'Yes, submit now!'

}).then((result) => {

if (result.value) {



   $.post("query/submitAnswerExe.php", $(this).serialize(), function(data){



    if(data.res == "alreadyTaken")

    {

       Swal.fire(

         'Already Taken',

         "you already take this exam",

         'error'

       ) 

    }

    else if(data.res == "success")

    {

        Swal.fire({

            title: 'Success',

            text: "your answer successfully submitted!",

            icon: 'success',

            allowOutsideClick: false,

            confirmButtonColor: '#3085d6',

            confirmButtonText: 'OK!'

        }).then((result) => {

        if (result.value) {

          $('#submitAnswerFrm')[0].reset();

           var exam_id = $('#exam_id').val();

           window.location.href='home.php?page=result&id=' + exam_id;

        }



        });





    }

    else if(data.res == "failed")

    {

     Swal.fire(

         'Error',

         "Something;s went wrong",

         'error'

       ) 

    }



   },'json');



}

});

  }



return false;

});





// Submit Feedbacks

$(document).on("submit","#addFeebacks", function(){

   $.post("query/submitFeedbacksExe.php", $(this).serialize(), function(data){

      if(data.res == "limit")

      {

        Swal.fire(

          'Error',

          'You reached the 3 limit maximum for feedbacks',

          'error'

        )

      }

      else if(data.res == "success")

      {

        Swal.fire(

          'Success',

          'your feedbacks has been submitted successfully',

          'success'

        )

          $('#addFeebacks')[0].reset();

        

      }

   },'json');



   return false;

});

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
$('#duplicate').click(function(){

  Swal.fire('','Please verify your email address first, for that go to "My Account"')

});
$('#start_exam').click(function(){

 

      cntque = document.getElementById('cntque').value;   

      queheadid = document.getElementById('queheadid').value;

      start_set_session(cntque,queheadid);   

      cntque2 = document.getElementById('cntque2').value;

      cntquee = document.getElementById('cntquee').value;

      

    if(cntque=='' && cntquee=='ll'){

     cntque = 0;

    Swal.fire('','Please Select No. Of Question.')

    

    } else{

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

startTimer();

cntque = document.getElementById('cntque').value;

if(cntque==""){

  cntque = 0;

} 

numm = cntque*90;

timebond = $("input:radio[name=timebond]:checked").val();

 if(timebond==1){

  timer(numm);

} else {

}

//openFullscreen();

document.getElementById('ins_tag').style.display='none';

 document.getElementById('select_no_of_question').style.display='none';

 document.getElementById('start_exam').style.display='none';

//document.getElementById('examtime').style.display="none";

    },

  )

}

});



$('#mainsubmit').click(function(){

tot_att = '';

tot_not_att = '';

tot_skip = '';

queheadid = document.getElementById('queheadid').value;

$.ajax({ 

        type: "POST",

        url: "get_tot_ans.php",  

        data: "queheadid="+queheadid,

        success: function(data) {

        //alert(data);

        dataa = data.trim();

        dataArr = dataa.split("||");

        tot_skip = dataArr[0];

        tot_not_att = dataArr[1];

        tot_att = dataArr[2];

if(tot_skip==0 && tot_not_att==0 && tot_att==0){   

  Swal.fire({

  

  //title: "Congratulation! You Finished the Exam.",

  //text: "You won't to submit the Exam!",

  text: "You have not Attempted any Question!",

  //text: "Total Attampt - "+tot_att+,

  type: "success",

  allowEscapeKey: false,

    allowOutsideClick: false,

})



} else{

Swal.fire({

  

  title: "Are you sure?",

  //text: "You won't to submit the Exam!",

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

        url: "get_question_sub.php", 

        data: "examne_id="+examne_id+"&queheadid="+queheadid+"&examtime="+examtime+'&impque='+impque,

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

        })                   //$( window ).off( "unload", handler );

                            //window.location.href = "home.php?page=gotresult&id="+queheadid;

                            document.getElementById('flagdiv').style.display='none';

                            document.getElementById('flagdiv2').style.display='none';

                            document.getElementById('currentqueno').style.display='none';

                            document.getElementById('save_and_next').style.display='none';

                            document.getElementById('skip').style.display='none';

                            document.getElementById('previous_que').style.display='none';

                            document.getElementById('next_que').style.display='none';

                            document.getElementById('showquestion_att').style.display='none';

                            document.getElementById('finelysub').style.display='none';

                            document.getElementById('examtime').style.display='none';

                            document.getElementById('ins_tag').style.display='none';

                            //document.getElementById('showquestion_att').innerHTML = 'Question '+att_totque+' of '+totque;



                           //$('#showeditor').attr("style", "display: none !important");

                           tot_att = "";

                           tot_skip = "";

                           tot_not_att = "";



                            $.ajax({ 

                            type: "POST",

                            url: "get_tot_ans2.php",  

                            data: "queheadid="+queheadid,

                            success: function(data) {

                            

                            dataa = data.trim();

                            dataArr = dataa.split("||");

                            tot_skip = dataArr[0];

                            tot_not_att = dataArr[1];

                            tot_att = dataArr[2];



                            document.getElementById('showquestion').innerHTML = "<div style='text-align:center;'><h4 style='font-weight:900;'>Your Exam has been Submitted Successfully.</h4><br><div style='color:green;'>Total Attempt - "+tot_att+"</div><div style='color:#d29706;'>Mark For Review - "+tot_skip+"</div><div style='color:red;'>Total Not Attempt - "+tot_not_att+"</div><br><div class='row'><div class='col-sm-6'><a href='home.php?page=result_date&id="+queheadid+"' id='gotres' style='margin-left: 100px;' class='btn btn-info' >Go To Result</a> </div><div class='col-sm-6'><a href='home.php?page=dashboard' id='canclebtn' style='margin-left: -100px;width: 108px;' class='btn btn-danger' >Cancel</a> </div><div></div>";

                            } });

                            //Swal.fire('','Your Exam Completed!.');



                           // window.location.href = 'home.php?page=result&id='+queid;

                            document.getElementById('start_exam').style.display = 'none';

                            document.getElementById('timerdiv').style.display = 'none';

                            document.getElementById('select_no_of_question').style.display='none';

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

function examtimeend(){

  //alert("ok");

  $("#timer").html("00:00:00");

//   Swal.fire({

  

//   title: "Exam Time End!",

//   //text: "You won't to submit the Exam!",

//   html: "<div>Exam Time End, you want to submit the Exam?</div>",

//   //text: "Total Attampt - "+tot_att+,

//   type: "info",

//   showCancelButton: true,

//   closeOnConfirm: false,

//   allowEscapeKey: false,

//   allowOutsideClick: false,

//   showLoaderOnConfirm: true

// }).then((result) => {

//   if (result.value) {

  // jQuery('#mainsubmit').click();

  //////////////////////////////////////////time end /////////////////////////

  tot_att = '';

tot_not_att = '';

tot_skip = '';

queheadid = document.getElementById('queheadid').value;

    $.ajax({ 

        type: "POST",

        url: "get_tot_ans.php",  

        data: "examne_id="+examne_id+"&queheadid="+queheadid+"&examend=1",

        success: function(data) {

        //alert(data);

        get_question('','','','');

        dataa = data.trim();

        dataArr = dataa.split("||");

        tot_skip = dataArr[0];

        tot_not_att = dataArr[1];

        tot_att = dataArr[2];

// if(tot_skip==0 && tot_not_att==0 && tot_att==0){   



//   Swal.fire({

  

//   //title: "Congratulation! You Finished the Exam.",

//   //text: "You won't to submit the Exam!",

//   text: "You have not Attempted any Question!",

//   //text: "Total Attampt - "+tot_att+,

//   type: "success",

//   allowEscapeKey: false,

//     allowOutsideClick: false,

// }).then((result) => {

//  //$(window).off('beforeunload.windowReload');

//  window.onbeforeunload = null;

//  window.location.href="home.php";

//   //ssee = window.setTimeout('timer();','000');

//   window.clearTimeout(time);

// //clearInterval(time);

// myStopFunction();

// document.getElementById("examtime").innerHTML="";

//   document.getElementById("showquestion_att").style.display="none";

//   document.getElementById("timerdiv").style.display="none";

//   document.getElementById("showquestion").style.display="none";

//   document.getElementById("flagdiv").style.display="none";

//    document.getElementById("allbtndiv").style.display="none";

//     document.getElementById("finelysub").style.display="none";

//     document.getElementById("select_no_of_question").style.display="block";

//     document.getElementById("start_button").style.display="block";

//     document.getElementById("start_exam").style.display="block";

//     document.getElementById("cntque").value = "";

//     document.getElementByName('no_of_que').checked = false;

// });

// //

// } else{

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

        url: "get_question_sub.php", 

        data: "examne_id="+examne_id+"&queheadid="+queheadid+"&examtime="+examtime+'&impque='+impque,

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

        })                   //$( window ).off( "unload", handler );

                            //window.location.href = "home.php?page=gotresult&id="+queheadid;

                            document.getElementById('flagdiv').style.display='none';

                            document.getElementById('flagdiv2').style.display='none';

                            document.getElementById('currentqueno').style.display='none';

                            document.getElementById('save_and_next').style.display='none';

                            document.getElementById('skip').style.display='none';

                            document.getElementById('previous_que').style.display='none';

                            document.getElementById('next_que').style.display='none';

                            document.getElementById('showquestion_att').style.display='none';

                            document.getElementById('finelysub').style.display='none';

                            document.getElementById('examtime').style.display='none';

                            document.getElementById('ins_tag').style.display="none";

                            //document.getElementById('showquestion_att').innerHTML = 'Question '+att_totque+' of '+totque;

                             tot_att = "";

                           tot_skip = "";

                           tot_not_att = "";



                            $.ajax({ 

                            type: "POST",

                            url: "get_tot_ans2.php",  

                            data: "queheadid="+queheadid,

                            success: function(data) {

                            

                            dataa = data.trim();

                            dataArr = dataa.split("||");

                            tot_skip = dataArr[0];

                            tot_not_att = dataArr[1];

                            tot_att = dataArr[2];



                            document.getElementById('showquestion').innerHTML = "<div style='text-align:center;'><h4 style='font-weight:900;'>Your Exam has been Submitted Successfully.</h4><br><div style='color:green;'>Total Attempt - "+tot_att+"</div><div style='color:#d29706;'>Mark For Review - "+tot_skip+"</div><div style='color:red;'>Total Not Attempt - "+tot_not_att+"</div><br><div class='row'><div class='col-sm-6'><a href='home.php?page=result_date&id="+queheadid+"' id='gotres' style='margin-left: 100px;' class='btn btn-info' >Go To Result</a> </div><div class='col-sm-6'><a href='home.php?page=dashboard' id='canclebtn' style='margin-left: -100px;width: 108px;' class='btn btn-danger' >Cancel</a> </div><div></div>";

                            } });

                           //$('#showeditor').attr("style", "display: none !important");

                            //document.getElementById('showquestion').innerHTML = '<a href="home.php?page=result_date&id='+queheadid+'" style="margin-left: 100px;" class="btn btn-info" >Go To Result</a> ';

                            //Swal.fire('','Your Exam Completed!.');



                           // window.location.href = 'home.php?page=result&id='+queid;

                            document.getElementById('start_exam').style.display = 'none';

                            document.getElementById('timerdiv').style.display = 'none';

                            document.getElementById('examtime').style.display = "none";

                            document.getElementById('select_no_of_question').style.display='none';

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

  ////////////////////////////////////////////////////////////////////////////

//   } else {

//     document.getElementById('timerdiv').style.display="none";

//     document.getElementById('examtime').style.display="block";

//   }

// }); 

}

function get_question(que_numm,iid,selected,type){  

    

      

     cntque = document.getElementById('cntque').value;

     cntque2 = document.getElementById('cntque2').value;

     cntquee = document.getElementById('cntquee').value;

      

    if(cntque=='' && cntquee=='ll'){

     cntque = 0;

    Swal.fire('','Please Select No. Of Question.')

     //alert('Please Select No. Of Question.');

   

    } else {

//alert(cntque);

     examne_id = document.getElementById('examne_id').value;

    if(examne_id==''){

      examne_id = 0;

    } 

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

url: "get_question.php", 

data: "examne_id="+examne_id+"&queheadid="+queheadid+"&eqt_id="+eqt_id+"&answer="+answer+"&answers="+''+'&selected='+selected+'&cntque='+cntque+'&cntquee='+cntquee+'&type='+type+'&for_previous_id='+for_previous_id+'&cntque2='+cntque2+'&que_numm='+que_numm+'&exam_comp='+exam_comp+'&exam_id='+exam_id,

success: function(data) {

  //alert("okk");

  

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

//alert(data);

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

document.getElementById('flagdiv').innerHTML = att_totque;

} else{

//alert(que);

document.getElementById('ins_tag').style.display='none';

document.getElementById('currentqueno').innerHTML = que_no;

document.getElementById('showquestion').innerHTML = que;

document.getElementById('flagdiv').innerHTML = flg;

document.getElementById('flagdiv2').innerHTML = flg;

document.getElementById('cntquee').value = 'lll';

document.getElementById('eqt_id').value = queid;

$('#showeditor').attr("style", "display: none");



document.getElementById('select_no_of_question').style.display='none';

document.getElementById('showquestion_att').innerHTML = 'Question '+att_totque+' of '+totque;

document.getElementById('showquestion_att').style.display='block';

if(timebond==1){

  document.getElementById('ins_tag').style.display='none';

document.getElementById('showquestion_att').style.display='block';  

document.getElementById('timerdiv').style.display='block';

document.getElementById('examtime').style.display = 'none';

} else {

  document.getElementById('ins_tag').style.display='none';

document.getElementById('timerdiv').style.display='none';

document.getElementById('examtime').style.display = 'block';

}document.getElementById('allbutton').style.display='block';

document.getElementById("flagdiv").style.display="block";

document.getElementById('finelysub').style.display='block';

document.getElementById('showquestion').style.display="block";

document.getElementById('start_button').style.display='none';

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

} }





