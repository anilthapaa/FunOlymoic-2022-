<?php
include "../functions.php";

if(isset($_GET['edit'])){
    $get_news_id = $_GET['edit'];
    $get_news_title = $_GET['title'];
}

if(isset($_POST['update_news'])){
    $news_title = $_POST['news-title'];
    $news_description = $_POST['news-description'];
    $news_category = $_POST['news-category'];
    $news_date = $_POST['news-date'];
    $image_path        = $_FILES['news-thumbnail']['name'];
    $image_path_temp   = $_FILES['news-thumbnail']['tmp_name'];

    $error = [
        'news-title'=> '',
        'news-description'=> '',
        'news-category'=> '',
        'news-date'=> '',
        'news-thumbnail'=> '',
    ];
    if($news_title==''){
        $error['news-title'] = 'Title cannot be empty.';
    }
    if($news_description==''){
        $error['news-description'] = 'description be empty.';
    }
    if($news_category==''){
        $error['news-category'] = 'Select a category.';
    }
    if($news_date==''){
        $error['news-date'] = 'Select date.';
    }
    if($image_path==''){
        $error['news-thumbnail'] = 'Select photo.';
    }
    foreach ($error as $key => $value){
        if(empty($value)){
            unset($error[$key]);
        }
    }
    if(empty($error)){
      if(update_news($get_news_id, $news_date, $news_description, $news_title, $news_category, time().$image_path)){
        copy($image_path_temp, "../images/".time().$image_path);
        $message = "News updated successfully";
      }
    }
}
$query = "SELECT * FROM news WHERE newsId = $get_news_id";
$select_news = mysqli_query($connection, $query);  

while($row = mysqli_fetch_assoc($select_news)) {
    $db_nTitle = $row['nTitle'];
    $db_nDescription = $row['nDescription'];
    $db_Category_Title = $row['category_title'];
    $db_Date = $row['date'];
    $db_New_Thumbnail = $row['new_thumbnail'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Edit News</title>
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
        <a href="manage-news.php">View All</a>
        <p style="color:green"><?php echo isset($message)?$message:'' ?></p>
        <div class="bottom-section">
            <!--form-->
            <form action="" method="post" enctype="multipart/form-data">
                <input type="text" name="news-title" id="" value="<?php echo $db_nTitle ?>">
                <textarea name="news-description" id="" cols="10" rows="10"><?php echo $db_nDescription ?></textarea>
                <select name="news-category" id="">
                    <option value="">Select a category</option>
                    <?php
                            $categories_query = "SELECT * FROM categories";
                            $select_categories_query = mysqli_query($connection, $categories_query);
                            while($row = mysqli_fetch_assoc($select_categories_query)) {
                              $title     = $row['title'];
                              if ($db_Category_Title == $title){
                                echo "<option selected value='{$title}'>{$title}</option>";
                            }
                            else {
                            echo "<option value='{$title}'>{$title}</option>";                    
                            }
                            }
                        ?>
                </select>
                <input type="date" name="news-date" id="" value="<?php echo $db_Date ?>">
                <img src="../images/<?php echo $db_New_Thumbnail ?>" alt="" height=80 width=100>
                <input type="file" name="news-thumbnail" id="">
                <p style="font-size:12px; color:red">
                        <?php echo isset($error['news-thumbnail']) ? $error['news-thumbnail'] : '' ?>
                    </p>
                <input type="submit" name="update_news" value="Update">
            </form>
        </div>
    </div>
</body>

</html>