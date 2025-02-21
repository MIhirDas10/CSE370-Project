<?php
// Database connection setup
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user input
    $ini_weight = isset($_POST['ini_weight']) ? (float)$_POST['ini_weight'] : 0;
    $ini_bodytype = isset($_POST['ini_bodytype']) ? $conn->real_escape_string($_POST['ini_bodytype']) : '';
    $member_id = isset($_POST['member_id']) ? (int)$_POST['member_id'] : 0; // Assuming member_id is provided by the form

    if ($ini_weight > 0 && $ini_bodytype !== '' && $member_id > 0) {
        // Default values
        $curr_weight = $ini_weight;
        $curr_bodytype = $ini_bodytype;
        //$trainer_id = 3; // Default trainer_id
        $progress_date = date('Y-m-d');

        // CUSTOM LOGIC
        $id = $_POST['member_id'];
        $checkEmail="SELECT * From progress where progress_id='$member_id'";
        $result=$conn->query($checkEmail);
        if($result->num_rows>0){
            echo "
            // ----> EDIT HERE
            <div style='display: flex; justify-content: center; align-items: center; height: 200vh; font-family: Arial, sans-serif;'>
                <h2>Progress already done!</h2>
            </div>";
        }
        else{

        
        // Insert query
        $sql = "INSERT INTO progress (progress_id,ini_weight, curr_weight, ini_bodytype, curr_bodytype, progress_date) 
                VALUES (?, ?, ?, ?, ?, ?)";

        // Prepare and bind
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iddsss", $member_id, $ini_weight, $curr_weight, $ini_bodytype, $curr_bodytype, $progress_date);

        // Execute the query
        if ($stmt->execute()) {
            echo "Progress data inserted successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
        } 
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Progress</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            color: #555;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Enter Initial Progress Details</h2>
        <form method="POST">
            <label for="member_id">Member ID:</label>
            <input type="number" id="member_id" name="member_id" required><br>

            <label for="ini_weight">Initial Weight (kg):</label>
            <input type="number" step="0.1" id="ini_weight" name="ini_weight" required><br>

            <label for="ini_bodytype">Initial Body Type:</label>
            <select id="ini_bodytype" name="ini_bodytype" required>
                <option value="">Select Body Type</option>
                <option value="fat">Fat</option>
                <option value="slim">Slim</option>
                <option value="athletic">Athletic</option>
                <option value="average">Average</option>
            </select><br>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
