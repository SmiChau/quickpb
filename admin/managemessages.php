<?php
// Start session for notifications
session_start();
include('adminconnect.php');

// Handle Approve Request
if (isset($_GET['approve'])) {
    $id = $_GET['approve'];
    $approve_query = "UPDATE messages SET status = 'approved' WHERE id = $id";
    if ($conn->query($approve_query)) {
        $_SESSION['notification'] = "Message approved successfully!";
    } else {
        $_SESSION['notification'] = "Error approving message: " . $conn->error;
    }
    header("Location: managemessages.php");
    exit();
}

// Handle Delete Request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete_query = "DELETE FROM messages WHERE id = $id";
    if ($conn->query($delete_query)) {
        $_SESSION['notification'] = "Message deleted successfully!";
    } else {
        $_SESSION['notification'] = "Error deleting message: " . $conn->error;
    }
    header("Location: managemessages.php");
    exit();
}

// Fetch Messages with Usernames
$query = "SELECT messages.id, messages.user_id, messages.message, messages.created_at, messages.status, users.username 
          FROM messages 
          JOIN users ON messages.user_id = users.id";
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
    <title>Manage Messages</title>
    <link rel="stylesheet" href="managemessages.css">
</head>
<body>
<header>
    <nav>
        <img src="logo.png" alt="">
    </nav>
</header>

<!-- Notification Banner -->
<?php if (isset($_SESSION['notification'])): ?>
    <div class="notification">
        <?php 
            echo $_SESSION['notification']; 
            unset($_SESSION['notification']); 
        ?>
    </div>
<?php endif; ?>

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
        <h1>Manage Messages</h1>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="message-box">
                    <div class="message-header">
                        <span class="username"><?php echo htmlspecialchars($row['username']); ?></span>
                        <span class="timestamp"><?php echo htmlspecialchars($row['created_at']); ?></span>
                    </div>
                    <p class="message-content"><?php echo htmlspecialchars($row['message']); ?></p>
                    <div class="message-actions">
                        <?php if ($row['status'] === 'approved') { ?>
                            <span class="approved">Approved</span>
                        <?php } else { ?>
                            <a href="managemessages.php?approve=<?php echo $row['id']; ?>" class="approve-btn">Approve</a>
                        <?php } ?>
                        <a href="managemessages.php?delete=<?php echo $row['id']; ?>" class="delete-btn">Delete</a>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>No messages found.</p>";
        }
        ?>
    </div>
</div>
</body>
</html>
