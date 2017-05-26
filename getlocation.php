<?php
/**
 * Created by PhpStorm.
 * User: WHOAMI
 * Date: 2017/5/22
 * Time: 18:55
 */
session_start();
include("connectMySQL.php");
$con = mysqli_connect('au-cdbr-azure-east-a.cloudapp.net:3306', "b622a8e03ec7ba", "6e32c3d6", "sik");
echo "Welcome " . $_SESSION['username'];
$query = "SELECT random FROM uid WHERE username = '".$_SESSION['username']."'";
$result = mysqli_query($con,$query);

/*Show Welcome information with current username and UID.*/

while($row = mysqli_fetch_assoc($result)) {
    print_r(" with UID: ");    //call uid by using $_SESSION['uid']
    print_r($row["random"]);
}


echo "<a href='logout.php'> [logout]</a>";
echo ("<p></p>");

$uid = $_SESSION['uid'];

$username = $_SESSION['username'];
echo("<p></p>");

/*Display the UID and the location correspond to that UID.*/

$query = "SELECT location FROM uid WHERE random= $uid";
$uid_location = mysqli_query($con, $query);


/*while ($row = mysqli_fetch_assoc($uid_location)) {
    print_r("Location is in: ");
    print_r($row["location"]);
}*/

$row2 = mysqli_fetch_assoc($uid_location);

//$fetch_try = 'Mount Gravatt';//used to test if the google maps direction api works.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SiK</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <div class="logo"><img src="img/SiKd.png" alt="Logo" width="70px" height="32px"></div>
    <h6>Find Your Friends At Anytime</h6>

    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 100%;
        }
    </style>
</head>
<div id="map" onload="initMap()"></div>
<script>


    if (navigator.geolocation) { //Checks if browser supports geolocation
        navigator.geolocation.getCurrentPosition(function (position) {                                                              //This gets the
            var latitude = position.coords.latitude;                    //users current
            var longitude = position.coords.longitude;                 //location
            var coords = new google.maps.LatLng(latitude, longitude); //Creates variable for map coordinates
            var directionsService = new google.maps.DirectionsService();
            var directionsDisplay = new google.maps.DirectionsRenderer();
            var mapOptions = //Sets map options
                {
                    zoom: 15,  //Sets zoom level (0-21)
                    center: coords, //zoom in on users location
                    mapTypeControl: true, //allows you to select map type eg. map or satellite
                    navigationControlOptions:
                        {
                            style: google.maps.NavigationControlStyle.SMALL //sets map controls size eg. zoom
                        },
                    mapTypeId: google.maps.MapTypeId.ROADMAP //sets type of map Options:ROADMAP, SATELLITE, HYBRID, TERRIAN
                };
            map = new google.maps.Map( /*creates Map variable*/ document.getElementById("map"), mapOptions /*Creates a new map using the passed optional parameters in the mapOptions parameter.*/);
            directionsDisplay.setMap(map);
            directionsDisplay.setPanel(document.getElementById('panel'));
            var request = {
                origin: coords,
                destination: "<?php printf($row2["location"]) ?>",
                travelMode: google.maps.DirectionsTravelMode.WALKING
            };

            directionsService.route(request, function (response, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(response);
                }
            });
        });
    }

    function initMap() {
        directionsService.route(request, function (result, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(result);
            }
        });
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPUyIe6inWNIdtAXaopnp5cVbBGgT2CzE">
</script>

<h3>Your friends is in location: <?php
    printf($row2["location"]);
    ?></h3>

</body>
</html>