<?php
include 'dbcon.php';
session_start();
$user_id = $_SESSION['user_id'];
//the isset function to check username is already loged in and stored on the session
if(!isset($_SESSION['user_id'])){
header('location:../index.php');	
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<title>Gym System Staff A/C</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="css/profile-style.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="../css/matrix-style.css" />    
 <link rel="stylesheet"  href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"/>
<link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="../css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>


</head>
    <body> 
        
                <?php $page="dashboard"; include 'includes/navbar.php'?>
<h1 class="text" style="margin-left:700px; color:black; margin-top:40px;">Membership Status <i class="icon icon-eye-open"></i></h1>
        <br><br><br>
        <div class="scrollable-table">
        <?php

      include "dbcon.php";
      $qry="select * from members join subscription on members.member_id = subscription.sub_id";
      $cnt = 1;
        $result=mysqli_query($con,$qry);

        
          echo"<table class='table'>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Fullname</th>
                  <th>Contact Number</th>
                  <th>Choosen Service</th>
                  <th>Plan</th>
                  <th>Membership Status</th>
                </tr>
              </thead>";
              
            while($row=mysqli_fetch_array($result)){?>
            
           <tbody> 
               
                <td><div class='text-center'><?php echo $cnt;?></div></td>
                <td><div class='text-center'><?php echo $row['fullname'];?></div></td>
                <td><div class='text-center'><?php echo $row['contact'];?></div></td>
                <td><div class='text-center'><?php echo $row['services'];?></div></td>
                <td><div class='text-center'><?php echo $row['plan'];?> Month/s</div></td>
                <td><div class='text-center'><?php if( $row['status'] == 'Active' ){ echo '<i class="fas fa-circle" style="color:green;"></i> Active';} else if ($row['status'] == 'Expired') { echo '<i class="fas fa-circle" style="color:red;"></i> Expired';} else { echo '<i class="fas fa-circle" style="color:orange;"></i> Pending Reg';}?></div></td>
                
              </tbody>
          <?php
     $cnt++;      }
            ?>

            </table>
        
        
        </div>
        
        
        
</body>
    
    
</html>