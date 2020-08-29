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
		
	if($currentUser["verified"]!=1){
		header("Location: verify.php");
	}
	
	$sql = "SELECT id, name, lat, lng, information, url, contact, address FROM information";
	$result = $mysqli->query($sql);
	$rows = mysqli_num_rows($result);
?>
<!doctype html>
<html>
<head>
    <title>Medical Information | Emergency and OPD Response System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" />
    <link rel="stylesheet" href="assets/css/user.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/js/user.js"></script>
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
                        <h3 class="text-center my-3">Medical Information</h3>
						<div class="accordion" id="accordionExample">
						<?php 
							$count = 0;
							if ($result->num_rows > 0){
									echo "<div class='mx-auto'>";
									while($row = $result->fetch_assoc()){
										$id = $row["id"];
										$name = $row["name"];
										$lat = $row["lat"];
										$lng = $row["lng"];
										$info = $row["information"];
										$url = $row["url"];
										$contact = $row["contact"];
										$address = $row["address"];
										echo "
											<div class='card my-3'>
												<div class='card-header' id='heading$count'>
													<h5 class='mb-0'>
													<button class='btn btn-info collapsed' type='button' data-toggle='collapse' data-target='#collapse$count' aria-expanded='true' aria-controls='collapse$count'>
													  $name 
													</button>
												  </h5>
												</div>

												<div id='collapse$count' class='collapse show' aria-labelledby='heading$count' data-parent='#accordionExample'>
													<div class='col-sm-12 text-center'>
														<div class='mx-auto text-center'><span><strong>Address:</strong> $address</span></div> <br>
														<span class='col-sm-4'>Hospital website: <a href='$url'>$url</a></span><br>
														<br><span class='col-sm-4'>Contact number: <a href='tel:$contact'>$contact</a></span>
														<div class='mx-auto'>Location : <a href=''>View on Google Maps</a></div>
													</div>
													<div class='card-body text-justify'>
														$info
													</div>
												</div>
											</div>
										";
										$count++;
									}
									echo "</div><hr class='my-5'/>";
							}
						?>
						</div>
						<button class="btn btn-secondary" onclick="location.assign('index.php')">Return to Homepage</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>