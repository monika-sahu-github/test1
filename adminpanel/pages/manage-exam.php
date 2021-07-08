<div class="app-main__outer">
        <div class="app-main__inner">
        	
        	<form>
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div>All Subjects</div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">List Of Subjects
                    </div>

                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="example">
                            <thead>
                            <tr>
                               <th class="text-left ">Subject Name</th>
                                <th class="text-left ">Total Questions</th>
                                <th class="text-left ">Total Beginner</th>
                                <th class="text-left ">Total Intermediate</th>
                                <th class="text-left ">Total Advanced</th>
                                <th class="text-left">Total Basics</th>
                                <th class="text-center" width="30%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                           <?php 
                           $selCourse = $conn->query("SELECT * FROM main_subject WHERE status='0'");
                               
                               while ($selCourseRow = $selCourse->fetch(PDO::FETCH_ASSOC)) {

                          $totQues = $conn->query("SELECT COUNT(*) as allques FROM exam_question_tbl WHERE main_subject_id = '$selCourseRow[ex_id]' AND status='0'")->fetch(PDO::FETCH_ASSOC); 

                						$ques_count = $totQues['allques'];
                			$totBeginner = $conn->query("SELECT COUNT(*) as allques FROM exam_question_tbl WHERE main_subject_id = '$selCourseRow[ex_id]' AND dificulty_level='1' AND status='0'")->fetch(PDO::FETCH_ASSOC); 

                			$beginner_count = $totBeginner['allques'];
                						$totIntermed = $conn->query("SELECT COUNT(*) as allques FROM exam_question_tbl WHERE main_subject_id = '$selCourseRow[ex_id]' AND dificulty_level='2' AND status='0'")->fetch(PDO::FETCH_ASSOC); 

                						$intermed_count = $totIntermed['allques'];
                						$totAdvanced = $conn->query("SELECT COUNT(*) as allques FROM exam_question_tbl WHERE main_subject_id = '$selCourseRow[ex_id]' AND dificulty_level='3' AND status='0'")->fetch(PDO::FETCH_ASSOC); 

                						$advanced_count = $totAdvanced['allques'];
                						$totBasic = $conn->query("SELECT COUNT(*) as allques FROM exam_question_tbl WHERE main_subject_id = '$selCourseRow[ex_id]' AND dificulty_level='4' AND status='0'")->fetch(PDO::FETCH_ASSOC); 

                						$basic_count = $totBasic['allques'];?>

                            	<tr>
                            	<td><?php echo $selCourseRow['ex_title']; ?></td>
                                 <td><?php echo $ques_count; ?></td>
                                 <td><?php echo $beginner_count; ?></td>
                                 <td><?php echo $intermed_count; ?></td>
                                 <td><?php echo $advanced_count; ?></td>
                                 <td><?php echo $basic_count; ?></td>	
                                 <td class="text-center"><a href="add-question.php?id=<?php echo $selCourseRow['ex_id']; ?>" class="btn btn-primary btn-sm">Add Questions</a>&nbsp;<a href="home.php?page=question-list&id=<?php echo $selCourseRow['ex_id']; ?>" class="btn btn-warning btn-sm">Questions List</a>
                                 </td>
                                 
                               		

                            </tr> <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            </form>
        
            </div>    