<?php 
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $review_id = intval($_GET['id']);
    $user_id = $_SESSION['user_id'];

    // Fetch the review data
    $stmt = $conn->prepare("SELECT * FROM reviews WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $review_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $review = $result->fetch_assoc();
    } else {
        echo "Unauthorized access!";
        exit();
    }
} else {
    echo "Review not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Review</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General Modal Styles */
        .modal {
    display: none; /* Hidden by default */
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    backdrop-filter: blur(8px); /* Blur effect */
    background-image: url('homey.jpg'); /* Replace with your image path */
    background-size: cover; /* Make the image cover the entire area */
    background-position: center; /* Center the image */
    background-repeat: no-repeat; /* Prevent tiling */
    justify-content: center;
    align-items: center;
}


        .modal-content {
            background-color: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .modal-header h2 {
            margin: 0;
        }

        .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }

        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
            font-size: 1.5em;
            margin: 10px 0;
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

        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 10px 0;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div id="editReviewModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Edit Your Review</h2>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>
        <form action="update_review.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="review_id" value="<?php echo $review['id']; ?>">

            <label for="rating">Rating:</label>
            <div class="star-rating">
                <input type="radio" name="rating" id="star5" value="5" <?php if ($review['rating'] == 5) echo 'checked'; ?>>
                <label for="star5" title="5 stars">★</label>
                <input type="radio" name="rating" id="star4" value="4" <?php if ($review['rating'] == 4) echo 'checked'; ?>>
                <label for="star4" title="4 stars">★</label>
                <input type="radio" name="rating" id="star3" value="3" <?php if ($review['rating'] == 3) echo 'checked'; ?>>
                <label for="star3" title="3 stars">★</label>
                <input type="radio" name="rating" id="star2" value="2" <?php if ($review['rating'] == 2) echo 'checked'; ?>>
                <label for="star2" title="2 stars">★</label>
                <input type="radio" name="rating" id="star1" value="1" <?php if ($review['rating'] == 1) echo 'checked'; ?>>
                <label for="star1" title="1 star">★</label>
            </div>

            <label for="review">Review:</label><br>
            <textarea name="review" rows="4" required><?php echo htmlspecialchars($review['review']); ?></textarea>
            <br>

            <button type="submit" name="updateReview">Update Review</button>
        </form>
    </div>
</div>

<script>
    // Show the modal
    document.getElementById('editReviewModal').style.display = 'flex';

    // Close the modal
    function closeModal() {
        document.getElementById('editReviewModal').style.display = 'none';
    }
</script>

</body>
</html>
