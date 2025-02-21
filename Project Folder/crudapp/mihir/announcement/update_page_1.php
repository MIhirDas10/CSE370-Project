<?php include("header.php"); ?>
<?php include("dbcon.php"); ?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Update Page</li>
  </ol>
</nav>

<?php
// Fetch the existing staff data
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($connection, $_GET['id']);
    $query = "SELECT * FROM `announcements` WHERE `id` = '$id'";

    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    } else {
        $row = mysqli_fetch_assoc($result);
    }
}
?>

<?php
// Handle the update logic
if (isset($_POST['update_announcements'])) {
    if (isset($_GET['id_new'])) {
        $idnew = mysqli_real_escape_string($connection, $_GET['id_new']);
    } else {
        die("No ID provided for update.");
    }

    $admin_id = 1;
    $message = mysqli_real_escape_string($connection, $_POST['message']);
    $date = mysqli_real_escape_string($connection, $_POST['date']);
    
    $query = "UPDATE `announcements` 
          SET `admin_id` = '$admin_id', 
              `message` = '$message',
              `date` = '$date'
          WHERE `id` = '$idnew'";

    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    } else {
        header('Location: index.php?update_msg=You have successfully updated the data.');
        exit(); // Stop further script execution
    }
}
?>

<!-- Update Form -->
<form action="update_page_1.php?id_new=<?php echo htmlspecialchars($id); ?>" method="post">
    <div class="row">
        <!-- First Row -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="message">Message</label>
                <input type="text" name="message" class="form-control" value="<?php echo htmlspecialchars($row['message']); ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" class="form-control" value="<?php echo htmlspecialchars($row['date']); ?>">
            </div>
        </div>

        

    <!-- Submit Button -->
    <div class="mt-3">
        <input type="submit" class="btn btn-success" name="update_announcements" value="UPDATE">
    </div>
</form>


<!-- the better code -->
<!-- <form action="update_page_1.php?id_new=<?php echo htmlspecialchars($id); ?>" method="post">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($row['name']); ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="user_name">Username</label>
                <input type="text" name="user_name" class="form-control" value="<?php echo htmlspecialchars($row['user_name']); ?>">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="age">Age</label>
                <input type="text" name="age" class="form-control" value="<?php echo htmlspecialchars($row['age']); ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo htmlspecialchars($row['email']); ?>">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($row['phone']); ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="gender">Gender</label>
                <input type="text" name="gender" class="form-control" value="<?php echo htmlspecialchars($row['gender']); ?>">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" value="<?php echo htmlspecialchars($row['address']); ?>">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="designation">Designation</label>
                <input type="text" name="designation" class="form-control" value="<?php echo htmlspecialchars($row['designation']); ?>">
            </div>
        </div>

    <div class="mt-3">
        <input type="submit" class="btn btn-success" name="update_students" value="UPDATE">
    </div>
</form> -->

<!--------------------->

<?php include("footer.php"); ?>
