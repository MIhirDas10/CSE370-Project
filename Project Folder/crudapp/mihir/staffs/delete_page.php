<?php include('dbcon.php'); ?>

<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    
    $query = "DELETE FROM `staff_attendance` WHERE `staff_id` = $id";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die("Query failed".mysqli_error($connection));
    }

    $query = "DELETE FROM `staffRoutine` WHERE `Sta_ID` = $id";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die("Query failed".mysqli_error($connection));
    }

    $query = "DELETE FROM `staffs` WHERE `staff_id` = $id";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die("Query failed".mysqli_error($connection));
    }
    else{
        header('location:index.php?delete_msg=You have deleted the record.');
    }
?>