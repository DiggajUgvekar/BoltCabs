<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="./style/style.css">
    <title>BoltCabs booking</title>
    <style>
body {
    font-family: Arial, sans-serif;
    text-align: center;
    margin: 20px;
}

h1 {
    color: #333;
    margin: 20px;
}


.taxi-cards-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.taxi-card {
    border: 1px solid #ccc;
    padding: 10px;
    margin: 10px 0;
    width: calc(33.33% - 20px); 
    box-sizing: border-box; 
        text-align: center;
}

.taxi-image {
    max-width: 100%;
    width: 100%;
    height: auto;
}
.taxi-card h2 {
    margin: 10px 0;
}

.taxi-card p {
    margin: 5px 0;
}

.book-button {
    display: block;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    padding: 5px 10px;
    border-radius: 5px;
    margin: 10px auto;
}

.book-button:hover {
    background-color: #0056b3;
}

        </style>

<body>
<header>
        <a href="index.php" class = "logo">BoltCabs</a>
        <ul class="nav-page">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <ul>
        <?php
        session_start();
        if(isset($_SESSION['email'])){
           echo '<li><a href="logout.php" class="logout">LOGOUT</a></li>';
        }
        else{
        echo '<li><a href="login.php" class="login">Log In</a></li>';
        echo '<li><a href="signup.php" class="signup">Sign Up</a></li>';
        }
        ?>
        </ul>
    </header>
    <br><br> <br> <br>  
    <h1>Available Taxis</h1>

    <div class="taxi-cards-container">
    <?php
include "connection.php"; 


if (isset($_SESSION['bookingid'])) {
    $bookingid = $_SESSION['bookingid'];

    $sql = "SELECT district,pickup_datetime,expiration_datetime,distance FROM bookings WHERE booking_id = '$bookingid'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row2 = $result->fetch_assoc();
        $user_district = $row2['district'];
        $pickup_datetime = $row2['pickup_datetime'];
        $expiration_datetime = $row2['expiration_datetime'];
        $distance = $row2['distance'];

$sql = "SELECT * FROM taxis WHERE taxi_location LIKE '%$user_district'
AND NOT EXISTS (
    SELECT 1
    FROM bookings AS b
    WHERE taxis.taxi_id = b.car_id
    AND b.booking_status = 'Confirmed'
    AND (
        '$pickup_datetime' BETWEEN b.pickup_datetime AND DATE_ADD(b.expiration_datetime, INTERVAL 20 MINUTE)
        OR '$expiration_datetime' BETWEEN b.pickup_datetime AND DATE_ADD(b.expiration_datetime, INTERVAL 20 MINUTE)
    )
)";

$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error); 
}
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="taxi-card">';
                echo "<img class='taxi-image' src='{$row['taxi_image']}' alt='Taxi Image'>";

                
                echo '<h2>' . $row['taxi_model'] . '</h2>';
                echo '<p><strong>Location:</strong> ' . $row['taxi_location'] . '</p>';
                echo '<p><strong>Driver Name:</strong> ' . $row['taxi_drivername'] . '</p>';
                $cost = $row['base_price'] + ($distance * 10);
                echo '<p><strong>Price:</strong> ₹ ' . $cost . '</p>';
                echo '<form action="carinfo.php" method="post" class="book-form" data-taxi-id="' . $row['taxi_id'] . '">';
echo '<input type="hidden" name="taxi_id" value="' . $row['taxi_id'] . '">';
echo '<input type="hidden" name="cost" value="' . $cost . '">';
echo '<input type="submit" value="Book Now" class="book-button">';
echo '</form>';

                echo '</div>';
            }
        }
        else {
            echo 'No available taxis at the moment.';
        }
    }
} else {
    echo "User is not logged in.";
}

?>

</div>


</body>
</html>