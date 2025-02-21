<?php

include 'dbcon.php';
session_start();
$user_id = $_SESSION['user_id'];

if(isset($_POST['update_profile'])){

   $update_name = mysqli_real_escape_string($con, $_POST['update_name']);
   $update_email = mysqli_real_escape_string($con, $_POST['update_email']);
   $update_address = mysqli_real_escape_string($con, $_POST['update_address']);   
   $update_pass = mysqli_real_escape_string($con, $_POST['update_pass']); 
   $old_pass = mysqli_real_escape_string($con, $_POST['old_pass']);
   $confirm_pass = mysqli_real_escape_string($con, $_POST['confirm_pass']);



   if(!empty($update_pass) || !empty($confirm_pass)){
      if($update_pass != $old_pass){          
         $message[] = 'Password not matched!'; 
      }
     elseif($old_pass != $confirm_pass){
         $message[] = 'Confirm password not matched!';
      }else{
        mysqli_query($con, "UPDATE `staffs` SET fullname = '$update_name', email = '$update_email', address= '$update_address' WHERE staff_id = '$user_id'") or die('query failed');
         $message[] = 'Updated successfully!';
      }
   }

    
   $update_image = $_FILES['update_image']['name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'uploaded_img/'.$update_image;

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'Image is too large!';
      }else{
         $image_update_query = mysqli_query($con, "UPDATE `staffs` SET image = '$update_image' WHERE staff_id = '$user_id'") or die('query failed');
         if($image_update_query){
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
         }
         
      }
   }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
 
   <link rel="stylesheet" href="css/profile-style.css?v=<?php echo time(); ?>">
<title>Gym System Staff A/C</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">




<link rel="stylesheet" href="../css/matrix-style.css" />
    
 <link rel="stylesheet"  href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"/>

<link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="../css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    
</head>
<body>
   <?php $page="dashboard"; include 'includes/navbar.php'?>
           <h1 class="text" style="text-align:center; color:black; margin-top:40px;">Update Profile <i class="icon icon-user"></i></h1><br>

<div class="update-profile">

   <?php
      $select = mysqli_query($con, "SELECT * FROM `staffs` WHERE staff_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>

   <form action="" method="post" enctype="multipart/form-data">
       
      <?php
         if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['image'].'">';
         }
         if(isset($message)){
            foreach($message as $message){
               echo '<div class="message">'.$message.'</div>';
            }
         }
      ?>
       <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
      
      <div class="flex">
         <div class="inputBox">
             
            <span>Full Name :</span>
            <input type="text" name="update_name" placeholder="<?php echo $fetch['fullname']; ?>" class="box">
            <span>Email :</span>
            <input type="email" name="update_email" placeholder="<?php echo $fetch['email']; ?>" class="box">
            <span>Profile Picture :</span>
            <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
         </div>
         <div class="inputBox">
            <input type="hidden" name="old_pass" value="<?php echo $fetch['password']; ?>">
            <span>Address :</span>
            <input type="text" name="update_address" placeholder="<?php echo $fetch['address']; ?>" class="box">
            <span>Password :</span>
            <input type="password" name="update_pass" placeholder="enter password" class="box" required>
            <span>Confirm Password :</span>
            <input type="password" name="confirm_pass" placeholder="confirm password" class="box" required>
            

         </div>
      </div>
      <input type="submit" value="Update" name="update_profile" class="btn">  
       <br>
      <a href="profile.php" class="delete-btn">Go back</a>
   </form>

</div>

    
</body>
</html>