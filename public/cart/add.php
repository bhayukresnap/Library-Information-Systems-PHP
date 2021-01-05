<?php 
	if(!isset($_GET['id']) || empty($_GET['id'])) exit(header("Location: /"));
	require_once($_SERVER['DOCUMENT_ROOT'].'/src/Session.php');
 ?>