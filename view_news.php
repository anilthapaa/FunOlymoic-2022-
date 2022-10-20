<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>$news_title</title>
</head>

<style>
    .container {
        width: 80%;
        height: auto;
        margin: auto;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    .container img {
        width: 60%;
        height: 40vh;
    }

    p {
        margin: 0;
    }

    p:first-of-type {
        font-size: 1.35em;
        font-weight: bolder;
        margin: .25em 0;
    }

    p:nth-of-type(2){
        font-size: 1em;
        font-weight: bold;
        margin: .15em 0;
        color: grey;
    }

    p:last-of-type{
        font-size: .9em;
    }
</style>

<body>
    <?php include_once('./header.php') ?>
    <div class="container">
        <?php
    $sql = "SELECT * FROM news WHERE newsId={$_GET['id']}";
                $result = mysqli_query($connection, $sql);
                        while($row = mysqli_fetch_assoc($result)) {
                           
                        ?>
        <img src="images/<?php echo $row['new_thumbnail'] ?>" alt="">
        <p><?php echo $row['nTitle'] ?></p>
        <p><?php echo $row['nDescription'] ?></p>
        <p><?php echo $row['date'] ?></p>
        <?php } ?>
    </div>
</body>

</html>