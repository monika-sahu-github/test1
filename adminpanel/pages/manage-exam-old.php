<div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div>MANAGE EXAM</div>
                    </div>
                </div>
            </div>        
            
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">Exam List
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="example">
                            <thead>
                            <tr>
                               <th class="text-left ">Subject</th>
                                <th class="text-left ">Topic</th>
                                <th class="text-left ">Exam Type</th>
                                <th class="text-left ">Date Time</th>
                                <th class="text-center" width="20%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php 
                                $selExam = $conn->query("SELECT * FROM subject_quehead WHERE status='0' ORDER BY id DESC ");
                                if($selExam->rowCount() > 0)
                                {
                                    while ($selExamRow = $selExam->fetch(PDO::FETCH_ASSOC)) {

                                        if($selExamRow['type']==0){
                                            $examtype = "Practice Test";
                                        } else {
                                            $examtype = "Mock Test";
                                        }

                                     ?>
                                        <tr>
                                            
                                            
                                            <td>
                                                <?php 
                                                    $exam_id =  $selExamRow['exam_id']; 
                                                    $selCourse = $conn->query("SELECT * FROM main_subject WHERE ex_id='$exam_id' and status='0'");
                                                    while ($selCourseRow = $selCourse->fetch(PDO::FETCH_ASSOC)) {
                                                        echo $selCourseRow['ex_title'];
                                                    }
                                                ?>
                                            </td>
                                            <td><a href="home.php?page=question-list&id=<?php echo $selExamRow['id']; ?>"><?php echo $selExamRow['quehead']; ?></a></td>
                                            <td><?php echo $examtype; ?></td>
                                            <td><?php echo $selExamRow['examQuestDipLimit'];  ?></td>
                                            <td class="text-center">
                                             <!-- <a href="manage-exam.php?id=<?php echo $selExamRow['id']; ?>" type="button" class="btn btn-primary btn-sm">Manage</a> -->
                                              <a href="add-question.php?id=<?php echo $selExamRow['id']; ?>" type="button" class="btn btn-primary btn-sm">Add Quesiton</a>
                                             <!-- <button type="button" id="deleteExam" data-id='<?php echo $selExamRow['id']; ?>'  class="btn btn-danger btn-sm">Delete</button> -->
                                            </td>
                                        </tr>

                                    <?php }
                                }
                                else
                                { ?>
                                    <tr>
                                      <td colspan="5">
                                        <h3 class="p-3">No Exam Found</h3>
                                      </td>
                                    </tr>
                                <?php }
                               ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
      
        
</div>
         
