<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/src/Session.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/Controller/Order.php');
$orders = new Order();
if(isset($_GET['id'])){
	print_r($orders->update([
		'id'=>$_GET['id'],
		'status'=> 3,
	]));
}
exit(header("Location: ".$_SERVER['HTTP_REFERER']));

?>