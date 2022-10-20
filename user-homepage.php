<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Lexend&display=swap');

    * {
        font-family: 'Lexend', sans-serif;
    }

    .container {
        width: 90%;
        margin: 0 auto 2.5em auto;
        padding: 1.5em 3em;
    }
    h3 {
        color: #A438FF;
        text-align: center;
        margin: .75em auto;
    }

    .bottom-section {
        display: flex;
        justify-content: space-between;
    }

    .video-section,
    .news-section,
    .fixtures-section {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
    }

    .video-section,
    .news-section {
        width: 40%;
        height: auto;
    }

    .fixtures-section {
        width: 15%;
    }



    .card-section:first-of-type,
    .card-section:nth-of-type(2) {
        width: 100%;
        display: grid;
        grid-template-columns: repeat(2, 47.5%);
        column-gap: 2.5em;
        grid-template-rows: repeat(2, 20em);
        row-gap: 2.5em;
        align-content: center;
        justify-items: center;
    }

    .fixtures-section .card-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }


    .fixture-card {
        width: 80%;
        height: auto;
        padding: .75em 1.5em;
        margin: .5em 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        box-shadow: .1em .1em .5em rgba(128, 128, 128, 0.45);
        font-size: .92em;
    }

    .fixture-card p {
        margin: .15em 0;
        font-weight: .5em;
    }

    .fixture-card p:first-of-type {
        font-weight: bolder;
        color: #0175a7;
    }

    .fixture-card p:nth-of-type(2) {
        color: grey;
        font-weight: bold;
    }

    .fixture-card p:last-of-type {
        font-weight: bold;
    }


    .video-card {
        width: 90%;
        height: 18em;
        box-shadow: .1em .1em .5em rgba(128, 128, 128, 0.45);
        border-radius: .25em;
        overflow: hidden;
    }

    .video-card p,
    .video-card a {
        margin: .75em 0 .75em .75em;
    }

    .video-card a {
        text-decoration: none;
        background-color: #0175a7;
        color: white;
        font-weight: bold;
        padding: .5em 1em;
        border-radius: .25em;
        margin-top: 1em;
    }

    .news-card {
        width: 100%;
        height: 20em;
        box-shadow: .1em .1em .5em rgba(128, 128, 128, 0.45);
        border-radius: .25em;
        overflow: hidden;
        padding-bottom:20px;
    }

    .news-card p,
    .news-card a {
        margin: .75em 0 .75em .75em;
    }

    .news-card a {
        text-decoration: none;
        background-color: #0175a7;
        color: white;
        font-weight: bold;
        padding: .5em 1em;
        border-radius: .25em;
        margin-top: 1em;
    }

    .news-card img {
        width: 100%;
        height: 60%;
    }
</style>


<?php include_once('header.php') ?>
<div class="container">
    <!--content section-->
    <div class="bottom-section">
        <div class="video-section">
            <h3>Most Viewed Videos</h3>
            <div class="card-section">
            <?php
                $select_videos = mysqli_query($connection, "SELECT * FROM videos LIMIT 4");
                while($row=mysqli_fetch_assoc($select_videos)){
                    $video_id = $row['video_id'];
                    $video_title = $row['vTitle'];
                    $video_description = $row['vDescription'];
                    $video_path = $row['vPath'];
                    $video_date = $row['date'];
                    $video_category = $row['vCategory'];
                ?>
                <div class="video-card">
                    <video width="100%" height="50%" controls>
                        <source src="uploads/<?php echo $video_path ?>" type="video/mp4">
                    </video>
                    <p><?php echo $video_title ?>
                    <p>
                    <p><?php $video_date ?></p>
                    <a href="view-video.php?vid=<?php echo $video_id ?>&title=<?php echo $video_title ?>&type=nonlive">View</a>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="news-section">
            <h3>Live Videos</h3>
            <div class="card-section">
            <?php
                $select_live = mysqli_query($connection, "SELECT * FROM livevideo LIMIT 4");
                while($row=mysqli_fetch_assoc($select_live)){
                    $live_video_id = $row['liveVideoId'];
                    $live_title = $row['vTitle'];
                    $live_description = $row['vDescription'];
                    $live_url = $row['url'];
                    $live_date = $row['date'];
                    $live_category = $row['vCategory'];
                ?>
                <div class="news-card">
                <iframe src="<?php echo $live_url ?>" frameborder="0" controls></iframe>
                    <p><?php echo $live_title ?></p>
                    <p><?php echo $live_date ?></p>
                    <a href="view-video.php?vid=<?php echo $live_video_id ?>&title=<?php echo $live_title ?>&type=live">View</a>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="fixtures-section">
            <h3>Fixtures</h3>
            <div class="card-section">
                <?php
                global $connection;
                $query = "SELECT * FROM fixtures ORDER BY fixid DESC LIMIT 5";
                $result = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    $title = $row['fixtures'];
                    $sports = $row['fixture_category'];
                    $time = $row['fixture_date'] . " / " . $row['fixture_time'];
                    echo "
           <div class='fixture-card'>
           <p>$title</p>
           <p>Sports: $sports</p>
           <p>Date: $time</p>
           </div>
           ";
                }

                ?>
            </div>
        </div>
    </div>
</div>
</body>

</html>