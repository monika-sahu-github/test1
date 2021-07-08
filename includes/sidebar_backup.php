<?php
//   function getvalfield($conn,$table,$field,$where)
// { //echo "SELECT $field FROM $table WHERE $where";
// $stmt = $conn->prepare("SELECT $field FROM $table WHERE $where"); 
// $stmt->execute(); 
// $row = $stmt->fetch(); 
// return $row[0];
// }  
$encryption = openssl_encrypt($simple_string, $ciphering, 
$key, $options, $iv); 
$simple_string2 = "1"; 
$ciphering = "AES-128-CTR";
//$decryption_iv = '1234567891011121'; 
$decryption_key = "OnLineTest";
$iv_length = openssl_cipher_iv_length($ciphering); 
$options = 0; 
$encryption2 = openssl_encrypt($simple_string2, $ciphering, 
$key, $options, $iv); 
 ?><div class="app-sidebar sidebar-shadow">
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
               <li class="app-sidebar__heading"><a href="home.php?page=dashboard">Dashboard</a></li>
         
  
 
  <li class="app-sidebar__heading">Exam</li>
                <li>
                <a href="#">
                     <i class="metismenu-icon pe-7s-display2"></i>
                     All Exams
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul >
                    <li>
                      <a href="home.php?page=examination_test_type&exam_type=<?php echo $encryption; ?>"> 
                                <i class="metismenu-icon"></i>Practice Test
                            </a>
                       </li>

                    <li>
                      <a href="home.php?page=mock"> 
                                <i class="metismenu-icon"></i>Mock Test
                            </a>
                       </li>                        


                </ul>
                </li>

         <li class="app-sidebar__heading">RESULT</li>
                <li>
                <a href="#">
                     <i class="metismenu-icon pe-7s-display2"></i>
                      Exam Results
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                     
                       <li>
                      <a href="home.php?page=all_results"> 
                                <i class="metismenu-icon"></i>Practice Test Result
                            </a>
                       </li>
                      <li>
                      <a href="home.php?page=mock_result"> 
                                <i class="metismenu-icon"></i>Mock Test Result
                            </a>
                       </li>
                </ul>
                </li> 
             <li class="app-sidebar__heading"><a href="home.php?page=myprofile">My Account</a></li>    
            <li class="app-sidebar__heading"><a href="home.php?page=change_pass">Change Password</a></li> 
            <li class="app-sidebar__heading"><a href="query/logoutExe.php">Logout</a></li>     
            </ul>
        </div>
    </div>
</div>  