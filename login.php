<?php
// Medical Response System for Smart City
session_start();
include("includes/conn.php");

$errors = "";


if (isset($_POST['loginNow'])) {
	$username = mysqli_real_escape_string($mysqli, $_POST['username']);
	$password = mysqli_real_escape_string($mysqli, $_POST['password']);
	
	// Empty Fields Detection
	if (empty($username)||empty($password)){
		$errors = "Please fill up all fields!";
	}		

	// Trying to log in
	if ($errors=="") {
		$password = md5($password);
		$loginQuery = "SELECT * FROM users WHERE username='$username' AND password='$password'";
		$result = mysqli_query($mysqli, $loginQuery);
		if (mysqli_num_rows($result) == 1) {
		  $_SESSION['username'] = $username;
		  header("location: index.php");
		} else {
			$errors = "Please enter valid information!";
		}
  }
}
?>

<!doctype html>
<html>
<head>
    <title>Login | Medical Response System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/login.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/js/login.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card login-box my-5">
                    <div class="card-body">
                        <h2 class="text-center my-3">User Portal</h2>
                        <hr class="my-5"/>
                        <h5 class="card-title text-center">Login to the Portal</h5>
						<?php 
						if($errors!=""){
							echo "
								<i>
									$errors
								</i>								
							";
						}
						?>
                        <form method="POST" action="login.php" class="form-signin my-3">
                            <div class="form-group">
                                <label for="inputUsername">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
							</div>
                            <div class="form-group">
                                <label for="inputPassword">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
							</div>
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" name="loginNow" type="submit">Login</button>
							<button class="btn btn-lg bg-primary text-light btn-block text-uppercase" name="createAccount" type="submit" onclick="location.assign('/hospital/login.php')">Hospital login</button>
                            <hr class="my-4"/>
							<button class="btn btn-lg bg-danger text-light btn-block text-uppercase" name="createAccount" type="submit" onclick="location.assign('create.php')">No account yet?</button>
						</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="alert alert-info" role="alert"> <marquee>Call 102 in case of medical emergency. Please wear mask and follow social distancing. Please follow instructions given by the government in order to help control COVID-19 spread</marquee></div>

	
</body>
</html>