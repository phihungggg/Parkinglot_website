<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a Map using HTML</title>
    <link rel="stylesheet" type="text/css" />
    @livewireStyles
    @livewireScripts
    <style>
        body {
            display: flex;
            height: 100vh;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        #map {
            height: 100%;
            width: 70%;
        }
        #reservation-menu {
            width: 30%;
            padding: 20px;
            background-color: #f0f0f0;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-top: 0;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="text"],
        input[type="datetime-local"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            margin-top: 20px;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }


        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }
        .blinking {
            animation: blink 1s infinite;
        }


    </style>
  




  <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"></script>
	<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
  


    <link rel="stylesheet" href="node_modules/leaflet/dist/leaflet.css">
    <link rel="stylesheet" href="node_modules/@geoapify/leaflet-address-search-plugin/dist/L.Control.GeoapifyAddressSearch.min.css">



  <link rel="stylesheet" href="https://unpkg.com/@geoapify/leaflet-address-search-plugin@^1/dist/L.Control.GeoapifyAddressSearch.min.css" />
  <script src="https://unpkg.com/@geoapify/leaflet-address-search-plugin@^1/dist/L.Control.GeoapifyAddressSearch.min.js"></script>


 
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />



</head>
<body  >
  


    <div id="map"></div>
    <div id="reservation-menu">
        <h2>Reservation</h2>
        
        <div id="location-options">
       
            <div id="suggestions"></div>
    
            <button id="use-gps">Use GPS</button>
            <button id="mark-on-map">Mark on Map</button>
        </div>
    
        <label for="parking-slot">Select parking slot</label>
        <select id="parking-slot">
            <option value="slot0"> none </option>
            <option value="3_thang_2"> 3/2 </option>
            <option value="Ly_Thuong_Kiet">Ly Thuong Kiet</option>
            <option value="Nguyen_Kim">Nguyen Kim</option>
            <option value="Le_Dai_Hanh">Le Dai Hanh</option>
            <option value="Lu_Gia">Lu Gia</option>
            <option value="To_Hien_Thanh">To Hien Thanh</option>
            <!-- Add more slots as needed -->
        </select>
    
        <label for="start-time">From:</label>
        <input type="datetime-local" id="start-time">
    
        <label for="end-time">To:</label>
        <input type="datetime-local" id="end-time">
    
        <label for="duration">Duration (hour):</label>
        <input type="number" id="duration" min="1" placeholder="Duration">
    
        <div id="something" style="display:flex; margin-top:100px  ">
        <button style=" margin-left:105px " type="button" onclick="reserveSpot()">Reserve</button>
        <button style=" margin-left:25px " type="button" onclick="guiding()">Show the way</button>
        </div>
       
    </div>
    



    <script>
       
       var currentMarker = null;
var current_parkingslot;
var current_zoom;
var search_flag=0;
var search_lat;
var search_long;


var currentRoute = null;
      var map = L.map('map').setView([ 10.771779135654299,106.65766122741186], 11);
		mapLink = "<a href='http://openstreetmap.org'>OpenStreetMap</a>";
		L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', { attribution: '© OpenStreetMap contributors', maxZoom: 18 }).addTo(map);

		var taxiIcon = L.icon({
			iconUrl: 'img/taxi.png',
			iconSize: [70, 70]
		})



        var redIcon = L.icon({
            iconUrl: 'https://example.com/red-icon.png', // Replace with the actual URL or path to the red marker
            iconSize: [40, 40], // Adjust size as needed
            iconAnchor: [20, 40],
            popupAnchor: [0, -40]
        });

        var greenIcon = L.icon({
    iconUrl: '{{ asset('images/availableslot.png') }}',
    //shadowUrl: '{{ asset('images/availableslot.png') }}',

    iconSize:     [45, 45], // size of the icon
    shadowSize:   [50, 64], // size of the shadow
    iconAnchor:   [22, 45], // point of the icon which will correspond to marker's location
    shadowAnchor: [4, 62],  // the same for the shadow
    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
});

