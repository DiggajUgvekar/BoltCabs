<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="./style/style.css">
    <title>BoltCabs</title>
    <style>
        
  body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
  }

  .book-more-button {
  background-color: white; /* Attractive background color */
  color: black;
  text-decoration: none;
  padding: 25px 40px;
  border: none;
  border-radius: 35px;
  font-weight: bold;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
  transition: background-color 0.3s ease;
  text-transform: uppercase; /* Uppercase text */
  letter-spacing: 2px; /* Increase letter spacing */
  font-size: 18px; /* Larger font size */
  cursor: pointer; /* Change cursor on hover */
  display: inline-block; /* Ensure it takes up the full width available */
  margin: 10px; /* Add spacing around the button */
}

.book-more-button:hover {
  background-color: white; /* Change color on hover */
  transform: scale(1.05); /* Slight scale increase on hover */
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

  max-height: 200px; /* Adjust as needed */
  overflow: auto; /* Add scrollbars if content exceeds the height */


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
  place-items: center; /* Center both horizontally and vertically */
  height: 40vh; /* Center within the viewport height */
  background-image:url(img/bg4.png);
}

        /* .booking-details {
    display: flex;
    align-items: center;
    margin: 20px;
    border: 1px solid #ddd;
    padding: 10px;
}
.no-bookings-message {
    text-align: center; 
    color: #777; 
    font-size: 16px; 
    font-style: italic; 
    margin: 10px 0; 
}


.car-image {
    max-width: 150px;
    margin-right: 20px;
}

.details {
    font-size: 16px;
    color: #333;
}
.book-more-button {
    width: 400px;
    font-size:40px;
    background-image: url(img/bg8.png);
    color: #fff;
    text-decoration: none;
    padding: 70px 100px;
    border-radius: 50px;
    display: block;
    margin: 10px auto; 
    text-align: center;
}

.book-more-button:hover {
    background-color:grey;
}

.button-container {
    text-align: center;
}

.view-button, .cancel-button {
    display: inline-block;

    color: #fff;
    text-decoration: none;
    padding: 10px 50px;
    border-radius: 5px;
    margin: 10px;
    text-align: center;
}
.view-button{
    background-color: #007bff;
}
.cancel-button {
    background:#ff0000;
}
.view-button:hover{
    background-color: #0056b3;
}
.cancel-button:hover{
    background:#AE2002  ;
}

.bookings-heading {
    font-size: 28px; 
    color: #333; 
    text-align: center;
    margin-top: 20px; 
    text-transform: uppercase; 
} */

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

            // Retrieve the car details
            $carSQL = "SELECT * FROM taxis WHERE taxi_id = ?";
            $stmt = $conn->prepare($carSQL);
            $stmt->bind_param("i", $car_id);
            $stmt->execute();
            $carResult = $stmt->get_result();
            $carRow = $carResult->fetch_assoc();

            // Display booking and car details
            echo '<div class="booking-details">';
            echo '<img src="' . $carRow['taxi_image'] . '" alt="Car Image" class="car-image">';
            echo '<div class="details">';
            echo '<p><strong>Booking ID:</strong> ' . $bookingRow['booking_id'] . '</p>';
            echo '<p><strong>Car Model:</strong> ' . $carRow['taxi_model'] . '</p>';
            echo '<p><strong>Car Registration Number:</strong> ' . $carRow['taxi_regno'] . '</p>';
            echo '<p><strong>Pickup Location:</strong> ' . $bookingRow['pickup_location'] . '</p>';
            echo '<p><strong>Arrival Date and Time  :</strong> ' . $bookingRow['pickup_datetime'] . '</p>';
            // Add more booking and car details as needed
            echo '<div class="button-container">
            <a href="viewbooking.php?booking_id='.$bookingRow["booking_id"] .'" class="view-button">View Booking</a>
            <a href="#" class="cancel-button">Cancel Booking</a>
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

</body>
</html>