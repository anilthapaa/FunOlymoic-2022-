<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>


<style>
    @import url('https://fonts.googleapis.com/css2?family=Lexend&display=swap');

    *{
        font-family: 'Lexend', sans-serif;
    }

   
    .container{
        width: auto;
        padding: 3.5em 2.5em;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        border: .1em solid rgba(128, 128, 128, 0.35);
        border-radius: .35em;
    }

    .display-block{
        width: auto;
        display: flex;
        justify-content: flex-start;
    }

    .display-block p{
        font-size: 1.15em;
        margin: 1.15em 0;
    }

    .display-block p:first-of-type{
        width: 9.5em;
        color:#0175a7;
        font-weight: bolder;
    }

    .container form{
        display: flex;
        width: auto;
        margin: .75em 0;
    }

    .container a{
        width: auto;
        height: auto;
        padding: 1em 3em;
        border: none;
        border-radius: .25em;
        color: white;
        font-size: .9em;
        font-weight: bolder;
        cursor: pointer;
    }

    .container a:first-of-type{
      background-color: #0175a7;
      margin-right: .75em;
    }

    .container a:last-of-type{
        background-color: red;
    }


</style>

<body>
    <?php include('header.php')?>
    <?php
    $email = $_SESSION['email'];
    if(isset($_GET['reset'])){
        if(request_password_reset($email));
        $success_message="Your request has been submitted successfully. You'll be provided with password reset link througn your mail.";
    }
    $user_profile = mysqli_query($connection, "SELECT * FROM users WHERE email = '$email'");
    while($row=mysqli_fetch_assoc($user_profile)){
        $user_id = $row['user_id'];
        $fullname = $row['full_name'];
        $email = $row['email'];
        $country = $row['country'];
        $date = $row['date'];
        $profile_image = $row['profile_image'];
    }
    ?>
    <div class="container">
    <p style="color:green">
    <?php
        echo isset($success_message)?$success_message:'';
    ?>
    </p>
    <p style="text-align:center">
    <img src="images/<?php echo $profile_image?>" alt="" height=100 width=100 style="border-radius:50%"></p>
        <div class="display-block">
            <p>Fullname</p>
            <p><?php echo $fullname ?></p>
        </div>
        <div class="display-block">
            <p>Email</p>
            <p><?php echo $email ?></p>
        </div>
        <div class="display-block">
            <p>Country</p>
            <p><?php echo $country ?></p>
        </div>
        <div class="display-block">
            <p>Joined Date</p>
            <p><?php echo $date ?></p>
        </div>

        
            <a href="update-profile.php?user_id=<?php echo $user_id ?>&email=<?php echo $email ?>">Edit Profile</a>
            <a href="profile.php?reset" onClick="javascript: return confirm('Are you sure you want to reset?')">Reset Password</a>
    </div>
</body>

</html>