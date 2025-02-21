

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Demo SpaceX</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <link rel="stylesheet" href="main-style.css">
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-body-tartiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">TRUEBUILD</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="holder collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav links ms-auto" style="font-size: 20px;">
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="/crudapp/index.php">Home</a></li>
            <!-- <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Membership</a></li> -->
            <!-- <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Trainer</a></li> -->
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="#member_list">Members</a></li>
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="#staff_list">Staffs</a></li>
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="#staff_routine">Staff Routine</a></li>
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="#analytics-section">Analytics</a></li>
            <!-- <li class="nav-item"><a class="nav-link active" aria-current="page" href="#financial-state-section">Financial State</a></li> -->
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="#announcement-section">Announcements</a></li>
            <!-- <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Equipment</a></li>
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Feedback</a></li> -->
          </ul>

          <!-- <form class="d-flex" method="POST" action="/" novalidate>
            <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search" />
            <button class="btn btn-outline-light" type="submit"><i class="bi bi-search"></i></button>
          </form> -->

          <!-- Dark Mode Toggle Button -->
          <button class="btn btn-outline-light ms-2" id="darkModeToggle">
            <i class="bi bi-moon-stars-fill"></i>
          </button> 
          

        </div>
      </div>
    </nav>
    <!-- navbar ends here -->

    

    <div class="welcome-img-div">
      <img class="welcome-img" src="pics/d1.jpg" alt="">
      <div class="intro">HELLO, ADMIN</div>
    </div>
   
    <div class="two-part-holder d-flex align-items-start" style="max-width: 1250px;
        margin: auto;
        margin-top: 320px;">

      <!-- Schedule Section -->
      <div class="part-one me-4">
        <div class="schedule-section">
          <div class="schedule-heading">GYM Schedule</div>
          <img src="pics/gsp.jpg" class="img-fluid" alt="Gym Schedule">
        </div>
      </div>

    

<!-- block section starts here -->
      <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "gym_system";
      
      $conn = new mysqli($servername, $username, $password, $dbname);
      
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
      $total_members_query = "SELECT COUNT(*) as total FROM members";
      $total_members_result = $conn->query($total_members_query);
      $total_members = $total_members_result->fetch_assoc()['total'];

      $total_staff_query = "SELECT COUNT(*) as total FROM staffs";
      $total_staff_result = $conn->query($total_staff_query);
      $total_staff = $total_staff_result->fetch_assoc()['total'];
      ?>

      <div class="card-holder">
        <div class="card" style="width: 18rem;">
          <i class="bi bi-person-circle"></i>
          <div class="card-body">
            <p class="card-text">Total Customers</p>
            <h5 class="card-title"><?php echo $total_members; ?></h5>
          </div>
        </div>
        <div class="card" style="width: 18rem;">
          <i class="bi bi-person-fill-gear"></i>
          <div class="card-body">
            <p class="card-text">Total Staffs</p>
            <h5 class="card-title"><?php echo $total_staff; ?></h5>
          </div>
        </div>
      </div>

    </div>

