<?php

$servername="localhost";
$uname="root";
$pass="";
$db="gym_system";

$conn=mysqli_connect($servername,$uname,$pass,$db);

if(!$conn){
    die("Connection Failed");
}

$sql = "select * from members join subscription on members.member_id = subscription.sub_id where subscription.status='Active'";
                $query = $conn->query($sql);

                echo "$query->num_rows";
?>