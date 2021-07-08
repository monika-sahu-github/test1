   <?php 
  //function getvalfield($conn,$table,$field,$where)
//{ //echo "SELECT $field FROM $table WHERE $where";
//$stmt = $conn->prepare("SELECT $field FROM $table WHERE $where"); 
// $stmt->execute(); 
// $row = $stmt->fetch(); 
// return $row[0] ?? 'default value'; 
//$row['Data'] ??= 'default value';
//return $row['Data'];
//}
$admin_userArr = $_SESSION['admin'];
$admin_user_type = $admin_userArr['type'];
 ?>
   <div class="app-sidebar sidebar-shadow">
                    <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div>    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading"><a href="home.php">Dashboards</a></li>
                               <?php //if($admin_user_type==1){ ?>
                                <li class="app-sidebar__heading">MASTER</li>
                                <li>
                                    <a href="#">
                                         <i class="metismenu-icon pe-7s-display2"></i>
                                         MASTER 
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <!-- <li>
                                            <a href="#" data-toggle="modal" data-target="#modalForAddMockTest">
                                                <i class="metismenu-icon"></i>
                                                EXAM MASTER
                                            </a>
                                        </li> -->
                                        <li>
                                            <a href="home.php?page=exam-master">
                                                <i class="metismenu-icon">
                                                </i>SUBJECT MASTER
                                            </a>
                                        </li>
                                       <!--  <li>
                                            <a href="home.php?page=manage-mock-test">
                                                <i class="metismenu-icon">
                                                </i>EXAM LIST
                                            </a>
                                        </li> -->
                                        <li>
                                            <a href="home.php?page=subject-master" data-toggle="modal">
                                                <i class="metismenu-icon"></i>
                                                 TOPIC MASTER
                                            </a>
                                        </li>
                                         
                                        <li style="display:none;">
                                            <a href="home.php?page=topic-master" data-toggle="modal"> 
                                                <i class="metismenu-icon"></i>
                                                TOPIC MASTER
                                            </a>
                                        </li>

                                        <li style="">
                                            <a href="home.php?page=sub-topic-master" data-toggle="modal"> 
                                                <i class="metismenu-icon"></i>
                                                SUB TOPIC MASTER
                                            </a>
                                        </li>
                                        <li style="">
                                            <a href="home.php?page=category-master" data-toggle="modal"> 
                                                <i class="metismenu-icon"></i>
                                                CATEGORY MASTER
                                            </a>
                                        </li>
                                        <li style="">
                                            <a href="home.php?page=sub-category-master" data-toggle="modal"> 
                                                <i class="metismenu-icon"></i>
                                                SUB CATEGORY MASTER
                                            </a>
                                        </li>
                                         <!-- <li>
                                            <a href="home.php?page=tag">
                                                <i class="metismenu-icon">
                                                </i>TAG MASTER
                                            </a>
                                        </li> -->
                                        <!-- <li>
                                            <a href="home.php?page=manage-course">
                                                <i class="metismenu-icon">
                                                </i>Manage PRACTICE TEST
                                            </a>
                                        </li> -->
                                       
                                    </ul>
                                </li>
                            <?php  //} ?>

                                <!-- <li class="app-sidebar__heading">MANAGE EXAM</li>
                                <li>
                                    <a href="#">
                                         <i class="metismenu-icon pe-7s-display2"></i>
                                         EXAM 
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="#" data-toggle="modal" data-target="#modalForAddMockTest">
                                                <i class="metismenu-icon"></i>
                                                Add MOCK TEST
                                            </a>
                                        </li>
                                        <li>
                                            <a href="home.php?page=manage-mock-test">
                                                <i class="metismenu-icon">
                                                </i>Manage MOCK TEST
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" data-toggle="modal" data-target="#modalForAddCourse">
                                                <i class="metismenu-icon"></i>
                                                Add PRACTICE TEST
                                            </a>
                                        </li>
                                        <li>
                                            <a href="home.php?page=manage-course">
                                                <i class="metismenu-icon">
                                                </i>Manage PRACTICE TEST
                                            </a>
                                        </li>
                                       
                                    </ul>
                                </li> -->
                               
                                <li class="app-sidebar__heading"> Question</li>
                                <li>
                                    <a href="#">
                                         <i class="metismenu-icon pe-7s-display2"></i>
                                         Add Question
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <!-- <li>
                                            <a href="#" data-toggle="modal" data-target="#modalForExam">
                                                <i class="metismenu-icon"></i>
                                                Add SUBJECT TOPIC
                                            </a>
                                        </li> -->
                                        <li>
                                            <a href="home.php?page=manage-exam">
                                                <i class="metismenu-icon">
                                                </i>Add Question
                                            </a>
                                        </li>
                                       
                                    </ul>
                                </li>
                           
                                <?php if($admin_user_type==1){ ?>
                                <li class="app-sidebar__heading">MANAGE EXAMINEE</li>
                                <!-- <li>
                                    <a href="" data-toggle="modal" data-target="#modalForAddExaminee">
                                        <i class="metismenu-icon pe-7s-add-user">
                                        </i>Add Examinee
                                    </a>
                                </li> -->
                                <li>
                                    <a href="home.php?page=manage-examinee">
                                        <i class="metismenu-icon pe-7s-users">
                                        </i>Manage Examinee
                                    </a>
                                </li><?php } ?>
                                <!-- <li class="app-sidebar__heading">RANKING</li>
                                <li>
                                    <a href="home.php?page=ranking-exam">
                                        <i class="metismenu-icon pe-7s-cup">
                                        </i>Ranking By Exam
                                    </a>
                                </li> -->
                                <?php if($admin_user_type==1){ ?>
                                <li class="app-sidebar__heading">NOTIFICATIONS</li><li>
                                    <a href="home.php?page=notifications"><i class="metismenu-icon pe-7s-users">
                                        </i>Create Notifications</a>
                                </li>


                                <li class="app-sidebar__heading">REPORTS</li>
                                <li>
                                    <a href="home.php?page=examinee-result">
                                        <i class="metismenu-icon pe-7s-cup">
                                        </i>Examinee Result
                                    </a>
                                </li>
                              

                                 <li class="app-sidebar__heading">FEEDBACKS</li>
                                <li>
                                    <a href="home.php?page=feedbacks">
                                        <i class="metismenu-icon pe-7s-chat">
                                        </i>All Feedbacks
                                    </a>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>  