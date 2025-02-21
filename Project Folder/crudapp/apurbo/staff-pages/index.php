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
<link rel="stylesheet" href="css/dashboard-style.css?v=<?php echo time(); ?>">

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
    
    

<link rel="stylesheet" href="../css/matrix-style.css" />
    
 <link rel="stylesheet"  href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"/>

<link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="../css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
    <body>


<?php $page="dashboard"; include 'includes/navbar.php'?>

<section class="main">    
    <div class="main-skills">
        <div class="card1">
        <i class="fas fa-user-check"></i>
            <h3>Active Members</h3>
        <p><strong><?php include'actions/dashboard-activecount.php' ?></strong></p>
        </div>
        <div class="card2">
           <i class="fas fa-user-clock"></i>
                    <h3>Staff Users</h3>
        <p><strong><?php include 'actions/dashboard-staff-count.php';?></strong></p>
        </div>
                <div class="card3">
       <i class="fas fa-calendar-check"></i>
            <h3>Present Members</h3>
        <p><strong><?php include 'actions/count-attendance.php';?></strong></p>
        </div>
                 <div class="card4">
        <i class="fas fa-user-ninja"></i>
            <h3>Active Trainers</h3>
        <p><strong><?php include 'actions/count-trainers.php' ?></strong></p>
        </div>
        
  



        </div>        
        </section>        

        
    <?php    
        
        include "dbcon.php";
$qry="SELECT services, count(*) as number FROM subscription GROUP BY services";
$result=mysqli_query($con,$qry);
        ?>
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
           <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Services', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["services"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: 'Percentage of Services taken by GYM Members',  
                      //is3D:true,  
                      pieHole: 0.0 
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }  
           </script>         

             <div class="charts">                          
            <div id="top_x_div" style="height:200px; margin-left:300px; border: 1px solid black; box-shadow: 0 20px 35px rgba(0,0,0,0.1);"></div>      
                <div id="piechart" style="width:550px; border: 1px solid black; height:200px; margin-left:70px; box-shadow: 0 20px 35px rgba(0,0,0,0.1);"></div>  
            </div>

    
        <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Gender', 'Total Numbers'],


          <?php
            $query="SELECT gender, count(*) as number FROM members GROUP BY gender";
            $res=mysqli_query($con,$query);
            while($data=mysqli_fetch_array($res)){
              $services=$data['gender'];
              $number=$data['number'];
           ?>
           ['<?php echo $services;?>',<?php echo $number;?>],   
           <?php   
            }
           ?> 

          
        ]);

        var options = {
          // title: 'Chess opening moves',
          width: 550,
          legend: { position: 'none' },
          // chart: { title: 'Chess opening moves',
          //          subtitle: 'popularity by percentage' },
          bars: 'vertical', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'GYM Members by Gender: Overview'} // Top x-axis.
            }
          },
          bar: { groupWidth: "100%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, options);
      };


      
    </script>
        <br>

<div class="scrollable-table">
    
    <table class="table">
        <thead>
            <tr>
                <th>Gym Announcements&nbsp;<i class="fas fa-bullhorn"></i></th>

            </tr>
        </thead>
        <tbody class="tbody-scroll">
            
                <tr>
                    <td class="text-center">
                    
                 <?php

                include "dbcon.php";
                $qry="select * from announcements";
                  $result=mysqli_query($conn,$qry);
            while($row=mysqli_fetch_array($result)){
                
                                  echo"<span class='user-info'>By: System Administrator / Date: ".$row['date']." </span>";
                                  echo"<p>".$row['message']." </p>";
                
                echo"<br>";                 
                }
            
                
             ?>                     
                    
            </td>
            </tr>        
            
        </tbody>
    </table>
</div>
        
     <div class="scrollable-table1">   
        <table class="table">
          <thead>
            <tr>
                <th>Member's To-Do Lists&nbsp;<i class="icon-tasks"></i></th>

            </tr>
        </thead>
          
<tbody class="tbody-scroll">
            
                <tr>
                    <td class="text-center">
              <?php
                echo"<br>";
                include "dbcon.php";
                $qry="SELECT * FROM todo";
                $result=mysqli_query($conn,$qry);

                while($row=mysqli_fetch_array($result)){ ?>

                
                                                                        
                    <div class='txt'> <?php echo $row["task_desc"]?> <?php if ($row["task_status"] == "Pending") { echo '<span class="badge-important">Pending</span>';} else { echo '<span class="badge-success">In Progress</span>'; }?></div>
                
               <?php 
                    echo"<br>";}
                
              
              ?>
                          
            </td>
            </tr>        
            
        </tbody>
    </table>
        </div>
     
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