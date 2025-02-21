<?php
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
<link rel="stylesheet" href="css/report.css?v=<?php echo time(); ?>">

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
    
<link rel="stylesheet" href="../css/matrix-style.css" />
    
 <link rel="stylesheet"  href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"/>

<link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="../css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
    <body>
<?php $page="dashboard"; include 'includes/navbar.php'?>
        <h1 class="text" style="margin-left:685px; color:black; margin-top:40px;">Overall Progress Report <i class="icon icon-file"></i></h1>
    <?php    
        
        include "dbcon.php";

        ?>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
 
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['ID', 'weight variation, %'],
           
          //PHP Code 
          <?php
            
              $query="select * from progress";
              $res=mysqli_query($con,$query);
              while($data=mysqli_fetch_array($res)){
                $iD=$data['progress_id'];
                $weigh=(($data['curr_weight']-$data['ini_weight'])/$data['ini_weight'])*100;
               
          ?>  
           ['<?php echo $iD;?>',<?php echo floor(abs($weigh));?>], 
          <?php      
              }
 
          ?> 
  
        ]);
 
        var options = {
          title: "GYM Members Report: Overview",
          curveType: 'function',
          legend: { position: 'bottom' }
        };
 
        var chart = new google.visualization.LineChart (document.getElementById('curve_chart'));
 
        chart.draw(data, options);
      }
    </script>
<div class="charts">
    <div id="curve_chart" style="width: 700px; height: 300px; margin-left:500px;  border: 1px solid black; box-shadow: 0 20px 35px rgba(0,0,0,0.1);"></div>
        
     </div>   <br><br>
        <a href="report.php">
            <button class="btn1">Go Back</button> </a>
    </body>
    
</html>