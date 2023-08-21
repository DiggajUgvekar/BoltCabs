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

if(isset($_POST["otpnumber"])){
   // Retrieve stored OTP and expiration from the database
   session_start();
   $email = $_SESSION["email"];
   $phoneno = $_SESSION["phoneno"];
   $name = $_SESSION["name"];
   $hashedPassword = $_SESSION["hashedPassword"];
   $enteredOTP = $_POST["otpnumber"];

$sql = "SELECT otpnum, expiry FROM otp WHERE user_id = '$email'";
$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    if ($row) {
        $storedOTP = $row['otpnum'];
        $expiryTimestamp = $row['expiry'];

        // Check if the entered OTP matches the stored OTP
        if ($enteredOTP === $storedOTP) {
            // Check if the OTP has not expired
            if (time() < $expiryTimestamp) {
                // alert("OTP verified successfully.");
                $stmt = $conn->prepare("INSERT INTO registration(user_name, user_phone, user_email, user_password) VALUES (?, ?, ?, ?)");
                 $stmt->bind_param("ssss", $name, $phoneno, $email, $hashedPassword);
                 $stmt->execute();
            } else {
                alert("OTP has expired. Please request a new OTP.");
            }
        } else {
            alert("User not found or OTP record not found.");
        }
    } else {
        alert( "User not found.");
    }
}
}