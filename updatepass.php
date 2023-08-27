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
$password = $_POST['confirm_password'];
$email = $_POST['email'];
$token = $_POST['token'];
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

$databasetoken = "SELECT token FROM otp WHERE user_id = '$email'";
$result = $conn->query($databasetoken);

if ($result) {
    $row = $result->fetch_assoc();
    if ($row) {
        $storedtoken = $row['token'];

        // Check if the entered OTP matches the stored OTP
        if ($storedtoken === $token) {
            $updatesql = "UPDATE registration SET user_password = '$hashedPassword' WHERE user_email = '$email'";
            $conn->query($updatesql);
            $updatetoken = "UPDATE otp SET token = '99999' WHERE user_id = '$email'";
            $conn->query($updatetoken);
            echo "<script>
                alert('Password Changed Sucessfully!');
              window.location.href = 'login.php';
            </script>";
            exit();
            } else {
            echo "<script>
                alert('Cannot change again with same link! Try Again');
              window.location.href = 'forgotpassword.php';
            </script>";
            exit();
            }
        }else {
            echo "<script>
            alert('User not found.');
          window.location.href = 'forgotpassword.php';
        </script>";
        exit();
        }
}