<?php
include 'connection.php';
session_start();
$email = $_POST["email"];
$password = $_POST["password"];


$sql = "SELECT user_password FROM registration WHERE user_email = '$email'";
$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    if ($row) {
        $storedpassword = $row['user_password'];
        if (password_verify($password, $storedpassword)) {
            $_SESSION["email"] = $email;
            echo "<script>
                alert('Login Successfully!!');
              window.location.href = 'book.php';
            </script>";
            exit();
        } else {
            echo "<script>
                alert('Login Failed!!');
              window.location.href = 'login.php';
            </script>";
            exit();
        }
        
    }

}
?>