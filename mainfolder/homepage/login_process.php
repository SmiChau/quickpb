<?php
session_start();
include 'connect.php';

if (isset($_POST['signUp'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    $password = md5($password); // Hashing password
    $confirmPassword = $_POST['confirmPassword'];
    $confirmPassword = md5($confirmPassword);

    // Insert new user into the database
    $insertQuery = "INSERT INTO users (username, email, phone, password, confirmPassword)
                    VALUES ('$username', '$email', '$phone', '$password', '$confirmPassword')";
    if ($conn->query($insertQuery) === TRUE) {
        header("Location: login.php");
    } else {
        echo "Error: " . $conn->error;
    }
}

if (isset($_POST['signIn'])) {
    $username = trim($_POST['username']);
    $password = md5($_POST['password']); // Hash the password for matching

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Set session variables for the logged-in user
        $_SESSION['user_id'] = $row['id']; // Assuming 'id' is the primary key column in the 'users' table
        $_SESSION['username'] = $row['username'];
        $_SESSION['showalert']=true;
        $_SESSION['loggedin']=true;

        header("Location: homepage.php");
    } else {
        header("Location: login.php?loginError=Invalid username or password");
    }
    exit();
}
?>
