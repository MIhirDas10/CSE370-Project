<?php
session_start();
$session_id = $_SESSION['user_id'];
if (!isset($_SESSION['user_id'])) {
    //Redirect to login page if not logged in
   header("Location: index.php");
   exit();
}
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
if (!isset($_SESSION['user_id'])) {
    //Redirect to login page if not logged in
   header("Location: index.php");
   exit();
}
// Initialize variables
$mem_id = $session_id; // Replace with the actual Member ID
$message = "";

// If the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve inputs (0 or 1) for each time slot
    $ts_8_10 = isset($_POST['ts_8_10']) ? 1 : 0;
    $ts_10_12 = isset($_POST['ts_10_12']) ? 1 : 0;
    $ts_12_2 = isset($_POST['ts_12_2']) ? 1 : 0;
    $ts_2_4 = isset($_POST['ts_2_4']) ? 1 : 0;
    $ts_4_6 = isset($_POST['ts_4_6']) ? 1 : 0;

    // Update the memberRoutine table
    $sql = "UPDATE memberroutine SET TS_8_10='$ts_8_10', TS_10_12='$ts_10_12', TS_12_2='$ts_12_2', TS_2_4='$ts_2_4', TS_4_6='$ts_4_6' WHERE Mem_ID='$session_id'";
    $stmt = $conn->prepare($sql);
    //$stmt->bind_param("iiiii", $ts_8_10, $ts_10_12, $ts_12_2, $ts_2_4, $ts_4_6, $mem_id);

    if ($stmt->execute()) {
        $message = "Routine updated successfully!";
    } else {
        $message = "Error updating routine: " . $conn->error;
    }

    $stmt->close();
}

// Fetch the current routine for the member
$sql = "SELECT TS_8_10, TS_10_12, TS_12_2, TS_2_4, TS_4_6 FROM memberroutine WHERE Mem_ID='$session_id'";
$stmt = $conn->prepare($sql);
// $stmt->bind_param("i", $mem_id);
$stmt->execute();
$result = $stmt->get_result();
$currentRoutine = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Routine</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
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
        .time-slot {
            margin-bottom: 10px;
        }
        .submit-btn {
            display: block;
            width: 100%;
            background: #4caf50;
            color: #fff;
            border: none;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background: #45a049;
        }
        .message {
            margin-top: 20px;
            text-align: center;
            color: #4caf50;
        }
        .routine-table {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
        }
        .routine-table th, .routine-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        .routine-table th {
            background: #f4f4f4;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Set Your Routine</h1>

        <!-- Form to update the routine -->
        <form method="POST">
            <div class="time-slot">
                <label>
                    <input type="checkbox" name="ts_8_10" <?php echo ($currentRoutine['TS_8_10'] == 1 ? 'checked' : ''); ?>>
                    8:00 AM - 10:00 AM
                </label>
            </div>
            <div class="time-slot">
                <label>
                    <input type="checkbox" name="ts_10_12" <?php echo ($currentRoutine['TS_10_12'] == 1 ? 'checked' : ''); ?>>
                    10:00 AM - 12:00 PM
                </label>
            </div>
            <div class="time-slot">
                <label>
                    <input type="checkbox" name="ts_12_2" <?php echo ($currentRoutine['TS_12_2'] == 1 ? 'checked' : ''); ?>>
                    12:00 PM - 2:00 PM
                </label>
            </div>
            <div class="time-slot">
                <label>
                    <input type="checkbox" name="ts_2_4" <?php echo ($currentRoutine['TS_2_4'] == 1 ? 'checked' : ''); ?>>
                    2:00 PM - 4:00 PM
                </label>
            </div>
            <div class="time-slot">
                <label>
                    <input type="checkbox" name="ts_4_6" <?php echo ($currentRoutine['TS_4_6'] == 1 ? 'checked' : ''); ?>>
                    4:00 PM - 6:00 PM
                </label>
            </div>
            <button type="submit" class="submit-btn">Update Routine</button>
        </form>

        <!-- Display success/error message -->
        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <!-- Display the current routine -->
        <h2>Your Current Routine</h2>
        <table class="routine-table">
            <thead>
                <tr>
                    <th>Time Slot</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>8:00 AM - 10:00 AM</td>
                    <td><?php echo ($currentRoutine['TS_8_10'] == 1 ? 'Active' : 'Inactive'); ?></td>
                </tr>
                <tr>
                    <td>10:00 AM - 12:00 PM</td>
                    <td><?php echo ($currentRoutine['TS_10_12'] == 1 ? 'Active' : 'Inactive'); ?></td>
                </tr>
                <tr>
                    <td>12:00 PM - 2:00 PM</td>
                    <td><?php echo ($currentRoutine['TS_12_2'] == 1 ? 'Active' : 'Inactive'); ?></td>
                </tr>
                <tr>
                    <td>2:00 PM - 4:00 PM</td>
                    <td><?php echo ($currentRoutine['TS_2_4'] == 1 ? 'Active' : 'Inactive'); ?></td>
                </tr>
                <tr>
                    <td>4:00 PM - 6:00 PM</td>
                    <td><?php echo ($currentRoutine['TS_4_6'] == 1 ? 'Active' : 'Inactive'); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
