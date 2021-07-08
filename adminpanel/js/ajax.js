// Admin Log in
//alert('ok');
$(document).on("submit","#adminLoginFrm", function(){
 
   $.post("query/loginExe.php", $(this).serialize(), function(data){
    //alert(data.res); 
      if(data.res == "invalid")
      { 
        Swal.fire(
          'Invalid',
          'Please input valid username / passwordd',
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
// Add Course  
$(document).on("submit","#addCourseFrm" , function(){
 
  $.post("query/addCourseExe.php", $(this).serialize() , function(data){
    
  	if(data.res == "exist")
  	{ 
  		Swal.fire(
  			'Already Exist',
  			data.course_name.toUpperCase() + ' Already Exist',
  			'error'
  		)
  	}
  	else if(data.res == "success")
  	{
  		Swal.fire(
  			'Success',
  			data.course_name.toUpperCase() + ' Successfully Added',
  			'success'
  		)
          // $('#course_name').val("");
          refreshDiv();
            setTimeout(function(){ 
                $('#body').load(document.URL);
             }, 2000);
  	}
  },'json');
  return false;
});
// Add Mock test
$(document).on("submit","#AddMockTestFrm" , function(){
  $.post("query/add_mock_test.php", $(this).serialize() , function(data){
    if(data.res == "exist")
    { 

      Swal.fire(
        'Already Exist',
        data.course_name.toUpperCase() + ' Already Exist',
        'error'
      )
    }
    else if(data.res == "success")
    {
      Swal.fire(
        'Success',
        data.course_name.toUpperCase() + ' Successfully Added',
        'success'
      )
          // $('#course_name').val("");
          refreshDiv();
            setTimeout(function(){ 
                $('#body').load(document.URL);
             }, 2000);
    }
  },'json');
  return false;
});
/////////////////

// Update Course
$(document).on("submit","#updateCourseFrm" , function(){
  $.post("query/updateCourseExe.php", $(this).serialize() , function(data){
     if(data.res == "success")
     { 
        Swal.fire(
            'Success',
            'Selected course has been successfully updated!',
            'success'
          )
          refreshDiv();
     }
  },'json')
  return false;
});

$(document).on("click","#option_A_chk" , function(){ 
      option_A_chk = document.getElementById('option_A_chk').checked;
      if(option_A_chk==true){
        document.getElementById('up1').style.display = 'block';
      } else {
        document.getElementById('option_A_chk').value = '';
        document.getElementById('up1').style.display = 'none';
      }
});
$(document).on("click","#option_B_chk" , function(){ 
      option_A_chk = document.getElementById('option_B_chk').checked;
      if(option_A_chk==true){
        document.getElementById('up2').style.display = 'block';
      } else {
        document.getElementById('option_B_chk').value = '';
        document.getElementById('up2').style.display = 'none';
      }
});
$(document).on("click","#option_C_chk" , function(){ 
      option_A_chk = document.getElementById('option_C_chk').checked;
      if(option_A_chk==true){
        document.getElementById('up3').style.display = 'block';
      } else {
        document.getElementById('option_C_chk').value = '';
        document.getElementById('up3').style.display = 'none';
      }
});
$(document).on("click","#option_D_chk" , function(){ 
      option_A_chk = document.getElementById('option_D_chk').checked;
      if(option_A_chk==true){
        document.getElementById('up4').style.display = 'block';
      } else {
        document.getElementById('option_D_chk').value = '';
        document.getElementById('up4').style.display = 'none';
      }
}); 
// Delete Course
$(document).on("click", "#deleteCourse", function(e){

Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.value) {
        e.preventDefault();
    var id = $(this).data("id");
     $.ajax({
      type : "post",
      url : "query/deleteCourseExe.php",
      dataType : "json",  
      data : {id:id},
      cache : false,
      success : function(data){
        if(data.res == "success")
        {
          Swal.fire(
            'Success',
            'Selected Course successfully deleted',
            'success'
          )
          refreshDiv();
        }
      },
      error : function(xhr, ErrorStatus, error){
        console.log(status.error);
      }

    });
    return false;
    // Swal.fire(
    //   'Deleted!',
    //   'Your file has been deleted.',
    //   'success'
    // )
  }
})


  });


// Delete Exam
$(document).on("click", "#deleteExam", function(e){
  Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.value) {

    e.preventDefault();
    var id = $(this).data("id");
     $.ajax({
      type : "post",
      url : "query/deleteExamExe.php",
      dataType : "json",  
      data : {id:id},
      cache : false,
      success : function(data){
        if(data.res == "success")
        {
          Swal.fire(
            'Success',
            'Selected Course successfully deleted',
            'success'
          )
          refreshDiv();
        }
      },
      error : function(xhr, ErrorStatus, error){
        console.log(status.error);
      }

    });
    
   

    return false;
    }
})
  });



