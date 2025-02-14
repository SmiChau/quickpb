<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="adminlogin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="wrapper" id="signIn">
        <form method="post" action="adminloginprocess.php">
            <h1>Login</h1>
            <?php if (!empty($_GET['loginError'])): ?>
                <p style="color: red;"><?php echo $_GET['loginError']; ?></p>
            <?php endif; ?>
            <div class="input-box">
                <input type="text" name="username" required><label>Username</label>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" required><label>Password</label>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <button type="submit" class="btn" name="signIn">Login</button>
        </form>
    </div>
    
</body>
</html>