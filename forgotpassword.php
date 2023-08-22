<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="./style/login.css">
</head>

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
            <h1 id="title">Verify</h1>
            <form action="forgotverify.php" method="post">
                <div class="input-group">
                    <div class="input-field">
                        <input type="text" placeholder="OTP" required name="otpnumber">
                    </div>
                </div>
                <div class="btn-field">
                    <button type="submit" id="signinbtn">Verify</button>

                </div>
                
            </form>
        </div>

</div>
</body>
</html>