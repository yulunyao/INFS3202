<!DOCTYPE html>
<?php
session_start();
$con = mysqli_connect('au-cdbr-azure-east-a.cloudapp.net:3306', "b622a8e03ec7ba", "6e32c3d6", "sik");
echo "Welcome " . $_SESSION['username'];
$query = "SELECT random FROM uid WHERE username = '".$_SESSION['username']."'";
$result = mysqli_query($con,$query);

while($row = mysqli_fetch_assoc($result)) {
    print_r(" with UID: ");
    print_r($row["random"]);
}
echo "<a href='logout.php'> [logout]</a>";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SiK</title>
    <link rel="stylesheet" type="text/css" href="css/styleTask.css">
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
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


    <form method="$_POST" action="location_sent.php">
        <div id=right style="width: 50%; height: 100%; float:right ">
            <h3>You are now in the location:</h3>
            <img src="img/blue.png" width="50%" height="50%" alt=""></img>
            <h2 id="addressA" name="address_detail"></h2>
            <input type="submit" value="Send Location" onclick="sendLocation()">
        </div>
    </form>

	<p></p>

	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDG4jMSOZattisRWE3f96RaJcV5S9nQHr0&sensor=true"></script>


	<script>
		var x = document.getElementById("demo");
		var lat = 0;
		var longi = 0;
		var map;
		var geocoder;
		var infowindow;
		var mapFlag = false;
		var intervalId = null;
		var intervalCounter = 0;
		
		window.addEventListener("load", function(){
				if (navigator.geolocation) {
					navigator.geolocation.watchPosition(showPosition, showError, {
						 enableHighAccuracy: true
							  ,timeout : 15000, maximumAge: 3000
					});
				} else {
					x.innerHTML = "Geolocation is not supported by this browser.";
				}
		});

		function showError(error) {
		  switch(error.code) {
			case error.PERMISSION_DENIED:
			  console.log("User denied the request for Geolocation.");
			  break;
			case error.POSITION_UNAVAILABLE:
			  console.log("Location information is unavailable.");
			  break;
			case error.TIMEOUT:
			  console.log("The request to get user location timed out.");
			  break;
			case error.UNKNOWN_ERROR:
			  console.log("An unknown error occurred.");
			  break;
		  }
		}

		function drawMapCallBack(error){
			
			intervalId = setInterval(function() {
			   console.log("Called once\n");
			   intervalCounter += 1;
			  if (!mapFlag) {
				
				showPosition;
			  }
			  if(intervalCounter > 15){
				  clearInterval(intervalId);
			  }
			}, 1000);
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
			mapFlag = true;
			
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
				  var address = document.getElementById("addressA").innerHTML = results[0].formatted_address;
				  console.log(address);
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

        function sendLocation(){
            var latlng = {lat: parseFloat(lat), lng: parseFloat(longi)};
            geocoder.geocode({'location': latlng}, function(results, status) {
                if (status === 'OK') {
                    if (results[1]) {
                        map.setZoom(15);
                        var marker = new google.maps.Marker({
                            position: latlng,
                            map: map
                        });
                        var address = document.getElementById("addressA").innerHTML = results[0].formatted_address;
                        console.log(address);
                        //textString
                        //infowindow.open(map, marker);
                    } else {
                        window.alert('No results found');
                    }
                } else {
                    window.alert('Geocoder failed due to: ' + status);
                }

                window.location.href = "location_sent.php?address=" + address;
            });


        }

	</script>

</div>
<div id="footer" >
            Designed By Team.
</div>

</body>
</html>