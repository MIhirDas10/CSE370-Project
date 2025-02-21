<?php
// Define constants for database connection
define("HOSTNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE", "link_test"); // Update to use the 'link_test' database

// Establish database connection
$connection = mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch customer routines
$sql = "SELECT c.first_name, c.last_name, r.TS_8_10, r.TS_10_12, r.TS_12_2, r.TS_2_4, r.TS_4_6 
        FROM staffroutine r 
        JOIN staff_list c ON c.id = r.Cus_ID";
$result = mysqli_query($connection, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Routine</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Customer Routine</h1>
    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>8-10 AM</th>
                <th>10-12 PM</th>
                <th>12-2 PM</th>
                <th>2-4 PM</th>
                <th>4-6 PM</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                // Output data for each row
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
                    echo "<td>" . ($row['TS_8_10'] ? "✔" : "✘") . "</td>";
                    echo "<td>" . ($row['TS_10_12'] ? "✔" : "✘") . "</td>";
                    echo "<td>" . ($row['TS_12_2'] ? "✔" : "✘") . "</td>";
                    echo "<td>" . ($row['TS_2_4'] ? "✔" : "✘") . "</td>";
                    echo "<td>" . ($row['TS_4_6'] ? "✔" : "✘") . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<?php
// Close the database connection
mysqli_close($connection);
?>
