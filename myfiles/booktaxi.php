<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="./style/style.css">
    <title>BoltCabs</title>
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
    width: calc(33.33% - 20px); /* 3 cards in a row with some spacing */
    box-sizing: border-box; /* Include padding in width calculation */
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
include "connection.php"; // Make sure you have the database connection set up



if (isset($_SESSION['bookingid'])) {
    $bookingid = $_SESSION['bookingid'];

    $sql = "SELECT district FROM bookings WHERE booking_id = '$bookingid'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_district = $row['district'];

        $sql = "SELECT * FROM taxis WHERE taxi_status = 'Available' AND taxi_location LIKE '%$user_district%'
        ";
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="taxi-card">';
                echo "<img class='taxi-image' src='{$row['taxi_image']}' alt='Taxi Image'>";


                echo '<h2>' . $row['taxi_model'] . '</h2>';
                echo '<p><strong>Location:</strong> ' . $row['taxi_location'] . '</p>';
                echo '<p><strong>Driver Name:</strong> ' . $row['taxi_drivername'] . '</p>';
                echo '<a href="carinfo.php?taxi_id=' . $row['taxi_id'] . '" class="book-button">Book Now</a>';
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