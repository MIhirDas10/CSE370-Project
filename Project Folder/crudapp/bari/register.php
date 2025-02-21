<?php 
session_start();
include 'connect.php';
$session_id = $_SESSION['user_id'];

if(isset($_POST['signUp'])){
    $fullname=$_POST['fullname'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    //$password=md5($password);
    $contact=$_POST['contact'];
    $address=$_POST['address'];
    $gender=$_POST['gender'];
    $dor = date('Y-m-d');

     $checkEmail="SELECT * From members where email='$email'";
     $result=$conn->query($checkEmail);
     if($result->num_rows>0){
        echo "Email Address Already Exists !";
     }
     else{
        $insertQuery="INSERT INTO members(fullname,username,email,password,contact,address,gender,dor)
                       VALUES ('$fullname','$username','$email','$password','$contact','$address','$gender','$dor')";
            if($conn->query($insertQuery)==TRUE){
                header("location: index.php");
            
            }
            else{
                echo "Error:".$conn->error;
            }
        
     }
    $last_inserted_staff_id = mysqli_insert_id($conn);
    $insertQuery="INSERT INTO member_attendance(member_id)
              VALUES('$last_inserted_staff_id')";
              $conn->query($insertQuery);
    $insertQuery="INSERT INTO memberroutine(Mem_ID)
              VALUES('$last_inserted_staff_id')";
              $conn->query($insertQuery);
    }

//$_SESSION['email']=$email;
if(isset($_POST['signIn'])){
//    $session_id = $_SESSION['user_id'];
   $email=$_POST['email'];
   $password=$_POST['password'];
   //$password=md5($password) ;
//    $insertQuery="INSERT INTO member_attendance(member_id)
        // VALUES('$session_id')";
    //  $conn->query($insertQuery);
   $sql="SELECT * FROM members WHERE email='$email' and password='$password'";
   $result=$conn->query($sql);
   if($result->num_rows>0){
    session_start();
    $row=$result->fetch_assoc();
    $_SESSION['email']=$row['email'];
    $_SESSION['user_id']=$row['member_id'];
    header("Location: a1.php");
    exit();
   }
   else{
    echo "Not Found, Incorrect Email or Password";
   }

}
?>