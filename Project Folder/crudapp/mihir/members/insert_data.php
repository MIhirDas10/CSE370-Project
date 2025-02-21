<?php
include 'dbcon.php';
if (isset($_POST['add_members'])) {
    // Correctly use the variable name
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $dor = $_POST['dor'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    // everything
    if (($fullname == "" || empty($fullname)) && ($username == "" || empty($username)) && ($password == "" || empty($password)) && ($gender == "" || empty($gender)) && ($dor == "" || empty($dor)) && ($address == "" || empty($address)) && ($contact == "" || empty($contact))) {
        header('location:index.php?message=You need to fill the form');
        exit();
    }

    // fullname
    if ($fullname == "" || empty($fullname)) {
        header('location:index.php?message=You need to fill in the first name');
        exit(); // Ensure the script stops executing after the redirect
    }

    // password
    if ($password == "" || empty($password)) {
        header('location:index.php?message=You need to fill in the last name');
        exit();
    }
    
    // gender
    if ($gender == "" || empty($gender)) {
        header('location:index.php?message=You need to fill in the age');
        exit();
    }

    // ----
    // dor
    if ($dor == "" || empty($dor)) {
        header('location:index.php?message=You need to fill in the phone');
        exit();
    }
    // address
    if ($address == "" || empty($address)) {
        header('location:index.php?message=You need to fill in the phone');
        exit();
    }
    // contact
    if ($contact == "" || empty($contact)) {
        header('location:index.php?message=You need to fill in the first name');
        exit(); // Ensure the script stops executing after the redirect
    }

    else{
        $query = "INSERT INTO `members` (`fullname`, `username`, `password`, `gender`, `dor`, `address`, `contact`) VALUES ('$fullname', '$username', '$password', '$gender', '$dor', '$address', '$contact')";
        $result = mysqli_query($connection, $query);

        if(!$result){
            die("Query failed".mysqli_error($connection));
        }
        else{
            header('location:index.php?insert_msg=Your data has been added successfully');
            exit();
        }
    }
    
}

?>