
<?php  
  include("../../conn.php");

   include("../../lib/getval.php");
  $cmn = new TestCommandRun();

  $eqt_id = $id = $_GET['id'];
  
  
  $selQueRow = $conn->query("SELECT * FROM exam_question_tbl WHERE eqt_id='$id' AND status='0'")->fetch(PDO::FETCH_ASSOC);
 

  $level = $selQueRow['dificulty_level'];
  $topic_id = $selQueRow["topic_id"];
    $sub_topic_id = $selQueRow["sub_topic_id"];
    $category_id = $selQueRow["category_id"];
    $sub_category_id = $selQueRow["sub_category_id"];
    
    
    

  $exam_question = $selQueRow['exam_question'];
  $exam_answer = $selQueRow['exam_answer'];
  $exam_answer_id = $selQueRow['exam_answer_id'];
  $explanation = $selQueRow['explanation'];
  $exam_answer = $selQueRow['exam_answer'];

  $main_subject_id = $selQueRow['main_subject_id'];
  $sub_subjecthead_id =$selQueRow['sub_subjecthead_id'];

  
  $choice_A1 = $cmn->getvalfield($conn,"exam_answers_option","answer","eqt_id = '$eqt_id' and quehead_id = '$sub_subjecthead_id' and atod = 'A'");
   $choice_A1_id = $cmn->getvalfield($conn,"exam_answers_option","id","eqt_id = '$eqt_id' and quehead_id = '$sub_subjecthead_id' and atod = 'A'");
  $choice_B1 = $cmn->getvalfield($conn,"exam_answers_option","answer","eqt_id = '$eqt_id' and quehead_id = '$sub_subjecthead_id' and atod = 'B'");
   $choice_B1_id = $cmn->getvalfield($conn,"exam_answers_option","id","eqt_id = '$eqt_id' and quehead_id = '$sub_subjecthead_id' and atod = 'B'");
  $choice_C1 = $cmn->getvalfield($conn,"exam_answers_option","answer","eqt_id = '$eqt_id' and quehead_id = '$sub_subjecthead_id' and atod = 'C'");
  $choice_C1_id = $cmn->getvalfield($conn,"exam_answers_option","id","eqt_id = '$eqt_id' and quehead_id = '$sub_subjecthead_id' and atod = 'C'");
  $choice_D1 = $cmn->getvalfield($conn,"exam_answers_option","answer","eqt_id = '$eqt_id' and quehead_id = '$sub_subjecthead_id' and atod = 'D'");
  $choice_D1_id = $cmn->getvalfield($conn,"exam_answers_option","id","eqt_id = '$eqt_id' and quehead_id = '$sub_subjecthead_id' and atod = 'D'");

  $isRight_A1 = $cmn->getvalfield($conn,"exam_answers_option","is_right","eqt_id = '$eqt_id' and quehead_id = '$sub_subjecthead_id' and atod = 'A'");
  $isRight_B1 = $cmn->getvalfield($conn,"exam_answers_option","is_right","eqt_id = '$eqt_id' and quehead_id = '$sub_subjecthead_id' and atod = 'B'");
  $isRight_C1 = $cmn->getvalfield($conn,"exam_answers_option","is_right","eqt_id = '$eqt_id' and quehead_id = '$sub_subjecthead_id' and atod = 'C'");
  $isRight_D1 = $cmn->getvalfield($conn,"exam_answers_option","is_right","eqt_id = '$eqt_id' and quehead_id = '$sub_subjecthead_id' and atod = 'D'");

 ?>
 <?php
      $sub_topic_name = $cmn->getvalfield($conn,"sub_topic_master","sub_topic_name","id =$sub_topic_id and topic_id = '$topic_id'");
 ?>
 
<style type="text/css">
  @media only screen and (max-width: 600px) {
  #resetdiv{
    margin-top: 10px;
  }
}
#output {
  padding: 0px;
   
}
.chosen-container-multi{
  width: 100% !important;
}
.search-choice-close{
  color: black !important;
}
 </style>

<script src="../ckeditor/ckeditor.js"></script>
<script src="../ckeditor/samples/js/sample.js"></script>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style type="text/css">
  #facebox{
    left: 365.5px !important;
    top: 13.3px !important;
  }
  #facebox .popup {
    width: 100% !important;

  }
  #facebox .content {
    width: 100% !important;
  }
