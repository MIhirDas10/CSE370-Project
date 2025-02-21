<?php
include 'dbcon.php';

if (isset($_POST['add_equipments'])) {
    // Collect form data
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $quantity = $_POST['quantity'];
    $vendor = $_POST['vendor'];
    $description = $_POST['description'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $date = $_POST['date'];

    // Validate required fields
    if(
        empty($name) || empty($amount) || empty($quantity) || empty($vendor) ||
        empty($description) || empty($address) || empty($contact) || empty($date)) {
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
        $query = "INSERT INTO `equipment` (`name`, `amount`, `quantity`, `vendor`, `description`, `address`, `contact`, `date`) VALUES ('$name', '$amount', '$quantity', '$vendor', '$description', '$address', '$contact', '$date')";
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
