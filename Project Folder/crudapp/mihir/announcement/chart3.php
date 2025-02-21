<?php
$conn = new mysqli("localhost", "root", "", "gym_system");

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
?> 
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Loan', 'Expenses', 'Tax', 'Profit'],
          <?php
            $query = "
              SELECT s.p_year, 
                     SUM(s.amount) AS profit, 
                     SUM(e.amount) AS expenses
              FROM subscription s
              LEFT JOIN equipment e ON e.id = e.id  -- Assuming there's a relationship between equipment and subscription
              GROUP BY s.p_year";
            
            $res = mysqli_query($conn, $query);
            while($data = mysqli_fetch_array($res)) {
              $tax = '100';
              $loan = '100';
              $year = $data['p_year'];
              $profit = $data['profit'];
              $expenses = $data['expenses'];
              
              // Default values for loan and tax
              $loan = 0;  // Default loan value
              $tax = 0;   // Default tax value
          ?>
           ['<?php echo $year; ?>', <?php echo $loan; ?>, <?php echo $expenses; ?>, <?php echo $tax; ?>, <?php echo $profit; ?>],   
           <?php   
            }
           ?> 
        ]);

        var options = {
          chart: {
            title: 'Company Performance',
            subtitle: 'Loan, Expenses, Tax and Profit: 2014-2017',
          },
          bars: 'vertical' // Required for Material Bar Charts.
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>
  <body>
    <div id="barchart_material" style="width: 900px; height: 500px;"></div>
  </body>
</html>