<!-- block section ends here -->

     

    <div id="member_list" class="member-list" style="margin: auto;
                                    justify-content: center;
                                    display: grid;
                                    margin-top: 100px;
                                    text-align: center;">
      <!-- <h2>Member List</h2> -->
      <embed type="text/html" src="/crudapp/index.php" width="1500" height="800">
    </div>

    <div id="staff_list" class="st-list" style="margin: auto;
                                    justify-content: center;
                                    display: grid;
                                    margin-top: 100px;
                                    text-align: center;
                                    margin-top: 200px">
      <!-- <h2>Staff List</h2> -->
      <embed type="text/html" src="/crudapp/staffs/index.php" width="1500" height="850">
    </div>

    <div id="staff_routine" class="st-list" style="margin: auto;
                                    justify-content: center;
                                    display: grid;
                                    margin-top: 100px;
                                    text-align: center;
                                    margin-top: 200px">
      <!-- <h2>Staff Routine List</h2> -->
      <embed type="text/html" src="/crudapp/staffRoutine/index.php" width="1500" height="850">
    </div>

    <!-- analytic section starts from here -->
    <div id="analytics-section" class="pie-chart-header" style="padding-top: 35px;">
          <h2>Analytics</h2>
          <div>Here are some important analytics about the customer's information</div>
        

        <!-- pie charts -->
        <div class="chart-container" style="
              display: flex;
              justify-content: center;
              text-align: center;
              align-items: center;
              /* background-color: blue; */
              margin-top: 10px;
              padding-left: 200px;
              overflow-x: hidden; 
              overflow-y: hidden;">
          <div class="chart-list" style="text-align: center; overflow-x: hidden; overflow-y: hidden;">
              <embed type="text/html" src="/crudapp/announcement/piechart.php" width="650" height="516" style="overflow-x: hidden; overflow-y: hidden;">
          </div>

          <div class="chart-list" style="text-align: center;">
              <embed type="text/html" src="/crudapp/announcement/piechart2.php" width="650" height="516" style="overflow-x: hidden; overflow-y: hidden;">
          </div>
        </div>

        <div id="financial-state-section" class="financial-header">Here is a brief overview of the financial side of the gym</div>

        <!-- Bar Chart Section -->
        <div class="chart-div">
          <div class="chart-list" style="text-align: center;">
              <embed type="text/html" src="/crudapp/announcement/chart3.php" width="1000" height="600">
          </div>
        </div>

    </div>
    
    <!-- Announcement section -->
    
    <div id="announcement-section" class="announcement-sec">
      <div class="chart-list" style="text-align: center;">
          <embed type="text/html" src="/crudapp/announcement/index.php" width="1200" height="600">
      </div>
    </div>
    

    <!-- Footer Section -->
<footer class="bg-dark text-light pt-5 pb-4" style="margin-top: 200px;">
    <div class="container">
        <div class="row">
            <!-- About Section -->
            <div class="col-md-4 mb-4">
                <h5>About Us</h5>
                <p class="txt-des">
                    We are dedicated to pushing the boundaries of our customers giving them the best experience that they could ask for.
                    Join us and make the best decision as we will never give up on you and you can count on us.
                </p>
            </div>

            <!-- Quick Links Section -->
            <div class="footer-section col-md-4 mb-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a class="element" href="/" class="text-muted">Home</a></li>
                    <li><a class="element" href="/about" class="text-muted">About Us</a></li>
                    <li><a class="element" href="/projects" class="text-muted">Our Projects</a></li>
                    <li><a class="element" href="/careers" class="text-muted">Careers</a></li>
                    <li><a class="element" href="/adminpanel" class="text-muted">Admin Panel</a></li>
                </ul>
            </div>

            <!-- Contact Section -->
            <div class="col-md-4 mb-4">
                <h5>Contact Us</h5>
                <ul class="list-unstyled">
                    <li><i class="bi bi-envelope"></i> <a href="mailto:info@spacex.com" class="text-muted">info@spacex.com</a></li>
                    <li><i class="bi bi-telephone"></i> +1 123 456 7890</li>
                    <li><i class="bi bi-geo-alt"></i> 1 Rocket Road, Hawthorne, CA</li>
                </ul>
                <div class="social-icons mt-3">
                    <a href="#" class="text-light me-3"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-light me-3"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-light me-3"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="text-light me-3"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
        </div>

        <!-- Scroll to Top Button -->
        <a href="#">
            <div class="scroll-to-top mt-4 text-center">
                <div class="scroll-button">
                <i class="bi bi-arrow-up-circle"></i>
                    <!-- <i id="scroll-button-icon" class="fas fa-arrow-circle-up" style="font-size: 2rem;"></i> -->
                </div>
            </div>
        </a>

        <!-- Footer Bottom Section -->
        <div class="lastline text-center pt-3">
            <p class="lastline text-muted">&copy; 2024 TRUEBUILD. All rights reserved.</p>
        </div>
    </div>
</footer>



    


    

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>

    <script src="/css/darkmode.js"></script>
  </body>
</html>
