<?php  
$connect = mysqli_connect("localhost", "root", "", "gym_system");  
$query = "SELECT gender, COUNT(*) as number FROM members GROUP BY gender";  
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
                ['Gender', 'Number'],  
                <?php  
                while ($row = mysqli_fetch_assoc($result)) {  
                    $gender = $row["gender"] === "Male" ? "Male" : ($row["gender"] === "Female" ? "Female" : "Other");
                    echo "['$gender', {$row["number"]}],";  
                }  
                ?>  
            ]);  

            var options = {  
                title: 'Gender Distribution Among Employees',  
                pieHole: 0.4  
            };  

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
            chart.draw(data, options);  
        }  
    </script>  
</head>  
<body>  
    <div style="width: 500px;">  
        <div id="piechart" style="width: 600px; height: 500px;"></div>  
    </div>  
</body>  
</html>
