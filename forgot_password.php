<?php
include "functions.php";
if(isset($_POST['btn-proceed'])){
    $email = $_POST['email'];
    $error = [
		'email'=> '',
	];
    if($email == ''){
		$error['email'] = 'Email cannot be empty.';
	}
    if(!empty($email) && !email_exists($email)){
		$error['email'] = 'Email not found.';
	}
    foreach ($error as $key => $value){
		if(empty($value)){
			unset($error[$key]);
		}
	}
	
	if(empty($error)){   
        if(request_password_reset($email)){
            $success_message="Your request has been submitted successfully. You'll be provided with password reset link througn your mail.";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
    body{
        padding: 50px;
    }
    form input {
        width: 50%;
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
    .heading {
        padding: 50px 0;
        font-size: 3em;
        font-weight: bolder;
        color: #a438ff;
    }
    .fa-circle-chevron-left {
        color: #a438ff;
        font-size: 2em;
        border: 2px solid #a438ff;
        border-radius: 50%;
    }

    .fa-circle-chevron-left:hover {
        color: white;
        background: #a438ff;
    }

    @media only screen and (max-width: 768px) {

        .heading {
            font-size: 1.5rem;
        }

    }
    </style>
    <title>Forgot Password</title>
</head>

<body>
<a href="login.php">
                <i class="fa-solid fa-circle-chevron-left"></i>
            </a>
    
    <h4 class="heading">Reset Password</h4>
    <p style="color:green">
    <?php
        echo isset($success_message)?$success_message:'';
    ?>
    </p>
    <form action="" method="post">
        <div class="form-group">
            <input type="text" name="email" id="" placeholder="Enter your email address" autocomplete=off>
            <p  style="font-size:12px; color:red">
                <?php echo isset($error['email']) ? $error['email'] : '' ?></p>
        </div>
        <input type="submit" value="Proceed" class="btn" name='btn-proceed'>
    </form>
</body>

</html>