<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="./style/login.css">
    <title>Verify OTP</title>
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
                    <div id="countdown">
                        Time left: <span id="timer">5:00</span>
                 </div>
                </div>
                <div class="btn-field">
                    <button type="submit" id="signinbtn">Verify</button>

                </div>
                
            </form>
        </div>

</div>
<script>
var countdownTime = 300;
var timer = document.getElementById('timer');

function startCountdown() {
    var timerInterval = setInterval(function() {
        var minutes = Math.floor(countdownTime / 60);
        var seconds = countdownTime % 60;

        timer.textContent = minutes + ":" + (seconds < 10 ? "0" : "") + seconds;

        if (countdownTime <= 0) {
            clearInterval(timerInterval);
            timer.textContent = "Expired";
        } else {
            countdownTime--;
        }
    }, 1000); 
}

startCountdown();
</script>
</body>
</html>

<?php
include 'connection.php';

$name = $_POST["name"];
$phoneno = '91'.$_POST["phoneno"];
$email = $_POST["email"];
$plainPassword = $_POST["password"];
$hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);

session_start();
$_SESSION["email"] = $email;
$_SESSION["phoneno"] = $phoneno;
$_SESSION["name"] = $name;
$_SESSION["hashedPassword"] = $hashedPassword;

$emailCheckQuery = "SELECT user_email FROM registration WHERE user_email = ?";
$stmtCheck = $conn->prepare($emailCheckQuery);
$stmtCheck->bind_param("s", $email);
$stmtCheck->execute();
$stmtCheck->store_result();

if ($stmtCheck->num_rows > 0) {

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
$expiryTimestamp = time() + 300; 
$expiryTimeFormatted = date('Y-m-d H:i:s', $expiryTimestamp);


$otpCheckQuery = "SELECT user_id FROM otp WHERE user_id = ?";
$otpCheck = $conn->prepare($otpCheckQuery);
$otpCheck->bind_param("s", $email);
$otpCheck->execute();
$otpCheck->store_result();

if ($otpCheck->num_rows > 0) {
    $sql = "UPDATE otp SET otpnum = $otp, expiry = '$expiryTimeFormatted' WHERE user_id = '$email'";
    $conn->query($sql);
}
else{
$sql = "INSERT INTO otp (user_id, otpnum, expiry) VALUES ('$email', $otp, '$expiryTimeFormatted')";
$conn->query($sql);
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
$mail = new PHPMailer(true);
  
$mail->isSMTP();
$mail->Host='smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'boltcabs86@gmail.com';
$mail->Password = 'zxcumcthpzghpfdr';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->setFrom('boltcabs86@gmail.com');
$mail->addAddress($email);
$mail->isHTML(true);
$mail->Subject = "Hey ".$name.", BoltCabs OTP(One Time Password)";
$mail->Body = "<p style='font-size: 24px;'>Your OTP: <strong>".$otp."</strong></p>";
$mail->send();

$conn->close();
?>