<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photos</title>
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Lexend&display=swap');

    * {
        font-family: 'Lexend', sans-serif;
    }


    h1 {
        text-align: center;
        margin-top: 2.5em;
    }

    .container {
        width: 90%;
        margin: 5em auto;
        padding: 1.5em 0;
        display: grid;
        grid-template-columns: repeat(4, minmax(20em, 20em));
        grid-template-rows: repeat(auto, minmax(20em, 20em));
        align-content: center;
        justify-content: center;
        column-gap: .5em;
        row-gap: 1.5em;
    }

    .container img {
        width: 18em;
        height: 18em;
        border-radius: .25em;
        border: .1em solid rgba(128, 128, 128, 0.5);
    }
</style>

<body>
    <?php include('header.php') ?>
    <h1>
        Photos
    </h1>
    <div class="container">
        <?php
        $select_photos = mysqli_query($connection, "SELECT * FROM admin_gallery");
        while($row=mysqli_fetch_assoc($select_photos)){
            $db_caption = $row['img_Title'];
            $db_img_path = $row['img_Path'];
        ?>
        <img src="./images/<?php echo $db_img_path ?>" alt="" title="$image_caption">
        <?php } ?>
    </div>
   

</body>

</html>