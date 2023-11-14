<?php
session_start();
include "connection.php";   

$sql = "SELECT booking_id, user_email, pickup_location, district, dropoff_location, booking_status, pickup_datetime, created_at,  expiration_datetime, car_id,distance, cost FROM bookings";
$result = $conn->query($sql);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
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
    .user.details table {
            width: 100%;
            border-collapse: collapse;
        }

        .user.details table th, .user.details table td {
            border: 1px solid #444;
            padding: 10px;
            color: white;
        }

        .user.details table th {
            background-color: #333;
        }

        .user.details table td {
            background-color: #111;
        }

        .user.details .action-icons a {
            color: #fff;
            text-decoration: none;
            margin: 0 5px;
        }

        .user.details .action-icons a i {
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>BoltCabs</h2>
        <a href="adminpanel.php">Dashboard</a>
        <a href="adminpaneluser.php">Users</a>
        <a href="adminpaneltaxis.php">Cars & Drivers</a>
        <a href="#">Bookings</a>
        <div class="sidebar-bottom">
            <button class="logout"><a href="adminlogout.php">Logout</a></button>
        </div>
    </div>

    <div class="content">
        <div class="user details">
    <h2>Bookings List</h2>
    <table>
        <tr>
            <th>Booking Id</th>
            <th>User Email</th>
            <th>Pickup Location</th>
            <th>District</th>
            <th>Dropoff Location</th>
            <th>Booking Status</th>
            <th>Pickup date & time</th>
            <th>Created at</th>
            <th>Expiratin Date Time</th>
            <th>car Id</th>
            <th>Distance</th>
            <th>Cost</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["booking_id"] . "</td>";
                echo "<td>" . $row["user_email"] . "</td>";
                echo "<td>" . $row["pickup_location"] . "</td>";
                echo "<td>" . $row["district"] . "</td>";
                echo "<td>" . $row["dropoff_location"] . "</td>";
                echo "<td>" . $row["booking_status"] . "</td>";
                echo "<td>" . $row["pickup_datetime"] . "</td>";
                echo "<td>" . $row["created_at"] . "</td>";
                echo "<td>" . $row["expiration_datetime"] . "</td>";
                echo "<td>" . $row["car_id"] . "</td>";
                echo "<td>" . $row["distance"] . "</td>";
                echo "<td>" . $row["cost"] . "</td>";
                echo "<td class='action-icons'>";
                echo "<a href='edit_booking.php?id=" . $row["booking_id"] . "' title='Edit Booking'><i class='fa fa-edit'></i></a>";
                echo "<a href='delete_booking.php?id=" . $row["booking_id"] . "' title='Delete Booking'><i class='fa fa-trash'></i></a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "No users found.";
        }
        ?>
    </table>
</div>  
    </div>

    
</body>
</html>
