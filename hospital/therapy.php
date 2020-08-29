<?php
	// Medical Response System for Smart City
	session_start(); 
	include("../includes/conn.php");
	if (!isset($_SESSION['hospitalName']) || isset($_GET['endSession'])) {
		session_destroy();
		unset($_SESSION['hospitalName']);
		header("Location: login.php");
	}
	
	$hospitalQuery = "SELECT * FROM hospitals WHERE username='".$_SESSION['hospitalName']."'";
	$result = mysqli_query($mysqli, $hospitalQuery);
	$currentHospital = mysqli_fetch_array($result);
	$geoCoords = $currentHospital["lat"].",".$currentHospital["lng"];
	
	if(!isset($_COOKIE["hospitalID"])){
		setcookie("hospitalID", $currentHospital["id"], time() + (86400*30), "/");
	}
?><!doctype html>
<html>
<head>
	<title>Control Panel | Hospital Access Portal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/js/main.js"></script>
	<script>
	
function requestblood() {
    var name = document.getElementById("blood").value;
    if (confirm('Are you sure you would like to request ' + name + ' blood type?')) {
        alert('SMS has been sent');
} else {
  reload();
}
};
</script>
</head>
<body>
	<div class="container-fluid">
		<nav class="navbar">
			<span class="navbar-brand text-light"><?php echo $currentHospital["username"];?></span>
			<div class="navbar-nav ml-auto">
			<div class="mb-1" onclick="window.location='index.php?endSession=1';">
				<button class="btn btn-dark">End Session</button>
			</div>
			</div>
		</nav>
		<hr class="my-2" />
        <form>
        <div class="form-group container">
            <label for="exampleFormControlSelect1" style="color:white">Blood Group</label>
        <select class="form-control" id="blood">
      <option>A+</option>
      <option>A-</option>
      <option>B+</option>
      <option>B-</option>
      <option>O+</option>
      <option>O-</option>
      <option>AB+</option>
      <option>AB-</option>
    </select><br>
    <button type="submit" class="btn btn-primary" onclick="requestblood()">Request blood</button>

    <a href="http://127.0.0.1:5000/hospital/index.php" class='btn btn-dark'> Back</a>
  </div>

 
  <footer>
			<div class="footer-credits text-right py-md-3">
				<span class="text-right text-light">
					<span class="font-weight-bold">Hospital Access Portal</span> | 
					Idea Designed and Platform Developed by <span class="font-weight-bold">SOLO</span>!
				</span>
			</div>
		</footer>
	</div>
<script>
var sessionCookie = getSessionCookie();
var wsUri = "ws://localhost:5000/server.php";		
websocket = new WebSocket(wsUri);
websocket.onmessage = function(ev) {
	var response = JSON.parse(ev.data);
	var geolocation = response.geolocation;
	var hospID = response.hospitalID;
	var phoneNumber = response.phoneNumber;
	if(sessionCookie==hospID){
		if(geolocation!=null){
			var audioSection = document.getElementById("sound");
			audioSection.innerHTML = "<audio autoplay><source src='buzzer.wav' type='audio/wav'></audio>";
			var mapSection = document.getElementById("mapArea");
			mapSection.innerHTML = "<iframe class='iFrameMap' src='https://maps.google.com/maps?q="+geolocation+"&t=&z=18&ie=UTF8&iwloc=&output=embed' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' style='width:100%' height='500'></iframe><br><h5 class='col-sm-4 text-center bg-light text-danger mx-auto my-5'>User's Phone Number: <a class='text-danger font-weight-bold' href='tel:"+phoneNumber+"'>"+phoneNumber+"</a></h5><br><div class='col-sm-12'><button class='mx-auto text-center col-sm-4 btn btn-lg btn-primary btn-block text-uppercase' name='receiveUser' onclick='receiveUser()'>Receive</button><button class='text-center col-sm-4 mx-auto btn btn-lg btn-danger btn-block text-uppercase' name='forwardLocation' onclick='forwardLocation()'>Forward</button></div><hr size=1>";
		}
	}
};


}
function forwardLocation(){
	websocket.send(1);
	window.location.reload();
}

function receiveUser(){
	websocket.send(2);
	window.location.reload();
}

</script>
</body>
</html>
 