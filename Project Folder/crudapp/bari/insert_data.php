<?php
include 'connect.php';
session_start();
$session_id = $_SESSION['user_id'];
if (!isset($_SESSION['user_id'])) {
    //Redirect to login page if not logged in
   header("Location: index.php");
   exit();
}

if (isset($_POST['add_routine'])) {
    // Collect form data
    $Sta_ID = $_POST['Mem_ID'];
    $TS_8_10 = $_POST['TS_8_10'];
    $TS_10_12 = $_POST['TS_10_12'];
    $TS_12_2 = $_POST['TS_12_2'];
    $TS_2_4 = $_POST['TS_2_4'];
    $TS_4_6 = $_POST['TS_4_6'];

    // Validate required fields
    if (empty($Sta_ID)) {
        header('location:index.php?message=member ID is required');
        exit();
    }
    // Check if the staff ID exists in the staffs table
    $query = "SELECT member_id FROM `members` WHERE member_id = '$Sta_ID'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) { // No matching staff ID found
        header('location:index.php?message=member ID is invalid!');
        exit();
    }

    // Insert query
    $query = "INSERT INTO `memberroutine` (`Mem_ID`, `TS_8_10`, `TS_10_12`, `TS_12_2`, `TS_2_4`, `TS_4_6`) 
              VALUES ('$Sta_ID', '$TS_8_10', '$TS_10_12', '$TS_12_2', '$TS_2_4', '$TS_4_6')";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    } else {
        header('location:index.php?insert_msg=Your data has been added successfully');
        exit();
    }
}

?>
