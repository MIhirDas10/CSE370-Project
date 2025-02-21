<?php  
$connect = mysqli_connect("localhost", "root", "", "gym_system");  
$query = "SELECT services, COUNT(*) as number FROM subscription GROUP BY services";  
$result = mysqli_query($connect, $query);  
?>  
<!DOCTYPE html>  
<html>  
<head>  
    <title>Gender Distribution Pie Chart</title>  
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
    <script type="text/javascript">  
        google.charts.load('current', {'packages': ['corechart']});  
        google.charts.setOnLoadCallback(drawChart);  

        function drawChart() {  
            var data = google.visualization.arrayToDataTable([  
                ['Services', 'Number'],  
                <?php  
                while ($row = mysqli_fetch_assoc($result)) {  
                    $services = $row["services"] === "Cardio" ? "Cardio" : ($row["services"] === "Fitness" ? "Fitness" : "Other");
                    echo "['$services', {$row["number"]}],";  
                }  
                ?>  
            ]);  

            var options = {  
                title: 'Service Distribution Among Employees',  
                pieHole: 0.4  
            };  

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
            chart.draw(data, options);  
        }  
    </script>  
</head>  
<body>  
    <div style="width: 200px;">  
        <div id="piechart" style="width: 600px; height: 500px;"></div>  
    </div>  
</body>  
</html>
