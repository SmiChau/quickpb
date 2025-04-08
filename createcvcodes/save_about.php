<?php
include('connect.php'); 
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
$conn = new mysqli("localhost", "root", "", "quick_profile_builder");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id']; 

$first_name = $_POST['first_name'] ?? ''; 
$last_name = $_POST['last_name'] ?? '';
$designation = $_POST['designation'] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? '';
$address = $_POST['address'] ?? '';
$city = $_POST['city'] ?? '';
$summary = $_POST['summary'] ?? '';

$profile_photo = null;
if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
    $upload_dir = 'profiles/'; 
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    $file_name = basename($_FILES['profile_photo']['name']);
    $file_path = $upload_dir . uniqid() . '_' . $file_name; 
    if (move_uploaded_file($_FILES['profile_photo']['tmp_name'], $file_path)) {
        $profile_photo = $file_path;
    }
}

// Check if the user already has an entry
$sql = "SELECT id FROM about WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $about_id = $row['id'];
    $sql = "UPDATE about SET first_name=?, last_name=?, designation=?, phone=?, email=?, address=?, city=?, summary=?, profile_photo=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssi", $first_name, $last_name, $designation, $phone, $email, $address, $city, $summary, $profile_photo, $about_id);
} else {
    $sql = "INSERT INTO about (user_id, first_name, last_name, designation, phone, email, address, city, summary, profile_photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssssss", $user_id, $first_name, $last_name, $designation, $phone, $email, $address, $city, $summary, $profile_photo);
}

// Execute the query
$stmt->execute();
$stmt->close();
$conn->close();
