<?php include "../functions.php";
if(isset($_GET['edit'])){
    $get_fixture_id = $_GET['edit'];
    $get_fixtures = $_GET['title'];
}
if(isset($_POST['edit_fixture'])){
    $fixture_title = $_POST['fixture-title'];
    $fixture_date = $_POST['fixture-date'];
    $fixture_time = $_POST['fixture-time'];
    $fixture_category = $_POST['fixture-category'];

    $error = [
        'fixture-title'=> '',
        'fixture-date'=> '',
        'fixture-time'=> '',
        'fixture-category'=> '',
    ];
    if($fixture_title==''){
        $error['fixture-title'] = 'Title cannot be empty.';
    }
    if($fixture_date==''){
        $error['fixture-date'] = 'Select date.';
    }
    if($fixture_time==''){
        $error['fixture-time'] = 'Select time.';
    }
    if($fixture_category==''){
        $error['fixture-category'] = 'Select category.';
    }
    foreach ($error as $key => $value){
        if(empty($value)){
            unset($error[$key]);
        }
    }
    if(empty($error)){
      if(update_fixture($get_fixture_id, $fixture_title, $fixture_date, $fixture_time, $fixture_category)){
        $message = "Fixture updated successfully";
      }
    }
}
$query = "SELECT * FROM fixtures WHERE fixId = $get_fixture_id";
    $select_fixture = mysqli_query($connection, $query);  

    while($row = mysqli_fetch_assoc($select_fixture)) {
        
        $db_fixture_title = $row['fixtures'];
        $db_fixture_date = $row['fixture_date'];
        $db_fixture_time = $row['fixture_time'];
        $db_fixture_category = $row['fixture_category'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Update Fixture</title>
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

    .bottom-section {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    table {
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

    input[type=file] {
        border: none;
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
        <a href="manage-fixtures.php">View All</a>
        <p style="color:green"><?php echo isset($message)?$message:'' ?></p>
        <div class="bottom-section">
            <!--form-->
            <form action="" method="post">
                <input type="text" name="fixture-title" id="" value="<?php echo $db_fixture_title ?>">
                <p style="font-size:12px; color:red">
                        <?php echo isset($error['fixture-title']) ? $error['fixture-title'] : '' ?>
                    </p>
                <input type="date" name="fixture-date" id="" value="<?php echo $db_fixture_date ?>">
                <p style="font-size:12px; color:red">
                        <?php echo isset($error['fixture-date']) ? $error['fixture-date'] : '' ?>
                    </p>
                <input type="time" name="fixture-time" id="" value="<?php echo $db_fixture_time ?>">
                <p style="font-size:12px; color:red">
                        <?php echo isset($error['fixture-time']) ? $error['fixture-time'] : '' ?>
                    </p>
                <select name="fixture-category" id="">
                <option value="">Select</option>
                            <?php
                            $categories_query = "SELECT * FROM categories";
                            $select_categories_query = mysqli_query($connection, $categories_query);
                            while($row = mysqli_fetch_assoc($select_categories_query)) {
                              $title     = $row['title'];
                              if ($db_fixture_category == $title){
                                echo "<option selected value='{$title}'>{$title}</option>";
                            }
                            else {
                            echo "<option value='{$title}'>{$title}</option>";                    
                            }
                            }
                        ?>
                </select>
                <input type="submit" name="edit_fixture" value="Update">
            </form>
            <!--table-->
            <!-- <table>
                <thead>
                    <th>Fixture Title</th>
                    <th>Category</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                </tbody>
            </table> -->
        </div>
    </div>
</body>

</html>