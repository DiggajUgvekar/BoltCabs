<?php
session_start();
include "connection.php";

if (!isset($_SESSION["AdminloginId"])) {
    header("Location: login.php"); 
    exit();
}

if (isset($_POST['submit'])) {
    $admin_name = $_POST['admin_name'];
    $admin_password = $_POST['admin_password'];

    $hashed_password = password_hash($admin_password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO admin_login (admin_name, admin_password) VALUES ('$admin_name', '$hashed_password')";

    if ($conn->query($sql) === true) {
        echo '<script>alert("New Admin Added!");window.location.href = "adminpanel.php";</script>';
    } else {
        echo '<script>alert("Operation Failed!");</script>';
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
       body {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
        display: flex;
        background-color: #1e1e1e;
    }

    .sidebar {
        background-color: #121212;
        color: white;
        width: 250px;
        padding: 20px;
        min-height: 93vh;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .content {
        flex: 1;
        padding: 20px;
        background-color: #1e1e1e;
        color: white;
    }

    .sidebar a {
        display: block;
        color: white;
        text-decoration: none;
        padding: 15px 20px;
        transition: background-color 0.3s;
    }

    .sidebar a:hover {
        background-color: #222222;
    }

    .header {
        background-color: #111;
        color: white;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header h1 {
        margin: 0;
        font-size: 24px;
    }

    .logout {
        background-color: #333;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .logout:hover {
        background-color: #444;
    }

    .logout a {
        text-decoration: none;
        color: white;
        display: block;
        padding: 10px 20px;
    }

    .logout a:hover {
        background-color: #444;
    }

    .sidebar-bottom {
        margin-top: auto;
    }
        
    .content {
        display: flex;
        justify-content: center;
        align-items: center;
        height:93vh;
        background-color: #1e1e1e;
    }

    .user.details {
        background-color: #333;
        color: white;
        padding: 20px;
        border-radius: 10px;
        width: 350px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); 
    }

    .user.details h2 {
        font-size: 24px;
        margin: 0 0 20px; 
    }

    .user.details input[type="text"] {
        background-color: #444;
        color: white;
        border: none;
        padding: 10px;
        margin: 10px 0; 
        width: 95%;
        border-radius: 5px;
    }
    .user.details input[type="password"] {
        background-color: #444;
        color: white;
        border: none;
        padding: 10px;
        margin: 10px 0; 
        width: 95%;
        border-radius: 5px;
    }
    .user.details input[type="submit"] {
        background-color: #000;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        margin-top: 10px; 
    }

    .user.details input[type="submit"]:hover {
        background-color: #444;
    }
 
    </style>
</head>
<body>
<div class="sidebar">
        <h2>BoltCabs</h2>
        <a href="adminpanel.php">Dashboard</a>
        <a href="#">Users</a>
        <a href="adminpaneltaxis.php">Cars & Drivers</a>
        <a href="adminpanelbooking.php">Bookings</a>
        <div class="sidebar-bottom">
            <button class="logout"><a href="adminlogout.php">Logout</a></button>
        </div>
    </div>

<div class="content">
    <div class="user details">
        <form method="POST" action="addadmins.php">
            <input type="text" name="admin_name" placeholder="Admin Name" required>
            <input type="password" name="admin_password" placeholder="Admin Password" required>
            <button type="submit" name="submit">Add Admin</button>
        </form>
    </div>
</div>
</body>
</html>
