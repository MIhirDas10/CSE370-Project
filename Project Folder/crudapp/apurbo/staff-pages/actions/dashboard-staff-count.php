<?php



$conn=mysqli_connect("localhost","root","","gym_system");

if(!$conn){
    die("Connection Failed");
}

$sql = "SELECT * FROM staffs";
                $query = $conn->query($sql);

                echo "$query->num_rows";
?>