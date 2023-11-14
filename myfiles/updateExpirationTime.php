<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['bookingid']) && isset($data['travelTimeInMinutes'])) {
        $bookingid = $data['bookingid'];
        $travelTimeInMinutes = $data['travelTimeInMinutes'];
        $distanceInKilometers = $data['distanceInKilometers'];
        $updatedist = "UPDATE bookings SET distance = " . (int)$distanceInKilometers . " WHERE booking_id = $bookingid";
        
        $conn->query($updatedist) ;
        $sql = "SELECT pickup_datetime FROM bookings WHERE booking_id = $bookingid";
        $result = $conn->query($sql);
        

        if ($result && $row = $result->fetch_assoc()) {
            $pickupDatetime = new DateTime($row['pickup_datetime']);

            $travelTimeInSeconds = round($travelTimeInMinutes * 60);
            $interval = new DateInterval('PT' . $travelTimeInSeconds . 'S');

            $expirationDatetime = clone $pickupDatetime;
            $expirationDatetime->add($interval);
            $expirationDatetimeStr = $expirationDatetime->format('Y-m-d H:i:s');

            $updateSql = "UPDATE bookings SET expiration_datetime = '$expirationDatetimeStr' WHERE booking_id = $bookingid";

            if ($conn->query($updateSql) === true) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('success' => false, 'message' => 'Error updating expiration_time: ' . $conn->error));
            }
        } else {
            echo json_encode(array('success' => false, 'message' => 'Error fetching pickup_datetime: ' . $conn->error));
        }
    } else {
        echo json_encode(array('success' => false, 'message' => 'Missing data'));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid request method'));
}

?>
