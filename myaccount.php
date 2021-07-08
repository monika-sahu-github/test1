<?php
include("conn.php");
session_start();

if(!isset($_SESSION['examineeSession']['examineenakalogin']) == true) header("location:index.php");
$examnee_id = $_SESSION['examineeSession']['exmne_id'];


if(isset($_POST['edit'])){
  $fname = $_POST['full_name'];
  $phone1 =$_POST['phone'];
  $state1 = $_POST['state'];
  extract($_POST);

    $data = [
      'exmne_state' => $state1,
      'exmne_phoneno' => $phone1,
    'exmne_fullname' => $fname,
    'exmne_id' => $examnee_id,
   ];
    $sql = "UPDATE examinee_tbl SET exmne_fullname=:exmne_fullname, exmne_phoneno=:exmne_phoneno, exmne_state=:exmne_state WHERE exmne_id=:exmne_id";
    $stmt= $conn->prepare($sql);
    $stmt->execute($data);
    echo "Successfully submitted";
}
?>
<?php  include("includes/header.php"); ?> 

<html><head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>ACHIEVERS ONE
</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
     
    <!-- MAIN CSS NIYA -->
    <link href="./main.css" rel="stylesheet">
    <link href="css/sweetalert.css" rel="stylesheet">
    <!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
<!-- Bootstrap CSS -->
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
<!-- Font Awesome CSS -->
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>

    <style type="text/css"> 
        .anchr-tagcolor{
            color: #a6aaad;
            text-decoration: none;
        }
        .anchr-tagcolor:hover{
            color: red;
            text-decoration: none;
        }
        .spanclr{
           color: #a6aaad; 
        }
        .spanclr:hover{ 
            color: red;
        }
        .righarr{
            color: #a6aaad;
        }
        body {
           
        }
        .student-profile .card {
            border-radius: 30px;
            background: #DCDCDC;
        }
        .student-profile .card .card-header  {
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin: 10px auto;
            border: 10px solid #ccc;
            border-radius: 50%;
        }
        .student-profile .card h3 {
            font-size: 20px;
            font-weight: 700;
        }
        .student-profile .card p {
            font-size: 16px;
            color: #000;
        }
        .student-profile .table th,
        .student-profile .table td {
            font-size: 14px;
            padding: 5px 10px;
            color: #000;
        }
        p{
           padding: 10px 100px 0 0; 
        }
        @media only screen and (max-width: 600px) {
table 
{
    table-layout:fixed;
    width:100%;
}
}
    </style>

</head>
 
<body>
  <div class="app-main">
 <?php  include("includes/sidebar.php"); ?> 
  <div class="container">
    <div class="container">
    <div class="col-sm-12">
      <div class="panel-heading"></div>
    </div>
    <div class="row">
      <div class="col-sm-4">
    
      </div>
      <?php $sql= "SELECT * FROM examinee_tbl WHERE exmne_id = $examnee_id";
            $result = $conn->prepare($sql);
            $result->execute();
            $rows = $result->fetchAll(PDO::FETCH_ASSOC);
            foreach($rows as $row){
                ?>
            
      <div class="col-lg-8">
        <div class="card shadow-sm">
          <div class="card-header bg-transparent border-0">
            <h3 class="mb-0"><i class="far fa-clone pr-1"></i>General Information</h3>
          </div>
          <div class="card-body pt-0">
            <form name="editprofile" action="myaccount.php" method="post">
 
            <table class="table table-bordered">
                <tr>
                <th width="30%">Examinee Id</th>
                 
                <td><?php  printf("{$row['exmne_id']} "); ?></td>
              </tr>
                 <tr>
                <th width="30%">Name</th>
                 
                <td><input type="text" name="full_name" value="<?php  printf("{$row['exmne_fullname']} "); ?>" /></td>
              </tr>
              <tr>
                <th width="30%">Date Of Birth</th>
                 
                <td><?php  printf("{$row['exmne_birthdate']} "); ?></td>
              </tr>
              <tr>
                <th width="30%">State</th>
                 
                <td><input type="text" name="state" value="<?php echo  $row['exmne_state']; ?>"/></td>
              </tr>
              <tr>
                <th width="30%">Email Address   </th>
                 
                <td><?php  printf("{$row['exmne_email']} "); ?></td>
              </tr>
              <tr>
                <th width="30%">Gender</th>
                 
                <td><?php echo  $row['exmne_gender']; ?></td>
              </tr>
              <tr>
                <th width="30%">Phone Number</th>
                 
                <td><input type="text" name="phone" value="<?php echo  $row["exmne_phoneno"]; ?>" /></td>
              </tr>
              <tr>
                <th width="30%">Status</th>
                 
                <td><?php echo  $row["exmne_status"];
                    } ?></td>
              </tr>
            </table>
            <div class="text-center">
            <input type="submit" name="edit" value="Update" class="btn btn-success"/>
          </div>
          </form>
          </div>
        </div>
          <div style="height: 26px"></div>
        
      </div>
    </div>
  </div>
</div>

</body><p>
 <?php include("includes/header.php");  ?>
<?php //include("includes/footer.php"); ?>
<script type="text/javascript" src="./assets/scripts/main.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/myjs.js"></script>

<script type="text/javascript" src="js/sweetalert.js"></script>
</p></html>
 
<?php include("includes/modals.php"); ?>


