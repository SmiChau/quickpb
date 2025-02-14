<?php
session_start();
include 'connect.php';

if (isset($_GET['id']) && isset($_SESSION['user_id'])) {
    $review_id = intval($_GET['id']);
    $user_id = $_SESSION['user_id'];

    // Check if the review belongs to the logged-in user
    $stmt = $conn->prepare("DELETE FROM reviews WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $review_id, $user_id);

    if ($stmt->execute()) {
        header("Location: review.php?delete_success=1");
    } else {
        echo "Error deleting review.";
    }
}
?>
