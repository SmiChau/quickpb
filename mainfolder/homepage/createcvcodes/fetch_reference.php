<?php
session_start();
include('connect.php');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in"]);
    exit;
}

$user_id = $_SESSION['user_id'];

$conn = new mysqli("localhost", "root", "", "quick_profile_builder");

$sql = "SELECT first_name, last_name, company, designation, phone, email FROM reference WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

$stmt->close();
$conn->close();

echo json_encode(["status" => "success", "data" => $data]);
?>
