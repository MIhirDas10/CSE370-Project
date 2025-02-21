<?php
    define("HOSTNAME", "localhost");
    define("USERNAME", "root");
    define("PASSWORD", "");
    define("DATABASE", "gym_system");

    $connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

    if(!$connection){
        die("Connection failed");
    }
?>



<?php

// include 'dbcon.php';
// session_start();
// $user_id = $_SESSION['user_id'];

if(isset($_POST['update_profile'])){

   $update_name = mysqli_real_escape_string($connection, $_POST['update_name']);
   $update_email = mysqli_real_escape_string($connection, $_POST['update_email']);
   $update_address = mysqli_real_escape_string($connection, $_POST['update_address']);   
   $update_pass = mysqli_real_escape_string($connection, $_POST['update_pass']); 
   $old_pass = mysqli_real_escape_string($connection, $_POST['old_pass']);
   $confirm_pass = mysqli_real_escape_string($connection, $_POST['confirm_pass']);



   if(!empty($update_pass) || !empty($confirm_pass)){
      if($update_pass != $old_pass){          
         $message[] = 'Password not matched!'; 
      }
     elseif($old_pass != $confirm_pass){
         $message[] = 'Confirm password not matched!';
      }else{
        mysqli_query($connection, "UPDATE `admin` SET fullname = '$update_name', email = '$update_email', address= '$update_address' WHERE admin_id = 1") or die('query failed');
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
         $image_update_query = mysqli_query($connection, "UPDATE `admin` SET image = '$update_image' WHERE admin_id = 1") or die('query failed');
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
   <!-- <?php $page="dashboard"; include 'includes/navbar.php'?> -->
           <h1 class="text" style="text-align:center; color:black;">Update Profile <i class="icon icon-user"></i></h1><br>
           <style>
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        h1.text{
            font-size: 2.5rem;
            margin-top: 20px;
            margin-bottom: 0px;
            color: #333;
            text-align: center;
        }

        .update-profile {
            max-width: 800px;
            height: 500px;
            margin: 0px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .update-profile img {
            display: block;
            margin: 0 auto 20px;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .update-profile .flex {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .update-profile .inputBox {
            flex: 1;
            min-width: 250px;
        }

        .update-profile .inputBox span {
            display: block;
            font-size: 1rem;
            margin-bottom: 5px;
            color: #555;
        }

        .update-profile .inputBox .box {
            width: 92%;
            padding: 10px;
            margin-bottom: 15px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
            transition: 0.3s ease;
        }

        .update-profile .inputBox .box:focus {
            border-color: #4CAF50;
        }

        .update-profile .btn,
        .update-profile .delete-btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 10px;
            font-size: 1rem;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .update-profile .btn {
            background-color: #4CAF50;
            color: #fff;
            margin-right: 8px;
        }

        .update-profile .btn:hover {
            background-color: #45a049;
        }

        .update-profile .delete-btn {
            background-color: #f44336;
            color: #fff;
        }

        .update-profile .delete-btn:hover {
            background-color: #d32f2f;
        }

        .message {
            text-align: center;
            margin-bottom: 15px;
            padding: 10px;
            color: #fff;
            background-color: #f44336;
            border-radius: 5px;
        }
    </style>
<div class="update-profile">

   <?php
      $select = mysqli_query($connection, "SELECT * FROM `admin` WHERE admin_id = 1") or die('query failed');
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
      <div class="button-holder" style="display: flex; margin-right: 5px">
         <input type="submit" value="Update" name="update_profile" class="btn">  
         <br>
         <a href="profile.php" class="delete-btn">Go back</a>
      </div>
   </form>

</div>

    
</body>
</html>