<html>
<head>
  <link rel="stylesheet" href="navbar-style.css">
  <script>
        // JavaScript for toggling the sidebar on mobile
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });

        // Function to load a page into the iframe without a full page reload
        function loadPage(url) {
            document.getElementById('content-frame').src = url;
        }

        
    </script>
</head>

<body>
<div class="side-menu">
  <header>
    <img src="logo%20(1).png" alt="Logo">
  </header>
  <nav class="sidebar">
    <ul>
      <li><a href="#" onclick="loadContent('/crudapp/index.php')">Member list</a></li>
      <li><a href="#" onclick="loadContent('/crudapp/staffs/index.php')">Staff list</a></li>
      <li><a href="#" onclick="loadContent('/crudapp/announcement/index.php')">Announcement</a></li>
      <li><a href="#" onclick="loadContent('/crudapp/announcement/piechart.php')">Pie chart</a></li>
    </ul>
  </nav>
</div>

<div class="main">
  <header>
    <h2>Welcome Admin/Customer</h2>
  </header>
  <!-- Add a div to display dynamic content -->
  <div id="content-area" style="border: 1px solid #ccc; padding: 10px;"></div>
</div>
</body>

</html>
