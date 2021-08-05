<?php
// CSCI 4145: Project, WINTER 2021
// Group members: Jiahao Wang, Yixiao Yuan, Yiping Yao.
// 
// 

session_start();

// Check whether the user login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    die();
}

// Get the user's id, name, etc.
$username = $_SESSION['username']; //first name + " " + last name
$authorname = $_SESSION['authorname']; //author name
$userid = $_SESSION['user_id'];// user id

require_once "includes/header.php";
require_once "includes/db.php";
?>

<?php

if (isset($_POST['submit-postarticle'])) {
        $articleid = $_POST['article_id'];
        $parent_id = $_POST['parent_id'];

		$content = trim(stripslashes(htmlspecialchars($_POST['message-text'])));
        $content = substr($content,0,4096);
        $content = str_replace("'","\'",$content);

        $title = trim(stripslashes(htmlspecialchars($_POST['title-text'])));
        $title = substr($title,0,256);
        $title = str_replace("'","\'",$title);

        $current_id = $articleid;

        if ($articleid == 0) {
            $querySQL="INSERT INTO `articles` (`user_id`,`parent_id`,`date`,`title`,`content` ,`like_count`,`like_id`) 
                            VALUES ({$userid},{$parent_id},NOW(),'{$title}','{$content}', 0, '')";
            $current_id = $parent_id;
        }else{
            $querySQL="UPDATE `articles` SET title='{$title}',`content`='{$content}' WHERE `id` = {$articleid}";
        }

        $result = $dbconnection->query($querySQL);

        // $querySQL="SELECT Max(id) FROM messages";
        // $result = $dbconnection->query($querySQL);
        // $row = $result->fetch_assoc();
        // $message_id= $row["Max(id)"];        

        $_SESSION['current_id'] = $current_id;
		include("index.php");
        die();
	}
	else {
		// If  register is not submitted but someone tries to access this file, 
		// redirect user to index page.
		header("Location: index.php");
		die();
	}
?>

<!--  -->
<?php
	require_once "includes/footer.php";
?>