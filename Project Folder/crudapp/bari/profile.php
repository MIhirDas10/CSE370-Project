<?php
// Start the session
session_start();
$session_id = $_SESSION['user_id'];

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
     //Redirect to login page if not logged in
    header("Location: index.php");
    exit();
}
 //Fetch user data
$member_id =$session_id;
$sql = "SELECT * FROM members WHERE member_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $member_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .profile-container {
            width: 50%;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .profile-info {
            margin-top: 20px;
        }
        .profile-info p {
            font-size: 18px;
            margin: 10px 0;
            color: #555;
        }
        .logout-btn {
            display: block;
            width: 100%;
            text-align: center;
            margin-top: 20px;
        }
        .logout-btn a {
            text-decoration: none;
            color: #fff;
            background-color: #ff4757;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .logout-btn a:hover {
            background-color: #e84118;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h1>Welcome, <?php echo htmlspecialchars($user['fullname']); ?>!</h1>
        <div class="profile-info">
            <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
            <p><strong>Gender:</strong> <?php echo htmlspecialchars($user['gender']); ?></p>
            <p><strong>Date of Registration:</strong> <?php echo htmlspecialchars($user['dor']); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
            <p><strong>Contact:</strong> <?php echo htmlspecialchars($user['contact']); ?></p>
            <p><strong>ID:</strong> <?php echo htmlspecialchars($user['member_id']); ?></p>
        </div>
        <div class="logout-btn">
            <a href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>
