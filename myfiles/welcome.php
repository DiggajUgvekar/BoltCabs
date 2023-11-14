<?php
include 'connection.php';

if (isset($_POST["otpnumber"])) {
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
            $expiryTimestampFor = strtotime($expiryTimestamp);
            if ($enteredOTP === $storedOTP) {
                date_default_timezone_set('Asia/Kolkata');
                $currentTimestamp = time();
                if ($currentTimestamp < $expiryTimestampFor) {
                    $stmt = $conn->prepare("INSERT INTO registration (user_name, user_phone, user_email, user_password) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("ssss", $name, $phoneno, $email, $hashedPassword);
                    $stmt->execute();
                    echo "<script>
                        alert('OTP verified successfully!');
                        window.location.href = 'dashboard.php';
                    </script>";
                    exit();
                } else {
                    echo "<script>
                        alert('OTP has expired. Please request a new OTP.');
                        window.location.href = 'signup.php';
                    </script>";
                    exit();
                }
            } else {
                echo "<script>
                    alert('Incorrect OTP entered.');
                    window.location.href = 'signup.php';
                </script>";
                exit();
            }
        } else {
            echo "<script>
                alert('User not found or OTP record not found.');
                window.location.href = 'signup.php';
            </script>";
            exit();
        }
    }
}
