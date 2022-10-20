<?php include "../functions.php"; 

if(isset($_POST['add_photo'])){
    $photo_title = $_POST['photo-title'];
    $image_path        = $_FILES['photo']['name'];
    $image_path_temp   = $_FILES['photo']['tmp_name'];

    $error = [
        'photo-title'=> '',
        'image-path'=> '',
    ];
    if($photo_title==''){
        $error['photo-title'] = 'Caption cannot be empty.';
    }
    if($image_path==''){
        $error['image-path'] = 'Select photo.';
    }
    foreach ($error as $key => $value){
        if(empty($value)){
            unset($error[$key]);
        }
    }
    if(empty($error)){
      if(add_photo($photo_title, time().$image_path)){
        copy($image_path_temp, "../images/".time().$image_path);
        $message = "Photo added successfully";
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
    <title>Manage Photos</title>
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
            <form action="" method="post"enctype="multipart/form-data">
                <input type="text" name="photo-title" id="" placeholder="Caption..">
                <p style="font-size:12px; color:red">
                        <?php echo isset($error['photo-title']) ? $error['photo-title'] : '' ?>
                    </p>
                <input type="file" name="photo" id="">
                <p style="font-size:12px; color:red">
                        <?php echo isset($error['image-path']) ? $error['image-path'] : '' ?>
                    </p>
                <input type="submit" name="add_photo" value="Add">
            </form>
            <!--table-->
            <table>
                <thead>
                    <th>Photo</th>
                    <th>Photo caption</th>
                    <th colspan="2">Actions</th>
                </thead>
                <tbody>
                    <?php
                    delete_photos();
                    $select_photos = mysqli_query($connection, "SELECT * FROM admin_gallery");
                    while($row = mysqli_fetch_assoc($select_photos)){
                        $imgId = $row['imgId'];
                        $img_Title = $row['img_Title'];
                        $img_Path = $row['img_Path'];
                        $upload_Date = $row['upload_Date'];
                    ?>
                    <tr>
                    <?php 
                    echo "<td>$img_Title</td>";
                    echo"<td><img src='../images/$img_Path' height=50 width=80></td>";
                            echo "<td><a href='update-photos.php?edit=$imgId&title=$img_Title'>Edit</a></td>";
                            echo "<td><a href='manage-photos.php?delete=$imgId&title=$img_Title' style='color:red' onClick=\"javascript: return confirm('Are you sure you want to delete?'); \">Delete</a></td>";
                    ?>

                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>