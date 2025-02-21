<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym_system"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if 'id' is passed via GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch data for the specific member
    $sql = "SELECT * FROM staffs WHERE staff_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the member exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<p class='text-center text-danger mt-5'>No user found with ID $id.</p>";
        exit;
    }
} else {
    echo "<p class='text-center text-danger mt-5'>Invalid request. No ID provided.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sriracha&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container py-5">
        <!-- Breadcrumb -->
        <!-- <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light p-3 rounded">
                <li class="breadcrumb-item"><a href="index.php" class="text-primary">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">View User</li>
            </ol>
        </nav> -->

        <div class="text-center mb-4">
        <h1 id="main-title" style="text-align: center;
                                        margin-bottom: 15px;
                                        color: beige;
                                        padding: 5px;
                                        /* font-weight: 500; */
                                        font-family: Bebas Neue;
                                        /* position: sticky; */
                                        background: #212529;;
                                        border-radius: 15px;
                                        /* display: inline-flex; */
                                        font-size: 30px;">
            Staff Data</h1>
            <h2 class="fw-bold"><?php echo htmlspecialchars($row['username']); ?></h2>
            <p class="text-muted">Viewing detailed information</p>
        </div>
        <div class="card shadow-lg">
            <div class="card-body">
                <table class="table table-hover table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Field</th>
                            <th scope="col">Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>Username</td><td><?php echo htmlspecialchars($row['username']); ?></td></tr>
                        <tr><td>Password</td><td><?php echo htmlspecialchars($row['password']); ?></td></tr>
                        <tr><td>Email</td><td><?php echo htmlspecialchars($row['email']); ?></td></tr>
                        <tr><td>Fullname</td><td><?php echo htmlspecialchars($row['fullname']); ?></td></tr>
                        <tr><td>Address</td><td><?php echo htmlspecialchars($row['address']); ?></td></tr>
                        <tr><td>Designation</td><td><?php echo htmlspecialchars($row['designation']); ?></td></tr>
                        <tr><td>Gender</td><td><?php echo htmlspecialchars($row['gender']); ?></td></tr>
                        <tr><td>Contact</td><td><?php echo htmlspecialchars($row['contact']); ?></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-secondary">Back to List</a>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr><td>username</td><td><?php echo htmlspecialchars($row['username']); ?></td></tr>
                        <tr><td>Password</td><td><?php echo htmlspecialchars($row['password']); ?></td></tr>
                        <tr><td>Email</td><td><?php echo htmlspecialchars($row['email']); ?></td></tr>
                        <tr><td>Fullname</td><td><?php echo htmlspecialchars($row['fullname']); ?></td></tr>
                        <tr><td>Address</td><td><?php echo htmlspecialchars($row['address']); ?></td></tr>
                        <tr><td>Designation</td><td><?php echo htmlspecialchars($row['designation']); ?></td></tr>
                        <tr><td>Gender</td><td><?php echo htmlspecialchars($row['gender']); ?></td></tr>
                        <tr><td>Contact</td><td><?php echo htmlspecialchars($row['contact']); ?></td></tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>
