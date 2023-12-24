<?php
    header('Content-Type: application/json');

    // Connect to the database
    $mysqli = new mysqli('localhost', 'root', 'password', 'doctors_db');

    if ($mysqli->connect_error) {
        die('{"error": "Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error . '"}');
    }

    // Fetch data from the database
    $sql = 'SELECT id, name, speciality FROM doctors';
    $result = $mysqli->query($sql);

    if (!$result) {
        die('{"error": "Error executing SQL query: ' . $mysqli->error . '"}');
    }

    // Convert the result set into a JSON array
    $doctors = [];
    while ($row = $result->fetch_assoc()) {
        $doctors[] = $row;
    }

    // Output the JSON array
    echo json_encode($doctors);

    // Close the database connection
    $mysqli->close();
?>
