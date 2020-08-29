<?php
	// Medical Response System for Smart City
	session_start(); 
	include("includes/conn.php");
	if (!isset($_SESSION['username']) || isset($_GET['endSession'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("Location: login.php");
	}
	
	$userQuery = "SELECT * FROM users WHERE username='".$_SESSION['username']."'";
	$userResult = mysqli_query($mysqli, $userQuery);
	$currentUser = mysqli_fetch_array($userResult);
	
	$phoneNumber = $currentUser["phone"];
	
	if($currentUser["verified"]!=1){
		header("Location: verify.php");
	}

	$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
	if(isset($_GET['lat']) && isset($_GET['lng'])){
		$lat = $_GET['lat'];
		$lng = $_GET['lng'];

		$sql = "SELECT id, name, lat, lng FROM hospitals";
		$result = $mysqli->query($sql);
		$rows = mysqli_num_rows($result);
		$i = 0;
		if ($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$hID = $row["id"];
				$hName = $row["name"];
				$hLat = $row["lat"];
				$hLng = $row["lng"];
				$dist = getDistanceBetweenPoints($lat,$lng,$hLat,$hLng);
				$hospitalInfo[$i] = array($hID,$hName,$hLat,$hLng,$dist);
				$i++;
			}

			$x=0;
			$perform=true;
			$t=0;
			while($perform){
				$perform=false;
				for($x=0;$x<$rows-1;$x++){
					if($hospitalInfo[$x][4]>$hospitalInfo[$x+1][4]){
						$t=$hospitalInfo[$x];
						$hospitalInfo[$x]=$hospitalInfo[$x+1];
						$hospitalInfo[$x+1]=$t;
						$perform=true;
					}
				}
			}
			
		}
	}
	
	function degreesToRadians($degrees){
		return $degrees * pi()/ 180;
	}

	function getDistanceBetweenPoints($lat1, $lng1, $lat2, $lng2){
		$R = 6378137;
		$dLat = degreesToRadians($lat2 - $lat1);
		$dLong = degreesToRadians($lng2 - $lng1);
		$a = sin($dLat / 2) * sin($dLat / 2) + cos(degreesToRadians($lat1)) * cos(degreesToRadians($lat1)) * sin($dLong / 2) * sin($dLong / 2);
		$c = 2 * atan2(sqrt($a),sqrt(1 - $a));
		$distance = $R * $c;
		return $distance;
	}
	
?><!doctype html>
<html>
<head>
    <title>Home | Medical Response System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/user.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/js/main.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card main-box my-5">
                    <div class="card-body text-center">
						<h5 class="text-center my-2">Medical Response System</h5>
						<hr class="my-4">
                        <h3 class="text-center my-3">Call Ambulance</h3>
						<div class="text-center my-4" onclick="getLocation()">
							<a href="javascript:getLocation()" class="text-light"><span onclick="getLocation()"><i class="fas fa-ambulance fa-spin fa-5x callBtn" onclick="getLocation()"></i></span></a>
						</div>
						<hr class="my-5"/>
						<a href="information.php"><button class="btn btn-success">Get More Medical Information</button></a>
						<a href="covidstatus.php"><button class="btn btn-success">Check you COVID-19 status</button></a> <br>
						<br> <button class="btn btn-danger" 
						onclick="Positive()"> I was recently diagonzed by COVID19</button> <!-- We have to add the value true to database when its true !-->
						<div class="p-2 mb-1 text-danger border border-success bg-light my-5" onclick="window.location='index.php?endSession=1';">
							<button class="btn btn-primary">End Session</button>
						</div>
                    </div>
                </div>
            </div>	
        </div>
    </div>
	<script>
function Positive() {
	var ho = window.confirm('Are you sure you have been tested positive?');
	if (ho)
	{
  		window.alert("Please find nearby hospital!");
		window.location.href= "information.php";
	} 
	else 
	{
		location.reload();
	}
}
</script>
<script language="javascript" type="text/javascript">
	var wsUri = "ws://localhost:5000/server.php";	
	websocket = new WebSocket(wsUri);
	

	setTimeout(
    function() {
		var msg = {
			geolocation: <?php echo "\"$lat,$lng\"";?>,
			hospitalID: <?php echo $hospitalInfo[0][0];?>,
			phoneNumber: <?php echo "$phoneNumber";?>
		};
		websocket.send(JSON.stringify(msg));
	}, 1000);
	
	websocket.onmessage = function(ev){
		if(ev.data==2){
			alert("Ambulance is arriving soon.");	
		}
		if(ev.data==1){
			alert("Your request will be sent to another hospital.");
		}
	}	
</script>

</body>
</html>