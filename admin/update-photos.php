<?php include "../functions.php";
if(isset($_GET['edit'])){
    $get_image_id = $_GET['edit'];
    $get_caption = $_GET['title'];
}
if(isset($_POST['update_photo'])){
    $photo_title = $_POST['photo-title'];
    $image_path        = $_FILES['photo']['name'];
    $image_path_temp   = $_FILES['photo']['tmp_name'];
    $photo_date = $_POST['photo-date'];

    $error = [
        'photo-title'=> '',
        'image-path'=> '',
        'photo-date'=> '',
    ];
    if($photo_title==''){
        $error['photo-title'] = 'Caption cannot be empty.';
    }
    if($photo_date==''){
        $error['photo-date'] = 'Select a date.';
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
      if(update_photo($get_image_id, $photo_title, time().$image_path, $photo_date)){
        copy($image_path_temp, "../images/".time().$image_path);
        $message = "Photo updated successfully";
      }
    }
}
$query = "SELECT * FROM admin_gallery WHERE imgId = $get_image_id";
    $select_photo = mysqli_query($connection, $query);  

    while($row = mysqli_fetch_assoc($select_photo)) {
        $db_Img_Title = $row['img_Title'];
        $db_Img_Path = $row['img_Path'];
        $db_Img_Date = $row['upload_Date'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Edit photo</title>
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
        <a href="manage-photos.php">View All</a>
        <p style="color:green"><?php echo isset($message)?$message:'' ?></p>
        <div class="bottom-section">
            
            <form action="" method="post" enctype="multipart/form-data">
                <input type="text" name="photo-title" id="" value=<?php echo $db_Img_Title ?>>
                <p style="font-size:12px; color:red">
                        <?php echo isset($error['photo-title']) ? $error['photo-title'] : '' ?>
                    </p>
                    <img src="../images/<?php echo $db_Img_Path ?>" alt="" height="80" width="100">
                <input type="file" name="photo">
                <p style="font-size:12px; color:red">
                        <?php echo isset($error['image-path']) ? $error['image-path'] : '' ?>
                    </p>
                    <input type="date" name="photo-date" value="<?php echo $db_Img_Date ?>">
                <p style="font-size:12px; color:red">
                        <?php echo isset($error['photo-date']) ? $error['photo-date'] : '' ?>
                    </p>
                <input type="submit" name="update_photo" value="Update">
            </form>

            <!-- <table>
                <thead>
                    <th>Photo</th>
                    <th>Photo caption</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <tr></tr>
                    <tr></tr>
                </tbody>
            </table> -->
        </div>
    </div>
</body>

</html>