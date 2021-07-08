<?php if(isset($_REQUEST["queheadid"])){ 
$queheadid = $_REQUEST["queheadid"];
} ?>
<script src="ckeditor/ckeditor.js"></script>
    <script src="ckeditor/samples/js/sample.js"></script>
    <style>
    .box{
        float:right;
        /*overflow: hidden;*/
         
    } 
    /* Add padding and border to inner content
    for better animation effect */
    .box-inner{
        width: 400px;
        padding: 10px;
        /*border: 1px solid #fcc7a4;*/
    }
</style>

<style type="text/css">
    .widget-heading{
        font-size: 25px;
    }
    h2{
        color: white;
    background: #375176;
    text-align: center;
    border-radius: 3px;
    padding: 8px;
    }
</style>
<style type="text/css">
#leavnow{
  border: 1px solid #bdc0c1;
    color: black !important;
    padding: -6px;
    width: 134px;
    text-align: center;
    background: #e0e3ec;
    float: right;
    font-weight: 900;
}
@media only screen and (max-width: 600px) {
  .stbtn {
    margin-top: 10px;
  }
  .btn-div{
    padding: 20px;
  }
  #leavnow{
  margin-left: 0px;
  margin-top: 23px;
}
}
input[type="radio"]{
  width: 37px;
    height: 19px;
}
.sug{
  padding-right: 1px !important;
    padding-left: 1px !important;
}
#next_que{
  background-color: #d92550 !important;
  border: 1px solid #d92550 !important;
}
#next_que:hover{
  background-color: #e26584 !important;
  border: 1px solid #e26584 !important;
} 
#skip{
  padding-left: 7px;
}
    </style>
<div class="app-main__outer">
 <div id="refreshData">
    <div class="app-main__inner">
    
    <div class="row" style="background: white;border: 3px solid #375176;padding: 0px;">
<input type="hidden" name="cntquee" id="cntquee" value="ll" >
<div class="col-sm-12">
</div> 

 <div class="col-md-12 col-xl-12" style="padding-top: 15px;padding-bottom: 20px;">
<br><br>
              <div class="row" id="queandflagdiv" >
                     <div class="col-sm-1" style="text-align: right;">  </div>
                      <div class="col-sm-8" style="margin-top: -15px;">

                         
                         <div  id="showquestion"><a href="home.php?page=result_date&id=<?php echo $queheadid; ?>" style="margin-left: 100px;" class="btn btn-info" >Go To Result</a></div> 

                      </div>
                      
              </div>
 
              
          
                </div>
               

            </div>
      <br>
        
        </div>
         
    </div>
<script src="jquery.min.js" type="text/javascript"></script>



<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->