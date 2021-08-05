<?php
// CSCI 2170: Project 2, WINTER 2021
// Member: Abdul Basit Syed, Jack Hipson, Yixiao Yuan 
// 
// login processing script, Connect database, check username and password
?>
<?php
	session_start();

	require_once "db.php";

	if (isset($_POST['submit-login'])) {
		$uname = trim(stripslashes(htmlspecialchars($_POST['inputUsername'])));
		$pswd = trim(stripslashes(htmlspecialchars($_POST['inputPassword'])));
		$uname = strtolower($uname);

		$querySQL="select * from `users` where `authorname`='{$uname}'";
		$result = $dbconnection->query($querySQL);

		if ($result->num_rows > 0) {
			$userRecord = $result->fetch_assoc();
			if ($pswd == $userRecord['password']) {
				session_regenerate_id(true); //create new session and delete old session
				// Create session variable when session is active
	
				$_SESSION['username'] = $userRecord['username'];
				$_SESSION['authorname'] = $userRecord['authorname'];
				$_SESSION['user_id'] = $userRecord['userid'];
				$_SESSION['user_level'] = $userRecord['userlevel'];
				$_SESSION['current_id'] = 0;
	
				header("Location: ../index.php");
				die();
			}else{
				// If password is not found, redirect to login page with error info.
				header("Location: ../login.php?loginerror=1");
				die();
			}
		}
		else {
			// If user is wrong, redirect to login page with error info.
			header("Location: ../login.php?loginerror=2");
			die();
		}	
	}
	else {
		// If login info is not submitted but someone tries to access this file, 
		// redirect user to index page.
		header("Location: ../index.php");
		die();
	}
?>
