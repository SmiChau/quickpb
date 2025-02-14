<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid! Login to send message']);
    exit;
}

require 'connect.php'; 

// Get the logged-in user's ID and the message
$user_id = $_SESSION['user_id'];
$message = htmlspecialchars($_POST['message']);

// Insert the message into the database
$sql = "INSERT INTO messages (user_id, message) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $user_id, $message);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Message sent successfully!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to send the message. Please try again later.']);
}
?>
