<?php
include "database.php";
session_start();
function redirect($location){
    return header("Location: " . $location);
    exit;
}

function email_exists($email){
    global $connection;
    $query = "SELECT email FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_num_rows($result);    
    if ($row > 0){
        return true;
    }
    else{
        return false;
    }
}
function user_registration($email, $full_name, $country, $password){
    global $connection;
    date_default_timezone_set("Asia/Kathmandu");
    $date=date('d-m-Y');
    $password = password_hash($password, PASSWORD_BCRYPT, array('cost'=>12));
    $register_query = mysqli_query($connection, "INSERT INTO users(full_name, email, profile_image, country, password, status, role, date) VALUES('$full_name','$email', 'profile.jpg', '$country', '$password', 'blocked', 'user', '$date')");
    if($register_query){
        $subject="Email Verification";
        $from = "noreply@ismt.com";
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: '.$from."\r\n".
        'Reply-To: '.$from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
        $message ="
        <html>
        <head>
        <title>Email Verification</title>
        </head>
        <body>
        <h2>Dear $full_name,</h2>
        <p>Thank you for requesting user registration. Please click link given below to activate your user account.</p>
        <center><a href='http://localhost/FunOlympic/email_verification.php?email=$email'>Complete Verification</a><center>
        </body>
        </html>";
        
        mail($email, $subject, $message, $headers);
        return true;
    }
}

function email_verification($email){
    global $connection;
    $result = mysqli_query($connection, "UPDATE users SET status = 'unblocked' WHERE email = '{$email}'");
    if(!$result){
        return false;
    }
    return true;
}

function is_verified($email){
    global $connection;
    $select_user = mysqli_query($connection, "SELECT * FROM users WHERE  email = '{$email}' AND status = 'unblocked'");
    $row = mysqli_num_rows($select_user);
    if ($row > 0){
        return true;
    }
    else{
        return false;
    }
}
function user_login($email, $password){
    global $connection;
    $login_user = mysqli_query($connection, "SELECT * FROM users WHERE email = '{$email}' AND status = 'unblocked'");
    while ($row = mysqli_fetch_array($login_user)) {
        $db_userid = $row['user_id'];
        $db_fullname = $row['full_name'];
        $db_password = $row['password'];
        $db_role = $row['role'];
        if (password_verify($password, $db_password)) {
            $_SESSION['user_id'] = $db_userid;
            $_SESSION['full_name'] = $db_fullname;
            $_SESSION['email'] = $email;
            if($db_role == 'admin'){
                redirect('admin/admin-dashboard.php');
            }
            else{
                redirect('user-homepage.php');
            }
        }
    }
}

function request_password_reset($email){
    global $connection;
    date_default_timezone_set("Asia/Kathmandu");
    $date=date('d-m-Y');
    $insert_query = mysqli_query($connection, "INSERT INTO password_reset_request(email, requested_date) VALUES('$email', '$date') ");
    if($insert_query){
        return true;
    }
}

function change_password($email, $new_password){
    global $connection;
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT, array('cost'=>12));
        $result = mysqli_query($connection, "UPDATE users SET password = '{$hashed_password}' WHERE email = '{$email}'");
        if(!$result){
            return false;
        }
        return true;
}

