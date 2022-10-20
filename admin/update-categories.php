<?php include "../functions.php";
if(isset($_GET['edit'])){
    $get_category_id = $_GET['edit'];
    $get_title = $_GET['title'];
}
if(isset($_POST['category-title'])){
    $title = $_POST['category-title'];
    $error = [
        'title'=> '',
    ];
    if($title==''){
        $error['title'] = 'Title cannot be empty.';
    }
    foreach ($error as $key => $value){
        if(empty($value)){
            unset($error[$key]);
        }
    }
    if(empty($error)){
      if(update_category($get_category_id, $title)){
        $message = "Category updated successfully";
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
        <div class="bottom-section">
            <!--form-->
            <form action="" method="post">
                <input type="text" name="category-title" id="" value="<?php echo isset($get_title)?$get_title:'' ?>">
                <p style="font-size:12px; color:red">
                        <?php echo isset($error['title']) ? $error['title'] : '' ?>
                    </p>
                <input type="submit" value="Update">
            </form>
            <!--table-->
            <table>
                <thead>
                    <th>Category Title</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                <?php
                    delete_categories();
                    $select_category = mysqli_query($connection, "SELECT * FROM categories");
                    while($row = mysqli_fetch_assoc($select_category)){
                        $category_id = $row['category_id'];
                        $title = $row['title'];
                    ?>
                    <tr>
                        <?php
                            echo "<td>$title</td>";
                            echo "<td><a href='update-categories.php?edit=$category_id&title=$title'>Edit</a></td>";
                            echo "<td><a href='manage-categories.php?delete=$category_id&title=$title' style='color:red' onClick=\"javascript: return confirm('Are you sure you want to delete? All contents associated to this category will also be deleted.'); \">Delete</a></td>";
                        ?>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>