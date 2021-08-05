<?php
// CSCI 4145: Project, WINTER 2021
// Group members: Jiahao Wang, Yixiao Yuan, Yiping Yao.

//  Story 3 : Logout of the website
// session destroy functionality implemented based on .

session_start();

if (!isset($_SESSION['username'])) {
    // access control
    header("Location: login.php");
    die();
}

// Unset all of the session variables.
$_SESSION = array();

// Finally, destroy the session.
session_destroy();

// Redirect the user to the homepage and kill the script.
header("Location: index.php");
die();
?>