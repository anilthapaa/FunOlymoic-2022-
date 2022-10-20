<?php include "functions.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body style="text-align:center">
<?php 
if (isset($_GET['email'])){
    $email = $_GET['email'];
    if(email_verification($email)){
        echo"<h3 class='text-success text-center'>CONGRATULATIONS!<br>Your account has been activated</h3>";
        echo"<a href='login.php' style='border:1px solid #a438ff; color:white; padding:10px 20px; background:#a438ff'>Sign In</a>";
     }
    else{
        echo "<p class='text-danger text-center'>Sorry! Your account could not be activated</p>";
    }
}
?>
</body>
</html>