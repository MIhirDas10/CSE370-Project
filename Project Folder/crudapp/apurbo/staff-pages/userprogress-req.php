<?php
session_start();

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
<link rel="stylesheet" href="css/update1-progress.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="../css/matrix-style.css" />    
 <link rel="stylesheet"  href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"/>
<link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="../css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    
        <script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">  
<body>


<?php $page="dashboard"; include 'includes/navbar.php'?>

<form role="form" action="index.php" method="POST">
    <?php 

            if(isset($_POST['ini_weight'])){ 
            $ini_weight = $_POST["ini_weight"];
            $curr_weight = $_POST["curr_weight"];
            $ini_bodytype = $_POST["ini_bodytype"];
            $curr_bodytype = $_POST["curr_bodytype"];
            $id=$_POST['id'];
            
            include 'dbcon.php';
            date_default_timezone_set('Asia/Dhaka');
            //$current_date = date('Y-m-d h:i:s');
                $current_date = date('Y-m-d h:i A');
              $exp_date_time = explode(' ', $current_date);
                $curr_date =  $exp_date_time['0'];
                $curr_time =  $exp_date_time['1']. ' ' .$exp_date_time['2'];
            //code after connection is successfull
            //update query
            $qry = "update progress set ini_weight='$ini_weight', curr_weight='$curr_weight', ini_bodytype='$ini_bodytype', curr_bodytype='$curr_bodytype', progress_date='$curr_date' where progress_id='$id'";
            $result = mysqli_query($con,$qry); 
            }                     
    ?>            
             </form>


        <div class='popup center'>
        <div class="icon">
            <i class="fas fa-check"></i>           
            </div>
            <div class="title">
            Success!
            </div>
            <div class="description">The requested member's progress has been updated succesfully!</div>
             
            <div class="dismiss-btn">
            
            <button onclick="history.back()">Ok</button>
            </div>
        </div>


</body>
</html>
