<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "boltcabs";


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST["email"];

$emailCheckQuery = "SELECT user_email FROM registration WHERE user_email = ?";
$stmtCheck = $conn->prepare($emailCheckQuery);
$stmtCheck->bind_param("s", $email);
$stmtCheck->execute();
$stmtCheck->store_result();

if ($stmtCheck->num_rows > 0) {
    //email exist
    $token = md5(rand());
    
    $sql = "UPDATE otp SET token = '$token' WHERE user_id = '$email'";
    $conn->query($sql);
    

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
$mail->Subject = "Reset Password! Boltcabs";

$email_template = "<h3>Click the Link below to Reset Your Password</h3>
                 <br>
                 <a href='http://localhost/mycode/BoltCabs/passwordchange.php?token=$token&email=$email'>ResetPassword</a>";
$mail->Body = $email_template;
$mail->send();
echo "<script>
        alert('Reset Link Sent! Check your inbox');
      window.location.href = 'forgotpassword.php';
    </script>";
$conn->close();
}
else{
    echo "<script>
        alert('No such Email exist!');
      window.location.href = 'forgotpassword.php';
    </script>";
}