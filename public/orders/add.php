<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/src/Session.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/Controller/Order.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/Controller/Shoppingcart.php');
$sc = new Shoppingcart();
$check = $sc->select('inner join shopping_cart_details on shopping_cart.id = shopping_cart_details.shopping_cart_id where shopping_cart.user_id = "'.$_SESSION['user']['id'].'"', "shopping_cart_details.book_id");
if(count(json_decode($check)) == 0){
	Helper::notification("Please add books first!", 2);
	exit(header("Location: /"));
}

$order = new Order();
print_r($order->insert([
	'order_id'=>Helper::id_order_generator(),
	'user_id'=>$_SESSION["user"]["id"],
	'status'=>1,
	'book_list'=>$check,
]));

exit(header("Location: /"));

?>