// Add Exam 
$(document).on("submit","#addExamFrm" , function(){
  //alert('ok');
  // $.post("query/addExamExe.php", $(this).serialize() , function(data){
     $.post("query/addExamExe.php", $(this).serialize() , function(data){
    //alert(data.res); 
 if(data.res == "exist")
    {
      Swal.fire(
        'Already Exist',
        '<br>Already Exist',
        'error'
      )
    }
    else if(data.res == "success")
    {
      Swal.fire(
        'Success',
        '<br>Successfully Added',
        'success'
      )
          $('#addExamFrm')[0].reset();
          //$('#course_name').val("");
          refreshDiv();
    }

  },'json')
  return false;
});



// Update Exam 
$(document).on("submit","#updateExamFrm" , function(){
  $.post("query/updateExamExe.php", $(this).serialize() , function(data){
    if(data.res == "success")
    { 
      Swal.fire(
          'Update Successfully',
          data.msg + ' <br>are now successfully updated',
          'success'
       )
          refreshDiv();
    }
    else if(data.res == "failed")
    {
      Swal.fire(
        "Something's went wrong!",
         'Somethings went wrong',
        'error'
      )
    }
   
  },'json')
  return false;
});

// Update Question
$(document).on("submit","#updateQuestionFrm" , function(){
  $.post("query/updateQuestionExe.php", $(this).serialize() , function(data){
     if(data.res == "success")
     {
        Swal.fire(
            'Success',
            'Selected question has been successfully updated!',
            'success'
          )
          refreshDiv();
     }
  },'json')
  return false;
});


// Delete Question
$(document).on("click", "#deleteQuestion", function(e){
    e.preventDefault();
    var id = $(this).data("id");
     $.ajax({
      type : "post",
      url : "query/deleteQuestionExe.php",
      dataType : "json",  
      data : {id:id},
      cache : false,
      success : function(data){
        if(data.res == "success")
        {
          Swal.fire(
            'Deleted Success',
            'Selected question successfully deleted',
            'success'
          )
          refreshDiv();
        }
      },
      error : function(xhr, ErrorStatus, error){
        console.log(status.error);
      }

    });
    
   

    return false;
  });

$(document).on("change", "#exam_typee", function(e){

//id = document.getElementById('exam_type').value;
id = $("#exam_typee").val();
  $.ajax({
      type : "post",
      url : "query/get_subject.php?id="+id,
     
      data : {id:id},
      
      success : function(data){
        
        document.getElementById('courseSelected').innerHTML=data;
      }

    });
  });


