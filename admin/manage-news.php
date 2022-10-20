<?php include "../functions.php"; 

if(isset($_POST['add_news'])){
    $news_title = $_POST['news-title'];
    $news_description = $_POST['news-description'];
    $news_category = $_POST['news-category'];
    $image_path        = $_FILES['news-thumbnail']['name'];
    $image_path_temp   = $_FILES['news-thumbnail']['tmp_name'];

    $error = [
        'news-title'=> '',
        'news-description'=> '',
        'news-category'=> '',
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
    if($image_path==''){
        $error['news-thumbnail'] = 'Select photo.';
    }
    foreach ($error as $key => $value){
        if(empty($value)){
            unset($error[$key]);
        }
    }
    if(empty($error)){
      if(add_news($news_description, $news_title, $news_category, time().$image_path)){
        copy($image_path_temp, "../images/".time().$image_path);
        $message = "News added successfully";
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
    <title>Manage News</title>
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
                <input type="text" name="news-title" id="" placeholder="Title of the news..">
                <p style="font-size:12px; color:red">
                        <?php echo isset($error['news-title']) ? $error['news-title'] : '' ?>
                    </p>

                <textarea name="news-description" cols="10" rows="10" placeholder="Description of the news.."></textarea>
                <p style="font-size:12px; color:red">
                        <?php echo isset($error['news-description']) ? $error['news-description'] : '' ?>
                    </p>
                
                <select name="news-category" id="">
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
                        <?php echo isset($error['news-category']) ? $error['news-category'] : '' ?>
                    </p>

                <input type="file" name="news-thumbnail" id="">
                <p style="font-size:12px; color:red">
                        <?php echo isset($error['news-thumbnail']) ? $error['news-thumbnail'] : '' ?>
                    </p>

                <input type="submit" name="add_news" value="Add">
            </form>
            <!--table-->
            <table>
                <thead>
                    <th>News Title</th>
                    <th>Description</th>
                    <th>Upload Date</th>
                    <th colspan="2">Actions</th>
                </thead>
                <tbody>
                <?php
                    delete_news();
                    $select_news = mysqli_query($connection, "SELECT * FROM news");
                    while($row = mysqli_fetch_assoc($select_news)){
                        $newsId = $row['newsId'];
                        $date = $row['date'];
                        $nDescription = $row['nDescription'];
                        $nTitle = $row['nTitle'];
                        $category_title = $row['category_title'];
                        $new_thumbnail = $row['new_thumbnail'];
                    ?>
                    <tr>
                    <?php 
                    echo "<td>$nTitle</td>";
                    echo"<td>$nDescription</td>";
                    echo"<td>$date</td>";
                    echo "<td><a href='update-news.php?edit=$newsId&title=$nTitle'>Edit</a></td>";
                    echo "<td><a href='manage-news.php?delete=$newsId&thumbnail=$new_thumbnail' style='color:red' onClick=\"javascript: return confirm('Are you sure you want to delete?'); \">Delete</a></td>";
                    ?>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>