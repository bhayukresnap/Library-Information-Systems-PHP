<?php 
	clearstatcache();
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT']."/src/Controller/User.php");
	if(!isset($_SESSION['user'])){
		Helper::notification("You need to login first!");
		exit(header("Location: /login"));
	}else{
		$user = new User();
		$user = json_decode($user->select('where email = "'.$_SESSION['user']['email'].'" and password = "'.$_SESSION['user']['password'].'"'), true);

		if(count($user) > 1){
			Helper::notification("There is a problem with your account, please contact Administrator!");
			exit(header("Location: /login"));
			unset($_SESSION['user']);
		}elseif($user[0]['role_id'] < 2){
			Helper::notification("You don't have permission to access this panel!");
			exit(header("Location: /"));
		}

	}

 ?>