<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="./style/style.css">
    <title>BoltCabs</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
    text-align: center;
}

.back-button {
    background-color: #28a745;
    color: #fff;
    text-decoration: none;
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    font-weight: bold;
    margin: 20px;
    display: inline-block;
}

        .booking-details-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 60vh;
        }

        .booking-details {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            text-align: center;
        }

        .booking-image {
            max-width: 60%;
            margin: 0 auto;
            display: block;
        }

        .details p {
            margin: 5px 0;
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
<br><br><br><br><br><br><br>


    <div class="booking-details-container">
    <?php
include "connection.php"; 
if (isset($_GET['booking_id'])) {
    $booking_id = $_GET['booking_id'];
    $sql = "SELECT * FROM bookings WHERE booking_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $car_id = $row['car_id'];
        $carSQL = "SELECT * FROM taxis WHERE taxi_id = ?";
        $stmt = $conn->prepare($carSQL);
        $stmt->bind_param("i", $car_id);
        $stmt->execute();
        $carResult = $stmt->get_result();
        $carRow = $carResult->fetch_assoc();

        echo '<div class="booking-details">';
        echo '<img src="' . $carRow['taxi_image'] . '" alt="Booking Image" class="booking-image">';
        echo '<div class="details">';
        echo '<p><strong>Booking ID:</strong> ' . $row['booking_id'] . '</p>';
        echo '<p><strong>Pickup Location:</strong> ' . $row['pickup_location'] . '</p>';
        echo '<p><strong>Dropoff Location:</strong> ' . $row['dropoff_location'] . '</p>';
            echo '<p><strong>Arrival Date and Time  :</strong> ' . $row['pickup_datetime'] . '</p>';
        echo '<p><strong>Car Model:</strong> ' . $carRow['taxi_model'] . '</p>';
        echo '<p><strong>Car Registration Number:</strong> ' . $carRow['taxi_regno'] . '</p>';
        echo '<p><strong>Driver Name:</strong> ' . $carRow['taxi_drivername'] . '</p>';
        echo '<p><strong>Cost:</strong> ₹' . $row['cost'] . '</p>';
        echo '</div>';
        echo '</div>';
    } else {
        echo 'Booking not found.';
    }
} else {
    echo 'Booking ID not provided.';
}
?>

</div>
<a href="dashboard.php" class="back-button">Back</a>
</body>
</html>