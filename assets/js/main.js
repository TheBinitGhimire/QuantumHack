/* Medical Response System for Smart City */

function getLocation(){
	if(navigator.geolocation){
		navigator.geolocation.getCurrentPosition(sendLocation);
	}
}

function sendLocation(position){
	latitude = position.coords.latitude;
	longitude = position.coords.longitude;
	location.assign("index.php?lat="+latitude+"&lng="+longitude);
}
