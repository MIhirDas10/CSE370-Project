<?php
include 'dbcon.php';
if (isset($_POST['add_announcements'])) {
    // Correctly use the variable name
    $admin_id = 1;
    
    $message = $_POST['message'];
    $date = $_POST['date'];

    // everything
    if (($message == "" || empty($message)) && ($date == "" || empty($date))) {
        header('location:index.php?message=You need to fill the form');
        exit();
    }

    // message 
    if ($message == "" || empty($message)) {
        header('location:index.php?message=You need to fill in the message');
        exit(); // Ensure the script stops executing after the redirect
    }

    // date
    if ($date == "" || empty($date)) {
        header('location:index.php?message=You need to fill in the date');
        exit();
    }
    
    else{
        $query = "INSERT INTO `announcements` (`admin_id`, `message`, `date`) VALUES ('$admin_id', '$message', '$date')";
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