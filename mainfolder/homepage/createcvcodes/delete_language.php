<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION['user_id']; // Ensure user is logged in
    $language_name = $_POST['language_name'];

    // Delete the language
    $delete = $conn->prepare("DELETE FROM languages WHERE user_id = ? AND language_name = ?");
    $delete->bind_param("is", $user_id, $language_name);
    $delete->execute();

    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error"]);
}
?>