function comments_count($table, $id){
    global $connection;
    $query = "SELECT * FROM " . $table . " WHERE video_id=" . $id;
    $select_from_table = mysqli_query($connection, $query);
    $result = mysqli_num_rows($select_from_table);
    return $result;
}
function likes_count($table, $id){
    global $connection;
    $query = "SELECT * FROM " . $table . " WHERE vid=" . $id;
    $select_from_table = mysqli_query($connection, $query);
    $result = mysqli_num_rows($select_from_table);
    return $result;
}
function like_video($uid, $vid){
    global $connection;
    $like_video = mysqli_query($connection, "INSERT INTO rating_info(uid, vid) VALUES($uid, $vid) ");
    if($like_video){
        return true;
    }
}
function update_profile($user_id, $fullname, $image_path, $email, $country){
    global $connection;
        $select_result = mysqli_query($connection, "SELECT profile_image FROM users WHERE user_id = $user_id");
         while($row = mysqli_fetch_assoc($select_result)){
            $filename = $row['profile_image'];
         }
        $query = "UPDATE users SET ";
        $query .= "full_name = '{$fullname}', ";
        $query .= "email = '{$email}', ";
        $query .= "country = '{$country}', ";
        $query .= "profile_image = '{$image_path}' ";
        $query .= " WHERE user_id = {$user_id}";
        $update_video = mysqli_query($connection, $query);
        if($update_video){
            if($filename != 'profile,jpg'){
                unlink("images/".$filename);
                return true;
            }
            return true;
        }
}
//-------------------  -------------------
function undo_like_video($uid, $vid){
    global $connection;
    $query = "DELETE FROM rating_info WHERE uid = $uid AND vid = $vid";
    mysqli_query($connection, $query);
}
function is_liked($uid, $vid){
    global $connection;
    $query = "SELECT * FROM rating_info WHERE uid = $uid AND vid = $vid";
    $select_query = mysqli_query($connection, $query);
    $result = mysqli_num_rows($select_query);
    return $result;
}

//--------------------------- functions for admin ---------------------------
function count_result($table){
    global $connection;
    $query = "SELECT * FROM " . $table;
    $select_from_table = mysqli_query($connection, $query);
    $result = mysqli_num_rows($select_from_table);
    return $result;
}

function changeStatusToInactive(){
    global $connection;
    if (isset($_GET['inactive'])) {
        $user_id = $_GET['inactive'];
        mysqli_query($connection, "UPDATE users SET status = 'blocked' WHERE user_id = {$user_id}");
    }
}

function changeStatusToActive(){
    global $connection;
    if (isset($_GET['active'])) {
        $user_id = $_GET['active'];
        mysqli_query($connection, "UPDATE users SET status = 'unblocked' WHERE user_id = {$user_id}");        
    }
}

function send_mail_after_password_reset($email){
    global $connection;
    $subject="Password Reset Link";
    $from = "noreply@ismt.com";
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    $message ="
    <html>
    <head>
    <title>Password Reset Link</title>
    </head>
    <body>
    <p style='text-align:center'>Kindly follow the link to change your password.</p>
    <center><a href='http://localhost/FunOlympic/forgot_password_process.php?email=$email'>Change Password</a><center>
    </body>
    </html>";
    if(mail($email, $subject, $message, $headers)){
        mysqli_query($connection, "DELETE FROM password_reset_request WHERE email = '$email'");
    }
    
    return true;
}


//add category
function add_category($title){
    global $connection;
    $add_category = mysqli_query($connection, "INSERT INTO categories(title) VALUES('$title')");
    if($add_category){
        return true;
    }
}

//update category
function update_category($category_id, $title){
    global $connection;
        $query = "UPDATE categories SET ";
        $query .= "title = '{$title}' ";
        $query .= " WHERE category_id = {$category_id}";
        $update_category = mysqli_query($connection, $query);
        if($update_category){
            return true;
        }
    }


//delete category
function delete_categories(){
    global $connection;
    if (isset($_GET['delete'])) {
         $category_id = $_GET['delete'];
         $category_title = $_GET['title'];
         $select_vid = mysqli_query($connection, "SELECT video_id FROM videos WHERE vCategory = '$category_title' LIMIT 1");
         if(mysqli_num_rows($select_vid)!=0){
            $row = mysqli_fetch_assoc($select_vid);
            $vid = $row['video_id'];
            $delete_rating_info = mysqli_query($connection, "DELETE FROM rating_info WHERE vid = $vid");
            $delete_comments = mysqli_query($connection, "DELETE FROM comment WHERE video_id = {$vid}");
            $delete_live_videos = mysqli_query($connection, "DELETE FROM livevideo WHERE vCategory = '{$category_title}'");
            $delete_videos = mysqli_query($connection, "DELETE FROM videos WHERE vCategory = '{$category_title}'");
            $delete_fixtures = mysqli_query($connection, "DELETE FROM fixtures WHERE fixture_category = '{$category_title}'");
            $delete_news = mysqli_query($connection, "DELETE FROM news WHERE nCategory = '{$category_title}'");
            $delete_photos = mysqli_query($connection, "DELETE FROM admin_gallery WHERE img_Category = '{$category_title}'");
         }
            $delete_cat = mysqli_query($connection, "DELETE FROM categories WHERE category_id = {$category_id}");
        }
}

