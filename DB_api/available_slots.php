<?php
    header('Content-Type: application/json');

    // Connect to the database
    $mysqli = new mysqli('localhost', 'root', 'password', 'doctors_db');

    if ($mysqli->connect_error) {
        die('{"error": "Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error . '"}');
    }

    // Check if date and doctor_id parameters are provided
    if (isset($_GET['date']) && isset($_GET['doctor_id'])) {
        $date = $_GET['date'];
        $doctorId = $_GET['doctor_id'];

        // Fetch available slots for the specified date and doctor_id
        $sql = "SELECT * FROM slots WHERE date = '$date' AND doctor_id = $doctorId AND booked = 1";
        $result = $mysqli->query($sql);

        if (!$result) {
            die('{"error": "Error executing SQL query: ' . $mysqli->error . '"}');
        }

        // Convert the result set into a JSON array
        $slots = [];
        while ($row = $result->fetch_assoc()) {
            $slots[] = $row;
        }

        // Output the JSON array
        echo json_encode($slots);
    } else {
        // Handle missing parameters
        echo '{"error": "Missing date or doctor_id parameters"}';
    }
    // Close the database connection
    $mysqli->close();
?>
