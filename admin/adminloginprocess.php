<?php
session_start();
include 'adminconnect.php';
if (isset($_POST['signIn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        header("Location: admindashboard.php");
    } else {
        header("Location: adminlogin.php?loginError=Invalid username or password");
    }
    exit();
}
?>
