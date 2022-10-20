<?php include "../functions.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Manage Users</title>
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

    .top-section a i {
        margin-right: .25em;
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
             <!--table-->
             <table>
                <thead>
                    <th>Fullname</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>Profile</th>
                    <th>Status</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <?php
                    changeStatusToInactive();
                    changeStatusToActive();
                    $select_user = mysqli_query($connection, "SELECT * FROM users");
                    while($row = mysqli_fetch_assoc($select_user)){
                        $user_id = $row['user_id'];
                        $full_name = $row['full_name'];
                        $email = $row['email'];
                        $country = $row['country'];
                        $profile_image = $row['profile_image'];
                        $status = $row['status'];
                        $date = $row['date'];
                    echo "<tr>
                        <td>$full_name</td>
                        <td>$email</td>
                        <td>$country</td>
                        <td><img src='../images/$profile_image' height=50 width=100></td>
                        <td>$status</td>";
                        if($status=='unblocked'){
                            echo "<td><a href='manage-users.php?inactive=$user_id' style='color:red'>Block</a></td>";
                        }
                        else{
                            echo "<td><a href='manage-users.php?active=$user_id' style='color:green'>Unblock</a></td>";
                        }
                    echo "</tr>";
                     } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>