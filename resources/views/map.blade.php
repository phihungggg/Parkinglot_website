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
  
  <script src="{{ asset('js/OpenLayers.js') }}"></script>
  
</head>
<body  onload="init();">

    <div id="map"></div>

 
    <script>
        function init() {
          map = new OpenLayers.Map("map");
          var mapnik         = new OpenLayers.Layer.OSM();
          var fromProjection = new OpenLayers.Projection("EPSG:4326");   // Transform from WGS 1984
          var toProjection   = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection
          var position       = new OpenLayers.LonLat(106.65976955431256, 10.763723871833784).transform( fromProjection, toProjection);
          var zoom           = 17; 
  
          map.addLayer(mapnik);
          map.setCenter(position, zoom );
//mat me cai map roi
 //marker1
 //hoi o cty con hien map ma :((
          var markers = new OpenLayers.Layer.Markers( "Markers" );
          map.addLayer(markers);
          var lonLat = new OpenLayers.LonLat( 106.65976955431256 ,10.763723871833784 )
          .transform(fromProjection, toProjection);
            var size = new OpenLayers.Size(45, 45);
            var offset = new OpenLayers.Pixel(-(size.w / 2), -size.h);
            var icon = new OpenLayers.Icon('{{ asset('images/availableslot.png') }}', size, offset);
            marker=new OpenLayers.Marker(lonLat, icon)
            markers.addMarker(marker);
            marker.events.register("click", marker, function(evt) {
    console.log("Marker clicked!");
    OpenLayers.Event.stop(evt); // Optional: Prevents the event from propagating further
    Livewire.dispatch('markerClicked', { lat: lat, lng: lng });
});
//deo hieu
//marker2
            var markers2 = new OpenLayers.Layer.Markers( "Markers" );
          map.addLayer(markers2);
          var lonLat = new OpenLayers.LonLat( 106.66060917741723 ,10.761078620733292 )
          .transform(fromProjection, toProjection);
            var size = new OpenLayers.Size(45, 45);
            var offset = new OpenLayers.Pixel(-(size.w / 2), -size.h);
            var icon = new OpenLayers.Icon('{{ asset('images/availableslot.png') }}', size, offset);
            marker2=new OpenLayers.Marker(lonLat, icon);
            markers2.addMarker(marker2);
            marker2.events.register("click", marker, function(evt) {
    console.log("Marker2 clicked!");
    OpenLayers.Event.stop(evt); // Optional: Prevents the event from propagating further
    Livewire.dispatch('markerClicked', { lat: lat, lng: lng });
});

//marker3
            var markers3 = new OpenLayers.Layer.Markers( "Markers" );
          map.addLayer(markers3);
          var lonLat = new OpenLayers.LonLat( 106.66195345162645 ,10.762378881477494 )
          .transform(fromProjection, toProjection);
            var size = new OpenLayers.Size(45, 45);
            var offset = new OpenLayers.Pixel(-(size.w / 2), -size.h);
            var icon = new OpenLayers.Icon('{{ asset('images/availableslot.png') }}', size, offset);
            marker3=new OpenLayers.Marker(lonLat, icon);
            markers3.addMarker(marker3);
            marker3.events.register("click", marker, function(evt) {
    console.log("Marker3 clicked!");
    OpenLayers.Event.stop(evt); // Optional: Prevents the event from propagating further
    Livewire.dispatch('markerClicked', { lat: lat, lng: lng });




});
// me no =))
/*
document.addEventListener('livewire:load', function () {
            Livewire.on('slotStatusChanged', (slotId, status,slotnumber  ) => {
                // Your logic to change the marker icon based on slotId and status
               switch ( slotnumber)
               {
               case 1:
                if (status === 1) {
                    marker.icon.url = = '{{ asset('images/availableslot.png') }}'; // Change icon to occupied
                } else {
                    marker.icon.url = = '{{ asset('images/notavaiableslot.png') }}'; // Change icon to available
                }
                marker.icon.image.src = marker.icon.url;
                marker.redraw(); // Redraw the marker to reflect the change
                break;
                case 2:
                if (status === 1) {
                    marker2.icon.url = '{{ asset('images/availableslot.png') }}'; // Change icon to occupied
                } else {
                    marker2.icon.url = '{{ asset('images/notavaiableslot.png') }}'; // Change icon to available
                }
                marker2.icon.image.src = marker.icon.url;
                marker2.redraw(); // Redraw the marker to reflect the change
                break;

                case 3:
                if (status === 1) {
                    marker3.icon.url = '{{ asset('images/availableslot.png') }}'; // Change icon to occupied
                } else {
                    marker3.icon.url = '{{ asset('images/notavaiableslot.png') }}'; // Change icon to available
                }
                marker3.icon.image.src = marker.icon.url;
                marker3.redraw(); // Redraw the marker to reflect the change
                break;

            }
            });
        });
        
        }*/
} //quen me no cai ngoac :)
      </script>
    <livewire:maps>
  
</body>
</html>





