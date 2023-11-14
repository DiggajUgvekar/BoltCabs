<?php
session_start();
include 'connection.php';
$queryUsers = "SELECT COUNT(*) as userCount FROM registration";
$queryTaxis = "SELECT COUNT(*) as taxiCount FROM taxis";
$queryBookings = "SELECT COUNT(*) as bookingCount FROM bookings";

$resultUsers = $conn->query($queryUsers);
$resultTaxis = $conn->query($queryTaxis);
$resultBookings = $conn->query($queryBookings);

if ($resultUsers && $resultTaxis && $resultBookings) {
    $rowUsers = $resultUsers->fetch_assoc();
    $rowTaxis = $resultTaxis->fetch_assoc();
    $rowBookings = $resultBookings->fetch_assoc();
    
    $usersCount = $rowUsers['userCount'];
    $taxisCount = $rowTaxis['taxiCount'];
    $bookingsCount = $rowBookings['bookingCount'];
} else {
    $usersCount = 0;
    $taxisCount = 0;
    $bookingsCount = 0;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
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

    .statistics {
        display: flex;
        justify-content: space-around;
        padding: 20px;
    }

    .stat-box {
        background-color: #333;
        padding: 20px;
        text-align: center;
        border-radius: 10px;
        flex: 1;
        margin: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
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

    .view-button {
        text-decoration: none;
        color: #fff;
        display: block;
        padding: 10px 20px;
        background-color: #000;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
        text-align: center;
        margin: 0 auto;
    }

    .view-button a {
        text-decoration: none;
        color: #fff;
        margin:10px;
    }

</style>


</head>
<body>
    <div class="sidebar">
        <h2>BoltCabs</h2>
        <a href="adminpanel.php">Dashboard</a>
        <a href="adminpaneluser.php">Users</a>
        <a href="adminpaneltaxis.php">Cars & Drivers</a>
        <a href="adminpanelbooking.php">Bookings</a>
        <div class="sidebar-bottom">
            <button class="logout"><a href="adminlogout.php">Logout</a></button>
        </div>
    </div>

    <div class="content">
        <div class="header">
            <h1>WELCOME TO ADMIN PANEL - <?php echo $_SESSION['AdminloginId']?></h1>
        </div>

        <div class="statistics">
            <div class="stat-box">
                <h2>Users</h2>
                <p><?php echo $usersCount; ?></p>
                <button class="view-button"><a href="adminpaneluser.php">View</a></button>
            </div>

            <div class="stat-box">
                <h2>Taxis</h2>
                <p><?php echo $taxisCount; ?></p>
                <button class="view-button"><a href="adminpaneltaxis.php">View</a></button>
            </div>

            <div class="stat-box">
                <h2>Drivers</h2>
                <p><?php echo $taxisCount; ?></p>
                <button class="view-button"><a href="adminpaneltaxis.php">View</a></button>
            </div>

            <div class="stat-box">
                <h2>Bookings</h2>
                <p><?php echo $bookingsCount; ?></p>
                <button class="view-button"><a href="adminpanelbooking.php">View</a></button>
            </div>
        </div>
    </div>
</body>
</html>
