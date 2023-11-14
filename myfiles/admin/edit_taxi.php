<?php
session_start();
include "connection.php";

if (!isset($_SESSION["AdminloginId"])) {
    header("Location: login.php"); 
    exit();
}

$taxi_id = $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $taxi_regno = $_POST["taxi_regno"];
    $taxi_model = $_POST["taxi_model"];
    $taxi_color = $_POST["taxi_color"];
    $taxi_capacity = $_POST["taxi_capacity"];
    $taxi_type = $_POST["taxi_type"];
    $taxi_image = $_POST["taxi_image"];
    $taxi_location = $_POST["taxi_location"];
    $taxi_drivername = $_POST["taxi_drivername"];
    $base_price = $_POST["base_price"];
    $sql = "UPDATE taxis SET taxi_regno = '$taxi_regno', taxi_model = '$taxi_model', taxi_color = '$taxi_color', taxi_capacity = '$taxi_capacity', taxi_type = '$taxi_type', taxi_image = '$taxi_image', taxi_location = '$taxi_location', taxi_drivername = '$taxi_drivername' , base_price = '$base_price' WHERE taxi_id = $taxi_id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: adminpaneltaxis.php");
        exit();
    } else {
        echo "Error updating taxi: " . $conn->error;
    }
}

$sql = "SELECT taxi_regno, taxi_model, taxi_color, taxi_capacity, taxi_type, taxi_image, taxi_location, taxi_drivername, base_price FROM taxis WHERE taxi_id = $taxi_id";
$result = $conn->query($sql);

if ($result === false) {
    die("Error in SQL query: " . $conn->error);
}

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $taxi_regno = $row["taxi_regno"];
    $taxi_model = $row["taxi_model"];
    $taxi_color = $row["taxi_color"];
    $taxi_capacity = $row["taxi_capacity"];
    $taxi_type = $row["taxi_type"];
    $taxi_image = $row["taxi_image"];
    $taxi_location = $row["taxi_location"];
    $taxi_drivername = $row["taxi_drivername"];
    $base_price = $row["base_price"];
} else {
    echo "Taxi not found.";
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
        <form method="post">
            <input type="text" name="taxi_regno" value="<?php echo $taxi_regno; ?>" placeholder="Taxi Registration Number" required><br>
            <input type="text" name="taxi_model" value="<?php echo $taxi_model; ?>" placeholder="Taxi Model" required><br>
            <input type="text" name="taxi_color" value="<?php echo $taxi_color; ?>" placeholder="Taxi Color" required><br>
            <input type="text" name="taxi_capacity" value="<?php echo $taxi_capacity; ?>" placeholder="Taxi Capacity" required><br>
            <input type="text" name="taxi_type" value="<?php echo $taxi_type; ?>" placeholder="Taxi Type" required><br>
            <input type="text" name="taxi_image" value="<?php echo $taxi_image; ?>" placeholder="Taxi Image" required><br>
            <input type="text" name="taxi_location" value="<?php echo $taxi_location; ?>" placeholder="Taxi Location" required><br>
            <input type="text" name="taxi_drivername" value="<?php echo $taxi_drivername; ?>" placeholder="Driver Name" required><br>
            <input type="text" name="base_price" value="<?php echo $base_price; ?>" placeholder="Base Price" required><br>
            <input type="submit" value="Update">
        </form>
    </div>
    </div>
</body>
</html>
