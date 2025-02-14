<?php
session_start();
include 'connect.php';

if (isset($_POST['updateReview'])) {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $review_id = intval($_POST['review_id']);
        $rating = intval($_POST['rating']);
        $review = trim($_POST['review']);
        $photoPaths = [];

        // Check if the review belongs to the logged-in user
        $stmt = $conn->prepare("SELECT * FROM reviews WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $review_id, $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            echo "Unauthorized access!";
            exit();
        }

        // Handle photo uploads
        if (!empty($_FILES['photos']['name'][0])) {
            foreach ($_FILES['photos']['tmp_name'] as $key => $tmpName) {
                $fileName = basename($_FILES['photos']['name'][$key]);
                $targetFile = "uploads/" . $fileName;

                if (move_uploaded_file($tmpName, $targetFile)) {
                    $photoPaths[] = $targetFile;
                }
            }
        }

        $photos = implode(",", $photoPaths); // Convert array to comma-separated string

        // Update the review in the database
        if (!empty($photos)) {
            $stmt = $conn->prepare("UPDATE reviews SET rating = ?, review = ?, photos = ? WHERE id = ? AND user_id = ?");
            $stmt->bind_param("issii", $rating, $review, $photos, $review_id, $user_id);
        } else {
            $stmt = $conn->prepare("UPDATE reviews SET rating = ?, review = ? WHERE id = ? AND user_id = ?");
            $stmt->bind_param("isii", $rating, $review, $review_id, $user_id);
        }

        if ($stmt->execute()) {
            header("Location: review.php?update_success=1");
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Please log in to update your review.";
    }
}
?>
