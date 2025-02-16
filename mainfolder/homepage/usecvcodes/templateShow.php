<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll(".loggedin-template").forEach(function(card) {
                    card.style.display = "none";
                });
            });
          </script>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template Selector</title>
    <link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300..800&family=Geist+Mono:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="templateShow.css">
</head>
<body>
    
    <header><nav>
        <img src="logo.png" alt="">
    </nav>
    <h1>Featured Templates</h1></header>
    <div class="template-container">
        <div class="template-card">
            <img src="template1.png" alt="Template 1">
            <h2>Modern Template</h2>
            <p>A clean and contemporary design that highlights your skills and experience.</p>
            <button><a href="template4.html">Use Template</a></button>
        </div>
        <div class="template-card">
            <img src="template2.png" alt="Template 2">
            <h2>Creative Template</h2>
            <p>A visually striking design that helps you stand out from the crowd.</p>
            <button><a href="template3.html">Use Template</a> </button>
        </div>
        <div class="template-card loggedin-template">
            <img src="template3.png" alt="Template 3">
            <h2>Traditional Template</h2>
            <p>A classic design that focuses on highlighting your professional experience.</p>
            <button><a href="template2.html">Use Template</a></button>
        </div>
        <div class="template-card loggedin-template">
            <img src="template4.png" alt="Template 4">
            <h2>Professional Template</h2>
            <p>Best suited for corporate and business-style resumes.</p>
            <button><a href="template1.html">Use Template</a></button>
        </div>
        <div class="template-card loggedin-template">
            <img src="template5.png" alt="Template 5">
            <h2>Minimalist Template</h2>
            <p>Focuses on clean and minimal layout with emphasis on details.</p>
            <button><a href="template5.html">Use Template</a></button>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
