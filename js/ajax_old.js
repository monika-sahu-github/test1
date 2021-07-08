// Admin Log in
$(document).on("submit","#examineeLoginFrm", function(){
   $.post("query/loginExe.php", $(this).serialize(), function(data){
    //alert(data);
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
        window.location.href='home.php';
      }
   },'json');

   return false;
});
//Registration

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
         window.location.href='index.php';
       });
      }
   },'json');

   return false;
});



// Submit Answer
$(document).on('submit', '#submitAnswerFrm', function(){
  var examAction = $('#examAction').val();

  if(examAction != "")
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
    // var speed = 300;
    // function mm(){
    //  alert('ok'); 
    // }
//$('#close-bar').on('click', function() {

  // var $$ = $(this),
  //   panelWidth = $('#hiddenPanel').outerWidth();

  // if ($$.is('.myButton')) {
  //   alert('ok');
  //   $('#hiddenPanel').animate({
  //     right: 0
  //   }, speed);
  //   $$.removeClass('myButton')
  // } else {
  //   $('#hiddenPanel').animate({
  //     right: -panelWidth
  //   }, speed);
  //   $$.addClass('myButton')
  // }

//});
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
startTimer();
      get_question();
    
});

$('#mainsubmit').click(function(){

//       Swal.fire({
//   title: 'Are you sure?',
//   text: "You won't to submit the Exam!",
//   icon: 'warning',
//   showCancelButton: true,
//   confirmButtonColor: '#3085d6',
//   cancelButtonColor: '#d33',
//   confirmButtonText: 'Yes'
// }).then((result) => {
//   //alert('ok');
  
//   if (result.isConfirmed) {
//      examne_id = document.getElementById('examne_id').value;
//     if(examne_id==''){
//       examne_id = 0;
//     } 
//     queheadid = document.getElementById('queheadid').value;
//     if(queheadid==''){
//       queheadid = 0;
//     }
//     $.ajax({ 
//         type: "POST",
//         url: "get_question_sub.php", 
//         data: "examne_id="+examne_id+"&queheadid="+queheadid,
//         success: function(data) {

//        }
//      });
//     Swal.fire(
//       'Deleted!',
//       'Your file has been deleted.',
//       'success'
//     )
//   }
// }) 
//    Swal.fire({
//   title: "Ajax request example",
//   text: "Submit to run ajax request",
//   type: "info",
//   showCancelButton: true,
//   closeOnConfirm: false,
//   showLoaderOnConfirm: true
// }).then((result) => {
//   if (result.value) {
//   setTimeout(function () {
//     Swal.fire("Ajax request finished!");
//   }, 2000);
// }
// });

Swal.fire({
  title: "Are you sure?",
  text: "You won't to submit the Exam!",
  type: "info",
  showCancelButton: true,
  closeOnConfirm: false,
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
        $.ajax({ 
        type: "POST",
        url: "get_question_sub.php", 
        data: "examne_id="+examne_id+"&queheadid="+queheadid+"&examtime="+examtime,
        success: function(data) {

       
  Swal.fire({
    title: 'Your Exam Submitted...',
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

                            document.getElementById('save_and_next').style.display='none';
                            document.getElementById('skip').style.display='none';
                            document.getElementById('previous_que').style.display='none';
                            document.getElementById('next_que').style.display='none';
                            document.getElementById('showquestion_att').style.display='none';
                            document.getElementById('finelysub').style.display='none';
                            document.getElementById('examtime').style.display='none';
                            //document.getElementById('showquestion_att').innerHTML = 'Question '+att_totque+' of '+totque;

                           //$('#showeditor').attr("style", "display: none !important");
                            document.getElementById('showquestion').innerHTML = '<a href="home.php?page=result&id='+queheadid+'" style="margin-left: 100px;" class="btn btn-info" >Go To Result</a> ';
                            //Swal.fire('','Your Exam Completed!.');

                           // window.location.href = 'home.php?page=result&id='+queid;
                            document.getElementById('start_exam').style.display = 'none';
                            document.getElementById('select_no_of_question').style.display='none';
                            document.getElementById('allbutton').style.display='none';


  }, 2000);
  }
     });
  }
});

}); 

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
exam_comp = document.getElementById('exam_comp').value;
// answers=CKEDITOR.instances.editor.getData();
//  if(answers==''){
//       answers = '';
//     }
//alert(cntque+"=="+cntque2);
//alert('okk');
   $.ajax({ 
                   type: "POST",
                   url: "get_question.php", 
        data: "examne_id="+examne_id+"&queheadid="+queheadid+"&eqt_id="+eqt_id+"&answer="+answer+"&answers="+''+'&selected='+selected+'&cntque='+cntque+'&cntquee='+cntquee+'&type='+type+'&for_previous_id='+for_previous_id+'&cntque2='+cntque2+'&que_numm='+que_numm+'&exam_comp='+exam_comp,
                   success: function(data) {
                   //alert(data);

                           dataa = data.trim();
                           dataArr = dataa.split("|||");
                           que = dataArr[0].trim(); 
                           queid = dataArr[1].trim();
                           totque = dataArr[2].trim();
                           att_totque = dataArr[3].trim();;
                           for_previous_id = dataArr[4];
                           cntque2 = dataArr[5];
                           //alert(cntque2);
                           //alert(att_totque+"--"+totque);
                           if(att_totque==totque){
                            document.getElementById('exam_comp').value = 'done';
                           } else if(att_totque>totque){
                            //alert('ok');
                            document.getElementById("next_que").disabled = true;
                            document.getElementById("skip").disabled = true;
                            document.getElementById("save_and_next").disabled = true;  
                           } else {
                            document.getElementById('exam_comp').value = '';
                           }
                           if(parseInt(att_totque)<parseInt(totque)){
                            document.getElementById("next_que").disabled = false;
                            document.getElementById("skip").disabled = false;
                            document.getElementById("save_and_next").disabled = false;
                           } 
                           //document.getElementById('cntque').value='';
                           if(cntque2==cntque){
                            //alert('ok');
                            document.getElementById("next_que").disabled = true;
                            document.getElementById("skip").disabled = true;
                           } else {
                            //document.getElementById("next_que").disabled = false;
                            //document.getElementById("skip").disabled = false;
                            //document.getElementById("save_and_next").disabled = false; 
                           }
                           if(cntque2==1){
                            document.getElementById("previous_que").disabled = true;
                           } else {
                            document.getElementById("previous_que").disabled = false;
                           }
                           if(que=='not found'){
                           //  document.getElementById('save_and_next').style.display='none';
                           //  document.getElementById('skip').style.display='none';
                           //  document.getElementById('previous_que').style.display='none';
                           //  document.getElementById('next_que').style.display='none';
                           //  document.getElementById('showquestion_att').style.display='none';
                           //  //document.getElementById('showquestion_att').innerHTML = 'Question '+att_totque+' of '+totque;

                           // //$('#showeditor').attr("style", "display: none !important");
                           //  document.getElementById('showquestion').innerHTML = '<a href="home.php?page=result&id='+queid+'" style="margin-left: 100px;" class="btn btn-info" >Go To Result</a> ';
                           //  Swal.fire('','Your Exam Completed!.');

                           // // window.location.href = 'home.php?page=result&id='+queid;
                           //  document.getElementById('start_exam').style.display = 'none';
                           //  document.getElementById('select_no_of_question').style.display='none';
                           //  document.getElementById('allbutton').style.display='none';

                           } else{

                           document.getElementById('showquestion').innerHTML = que;
                           document.getElementById('cntquee').value = 'lll';
                           document.getElementById('eqt_id').value = queid;
                           $('#showeditor').attr("style", "display: none");
                           //document.getElementById('save_and_next').value = 'SaNext >>';
                           document.getElementById('showquestion_att').innerHTML = 'Question '+att_totque+' of '+totque;
                           document.getElementById('showquestion_att').style.display='block';
                           document.getElementById('select_no_of_question').style.display='none';
                           document.getElementById('allbutton').style.display='block';

                           document.getElementById('finelysub').style.display='block';

                           document.getElementById('start_button').style.display='none';
                           document.getElementById('for_previous_id').value=for_previous_id;
                           //alert('fdsf'+att_totque);
                           document.getElementById('cntque2').value=att_totque;
                           document.getElementById('examtime').style.display='block';
                           //answers=CKEDITOR.instances.editor.setData('');


                           }
                   }

                });    
} }


