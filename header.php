<?php include "functions.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Name</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lexend&display=swap');

        * {
            font-family: 'Lexend', sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
        }

        .navbar {
            width: 100%;
            height: auto;
            box-sizing: border-box;
            display: flex;
            align-items: center ;
            padding: .75em 5em;
            justify-content: space-around;
        }

        .logo{
            width: 7.5em;
            height: 5em;
        }

        .logo img{
            width: 100%;
            height: 100%;
        }

        .nav-items{
            display: flex;
            justify-content: center;
            width: 50%;
        }

        .nav-link{
            margin: 0 2.5em 0 0;
            font-weight: bolder;
        }

        .nav-link a{
            color: #0175a7;
            text-decoration: none;
        }

        .end{
            display: flex;
            justify-content: center;
            align-items: center;
        }

        input{
            font-size: .9em;
            width: 20em;
            border: .1em solid rgba(128, 128, 128, 0.5);
            border-radius: .25em;
            outline: none;
            padding: .5em;
            margin-right: 2.5em;
        }

        .end a {
            margin-right: 2.5em;
            display: flex;
            text-decoration: none;
            color: #0175a7;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .end a i {
            margin-bottom: .15em;
        }

        button{
            background-color: #A438FF;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: .25em;
            padding: .5em 1.5em;
            font-size: .9em;
            cursor: pointer;
        }

       
    </style>
</head>



    <div class="navbar">
        <div class="logo">
            <a href="user-homepage.php"><img src="./images/logo.png" alt=""></a>
        </div>
        <!--navigation-->
        <div class="nav-items">
            <div class="nav-link"><a href="user-homepage.php">Home</a></div>
            <div class="nav-link"><a href="videos.php">Videos</a></div>
            <div class="nav-link"><a href="live.php">Live</a></div>
            <div class="nav-link"><a href="news.php">News</a></div>
            <div class="nav-link"><a href="fixtures.php">Fixtures</a></div>
            <div class="nav-link"><a href="photos.php">Photos</a></div>
        </div>
        <div class="end">
            <!--search-->
        <form action="search.php" method="post">
            <input type="search" name="search" placeholder="Search...">
        </form>
        <?php
    $email = $_SESSION['email'];
    $user_profile = mysqli_query($connection, "SELECT * FROM users WHERE email = '$email'");
    while($row=mysqli_fetch_assoc($user_profile)){
        $profile_image = $row['profile_image'];
    }
    ?>
        <a href="profile.php">
            <img src="images/<?php echo $profile_image ?>" alt="" height=20 width=20 style="border-radius:50%">
            Profile
        </a>
        <!--logout-->
        <form action="logout.php">
            <button type="submit">Logout</button>
        </form>
        </div>


    </div>

    