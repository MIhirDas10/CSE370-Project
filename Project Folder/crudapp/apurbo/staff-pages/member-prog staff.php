<?php
include 'dbcon.php';
session_start();
$user_id = $_SESSION['user_id'];
//the isset function to check username is already loged in and stored on the session
if(!isset($_SESSION['user_id'])){
header('location:../index.php');	
}
?>

<html lang="en">
<head>
    
       <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym System Staff A/C</title>
    <script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">   
    
       <link rel="stylesheet" href="css/update1-progress.css?v=<?php echo time(); ?>">
   <link rel="stylesheet" href="../css/matrix-style.css" />

<link rel="stylesheet" href="../css/matrix-style.css" />
    
 <link rel="stylesheet"  href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"/>

<link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="../css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    
    </head>
    
    <body>
  
  <?php $page="dashboard"; include 'includes/navbar.php'?>      
        

        <div class='popup center'>
        <div class="icon1">
            <i class="fas fa-x"></i>           
            </div>
            <div class="title">
            Access Denied!
            </div>
            <div class="description">You are not authorized to view this page!</div>
            <div class="dismiss-btn">
            <button onclick="history.back()">Ok</button>
            </div>
        </div>
</body>




</html>