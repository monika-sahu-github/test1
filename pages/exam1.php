<?php 
$decryption=openssl_decrypt ($_REQUEST['exam_type'], $ciphering,  
$key, $options, $iv);  
$type = $decryption;
$examtype = '';
if($type==0){
    $examtype = "Practice Test";
} else if($type==1){
   $examtype = "Mock Test"; 
}
?>
<style type="text/css">
    .widget-heading{
        font-size: 25px;
    }
    h2{
        color: white;
        text-align: center;
    }
    .anchroid{
        text-decoration: none;
    }
    .exam_headdiv{
        <?php if($type==0){ ?>
        background: linear-gradient(-20deg, #2b5876 0%, #4e4376 100%) !important;
    <?php } else { ?>
        background-image: radial-gradient(circle 248px at center, #16d9e3 0%, #30c7ec 47%, #46aef7 100%) !important;
    <?php  } ?>
    }
</style>
<div class="app-main__outer">
 <div id="refreshData">
    <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-university">
                            </i>
                        </div>
                        <div>Subjects
                            <!-- <div class="page-title-subheading">This is an example dashboard created using build-in elements and components.
                            </div> -->
                        </div>
                    </div>
                     
                 </div>
            </div>       <a href="home.php" class="anchr-tagcolor">Dashboard</a><span class="righarr">-></span><span class="spanclr"><?php echo $examtype; ?></span><br><br>          <div class="row" style="padding: 20px;">

<div class="col-sm-12">
     <!-- <h2>Practice Test</h2><br><br>  -->
</div>       <?php
        
// Select and tanang exam depende sa course nga ni login 
$selExam = $conn->query("SELECT * FROM exam_tbl WHERE type='$type' ORDER BY ex_id DESC ");

                       if($selExam->rowCount() > 0)
                        {      //echo "??".$selExam->rowCount();
                            while ($selExamRow = $selExam->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="col-md-6 col-xl-4">
                    <a href="home.php?page=get_subject_quehead&exam_type=<?php echo $_REQUEST['exam_type']; ?>&question_head_id=<?php echo openssl_encrypt($selExamRow['ex_id'], $ciphering, 
$key, $options, $iv); ?>" style="text-decoration: none;" class="anchroid">
                    <div class="card mb-3 widget-content exam_headdiv" style="">

                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading"><?php echo $selExamRow['ex_title']; ?></div>
                               <center>
                                   <i class="fa fa-<?php echo $selExamRow['exam_logo']; ?>" aria-hidden="true" style="font-size: 70px"></i>
                               </center>
                            </div>
                           
                        </div>
                    </div>
                    </a>
                </div><?php 
            }
                 }
                 ?>
               <!--  <div class="col-md-6 col-xl-4">
                    <a href="#" id="" class="anchroid">
                    <div class="card mb-3 widget-content" style="background: #89939a;">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">Goegraphy</div>
                               <center>
                                   <i class="fa fa-globe" aria-hidden="true" style="font-size: 70px"></i>
                               </center>
                            </div>
                           
                        </div>
                    </div>
                    </a>
                </div> -->
               <!--  <div class="col-md-6 col-xl-4">
                    <a href="#" id="practicetest" class="anchroid">
                    <div class="card mb-3 widget-content" style="background: #89939a;">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">General Study</div>
                               <center>
                                   <i class="fa fa-edit" aria-hidden="true" style="font-size: 70px"></i>
                               </center>
                            </div>
                           
                        </div>
                    </div>
                    </a>
                </div> -->
                
               
                <!-- <div class="col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-grow-early">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">Total Examinee</div>
                                <div class="widget-subheading" style="color:transparent;">.</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white"><span>46%</span></div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
                    <div class="card mb-3 widget-content bg-premium-dark">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">Products Sold</div>
                                <div class="widget-subheading">Revenue streams</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-warning"><span>$14M</span></div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
      
        
        </div>
         
    </div>
