<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Now</title>
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

    .card p{
        margin: .95em 0 .75em .75em;
    }

    .card a {
        text-decoration: none;
        background-color: #0175a7;
        color: white;
        font-weight: bold;
        padding: .5em 1em;
        border-radius: .25em;
        margin-top: .95em;
        margin-left: .75em;
    }

    .card iframe{
      width: 100%;
      height: 60%;
    }
</style>

<body>
    <?php include('header.php') ?>
    <div class="container">
        <h1>Live Now</h1>
        <div class="card-section">
        <?php
                $select_live = mysqli_query($connection, "SELECT * FROM livevideo");
                while($row=mysqli_fetch_assoc($select_live)){
                    $live_video_id = $row['liveVideoId'];
                    $live_title = $row['vTitle'];
                    $live_description = $row['vDescription'];
                    $live_url = $row['url'];
                    $live_date = $row['date'];
                    $live_category = $row['vCategory'];
                ?>
            <div class="card">
                <iframe src="<?php echo $live_url ?>" frameborder="0" controls></iframe>
                <p><?php echo $live_title ?></p>
                <a href="view-video.php?vid=<?php echo $live_video_id ?>&title=<?php echo $live_title ?>&type=live">View</a>
            </div>
             <?php } ?>
        </div>
    </div>
</body>

</html>