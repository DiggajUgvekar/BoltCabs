<?php
  include 'connection.php';
  session_start();
  ?>
  <!DOCTYPE html>
  <html>

  <head>
    <title>Select Route</title>
      <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/login.css">
    <script src="https://kit.fontawesome.com/df94d1352d.js" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

    <style>
      body {
        margin: 0;
        padding: 0;
      }
      .container{
        background-image:url();
      }
      .maincontainer{ 
        background-image:url(img/route2.jpg);
        background-size: cover;
      }
      .centered-text {
    text-align: center;
    margin-top: 100px; /* You can adjust the margin-top to center the text vertically */
    font-size: 18px; /* Adjust the font size as needed */
    color: #333; /* Text color */
}

    </style>

  </head>

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
          
            // session_start();
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
      <?php

      if(isset($_SESSION["email"])){
      echo '<div class="maincontainer">
    <br><br>
      <div class="container">
          <div class="formbox">
              <h1 id="title">Select You Route</h1>
              <form action="selectroute.php" method="post">
                <div class="input-group">
                      <div class="input-field">
                      <label for="from" class="content-label" ><i class="fa-regular fa-circle-dot"></i></label>
                    <input type="text" name="from"id="from"placeholder="Pick Up Location" class="origin" required>
                        </div>

                        <div class="input-field">
                        <label for="from" class="content-label" ><i class="fa-regular fa-circle-dot"></i></label>  
                        <select name="district" id="district">
            <option value="North Goa">North Goa</option>
            <option value="South Goa">South Goa</option>
        </select>
        </div>
                    <div class="input-field">
                    <i class="fa-regular fa-calendar"></i>
                    <input type="datetime-local" id="arrivaltime" name="arrivaltime" required><br>
                    </div>
                    <div class="input-field">
                              <label for="to" class="content-label" ><i class="fa-solid fa-location-dot"></i></label>
                              <input type="text" id="to" name="to"placeholder="Destination Location" class="destination" required><br>

                    </div>
                    <div class="btn-field">
                        <button type="submit" id="route ">Confirm Route</button>
                        
                    </div>
                </div>
                                    
              </form>
            </div>
        
        </div>

    </div>';
      }
      else{
        // echo"<br><br><br><br><br>";
        echo ' <div class="centered-text">
        <strong>User is Not Logged In</strong>
    </div>';
      }
?>
  </body>
  </html>

  <?php
  include 'connection.php';

  if(isset($_POST["from"]) && isset($_POST["to"])&& isset($_POST["arrivaltime"])){

    $email = $_SESSION["email"];
    $from = $_POST["from"];
    $to = $_POST["to"];
    $district = $_POST["district"];
    $arrivaltime = $_POST["arrivaltime"];
    $arrivalTimestamp = date("Y-m-d H:i:s", strtotime($arrivaltime));
    date_default_timezone_set("Asia/Kolkata");
    $currentTimestamp = date("Y-m-d H:i:s"); 
    
    $sql = "INSERT INTO bookings (user_email, pickup_location, district, dropoff_location, booking_status, pickup_datetime, created_at) VALUES ('$email', '$from', '$district', '$to', 'Pending', '$arrivalTimestamp', '$currentTimestamp')";
    $conn->query($sql);
    $booking_id = $conn->insert_id;
    $_SESSION["bookingid"] = $booking_id;
    header("Location:showroute.php");
  }
  ?>