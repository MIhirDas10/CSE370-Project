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
<h1 class="text" style="margin-left:700px; color:black; margin-top:40px;">Gym Equipments List <i class="icon icon-cogs"></i></h1>
        <br><br><br>
        <div class="scrollable-table">
        <?php

      include "dbcon.php";
      $qry="SELECT * FROM equipment";
      $cnt = 1;
        $result=mysqli_query($con,$qry);

        
          echo"<table class='table table-bordered table-striped'>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Equipment</th>
                  <th>Description</th>
                  <th>Qty</th>
                  <th>Amount</th>
                  <th>Vendor</th>                  
                  <th>Contact</th>
                  <th>Purchased Date</th>
                  
                </tr>
              </thead>";
              
            while($row=mysqli_fetch_array($result)){
            
            echo"<tbody> 
               
                <td><div class='text-center'>".$cnt."</div></td>
                <td><div class='text-center'>".$row['name']."</div></td>
                <td><div class='text-center'>".$row['description']."</div></td>
                <td><div class='text-center'>".$row['quantity']."</div></td>
                <td><div class='text-center'>$".$row['amount']."</div></td>
                <td><div class='text-center'>".$row['vendor']."</div></td>
                
                <td><div class='text-center'>".$row['contact']."</div></td>
                <td><div class='text-center'>".$row['date']."</div></td>
                
                
              </tbody>";
         $cnt++;   }
            ?>

            </table>
        
        
        </div>
        
        
        
</body>
    
    
</html>