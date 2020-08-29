<?php
// Medical Response System for Smart City
include("includes/conn.php");
$username = "";
$email = "";
$phone = "";
$password = "";
$errors = array("","","","","");

if (isset($_POST['createAccount'])) {
	$username = mysqli_real_escape_string($mysqli,$_POST['username']);
	$email = mysqli_real_escape_string($mysqli,$_POST['email']);
	$phone = mysqli_real_escape_string($mysqli,$_POST['phoneNumber']);
	$password = ($_POST['password']);
	
	// Empty Fields Detection
	if(empty($username)||empty($email)||empty($phone)||empty($password)){
		$errors[0] = "Please fill up all fields!";
	}
	
	// Invalid Email Detection
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors[1] = "Please enter a valid email address!";
	}
	
	// User Existence Detection
	$checkUserExistence = "SELECT * FROM users WHERE username='$username' OR email='$email' OR phone='$phone' LIMIT 1";
	$result = mysqli_query($mysqli, $checkUserExistence);
	$userExistence = mysqli_fetch_assoc($result);
		
	if($userExistence){
		if($userExistence['username']==$username) $errors[2]="Please enter a unique username!";
		if($userExistence['email']==$email) $errors[3]="Please enter a unique email!";
		if($userExistence['phone']==$phone) $errors[4]="Please enter a unique phone number!";
	}
	$errorList = "";
	if($errors[0]!=""){
		$errorList = $errors[0]."<br>";
	}
	if($errors[1]!=""){
		$errorList .= $errors[1]."<br>"; 
	}
	if($errors[2]!=""){
		$errorList .= $errors[2]."<br>"; 
	}
	if($errors[3]!=""){
		$errorList .= $errors[3]."<br>"; 
	}
	if($errors[4]!=""){
		$errorList .= $errors[4]."<br>"; 
	}
	if($errors[0]=="" && $errors[1]=="" && $errors[2]=="" && $errors[3]=="" && $errors[4]==""){
		$password = md5($password);
		$enc = "aes-128-gcm";
		$token = openssl_encrypt($username, $enc, time(), 0, openssl_random_pseudo_bytes(openssl_cipher_iv_length($enc)), $tag);
		
		require('includes/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPDebug = 0;
		$mail->SMTPAuth = TRUE;
		$mail->SMTPSecure = "tls";
		$mail->Port     = 587;  
		$mail->Username = "MRS@hack.it";
		$mail->Password = "hack.it";
		$mail->Host     = "smtp.gmail.com";
		$mail->Mailer   = "smtp";
		$mail->SetFrom("MRS@hack.it", "Medical Response Team");
		$mail->AddAddress("$email");
		$mail->Subject = "Medical Response System Verification";
		$mail->WordWrap   = 80;
		$content = "<html><head><title>Medical Response System Verification</title></head><body><p>Dear $username,</p><p>Thank you for joining the Medical Response System for Smart City designed and developed by <strong>U-TEC (A)</strong>!</p><p>Your Account Verification Token: $token</p><p>Thanks,<br>U-TEC (A)<br>United Technical College</p></body></html>"; $mail->MsgHTML($content);
		$mail->IsHTML(true);
		$mail->Send();

		$createQuery = "INSERT INTO users (username, email, phone, password, token)
						VALUES('$username','$email','$phone','$password','$token')";
		mysqli_query($mysqli, $createQuery);
		$_SESSION['user'] = $username;
		header("Location: index.php");
	}
}?>

<!doctype html>
<html>
<head>
    <title>Create Account | Medical Response System</title>
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
                        <h5 class="card-title text-center">Create an Account</h5>
						<?php 
						if($errorList!=""){
							echo "
								<i>
									$errorList
								</i>								
							";
						}
						?>
                        <form method="POST" action="create.php" class="form-signin my-3">
                            <div class="form-group">
								<label for="inputEmail">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="E-mail Address" required autofocus>
							</div>
                            <div class="form-group">
                                <label for="inputUsername">Phone Number</label>
                                <input type="tel" name="phoneNumber" class="form-control" placeholder="Phone Number" required>
							</div>
                            <div class="form-group">
                                <label for="inputUsername">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Username" required>
							</div>
                            <div class="form-group">
                                <label for="inputPassword">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
							</div>
                            <button class="btn btn-lg btn-danger text-light btn-block text-uppercase" name="createAccount" type="submit">Create Account</button>
                            <hr class="my-3"/>
							<button class="btn btn-lg btn-primary btn-block text-uppercase" name="gotologin" type="submit" onclick="window.location='login.php';">Already a User?</button>
						</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
