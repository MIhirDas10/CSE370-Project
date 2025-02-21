<?php
session_start();
$session_id = $_SESSION['user_id'];
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

// Initialize message variable
$message = "";
if (!isset($_SESSION['user_id'])) {
    //Redirect to login page if not logged in
   header("Location: index.php");
   exit();
}
$sub_id=$session_id;
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch input values
    //$sub_id=$_SESSION['user_id'];
    $services = $_POST['services'];
    $p_year = $_POST['p_year'];
    $status = $_POST['status'];

    // Fixed values
    $admin_id = 1;
    $plan = "3 months";
    $amount = 5000;
    $paid_date = date('Y-m-d');

    // CUSTOM LOGIC
    $checkEmail="SELECT * From subscription where sub_id='$session_id'";
    $result=$conn->query($checkEmail);
    if($result->num_rows>0){
        echo "
        <div style='display: flex; justify-content: center; align-items: center; font-family: Arial, sans-serif;'>
            <h2>Progress already done!</h2>
        </div>";
    }
    else{

    
    // Insert into database
    $sql = "INSERT INTO subscription (sub_id,admin_id, services, amount, paid_date, p_year, plan, status) 
            VALUES (?,?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisissss", $sub_id,$admin_id, $services, $amount, $paid_date, $p_year, $plan, $status);

    if ($stmt->execute()) {
        $message = "Subscription added successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }

    $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
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
        form {
            margin-top: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        select, input[type="text"], input[type="number"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .message {
            margin-top: 20px;
            text-align: center;
            font-size: 16px;
            color: #4caf50;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>New Subscription</h1>

        <!-- Display success or error message -->
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <!-- Subscription form -->
        <form method="POST">
            <div class="form-group">
                <label for="services">Select Service:</label>
                <select id="services" name="services" required>
                    <option value="Fitness">Fitness</option>
                    <option value="Cardio">Cardio</option>
                    <option value="Yoga">Yoga</option>
                </select>
            </div>

            <div class="form-group">
                <label for="p_year">Year of Payment:</label>
                <input type="number" id="p_year" name="p_year" min="2000" max="2100" required>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>

            <input type="submit" value="Add Subscription">
        </form>
    </div>
</body>
</html>
