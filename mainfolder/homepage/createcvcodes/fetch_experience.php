<?php
include('connect.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Enable MySQLi error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Establish database connection
    $conn = new mysqli("localhost", "root", "", "quick_profile_builder");

    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(["status" => "error", "message" => "User not logged in"]);
        exit;
    }

    $user_id = $_SESSION['user_id'];

    // Fetch experience data from the database
    $sql = "SELECT * FROM experience WHERE user_id = ? ORDER BY start_date DESC LIMIT 1"; // Fetch the latest entry
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Log the fetched data for debugging
        error_log(print_r($row, true));
        echo json_encode($row);
    } else {
        echo json_encode(["status" => "error", "message" => "No work experience found"]);
    }

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    // Log any exceptions
    error_log("Error: " . $e->getMessage());
    echo json_encode(["status" => "error", "message" => "An error occurred: " . $e->getMessage()]);
}
?>