//add fixture
function add_fixture($fixture_title, $fixture_date, $fixture_time, $fixture_category){
    global $connection;
    $add_fixture = mysqli_query($connection, "INSERT INTO fixtures(fixtures, fixture_date, fixture_time, fixture_category) VALUES('$fixture_title','$fixture_date','$fixture_time','$fixture_category')");
    if($add_fixture){
        return true;
    }
}

function delete_fixtures(){
    global $connection;
    if (isset($_GET['delete'])) {
         $fixId = $_GET['delete'];
         $fixture_title = $_GET['title'];
         $query = "DELETE FROM fixtures WHERE fixId = {$fixId}";
         $delete_fixtures = mysqli_query($connection, $query);
     }
}

function update_fixture($get_fixture_id, $fixture_title, $fixture_date, $fixture_time, $fixture_category){
    global $connection;
        $query = "UPDATE fixtures SET ";
        $query .= "fixtures = '{$fixture_title}', ";
        $query .= "fixture_date = '{$fixture_date}', ";
        $query .= "fixture_time = '{$fixture_time}', ";
        $query .= "fixture_category = '{$fixture_category}' ";
        $query .= " WHERE fixId = {$get_fixture_id}";
        $update_fixture = mysqli_query($connection, $query);
        if($update_fixture){
            return true;
        }
    }

//add photo
function add_photo($photo_title, $image_path){
    global $connection;
    date_default_timezone_set("Asia/Kathmandu");
    $date=date('Y-m-d');
    $add_photo = mysqli_query($connection, "INSERT INTO admin_gallery(img_Title, img_Path, upload_Date) VALUES('$photo_title', '$image_path','$date')");
    if($add_photo){
        return true;
    }
}
function delete_photos(){
    global $connection;
    if (isset($_GET['delete'])) {
         $imgId = $_GET['delete'];
         $query = "DELETE FROM admin_gallery WHERE imgId = {$imgId}";
         $delete_photos = mysqli_query($connection, $query);
     }
}
function update_photo($get_image_id, $photo_title, $image_path, $photo_date){
    global $connection;
    $select_result = mysqli_query($connection, "SELECT img_Path FROM admin_gallery WHERE imgId = $get_image_id");
         while($row = mysqli_fetch_assoc($select_result)){
            $filename = $row['img_Path'];
         }
        $query = "UPDATE admin_gallery SET ";
        $query .= "img_Title = '{$photo_title}', ";
        $query .= "img_Path = '{$image_path}', ";
        $query .= "upload_Date = '{$photo_date}' ";
        $query .= " WHERE imgId = {$get_image_id}";
        $update_photo = mysqli_query($connection, $query);
        if($update_photo){
            unlink("../images/".$filename);
            return true;
        }
    }


    //add news
