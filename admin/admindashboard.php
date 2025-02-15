<?php
// Include the database connection file
include('adminconnect.php');

// Fetch total registered users
$userQuery = "SELECT COUNT(*) AS total_users FROM users";
$userResult = $conn->query($userQuery);
$userData = $userResult->fetch_assoc();
$totalUsers = $userData['total_users'];

// Fetch total messages
$messageQuery = "SELECT COUNT(*) AS total_messages FROM messages";
$messageResult = $conn->query($messageQuery);
$messageData = $messageResult->fetch_assoc();
$totalMessages = $messageData['total_messages'];

// Fetch total reviews
$reviewsQuery = "SELECT COUNT(*) AS total_reviews FROM reviews";
$reviewsResult = $conn->query($reviewsQuery);
$reviewsData = $reviewsResult->fetch_assoc();
$totalReviews = $reviewsData['total_reviews'];

// Fetch total templates
$templateQuery = "SELECT COUNT(*) AS total_templates FROM templates";
$templateResult = $conn->query($templateQuery);
$templateData = $templateResult->fetch_assoc();
$totalTemplates = $templateData['total_templates'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* General Reset */
        body, html {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}
header {
position: fixed;
top: 0;
left: 0;
width: 100%;
background: #fff;
box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
z-index: 1000;
}
nav img {
width: 90px;
padding-left: 10px;
}

.container {
display: flex;
flex: 1;
margin-top: 90px;
height: calc(100vh - 70px); /* Subtract header height */
margin-bottom: 20px;
}
/* Sidebar Styling */
.sidebar {
    padding-top: 140px;
    width: 250px;
    height: 100vh;
    background-color: #2c3e50;
    color: white;
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.sidebar .logo {
    font-size: 2.5em;
    font-weight: bold;
    text-align: center;
    padding: 30px 0;
    border-bottom: 1px solid #34495e;
}
.sidebar ul {
list-style: none;
padding: 0;
margin: 0;
}

.sidebar ul li {
margin-bottom: 40px; /* Adds space between items */
}

.sidebar ul li a {
text-decoration: none;
color: white;
display: block;
padding: 15px 25px; /* Adjusts the clickable area */
border-radius: 8px; /* Rounds the corners */
transition: background-color 0.3s ease; /* Smooth hover transition */
}

.sidebar ul li a:hover {
background-color: #7f8c8d; /* Changes background on hover */
border-radius: 8px; /* Ensures hover effect matches the rounded shape */
}

/* Main Content */
.main-content {
    margin-left: 250px;
    padding: 20px;
}

.main-content h1 {
    margin-bottom: 20px;
    color: #2c3e50;
}

        /* Cards */
        .card-container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 20px;
        }
        .card {
            flex: 1;
            min-width: 200px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        .card h3 {
            margin: 0;
            color: #2c3e50;
        }
        .card p {
            font-size: 2em;
            color: #2980b9;
            margin: 10px 0;
        }
        .card small {
            display: block;
            color: #7f8c8d;
        }

        /* Chart Container */
        .chart-container {
            margin-top: 40px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
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
                    <li class="nav-item"><a href="adminlogout.php">Logout</a></li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h1>Admin Dashboard</h1>
            <p>Manage and monitor activities for your Quick CV and Resume Builder platform.</p>

            <!-- Cards -->
            <div class="card-container">
                <div class="card">
                    <h3>Total Registered Users</h3>
                    <p><?php echo $totalUsers; ?></p>
                    <small>Users who signed up for your platform</small>
                </div>
                <div class="card">
                    <h3>Total Messages</h3>
                    <p><?php echo $totalMessages; ?></p>
                    <small>Messages received through the contact section</small>
                </div>
                <div class="card">
                    <h3>Total Reviews</h3>
                    <p><?php echo $totalReviews; ?></p>
                    <small>Feedback and ratings from users</small>
                </div>
                <div class="card">
                    <h3>Total Templates</h3>
                    <p><?php echo $totalTemplates + 5; ?></p>
                    <small>Available resume and CV templates</small>
                </div>
            </div>

            <!-- Chart -->
            <div class="chart-container">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Users', 'Messages', 'Reviews', 'Templates'],
                datasets: [{
                    label: 'Platform Statistics',
                    data: [<?php echo $totalUsers; ?>, <?php echo $totalMessages; ?>, <?php echo $totalReviews; ?>, <?php echo $totalTemplates + 5; ?>],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>