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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="css/update1-progress.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="../css/matrix-style.css" />    
 <link rel="stylesheet"  href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"/>
<link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="../css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    


</head>
<body>
    <?php $page="dashboard"; include 'includes/navbar.php'?>
<h1 class="text" style="margin-left:680px; color:black; margin-top:40px;">Update Member's Progress <i class="icon icon-signal"></i></h1>
<br><br><br>
    <div class="update-profile">

<?php
include 'dbcon.php';
$id=$_GET['id'];
$qry= "select * from members join progress on members.member_id = progress.progress_id join subscription on progress.progress_id = subscription.sub_id where members.member_id='$id'";
$result=mysqli_query($con,$qry);
while($row=mysqli_fetch_array($result)){
?> 

<table class='table'>
    <thead>       
        <tr>
            <th>Details</th>
            <th>Progress</th>
            </tr>
        
    </thead>
    
    <form action="userprogress-req.php" method="POST">
        
        <tbody>
        <td>Member's Fullname:</td>
        <td><strong><?php echo $row['fullname']; ?></strong></td>
            </tbody>
        <tbody>
        <td>Service Taken:</td>
        <td><strong><?php echo $row['services']; ?></strong></td>
        </tbody>
        <tbody>
        <td>Initial Weight: (KG)</td>
        <td><input id="weight" type="number" name="ini_weight" value='<?php echo $row['ini_weight']; ?>' /></td>
        </tbody>
        <tbody>
        <td>Current Weight: (KG)</td>
        <td><input id="weight" type="number" name="curr_weight" value='<?php echo $row['curr_weight']; ?>' /></td>
        </tbody>
        <tbody>
        <td>Initial Body Type:</td>
        <td><input id="ini_bodytype" type="text" name="ini_bodytype" value='<?php echo $row['ini_bodytype']; ?>' /></td>
        </tbody>
        <tbody>
        <td>Current Body Type:</td>
        <td><input id="curr_bodytype" type="text" name="curr_bodytype" value='<?php echo $row['curr_bodytype']; ?>' /></td>
        </tbody>
        </table>      
          <br> <br>     
    <input type="hidden" name="id" value="<?php echo $row['member_id'];?>">
     <button class="btn" type="SUBMIT" href="">Save Changes</button> 
				
                
                
  	
        
    </form>
    <br>

        <a href="member-prog%20trainer.php">
            <button class="btn1">Go Back</button> </a>

    
<?php
}
    ?>

<script src="../js/excanvas.min.js"></script> 
<script src="../js/jquery.min.js"></script> 
<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/jquery.flot.min.js"></script> 
<script src="../js/jquery.flot.resize.min.js"></script> 
<script src="../js/jquery.peity.min.js"></script> 
<script src="../js/fullcalendar.min.js"></script> 
<script src="../js/matrix.js"></script> 
<script src="../js/matrix.dashboard.js"></script> 
<script src="../js/jquery.gritter.min.js"></script> 
<script src="../js/matrix.interface.js"></script> 
<script src="../js/matrix.chat.js"></script> 
<script src="../js/jquery.validate.js"></script> 
<script src="../js/matrix.form_validation.js"></script> 
<script src="../js/jquery.wizard.js"></script> 
<script src="../js/jquery.uniform.js"></script> 
<script src="../js/select2.min.js"></script> 
<script src="../js/matrix.popover.js"></script> 
<script src="../js/jquery.dataTables.min.js"></script> 
<script src="../js/matrix.tables.js"></script> 


</body>
</html>