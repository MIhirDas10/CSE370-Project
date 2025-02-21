<?php
$conn = new mysqli("localhost", "root", "", "gym_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['add_routine'])) {
    $sta_id = $_POST['Sta_ID'];
    $ts_8_10 = isset($_POST['TS_8_10']) ? 1 : 0;
    $ts_10_12 = isset($_POST['TS_10_12']) ? 1 : 0;
    $ts_12_2 = isset($_POST['TS_12_2']) ? 1 : 0;
    $ts_2_4 = isset($_POST['TS_2_4']) ? 1 : 0;
    $ts_4_6 = isset($_POST['TS_4_6']) ? 1 : 0;

    $check_staff_query = "SELECT staff_id FROM staffs WHERE staff_id = ?";
    $stmt = $conn->prepare($check_staff_query);
    $stmt->bind_param("i", $sta_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die("Error: Invalid Staff ID.");
    }

    $insert_query = "INSERT INTO staffRoutine (Sta_ID, TS_8_10, TS_10_12, TS_12_2, TS_2_4, TS_4_6) 
                     VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("iiiiii", $sta_id, $ts_8_10, $ts_10_12, $ts_12_2, $ts_2_4, $ts_4_6);

    if ($stmt->execute()) {
        echo "Routine added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
}
$conn->close();
?>
