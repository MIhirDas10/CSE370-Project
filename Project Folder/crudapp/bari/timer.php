<?php
// Database connection
session_start();
$session_id = $_SESSION['user_id'];
$host = 'localhost'; // Change as needed
$dbname = 'gym_system'; // Change as needed
$username = 'root'; // Change as needed
$password = ''; // Change as needed

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Fetch subscription details
$sub_id = $session_id; // Example subscription ID (Replace with dynamic value)
$stmt = $pdo->prepare("SELECT plan, paid_date, status FROM subscription WHERE sub_id = ?");
$stmt->execute([$sub_id]);
$subscription = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$subscription) {
    die("Subscription not found.");
}

// Calculate remaining time
$paid_date = strtotime($subscription['paid_date']);
$plan_duration = strtotime("+{$subscription['plan']}", $paid_date);
$current_time = time();
$remaining_time = $plan_duration - $current_time;

// Ensure status is "Inactive" if the timer has already expired
if ($remaining_time <= 0) {
    $remaining_time = 0;
    $stmt = $pdo->prepare("UPDATE subscription SET status = 'Expired' WHERE sub_id = ?");
    $stmt->execute([$sub_id]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Subscription Timer</title> -->
    <style>
        body {
            /* font-family: Arial, sans-serif; */
            /* text-align: center; */
            /* padding: 20px; */
            margin: 0;
            padding: 0;
            background: transparent;
        }
        #timer {
            font-size: 1rem;
            /* color: #333; */
            color: white;
            margin: 0;
            padding: 0;
            line-height: 1;
            text-align: center;

        }
    </style>
    <script>
        let remainingTime = <?= $remaining_time; ?>; // Time in seconds

        function startTimer() {
            const timerElement = document.getElementById('timer');
            const updateStatus = () => {
                fetch('update_status.php?sub_id=<?= $sub_id; ?>') // Call PHP to update status
                    .then(response => response.text())
                    .then(data => console.log(data))
                    .catch(error => console.error('Error:', error));
            };

            function updateTimer() {
                if (remainingTime <= 0) {
                    timerElement.textContent = "Membership Expired!";
                    updateStatus(); // Update status to "Inactive"
                    return;
                }
                const days = Math.floor(remainingTime / (24 * 3600));
                const hours = Math.floor((remainingTime % (24 * 3600)) / 3600);
                const minutes = Math.floor((remainingTime % 3600) / 60);
                const seconds = remainingTime % 60;

                timerElement.textContent = `${days}d ${hours}h ${minutes}m ${seconds}s`;
                remainingTime--;
            }

            setInterval(updateTimer, 1000);
            updateTimer(); // Initial call to set the timer immediately
        }

        document.addEventListener('DOMContentLoaded', startTimer);
    </script>
</head>
<body>
    <!-- <h1>Subscription Timer</h1> -->
    <p id="timer">Calculating...</p>
</body>
</html>
