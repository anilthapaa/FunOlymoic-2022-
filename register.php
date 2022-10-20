<?php
include "functions.php";
$strongRegex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/";
if(isset($_POST['register'])){
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $error = [
		'fullname'=> '',
		'email'=>'',
        'country'=> '',
		'confirm_password'=>'',
        'password'=> '',
		
	];
	
	if($email == ''){
		$error['email'] = 'Email cannot be empty.';
	}
    if($full_name == ''){
		$error['fullname'] = 'Fullname cannot be empty.';
	}
    if($country == ''){
		$error['country'] = 'Country cannot be empty.';
	}
    if($password == ''){
		$error['password'] = 'Password cannot be empty.';
	}
    if(!($password == '') && !preg_match($strongRegex, $password)) {
        $error['password'] = 'Password is not strong.';
}
    if($confirm_password == ''){
		$error['confirm_password'] = 'Confirm password cannot be empty.';
	}
    if(!empty($password) && !empty($confirm_password) && ($password != $confirm_password)){
        $error['password'] = 'Passwords do not match.';

    }
	if(!empty($email) && email_exists($email)){
		$error['email'] = $email . " already exists";
	}
    foreach ($error as $key => $value){
		if(empty($value)){
			unset($error[$key]);
		}
	}
	
	if(empty($error)){
        if(user_registration($email, $full_name, $country, $password)){
            $registration_message = "Registration successful. Check your email for verification.";
        }
        else{
            $registration_message = "Registration failed.";
        }
	}
}
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <script src="https://kit.fontawesome.com/860bdcab67.js" crossorigin="anonymous"></script>
    <title>Register</title>
</head>

<style>
@import url('https://fonts.googleapis.com/css2?family=Lexend&display=swap');

* {
    font-family: 'Lexend', sans-serif;
}

body {
    margin: 0;
    padding: 0;
    width: 100%;
    display: flex;
    height: 100vh;
    justify-content: center;
    align-items: center;
    background-color: #A438FF;
}

.container {
    background-color: white;
    width: 25em;
    min-width: 25em;
    height: 45em;
    min-height: 30em;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    border-radius: .75em;
}

.left {
    width: 100%;
    height: 25%;
    display: flex;
    align-items: center;
    justify-content: center;
}
#password-hints ul{
	padding-top: 15px;
	padding-right: 15px;
}
#password-hints ul li{
	list-style: none;
	margin-left: -25px;
	padding: 3px;
}
#password-hints ul li i{
	
	margin-right: 10px;
}
.left img {
    width: 40%;
    height: 65%;
}

.container form {
    width: 100%;
    height: auto;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: .5em .15em;
}

form input {
    width: 70%;
    height: 2.75em;
    outline: none;
    border: none;
    border-radius: .25em;
    background-color: rgba(128, 128, 128, 0.15);
    margin: .3em 0;
    padding: 0 0 0 .75em;
    font-size: .9em;
}

input[type='submit'] {
    width: auto;
    height: auto;
    padding: .75em 2.15em;
    background-color: #A438FF;
    color: white;
    font-weight: bold;
    cursor: pointer;
}

a {
    text-align: center;
    text-decoration: none;
    color: #0175a7;
    font-weight: bold;
    margin-top: 1em;
}

a:hover {
    text-decoration: underline;
}
#password-hints{
	display: none;
	font-size: 12px;
	position: absolute !important;
	top: 46%;
	left: 2%;
	z-index: 1;
	background: lightgrey;
	border-radius:5px;
	padding: 10px, 10px, 0, 10px !important;
}
#strength_message{
	color: red;
	display: none;
	margin-top: -20px;
	text-align: right;
	font-size: 12px;
}

#hr{
    
	display: none;
	border: 5px solid red;
  	border-radius: 5px;
	width: 25%;
	margin: auto;
}
</style>

<body>
    <div class="container">
        <div class="left">
            <img src="./images/logo.png" alt="">
        </div>

        <form action="" method="post">
            <p style="color:green"><?php echo isset($registration_message)?$registration_message:'' ?></p>
            <input type="text" name="full_name" placeholder="Full Name">
            <p style="font-size:12px; color:red">
                <?php echo isset($error['fullname']) ? $error['fullname'] : '' ?></p>

            <input type="text" name="email" placeholder="Email">
            <p style="font-size:12px; color:red">
                <?php echo isset($error['email']) ? $error['email'] : '' ?></p>

            <input type="text" name="country" placeholder="Country">
            <p style="font-size:12px; color:red">
                <?php echo isset($error['country']) ? $error['country'] : '' ?></p>

            <input type="password" name="password" placeholder="Password" onkeyup="passwordStrengthCheck()" id="password">
            <hr id="hr">
            <p style="font-size:12px; color:red">
                <?php echo isset($error['password']) ? $error['password'] : '' ?></p>
                <p id="strength_message">Very Weak</p>
            <input type="password" name="confirm_password" placeholder="Confirm Password" onclick="hidePasswordStrengthCheck()" id="confirm_password">
            <p style="font-size:12px; color:red">
                <?php echo isset($error['confirm_password']) ? $error['confirm_password'] : '' ?></p>

            <input type="submit" name="register" value="Register">
        </form>
        <a href="login.php">Login using an existing account</a>
    </div>
    <div id="password-hints">
        <ul>
            <li><i class="fa-regular fa-circle-xmark" id="min_char"></i>should contain at least 8 characters
            </li>
            <li><i class="fa-regular fa-circle-xmark" id="alpha_numeric"></i>should be alphanumeric</li>
            <li><i class="fa-regular fa-circle-xmark" id="upper_lower"></i>should contain at least one
                uppercase and
                lowercase letters</li>
            <li><i class="fa-regular fa-circle-xmark" id="special_char"></i>should contain at least one
                special
                character</li>
        </ul>
    </div>
    <script src="register.js"></script>
</body>

</html>