<?php
// Database connection configuration
$servername = "localhost"; // Replace with your database host
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "gym_system"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch announcements from the database
$sql = "SELECT id, admin_id, message, date FROM announcements ORDER BY date DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements</title>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #121212;
        margin: 0;
        padding: 0;
        color: #e0e0e0;
    }
    .container {
        max-width: 800px;
        margin: 50px auto;
        background: #1e1e1e;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(255, 255, 255, 0.1);
    }
    h1 {
        text-align: center;
        color: #bb86fc;
        margin-bottom: 30px;
        font-size: 2.5rem;
        text-transform: uppercase;
        letter-spacing: 2px;
    }
    .announcement {
        border: none;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        background: #292929;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    .announcement:nth-child(3n+1) {
        background: #1a3a3a;
    }
    .announcement:nth-child(3n+2) {
        background: #3a1a3a;
    }
    .announcement:nth-child(3n) {
        background: #3a2a1a;
    }
    .announcement:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(187, 134, 252, 0.3);
    }
    .announcement p {
        margin: 0;
        font-size: 1.1rem;
        color: #e0e0e0;
        line-height: 1.6;
    }
    .announcement-date {
        margin-top: 15px;
        font-size: 0.9rem;
        color: #bb86fc;
        font-style: italic;
    }
    .no-announcements {
        text-align: center;
        color: #bb86fc;
        font-style: italic;
        font-size: 1.1rem;
        padding: 20px;
        background: #292929;
        border-radius: 12px;
    }
</style>
</head>
<body>
    <div class="container">
        <h1>Announcements</h1>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="announcement">
                    <p><?php echo htmlspecialchars($row['message']); ?></p>
                    <div class="announcement-date">
                        Posted on: <?php echo date('F j, Y, g:i a', strtotime($row['date'])); ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="no-announcements">No announcements available at the moment.</p>
        <?php endif; ?>
        <?php $conn->close(); ?>
    </div>
</body>
</html>

