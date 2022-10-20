<?php include "../functions.php"; 

if(isset($_POST['add_live'])){
    $live_title = $_POST['live-title'];
    $live_description = $_POST['live-description'];
    $live_category = $_POST['live-category'];
    $live_url        = $_POST['live-url'];

    $error = [
        'live-title'=> '',
        'live-description'=> '',
        'live-category'=> '',
        'live-url'=> '',
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
    foreach ($error as $key => $value){
        if(empty($value)){
            unset($error[$key]);
        }
    }
    if(empty($error)){
      if(add_live($live_title, $live_description, $live_url.'?autoplay=1&mute=1', $live_category)){
        $message = "Live Video added successfully";
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
            <form action="" method="post">
                <input type="text" name="live-title" id="" placeholder="Title of the live stream..">
                <p style="font-size:12px; color:red">
                        <?php echo isset($error['live-title']) ? $error['live-title'] : '' ?>
                    </p>
                    <textarea name="live-description" id="" cols="10" rows="10" placeholder="Description of the live.."></textarea>
                <p style="font-size:12px; color:red">
                        <?php echo isset($error['live-description']) ? $error['live-description'] : '' ?>
                    </p>
                <input type="text" name="live-url" id="" placeholder="URL or link..">
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
                            echo "<option value='$title'>$title</option>";
                            }
                        ?>
                </select>
                <p style="font-size:12px; color:red">
                        <?php echo isset($error['live-category']) ? $error['live-category'] : '' ?>
                    </p>
                <input type="submit" name="add_live" value="Add">
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
                    delete_live();
                    $select_live = mysqli_query($connection, "SELECT * FROM livevideo");
                    while($row = mysqli_fetch_assoc($select_live)){
                        $liveVideoId = $row['liveVideoId'];
                        $vTitle = $row['vTitle'];
                        $vDescription = $row['vDescription'];
                        $url = $row['url'];
                        $vDate = $row['date'];
                        $vCategory = $row['vCategory'];
                    ?>
                    <tr>
                        <?php
                    echo "<td>$vTitle</td>";
                    echo "<td>$vDescription</td>";
                    echo "<td>$vDate</td>";
                    echo "<td><a href='update-live.php?edit=$liveVideoId&title=$vTitle'>Edit</a></td>";
                    echo "<td><a href='manage-live.php?delete=$liveVideoId' style='color:red' onClick=\"javascript: return confirm('Are you sure you want to delete?'); \">Delete</a></td>";
                    ?>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>