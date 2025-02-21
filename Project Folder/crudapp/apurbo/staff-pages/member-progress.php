<?php
include 'dbcon.php';
session_start();
$user_id = $_SESSION['user_id'];
//the isset function to check username is already loged in and stored on the session
if(!isset($_SESSION['user_id'])){
header('location:../index.php');	
}

$sql="select * from staffs where staff_id='$user_id'";
$result=mysqli_query($con, $sql);
$row=mysqli_fetch_array($result);
if ($row['designation']=='Trainer')
{
    
    header('location:member-prog trainer.php');
}
else
{
    header('location:member-prog staff.php');
}
?>