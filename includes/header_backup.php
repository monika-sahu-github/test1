<?php 
  include("conn.php");
  include("./lib/getval.php");
  $cmn = new TestCommandRun();

  include("query/selectData.php");
$examne_id =  $_SESSION['examineeSession']['exmne_id'];
  //////////////////////////REMOVE INCOMPEXAM///////////////
$conn->query("DELETE FROM exam_answers WHERE axmne_id='$examne_id' AND is_finel_sub=0");
$conn->query("DELETE FROM exam_que_for_match_tbl WHERE examinee_id='$examne_id' AND is_finel_sub=0");
$payment_status = 0;
 ?>
 <?php
// PHP program to convert timestamp
// to time ago
  
function to_time_ago( $time ) {
      
    // Calculate difference between current
    // time and given timestamp in seconds
    $diff = time() - $time;
      
    if( $diff < 1 ) { 
        return 'few sec ago'; 
    }
      
    $time_rules = array ( 
                12 * 30 * 24 * 60 * 60 => 'y',
                30 * 24 * 60 * 60       => 'mo',
                24 * 60 * 60           => 'd',
                60 * 60                   => 'h',
                60                       => 'm',
                1                       => 's'
    );
  
    foreach( $time_rules as $secs => $str ) {
          
        $div = $diff / $secs;
  
        if( $div >= 1 ) {
              
            $t = round( $div );
              
            return $t . ' ' . $str . 
                ( $t > 1 ? '' : '' ) . '';
        }
    }
}
  
?>
<!doctypeHTML> 
 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text.php; charset=utf-8"/>
    <title>ACHIEVERS ONE
</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
  
  <link rel="stylesheet" href="/resources/demos/style.css">
 <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
 
    <!-- MAIN CSS NIYA -->
    <link href="./main.css" rel="stylesheet">
    <link href="css/sweetalert.css" rel="stylesheet">
    <style type="text/css"> 
        .anchr-tagcolor{
            color: #a6aaad;
            text-decoration: none;
        }
        .anchr-tagcolor:hover{
            color: white;
            text-decoration: none;
        }
        .spanclr{
           color: #a6aaad; 
        }
        .spanclr:hover{ 
            color: white;
        }
        .righarr{
            color: #a6aaad;
        }
    </style>
     <style type="text/css">
    .badge{
      font-size: 137% !important;
      margin-left: -4px;
    margin-top: -13px;
    padding: 1px 1px !important;
    }
    .dropdown-menu .dropdown-item{
        font-weight: 900;
    }

    @media only screen and (max-width: 600px) {
  #desk_notification{
    display: none;
  }
  #mobile_notification{
    margin-right: 10px;
  }
  .popover, .dropdown-menu{
    top: 23% !important;
  }
}
  </style>
  <style type="text/css">

/*custom font*/
@import url(https://fonts.googleapis.com/css?family=Merriweather+Sans);

* {margin: 0; padding: 0;}

html, body {min-height: 100%;}


.breadcrumb {
  /*centering*/
  display: inline-block;
  box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.35);
  overflow: hidden;
  border-radius: 5px;
  background-color: #ffffff;
  /*Lets add the numbers for each link using CSS counters. flag is the name of the counter. to be defined using counter-reset in the parent element of the links*/
  counter-reset: flag; 
}

