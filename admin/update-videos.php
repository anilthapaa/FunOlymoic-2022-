<?php include "../functions.php";
if(isset($_GET['edit'])){
    $get_video_id = $_GET['edit'];
    $get_title = $_GET['title'];
}
if(isset($_POST['update_video'])){
    $video_title = $_POST['video-title'];
    $video_description = $_POST['video-description'];
    $video_category = $_POST['video-category'];
    $video_date = $_POST['video-date'];
    $video_path        = $_FILES['video']['name'];
    $video_path_temp   = $_FILES['video']['tmp_name'];

    $error = [
        'video-title'=> '',
        'video-description'=> '',
        'video-category'=> '',
        'video-file'=> '',
        'video-date'=>'',
    ];
    if($video_title==''){
        $error['video-title'] = 'Title cannot be empty.';
    }
    if($video_description==''){
        $error['video-description'] = 'Description cannot be empty.';
    }
    if($video_category==''){
        $error['video-category'] = 'Select a category.';
    }
    if($video_date==''){
        $error['video-date'] = 'Select date.';
    }
    if($video_path==''){
        $error['video-file'] = 'Select video.';
    }
    foreach ($error as $key => $value){
        if(empty($value)){
            unset($error[$key]);
        }
    }
    if(empty($error)){
      if(update_video($get_video_id, $video_title, $video_description, time().$video_path, $video_date, $video_category)){
        copy($video_path_temp, "../uploads/".time().$video_path);
        $message = "Video updated successfully";
      }
    }
}
$query = "SELECT * FROM videos WHERE video_id = $get_video_id";
    $select_video = mysqli_query($connection, $query);  

    while($row = mysqli_fetch_assoc($select_video)) {
        $db_video_title = $row['vTitle'];
        $db_video_date = $row['date'];
        $db_video_description = $row['vDescription'];
        $db_video_path = $row['vPath'];
        $db_video_category = $row['vCategory'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Manage Videos</title>
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Lexend&display=swap');

    * {
        font-family: 'Lexend', sans-serif;
    }

    .container {
        width: 90%;
        margin: auto;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 1.5em 3em;
    }


    .top-section {
        width: 100%;
        padding: 1.5em 3em;
    }

    .top-section a {
        display: flex;
        color: #0175a7;
        font-size: 1.25em;
        font-weight: bold;
        text-decoration: none;
        align-items: center;
        justify-content: flex-start;
    }

    .top-section a i {
        margin-right: .25em;
    }

    .bottom-section{
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }
    table{
        width: 55%;
    }

    form {
        width: 30%;
        display: flex;
        flex-direction: column;
    }

    input,
    select,
    textarea {
        width: 100%;
        font-size: .9em;
        margin: .75em 0;
        padding: .5em .25em;
        outline: none;
        border: .1em solid #0175a7;
        border-radius: .25em;
    }

    input[type=submit] {
        background-color: #0175a7;
        color: white;
        border: none;
        cursor: pointer;
        font-weight: bolder;
    }

    input[type=file]{
        border:none;
    }
</style>

<body>
    <div class="container">
        <div class="top-section">
            <a href="../admin/admin-dashboard.php">
                <i class="fa-solid fa-arrow-left-long"></i>
                <p>Back to dashboard</p>
            </a>
        </div>
        <a href="manage-videos.php">View All</a>
        <p style="color:green"><?php echo isset($message)?$message:'' ?></p>
        <div class="bottom-section">
            <!--form-->
            <form action="" method="post" enctype="multipart/form-data">
            <input type="text" name="video-title" id="" value="<?php echo $db_video_title ?>">
                <p style="font-size:12px; color:red">
                        <?php echo isset($error['video-title']) ? $error['video-title'] : '' ?>
                    </p>
                
                <textarea name="video-description" id="" cols="10" rows="10"><?php echo $db_video_description ?></textarea>
                <p style="font-size:12px; color:red">
                        <?php echo isset($error['video-description']) ? $error['video-description'] : '' ?>
                    </p>
                    <input type="date" name="video-date" id="" value="<?php echo $db_video_date ?>">
                <p style="font-size:12px; color:red">
                        <?php echo isset($error['video-date']) ? $error['video-date'] : '' ?>
                    </p>
                <select name="video-category" id="">
                    <option value="default">Select a category</option>
                    <?php
                            $categories_query = "SELECT * FROM categories";
                            $select_categories_query = mysqli_query($connection, $categories_query);
                            while($row = mysqli_fetch_assoc($select_categories_query)) {
                              $title     = $row['title'];
                              if ($db_video_category == $title){
                                echo "<option selected value='{$title}'>{$title}</option>";
                            }
                            else {
                            echo "<option value='{$title}'>{$title}</option>";                    
                            }
                            }
                        ?>
                </select>
                <p style="font-size:12px; color:red">
                        <?php echo isset($error['video-category']) ? $error['video-category'] : '' ?>
                    </p>

<video src="../uploads/<?php echo $db_video_path ?>" height=100 width=150 controls></video>
                <input type="file" name="video" id="">
                <p style="font-size:12px; color:red">
                        <?php echo isset($error['video-file']) ? $error['video-file'] : '' ?>
                    </p>
                <input type="submit" name="update_video" value="Update">
            </form>
        </div>
    </div>
</body>

</html>