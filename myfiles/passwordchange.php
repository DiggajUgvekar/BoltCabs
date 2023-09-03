<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="./style/login.css">
    <title>BoltCabs</title>
<body>
<header>
        <a href="index.php" class = "logo">BoltCabs</a>
        <ul class="nav-page">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <ul>
        <li><a href="login.php" class="login">Log In</a></li>
        <li><a href="signup.php" class="signup">Sign Up</a></li>
        </ul>
    </header>

    <div class="container">
        <div class="formbox">
            <h1 id="title">Change Password</h1>
            <form action="updatepass.php" method="post" onsubmit="return validateForm()">
            <div class="input-group">
                <input type="hidden" required name="token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];} ?>">
                <div class="input-field">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" placeholder="Email" required name="email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>">
                    </div>
                 <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" placeholder="Password" required id="password"name="password" minlength="8">
                    </div>
                <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" placeholder="Confirm Password" required id="confirm_password" name="confirm_password" minlength="8">
                    </div>
                    <p id="password_match_message"></p>
                    </div>
                <div class="btn-field">
                    <button type="submit" id="signinbtn">Change Password</button>

                </div>
                
            </form>
        </div>
    </div>
    <script>
        const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("confirm_password");
    const passwordMatchMessage = document.getElementById("password_match_message");

    confirmPasswordInput.addEventListener("input", function() {
        if (passwordInput.value === confirmPasswordInput.value) {
            passwordMatchMessage.textContent = "Passwords match.";
            passwordMatchMessage.style.color = "green";
        } else {
            passwordMatchMessage.textContent = "Passwords do not match.";
            passwordMatchMessage.style.color = "red";
        }
    });

    function validateForm() {
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("confirm_password");
    const passwordMatchMessage = document.getElementById("password_match_message");

    if (passwordInput.value !== confirmPasswordInput.value) {
        passwordMatchMessage.textContent = "Passwords do not match.";
        passwordMatchMessage.style.color = "red";
        return false; // Prevent form submission
    } else {
        passwordMatchMessage.textContent = ""; // Clear the message
        return true; // Allow form submission
    }
}


    </script>
</body>
</html>