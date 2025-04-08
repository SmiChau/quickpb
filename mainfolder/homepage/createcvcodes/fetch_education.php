<?php
include('connect.php'); 
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
$conn = new mysqli("localhost", "root", "", "quick_profile_builder");

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Database connection failed: " . $conn->connect_error]));
}

header("Content-Type: application/json");

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in"]);
    exit;
}
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM education WHERE user_id = ? ORDER BY start_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$educationData = [];
while ($row = $result->fetch_assoc()) {
    $educationData[] = $row;
}

if (empty($educationData)) {
    echo json_encode(["status" => "error", "message" => "No education data found."]);
} else {
    echo json_encode(["status" => "success", "data" => $educationData]);
}

$stmt->close();
$conn->close();
?>