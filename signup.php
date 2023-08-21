<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="./style/login.css">
    <script src="https://kit.fontawesome.com/df94d1352d.js" crossorigin="anonymous"></script>
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
            <h1 id="title">Sign up</h1>
            <form method ="post" action="verify.php">
                <div class="input-group">
                    <div class="input-field" id="namefield">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" class="nameinput" placeholder="Name" name="name" required >
                    </div>

                    <div class="input-field" id="phonefield">
                        <i class="fa-solid fa-phone"></i>
                        <input type="tel" class="phoneno" placeholder="Phone number" pattern="[0-9]{3}[0-9]{3}[0-9]{}" name="phoneno" required>
                    </div>
                    <div class="input-field">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" placeholder="Email" required name="email">
                    </div>

                    <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" placeholder="Password" required name="password">
                    </div>

                    <p>Forgot password <a href="#"><u> Click Here!</u></a></p>
                </div>
                <div class="btn-field">
                    <button type="submit" id="signupbtn">Sign Up</button>                   
                </div>
                
            </form>
        </div>
    </div>

</body>
</html>
