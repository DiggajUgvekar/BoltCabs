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

    $deleteBookingSQL = "DELETE FROM bookings WHERE booking_id = ?";
    $deleteBookingStmt = $conn->prepare($deleteBookingSQL);
    $deleteBookingStmt->bind_param("i", $booking_id);

    if ($deleteBookingStmt->execute()) {
        echo '<script>alert("Booking Cancelled Successfully")</script>';
        echo '<script>window.location.href = "dashboard.php";</script>';
    } else {
        echo '<script>alert("Failed to Cancel")</script>';
        
        echo '<script>window.location.href = "dashboard.php";</script>';
    }

    } else {
        echo '<script>alert("Booking not found")</script>';
                echo '<script>window.location.href = "dashboard.php";</script>';
    }
} else {
    echo '<script>alert("Booking ID not provided.")</script>';
       echo '<script>window.location.href = "dashboard.php";</script>';
}
?>
