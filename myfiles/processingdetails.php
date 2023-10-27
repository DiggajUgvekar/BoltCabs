<?php
include "connection.php"; // Include your database connection script
session_start();
if (isset($_SESSION['bookingid']) && isset($_SESSION['taxi_id'])) {
    $booking_id = $_SESSION['bookingid'];
    $car_id = $_SESSION['taxi_id'];

    // Update the booking status to "Confirmed"
    $bookingStatus = "Confirmed";
    $updateBookingStatusSQL = "UPDATE bookings SET booking_status = ? WHERE booking_id = ?";
    $stmt = $conn->prepare($updateBookingStatusSQL);
    $stmt->bind_param("si", $bookingStatus, $booking_id);
    
    // Update the car_id to associate the booking with the selected car
    $updateCarIdSQL = "UPDATE bookings SET car_id = ? WHERE booking_id = ?";
    $stmt2 = $conn->prepare($updateCarIdSQL);
    $stmt2->bind_param("ii", $car_id, $booking_id);
    
    $updateTaxiStatusSQL = "UPDATE taxis SET taxi_status = 'Booked' WHERE taxi_id = ?";
    $stmt3 = $conn->prepare($updateTaxiStatusSQL);
    $stmt3->bind_param("i", $car_id);

    // Execute the update queries
    $stmt->execute();
    $stmt2->execute();
    $stmt3->execute();
    
    $stmt->close();
    $stmt2->close();
    $stmt3->close();
    
    
    echo "<script>
    setTimeout(function() {
        // Hide the loader and show the checkmark
        document.querySelector('.loader').style.display = 'none';
        document.querySelector('.checkmark').style.display = 'inline';

        // Update the message
        document.querySelector('#details').innerHTML = 'Booking confirmed successfully';

        // Redirect to the receipt page after a short delay
        setTimeout(function() {
            window.location.href = 'dashboard.php';
        }, 2000); // Wait for 2 seconds after showing the checkmark
    }, 5000);
</script>
";

    // Redirect to another page after confirmation
    // echo '<script>window.location.href = "confirmation-page.php";</script>';
} else {
    echo 'Booking ID or Car ID not provided.';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Processing...</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.processing-container {
    text-align: center;
    background-color: #fff;
    border: 1px solid #ddd;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    max-width: 300px;
}

.processing-animation {
    margin-bottom: 20px;
}

.loader {
    border: 4px solid #f3f3f3;
    border-top: 4px solid #3498db;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 2s linear infinite;
}

.message {
    font-size: 16px;
}
.checkmark {
    display: none; /* Initially hidden */
    font-size: 40px; /* Adjust the font size as needed */
    color: #00cc00; /* Green color for the checkmark */
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

    </style>
</head>
<body>
    
    <div class="processing-container">
    <div class="processing-animation">
    <div class="loader"></div>
    <div class="checkmark">&#10003;</div>
</div>

        <div class="message">
            <!-- Display a message to the user -->
            <p id="details">Processing your request...</p>
        </div>
    </div>

  
</body>
</html>
