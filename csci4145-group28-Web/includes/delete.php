<?php
// CSCI 4145: Project, WINTER 2021
// Group members: Jiahao Wang, Yixiao Yuan, Yiping Yao.
// 
//  delete the article
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

    $querySQL="DELETE FROM `articles` WHERE id = {$id}";
    $result = $dbconnection->query($querySQL);
}

?>