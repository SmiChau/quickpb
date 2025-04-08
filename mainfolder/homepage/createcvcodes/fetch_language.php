<?php
session_start();
include 'connect.php';

$user_id = $_SESSION['user_id'];
$query = $conn->prepare("SELECT language_name, language_level FROM languages WHERE user_id = ?");
$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();

$languages = [];
while ($row = $result->fetch_assoc()) {
    $languages[] = $row;
}

echo json_encode($languages);
?>
