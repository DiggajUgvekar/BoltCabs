var mylatlng = { lat: 15.286691, lng: 73.969780 };
var mapOptions = {
    center: mylatlng,
    zoom: 10,
    mapTypeId: google.maps.MapTypeId.ROADMAP
};

var map = new google.maps.Map(document.getElementById("googleMap"), mapOptions)

//create direction service object
var directionService = new google.maps.DirectionsService();

//create direction renderer object
var directionsDisplay = new google.maps.DirectionsRenderer();

//bind the directionsRenderer to the map
directionsDisplay.setMap(map);

//function

function calcRoute() {
    var request = {
            origin: document.getElementById("from").value,
            destination: document.getElementById("to").value,
            travelMode: google.maps.TravelMode.DRIVING,
            unitSystem: google.maps.UnitSystem.IMPERIAL
        }
        //pass the request to the route method
    directionService.route(request, (result, status) => {
        if (status == google.maps.DirectionsStatus.OK) {
            //get distance and time
            const ouptut = document.querySelector('#output');
            ouptut.innerHTML = "<div class='alert-info'>from: " + document.getElementById("from").value + ".<br/>" + document.getElementById("to").value + ". <br /> Driving distance <i class='fa-solid fa-road'></i>:" + result.routes[0].legs[0].distance.text + ".<br />Duration <i class='fa-solid fa-hourglass-start'></i> : " + result.routes[0].legs[0].duration.text + ". </div>";

            //display route
            directionsDisplay.setDirections(result);
        } else {
            //delete route from map
            directionsDisplay.setDirections({ routes: [] });

            //center map in goa
            map.setCenter(mylatlng);

            //show error message
            ouptut.innerHTML = "<div class='alert-danger'><i class='fa-solid fa-triangle-exclamation'></i> Could not retrieve driving distance. </div>";

        }
    });
}

//create autocomplete objects for all input
var options = {
    types: ['(cities)']
}

var input1 = document.getElementById("from");
var autocomplete1 = new google.maps.places.Autocomplete(input1, options)


var input2 = document.getElementById("to");
var autocomplete2 = new google.maps.places.Autocomplete(input2, options)