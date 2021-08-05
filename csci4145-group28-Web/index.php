<?php
// CSCI 4145: Project, WINTER 2021
// Group members: Jiahao Wang, Yixiao Yuan, Yiping Yao.
// 
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

if (isset($_GET['main']) && $_GET['main']==1) {
    $_SESSION['current_id'] = -1;
}
require_once "includes/header.php";
require_once "includes/db.php";

?>
                <div class="col mx-auto">
                    <div class="container shadow" id ="article_container">
                    <?php
                        include "article.php";
                    ?>
                    </div>
                </div>

<?php
	require_once "includes/footer.php";
?>