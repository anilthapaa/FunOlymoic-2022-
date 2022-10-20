<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
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
        height: 22em;
        box-shadow: .1em .1em .5em rgba(128, 128, 128, 0.45);
        border-radius: .25em;
        overflow: hidden;
    }
   
    .card p, .card a {
        margin: .25em 0 .75em .75em;
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

    .card img{
        width: 100%;
        height: 60%;
    }
</style>

<body>
    <?php include('header.php') ?>
    <div class="container">
        <h1>News</h1>
        <div class="card-section">
        <?php
                $select_news = mysqli_query($connection, "SELECT * FROM news");
                while($row=mysqli_fetch_assoc($select_news)){
                    $newsId = $row['newsId'];
                    $news_title = $row['nTitle'];
                    $news_category = $row['category_title'];
                    $news_thumbnail = $row['new_thumbnail'];
                    $news_date = $row['date'];
                ?>
            <div class="card">
                <img src="./images/<?php echo  $news_thumbnail ?>" alt="">
                <p><?php echo $news_title ?></p>
                <p><?php echo $news_date ?></p>
                <a href="view_news.php?id=<?php echo $newsId?>">View</a>
            </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>