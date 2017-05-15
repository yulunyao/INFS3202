<!DOCTYPE html>
<html>
<body>

<!--
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
		mapUpdate();
    }
	
	function myMap() {
		var mapProp= {
			center:new google.maps.LatLng(lat,longi),
			zoom:5,
		};
		map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
	}
	
	function mapUpdate() {
		var mapProp= {
			center:new google.maps.LatLng(lat,longi),
			zoom:5,
		};
		map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
	}
	
	//https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=YOUR_API_KEY
</script>

</body>
</html>