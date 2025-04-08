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
file_put_contents("debug_log.txt", print_r($_POST, true));

if (empty($_POST)) {
    echo json_encode(["status" => "error", "message" => "No education data received"]);
    exit;
}

// Parse education data
$educations = isset($_POST['education']) ? $_POST['education'] : [];

if (empty($educations)) {
    echo json_encode(["status" => "error", "message" => "No data received"]);
    exit;
}

// Debugging: Log parsed education data
file_put_contents("education_data_log.txt", print_r($educations, true));

// **DELETE old data only if new data exists**
$sql = "DELETE FROM education WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->close();

// **INSERT new data**
$sql = "INSERT INTO education (user_id, degree, school, city, start_date, graduation_date, description) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

foreach ($educations as $education) {
    $degree = $education['degree'] ?? '';
    $school = $education['school'] ?? '';
    $city = $education['city'] ?? '';
    $start_date = $education['start_date'] ?? '';
    $graduation_date = $education['graduation_date'] ?? '';
    $description = $education['description'] ?? '';

    $stmt->bind_param("issssss", $user_id, $degree, $school, $city, $start_date, $graduation_date, $description);
    $stmt->execute();
}

$stmt->close();
$conn->close();

echo json_encode(["status" => "success", "message" => "Education data saved successfully!"]);
?>