.breadcrumb a {
  text-decoration: none;
  outline: none;
  display: block;
  float: left;
  font-size: 12px;
  line-height: 36px;
  color: white;
  /*need more margin on the left of links to accomodate the numbers*/
  padding: 0 10px 0 60px;
  background: #666;
  /*background: linear-gradient(#666, #333);*/
  background: linear-gradient(#494676, #484776);
  position: relative;
}
/*since the first link does not have a triangle before it we can reduce the left padding to make it look consistent with other links*/
.breadcrumb a:first-child {
  padding-left: 46px;
  border-radius: 5px 0 0 5px; /*to match with the parent's radius*/
}
.breadcrumb a:first-child:before {
  left: 14px;
}
.breadcrumb a:last-child {
  border-radius: 0 5px 5px 0; /*this was to prevent glitches on hover*/
  padding-right: 20px;
}

/*hover/active styles*/
.breadcrumb a.active, .breadcrumb a:hover{
  background: #333;
  /*background: linear-gradient(#333, #000);*/
  background: linear-gradient(#0b00ff, #0900df);
}
.breadcrumb a.active:after, .breadcrumb a:hover:after {
  /*background: #333;*/
  /*background: linear-gradient(135deg, #333, #000);*/
  background: linear-gradient(
135deg
, #0900e5, #0a00fc);
}

/*adding the arrows for the breadcrumbs using rotated pseudo elements*/
.breadcrumb a:after {
  content: '';
  position: absolute;
  top: 0; 
  right: -18px; /*half of square's length*/
  /*same dimension as the line-height of .breadcrumb a */
  width: 36px; 
  height: 36px;
  /*as you see the rotated square takes a larger height. which makes it tough to position it properly. So we are going to scale it down so that the diagonals become equal to the line-height of the link. We scale it to 70.7% because if square's: 
  length = 1; diagonal = (1^2 + 1^2)^0.5 = 1.414 (pythagoras theorem)
  if diagonal required = 1; length = 1/1.414 = 0.707*/
  transform: scale(0.707) rotate(45deg);
  /*we need to prevent the arrows from getting buried under the next link*/
  z-index: 1;
  /*background same as links but the gradient will be rotated to compensate with the transform applied*/
  background: #666;
  /*background: linear-gradient(135deg, #666, #333);*/
  background: linear-gradient(
135deg
, #666, #141158);
  /*stylish arrow design using box shadow*/
  box-shadow: 
    2px -2px 0 2px rgba(0, 0, 0, 0.4), 
    3px -3px 0 2px rgba(255, 255, 255, 0.1);
  /*
    5px - for rounded arrows and 
    50px - to prevent hover glitches on the border created using shadows*/
  border-radius: 0 5px 0 50px;
}
/*we dont need an arrow after the last link*/
.breadcrumb a:last-child:after {
  content: none;
}
/*we will use the :before element to show numbers*/
.breadcrumb a:before {
  content: counter(flag);
  counter-increment: flag;
  /*some styles now*/
  border-radius: 100%;
  width: 20px;
  height: 20px;
  line-height: 20px;
  margin: 8px 0;
  position: absolute;
  top: 0;
  left: 30px;
  background: #444;
  /*background: linear-gradient(#444, #222);*/
  background: linear-gradient(#444, #487ea5);
  font-weight: bold;
}
</style>
  <script type="text/javascript">
    function leavpage(){
window.onbeforeunload = function() {
return "You have some unsaved changesss"; 
     
};
    }
  </script>
</head>
<body id="body" onload="leavpage();">
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <a href="home.php" style="text-decoration: block;"><h5>ACHIEVERS ONE</h5>
                </a>
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
                                <div class="btn-group">
                                        <ul class="navbar-nav ml-auto">
                                              <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-bell" style="font-size: 30px;"></i>
         
             
          <span class="badge badge-warning navbar-badge">3</span> 
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="notification" >
          <span class="dropdown-item dropdown-header">Notifications</span>
          <a href="home.php?page=all_notifications" class="dropdown-item dropdown-footer"><b>See All Notifications</b></a>
        </div>
      </li>
    </ul>
                                    </div>
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>    <div class="app-header__content"> 
                <div class="app-header-left">
                  <?php if(!isset($_REQUEST["page"])){ ?>
                   <center><h3 id="well">WELCOME</h3></center>
                 <?php } ?>
                </div> 
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                             <div class="btn-group">
                                        <ul class="navbar-nav ml-auto">
                                              <li class="nav-item dropdown">
 
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="notification" >
          <span class="dropdown-item dropdown-header">Notifications</span>
          <div class="dropdown-divider"></div> 
          <?php
            if($payment_status == 0){
              echo "<div style='background-color:#fffff;'><span class='dropdown-item notifi'>Complete your payment to get more features.</span> </div>";
            }else{ echo "<div style='background-color:#30f91069;'><span class='dropdown-item notifi'>payment has done</span> </div>"; } ?>
                 <?php    
            $notif_date = $conn->query("SELECT * FROM notifications where id not in(select notification_id from read_status where user_id = '$examne_id') ORDER BY id DESC");
            $count = $total = 0; 
            while ($selNotifRow = $notif_date->fetch(PDO::FETCH_ASSOC)) {
              $date1 = date('d-m-Y',strtotime($selNotifRow['createdate']));
               $title = $selNotifRow['title']; 
              $id1 = $selNotifRow['id'];
           // $notif_date->execute();
            //$result = $notif_date->fetchAll();
               $sql1 = $conn->query("INSERT INTO read_status SET notification_id = 'id', user_id = '$examne_id' ");
                $sql1->execute(); 
                //if(count($result) > 0){ 
            
              $examinee = $conn->query("SELECT create_date FROM examinee_tbl where exmne_id = $examne_id");
              while($examineeRow = $examinee->fetch(PDO::FETCH_ASSOC)){
              $date2 = date('d-m-Y',strtotime($examineeRow['create_date']));
              if(strtotime($date1) >= strtotime($date2)){
                ++$count;
              $total = $count + 1; //echo $total;


      ?>
          <a style="
          <?php echo "font-weight: bold;"; ?>
          " href="view.php?id=<?php echo $selNotifRow['id'];?>" class="dropdown-item notifi"><?php echo $title," "; ?>
            <!-- <i class="fas fa-envelope mr-2"></i> --> 
            <span class="float-right text-muted text-sm">
            <?php echo " ",to_time_ago( strtotime($selNotifRow['createdate'])); }}} ?>
              </span>
          </a>
         <div class="dropdown-divider"></div>
          <a href="home.php?page=all_notifications" class="dropdown-item dropdown-footer"><b>See All Notifications</b></a>
        </div>
          <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-bell" style="font-size: 20px;"></i>
         <span class="badge badge-warning navbar-badge" style="font-size: 30px;">
           <?php if ($total != 0){ echo $total; }else { echo "1"; } ?></span> 
          
        </a>
      </li>
    </ul>
                                    </div>

                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <?php 
                                                echo strtoupper($selExmneeData['exmne_fullname']);
                                             ?>
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            
                                            <button type="button" tabindex="0" class="dropdown-item"><a href="home.php?page=myprofile">My Account</a></button>
                                            
                                             <button type="button" tabindex="0" class="dropdown-item"><a href="home.php?page=change_pass">Change Password</a></button>
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <a href="query/logoutExe.php" class="dropdown-item">LOG OUT</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>        </div>
            </div>
        </div> 
        <?php if(!isset($_REQUEST["page"])){ ?>
        <script type="text/javascript">
  setTimeout(function(){
   document.getElementById('well').style.display='none';
  }, 6000);
</script> <?php } ?>