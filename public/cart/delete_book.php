<?php 
	if(!isset($_GET['id']) || empty($_GET['id'])) exit(header("Location: /"));
	require_once($_SERVER['DOCUMENT_ROOT'].'/src/Session.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/src/Controller/Shoppingcart.php');
	$shoppingcart = new Shoppingcart();
	print_r($shoppingcart->deleteBook($_GET['id']));
	exit(header("Location: ".$_SERVER['HTTP_REFERER']));
 ?>