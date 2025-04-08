<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]);
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT skill_name, skill_level FROM skills WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$skills = [];
while ($row = $result->fetch_assoc()) {
    $skills[] = $row;
}

echo json_encode($skills);
?>
