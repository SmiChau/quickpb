<?php
include('connect.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]);
    exit;
}

$user_id = $_SESSION['user_id'];

try {
    $conn = new mysqli("localhost", "root", "", "quick_profile_builder");

    $sql = "SELECT title, description FROM achievements WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo json_encode($row);
    } else {
        echo json_encode([]);
    }

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    error_log("Error: " . $e->getMessage());
    echo json_encode([]);
}
?>
