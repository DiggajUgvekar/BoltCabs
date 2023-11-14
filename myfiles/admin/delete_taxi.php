<?php
include "connection.php";
if (isset($_GET['id'])) {
    $taxiId = $_GET['id'];

    $sql = "DELETE FROM taxis WHERE taxi_id = $taxiId";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Taxi Deleted Successfully!');
            </script>";
        header("Location: adminpaneltaxis.php");
        exit();
    } else {
        echo "Error deleting taxi: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Taxi ID not provided.";
}
?>
