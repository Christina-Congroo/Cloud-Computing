<?php
// CSCI 4145: Project, WINTER 2021
// Group members: Jiahao Wang, Yixiao Yuan, Yiping Yao.
// 
//  Story 4 : See a list of all the article
if (!isset($_SESSION)){
    session_start();
}

// Check whether the user login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    die();
}

require_once "db.php";
?>

<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $querySQL="SELECT A.*,U.* FROM `articles` A, users U WHERE U.userid = A.user_id and A.id = {$id}";
    $result = $dbconnection->query($querySQL);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row["title"];
        $content = $row["content"];
        $parent_id = $row["parent_id"];
        echo $id."^^^vv^^^".$title."^^^vv^^^".$content."^^^vv^^^".$parent_id;
    }
}

?>
