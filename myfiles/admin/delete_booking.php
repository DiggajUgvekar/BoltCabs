<?php
include "connection.php";
if (isset($_GET['id'])) {
    $bookingId = $_GET['id'];

    $sql = "DELETE FROM bookings WHERE booking_id = $bookingId";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Booking Deleted Successfully!');
            </script>";
        header("Location: adminpaneltaxis.php");
        exit();
    } else {
        echo "Error deleting booking: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Booking Id not provided.";
}
?>
