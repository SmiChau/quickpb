<?php
include('connect.php'); 
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
$conn = new mysqli("localhost", "root", "", "quick_profile_builder");
header("Content-Type: application/json");

// Check database connection
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Database connection failed: " . $conn->connect_error]));
}

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in"]);
    exit;
}
$user_id = $_SESSION['user_id']; 

// Debugging: Log received data
file_put_contents("debug_experience_log.txt", print_r($_POST, true));

if (empty($_POST)) {
    echo json_encode(["status" => "error", "message" => "No experience data received"]);
    exit;
}

// Parse experience data
$experiences = isset($_POST['experience']) ? $_POST['experience'] : [];

if (empty($experiences)) {
    echo json_encode(["status" => "error", "message" => "No data received"]);
    exit;
}

// Debugging: Log parsed experience data
file_put_contents("experience_data_log.txt", print_r($experiences, true));

// **DELETE old data only if new data exists**
$sql = "DELETE FROM experience WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->close();

// **INSERT new data**
$sql = "INSERT INTO experience (user_id, job_title, employer, location, start_date, end_date, description) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

foreach ($experiences as $experience) {
    $job_title = $experience['job_title'] ?? '';
    $employer = $experience['employer'] ?? '';
    $location = $experience['location'] ?? '';
    $start_date = $experience['start_date'] ?? '';
    $end_date = $experience['end_date'] ?? '';
    $description = $experience['description'] ?? '';

    $stmt->bind_param("issssss", $user_id, $job_title, $employer, $location, $start_date, $end_date, $description);
    $stmt->execute();
}

$stmt->close();
$conn->close();

echo json_encode(["status" => "success", "message" => "Experience data saved successfully!"]);
?>
