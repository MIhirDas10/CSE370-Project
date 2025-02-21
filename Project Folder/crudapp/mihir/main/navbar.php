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
        text-align: center; /* Center the logo */
        margin-bottom: 20px; /* Add some spacing below the logo */
        }

        .logo-container img {
            max-width: 80%; /* Ensure the logo fits within the sidebar */
            height: auto; /* Maintain aspect ratio */
            border-radius: 5px; /* Optional: Add rounded corners if desired */
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
        .text{
            color: white;
            font-size: 30px;
            margin-left: -955px;
        }

        /* Top Navbar */
        .top-navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background-color: black;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* Content styles */
        .chart-container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* buttons */
        .btn-text{
            list-style: none;
            text-decoration: none;
            color: white;
            background: #222529;
            border-radius: 10px;
            padding: 12px;
        }

        .btn-text:hover{
            background: #3a3f45;
        }

        iframe { border: none; width: 100%; height: calc(96vh - 56px); }
    </style>
</head>
<body>
    <div class="layout">
        <!-- Left Sidebar -->
        <nav class="sidebar">
            <div class="logo-container">
                <img src="pics/logo.png" alt="Logo">
            </div>
            <ul>
                <li><a href="javascript:void(0)" onclick="loadPage('/crudapp/mihir/main/dashboard.php')">🏠 <span>Dashboard</span></a></li>
                <li><a href="javascript:void(0)" onclick="loadPage('/crudapp/mihir/profile/profile.php')">👤 <span>Profile</span></a></li>
                <li><a href="javascript:void(0)" onclick="loadPage('/crudapp/mihir/members/index.php')">📋 <span>Member List</span></a></li>
                <li><a href="javascript:void(0)" onclick="loadPage('/crudapp/mihir/staffs/index.php')">👥 <span>Staff List</span></a></li>
                <li><a href="javascript:void(0)" onclick="loadPage('/crudapp/mihir/staffRoutine/index.php')">👥 <span>Staff Routine</span></a></li>
                <li><a href="javascript:void(0)" onclick="loadPage('/crudapp/mihir/equipments/index.php')">👥 <span>Equipment List</span></a></li>
                <li><a href="javascript:void(0)" onclick="loadPage('/crudapp/mihir/announcement/index.php')">📢 <span>Announcements</span></a></li>
            </ul>
        </nav>

        <!-- Main Content Area -->
        <div class="main-content">
            <!-- Top Navbar -->
            <header class="top-navbar">
                <div class="navbar-left">
                    <button id="sidebar-toggle" aria-label="Toggle Sidebar">☰</button>
                </div>
                <?php
                    define("HOSTNAME", "localhost");
                    define("USERNAME", "root");
                    define("PASSWORD", "");
                    define("DATABASE", "gym_system");

                    $connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

                    if(!$connection){
                        die("Connection failed");
                    }

                $result = $connection->query("SELECT username FROM `admin`");
                $username = ($result->num_rows > 0) ? $result->fetch_assoc()['username'] : "Guest";
                ?>
                <div class="text">Welcome, <?php echo htmlspecialchars($username); ?></div>

                <div class="navbar-right">
                    <!-- <a href="javascript:void(0)" class="btn-text" onclick="loadPage('subscription.html')">Subscription</a> -->
                    <a href="logout.php" class="btn-text">Logout</a>
                    <!-- <a href="announcement.php" class="btn-text" onclick="loadPage('announcement.php')">Notices</a> -->
                    <!-- <a href="timer.php" class="btn-text" onclick="loadPage('timer.php')">Countdown</a> -->
                </div>
            </header>

            <!-- Page Content (Iframe to load the content dynamically) -->
            <iframe id="content-frame" src="/crudapp/mihir/main/dashboard.php"></iframe>
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