var markers = {
        "3_thang_2": L.marker([10.763723871833784, 106.65976955431256],{icon: greenIcon}).addTo(map),
        "Ly_Thuong_Kiet": L.marker([10.761078620733292, 106.66060917741723],{icon: greenIcon}).addTo(map),
        "Nguyen_Kim": L.marker([10.762378881477494, 106.66195345162645],{icon: greenIcon}).addTo(map),
        "Le_Dai_Hanh": L.marker([10.766211203146504, 106.6543467857687],{icon: greenIcon}).addTo(map),
        "Lu_Gia": L.marker([10.770669889748305, 106.65629512277314],{icon: greenIcon}).addTo(map),
        "To_Hien_Thanh": L.marker([10.774398028512875, 106.66200563634163],{icon: greenIcon}).addTo(map)
    };


  
    var myAPIKey = "db406161c8504f2da04ce0155cd7617d";
    const addressSearchControl = L.control.addressSearch(myAPIKey, {
  position: 'topleft',
  resultCallback: (selectedAddress) => {
                    // Center the map on the selected location
                    console.log(selectedAddress);
                    map.setView([selectedAddress.lat, selectedAddress.lon], current_zoom);
                    search_lat=selectedAddress.lat;
                    search_long=selectedAddress.lon;
                    search_flag=1;
                },
  suggestionsCallback: (suggestions) => {
    console.log(suggestions);
  }
});




map.addControl(addressSearchControl);
L.control.zoom({ position: 'bottomright' }).addTo(map);


//map.addControl(addressSearchControl);
//L.control.zoom({ position: 'bottomright' }).addTo(map);


/*

		map.on('click', function (e) {
			console.log(e)
			var newMarker = L.marker([e.latlng.lat, e.latlng.lng]).addTo(map);
			L.Routing.control({
				waypoints: [
                    L.latLng(e.latlng.lat, e.latlng.lng),
					L.latLng(10.763723871833784,106.65976955431256)
					
				]
			}).on('routesfound', function (e) {
				var routes = e.routes;
				console.log(routes);

				e.routes[0].coordinates.forEach(function (coord, index) {
					setTimeout(function () {
						marker.setLatLng([coord.lat, coord.lng]);
					}, 100 * index)
				})

			}).addTo(map);
		});
*/
        map.on('zoomend', function (e) {
            current_zoom=e.target._zoom;
    console.log(e.target._zoom);

});

  

        document.getElementById("parking-slot").addEventListener("change", function() {
            var selectedSlot = this.value;

            switch (selectedSlot)
            {
               
                
                case "3_thang_2":
                    current_parkingslot=[10.763723871833784,106.65976955431256];

                    break;
                case "Ly_Thuong_Kiet":
                     current_parkingslot=[10.761078620733292,106.66060917741723];
                    break;
                case "Nguyen_Kim":
                    current_parkingslot=[10.762378881477494,106.66195345162645];
                     break;
                case "Le_Dai_Hanh":
                    current_parkingslot=[10.766211203146504,106.6543467857687];
                    break;
                case "Lu_Gia":
                    current_parkingslot=[10.770669889748305,106.65629512277314];
                    break;
                case "To_Hien_Thanh":
                    current_parkingslot=[10.774398028512875,106.66200563634163];
                    break;
                    
                default:
                    current_parkingslot = null;
                    break;
            }

            console.log(current_parkingslot);
            if (currentMarker) {
            currentMarker.getElement().classList.remove("blinking");
        }



            if (current_parkingslot) {
        map.setView(current_parkingslot, current_zoom); // Adjust the zoom level as desired
    }
            console.log("Selected parking slot:", selectedSlot, current_parkingslot);

            if (selectedSlot && markers[selectedSlot]) {
            currentMarker = markers[selectedSlot];
            currentMarker.getElement().classList.add("blinking");
            map.setView(currentMarker.getLatLng(), current_zoom); // Center the map on the selected slot
        }
            // Add any additional logic you want to trigger on slot selection here
        });

function guiding()
{ if ( search_flag ===1)
{
//search_flag=0;
if (currentRoute) {
            map.removeControl(currentRoute);
        }
        //var userMarker = L.marker([search_lat, search_long], { icon: redIcon }).addTo(map);
        map.setView([search_lat,search_long],current_zoom);            
        currentRoute=L.Routing.control({
				waypoints: [
                    L.latLng(search_lat,search_long),
					L.latLng(current_parkingslot),
					
				]
               

                
			}).addTo(map);
/*
            currentRoute.on('routesfound', function(e) {
    var routes = e.routes;
    // Fit the map to the bounds of the first route
    map.fitBounds(routes[0].bounds);
});*/



}

}
      </script>
   
  
</body>
</html>





