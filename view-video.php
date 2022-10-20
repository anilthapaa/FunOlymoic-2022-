<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>$video_title</title>
</head>

<style>
.container {
    width: 90%;
    height: auto;
    box-sizing: border-box;
    margin: auto;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: flex-start;
    padding: 1.5em 3em;
}

video {
    width: 100%;
    height: 40vh;
}

.info-section {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.info-section p {
    margin: .5em 0;
}


.info-section p:first-of-type {
    font-size: 1.5em;
    font-weight: bolder;
    margin: .15em 0;
}

.info-section p:nth-of-type(2) {
    color: grey;
    font-weight: bold;
    font-size: .9em;
    margin: .25em 0;
}

.info-section p:last-of-type {
    color: #000000BD;
    font-size: .9em;
    margin: .75em 0;
}


.interaction-section {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    width: 60%;
}

.interaction-section p {
    margin-right: 1.5em;
}

#comment-form {
    margin: 1.25em 0;
    width: 60%;
    height: auto;
    display: flex;
    justify-content: flex-start;
    align-items: center;
}

#comment-form textarea {
    margin-right: 1.5em;
    border: none;
    border-bottom: .12em solid grey;
    outline: none;
    padding: .75em;
}
</style>

<body>
    <?php include('header.php');
    $uid = $_SESSION['user_id']; ?>
    <?php $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 
    ?>
    <div class="container">
        <?php 
                if($_GET['type']=='nonlive'){
                $sql = "SELECT * FROM videos WHERE video_id={$_GET['vid']}";
                $result = mysqli_query($connection, $sql);
                        while($row = mysqli_fetch_assoc($result)) {
                            $vid= $row['video_id'];
                        ?>
        <video controls>
            <source src="uploads/<?php echo $row['vPath'] ?>" type="video/mp4">
        </video>
        <div class="info-section">
            <p><?php echo $row['vTitle'] ?></p>
            <p><?php echo $row['date'] ?></p>
            <p><?php echo $row['vDescription'] ?></p>
        </div>
        <div class="interaction-section">
            <p><?php echo likes_count('rating_info', $_GET['vid']) ?> Likes</p>
            <p><?php echo comments_count('comment', $_GET['vid']) ?> Comments</p>

            <form action="" method="post">
                <button type="submit">Like</button>
            </form>
            <button onclick="document.getElementById('share-video').style.display='block'"
                class="w3-button w3-black">Share</button>
            <div id="share-video" class="w3-modal">
                <div class="w3-modal-content">
                    <div class="w3-container" style="padding:40px">
                        <span onclick="document.getElementById('share-video').style.display='none'"
                            class="w3-button w3-display-topright">&times;</span>
                        <h4>Share with others</h4>
                        <input type="text" name="" id="inputURL" value="<?php echo $url ?>" style="width:90%" disabled>
                        <span onclick="copyURL()" style="cursor:pointer" class="input-group-text" id="copy-URL">
                            <i class="fa-regular fa-copy"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <?php 
if(isset($_POST['comment'])){
    $content = $_POST['comment'];
    add_comment($_SESSION['user_id'], $vid, $content);    
}?>
        <form action="" method="post" id="comment-form">
            <textarea name="comment" id="" cols="55" rows="2" placeholder="Write a comment.."></textarea>
            <button type="submit">Add a comment</button>
        </form>

        <div class="comment-section" style=" height:40vh; overflow:auto; width:100%">


            <?php
    $query = "SELECT * FROM comment WHERE video_id = $vid";
    $select_comments = mysqli_query($connection, $query);  

    while($row = mysqli_fetch_assoc($select_comments)) {
        $content = $row['comment'];
        $uid= $row['user_id'];
        $date = $row['date'];
        ?>

            <?php
    $user_query = "SELECT * FROM users WHERE user_id = $uid";
    $select_user = mysqli_query($connection, $user_query);  

    while($row = mysqli_fetch_assoc($select_user)) {
        $full_name = $row['full_name'];
        echo"<div class='row button'>
        <h6 style='color:grey; font-weight:600'>$full_name</h6>                   
        <span style='color:blue'>$content</span></div>";
        }
        }?>


        </div>

        <?php } }

///Play Live Video


        else{
            $sql = "SELECT * FROM livevideo WHERE liveVideoId={$_GET['vid']}";
                $result = mysqli_query($connection, $sql);
                        while($row = mysqli_fetch_assoc($result)) {
                            $vid= $row['liveVideoId'];
                        ?>
        <iframe src="<?php echo $row['url'] ?>" frameborder="0" width="100%" height="300"></iframe>
        <div class="info-section">
            <p><?php echo $row['vTitle'] ?></p>
            <p><?php echo $row['date'] ?></p>
            <p><?php echo $row['vDescription'] ?></p>
        </div>
        <div class="interaction-section">
            <p><?php echo likes_count('rating_info', $_GET['vid']) ?> Likes</p>
            <p><?php echo comments_count('comment', $_GET['vid']) ?> Comments</p>

            
                <?php
                if(isset($_POST['like'])){
                    like_video($uid, $vid);
                    }
                    if(isset($_POST['undo-like'])){
                        undo_like_video($uid, $vid);
                    }

            if(is_liked($uid, $vid)==0){
                            echo "<form action='' method='post'>
                                    <button type='submit' name='like'>Like</button>
                                </form>";
                        }
                        else{
                            echo "<form action='' method='post'>
                                    <button type='submit' name='undo-like'>Liked</button>
                                </form>";
                        }
                        ?>
                
            <button onclick="document.getElementById('share-live').style.display='block'"
                class="w3-button w3-black">Share</button>

            <div id="share-live" class="w3-modal">
                <div class="w3-modal-content">
                    <div class="w3-container" style="padding:40px">
                        <span onclick="document.getElementById('share-live').style.display='none'"
                            class="w3-button w3-display-topright">&times;</span>
                        <h4>Share with others</h4>
                        <input type="text" name="" id="inputURL" value="<?php echo $url ?>" style="width:90%" disabled>
                        <span onclick="copyURL()" style="cursor:pointer" class="input-group-text" id="copy-URL">
                            <i class="fa-regular fa-copy"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <?php 
        if(isset($_POST['comment'])){
            $content = $_POST['comment'];
            add_comment($_SESSION['user_id'], $vid, $content);    
        }?>
        <form action="" method="post" id="comment-form">
            <textarea name="comment" id="" cols="55" rows="2" placeholder="Write a comment.."></textarea>
            <button type="submit">Add a comment</button>
        </form>
        <div class="comment-section" style=" height:40vh; overflow:auto; width:100%">


        <?php
        $query = "SELECT * FROM comment WHERE video_id = $vid";
        $select_comments = mysqli_query($connection, $query);  

        while($row = mysqli_fetch_assoc($select_comments)) {
        $content = $row['comment'];
        $uid= $row['user_id'];
        $date = $row['date'];
        ?>

                    <?php
        $user_query = "SELECT * FROM users WHERE user_id = $uid";
        $select_user = mysqli_query($connection, $user_query);  

        while($row = mysqli_fetch_assoc($select_user)) {
        $full_name = $row['full_name'];
        echo"<div class='row button'>
        <h6 style='color:grey; font-weight:600'>$full_name</h6>                   
        <span style='color:blue'>$content</span></div>";
        }
        }?>


        </div>
        <?php } }
        ?>
    </div>
    <script>
    function copyURL() {
        var copyText = document.getElementById("inputURL");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);
    }
    $(document).ready(function() {
        $('#copy-URL').tooltip({
            title: "Copied",
            trigger: "click"
        });
    });
    </script>
</body>

</html>