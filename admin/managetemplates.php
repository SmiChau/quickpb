<?php
include('adminconnect.php'); // Database connection

// Add template
if (isset($_POST['add_template'])) {
    $template_name = $_POST['name'];
    $thumbnail_file = $_FILES['thumbnail']['name'];
    $preview_file = $_FILES['preview']['name'];

    // File upload paths
    $thumbnail_target = "uploads/thumbnails/" . basename($thumbnail_file);
    $preview_target = "uploads/previews/" . basename($preview_file);

    // Upload files
    $thumbnail_success = move_uploaded_file($_FILES['thumbnail']['tmp_name'], $thumbnail_target);
    $preview_success = move_uploaded_file($_FILES['preview']['tmp_name'], $preview_target);

    if ($thumbnail_success && $preview_success) {
        $query = "INSERT INTO templates (name, thumbnail, preview) VALUES ('$template_name', '$thumbnail_file', '$preview_file')";
        if ($conn->query($query)) {
            $message = "Template added successfully!";
        } else {
            $error = "Database Error: " . $conn->error;
        }
    } else {
        $error = "Error uploading files. Check permissions.";
    }
}

// Delete template
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM templates WHERE id = $id";
    if ($conn->query($query)) {
        $message = "Template deleted successfully!";
    } else {
        $error = "Error deleting template: " . $conn->error;
    }
}

// Edit template
if (isset($_POST['edit_template'])) {
    $id = $_POST['edit_id'];
    $template_name = $_POST['edit_name'];
    $thumbnail_file = $_FILES['edit_thumbnail']['name'];
    $preview_file = $_FILES['edit_preview']['name'];

    // File upload paths
    $thumbnail_target = "uploads/thumbnails/" . basename($thumbnail_file);
    $preview_target = "uploads/previews/" . basename($preview_file);

    // Update query
    $query = "UPDATE templates SET name = '$template_name'";
    if (!empty($thumbnail_file)) {
        $query .= ", thumbnail = '$thumbnail_file'";
        move_uploaded_file($_FILES['edit_thumbnail']['tmp_name'], $thumbnail_target);
    }
    if (!empty($preview_file)) {
        $query .= ", preview = '$preview_file'";
        move_uploaded_file($_FILES['edit_preview']['tmp_name'], $preview_target);
    }
    $query .= " WHERE id = $id";

    if ($conn->query($query)) {
        $message = " ";
    } else {
        $error = "Error updating template: " . $conn->error;
    }
}

// Fetch templates
$query = "SELECT * FROM templates";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Templates</title>
    <link rel="stylesheet" href="managetemplates.css">
    
    <script>
        function openEditForm(id, name, thumbnail, preview) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit-template-form').style.display = 'block';
        }

        function closeEditForm() {
            document.getElementById('edit-template-form').style.display = 'none';
        }
    </script>
</head>
<body>
<header>
    <nav>
        <img src="logo.png" alt="Logo">
    </nav>
</header>
<div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
        <ul>
            <li><a href="admindashboard.php">Dashboard</a></li>
            <li><a href="manageusers.php">Manage Users</a></li>
            <li><a href="managemessages.php">Manage Messages</a></li>
            <li><a href="managereviews.php">Manage Reviews</a></li>
            <li><a href="managetemplates.php">Manage Templates</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
        <h1>Manage Templates</h1>
        <?php if (isset($message)) { echo "<p class='success'>$message</p>"; } ?>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <form method="POST" enctype="multipart/form-data" class="add-template-form">
            <input type="text" name="name" placeholder="Template Name" required>
            <div class="file-inputs">
                <label>Thumbnail:</label>
                <input type="file" name="thumbnail" accept="image/png" required>
                <label>Preview:</label>
                <input type="file" name="preview" accept="image/png" required>
            </div>
            <button type="submit" name="add_template">Add Template</button>
        </form>
        <div class="edit-template-form" id="edit-template-form">
            <h2>Edit Template</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="edit_id" id="edit_id">
                <input type="text" name="edit_name" id="edit_name" placeholder="Template Name" required>
                <div class="file-inputs">
                    <label>Thumbnail:</label>
                    <input type="file" name="edit_thumbnail" accept="image/png">
                    <label>Preview:</label>
                    <input type="file" name="edit_preview" accept="image/png">
                </div>
                <button type="submit" name="edit_template">Save Changes</button>
                <button type="button" onclick="closeEditForm()">Cancel</button>
            </form>
        </div>
        <div class="template-list">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="template-item">
                    <img src="uploads/thumbnails/<?php echo $row['thumbnail']; ?>" alt="<?php echo $row['name']; ?>">
                    <p><?php echo $row['name']; ?></p>
                    <div class="actions">
                        <a href="managetemplates.php?delete=<?php echo $row['id']; ?>" class="delete-btn">Delete</a>
                        <button class="edit-btn" onclick="openEditForm(<?php echo $row['id']; ?>, '<?php echo $row['name']; ?>', '<?php echo $row['thumbnail']; ?>', '<?php echo $row['preview']; ?>')">Edit</button>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
</body>
</html>