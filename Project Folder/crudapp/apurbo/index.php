<?php session_start();
include('dbcon.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
        <title>Gym System Staff</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="css/login-style.css?v=<?php echo time(); ?>"/>
        
		

    </head>
    
    <body style= "background-image:url('img/background.jpg')">    
        
<br><br><br><br><br>
     
            
        <div class="loginbox">            
            <form name="form" method="POST" action="#">
            <div class="login-header">
            <header>Staff Login</header>
            </div>
                <div class="input-box">
                    <input type="text" class="input-field" name="user" placeholder="Username" required>                     
                </div>
                <div class="input-box">
                    <input type="password" class="input-field" name="pass" placeholder="Password" required>                     
                </div>
                <div class="input-submit">
                    <button class="submit-btn" name="login">Login</button>        
                </div> 

            </form>
            </div>
            
            <?php 
                if (isset($_POST['login']))
                    {
                        $username = mysqli_real_escape_string($con, $_POST['user']);
                        $password = mysqli_real_escape_string($con, $_POST['pass']);                    
                        
                        $query 		= mysqli_query($con, "SELECT * FROM staffs WHERE password='$password' and username='$username'");
                        $row		= mysqli_fetch_array($query);
                        $num_row 	= mysqli_num_rows($query);
                        
                        if ($num_row > 0) 
                            {			
                                $_SESSION['user_id']=$row['staff_id'];
                                header('location:staff-pages/index.php');
                                
                            }
                            
                        else
                            {
                                echo "<div class='alert alert-danger alert-dismissible' role='alert'>
                                Invalid Username and Password!
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                                </div>";
                            }
                    }
            ?>

       
        
        <script src="js/jquery.min.js"></script>  
        <script src="js/matrix.login.js"></script> 
        <script src="js/bootstrap.min.js"></script> 
        <script src="js/matrix.js"></script>
        

    </body>

</html>
