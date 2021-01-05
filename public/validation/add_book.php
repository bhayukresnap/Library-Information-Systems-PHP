<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/src/Session.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/src/Controller/Book.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/src/Controller/Shoppingcart.php');
	$book = new Book();
	$add = new Shoppingcart();
	if(count(json_decode($book->select('where id = '.$_GET['id'], true))) > 0){
		$add->insert($_GET['id']);
		if(isset($_SERVER['HTTP_REFERER'])){
			exit(header("Location: ".$_SERVER['HTTP_REFERER']));
		}
		return;
	}
	exit(header("Location: /"));
 ?>