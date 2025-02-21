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
<h1 class="text" style="text-align:center; color:black; margin-top:40px;">My Profile <i class="icon icon-user"></i></h1>
        
        <div class="container">


   <div class="wrapper">
       
    
      <?php
         $select = mysqli_query($con, "SELECT * FROM `staffs` WHERE staff_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img height=110 width=120 src="uploaded_img/'.$fetch['image'].'">';
         }
      ?>
       
      <ul>
          <li><?php echo 'Name : '. $fetch['fullname']; ?></li>           
          <hr>          
          <li><?php echo 'ID : '. $fetch['staff_id']; ?></li>  
          
          <hr>
          <li><?php echo 'Email : '. $fetch['email']; ?></li>
          <hr>
          <li><?php echo 'Address : '. $fetch['address']; ?></li>
          <hr>
          <li><?php echo 'Designation : '. $fetch['designation']; ?></li>
          <hr>
          <li><?php echo 'Gender : '. $fetch['gender']; ?></li>
          <hr>
          <li><?php echo 'Contact : '. $fetch['contact']; ?></li>
          <hr>
       </ul>       
       <br>
      <a href="update_profile.php" class="btn">Edit</a>
            </div>  

</div>
        
</body>
    
    
</html>

