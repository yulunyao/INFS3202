<!DOCTYPE html>
<html>
<body>

<!--
Or key is:
AIzaSyDG4jMSOZattisRWE3f96RaJcV5S9nQHr0
-->

<p>Click the button to get your coordinates.</p>

<button onclick="getLocation()">Try It</button>

<p id="demo"></p>

<div id="googleMap" style="width:100%;height:400px;"></div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDG4jMSOZattisRWE3f96RaJcV5S9nQHr0&callback=myMap"></script>


<script>
    var x = document.getElementById("demo");
	var lat = 0;
	var longi = 0;
	var map;
	var geocoder;
	var infowindow;

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showPosition(position) {
        x.innerHTML = "Latitude: " + position.coords.latitude +
            "<br>Longitude: " + position.coords.longitude;
		lat = position.coords.latitude;
		longi = position.coords.longitude;
		console.log(lat);
		console.log(longi);
		mapUpdate();
    }
	
	function myMap() {
		var mapProp= {
			center:new google.maps.LatLng(lat,longi),
			zoom:15,
		};
		map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
		geocoder = new google.maps.Geocoder;
		infowindow = new google.maps.InfoWindow;
	}
	
	function mapUpdate() {
		var mapProp= {
			center:new google.maps.LatLng(lat,longi),
			zoom:15,
		};
		map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
	}
	
	
	function geoLookup(){
		var latlng = {lat: parseFloat(lat), lng: parseFloat(longi)};
		geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[1]) {
              map.setZoom(11);
              var marker = new google.maps.Marker({
                position: latlng,
                map: map
              });
              infowindow.setContent(results[1].formatted_address);
              infowindow.open(map, marker);
            } else {
              window.alert('No results found');
            }
          } else {
            window.alert('Geocoder failed due to: ' + status);
          }
        });
		
	}
	
	//var json = https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=AIzaSyDG4jMSOZattisRWE3f96RaJcV5S9nQHr0
</script>

</body>
</html>