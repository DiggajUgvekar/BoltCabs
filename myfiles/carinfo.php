<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="./style/style.css">
    <title>BoltCabs</title>
    <script>
    var taxiCost = <?php echo json_encode($cost); ?>;
</script>

    <style>
                body {
            font-family: 'Arial', sans-serif;
            text-align: center;
            background-color: #fff;
            color: #333; 
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #333;
        }

        .taxi-details-container {
            max-width: 800px;
            margin: 0 auto;
            margin-top:100px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd; 
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1); 
            display: flex;
            align-items: center;
        }

        .taxi-image {
            max-width: 50%;
            display: block;
            border: 1px solid #ddd; 
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); 
        }

        .taxi-details {
            max-width: 50%;
            padding: 0 20px;
            color: #333;
        }

        .taxi-details p {
            margin: 10px 0;
        }

        .confirm-button {
            text-align: center; 
            margin-top: 20px; 
        }

        .confirm-button button {
            background-color: #007bff; 
            color: #fff; 
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .confirm-button button:hover {
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
<div class="taxi-details-container">
    <div class="taxi-details">
        <?php
        include "connection.php"; 
    if(isset($_SESSION['email'])){
        if (isset($_POST['taxi_id'])) {
            $taxi_id = $_POST['taxi_id'];
            $cost = $_POST['cost'];
            $_SESSION["taxi_id"] = $_POST['taxi_id'];
            $sql = "SELECT * FROM taxis WHERE taxi_id = $taxi_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                echo '<h1>Taxi Details</h1>';
                echo '<p><strong>Registration Number:</strong> ' . $row['taxi_regno'] . '</p>';
                echo '<p><strong>Model:</strong> ' . $row['taxi_model'] . '</p>';
                echo '<p><strong>Color:</strong> ' . $row['taxi_color'] . '</p>';
                echo '<p><strong>Capacity:</strong> ' . $row['taxi_capacity'] . '</p>';
                echo '<p><strong>Type:</strong> ' . $row['taxi_type'] . '</p>';
                echo '<p><strong>Location:</strong> ' . $row['taxi_location'] . '</p>';
                echo '<p><strong>Driver Name:</strong> ' . $row['taxi_drivername'] . '</p>';
                echo '<p><strong>Price:</strong> ₹<span id="taxiCost">' .$cost. '</span></p>';
                
            } else {
                echo 'Taxi not found.';
            }
        } else {
            echo 'Taxi ID not provided.';
        }
    }else{
        echo "User is Not Logged In!";
    }
        ?>
    </div>
  <img class="taxi-image" src="<?php echo $row["taxi_image"]; ?>" alt="Taxi Image">
            </div>
                <div class="confirm-button">
                    <button onclick="gotofunction()">Confirm Booking</button>
                </div>

                <script>
    function gotofunction() {
        var costElement = document.getElementById("taxiCost");
        var cost = costElement.textContent.trim();
        window.location.href = 'processingdetails.php?cost=' + cost;
    }
</script>

</body>
</html>