</style>
<fieldset style="" >
	<legend><i class="facebox-header"><i class="edit large icon"></i>&nbsp;Edit Question</i></legend>
  
  <div class="app-main__outer">
        <div class="app-main__inner">
           <!--  <div class="app-page-title">
                <div class="page-title-wrapper">
                     <div class="page-title-heading">
                        <div> Add Question
                            <div class="page-title-subheading">
                              Add Question for <b><?php echo $selExamRow['quehead']; ?></b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   -->      
            
            <div class="col-md-12">
            <div id="refreshData">
            <div class="row">
                  <div class="col-md-12">
                      <div class="main-card mb-3 card">
                          <div class="card-header"> 
                            <i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>Question Information
                          </div>
                          <div class="card-body"> 
                            <form class="refreshFrm" id="updateQuestionFrm2" action="" method="post" enctype="multipart/form-data" >
                              <input type="hidden" name="action" value="update">
     <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="refreshFrm" method="post" id="addQuestionFrm2">
        <input type="hidden" name="eqt_id" id="eqt_id" value="<?php echo $eqt_id; ?>">
        <input type="hidden" name="main_subject_id"  value="<?php echo $main_subject_id; ?>">
        <input type="hidden" name="sub_subjecthead_id" id="sub_subjecthead_id" value="<?php echo $sub_subjecthead_id; ?>">
      <div class="modal-body" style="">
            


        <div class="col-md-12">
          <div class="form-group">
            <label><b>Question</b></label>
            
            <!-- <input type="" name="question" id="question" class="form-control" placeholder="Input question" autocomplete="off"> -->
                <textarea name="exam_question" id="editor11" rows="10" cols="80">
                <?php echo $exam_question; ?>
            </textarea>
            <script>
                CKEDITOR.replace( 'editor11' );
            </script>
          </div>

          <fieldset>
            <legend>Input word for Options</legend>
            <div class="form-group">
              <input type="hidden" name="choice_A1_id" value="<?php echo $choice_A1_id; ?>">
                <label>Option A</label>
                <input type="" name="choice_A1" id="choice_A1" value="<?php echo $choice_A1; ?>" class="form-control" placeholder="Input Option A" autocomplete="off">
                Graphic <input type="checkbox" name="option_A_chk" id="option_A_chk">
               <span id="up1" style="display: none;">Upload File : <input type="file"  name="graphic_A" id="graphic_A"></span> 
            </div>

            <div class="form-group">
              <input type="hidden" name="choice_B1_id" value="<?php echo $choice_B1_id; ?>">
                <label>Option B</label>
                <input type="" name="choice_B1" value="<?php echo $choice_B1; ?>" id="choice_B1" class="form-control" placeholder="Input Option B" autocomplete="off">
                Graphic <input type="checkbox" name="option_B_chk" id="option_B_chk">
                <span id="up2" style="display: none;">Upload File : <input type="file"  name="graphic_b" id="graphic_b"></span> 
            </div>

            <div class="form-group">
              <input type="hidden" name="choice_C1_id" value="<?php echo $choice_C1_id; ?>">
                <label>Option C</label>
                <input type="" name="choice_C1" value="<?php echo $choice_C1; ?>" id="choice_C1" class="form-control" placeholder="Input Option C" autocomplete="off">
                Graphic <input type="checkbox" name="option_C_chk" id="option_C_chk">
                <span id="up3" style="display: none;">Upload File : <input type="file"  name="graphic_c" id="graphic_c"></span> 
            </div>
 
            <div class="form-group">
              <input type="hidden" name="choice_D1_id" value="<?php echo $choice_D1_id; ?>">
                <label>Option D</label>
                <input type="" name="choice_D1" value="<?php echo $choice_D1; ?>" id="choice_D1" class="form-control" placeholder="Input Option D" autocomplete="off">
                Graphic <input type="checkbox" name="option_D_chk" id="option_D_chk">
                <span id="up4" style="display: none;">Upload File : <input type="file"  name="graphic_d" id="graphic_d"></span> 
            </div>

            <div class="form-group">
                <label>Correct Answer</label>
                <!-- <input type="" name="correctAnswer" id="" class="form-control" placeholder="Input correct answer" autocomplete="off"> -->
                <select name="correctAnswer" id="correctAnswer" class="form-control" >
                  <!-- <option value="" >Select</option> -->
                  <option <?php if($isRight_A1=="1"){ echo "selected"; } ?> value="A">A</option>
                  <option <?php if($isRight_B1=="1"){ echo "selected"; } ?> value="B">B</option>
                  <option <?php if($isRight_C1=="1"){ echo "selected"; } ?> value="C">C</option>
                  <option <?php if($isRight_D1=="1"){ echo "selected"; } ?> value="D">D</option>
                </select>
            </div>
          

           <div class="col-md-12">
                    <div class="col-sm-6">
            <label ><b>Difficulty Level</b></label>
            <select name="dificulty_level" class="form-control">
              
              <option <?php if($level == '1'){ echo "selected"; }?> value="1">Beginner</option>
              <option <?php if($level == '2'){ echo "selected"; }?> value="2">Intermediate</option>
              <option <?php if($level == '3'){ echo "selected"; }?> value="3">Advanced</option>
              <option <?php if($level == '4'){ echo "selected"; }?> value="4">Basic</option>
            </select>
           
          </div>
        </div>

          <input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>">


        <!--  <div class="col-md-12" style="display: none;">
          <label class="col-sm-2 control-label"><b>Topic</b></label>
                <div  class="col-sm-6" >
                <select name="topic_id" onchange="get_sub_topic();" id="topic_id" class="form-control" >
                 <?php  $sql = $conn->query("SELECT * FROM subject_quehead  WHERE id = '$topic_id' AND status='0' ORDER BY id DESC ");
 ?>
