<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videos</title>
</head>

<style>
    .container {
        width: 90%;
        height: auto;
        margin: 2.5em auto;
        padding: 1.5em 3em;
    }

    .container h1 {
        color: #A438FF;
    }

    .card-section{
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(20%,20%));
        grid-template-rows: repeat(aurofit, minmax(22em, 22em));
        row-gap: .5em;
        column-gap: .75em;
    }

    .card {
        width: 100%;
        height: 20em;
        box-shadow: .1em .1em .5em rgba(128, 128, 128, 0.45);
        border-radius: .25em;
        overflow: hidden;
    }

    .card p, .card a {
        margin: .75em 0 .75em .75em;
    }

    .card a {
        text-decoration: none;
        background-color: #0175a7;
        color: white;
        font-weight: bold;
        padding: .5em 1em;
        border-radius: .25em;
        margin-top: 1em;
    }
</style>

<body>
    <?php include('header.php') ?>
    <div class="container">
        <h1>Videos</h1>
        <div class="card-section">
        <?php
                $select_videos = mysqli_query($connection, "SELECT * FROM videos");
                while($row=mysqli_fetch_assoc($select_videos)){
                    $video_id = $row['video_id'];
                    $video_title = $row['vTitle'];
                    $video_description = $row['vDescription'];
                    $video_path = $row['vPath'];
                    $video_date = $row['date'];
                    $video_category = $row['vCategory'];
                ?>
            <div class="card">
                <video width="100%" height="50%" controls>
                    <source src="uploads/<?php echo $video_path ?>" type="video/mp4">
                </video>
                <?php echo $video_title ?>
                <p>
                <p><?php echo $video_date?></p>
                <a href="view-video.php?vid=<?php echo $video_id ?>&title=<?php echo $video_title ?>&type=nonlive">View</a>
            </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>