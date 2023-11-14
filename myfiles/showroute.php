<?php
  include 'connection.php';
  session_start();
  $bookingid = $_SESSION["bookingid"];
  $sql = "SELECT pickup_location, dropoff_location FROM bookings WHERE booking_id = $bookingid";
$result = $conn->query($sql);

if ($result) {
    $row = $result->fetch_assoc();

    echo "<script>";
    echo "var bookingData = " . json_encode($row) . ";";
    echo "</script>";

} else {
    echo "Error: " . $conn->error;
}
  ?>
  <!DOCTYPE html>
  <html>

  <head>
    <title>Show Route</title>
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
          #map{
              width:80%;
              height: 400px;
              margin: 30px auto;
              box-shadow: 0px 0px 1000px black;
              border:20px;
              z-index: 10;
          }
      .btn-field i{
        width: 100px
      }
      .container{
        background-image:url();
      }
      .maincontainer{
        background-image:url(img/route2.jpg);
        background-size: cover;
      }
      div.details{
      text-decoration: none;
      color: black;
      letter-spacing: 1px;
      font-weight: 500;
      font-size: 18px;
      background-color:white;
      margin:5px 120px 5px 120px;
      padding:20px;
      box-shadow: 0 15px 15px rgba(0, 0, 0, 0.05);

              display: flex;
              align-items: center;
              z-index: 100;

      }
      .details .distancetime{
        flex:1;
      }
      .details button{
        padding:20px;
        margin-left: 10px;
        background-color: #0074d9; 
        color: #ffffff; 
        padding: 10px 20px;
        font-size: 16px; 
        border: none; 
        border-radius: 5px;
        cursor: pointer; 
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
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
  <div class="maincontainer">
    <br><br>  
      <div class="container">
          <div id="map"></div>
          <div class="details">
            <div class="distancetime">
          <p id="distance">Distance: <span id="distanceValue"></span> kilometers</p>
          <p id="travelTime">Travel Time: <span id="travelTimeValue"></span> minutes</p>
          </div>
          <button class="confirm"  onclick="confirmdetails()">
            CONFIRM ROUTE
          </button>

          <script>
             function confirmdetails(){
              alert('Route Confirmed');
              window.location.href = 'booktaxi.php';
             }
              </script>
          </div>
        </div>
     <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    
    
    <script>
      function updateExpirationTime(travelTimeInMinutes,distanceInKilometers) {
    var bookingid = <?php echo $bookingid; ?>; 
    var data = {
      bookingid: bookingid,
      travelTimeInMinutes: travelTimeInMinutes,
      distanceInKilometers : distanceInKilometers
    };

    
    axios.post('updateExpirationTime.php', data)
      .then(function (response) {
    
        if (response.data.success) {
          // alert('Route Confirmed');
          // window.location.href = 'booktaxi.php';
        } else {
          alert('Error updating expiration time: ' + response.data.message);
        }
      })
      .catch(function (error) {
        alert('An error occurred: ' + error.message);
      });
  }

      function geocodeLocation(locationText) {
        var apiKey = 'c8d95b3fea6b42d881f5bf0d633892b3';
        var apiUrl = `https://api.opencagedata.com/geocode/v1/json?q=${encodeURIComponent(locationText)}&key=${apiKey}`;
    
        return axios.get(apiUrl)
          .then(function (response) {
            if (response.status === 200) {
              var results = response.data.results;
              if (results.length > 0) {
                return {
                  lat: results[0].geometry.lat,
                  lng: results[0].geometry.lng
                };
              } else {
                throw new Error("No results found for the location.");
              }
            } else {
              throw new Error("Error occurred while geocoding.");
            }
          })
          .catch(function (error) {
            throw error;
          });
        }

     
      var map = L.map('map').setView([15.286691, 73.969780], 10);
      mapLink = "<a href='http://openstreetmap.org'>OpenStreetMap</a>";
      L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', { attribution: 'Leaflet &copy; ' + mapLink + ', contribution', maxZoom: 18 }).addTo(map);
      
      var lat1, lat2, lng1, lng2;
      
    
      async function getCoordinates() {
      var origin = bookingData.pickup_location;
      var destination = bookingData.dropoff_location;
      
      try {
        var originCoordinates = await geocodeLocation(origin);
        var destinationCoordinates = await geocodeLocation(destination);
        processCoordinates(originCoordinates, destinationCoordinates);
        
      } catch (error) {
        console.error("An error occurred while geocoding:", error);
      }
    }


function processCoordinates(originCoordinates, destinationCoordinates) {
    lat1 = originCoordinates.lat;
  lng1 = originCoordinates.lng;
  lat2 = destinationCoordinates.lat;
  lng2 = destinationCoordinates.lng;
  
  var marker = L.marker([lat1, lng1]).addTo(map);
  var newMarker = L.marker([lat2, lng2]).addTo(map);

  L.Routing.control({
          waypoints: [
            L.latLng(lat1, lng1),
            L.latLng(lat2, lng2)
          ]
        }).on('routesfound', function (e) {
          var routes = e.routes;
          console.log(routes);
          
          var distanceInKilometers = (routes[0].summary.totalDistance / 1000).toFixed(2);
          console.log("Distance: " + distanceInKilometers + " kilometers");

          var travelTimeInMinutes = (routes[0].summary.totalTime / 60).toFixed(2);
          console.log("Travel Time: " + travelTimeInMinutes + " minutes");
            
          document.getElementById("distanceValue").textContent = distanceInKilometers;
          document.getElementById("travelTimeValue").textContent = travelTimeInMinutes;
          map.setZoom(9);
          updateExpirationTime(travelTimeInMinutes,distanceInKilometers);
        }).addTo(map);
}

getCoordinates();

    </script>    
  </body>
  </html>


