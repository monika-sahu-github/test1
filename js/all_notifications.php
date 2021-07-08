<?php $page_name = "All Notifications";?>
<style type="text/css">
    .w3-card{
        display: flex;
        flex-direction: row;
    }
    .w3-card, .w3-card-2 {
    box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
    }

    .w3-panel {
    margin-top: 16px;
    margin-bottom: 16px;
    }
    .w3-container, .w3-panel {
    padding: 0.01em 16px;
    }
    </style>
<div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div>ALL NOTIFICATIONS</div>
                    </div>
                </div>
            </div>        
             <div class="breadcrumb">  <a href="home.php?page=dashboard" class="anchr-tagcolor">Dashboard</a><a href="home.php?page=all_notifications" class="anchr-tagcolor"><?php echo $page_name; ?></a></div>
     <div class="row" style="background: white;border: 3px solid #375176;padding: 0px;">
            <div class="col-md-8">
                <div>
                    
                    
                         
                            
    
                <?php $verify = "SELECT verify_status from examinee_tbl WHERE exmne_id = $examnee_id";
                             $result = $conn->prepare($verify);
                             $result->execute();
                             $status = $result->fetch(PDO::FETCH_ASSOC);
                             foreach($status as $verify_status){
                if($verify_status == 0){
                echo "<div class='col-md-12' style='color:blue'><div class='w3-panel w3-card'><br>";
                echo "<span style='color:#444b54;'><br><b><center>Verify your email id go to: &nbsp;<a href='home.php?page=myprofile'> My Account</a></center></b><br></span>";
                echo "</div></div>";
                }else{  
                echo "<div class='col-md-12' style='color:blue'><div class='w3-panel w3-card'>";
                echo "<div style='background-color:#30f91069;'><span>your email verification has done</span></div>";
                echo "</div></div>"; } }
                  $payment_status = 0;
                if($payment_status == 0){
                echo "<div class='col-md-12' style='color:blue'><div class='w3-panel w3-card'><br>";
                echo "<span style='color:#444b54'><br><b><center>Complete your payment to get more features.</center></b><br></span>";
                echo "</div></div>";
                }else{  
                echo "<div class='col-md-12' style='color:blue'><div class='w3-panel w3-card'>";
                echo "<div style='background-color:#30f91069;'><span>payment has done</span></div>";
                echo "</div></div>"; }
                //   $verification_status = 0;
                // if($verification_status == 0){
                // echo "<div class='col-md-12' style='color:blue'><div class='w3-panel w3-card'><br>";
                // echo "<h6><span><br><b><center>Please verify your email id</center></b><br></span></h6><p>Go to My Account</p>";
                // echo "</div></div>";
                // }else{  
                // echo "<div class='col-md-12' style='color:blue'><div class='w3-panel w3-card'>";
                // echo "<div style='background-color:#30f91069;'><span>verification has done</span></div>";
                // echo "</div></div>"; }
  $from_date = date('Y-m-d', strtotime('-30 days'));
 $to_date = date('Y-m-d');              
$notif_date = $conn->query("SELECT * FROM notifications  WHERE DATE(createdate) BETWEEN '$from_date' AND  '$to_date' ORDER BY createdate DESC");
while ($selNotifRow = $notif_date->fetch(PDO::FETCH_ASSOC)) {
$date1 = date('d-m-Y',strtotime($selNotifRow['createdate']));
//echo $date1,"<br><br>";
$id1 = $selNotifRow['id'];
$examinee = $conn->query("SELECT create_date FROM examinee_tbl where exmne_id = $examne_id");
while($examineeRow = $examinee->fetch(PDO::FETCH_ASSOC)){
$date2 = date('d-m-Y',strtotime($examineeRow['create_date']));
//echo $date2,"<br><br>";
if(strtotime($date1) >= strtotime($date2)){
    //echo $selNotifRow['title'];
    //echo $date1;
    $sql = $conn->query("SELECT * FROM read_status Where notification_id = '$id1' AND user_id = '$examne_id' ");
                                    $sql->execute();
                                    $result = $sql->fetchAll();
                                    if(count($result)>0){
     echo "<div class='col-md-12'><div class='w3-panel w3-card'>";
     ?>
     <a href="view.php?id=<?php
                         echo $selNotifRow['id'];?>">
                <?php   echo "<br><span><center>",$selNotifRow['title'],"<br><br></center>";?> </a>
                    <?php echo "<p style='color: #7b7272;'><br>";?><?php echo "&nbsp;",to_time_ago( strtotime($selNotifRow['createdate'])),"</p></span></div></div>";?>
                     <?php     
                                    }else{ 
                                        echo "<div class='col-md-12' style='color:blue'><div class='w3-panel w3-card'>"; ?>                                
                                         <a href="view.php?id=<?php
                         echo $selNotifRow['id'];?>">
                <?php   echo "<br><span><b><center>",$selNotifRow['title'],"</b><br></center>";?> </a>
                <?php echo "<p style='color: #060505;'><br>";?><?php echo "&nbsp;",to_time_ago( strtotime($selNotifRow['createdate']))," &nbsp;<b><i> |  unread</i></b>","</p></span></div></div>"; }?>
                                        <!-- </div> -->

     <?php
}
} }

                    ?>

                          
                    </div>
                </div></div>
            </div>
      
        
</div>
 <script type="text/javascript">
    // $(function temp1(){ // trigger when document's ready

    //   // hide the pragraph initially
    //   $('p').hide();

    //   // add a click event to the header so we can hide/show the paragraph
    //   $('h6').click(function temp1(e){
    //     // $(this) is the header, next finds the next paragraph sibling (they're both
    //     // withint he div, so the header and div are known as siblings) then toggle
    //     // toggles if this found paragraph should be shown or hidden
    //     $(this).next('p').toggle();
    //   });
    // });
  </script>
         