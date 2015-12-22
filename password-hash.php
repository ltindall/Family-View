<?php 


	if (version_compare(PHP_VERSION, '5.3.7', '<')) {     
		exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
	} 
	else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
	// if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
	//   (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
		require_once("libraries/password_compatibility_library.php");
	}
	require_once("phptest/lib/password.php"); 
	//require_once("../config/db.php");
	require_once('db-credentials/db.php');
	$db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	require_once("db_functions.php"); 
	
	$unhashedPasswords = db_select("SELECT `user_password_hash`,`user_id` FROM ".
		"`users` WHERE  CHAR_LENGTH(  `user_password_hash` ) < 30"); 
	//$unhashedPasswords = db_select("SELECT `user_password_hash`,`user_id` FROM ".
	//	"`users` WHERE `user_id` >= 2171 AND `user_id` <= 2175"); 
	//print_r ($password);
	
	//echo $password[0]['user_password_hash']; 	
	foreach($unhashedPasswords as $tempPassword){
		$plaintext = $tempPassword['user_password_hash']; 

		$user_password_hash = password_hash($plaintext, PASSWORD_DEFAULT);
		$update = db_query("UPDATE `c9`.`users` SET `user_password_hash` = '"
			.$user_password_hash."' WHERE `users`.`user_id` = ".$tempPassword['user_id']);

	}
 
