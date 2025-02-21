<?php
session_start();
$st_id=$_SESSION['user_id'];
if(!isset($_SESSION['user_id'])){
  header('location:../index.php');	
}

include('dbcon.php');
 date_default_timezone_set('Asia/Dhaka');

   
   
   $current_date = date('Y-m-d h:i A');
   $exp_date_time = explode(' ', $current_date);
   $curr_date =  $exp_date_time['0'];
   $curr_time =  $exp_date_time['1']. ' ' .$exp_date_time['2'];   
   $flag = 1;
   $user_id = $_GET['id'];
   $sql = "INSERT INTO attendance (member_id, curr_date, curr_time, present)
   VALUES ('$user_id','$curr_date','$curr_time','$flag')";

 if ($con->query($sql) === TRUE) {  
  $attend = "select * from member_attendance where member_id = '$user_id'";
  $result_attend = $con->query($attend);
  $row_attend = mysqli_fetch_array($result_attend);
   $cnt = $row_attend['count'];
   $cnt = $cnt + 1;
  $sql1 = "update member_attendance set count ='$cnt' where member_id='$user_id'";
  $con->query($sql1);

      
     ?>
<script type="text/javascript">
window.location="../attendance.php";
</script>
<?php
} else {
   
      $_SESSION['error']='Something Went Wrong';
?>
<script type="text/javascript">
window.location="../attendance.php";
</script>
<?php
}

?>