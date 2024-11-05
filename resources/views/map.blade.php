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
    </style>
  
 

  

  <link rel="stylesheet" href="node_modules/leaflet/dist/leaflet.css">
  <link rel="stylesheet" href="node_modules/@geoapify/leaflet-address-search-plugin/dist/L.Control.GeoapifyAddressSearch.min.css">


  
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
  integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
  crossorigin=""/>

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
  integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
  crossorigin=""></script>


  <link rel="stylesheet" href="https://unpkg.com/@geoapify/leaflet-address-search-plugin@^1/dist/L.Control.GeoapifyAddressSearch.min.css" />
  <script src="https://unpkg.com/@geoapify/leaflet-address-search-plugin@^1/dist/L.Control.GeoapifyAddressSearch.min.js"></script>


 
</head>
<body  onload="init();">

    <div id="map"></div>

 
    <script>
      



        function init()
        {
            var map = L.map('map').setView([ 10.771779135654299,106.65766122741186], 17);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

var greenIcon = L.icon({
    iconUrl: '{{ asset('images/availableslot.png') }}',
   // shadowUrl: 'leaf-shadow.png',

    iconSize:     [45, 45], // size of the icon
    shadowSize:   [50, 64], // size of the shadow
    iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
    shadowAnchor: [4, 62],  // the same for the shadow
    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
});

var marker = L.marker([10.763723871833784,106.65976955431256],{icon: greenIcon}).addTo(map);
var marker2 = L.marker([10.761078620733292,106.66060917741723],{icon: greenIcon}).addTo(map);
var marker3 = L.marker([10.762378881477494,106.66195345162645],{icon: greenIcon}).addTo(map);
var marker4 = L.marker([10.766211203146504,106.6543467857687],{icon: greenIcon}).addTo(map);
var marker5 = L.marker([10.770669889748305,106.65629512277314],{icon: greenIcon}).addTo(map);
var marker6 = L.marker([10.774398028512875,106.66200563634163],{icon: greenIcon}).addTo(map);        


var myAPIKey = "db406161c8504f2da04ce0155cd7617d"; // Get an API Key on https://myprojects.geoapify.com
var mapURL = L.Browser.retina
  ? `https://maps.geoapify.com/v1/tile/{mapStyle}/{z}/{x}/{y}.png?apiKey=db406161c8504f2da04ce0155cd7617d`
  : `https://maps.geoapify.com/v1/tile/{mapStyle}/{z}/{x}/{y}@2x.png?apiKey=db406161c8504f2da04ce0155cd7617d`;

  const addressSearchControl = L.control.addressSearch(myAPIKey, {
  position: 'topleft',
  resultCallback: (selectedAddress) => {
    console.log(selectedAddress);
  },
  suggestionsCallback: (suggestions) => {
    console.log(suggestions);
  }
});
map.addControl(addressSearchControl);
L.control.zoom({ position: 'bottomright' }).addTo(map);
}
//function addmarker(float x, float y)
//{
   // var marker = L.marker([x,y]).addTo(map);
//}
//marker1

   // addmarker(10.763723871833784,106.65976955431256);
   // addmarker(10.761078620733292,106.66060917741723);
  //  addmarker(10.762378881477494,106.66195345162645);
   // addmarker(10.766211203146504,106.6543467857687);
 //   addmarker(10.770669889748305,106.65629512277314);
   // addmarker(10.774398028512875,106.66200563634163);

//var marker = L.marker([10.763723871833784, 106.65766122741186]).addTo(map);

        

      </script>
   <div id="reservation-menu">
    <h2>Reservation</h2>
    
    <div id="location-options">
        <label for="location">Your current location:</label>
        <input type="text" id="location" placeholder="Fill in your location">
    
        <button id="use-gps">Use GPS</button>
        <button id="mark-on-map">Mark on Map</button>
    </div>

    <label for="parking-slot">Select parking slot</label>
    <select id="parking-slot">
        <option value="slot0"> none </option>
        <option value="slot1"> 3/2 </option>
        <option value="slot2">Ly Thuong Kiet</option>
        <option value="slot3">Nguyen Kim</option>
        <option value="slot4">Le Dai Hanh</option>
        <option value="slot5">Lu Gia</option>
        <option value="slot6">To Hien Thanh</option>
        <!-- Add more slots as needed -->
    </select>

    <label for="start-time">From:</label>
    <input type="datetime-local" id="start-time">

    <label for="end-time">To:</label>
    <input type="datetime-local" id="end-time">

    <label for="duration">Duration (hour):</label>
    <input type="number" id="duration" min="1" placeholder="Số giờ">

    <div id="something" style="display:flex; margin-top:100px  ">
    <button style=" margin-left:105px " type="button" onclick="reserveSpot()">Reserve</button>
    <button style=" margin-left:25px " type="button" onclick="reserveSpot()">Show the way</button>
    </div>
   
</div>
  
</body>
</html>





