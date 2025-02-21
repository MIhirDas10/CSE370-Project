<?php include("header.php"); ?>
<?php include("dbcon.php"); ?>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Library</li>
  </ol>
</nav>

<?php
// Fetch the existing student data
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($connection, $_GET['id']);
    $query = "SELECT * FROM `members` WHERE `member_id` = '$id'";

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
if (isset($_POST['update_students'])) {
    if (isset($_GET['id_new'])) {
        $idnew = mysqli_real_escape_string($connection, $_GET['id_new']);
    } else {
        die("No ID provided for update.");
    }

    $fullname = mysqli_real_escape_string($connection, $_POST['fullname']);
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $gender = mysqli_real_escape_string($connection, $_POST['gender']);
    $dor = mysqli_real_escape_string($connection, $_POST['dor']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $contact = mysqli_real_escape_string($connection, $_POST['contact']);

    $query = "UPDATE `members` 
              SET `fullname` = '$fullname', 
                  `username` = '$username', 
                  `password` = '$password',
                  `gender` = '$gender', 
                  `dor` = '$dor', 
                  `address` = '$address', 
                  `contact` = '$contact' 
              WHERE `member_id` = '$idnew'";

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
                <label for="fullname">Full Name</label>
                <input type="text" name="fullname" class="form-control" value="<?php echo htmlspecialchars($row['fullname']); ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($row['username']); ?>">
            </div>
        </div>

        <!-- Second Row -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" name="password" class="form-control" value="<?php echo htmlspecialchars($row['password']); ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="gender">Gender</label>
                <input type="text" name="gender" class="form-control" value="<?php echo htmlspecialchars($row['gender']); ?>">
            </div>
        </div>

        <!-- Third Row -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="dor">DOR</label>
                <input type="text" name="dor" class="form-control" value="<?php echo htmlspecialchars($row['dor']); ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" value="<?php echo htmlspecialchars($row['address']); ?>">
            </div>
        </div>

        <!-- Fourth Row -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="contact">Contact</label>
                <input type="text" name="contact" class="form-control" value="<?php echo htmlspecialchars($row['contact']); ?>">
            </div>
        </div>

    <!-- Submit Button -->
    <div class="mt-3">
        <input type="submit" class="btn btn-success" name="update_students" value="UPDATE">
    </div>
</form>


<?php include("footer.php"); ?>
