<!--<script src="../ckeditor/ckeditor.js"></script>-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>  
<script type="text/javascript">
//get_question();
function get_question(iid,selected,type){  
    //alert('ok');

      cntque = document.getElementById('cntque').value;
      cntquee = document.getElementById('cntquee').value;
      
    if(cntque=='' && cntquee=='ll'){
     cntque = 0;
    
     alert('Please Select No. Of Question.');
   
    } else {
     examne_id = '<?php echo $examnee_id; ?>';
    if(examne_id==''){
      examne_id = 0;
    } 
    queheadid = '<?php echo $queheadid; ?>';
    if(queheadid==''){
      queheadid = 0;
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
answers=CKEDITOR.instances.editor.getData();
 if(answers==''){
      answers = '';
    }
//alert(cntque);
   $.ajax({ 
                   type: "POST",
                   url: "get_question.php", 
        data: "examne_id="+examne_id+"&queheadid="+queheadid+"&eqt_id="+eqt_id+"&answer="+answer+"&answers="+answers+'&selected='+selected+'&cntque='+cntque+'&cntquee='+cntquee,
                   success: function(data) {
                    //alert(data);
                           dataa = data.trim();
                           dataArr = dataa.split("|||");
                           que = dataArr[0].trim(); 
                           queid = dataArr[1].trim();
                           totque = dataArr[2];
                           att_totque = dataArr[3];
                           document.getElementById('cntque').value='';
                           if(que=='not found'){
                            document.getElementById('next').style.display='none';
                            document.getElementById('showquestion_att').innerHTML = 'Question '+att_totque+' of '+totque;

                           $('#showeditor').attr("style", "display: none !important");
                           	document.getElementById('showquestion').innerHTML = '<h5 style="color:red;margin-left: 60px;">Your Exam Completed!</h5> ';
                            document.getElementById('next').style.display = 'none';
                            document.getElementById('select_no_of_question').style.display='none';
                            document.getElementById('allbutton').style.display='none';

                           } else{
                           document.getElementById('showquestion').innerHTML = que;
                           document.getElementById('cntquee').value = 'lll';
                           document.getElementById('eqt_id').value = queid;
                           $('#showeditor').attr("style", "display: none");
                           document.getElementById('next').value = 'Next';
                           document.getElementById('showquestion_att').innerHTML = 'Question '+att_totque+' of '+totque;
                           document.getElementById('showquestion_att').style.display='block';
                           document.getElementById('select_no_of_question').style.display='none';
                           document.getElementById('allbutton').style.display='block';
                           document.getElementById('start_button').style.display='none';
                           answers=CKEDITOR.instances.editor.setData('');

                           }
                   }

                });    
} }
</script>
<script>
  initSample();
</script>
   <script type="text/javascript">
        $(window).on('load', function() {
        // alert('ok');
     document.getElementById('next').value = 'Start Exam';
     //$(".cke_reset").hide();
     
document.getElementById('showquestion_att').style.display='none';
     
     //alert('okmm');
});
    </script>
    <script>
    window.onbeforeunload = function(e) {
       return 'Dialog text here.';
    };
</script>
<!-- <script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/samples/js/sample.js"></script> -->

