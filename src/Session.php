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

		if(count($user) != 1){
			Helper::notification("There is a problem with your account, please contact Administrator!");
			unset($_SESSION['user']);
			exit(header("Location: /login"));
			
		}else if($user[0]['role_id'] < 1){
			Helper::notification("You don't have permission to access this panel!");
			unset($_SESSION['user']);
			exit(header("Location: /login"));
		}else if($user[0]['role_id'] >= 2){
			Helper::notification("You are not user!");
			exit(header("Location: /admin"));
		}
	}

 ?>