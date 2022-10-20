
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fixtures</title>
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Lexend&display=swap');

    * {
        font-family: 'Lexend', sans-serif;
    }

    body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .container{
        width: 90%;
        margin: 5em auto;
        padding: 1.5em 3em;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .container h1 {
        color: #A438FF;
        margin: .15em 0;
    }



    .card-section{
        width: 90%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 1.5em 3em;
    }

    .card{
        width: 50%;
        height: auto;
        padding: .75em 1.5em;
        margin: .5em 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        box-shadow: .1em .1em .5em rgba(128, 128, 128, 0.45);
    }

    .card p{
        margin: .15em 0;
    }

    .card p:first-of-type{
        font-weight: bolder;
        color: #0175a7;
        font-size: 1.5em;
    }

    .card p:nth-of-type(2){
        color: grey;
        font-weight: bold;
        font-size: 1.1em;
    }

    .card p:last-of-type{
        font-size: .98em;
        font-weight: bold;
    }
</style>

<body>
    <?php include('header.php')?> 
        <div class="container">
            <h1>Fixtures</h1>
            <div class="card-section">
                <?php
                $select_fixtures = mysqli_query($connection, "SELECT * FROM fixtures");
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
                <?php } ?>
            </div>
        </div>
    </body>

    </html>
</body>

</html>