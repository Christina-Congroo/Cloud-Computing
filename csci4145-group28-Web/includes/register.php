<?php
// CSCI 2170: Project 2, WINTER 2021
// Member: Abdul Basit Syed, Jack Hipson, Yixiao Yuan 
// 
// Create an Account, Connect the database, write user information
?>
<?php
	session_start();

	require_once "db.php";

	if (isset($_POST['submit-register'])) {
		$fname = trim(stripslashes(htmlspecialchars($_POST['inputFirstname'])));
		$lname = trim(stripslashes(htmlspecialchars($_POST['inputLastname'])));
		$uname = trim(stripslashes(htmlspecialchars($_POST['inputUsername'])));
		$pswd = trim(stripslashes(htmlspecialchars($_POST['inputPassword'])));
		$email = trim(stripslashes(htmlspecialchars($_POST['inputEmail'])));
        $username = $fname." ".$lname;
        $uname = strtolower($uname);

		$querySQL="select * from `users` where `authorname`='{$uname}'";
		$result = $dbconnection->query($querySQL);

		if ($result->num_rows > 0) {
            // If authorname is found, redirect to login page with error info.
            header("Location: ../login.php?op=register&registererror=1");
            die();
		}
		else {
            $querySQL="INSERT INTO `users` (`authorname`,`username` ,`password`,`email`,`userlevel`) VALUES ('{$uname}', '{$username}', '{$pswd}', '{$email}', 2)";
            $result = $dbconnection->query($querySQL);
			// If authorname is not found, redirect to login page with success info.
			header("Location: ../login.php?registerok=1");
			die();
		}	
	}
	else {
		// If  register is not submitted but someone tries to access this file, 
		// redirect user to index page.
		header("Location: ../index.php");
		die();
	}
?>
