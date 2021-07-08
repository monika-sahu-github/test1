<style type="text/css">
    .w3-card{
        display: flex;
        flex-direction: row;
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
            
            <div class="col-md-8">
                <div class="main-card mb-3 card">
                    
                    
                         
                            
    
                                <?php 
                                $selExam = $conn->query("SELECT * FROM notifications ORDER BY id DESC ");
                                if($selExam->rowCount() > 0)
                                {
                                    while ($selExamRow = $selExam->fetch(PDO::FETCH_ASSOC)) {
                                        if($selExamRow > 0){


                                     ?>
                                        
                                            
                                                <div class="col-md-12">
                                                   
                                            <a href="view.php?id=<?php
                         echo $selExamRow['id'];?>">
                <?php 
                echo " <div class='w3-panel w3-card'><p>",$selExamRow['title'],"&nbsp;"; 
                echo to_time_ago( strtotime($selExamRow['createdate'])),"</p></div>";?></a>
                                            
                                           
             <?php 
                
                                            //echo time_elapsed_string($selExamRow['createdate']);
                                            //echo $selExamRow['createdate']; ?>
                                            </div>
                                          
                                      

                                    <?php } }
                                }
                                else
                                { ?>
                                    <div class="col-md-12">
                                        <h3 class="p-3">No New Notifications Found</h3>
                                     </div>
                                <?php }
                               ?>
                          
                    </div>
                </div>
            </div>
      
        
</div>
         