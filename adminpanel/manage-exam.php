<?php 
session_start();
if(!isset($_SESSION['admin']['adminnakalogin']) == true) header("location:index.php");


?>
<?php include("../conn.php");
//  function getvalfield($conn,$table,$field,$where)
// { //echo "SELECT $field FROM $table WHERE $where";die;
// $stmt = $conn->prepare("SELECT $field FROM $table WHERE $where"); 
// $stmt->execute(); 
// $row = $stmt->fetch(); 
// return $row[0];
// }
 ?>
<!-- MAO NI ANG HEADER -->
<?php include("includes/header.php"); ?>      

<!-- UI THEME DIRI -->
<?php include("includes/ui-theme.php"); ?>
<script src="../ckeditor/ckeditor.js"></script>
    <script src="../ckeditor/samples/js/sample.js"></script>
<div class="app-main">
<!-- sidebar diri  -->
<?php include("includes/sidebar.php"); ?>
<?php 

   $exId = $_GET['id'];
   $exam_name = getvalfield($conn,"exam_tbl","ex_title","ex_id = '$exId'"); 
   $questions = getvalfield($conn,"exam_tbl","questions","ex_id = '$exId'"); 
   $selExam = $conn->query("SELECT * FROM subject_quehead WHERE id='$exId' ");

   $selExamRow = $selExam->fetch(PDO::FETCH_ASSOC);

  $ex_id = $selExamRow['exam_id'];
   $selCourse = $conn->query("SELECT ex_title as courseName FROM exam_tbl WHERE ex_id='$ex_id' ")->fetch(PDO::FETCH_ASSOC);
 ?>
<link rel="stylesheet" href="css/chosen.css">
<div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                     <div class="page-title-heading">
                        <div> MANAGE EXAM
                            <div class="page-title-subheading">
                              Add Question for <b><?php echo $exam_name; ?></b><br>
                              Questions - <b><?php echo $questions; ?></b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        
            <div class="col-md-12">
            <div id="refreshData">
            <div class="row">
                  <div class="col-md-6">
                      <div class="main-card mb-3 card">
                          <div class="card-header">
                            <i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>Select Subjects
                          </div>
                          <div class="card-body">
                           <form method="post" id="updateExamFrm">
                            <input type="hidden" name="examId" value="<?php echo $selExamRow['id']; ?>">
      <div class="modal-body">
        <div class="col-md-12">
          <div class="form-group">
            <label>Select Subject</label>
            <select data-placeholder="Select Combo" multiple class="form-control chosen-select" required="" id="courseSelected" name="courseSelected">
               
              <?php 
                $selCourse = $conn->query("SELECT * FROM subject_quehead WHERE type = 1 AND exam_id = '$exId' ORDER BY id DESC");
                if($selCourse->rowCount() > 0)
                {
                  while ($selCourseRow = $selCourse->fetch(PDO::FETCH_ASSOC)) { ?>
                     <option <?php if($selExamRow['exam_id']==$selCourseRow['id']){ echo "selected"; } ?> value="<?php echo $selCourseRow['id']; ?>"><?php echo $selCourseRow['quehead']; ?></option>
                  <?php }
                }
                else
                { ?>
                  <option value="0">No Course Found</option>
                <?php }
               ?>
            </select>
          </div>

          <!-- <div class="form-group">
            <label>Exam Title</label>
            <input type="" name="examTitle" value="<?php echo $selExamRow['quehead']; ?>" class="form-control" placeholder="Input Exam Title" required="">
          </div> -->

          <!-- <div class="form-group">
            <label>Date Time</label>
            <input type="datetime-local" name="examQuestTime" value="<?php echo $selExamRow['examQuestDipLimit'];   ?>" id="examQuestTime" class="form-control" placeholder="">
            <?php echo $selExamRow['examQuestDipLimit'];   ?>
          </div> -->
</div>
      </div>
   <div class="form-group" align="right">
                                <button type="submit" class="btn btn-primary btn-lg">Save</button>
                              </div> 
                           </form>                           
                          </div>
                      </div>
                   
                  </div>
                  <div class="col-md-6" style="">
                    <?php 
                        $selQuest = $conn->query("SELECT * FROM exam_question_tbl WHERE exam_id='$exId' ORDER BY eqt_id desc");
                    ?>
                     <div class="main-card mb-3 card">
                          <div class="card-header"><i class="header-icon lnr-license icon-gradient bg-plum-plate"> </i>Exam Question's 
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
                                            <th class="text-left pl-1">Course Name</th>
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
      
        

<!-- MAO NI IYA FOOTER -->
<?php include("includes/footer.php"); ?>
  <script src="js/chosen.jquery.js" type="text/javascript"></script>
    <script src="js/chosen.jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        // Chosen touch support.
    if ($('.chosen-select').length > 0) {
      $('.chosen-select').on('touchstart', function(e){
        e.stopPropagation(); e.preventDefault();
        // Trigger the mousedown event.
        $(this).trigger('mousedown');
      });
    }
    </script>
    <script>
function changeLook()
{
  var config = {
      '.chosen-select' : {}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
}
changeLook();
</script>

<?php include("includes/modals.php"); ?>
