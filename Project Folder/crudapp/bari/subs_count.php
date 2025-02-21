<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Count Navbar</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color:black; /*#333;*/
            color: white;
            padding: 10px 20px;
        }
        .navbar .left {
            font-size: 18px;
            font-weight: bold;
        }
        .navbar .right {
            font-size: 16px;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
        }
        .navbar a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
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

    // Query to count rows
    $sql = "SELECT COUNT(*) AS subscription_count FROM attendance";
    $result = $conn->query($sql);

    // Initialize the count
    $subscription_count = 0;

    if ($result && $row = $result->fetch_assoc()) {
        $subscription_count = $row['subscription_count'];
        echo $subscription_count;
    }

    $conn->close();
    ?>

    <!--<div class="navbar">
        Left corner: Subscription count
        <div class="left">
            Total Subscriptions: //<//?php echo $subscription_count; ?>
        </div>
         Right corner: Navigation links
        <div class="right">
            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#contact">Contact</a>
        </div>
    </div>-->
</body>
</html>
