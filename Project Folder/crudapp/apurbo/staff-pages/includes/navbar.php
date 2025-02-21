<?php
$user_id = $_SESSION['user_id'];
if(!isset($_SESSION['user_id'])){
header('location:../index.php');	
}
?>
<div class="side-menu">

<div id="header">
  <h1>Perfect Gym</h1>
</div>
    <ul>
    <li><a href="index.php"><i class="icon icon-home"></i>Dashboard</a></li>
    <li><a href="profile.php"><i class="icon icon-user"></i>Profile</a></li>
    <li><a href="routine.php"><i class="icon icon-calendar"></i>Routine</a></li>
    <li><a href="members-list.php"><i class="icon icon-group"></i>Member's List</a></li>
    <li><a href="equipment-list.php"><i class="icon icon-cogs"></i>Equipment List</a></li>
    <li><a href="report.php"><i class="icon icon-file"></i> Progress Reports</a></li>
    <li><a href="member-progress.php"><i class="icon icon-signal"></i>Update Progress</a></li>   
    <li><a href="attendance.php"><i class="icon icon-check"></i>Manage Attendance</a></li>
    <li><a href="membership.php"><i class="icon icon-eye-open"></i>Membership Status</a></li>
    <li><a href="finance.php"><i class="icon icon-money"></i>Financial Report</a></li>
    <li><a href="../logout.php"><i class="icon icon-signout"></i>Log Out</a></li>
    </ul>
    
    </div>

             <?php include "dbcon.php";
              
                     $qry="SELECT * FROM staffs WHERE staff_id = '$user_id'";
                    $result=mysqli_query($con,$qry);
                   
              $cnt = 1;
            while($row=mysqli_fetch_array($result)){ ?>
<div class="main">
<header>
    <h2>Welcome <?php echo $row['fullname']; ?>&nbsp;<i class="icon icon-user"></i></h2>
</header>
</div>
<?php } ?>

    <li class="<?php if($page=='dashboard'){ echo 'active'; }?>"><a href="index.php"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>


