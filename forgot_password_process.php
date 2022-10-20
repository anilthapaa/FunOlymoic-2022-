<?php include "functions.php";
if(isset($_POST['change_password'])){
    $strong_regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/";
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $error = [
        'new_password_error'=> '',
        'confirm_password_error'=> '',        
    ];
    if(empty($new_password)){
        $error['new_password_error'] = 'New password cannot be empty.';
    }
    if(empty($confirm_password)){
        $error['confirm_password_error'] = 'Confirm password cannot be empty.';
    }
    if($confirm_password != $new_password){
        $error['confirm_password_error'] = 'Passwords do not match.';
    }
    if(!empty($new_password) && !preg_match($strong_regex, $new_password)){
		$error['new_password_error'] = 'New password is not strong.';
	}
    foreach ($error as $key => $value){
        if(empty($value)){
            unset($error[$key]);
        }
    }
    if(empty($error)){
        
        if(change_password($_GET['email'], $new_password)){
            $upload_message = "Password has been changed successfully.";
            $message_color ="green";
        }
        else{
            $upload_message = "Password could not be changed.";
            $message_color ="red";
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
    <title>Change Password</title>
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
    </style>
</head>
<body>
<h4 class="heading">Change Password</h4>
    <p style="color:green">
    <p style="<?php echo isset($message_color) ? $message_color : ''?>">
        <?php echo isset($upload_message) ? $upload_message : ''?></p>
    </p>
<form action="" method="POST">
    <input type="password" name="new_password" placeholder="Password">
        <p style="font-size:12px; color:red">
            <?php echo isset($error['new_password_error']) ? $error['new_password_error'] : '' ?>
        </p>
    <input type="password" name="confirm_password" placeholder="Confirm Password">
        <p style="font-size:12px; color:Red">
            <?php echo isset($error['confirm_password_error']) ? $error['confirm_password_error'] : '' ?>
        </p>

<input type="submit" value="Change Password" name='change_password'>

</form> 
</body>
</html>