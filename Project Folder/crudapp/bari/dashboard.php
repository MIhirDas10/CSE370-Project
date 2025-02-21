<?php
// Start the session
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

// Replace this with the actual progress_id you want to query
$progress_id = $session_id;

// Fetch initial and current weight for the given progress_id
$sql = "SELECT ini_weight, curr_weight FROM progress WHERE progress_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $progress_id);
$stmt->execute();
$result = $stmt->get_result();

$weights = $result->fetch_assoc();
$ini_weight = $weights['ini_weight'] ?? 0;
$curr_weight = $weights['curr_weight'] ?? 0;

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .chart-container {
            width: 60%;
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
    </style>
</head>
<body>
    <div class="chart-container">
        <h1> Progress Chart</h1>
        <canvas id="progressChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('progressChart').getContext('2d');
        const progressChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Initial Weight', 'Current Weight'],
                datasets: [{
                    label: 'Weight (kg)',
                    data: [<?php echo $ini_weight; ?>, <?php echo $curr_weight; ?>],
                    backgroundColor: ['#4caf50', '#2196f3'],
                    borderColor: ['#388e3c', '#1976d2'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Weight (kg)'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
