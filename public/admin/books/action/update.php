<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/src/AdminSession.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/Controller/Book.php');
if(isset($_POST['submit_update'])){
	$book = new Book();
	print_r($book->update([
		'id'=>$_POST['book_id'],
		'book_name'=>$_POST['name'],
		'book_description'=>$_POST['description'],
		'book_image'=> !empty($_FILES['image']['tmp_name']) ? $_FILES['image'] : "",
		'price_before'=>$_POST['price_before'],
		'price_after'=>$_POST['price_after'],
		'rack_id'=>isset($_POST['rack']) ? $_POST['rack'] : 0,
		'quantity'=>$_POST['quantity'],
		'book_year'=>$_POST['year'],
		'publisher_id'=>isset($_POST['publisher']) ? $_POST['publisher'] : 0,
		'type_id'=>isset($_POST['type']) ? $_POST['type'] : 0,
		'tags'=>isset($_POST['tags']) ? $_POST['tags'] : 0,
		'current_image'=>$_POST['current_image'],							
	]));
	
}

exit(header("Location: ".$_SERVER['HTTP_REFERER']));
?>