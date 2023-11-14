<?php
session_start();
include "connection.php";
if (!isset($_SESSION["AdminloginId"])) {
    header("Location: login.php"); 
    exit();
}

$user_id = $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_POST["user_name"];
    $user_phone = $_POST["user_phone"];
    $user_email = $_POST["user_email"];

    $sql = "UPDATE registration SET user_name = '$user_name', user_phone = '$user_phone', user_email = '$user_email' WHERE user_id = $user_id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: adminpaneluser.php");
        exit();
    } else {
        echo "Error updating user: " . $conn->error;
    }
}

$sql = "SELECT user_name, user_phone, user_email, user_password FROM registration WHERE user_id = $user_id";
$result = $conn->query($sql);

if ($result === false) {
    die("Error in SQL query: " . $conn->error);
}

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_name = $row["user_name"];
    $user_phone = $row["user_phone"];
    $user_email = $row["user_email"];

} else {
    echo "User not found.";
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
        height:93;
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
        <h2>Edit User</h2>
        <form method="post">
            <input type="text" name="user_name" value="<?php echo $user_name; ?>" placeholder="User Name" required><br>
            <input type="text" name="user_phone" value="<?php echo $user_phone; ?>" placeholder="User Phone" required><br>
            <input type="text" name="user_email" value="<?php echo $user_email; ?>" placeholder="User Email" required><br>
            <input type="submit" value="Update">
        </form>
    </div>
    </div>
</body>
</html>