<option  value="">Select</option>
 <?php
while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
?>
    <option <?php if($topic_id==$row["id"]){ echo "selected"; } ?> value="<?php echo $row["id"] ?>" ><?php echo $row["topic_name"]; ?></option>
<?php } ?>
                  </select>
                </div>
</div> -->          
        <div class="col-md-12" style="">
                    <div class="col-sm-6">
            <label ><b>Sub Topic</b></label>
            <select name="sub_topic_id" class="form-control" id="sub_topic_id">
              <!--  onchange="get_category();" -->
              <?php  $sql = $conn->query("SELECT * FROM sub_topic_master  WHERE topic_id = '$topic_id' AND status='0' ORDER BY id DESC ");
 ?><?php
              while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                ?>
    <option  <?php  if($sub_topic_id == $row["id"]){ echo "selected"; }?> value="<?php echo $row["id"]; ?>" ><?php echo $row["sub_topic_name"]; ?></option>
              <?php } ?> 
            </select>
           
          </div>
        </div>
        <br>
        <div class="form-group">
              <label>Category</label>&nbsp;
              <?php $cat_name = $cmn->getvalfield($conn,"category_master","category_name","topic_id = '$topic_id' and status='0'");?>
              <button type="button" class="btn-outline-primary"><?php echo $cat_name; ?></button><br>
               <select data-placeholder="Select Tags" name="categorytag[]" multiple class="chosen-select">
               <?php  $sql = $conn->query("SELECT * FROM category_master  WHERE topic_id = '$topic_id' AND status='0' ORDER BY id DESC ");
               while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
 ?>
                  
                 <option value="<?php echo $row["id"]; ?>"><?php echo $row["category_name"]; ?></option> 
                 <?php } ?>
               </select>
            </div>

         <div class="col-md-12" style="">
                    <div class="col-sm-6">
            <label>Sub Category</label>
            <?php $sub_cat_name = $cmn->getvalfield($conn,"sub_category_master","sub_category_name","topic_id = '$topic_id' and status='0'");?>
              <button type="button" class="btn-outline-primary"><?php echo $sub_cat_name; ?></button><br>
            <select data-placeholder="Select Tags"  name="subcattag[]" multiple class="chosen-select">
                <?php  $sql = $conn->query("SELECT * FROM sub_category_master  WHERE topic_id = '$topic_id' AND status='0' ORDER BY id DESC ");
                  while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                ?>
                 <option value="<?php echo $row["id"]; ?>"><?php echo $row["sub_category_name"]; ?></option> 
                 <?php } ?>
               </select>
           
          </div>
        </div>
        </fieldset>

        <div class="form-group">
            <label><b>Explanation</b></label>
            
            <!-- <input type="" name="question" id="question" class="form-control" placeholder="Input question" autocomplete="off"> -->
                <textarea name="explanation" id="editor2" rows="10" cols="80">
                <?php echo $explanation; ?>
            </textarea>
            <script>
                CKEDITOR.replace( 'editor2' );
            </script>
          </div>
        
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
        <button type="submit" name="update" class="btn btn-primary">Save Changes</button>
      </div>
      </form>
    </div>
   </form>
                           
                          </div>
                      </div>
                   
                  </div></div>
                  <div class="col-md-6" style="display: none;">
                    <?php 
                        $selQuest = $conn->query("SELECT * FROM exam_question_tbl WHERE exam_id='$exId' ORDER BY eqt_id desc");
                    ?>
                     <div class="main-card mb-3 card">
                          <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>Topic Questions 
                            <span class="badge badge-pill badge-primary ml-2">
                              <?php echo $selQuest->rowCount(); ?>
                            </span>
                             <div class="btn-actions-pane-right">
                                <button class="btn btn-sm btn-primary " data-toggle="modal" data-target="#modalForAddQuestion">Add Question</button>
                              </div>
                          </div>
                          <div class="card-body" >
                            <div class="scroll-area-sm" style="min-height: 400px;">
                               <div class="scrollbar-container">

                            <?php 
                               
                               if($selQuest->rowCount() > 0)
                               {  ?>
                                 <div class="table-responsive">
                                    <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="tableList">
                                        <thead>
                                        <tr>
                                            <th class="text-left pl-1">Subject Name</th>
                                            <th class="text-center" width="20%">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                          <?php 
                                            
                                            if($selQuest->rowCount() > 0)
                                            {
                                               $i = 1;
                                               while ($selQuestionRow = $selQuest->fetch(PDO::FETCH_ASSOC)) { ?>
                                                <tr>
                                                        <td >
                                                            <b><?php echo $i++ ; ?> .) <?php echo $selQuestionRow['exam_question']; ?></b><br>
                                                            <?php 
                                                              // Choice A
                                                              if($selQuestionRow['exam_ch1'] == $selQuestionRow['exam_answer'])
                                                              { ?>
                                                                <span class="pl-4 text-success">A - <?php echo  $selQuestionRow['exam_ch1']; ?></span><br>
                                                              <?php }
                                                              else
                                                              { ?>
                                                                <span class="pl-4">A - <?php echo $selQuestionRow['exam_ch1']; ?></span><br>
                                                              <?php }

                                                              // Choice B
                                                              if($selQuestionRow['exam_ch2'] == $selQuestionRow['exam_answer'])
                                                              { ?>
                                                                <span class="pl-4 text-success">B - <?php echo $selQuestionRow['exam_ch2']; ?></span><br>
                                                              <?php }
                                                              else
                                                              { ?>
                                                                <span class="pl-4">B - <?php echo $selQuestionRow['exam_ch2']; ?></span><br>
                                                              <?php }

                                                              // Choice C
                                                              if($selQuestionRow['exam_ch3'] == $selQuestionRow['exam_answer'])
                                                              { ?>
                                                                <span class="pl-4 text-success">C - <?php echo $selQuestionRow['exam_ch3']; ?></span><br>
                                                              <?php }
                                                              else
                                                              { ?>
                                                                <span class="pl-4">C - <?php echo $selQuestionRow['exam_ch3']; ?></span><br>
                                                              <?php }

                                                              // Choice D
                                                              if($selQuestionRow['exam_ch4'] == $selQuestionRow['exam_answer'])
                                                              { ?>
                                                                <span class="pl-4 text-success">D - <?php echo $selQuestionRow['exam_ch4']; ?></span><br>
                                                              <?php }
                                                              else
                                                              { ?>
                                                                <span class="pl-4">D - <?php echo $selQuestionRow['exam_ch4']; ?></span><br>
                                                              <?php }

                                                             ?>
                                                            
                                                        </td>
                                                        <td class="text-center">
                                                         <a rel="facebox" href="facebox_modal/updateQuestion.php?id=<?php echo $selQuestionRow['eqt_id']; ?>" class="btn btn-sm btn-primary">Update</a>
                                                         <button type="button" id="deleteQuestion" data-id='<?php echo $selQuestionRow['eqt_id']; ?>'  class="btn btn-danger btn-sm">Delete</button>
                                                        </td>
                                                    </tr>
                                               <?php }
                                            }
                                            else
                                            { ?>
                                                <tr>
                                                  <td colspan="2">
                                                    <h3 class="p-3">No Course Found</h3>
                                                  </td>
                                                </tr>
                                            <?php }
                                           ?>
                                        </tbody>
                                    </table>
                                </div>
                               <?php }
                               else
                               { ?>
                                  <h4 class="text-primary">No question found...</h4>
                                 <?php
                               }
                             ?>
                               </div>
                            </div>


                          </div>
                        
                      </div>
                  </div>
              </div>  
            </div> 
            </div>
               
            </div>
</fieldset>


      <script type="text/javascript">
  //document.getElementById('output').innerHTML = location.search;
$(".chosen-select").chosen();
 </script> 

    








