<?php include "../functions.php";
if(isset($_GET['edit'])){
    $get_live_video_id = $_GET['edit'];
    $get_live_title = $_GET['title'];
}
if(isset($_POST['update_live'])){
    $live_title = $_POST['live-title'];
    $live_description = $_POST['live-description'];
    $live_category = $_POST['live-category'];
    $live_url        = $_POST['live-url'];
    $live_date = $_POST['live-date'];

    $error = [
        'live-title'=> '',
        'live-description'=> '',
        'live-category'=> '',
        'live-url'=> '',
        'live-date'=>'',
    ];
    if($live_title==''){
        $error['live-title'] = 'Title cannot be empty.';
    }
    if($live_description==''){
        $error['live-description'] = 'Description cannot be empty.';
    }
    if($live_category==''){
        $error['live-category'] = 'Select a category.';
    }
    if($live_url ==''){
        $error['live-url'] = 'URL cannot be empty.';
    }
    if($live_date ==''){
        $error['live-date'] = 'Select date.';
    }
    foreach ($error as $key => $value){
        if(empty($value)){
            unset($error[$key]);
        }
    }
    if(empty($error)){
      if(update_live($get_live_video_id, $live_title, $live_description, $live_url.'?autoplay=1&mute=1', $live_date, $live_category)){
        $message = "Live Video updated successfully";
      }
    }
}
$query = "SELECT * FROM livevideo WHERE liveVideoId = $get_live_video_id";
    $select_live = mysqli_query($connection, $query);  

    while($row = mysqli_fetch_assoc($select_live)) {
        $db_live_title = $row['vTitle'];
        $db_live_date = $row['date'];
        $db_live_description = $row['vDescription'];
        $db_live_url = $row['url'];
        $db_live_category = $row['vCategory'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Manage Live</title>
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
        <a href="manage-live.php">View All</a>
        <p style="color:green"><?php echo isset($message)?$message:'' ?></p>
        <div class="bottom-section">
            <!--form-->
            <form action="" method="post">
            <input type="text" name="live-title" id="" value="<?php echo $db_live_title ?>">
                <p style="font-size:12px; color:red">
                        <?php echo isset($error['live-title']) ? $error['live-title'] : '' ?>
                    </p>
                    <textarea name="live-description" id="" cols="10" rows="10"><?php echo $db_live_description ?></textarea>
                <p style="font-size:12px; color:red">
                        <?php echo isset($error['live-description']) ? $error['live-description'] : '' ?>
                    </p>
                <input type="text" name="live-url" id="" value="<?php echo $db_live_url ?>">
                <p style="font-size:12px; color:red">
                        <?php echo isset($error['live-url']) ? $error['live-url'] : '' ?>
                    </p>

                <select name="live-category" id="">
                    <option value="">Select a category</option>
                    <?php
                            $categories_query = "SELECT * FROM categories";
                            $select_categories_query = mysqli_query($connection, $categories_query);
                            while($row = mysqli_fetch_assoc($select_categories_query)) {
                              $title     = $row['title'];
                              if ($db_live_category == $title){
                                echo "<option selected value='{$title}'>{$title}</option>";
                            }
                            else {
                            echo "<option value='{$title}'>{$title}</option>";                    
                            }
                            }
                        ?>
                </select>
                <input type="date" name="live-date" id="" value="<?php echo $db_live_date ?>">
                <p style="font-size:12px; color:red">
                        <?php echo isset($error['live-date']) ? $error['live-date'] : '' ?>
                    </p>
                <p style="font-size:12px; color:red">
                        <?php echo isset($error['live-category']) ? $error['live-category'] : '' ?>
                    </p>
                <input type="submit" name="update_live" value="Update">
            </form>

            <iframe src="<?php echo $db_live_url ?>" frameborder="0" height=350 width="400"></iframe>
        </div>
    </div>
</body>

</html>