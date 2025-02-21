<?php

$servername="localhost";
$uname="root";
$pass="";
$db="gym_system";

$conn=mysqli_connect($servername,$uname,$pass,$db);

if(!$conn){
    die("Connection Failed");
}

$sql = "SELECT SUM( (curr_weight - ini_weight) / ini_weight * 100) FROM progress WHERE progress_id='$id'";
        $amountsum = mysqli_query($conn, $sql) or die(mysqli_error($sql));
        $row_amountsum = mysqli_fetch_assoc($amountsum);
        $totalRows_amountsum = mysqli_num_rows($amountsum);
        echo abs((int)$row_amountsum['SUM( (curr_weight - ini_weight) / ini_weight * 100)']);

                
?>