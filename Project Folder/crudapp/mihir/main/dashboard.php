<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboardStyle.css">
</head>
<body>
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


      $total_equipment_query = "SELECT COUNT(*) as total FROM equipment";
      $total_equipment_result = $conn->query($total_equipment_query);
      $total_equipment = $total_equipment_result->fetch_assoc()['total'];


      $total_attendance_query = "SELECT COUNT(*) as total FROM attendance";
      $total_attendance_result = $conn->query($total_attendance_query);
      $total_attendance = $total_attendance_result->fetch_assoc()['total'];
      ?>

      <div class="card-holder">
        <div class="card" style="width: 15rem; height: 10rem">
          <i class="bi bi-person-circle"></i>
          <div class="card-body">
            <p class="card-text"><b>Total Customers</b></p>
            <h5 class="card-title"><?php echo $total_members; ?></h5>
          </div>
        </div>
        <div class="card" style="width: 15rem; height: 10rem">
          <i class="bi bi-person-fill-gear"></i>
          <div class="card-body">
            <p class="card-text"><b>Total Staffs</b></p>
            <h5 class="card-title"><?php echo $total_staff; ?></h5>
          </div>
        </div>
        <div class="card" style="width: 15rem; height: 10rem">
          <i class="bi bi-person-circle"></i>
          <div class="card-body">
            <p class="card-text"><b>Total Equipments</b></p>
            <h5 class="card-title"><?php echo $total_equipment; ?></h5>
          </div>
        </div>
        <div class="card" style="width: 15rem; height: 10rem">
          <i class="bi bi-person-fill-gear"></i>
          <div class="card-body">
            <p class="card-text"><b>Present Members</b></p>
            <h5 class="card-title"><?php echo $total_attendance; ?></h5>
          </div>
        </div>
      </div>
    </div>
<!-- block section ends here -->
<!-- analytic section starts from here -->
<div id="analytics-section" class="pie-chart-header" style="padding-top: 35px;">
        <!-- pie charts -->
        <div class="chart-container" style="
            display: flex;
            justify-content: center;
            text-align: center;
            align-items: center;
            margin-top: 20px;
            padding-left: 200px;
            overflow-x: hidden;
            overflow-y: hidden;
            height: 380px;">
          <div class="chart-list" style="text-align: center; overflow-x: hidden; overflow-y: hidden;">
              <embed type="text/html" src="/crudapp/mihir/announcement/piechart.php" width="650" height="516" style="overflow-x: hidden; overflow-y: hidden;">
          </div>

          <div class="chart-list" style="text-align: center;">
              <embed type="text/html" src="/crudapp/mihir/announcement/piechart2.php" width="650" height="516" style="overflow-x: hidden; overflow-y: hidden;">
          </div>
        </div>

        <!-- <div id="financial-state-section" class="financial-header">Here is a brief overview of the financial side of the gym</div> -->

        <!-- Bar Chart Section -->
        <!-- <div class="chart-div">
          <div class="chart-list" style="text-align: center;">
              <embed type="text/html" src="/crudapp/announcement/chart3.php" width="1000" height="600">
          </div>
        </div> -->

    </div>
</body>
</html>