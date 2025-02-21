<?php 
session_start(); 
include "db_conn.php";

if (isset($_POST['username']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$username = validate($_POST['username']);
	$password = validate($_POST['password']);

	if (empty($username)) {
		header("Location: index1.php?error=User Name is required");
	    exit();
	}else if(empty($password)){
        header("Location: index1.php?error=Password is required");
	    exit();
	}else{
		$sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['username'] === $username && $row['password'] === $password) {
            	$_SESSION['username'] = $row['username'];
            	$_SESSION['fullname'] = $row['fullname'];
            	$_SESSION['admin_id'] = $row['admin_id'];
            	header("Location: navbar.php");
		        exit();
            }else{
				header("Location: index1.php?error=Incorect User name or password");
		        exit();
			}
		}else{
			header("Location: index1.php?error=Incorect User name or password");
	        exit();
		}
	}
	
}else{
	header("Location: index1.php");
	exit();
}