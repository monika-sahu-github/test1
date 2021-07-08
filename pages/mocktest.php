<?php
$examtype = 'Mock Test';
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
//$decryption2=openssl_decrypt ($encryption, $ciphering,  $key, $options, $iv); 
//echo "Decrypted String: " . $decryption;
// function $cmn->getvalfield($conn,$table,$field,$where)
// { //echo "SELECT $field FROM $table WHERE $where";
// $stmt = $conn->prepare("SELECT $field FROM $table WHERE $where"); 
// $stmt->execute(); 
// $row = $stmt->fetch();
// return $row[0]; 
// } 
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
                        <div>Mock Test
                        </div>
                    </div>
                     
                 </div>
            </div> 
            <div class="breadcrumb">   
                <input type="hidden" name="src1" value="<?php echo $_GET['source']; ?>">
                <?php $val1 = $_GET['source']; 
                if($val1 == 'menu'){?>
                <a href="#" class="anchr-tagcolor">Exam</a><a href="#" class="anchr-tagcolor">All Exams</a><a href="#" class="spanclr"><?php echo $examtype; ?></a></div>
            <br><br>
                <?php }else{?>
                <a href="home.php?page=dashboard" class="anchr-tagcolor">Dashboard</a><a href="#" class="spanclr"><?php echo $examtype; ?></a></div>
            <br><br><?php }?>
            <div class="" style="background: white;border: 3px solid #375176;">   
             <div class="row" style="padding: 20px;">
                <div class="col-md-6 col-xl-4"> 
                    <a href="home.php?page=mock-test&exam_type=on-demand&source=<?php echo $val1; ?>" id="practicetest">
                    <div class="card mb-3 widget-content bg-midnight-bloom">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">On Demand Test</div>
                               
                            </div> 
                        </div>
                    </div>
                    </a>
                </div>
                
    <div class="col-md-6 col-xl-4">
                    <a href="home.php?page=mock-test&exam_type=scheduled-test&source=<?php echo $val1; ?>" id="mocktest">
                    <div class="card mb-3 widget-content bg-midnight-bloom">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading">Scheduled Test</div>
                            </div>
                        </div>
                    </div>
                </a>
                </div> 
            </div>  
            </div>      
</div>
         
    </div>
