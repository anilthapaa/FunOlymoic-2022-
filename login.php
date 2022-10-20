<?php
include "functions.php";
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $error = [
		'password'=> '',
		'email'=>'',	
	];
    if($email==''){
        $error['email'] = 'Email cannot be empty';
    }
    if($password == ''){
        $error['password'] = 'Password cannot be empty';
    }
    if(!empty($email) && !is_verified($email)){
        $error['email'] = 'Email not verified';
    }
    if(!empty($email) && !email_exists($email)){
        $error['email'] = 'Email does not exist';
    }
    
    if(!empty($email) && is_verified($email) && email_exists($email) && !user_login($email, $password)){
        $error['email'] = 'Check your email and passsword';
}
    foreach ($error as $key => $value){
		if(empty($value)){
			unset($error[$key]);
		}
	}
	
	if(empty($error)){
        $user_login($email, $password);
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        height: 35em;
        min-height: 30em;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        border-radius: .75em;
    }

    .left {
        width: 100%;
        height: 40%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .left img {
        width: 40%;
        height: 50%;
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
        margin-top: 1.5em;
    }

    a:hover {
        text-decoration: underline;
    }
</style>

<body>
    <div class="container">
        <div class="left">
            <img src="./images/logo.png" alt="">
        </div>
        <form action="" method="post">
            <input type="text" name="email" placeholder="Email">
            <p style="font-size:12px; color:red">
            <?php echo isset($error['email']) ? $error['email'] : '' ?></p>
            <input type="password" name="password" placeholder="Password">
            <p style="font-size:12px;color:red">
            <?php echo isset($error['password']) ? $error['password'] : '' ?></p>
            <input type="submit" name="login" value="Login">
        </form>

        <a href="register.php">Create an account</a>
        <a href="forgot_password.php" style="margin-top: 10px; font-size:12px; color: blue">Forgot Password?</a>
    </div>
</body>

</html>