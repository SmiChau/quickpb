<?php
// Database Connection
include('adminconnect.php'); // Ensure the connection file is correct

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete_query = "DELETE FROM users WHERE id = $id";
    if ($conn->query($delete_query)) {
        echo "<script>alert('User deleted successfully!');</script>";
    } else {
        echo "<script>alert('Error deleting user!');</script>";
    }
}

// Fetch Users
$query = "SELECT id, username, email, phone FROM users";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="manageusers.css">
</head>
<body>
<header>
        <nav>
        <img src="logo.png" alt="">
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
        <h1>Manage Users</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['phone']}</td>
                            <td>
                                <a href='manage_users.php?delete={$row['id']}' class='delete-btn'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No users found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
