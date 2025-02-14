<?php
session_start();
include('adminconnect.php');

// Handle Delete Request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete_query = "DELETE FROM reviews WHERE id = $id";
    $conn->query($delete_query);
    header("Location: managereviews.php");
    exit();
}

// Fetch Reviews with Usernames
$query = "SELECT reviews.id, reviews.user_id, reviews.rating, reviews.review, reviews.created_at, users.username 
          FROM reviews 
          JOIN users ON reviews.user_id = users.id";
$result = $conn->query($query);

if (!$result) {
    die("Query Failed: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reviews</title>
    <link rel="stylesheet" href="managereviews.css">
</head>
<body>
<header>
    <nav>
        <img src="logo.png" alt="Logo">
    </nav>
</header>

<div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
        <nav>
            <ul class="nav-menu">
                <li class="nav-item"><a href="admindashboard.php">Dashboard</a></li>
                <li class="nav-item"><a href="manageusers.php">Manage Users</a></li>
                <li class="nav-item"><a href="managemessages.php">Manage Messages</a></li>
                <li class="nav-item"><a href="managereviews.php">Manage Reviews</a></li>
                <li class="nav-item"><a href="managetemplates.php">Manage Templates</a></li>
                <li class="nav-item"><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </div>

    <div class="main-content">
        <h1>Manage Reviews</h1>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="review-box">
                    <div class="review-header">
                        <span class="username"><?php echo htmlspecialchars($row['username']); ?></span>
                        <span class="timestamp"><?php echo htmlspecialchars($row['created_at']); ?></span>
                    </div>
                    <div class="rating">
                        <?php for ($i = 0; $i < $row['rating']; $i++) { ?>
                            <span class="star">&#9733;</span>
                        <?php } ?>
                        <?php for ($i = $row['rating']; $i < 5; $i++) { ?>
                            <span class="star inactive">&#9733;</span>
                        <?php } ?>
                    </div>
                    <p class="review-content"><?php echo htmlspecialchars($row['review']); ?></p>
                    <div class="review-actions">
                        <a href="managereviews.php?delete=<?php echo $row['id']; ?>" class="delete-btn">Delete</a>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>No reviews found.</p>";
        }
        ?>
    </div>
</div>
</body>
</html>
