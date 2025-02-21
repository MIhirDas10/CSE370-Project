<?php
include 'dbcon.php';

if (isset($_POST['add_routine'])) {
    // Collect form data
    $Sta_ID = $_POST['Sta_ID'];
    $TS_8_10 = $_POST['TS_8_10'];
    $TS_10_12 = $_POST['TS_10_12'];
    $TS_12_2 = $_POST['TS_12_2'];
    $TS_2_4 = $_POST['TS_2_4'];
    $TS_4_6 = $_POST['TS_4_6'];

    // Validate required fields
    if (empty($Sta_ID)) {
        header('location:index.php?message=Staff ID is required');
        exit();
    }
    // Check if the staff ID exists in the staffs table
    $query = "SELECT staff_id FROM `staffs` WHERE staff_id = '$Sta_ID'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 0) { // No matching staff ID found
        header('location:index.php?message=Staff ID is invalid!');
        exit();
    }

    // Insert query
    $query = "INSERT INTO `staffRoutine` (`Sta_ID`, `TS_8_10`, `TS_10_12`, `TS_12_2`, `TS_2_4`, `TS_4_6`) 
              VALUES ('$Sta_ID', '$TS_8_10', '$TS_10_12', '$TS_12_2', '$TS_2_4', '$TS_4_6')";

    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    } else {
        header('location:index.php?insert_msg=Your data has been added successfully');
        exit();
    }
}

?>
