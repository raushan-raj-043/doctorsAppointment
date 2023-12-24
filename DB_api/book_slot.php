<?php
    header('Content-Type: application/json');

    // Enable error reporting for debugging purposes (remove in production)
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Get data from the POST request
    $data = json_decode(file_get_contents('php://input'), true);

        // Get data from the query parameters
    $date = isset($_GET['date']) ? $_GET['date'] : '';
    $doctorid = isset($_GET['doctorid']) ? intval($_GET['doctorid']) : 0;
    $time = isset($_GET['time']) ? $_GET['time'] : '';
    $userid = isset($_GET['userid']) ? intval($_GET['userid']) : 0;

    // Check if required fields are present
    if (empty($date) || $doctorid === 0 || empty($time) || $userid === 0) {
        die(json_encode(['error' => 'Invalid input data']));
    }

    // Connect to the database (replace with your actual database connection logic)
    $mysqli = new mysqli('localhost', 'root', 'password', 'doctors_db');

    if ($mysqli->connect_error) {
        die(json_encode(['error' => 'Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error]));
    }

    // Use prepared statements to prevent SQL injection
    $sqlBooking = "INSERT INTO booking (user_id, doctor_id, time, date) VALUES (?, ?, ?, ?)";
    $stmtBooking = $mysqli->prepare($sqlBooking);

    if (!$stmtBooking) {
        die(json_encode(['error' => 'Prepare failed: (' . $mysqli->errno . ') ' . $mysqli->error]));
    }

    $stmtBooking->bind_param('iiss', $userid, $doctorid, $time, $date);
    $resultBooking = $stmtBooking->execute();

    if (!$resultBooking) {
        die(json_encode(['error' => 'Error executing booking SQL query: (' . $stmtBooking->errno . ') ' . $stmtBooking->error]));
    }

    // Use prepared statements for the update as well
    $sqlUpdateSlot = "INSERT INTO slots (doctor_id, time, date, booked) VALUES (?, ?, ?, 1)";
    $stmtUpdateSlot = $mysqli->prepare($sqlUpdateSlot);

    if (!$stmtUpdateSlot) {
        die(json_encode(['error' => 'Prepare failed: (' . $mysqli->errno . ') ' . $mysqli->error]));
    }

    $stmtUpdateSlot->bind_param('iss', $doctorid, $time, $date);
    $resultUpdateSlot = $stmtUpdateSlot->execute();

    if (!$resultUpdateSlot) {
        die(json_encode(['error' => 'Error updating slot SQL query: (' . $stmtUpdateSlot->errno . ') ' . $stmtUpdateSlot->error]));
    }

    // Close the prepared statements
    $stmtBooking->close();
    $stmtUpdateSlot->close();

    // Close the database connection
    $mysqli->close();

    // Return a success response
    $response = ['success' => true, 'message' => 'Booking and slot updated successfully'];
    echo json_encode($response);
?>
