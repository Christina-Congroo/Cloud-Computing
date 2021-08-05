<?php
// CSCI 4145: Project, WINTER 2021
// Group members: Jiahao Wang, Yixiao Yuan, Yiping Yao.
// 
if (!isset($_SESSION)){
    session_start();
}

// Check whether the user login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    die();
}
// Get the user's id, name, etc.
$username = $_SESSION['username']; //first name + " " + last name
$authorname = $_SESSION['authorname']; //author name
$userid = $_SESSION['user_id'];// user id
$userlevel = $_SESSION['user_level'];// user level

require_once "db.php";
?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $querySQL="SELECT A.*,U.* FROM `articles` A, users U WHERE U.userid = A.user_id and A.id = {$id}";
    $result = $dbconnection->query($querySQL);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $like_id = $row["like_id"];
        $like_count =$row["like_count"];

        $like_id_list = explode(",",$like_id);

        $like_id ="";
        $islike = 0;
        if ($like_count>0) {
            foreach ($like_id_list as $value) {
                if ($value != (string)$id) {
                    $like_id += (string)$value +",";
                }else{
                    $islike = 1;
                }
            }
        }

        if ($islike == 1) {
            $like_count -= 1;            
        }else{
            $like_count += 1;
            $like_id = $like_id+","+(string)$id;
        }

        $querySQLA="UPDATE `articles` SET like_count='{$like_count}',`like_id`='{$like_id}' WHERE `id` = {$id}";
        $resultA = $dbconnection->query($querySQLA);

        echo " (".(string)$like_id_list.")";
    }
}

?>
