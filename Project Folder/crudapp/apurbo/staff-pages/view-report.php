<?php
include 'dbcon.php';
session_start();
$user_id = $_SESSION['user_id'];
//the isset function to check username is already loged in and stored on the session
if(!isset($_SESSION['user_id'])){
header('location:../index.php');	
}
?>


<html>

<html>
<head>
    <html lang="en">
<head>

<title>Gym System Staff A/C</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="css/report1.css?v=<?php echo time(); ?>">


<link rel="stylesheet" href="../css/matrix-style.css" />
    
 <link rel="stylesheet"  href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"/>

<link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="../css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    
    
    
    
    
    </head>
    
        
        <body>
            
            <?php $page="dashboard"; include 'includes/navbar.php'?>
        <h1 class="text" style="margin-left:710px; color:black; margin-top:60px;">Member's Report <i class="icon icon-file"></i></h1>

<div class="container">
    <div class="wrapper">
                        <div class="info">
                  <ul>
                  <div class="text-bold">
                      <li>Apurbo's GYM Club</li>
                </div>
                      <li>5021  Wetzel Lane, Williamsburg</li>
                  
                      <li>Tel: 231-267-6011</li>
                 
                      <li>Email: support@gym.com</li>                    
                  </ul>
                </div>
      <?php
            include 'dbcon.php';
            $id=$_GET['id'];
            $qry= "select * from members join progress on members.member_id = progress.progress_id join subscription on progress.progress_id = subscription.sub_id where members.member_id='$id'";
            
            $result=mysqli_query($con,$qry);
            while($row=mysqli_fetch_array($result)){
            ?> 




                <table class="table">
                  <thead>
                    <tr>
                      <th class="head0">Membership ID</th>
                      <th class="head1 right">Initial Weight</th>
                      <th class="head0 right">Current Weight</th>
                      <th class="head1">Services Taken</th>
                      <th class="head0 right">Plans (Upto)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><div class="text-center">PGC-SS-<?php echo $row['member_id']; ?></div></td>
                      <td><div class="text-center"><?php echo $row['ini_weight']; ?> KG</div></td>
                      <td><div class="text-center"><?php echo $row['curr_weight']; ?> KG</div></td>
                      <td><div class="text-center"><?php echo $row['services']; ?></div></td>
                      <td><div class="text-center"><?php echo $row['plan']; ?> Month/s</div></td>
                    </tr>
                  </tbody>
                </table>
        </div><br><br>
                <table class="table1">
                  <tbody>
                    <tr>
                      <td class="msg-invoice" width="55%"> <div class="text-center"><h5><?php echo $row['fullname']; ?>'s Body Structure stated as from <?php echo $row['ini_bodytype']; ?> to <?php echo $row['curr_bodytype']; ?>. <br /> With Total Weight Differences of <?php include 'actions/weight-diff.php';?> KG <br /> As per records of <?php echo $row['progress_date']; ?></h5>
                        
                        </div>
                    </tr>
                  </tbody>
                </table>


                <br><br>
                <div class="wrap">
                    <div class="t">
                <h4>GYM Member: <?php echo $row['fullname']; ?> <br> Weight Variation of <em style="color:green"><?php include 'actions/progress-percent.php';?>%</em> as per current updates! <i class="fa fa-spinner fa-spin" style="font-size:24px"></i><br/> <br/>  <br/></h4><p>Thank you for choosing our services.<br/>- on the behalf of whole team</p></div>
<div class="t2">
                  <h4>Approved By:</h4>
                  <img src="../img/report/stamp-sample.png" width="124px;" alt=""><p class="text-center">Note:AutoGenerated</p> 
    </div>
    </div>
                          
    <button class="invoice-btn" onclick="history.back()">Go Back</button>
  
      <?php
}
      ?>
                 </div>

    
    <script src="../js/excanvas.min.js"></script> 
<script src="../js/jquery.min.js"></script> 
<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/jquery.flot.min.js"></script> 
<script src="../js/jquery.flot.resize.min.js"></script> 
<script src="../js/jquery.peity.min.js"></script> 
<script src="../js/fullcalendar.min.js"></script> 
<script src="../js/matrix.js"></script> 
<script src="../js/matrix.dashboard.js"></script> 
<script src="../js/jquery.gritter.min.js"></script> 
<script src="../js/matrix.interface.js"></script> 
<script src="../js/matrix.chat.js"></script> 
<script src="../js/jquery.validate.js"></script> 
<script src="../js/matrix.form_validation.js"></script> 
<script src="../js/jquery.wizard.js"></script> 
<script src="../js/jquery.uniform.js"></script> 
<script src="../js/select2.min.js"></script> 
<script src="../js/matrix.popover.js"></script> 
<script src="../js/jquery.dataTables.min.js"></script> 
<script src="../js/matrix.tables.js"></script> 
        </body>
    </html>