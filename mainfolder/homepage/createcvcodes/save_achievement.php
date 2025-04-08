<?php
include('connect.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    exit;
}

$user_id = $_SESSION['user_id'];
$title = $_POST['title'] ?? '';
$description = $_POST['description'] ?? '';

if (empty($title) || empty($description)) {
    exit;
}

try {
    $conn = new mysqli("localhost", "root", "", "quick_profile_builder");

    // Check if achievement already exists
    $sql = "SELECT id FROM achievements WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Update existing record
        $updateSql = "UPDATE achievements SET title = ?, description = ? WHERE user_id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ssi", $title, $description, $user_id);
        $updateStmt->execute();
        $updateStmt->close();
    } else {
        // Insert new record
        $insertSql = "INSERT INTO achievements (user_id, title, description) VALUES (?, ?, ?)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("iss", $user_id, $title, $description);
        $insertStmt->execute();
        $insertStmt->close();
    }

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    error_log("Error: " . $e->getMessage());
}
?>
