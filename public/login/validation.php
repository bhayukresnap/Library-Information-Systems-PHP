<?php 
	session_start();
	if(isset($_POST['submit_login'])){
		require_once($_SERVER['DOCUMENT_ROOT'].'/src/Controller/User.php');
		$user = new User();
		$user = $user->login($_POST['email'], $_POST['password']);
	}else{
		exit(header("location: /login"));
	}
 ?>