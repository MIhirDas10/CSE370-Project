<?php
session_start();
$session_id = $_SESSION['user_id'];
// Assuming user ID is stored in session when logged in
//if (!isset($_SESSION['member_id'])) {
  //  echo "<p>You must be logged in to add a task.</p>";
   // exit;
//}

//$member_id = $_SESSION['member_id'];
$member_id =$session_id;
// Database connection
$host = 'localhost'; // Change as needed
$dbname = 'gym_system';
$username = 'root'; // Change as needed
$password = ''; // Change as needed
if (!isset($_SESSION['user_id'])) {
    //Redirect to login page if not logged in
   header("Location: index.php");
   exit();
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_status = $_POST['task_status'];
    $task_desc = $_POST['task_desc'];

    // Insert into the database
    $stmt = $pdo->prepare("INSERT INTO todo (task_status, task_desc, member_id) VALUES (?, ?, ?)");
    $stmt->execute([$task_status, $task_desc, $member_id]);

    echo "<p>Task added successfully!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            /* max-width: 400px; */
        }
        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        select, button {
            margin-bottom: 15px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #28a745;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add a New Task</h1>
        <form method="POST">
            <label for="task_status">Task Status</label>
            <select name="task_status" id="task_status" required>
                <option value="In Progress">In Progress</option>
                <option value="Pending">Pending</option>
            </select>

            <label for="task_desc">Task Description</label>
            <select name="task_desc" id="task_desc" required>
                <option value="Test Completed">Test Completed</option>
                <option value="Decline dumbbell bench press">Decline dumbbell bench press</option>
                <option value="Triceps Buildup - 3 set">Triceps Buildup - 3 set</option>
                <option value="Standing Workouts For Flat Abs">Standing Workouts For Flat Abs</option>
                <option value="Mastering Crunches">Mastering Crunches</option>
            </select>

            <button type="submit">Add Task</button>
        </form>
    </div>
</body>
</html>
