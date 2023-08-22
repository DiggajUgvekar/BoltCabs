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
            <h1 id="title">Verify</h1>
            <form action="welcome.php" method="post">
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

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boltcabs";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST["name"];
$phoneno = '91'.$_POST["phoneno"];
$email = $_POST["email"];
$plainPassword = $_POST["password"];

// Hash the password using bcrypt
$hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);

session_start();
$_SESSION["email"] = $email;
$_SESSION["phoneno"] = $phoneno;
$_SESSION["name"] = $name;
$_SESSION["hashedPassword"] = $hashedPassword;

// Check if the email already exists in the database
$emailCheckQuery = "SELECT user_email FROM registration WHERE user_email = ?";
$stmtCheck = $conn->prepare($emailCheckQuery);
$stmtCheck->bind_param("s", $email);
$stmtCheck->execute();
$stmtCheck->store_result();

if ($stmtCheck->num_rows > 0) {
    // Email already exists in the database
    echo "<script>
    alert('Already Email Exist!, Try Login In');
    window.location.href = 'login.php';
  </script>.";
    $stmtCheck->close();
    $conn->close();
    exit();
}

$otp = rand(100000, 999999);
date_default_timezone_set('Asia/Kolkata');
$expiryTimestamp = time() + 300; // Current timestamp + 300 seconds (5 minutes)
$expiryTimeFormatted = date('Y-m-d H:i:s', $expiryTimestamp);

$sql = "INSERT INTO otp (user_id, otpnum, expiry) VALUES ('$email', $otp, '$expiryTimeFormatted')";
$conn->query($sql);

//sending otp to email
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
$mail = new PHPMailer(true);
  
$mail->isSMTP();
$mail->Host='smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'contactdiggaj@gmail.com';
$mail->Password = 'bwdacyufzwwoleek';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->setFrom('contactdiggaj@gmail.com');
$mail->addAddress($email);
$mail->isHTML(true);
$mail->Subject = "Hey ".$name.", BoltCabs OTP(One Time Password)";
$mail->Body = "<p style='font-size: 24px;'>Your OTP: <strong>".$otp."</strong></p>";
$mail->send();

$conn->close();
?>


