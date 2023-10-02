<!DOCTYPE html>
<html>

<head>
	<title>Geolocation</title>
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
            margin: 50px auto;
            box-shadow: 0px 0px 1000px black;
            border:20px;
        }
            /* div .padding1{
          padding-top:15px;
          padding-bottom:15px;
        }
        div .padding1 i{
          padding-right:15px;
        } */
    .btn-field i{
      width: 100px
    }
    .container{
      background-image:url();
    }
    .maincontainer{
      height: 200vb;
      background-image:url(img/route2.jpg);
      background-size: cover;
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
<div class="maincontainer">
    <div class="container">
        <div class="formbox">
            <h1 id="title">Select You Route</h1>
            <form id="myForm" >
              <div class="input-group">
                    <div class="input-field">
                    <label for="from" class="content-label" ><i class="fa-regular fa-circle-dot"></i></label>
                   <input type="text" id="from"placeholder="Pick Up Location" class="origin">
              </div>

              <!-- <div class="input-field padding1">
              <i class="fa-regular fa-calendar"></i>
                   <select name="district" id="district" class="district" >
                      <option value="northgoa">North Goa</option>
                      <option value="southgoa">South Goa</option>
                    </select>
                  </div> -->

                  <div class="input-field">
                  <i class="fa-regular fa-calendar"></i>
                            <input type="datetime-local" id="arrivaltime" name="arrivaltime"><br>
                  </div>
                  <div class="input-field">
                            <label for="to" class="content-label" ><i class="fa-solid fa-location-dot"></i></label>
                            <input type="text" id="to" placeholder="Destination Location" class="destination"><br>

                                      </div>
                  </div>
                                  <div class="btn-field">
                                      <button type="submit" id="direction"><i class="fa-solid fa-diamond-turn-right"></i></button>

                                  </div>
                                  
            </form>
          </div>
          
        </div>
        <div id="map"></div>
      </div>
	<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>
	<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  
  
	<script>
    var map = L.map('map').setView([15.286691, 73.969780], 10);
    mapLink = "<a href='http://openstreetmap.org'>OpenStreetMap</a>";
    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', { attribution: 'Leaflet &copy; ' + mapLink + ', contribution', maxZoom: 18 }).addTo(map);
    
        var taxiIcon = L.icon({
          iconUrl: 'img/taxi.png',
          iconSize: [20, 20]
    
    
    })
    var lat1, lat2, lng1, lng2;
    
function geocodeLocation(locationText) {
  // Replace 'YOUR_API_KEY' with your OpenCage Geocoder API key
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
  
  document.addEventListener("DOMContentLoaded", function() {
  var form = document.getElementById("myForm");

  form.addEventListener("submit", async function(event) {
    event.preventDefault(); // Prevent the default form submission behavior

    // Get form data and geocode both locations
    var origin = document.getElementById("from").value;
    var destination = document.getElementById("to").value;

    try {
      var originCoordinates = await geocodeLocation(origin);
      var destinationCoordinates = await geocodeLocation(destination);

      lat1 = originCoordinates.lat;
      lng1 = originCoordinates.lng;
      lat2 = destinationCoordinates.lat;
      lng2 = destinationCoordinates.lng;

      var marker = L.marker([lat1, lng1], { icon: taxiIcon }).addTo(map);

		// map.on('click', function (e) {
			// console.log(e)
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
          
        window.scroll({
          top: window.scrollY + 600, // Adjust the value to your desired scrolling distance
          behavior: 'smooth' // Optional smooth scrolling
        });
				e.routes[0].coordinates.forEach(function (coord, index) {
					setTimeout(function () {
						marker.setLatLng([coord.lat, coord.lng]);
					}, 100 * index)
				})

			}).addTo(map);
		// });


    } catch (error) {
      console.error("Error: " + error.message);
    }
  });
});

		
	</script>


</body>

</html>