function add_news($news_description, $news_title, $news_category, $image_path){
    global $connection;
    date_default_timezone_set("Asia/Kathmandu");
    $date=date('Y-m-d');
    $add_news = mysqli_query($connection, "INSERT INTO news(date, nDescription, nTitle, category_title, new_thumbnail) VALUES('$date', '$news_description', '$news_title', '$news_category', '$image_path')");
    if($add_news){
        return true;
    }
}
function delete_news(){
    global $connection;
    if (isset($_GET['delete'])) {
         $newsId = $_GET['delete'];
         $filename = $_GET['thumbnail'];
         $query = "DELETE FROM news WHERE newsId = {$newsId}";
         $delete_news = mysqli_query($connection, $query);
         if($delete_news){
            unlink("../images/".$filename);
         }
     }
}
function update_news($get_news_id, $news_date, $news_description, $news_title, $news_category, $image_path){
    global $connection;
    $select_result = mysqli_query($connection, "SELECT new_thumbnail FROM news WHERE newsId = $get_news_id");
         while($row = mysqli_fetch_assoc($select_result)){
            $filename = $row['new_thumbnail'];
         }
        $query = "UPDATE news SET ";
        $query .= "date = '{$news_date}', ";
        $query .= "nDescription = '{$news_description}', ";
        $query .= "nTitle = '{$news_title}', ";
        $query .= "category_title = '{$news_category}', ";
        $query .= "new_thumbnail = '{$image_path}' ";
        $query .= " WHERE newsId = {$get_news_id}";
        $update_news = mysqli_query($connection, $query);
        if($update_news){
            unlink("../images/".$filename);
            return true;
        }
}
function add_comment($uid, $vid, $content){
    global $connection;
    date_default_timezone_set("Asia/Kathmandu");
$date=date('Y-m-d');
$time = date("h:i:sa");
    $add_comment = mysqli_query($connection, "INSERT INTO comment(user_id, video_id, comment, date, time) VALUES($uid, $vid, '$content', '$date', '$time') ");
    if($add_comment){
        return true;
    }
}

    //add video
    function add_video($video_title, $video_description, $video_path, $video_category){
        global $connection;
        date_default_timezone_set("Asia/Kathmandu");
        $date=date('Y-m-d');
        $add_video = mysqli_query($connection, "INSERT INTO videos(vTitle, vDescription, vPath, date, vCategory) VALUES('$video_title', '$video_description', '$video_path', '$date', '$video_category')");
        if($add_video){
            return true;
        }
    }
    function delete_video(){
        global $connection;
        if (isset($_GET['delete'])) {
             $video_id = $_GET['delete'];
             $filename = $_GET['thumbnail'];
             $query = "DELETE FROM videos WHERE video_id = {$video_id}";
             $delete_video = mysqli_query($connection, $query);
             if($delete_video){
                unlink("../uploads/".$filename);
             }
         }
    }

    function update_video($get_video_id, $video_title, $video_description, $video_path, $video_date, $video_category){
        global $connection;
        $select_result = mysqli_query($connection, "SELECT vPath FROM videos WHERE video_id = $get_video_id");
         while($row = mysqli_fetch_assoc($select_result)){
            $filename = $row['vPath'];
         }
        $query = "UPDATE videos SET ";
        $query .= "vTitle = '{$video_title}', ";
        $query .= "vDescription = '{$video_description}', ";
        $query .= "vPath = '{$video_path}', ";
        $query .= "date = '{$video_date}', ";
        $query .= "vCategory = '{$video_category}' ";
        $query .= " WHERE video_id = {$get_video_id}";
        $update_video = mysqli_query($connection, $query);
        if($update_video){
            unlink("../uploads/".$filename);
            return true;
        }
    }


    //add live video
    function add_live($live_title, $live_description, $live_url, $live_category){
        global $connection;
        date_default_timezone_set("Asia/Kathmandu");
        $date=date('Y-m-d');
        $add_live = mysqli_query($connection, "INSERT INTO livevideo(vTitle, vDescription, url, date, vCategory) VALUES('$live_title', '$live_description', '$live_url', '$date', '$live_category')");
        if($add_live){
            return true;
        }
    }
    function delete_live(){
        global $connection;
        if (isset($_GET['delete'])) {
             $live_video_id = $_GET['delete'];
             $query = "DELETE FROM livevideo WHERE liveVideoId = {$live_video_id}";
             $delete_live = mysqli_query($connection, $query);
             if($delete_live){
                return true;
             }
         }
    }

    function update_live($get_live_video_id, $live_title, $live_description, $live_url, $live_date, $live_category){
        global $connection;
        $query = "UPDATE livevideo SET ";
        $query .= "vTitle = '{$live_title}', ";
        $query .= "vDescription = '{$live_description}', ";
        $query .= "url = '{$live_url}', ";
        $query .= "date = '{$live_date}', ";
        $query .= "vCategory = '{$live_category}' ";
        $query .= " WHERE liveVideoId = {$get_live_video_id}";
        $update_live = mysqli_query($connection, $query);
        if($update_live){
            return true;
        }
    }
?>