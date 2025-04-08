<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION['user_id']; // Ensure user is logged in
    $languages = json_decode($_POST['languages'], true);

    // Delete all existing languages for the user
    $delete = $conn->prepare("DELETE FROM languages WHERE user_id = ?");
    $delete->bind_param("i", $user_id);
    $delete->execute();

    // Insert or update languages
    foreach ($languages as $language) {
        $name = $language['name'];
        $level = $language['level'];

        $insert = $conn->prepare("INSERT INTO languages (user_id, language_name, language_level) VALUES (?, ?, ?)");
        $insert->bind_param("isi", $user_id, $name, $level);
        $insert->execute();
    }

    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error"]);
}

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