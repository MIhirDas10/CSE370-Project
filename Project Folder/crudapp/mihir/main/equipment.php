<?php
// Include database connection
include 'connect.php';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['addEquipment'])) {
        // Add new equipment
        $name = $_POST['name'];
        $quantity = $_POST['quantity'];
        $vendor = $_POST['vendor'];
        $equip_id= $_POST['equip_id'];

        $insertQuery = $conn->prepare("INSERT INTO equipment (name, quantity, vendor) VALUES (?, ?, ?)");
        $insertQuery->bind_param("sis", $name, $quantity, $vendor);
        if ($insertQuery->execute()) {
            echo "<script>alert('Equipment added successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    } elseif (isset($_POST['updateEquipment'])) {
        // Update existing equipment
        $equip_id = $_POST['equip_id'];
        $name = $_POST['name'];
        $quantity = $_POST['quantity'];
        $vendor = $_POST['vendor'];

        $updateQuery = $conn->prepare("UPDATE equipment SET name = ?, quantity = ?, vendor = ? WHERE equip_id = ?");
        $updateQuery->bind_param("sisi", $name, $quantity, $vendor, $equip_id);
        if ($updateQuery->execute()) {
            echo "<script>alert('Equipment updated successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    } elseif (isset($_POST['deleteEquipment'])) {
        // Delete equipment
        $equip_id = $_POST['equip_id'];

        $deleteQuery = $conn->prepare("DELETE FROM equipment WHERE equip_id = ?");
        $deleteQuery->bind_param("i", $equip_id);
        if ($deleteQuery->execute()) {
            echo "<script>alert('Equipment deleted successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px 15px;
            background-color: #5cb85c;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Equipment Management</h2>
    <form method="POST">
        <div class="form-group">
            <label for="name">Equipment Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>
        </div>
        <div class="form-group">
            <label for="vendor">Vendor:</label>
            <input type="text" id="vendor" name="vendor" required>
        </div>
        <button type="submit" name="addEquipment">Add Equipment</button>
    </form>

    <h3>Existing Equipment</h3>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Vendor</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Fetch existing equipment
        $result = $conn->query("SELECT * FROM equipment");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['equip_id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>" . $row['vendor'] . "</td>";
                echo "<td>
                        <form method='POST' style='display:inline-block;'>
                            <input type='hidden' name='equip_id' value='" . $row['equip_id'] . "'>
                            <button type='submit' name='deleteEquipment'>Delete</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No equipment found.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
