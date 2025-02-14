<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="homepage.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Funnel+Display:wght@300..800&family=Geist+Mono:wght@100..900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header/ Navbar -->
    <header>
        <nav class="navbar section-content">
            <a href="homepage.php"><img src="logo.png"></a>
            
            
               
            <ul class="nav-menu">
            <button id="menu-close" class="fas fa-times"></button>
                <li class="nav-item"><a href="#home" class="nav-link">HOME</a></li>
                <li class="nav-item"><a href="#about" class="nav-link">ABOUT</a></li>
                <li class="nav-item"><a href="#services" class="nav-link">SERVICES</a></li>
                <li class="nav-item"><a href="#contact" class="nav-link">CONTACT</a></li>
                <li class="nav-item"><a href="#login-header" class="nav-link">LOGIN/SIGNUP</a></li>
                <li class="nav-item"><a href="review.php" class="nav-links">RATINGS & REVIEWS</a></li>
                <li class="nav-item"><a href="logout.php" class="nav-links">LOGOUT</a></li>

            </ul>
            <button id="menu-open" class="fas fa-bars"></button>
            
        </nav>
    </header>
<main>
    <!-- Home Section -->
    <section id="home" class="home-section">
        <div class="text-box">
            <h1>Craft your perfect profile in moments – because first impressions matter</h1>
            <p>Welcome to QuickProfile Builder – your ultimate tool for creating professional CVs and resumes with ease.<br>Your dream job starts here!</p>
            <a href="choosepg.html" class="start">Get Started</a>
        </div>
    </section>
    
   
    <!-- About Section>-->
    
    <section id="about" class="about-section">
        <div class="about-container">
            <h2>About Us</h2>
            <p>Welcome to Quick CV and Resume Builder! Our goal is to simplify resume creation for everyone, 
               from students to professionals. With intuitive tools and professional templates, we make it easy 
               for you to craft the perfect resume.</p>
            <p>We are committed to providing a seamless experience, ensuring that your profile stands out in 
               today’s competitive job market.</p>
        </div>
    </section>

    <!-- Service Section -->
    <section id="services" class="services-section">
        <div class="services-container">
            <h2>Our Services</h2>
            <div class="service-list">
                <div class="service-item">
                    <h3>Customizable Templates</h3>
                    <p>Pick from a wide variety of professionally designed templates to suit your style.</p>
                </div>
                <div class="service-item">
                    <h3>Quick Profile Builder</h3>
                    <p>Convert user-entered data into a visually appealing profile summary.</p>
                </div>
                <div class="service-item">
                    <h3>Real-Time Preview</h3>
                    <p>See your resume take shape as you edit it in real-time.</p>
                </div>
                <div class="service-item">
                    <h3>Easy Downloading</h3>
                    <p>Download your resume effortlessly with a single click.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section -->
    <section id="contact" class="contact-section">
        <div class="contact-container">
            <h2>Contact Us</h2>
            <p>Reach out to us using the details below:</p>
            <div class="contact-details">
                <p><strong>Phone:</strong> +1 234 567 890</p>
                <p><strong>Email:</strong> <a href="mailto:support@quickcvbuilder.com"> quickpb@gmail.com</a></p>
                <p><strong>Address:</strong> Kalanki, Kathmandu</p>
            </div>
            <div class="social-links">
                <a href="https://facebook.com" target="_blank">Facebook</a> | 
                <a href="https://twitter.com" target="_blank">Twitter</a> | 
                <a href="https://linkedin.com" target="_blank">LinkedIn</a>
            </div>
            <br>
           

            <form id="contact-form" method="POST">
    <textarea name="message" id="message" placeholder="Type your message..." rows="5" cols="50" required></textarea><br>
    <button type="submit" id="contactMessage">Send Message</button>
    <p id="response-message" style="color: green; display: none;"></p>
</form>

<script>
    const form = document.getElementById('contact-form');
    const responseMessage = document.getElementById('response-message');

    form.addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent the form from submitting the traditional way

        const formData = new FormData(form); // Gather form data

        // Send the data using AJAX
        fetch('send_message.php', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    responseMessage.style.color = 'green';
                } else {
                    responseMessage.style.color = 'red';
                }
                responseMessage.textContent = data.message;
                responseMessage.style.display = 'block';
                form.reset(); // Clear the form after successful submission
            })
            .catch(error => {
                responseMessage.style.color = 'red';
                responseMessage.textContent = 'An error occurred. Please try again.';
                responseMessage.style.display = 'block';
            });
    });
</script>        
        </div>
        </section>
    <!-- Login/Sign Up Section -->
    <section id="login-header" class="login-header">
        <div class="login-container">
            <h2>Join Us Today!</h2>
            <p>Unlock exclusive features, save your profiles, and access professional templates by logging into your account. Don’t have an account? Sign up in seconds and start building your perfect profile today!</p>
            <a href="login.php" class="btn-login-signup">Login/Signup</a>
        </div> 
        
    </section>
    
    <footer>
        <p>&copy; 2024 QuickProfile Builder. All rights reserved.</p>
        <p><a href="privacypolicy.html">Privacy Policy</a> | <a href="termsofservice.html">Terms of Service</a></p>
    </footer>
    </main>
    <script src="homepage.js"></script>
    <script src="services.js"></script>
    <script src="media.js"></script>
</body>
</html>