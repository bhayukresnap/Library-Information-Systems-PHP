<?php 
	session_start();
	if(isset($_POST['submit_register'])){
		require_once($_SERVER['DOCUMENT_ROOT'].'/src/Controller/User.php');
		$user = new User();
		$user = $user->insert([
			'email'=> $_POST['email'],
			'name'=> $_POST['name'],
			'password' => $_POST['password'],
			'role_id' => 0,
		]);
	}
	exit(header("location: /login"));
	
 ?>