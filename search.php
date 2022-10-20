<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Lexend&display=swap');

    * {
        font-family: 'Lexend', sans-serif;
    }

    h1 {
        text-align: center;
        margin-top: 2.5em;
        color: #A438FF;
    }

    .result-container {
        margin: 2.5em auto;
        padding: 1.5em 3em;
        width: 90%;
        height: auto;
        display: flex;
        flex-direction: column;
    }

    .video-results,
    .news-results,
    .fixture-results {
        width: 100%;
        height: auto;
        display: flex;
        flex-direction: column;
    }

    h3{
        color: #0175a7;
    }

    .card-section {
        width: 100%;
        height: auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(25%, 25%));
        grid-template-rows: repeat(auto-fit, minmax(25em, 25em));
        column-gap: .75em;
        row-gap: .5em;
    }
</style>

<body>
    <?php include('header.php') ?>
    <?php
if(isset($_POST['search'])){
    $search = $_POST['search'];
}?>
    <h1>Search results for '<?php echo $search ?>':</h1>
    <div class="result-container">
        <div class="video-results">
            <h3>Video Results</h3>
            <div class="card-section">
            <?php
                $select_videos = mysqli_query($connection, "SELECT * FROM videos WHERE vDescription LIKE '%$search%'");
                if(mysqli_num_rows($select_videos)==0){
                    echo "<p>No videos available</p>";
                }
                else{
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
            <?php } } ?>
            </div>
        </div>
        <div class="news-resutls">
            <h3>News Results</h3>
            <div class="card-section">
            <ul>
            <?php
        $select_news = mysqli_query($connection, "SELECT * FROM news WHERE nDescription LIKE '%$search%'");
        if(mysqli_num_rows($select_news)==0){
            echo "<p>No news available</p>";
        }
        else{

        
                $select_news = mysqli_query($connection, "SELECT * FROM news");
                while($row=mysqli_fetch_assoc($select_news)){
                    $newsId = $row['newsId'];
                    $news_title = $row['nTitle'];
                    $news_description = $row['nDescription'];
                    $news_category = $row['category_title'];
                    $news_thumbnail = $row['new_thumbnail'];
                    $news_date = $row['date'];
                ?><a href="view_news.php?id=<?php echo $newsId?>">
                    <li>
                    <p><?php echo $news_title ?></p>
                <p><?php echo $news_date ?></p>
             
                    </li>
                    </a>
            <?php } } ?>
                </ul>
            </div>
        </div>
        <div class="fixture-results">
            <h3>Fixture Results</h3>
            <div class="card-section">
            <?php
        $select_fixtures = mysqli_query($connection, "SELECT * FROM fixtures WHERE fixtures LIKE '%$search%'");
        if(mysqli_num_rows($select_fixtures)==0){
            echo "<p>No fixtures available</p>";
        }
        else{
                while($row=mysqli_fetch_assoc($select_fixtures)){
                    $fixture_title = $row['fixtures'];
                    $fixture_category = $row['fixture_category'];
                    $fixture_date = $row['fixture_date'];
                    ?>
                    <div class="card">
                    <p><?php echo $fixture_title ?></p>
                    <p>Sports: <?php echo $fixture_category ?></p>
                    <p>Date: <?php echo $fixture_date ?></p>
                </div>
        <?php } }
        ?>
            </div>
        </div>
    </div>
</body>

</html>