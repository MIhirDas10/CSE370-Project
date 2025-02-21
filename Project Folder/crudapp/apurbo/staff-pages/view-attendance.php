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
</head>
<body>

	          <?php $page="dashboard"; include 'includes/navbar.php'?>
    <h1 class="text" style="margin-left:735px; color:black; margin-top:40px;">Attendance List <i class="icon icon-check"></i></h1>
        <br><br><br>
	  


         <div class="scrollable-table">
        
          <table class='table'>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Fullname</th>
                  <th>Plan</th>
                  <th>Attendance Count</th> 
                </tr>
              </thead>

             <?php include "dbcon.php";
              
                     $qry="select * from members join subscription on members.member_id = subscription.sub_id join member_attendance on member_attendance.member_id = members.member_id WHERE status = 'Active'";
                    $result=mysqli_query($con,$qry);
                   
              $cnt = 1;
            while($row=mysqli_fetch_array($result)){ ?>
            
           <tbody> 
               
                <td><div class='text-center'><?php echo $cnt; ?></div></td>
                <td><div class='text-center'><?php echo $row['fullname']; ?></div></td>
                <td><div class='text-center'><?php if($row['plan'] == 1) { echo $row['plan']. ' Month';} else if($row['plan'] == '0') { echo'Expired';} else { echo $row['plan']. ' Months'; } ?></div></td>
                <td><div class='text-center'><?php if($row['count'] == 1) { echo $row['count']. ' Day';} else if($row['count'] == '0') { echo 0;} else { echo $row['count']. ' Days'; } ?>  </div></td>
              </tbody>
           <?php $cnt++; } ?>
           

            </table>
             </div>

    <br>
    <a href="attendance.php">
            <button class="btn1">Go Back</button> </a>


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
