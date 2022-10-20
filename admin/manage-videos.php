<?php include "../functions.php"; 

if(isset($_POST['add_video'])){
    $video_title = $_POST['video-title'];
    $video_description = $_POST['video-description'];
    $video_category = $_POST['video-category'];
    $video_path        = $_FILES['video']['name'];
    $video_path_temp   = $_FILES['video']['tmp_name'];

    $error = [
        'video-title'=> '',
        'video-description'=> '',
        'video-category'=> '',
        'video-file'=> '',
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
    if($video_path==''){
        $error['video-file'] = 'Select video.';
    }
    foreach ($error as $key => $value){
        if(empty($value)){
            unset($error[$key]);
        }
    }
    if(empty($error)){
      if(add_video($video_title, $video_description, time().$video_path, $video_category)){
        copy($video_path_temp, "../uploads/".time().$video_path);
        $message = "Video added successfully";
      }
    }
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

    table thead{
        background-color: #0175a7;
        color: white;
        font-weight: bolder;
    }

    table thead th{
        padding: .75em .5em;
        text-align: start;

    }

    table tbody tr td{
        padding: .75em .5em;
        text-align: start;
    }

   tbody tr:nth-of-type(odd){
        background-color: #E8E8E8;
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
        <p style="color:green"><?php echo isset($message)?$message:'' ?></p>
        <div class="bottom-section">
            <!--form-->
            <form action="" method="post" enctype="multipart/form-data">
                <input type="text" name="video-title" id="" placeholder="Title of the video..">
                <p style="font-size:12px; color:red">
                        <?php echo isset($error['video-title']) ? $error['video-title'] : '' ?>
                    </p>
                
                <textarea name="video-description" id="" cols="10" rows="10" placeholder="Description of the video.."></textarea>
                <p style="font-size:12px; color:red">
                        <?php echo isset($error['video-description']) ? $error['video-description'] : '' ?>
                    </p>
                
                <select name="video-category" id="">
                    <option value="default">Select a category</option>
                    <?php
                            $categories_query = "SELECT * FROM categories";
                            $select_categories_query = mysqli_query($connection, $categories_query);
                            while($row = mysqli_fetch_assoc($select_categories_query)) {
                              $title     = $row['title'];
                            echo "<option value='$title'>$title</option>";
                            }
                        ?>
                </select>
                <p style="font-size:12px; color:red">
                        <?php echo isset($error['video-category']) ? $error['video-category'] : '' ?>
                    </p>


                <input type="file" name="video" id="">
                <p style="font-size:12px; color:red">
                        <?php echo isset($error['video-file']) ? $error['video-file'] : '' ?>
                    </p>

                <input type="submit" name="add_video" value="Add">
            </form>
            <!--table-->
            <table>
                <thead>
                    <th>Video Title</th>
                    <th>Description</th>
                    <th>Upload Date</th>
                    <th colspan="2">Actions</th>
                </thead>
                <tbody>
                <?php
                    delete_video();
                    $select_videos = mysqli_query($connection, "SELECT * FROM videos");
                    while($row = mysqli_fetch_assoc($select_videos)){
                        $video_id = $row['video_id'];
                        $vTitle = $row['vTitle'];
                        $vDescription = $row['vDescription'];
                        $vPath = $row['vPath'];
                        $vDate = $row['date'];
                        $vCategory = $row['vCategory'];
                    ?>
                    <tr>
                    <?php 
                    echo "<td>$vTitle</td>";
                    echo "<td>$vDescription</td>";
                    echo "<td>$vDate</td>";
                    echo "<td><a href='update-videos.php?edit=$video_id&title=$vTitle'>Edit</a></td>";
                    echo "<td><a href='manage-videos.php?delete=$video_id&thumbnail=$vPath' style='color:red' onClick=\"javascript: return confirm('Are you sure you want to delete?'); \">Delete</a></td>";
                    ?>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            
        </div>
    </div>
</body>

</html>