<?php
// Start the session
session_start();
$session_id = $_SESSION['user_id'];
if (!isset($_SESSION['user_id'])) {
    //Redirect to login page if not logged in
   header("Location: index.php");
   exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Roboto', sans-serif; line-height: 1.6; color: #333; }
        .layout { display: flex; min-height: 100vh; }

        /* logo */
        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-container img {
            max-width: 80%;
            height: auto;
            border-radius: 5px;
        }

        /* Sidebar styles */
        .sidebar {
            width: 250px;
            background-color: black;
            color: #ecf0f1;
            padding: 20px 0;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .sidebar.collapsed {
            width: 0px;
        }

        .sidebar ul { list-style-type: none; }
        .sidebar ul li a {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            white-space: nowrap;
            padding: 15px 20px;
            color: #ecf0f1;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .sidebar.collapsed ul li a {
            justify-content: center;
        }

        .sidebar ul li a:hover { background-color: #34495e; }
        .sidebar ul li a span {
            display: inline-block;
            margin-left: 10px;
            transition: opacity 0.3s;
        }

        .sidebar.collapsed ul li a span {
            opacity: 0;
            visibility: hidden;
        }

        .main-content { flex: 1; display: flex; flex-direction: column; }

        /* welcome text */
        .text {
            color: white;
            font-size: 30px;
            margin-left: -600px;
        }

        /* Top Navbar */
        .top-navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px; /* Reduced padding */
            background-color: black;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* Navbar links */
        .navbar-right .btn-text {
            list-style: none;
            text-decoration: none;
            color: white;
            padding: 5px 10px; /* Reduced padding */
            margin: 0 5px; /* Spacing between items */
            display: inline-block;
        }
        .subscription-count{
            color: white;
        }
        .text{
            margin-left: 10px;
        }

        /* Timer specific styling */
        .navbar-right .btn-text embed {
            display: inline-block;
            color: white;
            vertical-align: middle;
            height: 20px; /* Adjusted height for better alignment */
            width: auto;
        }

        iframe { border: none; width: 100%; height: calc(100vh - 60px); background-color: black; }
    </style>
</head>
<body>
    <div class="layout">
        <!-- Left Sidebar -->
        <nav class="sidebar">
            <div class="logo-container">
                <img src="logo.png" alt="Logo">
            </div>
            <ul>
            <li><a href="javascript:void(0)" onclick="loadPage('chart1.php')">🏠 <span>Dashboard</span></a></li>
                <li><a href="javascript:void(0)" onclick="loadPage('profile.php')">👤 <span>Profile</span></a></li>
                <li><a href="javascript:void(0)" onclick="loadPage('todo.php')">📋 <span>Todo</span></a></li>
                <li><a href="javascript:void(0)" onclick="loadPage('feedback.php')">👥 <span>Feedback</span></a></li>
                <li><a href="javascript:void(0)" onclick="loadPage('progress.php')"> <span>Progress</span></a></li>
                <li><a href="javascript:void(0)" onclick="loadPage('routine.php')"> <span>Routine</span></a></li>
                <li><a href="javascript:void(0)" onclick="loadPage('equipment.php')"> <span>Equipment</span></a></li>
            </ul>
        </nav>

        <!-- Main Content Area -->
        <div class="main-content">
            <!-- Top Navbar -->
            <header class="top-navbar">
                <div class="navbar-left">
                    <!-- <button id="sidebar-toggle" aria-label="Toggle Sidebar">☰</button> -->
                     
                </div>
                <?php
                    define("HOSTNAME", "localhost");
                    define("USERNAME", "root");
                    define("PASSWORD", "");
                    define("DATABASE", "gym_system");

                    $connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

                    if (!$connection) {
                        die("Connection failed");
                    }

                    $result = $connection->query("SELECT username FROM `members` where member_id=$session_id");
                    $username = ($result->num_rows > 0) ? $result->fetch_assoc()['username'] : "Guest";
                ?>
                <div class="text"> Welcome, <?php echo htmlspecialchars($username); ?></div>

                <div class="navbar-right">
                    <a href="javascript:void(0)" class="btn-text" onclick="loadPage('subscription.php')">Subscription</a>
                    <span class="subscription-count">Present Members: <?php include'subs_count.php' ?></span>
                    <a href="logout.php" class="btn-text">Logout</a>
                    <a href="javascript:void(0)" class="btn-text" onclick="loadPage('announcement.php')">Notices</a>
                    <a href="timer.php" class="btn-text">
                        <embed src="timer.php">
                    </a>
                </div>
            </header>

            <!-- Page Content (Iframe to load the content dynamically) -->
            <iframe id="content-frame" src="dashboard.php"></iframe>
        </div>
    </div>

    <script>
        // JavaScript for toggling the sidebar
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('collapsed');
        });

        // Function to load a page into the iframe without a full page reload
        function loadPage(url) {
            document.getElementById('content-frame').src = url;
        }
    </script>
</body>
</html>
