<?php
include "connection.php";
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $sql = "DELETE FROM registration WHERE user_id = $userId";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('User Deleted Successfully!');
            </script>";
        header("Location: adminpaneluser.php");
        exit();
    } else {
        echo "Error deleting user: " . $conn->error;
    }
    $conn->close();
} else {
    echo "User ID not provided.";
}
?>
