<?php

$servername="localhost";
$uname="root";
$pass="";
$db="gym_system";

$conn=mysqli_connect($servername,$uname,$pass,$db);

if(!$conn){
    die("Connection Failed");
}

$sql = "SELECT * FROM attendance";
                $query = $conn->query($sql);

                echo "$query->num_rows";
?>