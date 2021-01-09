<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/src/OwnerSession.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/Controller/User.php');
$orders = new User();
if(isset($_GET['id']) && isset($_GET['role_id'])){
	print_r($orders->update([
		'id'=>$_GET['id'],
		'role_id'=> $_GET['role_id'],
	]));
}
exit(header("Location: ".$_SERVER['HTTP_REFERER']));

?>