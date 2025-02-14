function validationForm() {
    let isValid = true;
    
    document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
    document.querySelectorAll('input').forEach(el => el.classList.remove('error'));

    const username = document.getElementById("username").value;
    if (username.length<3 || /[^a-zA-Z\s]/.test(username)) {
        document.getElementById("username error").textContent = "Invalid! Full Name should be at least 3 characters long and should not contain any special characters or numbers.";
        document.getElementById("username").classList.add('error');
        isValid = false;
    }

    const email = document.getElementById('email').value;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        document.getElementById('email error').textContent = "Invalid! Email should not contain unnecessary symbols.";
        document.getElementById('email').classList.add('error');
        isValid = false;
    }

    const phone = document.getElementById("phone").value;
    const phoneRegex = /^\d{10}$/;
    if (!phoneRegex.test(phone)) {
        document.getElementById('phone error').textContent = "Invalid! Mobile number should be 10 digits and should not contain letters.";
        document.getElementById('phone').classList.add('error');
        isValid = false;
    }

    const password = document.getElementById('password').value;
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@!$#])[A-Za-z\d@!$#]{8,}$/;
    if (!passwordRegex.test(password)) {
        document.getElementById('password error').textContent = "Password should be at least 8 characters long, with uppercase, lowercase, number, and special character.";
        document.getElementById('password').classList.add('error');
        isValid = false;
    }

    const confirmPassword = document.getElementById('confirmPassword').value;
    if (password !== confirmPassword) {
        document.getElementById('confirmPassword error').textContent = "Passwords do not match.";
        document.getElementById('confirmPassword').classList.add('error');
        isValid = false;
    }
    
    return isValid;
}