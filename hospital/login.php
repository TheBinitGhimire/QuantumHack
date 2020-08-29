<?php
/* Medical Response System for Smart City */
session_start();
include("../includes/conn.php");

$errors = "";

if (isset($_POST['loginNow'])) {
	$username = mysqli_real_escape_string($mysqli, $_POST['username']);
	$accessToken = mysqli_real_escape_string($mysqli, $_POST['token']);
	
	// Empty Fields Detection
	if (empty($username)||empty($accessToken)){
		$errors = "Please fill up all fields!";
	}		

	// Trying to log in
	if ($errors=="") {
		$accessToken = md5($accessToken);
		$loginQuery = "SELECT * FROM hospitals WHERE username='$username' AND password='$accessToken'";
		$result = mysqli_query($mysqli, $loginQuery);
		if (mysqli_num_rows($result) == 1) {
		  $_SESSION['hospitalName'] = $username;
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
    <title>Login | Hospital Portal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
    <link rel="stylesheet" href="assets/css/login.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/js/login.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 my-5 mx-auto">
                <div class="card login-box my-5">
                    <div class="card-body">
                        <h2 class="text-center my-3">Hospital Portal</h2>
                        <hr class="my-5"/>
                        <h5 class="card-title text-center">Login to the Portal</h5>
                        <form method="POST" class="form-signin">
                            <div class="form-group">
                                <label for="inputEmail">Hospital Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Hospital Username" required autofocus>
							</div>
                            <div class="form-group">
                                <label for="inputPassword">Access Token</label>
                                <input type="password" name="token" class="form-control" placeholder="Password" required>
							</div>
                            <button class="btn btn-lg btn-primary btn-block text-uppercase" name="loginNow" type="submit">Login</button>
                            <hr class="my-4"/>
						</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>