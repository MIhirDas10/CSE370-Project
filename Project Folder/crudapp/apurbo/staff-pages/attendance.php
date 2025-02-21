<?php
session_start();
//the isset function to check username is already loged in and stored on the session
if(!isset($_SESSION['user_id'])){
header('location:../index.php');	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Gym System Staff A/C</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="css/attendance.css?v=<?php echo time(); ?>">


<link rel="stylesheet" href="../css/matrix-style.css" />
    
 <link rel="stylesheet"  href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"/>

<link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="../css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<body>


	          <?php $page="dashboard"; include 'includes/navbar.php'?>
    <h1 class="text" style="margin-left:715px; color:black; margin-top:40px;">Manage Attendance <i class="icon icon-check"></i></h1>
        <br><br><br>
    <div class="scrollable-table">
	  <?php

      include "dbcon.php";
     

        
          echo"<table class='table'>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Fullname</th>
                  <th>Contact Number</th>
                  <th>Choosen Service</th>
                  <th>Action</th>
                </tr>
              </thead>";

              date_default_timezone_set('Asia/Dhaka');
              //$current_date = date('Y-m-d h:i:s');
                 $current_date = date('Y-m-d h:i A');
                $exp_date_time = explode(' ', $current_date);
                 $todays_date =  $exp_date_time['0'];
                     $qry="select * from members join subscription on members.member_id = subscription.sub_id WHERE status = 'Active'";
                    $result=mysqli_query($con,$qry);
                   $i=1;
                   $cnt = 1;
              
            while($row=mysqli_fetch_array($result)){ ?>
            
           <tbody> 
               
                <td><div class='text-center'><?php echo $cnt; ?></div></td>
                <td><div class='text-center'><?php echo $row['fullname']; ?></div></td>
                <td><div class='text-center'><?php echo $row['contact']; ?></div></td>
                <td><div class='text-center'><?php echo $row['services']; ?></div></td>

                <input type="hidden" name="user_id" value="<?php echo $row['member_id'];?>">

            <?php
                $qry = "select * from attendance where curr_date = '$todays_date' AND member_id = '".$row['member_id']."'";
                $res = $con->query($qry);
                $num_count  = mysqli_num_rows($res);
                $row_exist = mysqli_fetch_array($res);
                if($num_count>0){
                    $curr_date = $row_exist['curr_date'];
                }
                else{
                    $curr_date=null;
                }
                if($curr_date == $todays_date){
  
    ?>
                <td><div class='text-box'><span class="label"><?php echo $row_exist['curr_date'];?>  <?php echo $row_exist['curr_time'];?></span></div>
                <div class='text-center'><a href='actions/delete-attendance.php?id=<?php echo $row['member_id'];?>'><button class='btn-danger'>Check Out <i class='icon icon-time'></i></button> </a></div>
                </td>

              <?php $cnt++;} else {
                  
                  ?>

                <td><a href='actions/check-attendance.php?id=<?php echo $row['member_id'];?>'><button class='btn-info'>Check In <i class='icon icon-map-marker'></i></button> </a></td>
             
                <?php $cnt++; }

              ?>

              </tbody>

           <?php } ?>
           

            </table>
    </div>
    <br>
    <a href="view-attendance.php">
            <button class="btn">View Attendance</button> </a>


<script src="../js/jquery.min.js"></script> 
<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script>  
<script src="../js/matrix.js"></script> 
<script src="../js/jquery.validate.js"></script> 
<script src="../js/jquery.uniform.js"></script> 
<script src="../js/select2.min.js"></script> 
<script src="../js/jquery.dataTables.min.js"></script> 
<script src="../js/matrix.tables.js"></script> 


</body>
</html>
