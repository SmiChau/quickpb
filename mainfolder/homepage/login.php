<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="wrapper" id="signIn">
        <form method="post" action="login_process.php">
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
            <div class="register-link">
                <p>Don't have an account? <button id="signUpButton">Sign up</button></p>
            </div>
        </form>
    </div>

    <div class="wrapper" id="signUp" style="display: none;">
        <form onsubmit="return validationForm()" method="post" action="login_process.php">
            <h1>Sign up</h1>
            
            <div class="input-box">
                <input type="text" id="username" name="username" required><label>Username</label>
                <i class='bx bxs-user'></i>

            </div>
            <div class="error-message" id="username error"></div><br>
            <div class="input-box">
                <input type="text" id="email" name="email" required><label>Email</label>
                <i class='bx bxs-envelope'></i>          
            </div>
            <div class="error-message" id="username error"></div><br>
            <div class="error-message" id="email error"></div><br>
            <div class="input-box">
                <input type="tel" id="phone" name="phone" required><label>Phone</label>
                <i class='bx bxs-phone'></i>
            </div>
            <div class="error-message" id="phone error"></div><br>
            <div class="input-box">
                <input type="password" id="password" name="password" required><label>Password</label>
                <i class='bx bxs-lock-alt'></i>

            </div>
            <div class="error-message" id="password error"></div><br>
            <div class="input-box">
                <input type="password" id="confirmPassword" name="confirmPassword" required><label>Confirm Password</label>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="error-message" id="confirmPassword error"></div><br>
            <div class="remember-forgot">
                <label><input type="checkbox" name="agreeTerms" required>I agree to the terms & conditions</label>
            </div>
            <button type="submit" class="btn" name="signUp">Sign up</button>
            <div class="register-link">
                <p>Already have an account? <button id="signInButton">Sign in</button></p>
            </div>
        </form>
    </div>

    <script src="login.js"></script>
    <script src="loginValidation.js"></script>
</body>
</html>