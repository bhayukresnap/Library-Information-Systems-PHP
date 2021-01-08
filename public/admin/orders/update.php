<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/src/AdminSession.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/Controller/Order.php');
$orders = new Order();
if(isset($_GET['id']) && isset($_GET['status'])){
	print_r($orders->update([
		'id'=>$_GET['id'],
		'status'=> $_GET['status'],
	]));
}
exit(header("Location: ".$_SERVER['HTTP_REFERER']));

?>