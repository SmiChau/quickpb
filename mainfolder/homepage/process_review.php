<?php
session_start();
include 'connect.php';

if (isset($_POST['submitReview'])) {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Ensure rating is an integer between 1 and 5
        if (isset($_POST['rating'])) {
            $rating = intval($_POST['rating']);
            if ($rating < 1 || $rating > 5) {
                echo "Invalid rating. Please select a rating between 1 and 5.";
                exit;
            }
        } else {
            echo "Please select a rating.";
            exit;
        }

        // Sanitize and clean the review text
        $review = trim($_POST['review']);
        if (empty($review)) {
            echo "Review text cannot be empty.";
            exit;
        }

        // Handle photo uploads
        $photoPaths = [];
        if (!empty($_FILES['photos']['name'][0])) {
            foreach ($_FILES['photos']['tmp_name'] as $key => $tmpName) {
                $fileName = basename($_FILES['photos']['name'][$key]);
                $targetFile = "uploads/" . $fileName;

                if (move_uploaded_file($tmpName, $targetFile)) {
                    $photoPaths[] = $targetFile;
                } else {
                    echo "Error uploading photo: " . $_FILES['photos']['name'][$key];
                    exit;
                }
            }
        }

        $photos = implode(",", $photoPaths); // Convert array to comma-separated string

        // Insert the review into the database
        $stmt = $conn->prepare("INSERT INTO reviews (user_id, rating, review, photos) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $user_id, $rating, $review, $photos);

        if ($stmt->execute()) {
            header("Location: review.php?message=success");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Please log in to submit a review.";
    }
}
?>
