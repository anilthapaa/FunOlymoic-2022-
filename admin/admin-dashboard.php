<?php include "../functions.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Dashboard</title>
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Lexend&display=swap');

    * {
        font-family: 'Lexend', sans-serif;
    }

    .container {
        width: 90%;
        height: 100%;
        margin: auto;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        padding: 1.5em 3em;
    }

    .top-section {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 2.5em 0;
        padding: 1.5em 0;
    }

    .top-section a {
        display: flex;
        justify-content: center;
        align-items: center;
        text-decoration: none;
        font-size: 1.15em;
        font-weight: bold;
        padding: .75em 1.5em;
        border-radius: .5em;
        margin-right: 2.5em;
    }

    .top-section a:first-of-type {
        background-color: #A438FF;
        color: white;

    }

    .top-section a i {
        margin-right: .75em;
    }

    .bottom-section {
        width: 100%;
        height: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: .75em 1.5em;
    }

    .bottom-section div{
        padding: 1.5em 3em;
        border: .25em solid #A438FF;
        border-radius: .5em;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin-right: .75em;
    }

    .bottom-section div h3{
        margin:.15em 0;
    }

    .bottom-section div p{
        margin: .15em 0;
    }

    

    .bottom-section div a{
        text-decoration: none;
        font-size: 1.35em;
        color: #A438FF;
        margin-top: .25em;
            
    }
</style>

<body>
    <div class="container">
        <!--top section-->
        <div class="top-section">
            <a href="../admin/admin-dashboard.php">
                <i class="fa-solid fa-gauge"></i>
                Dashboard
            </a>
            <a href="../admin/notifications.php">
                <i class="fa-solid fa-bell"></i>
                <p>Reset<br>Notifications</p>
                <span style="background:red; color:white; padding:2px 4px; border-radius:6px"><?php echo count_result('password_reset_request') ?><span>
            </a>
            <a href="../user-homepage.php" target="_blank">
                <i class="fa-solid fa-eye"></i>
                <p>View Website</p>
            </a>
            <a href="../logout.php" style="color:red">
            <i class="fa-solid fa-right-from-bracket" style="color:red"></i>
                <p>Logout</p>
            </a>
        </div>
        <!--bottom section-->
        <div class="bottom-section">
            <div class="users">
                <i class="fa-solid fa-users"></i>
                <h3>Users</h3>
                <p><?php echo count_result('users') ?></p>
                <a href="../admin/manage-users.php"><i class="fa-solid fa-gear"></i></a>
            </div>
            <div class="videos">
                <i class="fa-solid fa-video"></i>
                <h3>Videos</h3>
                <p><?php echo count_result('videos') ?></p>
                <a href="../admin/manage-videos.php"><i class="fa-solid fa-gear"></i></a>
            </div>
            <div class="live-now">
                <i class="fa-solid fa-tower-broadcast"></i>
                <h3>Live Now</h3>
                <p><?php echo count_result('livevideo') ?></p>
                <a href="../admin/manage-live.php"><i class="fa-solid fa-gear"></i></a>
            </div>
            <div class="news">
                <i class="fa-solid fa-newspaper"></i>
                <h3>News</h3>
                <p><?php echo count_result('news') ?></p>
                <a href="../admin/manage-news.php"><i class="fa-solid fa-gear"></i></a>
            </div>
            <div class="photos">
                <i class="fa-solid fa-image"></i>
                <h3>Photos</h3>
                <p><?php echo count_result('admin_gallery') ?></p>
                <a href="../admin/manage-photos.php"><i class="fa-solid fa-gear"></i></a>
            </div>
            <div class="fixtures">
                <i class="fa-solid fa-ranking-star"></i>
                <h3>Fixtures</h3>
                <p><?php echo count_result('fixtures') ?></p>
                <a href="../admin/manage-fixtures.php"><i class="fa-solid fa-gear"></i></a>
            </div>
            <div class="categories">
                <i class="fa-solid fa-sitemap"></i>
                <h3>Categories</h3>
                <p><?php echo count_result('categories') ?></p>
                <a href="../admin/manage-categories.php"><i class="fa-solid fa-gear"></i></a>
            </div>
        </div>
    </div>
</body>

</html>