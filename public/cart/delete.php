<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/src/Session.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/src/Controller/Shoppingcart.php');

	$shoppingcart = new Shoppingcart();
	$shoppingcart->delete($_SESSION["user"]["id"], 'user_id');
	exit(header("Location: ".$_SERVER['HTTP_REFERER']));
 ?>