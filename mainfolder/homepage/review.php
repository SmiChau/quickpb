<?php 
session_start();
include('connect.php'); // Include database connection

if(!isset($_SESSION['loggedin'])){
    header("Location: http://localhost/quickpb/mainfolder/homepage/login.php");
}

// Error or success messages
$error_message = $success_message = '';
if (isset($_GET['message'])) {
    if ($_GET['message'] == 'duplicate') {
        $error_message = "You have already provided a rating and review.";
    } elseif ($_GET['message'] == 'success') {
        $success_message = "Review submitted successfully!";
    }
}

// Initialize variables for overall rating
$average_rating = 0;
$total_reviews = 0;

// Fetch overall rating and review count
$result = $conn->query("SELECT AVG(rating) AS avg_rating, COUNT(*) AS total_reviews FROM reviews");
if ($result && $row = $result->fetch_assoc()) {
    $average_rating = round($row['avg_rating'], 1); // Round to 1 decimal place
    $total_reviews = $row['total_reviews'];
}

// Check if the user has already submitted a review
$already_reviewed = false;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT COUNT(*) FROM reviews WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($review_count);
    $stmt->fetch();
    $stmt->close();

    if ($review_count > 0) {
        $already_reviewed = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rating and Review System</title>
    <link rel="stylesheet" href="homepage.css">
    <link rel="stylesheet" href="review.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Star Rating CSS */
        .star-rating {
            display: flex;
            justify-content: center;
            flex-direction: row-reverse;
            font-size: 2em;

            
        }

        .star-rating input[type="radio"] {
            display: none;
        }

        .star-rating label {
            cursor: pointer;
            color: lightgray;
        }

        .star-rating label:hover,
        .star-rating label:hover ~ label,
        .star-rating input[type="radio"]:checked ~ label {
            color: gold;
        }
        .stars-rating {
            display: flex;
            justify-content: center;

            font-size: 2em;
        }

        .stars-rating input[type="radio"] {
            display: none;
        }

        .stars-rating label {
            cursor: pointer;
            color: lightgray;
        }

        .stars-rating label:hover,
        .stars-rating label:hover ~ label,
        .stars-rating input[type="radio"]:checked ~ label {
            color: gold;
        }


        .total-reviews {
            font-size: 1.1em;
            margin-top: 5px;
        }

        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: auto;
        }

        textarea {
            width: 100%;
            padding: 10px;
        }
    </style>
</head>
<body>
    <!-- Header/ Navbar -->
    <header>
        <nav class="navbar section-content">
            <a href="homepage.php"><img src="logo.png"></a>               
            <ul class="nav-menu">
            <li class="nav-item"><a href="homepage.php#home" class="nav-link">HOME</a></li>
                <li class="nav-item"><a href="homepage.php#about" class="nav-link">ABOUT</a></li>
                <li class="nav-item"><a href="homepage.php#services" class="nav-link">SERVICES</a></li>
                <li class="nav-item"><a href="homepage.php#contact" class="nav-link">CONTACT</a></li>
                <li class="nav-item" id="login"><a href="homepage.php#login-header" class="nav-link">LOGIN/SIGNUP</a></li>
                <li class="nav-item"><a href="review.php" class="nav-link">RATINGS & REVIEWS</a></li>
                <li class="nav-item" id="logout"><a href="logout.php" class="nav-link">LOGOUT</a></li>
            </ul>
            <button id="menu-open" class="fas fa-bars"></button>
            
        </nav>
    </header>
    
<script>



 document.getElementById('login').style.display="none";
 
 document.getElementById('logout').style.display="block";

</script>
    <div class="container">
        <section id="review-section">
            <!-- Overall Rating Section -->
            <?php if ($total_reviews > 0): ?>
                <div id="overall-rating-section">
                    <h2>Overall Rating</h2>
                    <div class="rating-summary">
                        <span class="average-rating"><?php echo $average_rating; ?> / 5.0</span>
                        <div class="stars-rating">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <span class="star" style="color: <?php echo ($i <= floor($average_rating)) ? 'gold' : 'lightgray'; ?>">★</span>
                            <?php endfor; ?>
                        </div>
                        <p class="total-reviews"><?php echo $total_reviews; ?> Review(s)</p>
                    </div>
                </div>
            <?php else: ?>
                <p>No reviews have been submitted yet. Be the first to leave a review!</p>
            <?php endif; ?>

            <h1>Submit Your Rating and Review</h1>

            <?php if (!empty($error_message)): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php elseif (!empty($success_message)): ?>
                <p class="success-message"><?php echo $success_message; ?></p>
            <?php endif; ?>

            <?php if (isset($_SESSION['user_id'])): ?>
                <?php if ($already_reviewed): ?>
                    <p class="error-message">You have already provided a rating and review.</p>
                <?php else: ?>
                    <form action="process_review.php" id="reviewForm" method="POST" enctype="multipart/form-data">
                        <label for="rating">Rating:</label>
                        <div class="star-rating">
                            <input type="radio" name="rating" id="star5" value="5"><label for="star5" title="5 stars">★</label>
                            <input type="radio" name="rating" id="star4" value="4"><label for="star4" title="4 stars">★</label>
                            <input type="radio" name="rating" id="star3" value="3"><label for="star3" title="3 stars">★</label>
                            <input type="radio" name="rating" id="star2" value="2"><label for="star2" title="2 stars">★</label>
                            <input type="radio" name="rating" id="star1" value="1"><label for="star1" title="1 star">★</label>
                            
                        </div>
                        <br><br>

                        <label for="review">Write your review:</label><br>
                        <textarea name="review" rows="4" cols="50" required></textarea>
                        <br><br>

                        <button type="submit" name="submitReview">Submit Review</button>
                    </form>
                <?php endif; ?>
            <?php else: ?>
                <p>Please <a href="login.php"><b><u>login</u></b></a> to submit a review.</p>
            <?php endif; ?>

            <h2>Reviews:</h2>
            <?php include 'display_reviews.php'; ?>
        </section>
    </div>
    <script>
        document.querySelectorAll('.star-rating input[type="radio"]').forEach(radio => {
    radio.addEventListener('change', function () {
        // Reset all labels to lightgray
        document.querySelectorAll('.star-rating label').forEach(label => {
            label.style.color = 'lightgray';
        });

        // Highlight selected stars and previous ones
        const selectedStar = document.querySelector(`input[name="rating"]:checked`); // Get the checked radio button
        const selectedStarId = selectedStar.id; // Get the ID of the selected radio button

        // Loop through all radio buttons and highlight the corresponding labels
        document.querySelectorAll('.star-rating label').forEach(label => {
            if (label.getAttribute('for') <= selectedStarId) {
                label.style.color = 'gold'; // Highlight all labels up to the selected one
            }
        });
    });
});

        document.getElementById('reviewForm').addEventListener('submit', function (e) {
            // Remove any existing error messages
            const existingError = document.querySelector('.error-message.dynamic');
            if (existingError) {
                existingError.remove();
            }

            // Check if a rating is selected
            const rating = document.querySelector('input[name="rating"]:checked');
            if (!rating) {
                e.preventDefault();

                // Create and insert the error message
                const errorMessage = document.createElement('p');
                errorMessage.textContent = "Please select a rating before submitting.";
                errorMessage.classList.add('error-message', 'dynamic'); // Add custom classes for styling
                document.querySelector('#reviewForm').appendChild(errorMessage);
            }
        });
    </script>
</body>
</html>
