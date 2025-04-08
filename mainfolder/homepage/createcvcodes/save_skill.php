<?php
session_start();
include 'connect.php';

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in"]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION['user_id']; // Ensure session contains user ID
    $data = json_decode(file_get_contents("php://input"), true); // Correct way to read JSON

    if (!isset($data['skills']) || !is_array($data['skills'])) {
        echo json_encode(["status" => "error", "message" => "Invalid data"]);
        exit;
    }

    foreach ($data['skills'] as $skill) {
        $name = trim($skill['name']);
        $level = (int) $skill['level'];

        if (!empty($name)) {
            // Check if skill exists for the user
            $stmt = $conn->prepare("SELECT id FROM skills WHERE user_id = ? AND skill_name = ?");
            $stmt->bind_param("is", $user_id, $name);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                // Update skill if it exists
                $update = $conn->prepare("UPDATE skills SET skill_level = ? WHERE user_id = ? AND skill_name = ?");
                $update->bind_param("iis", $level, $user_id, $name);
                $update->execute();
            } else {
                // Insert new skill
                $insert = $conn->prepare("INSERT INTO skills (user_id, skill_name, skill_level) VALUES (?, ?, ?)");
                $insert->bind_param("isi", $user_id, $name, $level);
                $insert->execute();
            }
        }
    }
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
?>
