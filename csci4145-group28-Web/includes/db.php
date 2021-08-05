<?php
// CSCI 4145: Project, WINTER 2021
// Group members: Jiahao Wang, Yixiao Yuan, Yiping Yao.
// 
// DB connection script
// 
	// hosted locally
	$hostservername = "localhost"; //use localhost:<port_number> if connection does not work
	$username = "root";
	$password = "root";
	$dbname = "4145db";

	// hosted Timberlea
	// $hostservername = "db.cs.dal.ca";
	// $username = "yuan1";
	// $password = "8XZSUnChC5GWmhdvHi2KiJCpj";
	// $dbname = "yuan1";

	// hosted AWS 

	// $hostservername = "aa1w9p97exfm7qy.c8vwcqkq2fyn.us-east-1.rds.amazonaws.com";
	// $username = "admin";
	// $password = "4145project";
	// $dbname = "ebdb";

	$dbconnection = new mysqli($hostservername, $username, $password, $dbname);

	if ($dbconnection->connect_error) {
		die("Nooooooooo<br>" . $dbconnection->connect_error);
	}
	else {
		//echo "<h1>Connected!</h1>";
	}
?>