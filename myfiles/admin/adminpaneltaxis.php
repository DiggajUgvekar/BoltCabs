<?php
session_start();
include "connection.php";   

$sql = "SELECT taxi_id, taxi_regno, taxi_model, taxi_color, taxi_capacity, taxi_type, taxi_image, taxi_location, taxi_drivername ,base_price FROM taxis";
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
        .sidebar-bottom {
            background-color: #121212;
            position: fixed;
            bottom: 0;
            width: 100px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .logout {
            background-color: #333;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
            padding: 10px 20px;
        }  
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .addtaxi {
            background-color: #333;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
            padding: 10px 20px;
    }
    .addtaxi:hover{
        background-color: #444;
    }

    </style>
</head>
<body>
    <div class="sidebar">
        <h2>BoltCabs</h2>
        <a href="adminpanel.php">Dashboard</a>
        <a href="adminpaneluser.php">Users</a>
        <a href="#">Cars & Drivers</a>
        <a href="adminpanelbooking.php">Bookings</a>
        <div class="sidebar-bottom">
            <button class="logout"><a href="adminlogout.php">Logout</a></button>
        </div>
    </div>

    <div class="content">
        <div class="user details">
    <h2>Taxi details</h2>
    <table>
        <tr>
            <th>Taxi Id</th>
            <th>taxi Regno</th>
            <th>Taxi Model</th>
            <th>Taxi color</th>
            <th>Taxi Capacity</th>
            <th>Taxi Type</th>
            <th>Taxi Image</th>
            <th>Taxi Location</th>
            <th>Taxi driver Name</th>
            <th>Taxi Base Price</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["taxi_id"] . "</td>";
                echo "<td>" . $row["taxi_regno"] . "</td>";
                echo "<td>" . $row["taxi_model"] . "</td>";
                echo "<td>" . $row["taxi_color"] . "</td>";
                echo "<td>" . $row["taxi_capacity"] . "</td>";
                echo "<td>" . $row["taxi_type"] . "</td>";
                echo "<td>" . '<img src="../' . $row['taxi_image'] . '" alt="Car Image" width="100" height="70" class="car-image" >' . "</td>";
              
                echo "<td>" . $row["taxi_location"] . "</td>";
                echo "<td>" . $row["taxi_drivername"] . "</td>";
                echo "<td>" . $row["base_price"] . "</td>";
                echo "<td class='action-icons'>";
                echo "<a href='edit_taxi.php?id=" . $row["taxi_id"] . "' title='Edit Taxi'><i class='fa fa-edit'></i></a>";
                echo "<a href='delete_taxi.php?id=" . $row["taxi_id"] . "' title='Delete Taxi'><i class='fa fa-trash'></i></a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "No users found.";
        }
        ?>
    </table>
        
        <div class='button-container'>
        <button onclick='myFunction()' class='addtaxi'>
        <i class='fas fa-plus'></i> Add Taxi
    </button>
    </div>
</div>  
    </div>

    <script>
function myFunction() {
        window.location.href="addtaxi.php";
    }
    </script>;

</body>
</html>
