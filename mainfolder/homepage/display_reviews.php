<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="display_reviews.css">
</head>
<body>
<?php
include 'connect.php';

// Check if the user is logged in

$current_user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Fetch all reviews, prioritizing the logged-in user's review
$query = "SELECT r.*, u.username FROM reviews r 
          JOIN users u ON r.user_id = u.id
          ORDER BY 
              CASE 
                  WHEN r.user_id = $current_user_id THEN 1 
                  ELSE 2 
              END, 
              r.created_at DESC";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    echo "<div class='review-card'>";
    echo "<div class='review-header'>";
    echo "<h3>{$row['username']}</h3>";
    echo "<div class='star-container'>";
    for ($i = 1; $i <= 5; $i++) {
        echo $i <= $row['rating'] ? "<span class='selected'>&#9733;</span>" : "<span>&#9734;</span>";
    }
    echo "</div>";
    echo "</div>";
    echo "<div class='review-body'>";
    echo "<p>{$row['review']}</p>";

    // Display photos
    if (!empty($row['photos'])) {
        $photos = explode(',', $row['photos']);
        foreach ($photos as $photo) {
            echo "<img src='uploads/$photo' alt='Review Photo' />";
        }
    }

    // Add Edit/Delete options for the owner
    if ($current_user_id && $row['user_id'] == $current_user_id) {
        echo "<div class='edit-delete'>";
        echo "<a href='edit_review.php?id={$row['id']}'>Edit</a> | ";
        echo "<a href='delete_review.php?id={$row['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>";
        echo "</div>";
    }

    echo "</div>";
    echo "</div>";
}
?>
</body>
</html>

