<?php
include 'dbcon.php';
session_start();
$user_id = $_SESSION['user_id'];
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
<link rel="stylesheet" href="css/routine-style.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="../css/matrix-style.css" />    
 <link rel="stylesheet"  href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"/>
<link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="../css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>


</head>
    <body> 
        
                <?php $page="dashboard"; include 'includes/navbar.php'?>
    <h1 class="text" style="margin-left:740px; color:black; margin-top:40px;">My Routine <i class="icon icon-calendar"></i></h1>
        <br><br><br>
        
                  <table class='table'>
              <thead>
                <tr>
                  <th>Time</th>                  
                  <th>Sunday</th>
                  <th>Monday</th>
                  <th>Tuesday</th>
                  <th>Wednesday</th>
                  <th>Thursday</th>
                       <th>Friday</th>           
                    <th>Saturday</th>
                </tr>
              </thead>
                      
                      
                           <?php

      include "dbcon.php";
      $qry="select * from staffroutine WHERE Sta_ID = '$user_id'";      
        $result=mysqli_query($con,$qry);
        
                      
                               while($row=mysqli_fetch_array($result)){?>
            
           <tbody>                
                <td><div class='text-center'>08:00AM-10:00AM</div></td>              
               <td><div class='text-center'><?php if( $row['TS_8_10'] == '0' ){ echo '<i class="fas fa-x" style="color:red;"></i>';} else { echo '<i class="fas fa-check" style="color:green;"></i>';}?></div></td>
           <td><div class='text-center'><?php if( $row['TS_8_10'] == '0' ){ echo '<i class="fas fa-x" style="color:red;"></i>';} else { echo '<i class="fas fa-check" style="color:green;"></i>';}?></div></td>
          <td><div class='text-center'><?php if( $row['TS_8_10'] == '0' ){ echo '<i class="fas fa-x" style="color:red;"></i>';} else { echo '<i class="fas fa-check" style="color:green;"></i>';}?></div></td>
          <td><div class='text-center'><?php if( $row['TS_8_10'] == '0' ){ echo '<i class="fas fa-x" style="color:red;"></i>';} else { echo '<i class="fas fa-check" style="color:green;"></i>';}?></div></td>
          <td><div class='text-center'><?php if( $row['TS_8_10'] == '0' ){ echo '<i class="fas fa-x" style="color:red;"></i>';} else { echo '<i class="fas fa-check" style="color:green;"></i>';}?></div></td>
          <td><div class='text-center'></div><i class="fas fa-x" style="color:red;"></i></td>
               <td><div class='text-center'></div><i class="fas fa-x" style="color:red;"></i></td>
              </tbody>
            <tbody>                
                <td><div class='text-center'>10:00AM-12:00PM</div></td>
               <td><div class='text-center'><?php if( $row['TS_10_12'] == '0' ){ echo '<i class="fas fa-x" style="color:red;"></i>';} else { echo '<i class="fas fa-check" style="color:green;"></i>';}?></div></td>
               <td><div class='text-center'><?php if( $row['TS_10_12'] == '0' ){ echo '<i class="fas fa-x" style="color:red;"></i>';} else { echo '<i class="fas fa-check" style="color:green;"></i>';}?></div></td>
               <td><div class='text-center'><?php if( $row['TS_10_12'] == '0' ){ echo '<i class="fas fa-x" style="color:red;"></i>';} else { echo '<i class="fas fa-check" style="color:green;"></i>';}?></div></td>
               <td><div class='text-center'><?php if( $row['TS_10_12'] == '0' ){ echo '<i class="fas fa-x" style="color:red;"></i>';} else { echo '<i class="fas fa-check" style="color:green;"></i>';}?></div></td>
               <td><div class='text-center'><?php if( $row['TS_10_12'] == '0' ){ echo '<i class="fas fa-x" style="color:red;"></i>';} else { echo '<i class="fas fa-check" style="color:green;"></i>';}?></div></td>
                <td><div class='text-center'></div><i class="fas fa-x" style="color:red;"></i></td>
                <td><div class='text-center'></div><i class="fas fa-x" style="color:red;"></i></td>
              </tbody>
                    <tbody>                
                <td><div class='text-center'>12:00PM-02:00PM</div></td>  
               <td><div class='text-center'><?php if( $row['TS_12_2'] == '0' ){ echo '<i class="fas fa-x" style="color:red;"></i>';} else { echo '<i class="fas fa-check" style="color:green;"></i>';}?></div></td>
               <td><div class='text-center'><?php if( $row['TS_12_2'] == '0' ){ echo '<i class="fas fa-x" style="color:red;"></i>';} else { echo '<i class="fas fa-check" style="color:green;"></i>';}?></div></td>
               <td><div class='text-center'><?php if( $row['TS_12_2'] == '0' ){ echo '<i class="fas fa-x" style="color:red;"></i>';} else { echo '<i class="fas fa-check" style="color:green;"></i>';}?></div></td>
               <td><div class='text-center'><?php if( $row['TS_12_2'] == '0' ){ echo '<i class="fas fa-x" style="color:red;"></i>';} else { echo '<i class="fas fa-check" style="color:green;"></i>';}?></div></td>
               <td><div class='text-center'><?php if( $row['TS_12_2'] == '0' ){ echo '<i class="fas fa-x" style="color:red;"></i>';} else { echo '<i class="fas fa-check" style="color:green;"></i>';}?></div></td>
                        <td><div class='text-center'></div><i class="fas fa-x" style="color:red;"></i></td>
                        <td><div class='text-center'></div><i class="fas fa-x" style="color:red;"></i></td>
              </tbody>
                        
                    <tbody>                
                <td><div class='text-center'>02:00PM-04:00PM</div></td>
               <td><div class='text-center'><?php if( $row['TS_2_4'] == '0' ){ echo '<i class="fas fa-x" style="color:red;"></i>';} else { echo '<i class="fas fa-check" style="color:green;"></i>';}?></div></td>
               <td><div class='text-center'><?php if( $row['TS_2_4'] == '0' ){ echo '<i class="fas fa-x" style="color:red;"></i>';} else { echo '<i class="fas fa-check" style="color:green;"></i>';}?></div></td>
                <td><div class='text-center'><?php if( $row['TS_2_4'] == '0' ){ echo '<i class="fas fa-x" style="color:red;"></i>';} else { echo '<i class="fas fa-check" style="color:green;"></i>';}?></div></td>
               <td><div class='text-center'><?php if( $row['TS_2_4'] == '0' ){ echo '<i class="fas fa-x" style="color:red;"></i>';} else { echo '<i class="fas fa-check" style="color:green;"></i>';}?></div></td>
               <td><div class='text-center'><?php if( $row['TS_2_4'] == '0' ){ echo '<i class="fas fa-x" style="color:red;"></i>';} else { echo '<i class="fas fa-check" style="color:green;"></i>';}?></div></td>
                        <td><div class='text-center'></div><i class="fas fa-x" style="color:red;"></i></td>
                        <td><div class='text-center'></div><i class="fas fa-x" style="color:red;"></i></td>
              </tbody>
            <tbody>       
                
                <td><div class='text-center'>04:00PM-06:00PM</div></td>
           <td><div class='text-center'><?php if( $row['TS_4_6'] == '0' ){ echo '<i class="fas fa-x" style="color:red;"></i>';} else { echo '<i class="fas fa-check" style="color:green;"></i>';}?></div></td>
           <td><div class='text-center'><?php if( $row['TS_4_6'] == '0' ){ echo '<i class="fas fa-x" style="color:red;"></i>';} else { echo '<i class="fas fa-check" style="color:green;"></i>';}?></div></td>  
           <td><div class='text-center'><?php if( $row['TS_4_6'] == '0' ){ echo '<i class="fas fa-x" style="color:red;"></i>';} else { echo '<i class="fas fa-check" style="color:green;"></i>';}?></div></td>  
           <td><div class='text-center'><?php if( $row['TS_4_6'] == '0' ){ echo '<i class="fas fa-x" style="color:red;"></i>';} else { echo '<i class="fas fa-check" style="color:green;"></i>';}?></div></td>  
           <td><div class='text-center'><?php if( $row['TS_4_6'] == '0' ){ echo '<i class="fas fa-x" style="color:red;"></i>';} else { echo '<i class="fas fa-check" style="color:green;"></i>';}?></div></td>  
                <td><div class='text-center'></div><i class="fas fa-x" style="color:red;"></i></td>
                <td><div class='text-center'></div><i class="fas fa-x" style="color:red;"></i></td>

              </tbody>
          <?php
       }
            ?>   


                     
                      
        </table>
        
       
        
        
        
        
        
    </body>
</html>