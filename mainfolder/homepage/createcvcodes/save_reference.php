<?php
include('connect.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    exit;
}

$user_id = $_SESSION['user_id'];
$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$company = $_POST['company'] ?? '';
$designation = $_POST['designation'] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? '';

if (empty($first_name) || empty($last_name) || empty($company) || empty($designation) || empty($phone) || empty($email)) {
    exit;
}

try {
    $conn = new mysqli("localhost", "root", "", "quick_profile_builder");

    // Check if the user already has a reference entry
    $sql = "SELECT id FROM reference WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Update existing reference
        $updateSql = "UPDATE reference SET first_name = ?, last_name = ?, company = ?, designation = ?, phone = ?, email = ? WHERE user_id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ssssssi", $first_name, $last_name, $company, $designation, $phone, $email, $user_id);
        $updateStmt->execute();
        $updateStmt->close();
    } else {
        // Insert new reference
        $insertSql = "INSERT INTO reference (user_id, first_name, last_name, company, designation, phone, email) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("issssss", $user_id, $first_name, $last_name, $company, $designation, $phone, $email);
        $insertStmt->execute();
        $insertStmt->close();
    }

    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    error_log("Error: " . $e->getMessage());
}
?>
