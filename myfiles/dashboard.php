<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="./style/style.css">
    <title>DashBoard - BoltCabs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        
  body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
  }

  .book-more-button {
  background-color: white; 
  color: black;
  text-decoration: none;
  padding: 25px 40px;
  border: none;
  border-radius: 35px;
  font-weight: bold;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  transition: background-color 0.3s ease;
  text-transform: uppercase; 
  letter-spacing: 2px; 
  font-size: 18px;
  cursor: pointer; 
  display: inline-block; 
  margin: 10px; 
}

.book-more-button:hover {
  background-color: white; 
  transform: scale(1.05); 
}



  .bookings-heading {
    font-size: 24px;
    margin-top: 20px;
    margin:25px;
  }

  .booking-details {
    background-color: #fff;
    margin: 20px;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);

  max-height: 200px; 
  overflow: auto; 


  }

  .car-image {
    max-width: 250px;
    max-height: 250px;
    float: left;
    margin-right: 20px;
  }

  .details {
    float: left;
  }

  .details p {
    margin: 5px 0;
  }

  .button-container {
    clear: both;
    margin-top: 10px;
    
  }

  .view-button {
    background-color: #28a745;
    color: #fff;
    text-decoration: none;
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    font-weight: bold;
  }

  .cancel-button {
    background-color: #dc3545;
    color: #fff;
    text-decoration: none;
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    font-weight: bold;
    margin-left: 10px;
  }

  .no-bookings-message {
    font-size: 18px;
    margin-top: 20px;
  }

  .button-container-booknow {
  display: grid;
  place-items: center; 
  height: 40vh; 
  background-image:url(img/bg4.png);
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

<br><br><br>    <br> 
<div class="button-container-booknow">
  <a href="selectroute.php" class="book-more-button">Book Now</a>
</div>

<br><br><br>
<h1 class="bookings-heading">Your Bookings</h1>
    <?php
include "connection.php";   

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    $bookingSQL = "SELECT * FROM bookings WHERE user_email = ? AND booking_status = 'Confirmed'";
    $stmt = $conn->prepare($bookingSQL);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $bookingResult = $stmt->get_result();

    if ($bookingResult->num_rows > 0) {
        while ($bookingRow = $bookingResult->fetch_assoc()) {
            $car_id = $bookingRow['car_id'];
            $carSQL = "SELECT * FROM taxis WHERE taxi_id = ?";
            $stmt = $conn->prepare($carSQL);
            $stmt->bind_param("i", $car_id);
            $stmt->execute();
            $carResult = $stmt->get_result();
            $carRow = $carResult->fetch_assoc();

            echo '<div class="booking-details">';
            echo '<img src="' . $carRow['taxi_image'] . '" alt="Car Image" class="car-image">';
            echo '<div class="details">';
            echo '<p><strong>Booking ID:</strong> ' . $bookingRow['booking_id'] . '</p>';
            echo '<p><strong>Car Model:</strong> ' . $carRow['taxi_model'] . '</p>';
            echo '<p><strong>Car Registration Number:</strong> ' . $carRow['taxi_regno'] . '</p>';
            echo '<p><strong>Pickup Location:</strong> ' . $bookingRow['pickup_location'] . '</p>';
            echo '<p><strong>Arrival Date and Time  :</strong> ' . $bookingRow['pickup_datetime'] . '</p>';
            echo '<div class="button-container">
            <a href="viewbooking.php?booking_id='.$bookingRow["booking_id"] .'" class="view-button">View Booking</a>
            <a href="cancelbooking.php?booking_id='.$bookingRow["booking_id"] .'" class="cancel-button">Cancel Booking</a>
        </div>
        ';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p class="no-bookings-message">No confirmed bookings available.</p>';

    }
} else {
    echo "User is not logged in.";
}


?>
  <footer>
    <div class="footer-content">
       
        <div class="social-icons">
            <a href="#" ><i class="fab fa-facebook"></i></a>
            <a href="#" ><i class="fab fa-instagram"></i></a>
            <a href="#" ><i class="fab fa-linkedin"></i></a>
            <a href="#" ><i class="fab fa-twitter"></i></a>
        </div>
        <div class="footer-links">
            <a href="#"><i class="fas fa-file-alt"></i> Terms of Service</a>
            <a href="#"><i class="fas fa-shield-alt"></i> Privacy Policy</a>
            <a href="contact.php"><i class="fas fa-envelope"></i> Contact Us</a>
            <a href="#"><i class="fas fa-question-circle"></i> FAQ</a>
            <a href="#"><i class="fas fa-phone-alt"></i> Customer Support</a>
        </div>
    </div>
</footer>
</body>
</html>