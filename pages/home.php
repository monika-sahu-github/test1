<?php
$encryption = openssl_encrypt($simple_string, $ciphering, 
$key, $options, $iv); 
$simple_string2 = "1"; 
$ciphering = "AES-128-CTR";
$decryption_key = "OnLineTest";
$iv_length = openssl_cipher_iv_length($ciphering); 
$options = 0; 
$encryption2 = openssl_encrypt($simple_string2, $ciphering, 
$key, $options, $iv); 
$tot_practice = $cmn->getvalfield($conn,"exam_tbl","count(*)","type=0");
$tot_moc = $cmn->getvalfield($conn,"exam_tbl","count(*)","type=1");
?>
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
                        <div>Online Test
                        </div>
                    </div>
                     
                 </div>
            </div>  
                <div class="" style="background: white;border: 3px solid #375176;padding: 0px;">
                    <div class="col-md-12 mb-3"></div>
                      <div class="row">
                        <div class="col-md-2 mb-3"></div>
                <div class="col-md-6 col-xl-4"> 
                    <a href="home.php?page=examination_test_type&source=menu&exam_type=<?php echo $encryption; ?>" id="practicetest">
                    <div class="card mb-3 widget-content bg-midnight-bloom">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">Practice Test</div>
                                <!-- <div class="widget-subheading" style="">Total Subjects</div> -->
                            </div> 
                           <!-- <div class="widget-content-right">
                                <div class="widget-numbers text-white"><span><?php echo $tot_practice; ?></span></div>
                            </div> -->
                        </div>
                    </div>
                    </a>
                </div>
                
    <div class="col-md-6 col-xl-4">
                    <a href="home.php?page=mock" id="mocktest">
                    <div class="card mb-3 widget-content bg-arielle-smile">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">Mock Test</div>
                            </div>
                        </div>
                    </div>
                </a>
                </div> 
            </div></div>
      
        
        </div>
         
    </div>