// Add Question 
$(document).on("submit","#addQuestionFrm" , function(){
  $.post("query/addQuestionExe.php", $(this).serialize() , function(data){
    if(data.res == "exist")
    {
      Swal.fire(
          'Already Exist',
          data.msg + ' question <br>already exist in this exam',
          'error'
       )
    }
    else if(data.res == "success")
    {
      Swal.fire(
        'Success',
         data.msg + ' question <br>Successfully added',
        'success'
      )
        $('#addQuestionFrm')[0].reset();
        refreshDiv();
    }
   
  },'json')
  return false;
});
//  $(function() { 
//     $('#addQuestionFrm2').ajaxForm(function(result) {
//         alert('the form was successfully processed');
//     });
// });
// Add Question 
$(document).on("submit","#addQuestionFrm2" , function(){
  $.post("query/addQuestionExe2.php", $(this).serialize() , function(data){
    alert(data);
    if(data.res == "exist")
    { 
      Swal.fire(
          'Already Exist',
          data.msg + ' question <br>already exist in this exam',
          'error'
       )
    }
    else if(data.res == "success")
    {
      Swal.fire(
        'Success',
        ' question <br>Successfully added',
        'success'
      )
        $('#addQuestionFrm2')[0].reset();
        refreshDiv();
    }
   
  },'json')
  return false;
});
    $(document).on("submit","#addQuestionFrm22" , function(e){
        e.preventDefault();
    //      var formData = $("#addQuestionFrm2").submit(function (e) {
    //     return;
    // });
         var formData = new FormData(formData[0]);
        var formname = $('#addQuestionFrm2').attr('name');
       var form = $('#addQuestionFrm2').serialize(); 
        //alert("kkkxx");              
        var FormData = new FormData(this);
//alert("ok");
        $.ajax({ 
            url : 'query/addQuestionExe2.php',
            data : {FormData:FormData},
            type : 'POST',
            processData: false,
            contentType: false,
            success : function(data){
            alert(data); 
    //             if(data.res == "exist")
    // { 
    //   Swal.fire(
    //       'Already Exist',
    //       data.msg + ' question <br>already exist in this exam',
    //       'error'
    //    )
    // }
    // else if(data.res == "success")
    // {
    //   Swal.fire(
    //     'Success',
    //     ' question <br>Successfully added',
    //     'success'
    //   )
    //     $('#addQuestionFrm2')[0].reset();
    //     refreshDiv();
    // }
            }
        });
   });
// Update Question


// Add Examinee
$(document).on("submit","#addExamineeFrm" , function(){
  $.post("query/addExamineeExe.php", $(this).serialize() , function(data){
    if(data.res == "noGender")
    {
      Swal.fire(
          'No Gender',
          'Please select gender',
          'error'
       )
    }
    else if(data.res == "noCourse")
    {
      Swal.fire(
          'No Course',
          'Please select course',
          'error'
       )
    }
    else if(data.res == "noLevel")
    {
      Swal.fire(
          'No Year Level',
          'Please select year level',
          'error'
       )
    }
    else if(data.res == "fullnameExist")
    {
      Swal.fire(
          'Fullname Already Exist',
          data.msg + ' are already exist',
          'error'
       )
    }
    else if(data.res == "emailExist")
    {
      Swal.fire(
          'Email Already Exist',
          data.msg + ' are already exist',
          'error'
       )
    }
    else if(data.res == "success")
    {
      Swal.fire(
          'Success',
          data.msg + ' are now successfully added',
          'success'
       )
        refreshDiv();
        $('#addExamineeFrm')[0].reset();
    }
    else if(data.res == "failed")
    {
      Swal.fire(
          "Something's Went Wrong",
          '',
          'error'
       )
    }


    
  },'json')
  return false;
});



// Update Examinee
$(document).on("submit","#updateExamineeFrm" , function(){
  $.post("query/updateExamineeExe.php", $(this).serialize() , function(data){
     if(data.res == "success")
     {
        Swal.fire(
            'Success',
            data.exFullname + ' <br>has been successfully updated!',
            'success'
          )
          refreshDiv();
     }
  },'json')
  return false;
});


function refreshDiv()
{
  $('#tableList').load(document.URL +  ' #tableList');
  $('#refreshData').load(document.URL +  ' #refreshData');

}



