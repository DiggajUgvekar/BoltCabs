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
            <form method ="post" action="signup.php">
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
    <script>
</script>
</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "CHESSDIGGAJ@123";
$dbname = "boltcabs";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$name = $_POST["name"];
$phoneno = $_POST["phoneno"];
$email = $_POST["email"];
$password = $_POST["password"];


require __DIR__ . 'C:/Users/digga/vendor/twilio/sdk/src/Twilioautoload.php'; // Path to Twilio PHP library

// Your Twilio credentials
$accountSid = 'AC7609a20fe2f822da2d5b016c347bfc64';
$authToken = '77003243d289057e69b2f064d682d028';

// Initialize Twilio client
$twilio = new Twilio\Rest\Client($accountSid, $authToken);

// User's phone number to send OTP
$toPhoneNumber = '+91' . $phoneno;


// Generate a random OTP
$otp = rand(100000, 999999);

// Send OTP as SMS
$message = $twilio->messages->create(
    $toPhoneNumber,
    [
        'from' => '+15736779803', // Replace with your Twilio phone number
        'body' => "Your OTP: $otp",
    ]
);



$stmt = $conn->prepare("INSERT INTO registration(user_name, user_phone, user_email, user_password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $phoneno, $email, $password);

if ($stmt->execute()) {
    echo "<script>
            alert('Sign Up successfull!');
            window.location.href = 'login.php';
          </script>";
    exit();
}
$stmt->close();
?>