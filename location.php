<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SiK</title>
    <link rel="stylesheet" type="text/css" href="">
</head>
<body>

<!--
Or key is:
AIzaSyDG4jMSOZattisRWE3f96RaJcV5S9nQHr0
-->
<div id="wrapper">
	<div class="logo"><img src="img/SiKd.png" alt="Logo" width="70px" height="32px"></div>
	
	<p id="demo"></p>
	
	<div style="width: 50%; height: 100%; float:left;">
		<div id="googleMap" style="width:80%;height:400px;"></div>
	</div>
	<div style="width: 50%; height: 100%; float:right ">
		<h3>You are now in the location:</h2>
		<img src="img/blue.png"  width="50%" height="50%"></img>
		<h2 id=addressA>Current Location String</h2>
		<button id=locationBtn>Send Location</button>
	</div>

	<p></p>

	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDG4jMSOZattisRWE3f96RaJcV5S9nQHr0"></script>


	<script>
		var x = document.getElementById("demo");
		var lat = 0;
		var longi = 0;
		var map;
		var geocoder;
		var infowindow;
		
		window.addEventListener("load", function(){
			if (navigator.geolocation) {
					navigator.geolocation.getCurrentPosition(showPosition);
				} else {
					x.innerHTML = "Geolocation is not supported by this browser.";
				}
		});;

		function getLocation() {
			
		}

		function showPosition(position) {
			/*x.innerHTML = "Latitude: " + position.coords.latitude +
				"<br>Longitude: " + position.coords.longitude;*/
			lat = position.coords.latitude;
			longi = position.coords.longitude;
			console.log(lat);
			console.log(longi);
			mapInit();
		}
		
		function mapInit() {
			var mapProp= {
				center:new google.maps.LatLng(lat,longi),
				zoom:15,
			};
			map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
			
			var links = document.getElementsByTagName("link");
			for (var cl in links)
			{
				var link = links[cl];
				if (link.rel === "stylesheet")
					link.href = "css/styleTask.css";
			}
			geocoder = new google.maps.Geocoder;
			infowindow = new google.maps.InfoWindow;
			geoLookup();
		}
		
		
		function geoLookup(){
			var latlng = {lat: parseFloat(lat), lng: parseFloat(longi)};
			geocoder.geocode({'location': latlng}, function(results, status) {
			  if (status === 'OK') {
				if (results[1]) {
				  map.setZoom(15);
				  var marker = new google.maps.Marker({
					position: latlng,
					map: map
				  });
				  document.getElementById("addressA").innerHTML(results[1].formatted_address);
				  //textString
				  //infowindow.open(map, marker);
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

</div>

<div id="footer" >
            Designed By Team.
</div>

</body>
</html>