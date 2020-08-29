<?php

	// Medical Response System for Smart City
	session_start(); 
	include("includes/conn.php");
	
	if(isset($_POST['verifyNow'])){
		$verifyQuery = "SELECT * FROM users WHERE username='".$_SESSION['username']."'";
		$result = mysqli_query($mysqli, $verifyQuery);
		$currentUser = mysqli_fetch_array($result);
		$dbToken = md5($currentUser['token']);
		$verificationToken = md5($_POST['verificationToken']);
		
		if($verificationToken==$dbToken){
			$verifiedQuery = "UPDATE users
							SET verified=1 WHERE username='".$_SESSION['username']."'";
			mysqli_query($mysqli, $verifiedQuery);
			header("Location: index.php");
		}
	}
	if (!isset($_SESSION['username']) || isset($_GET['endSession'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("Location: login.php");
	}
	
	$userQuery = "SELECT * FROM users WHERE username='".$_SESSION['username']."'";
	$result = mysqli_query($mysqli, $userQuery);
	$currentUser = mysqli_fetch_array($result);
	
	if($currentUser["verified"]!=0){
		header("Location: index.php");
	}
	
	
?><!doctype html>
<html>
<head>
    <title>Verify Email | Medical Response System</title>
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
                        <h3 class="text-center my-3">Verify Email</h3>
						<h6 class="text-center my-4">Check your email for verification token!</h6>
						<form method="POST" action="verify.php" class="form-signin">
                            <div class="form-group">
                                <label for="inputToken">Verification Token</label>
                                <input type="text" name="verificationToken" class="form-control" placeholder="Verification Token" required autofocus>
							</div>
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" name="verifyNow" type="submit">Verify</button>
						</form>
						<hr class="my-5"/>
						<h6 class="text-center my-2">You can still view medical information.</h6>
						<a href="information.php"><button class="my-3 btn btn-success">Get Medical Information</button></a>
						<div class="p-2 mb-1 text-danger border border-success bg-light my-5" onclick="location.assign('index.php?endSession=1')">
							<button class="btn btn-danger">End Session</button>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>