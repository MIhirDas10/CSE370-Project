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
<link rel="stylesheet" href="css/report.css?v=<?php echo time(); ?>">


<link rel="stylesheet" href="../css/matrix-style.css" />
    
 <link rel="stylesheet"  href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"/>

<link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="../css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    </head>
    
    <body>

        
        <?php $page="dashboard"; include 'includes/navbar.php'?>    

          
          
<h1 class="text" style="margin-left:670px; color:black; margin-top:40px;">Member's Progress Reports <i class="icon icon-file"></i></h1>


    <br><br><br>
    <div class="scrollable-table">
	  <?php

      include "dbcon.php";
      $qry="select * from members join subscription on members.member_id = subscription.sub_id join progress on progress.progress_id = members.member_id";
      $cnt=1;
        $result=mysqli_query($con,$qry);

        
          echo"<table class='table'>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Fullname</th>
                  <th>Choosen Service</th>
                  <th>Plan</th>
                  <th>Initial Weight</th>
                  <th>Current Weight</th>
                  <th>Progress Date</th>
                  <th>Action</th>
                </tr>
              </thead>"
              ;
              
            while($row=mysqli_fetch_array($result)){
            
            echo"<tbody> 
               
                <td><div class='text-center'>".$cnt."</div></td>
                <td><div class='text-center'>".$row['fullname']."</div></td>
                <td><div class='text-center'>".$row['services']."</div></td>
                <td><div class='text-center'>".$row['plan']." Month/s</div></td>
                <td><div class='text-center'>".$row['ini_weight']."</div></td>
                <td><div class='text-center'>".$row['curr_weight']."</div></td>
                <td><div class='text-center'>".$row['progress_date']."</div></td>
                <td><div class='text-center'><a href='view-report.php?id=".$row['member_id']."'><i class='icon icon-file'></i> View Report</a></div></td>
              </tbody>";
          $cnt++;  }
            ?>
   
        </table>
        </div>
        
<br>
        <a href='view-progress.php'><button class='btn2'>View Progress</button></a>
    </body>




</html>
