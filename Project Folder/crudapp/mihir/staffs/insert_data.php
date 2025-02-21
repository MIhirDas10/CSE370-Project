<?php
include 'dbcon.php';

if (isset($_POST['add_staffs'])) {
    // Collect form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $designation = $_POST['designation'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];

    // Validate required fields
    if(
        empty($username) || empty($password) || empty($email) || empty($fullname) ||
        empty($address) || empty($designation) || empty($gender) || empty($contact)) {
        header('location:index.php?message=You need to fill the form');
        exit();
    } 
    // // first name 
    // if ($first_name == "" || empty($first_name)) {
    //     header('location:index.php?message=You need to fill in the first name');
    //     exit(); // Ensure the script stops executing after the redirect
    // }

    // // last name
    // if ($last_name == "" || empty($last_name)) {
    //     header('location:index.php?message=You need to fill in the last name');
    //     exit();
    // }
    
    // // age
    // if ($age == "" || empty($age)) {
    //     header('location:index.php?message=You need to fill in the age');
    //     exit();
    // }
    // // email
    // if ($email == "" || empty($email)) {
    //     header('location:index.php?message=You need to fill in the email');
    //     exit();
    // }
    // // phone
    // if ($phone == "" || empty($phone)) {
    //     header('location:index.php?message=You need to fill in the phone');
    //     exit();
    // }
    // // first name 
    // if ($first_name == "" || empty($first_name)) {
    //     header('location:index.php?message=You need to fill in the first name');
    //     exit(); // Ensure the script stops executing after the redirect
    // }

    // // last name
    // if ($last_name == "" || empty($last_name)) {
    //     header('location:index.php?message=You need to fill in the last name');
    //     exit();
    // }
    
    // // age
    // if ($age == "" || empty($age)) {
    //     header('location:index.php?message=You need to fill in the age');
    //     exit();
    // }
    // // email
    // if ($email == "" || empty($email)) {
    //     header('location:index.php?message=You need to fill in the email');
    //     exit();
    // }
    // // phone
    // if ($phone == "" || empty($phone)) {
    //     header('location:index.php?message=You need to fill in the phone');
    //     exit();
    // }
    else{
        // Insert staff into the `staffs` table
        $query = "INSERT INTO `staffs` (`username`, `password`, `email`, `fullname`, `address`, `designation`, `gender`, `contact`) 
                  VALUES ('$username', '$password', '$email', '$fullname', '$address', '$designation', '$gender', '$contact')";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            die("Staff insertion failed: " . mysqli_error($connection));
        }

        // Get the last inserted staff_id
        $last_inserted_staff_id = mysqli_insert_id($connection);

        // insert the staff_id into the `staff_attendance` table
        $insertion_staff_id = "INSERT INTO `staff_attendance` (`staff_id`) VALUES ($last_inserted_staff_id)";
        $result = mysqli_query($connection, $insertion_staff_id);

        if (!$result) {
            die("Attendance insertion failed: " . mysqli_error($connection));
        } else {
            header('location:index.php?insert_msg=Your data has been added successfully');
            exit();
        }
    }
}
?>
