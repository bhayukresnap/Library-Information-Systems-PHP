<?php 
if(!isset($_GET['id']) || empty($_GET['id'])) exit(header("Location: /"));
require_once($_SERVER['DOCUMENT_ROOT'].'/src/Session.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/Controller/Book.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/Controller/Tag.php');
$book = new Book();
$book_tags = new Tag();
if(count(json_decode($book->select("inner join shopping_cart on shopping_cart.user_id = '".$_SESSION["user"]["id"]."' inner join shopping_cart_details on shopping_cart.id = shopping_cart_details.shopping_cart_id where shopping_cart_details.book_id = '$_GET[id]'"),true)) > 0){
	$disabled = 'disabled';
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php require_once($_SERVER['DOCUMENT_ROOT']."/templates/vendor_library.php");?>
	<script type="text/javascript">
		const book = <?php echo $book->select("inner join publishers on books.publisher_id = publishers.id left join types on books.book_type_id = types.id where books.id = '$_GET[id]'", 'books.id as book_id, books.book_name as name, books.book_image as image, books.price_before, books.price_after, books.publisher_id, publishers.publisher_name, types.book_type, books.quantity, books.book_description as description'); ?>[0];
		const book_tags = <?php echo $book_tags->select("inner join books_tags on tags.id = books_tags.tag_id where books_tags.book_id = '$_GET[id]'", "tags.id as id, tags.tag_name"); ?>;
	</script>
</head>
<body class="app sidebar-mini">
	<?php include_once($_SERVER['DOCUMENT_ROOT']."/templates/header.php") ?>
	<?php include_once($_SERVER['DOCUMENT_ROOT']."/templates/side_bar.php") ?>
	<main class="app-content" id="<?php echo "book_".$_GET['id']; ?>">
		<div class="app-title">
			<div class="div">
				<h1><i class="fa fa-book"></i> Welcome to Vali - Library</h1>
			</div>
			<ul class="app-breadcrumb breadcrumb">
				<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			</ul>
		</div>
		<div class="tile mb-4">
			<div class="row">
				<div class="col-12 col-md-6 text-center">
					<img width="50%" data-image>
				</div>
				<div class="col-12 col-md-6 mt-4">
					<h2 data-name></h2>
					<b data-type style="font-style: italic;"></b>
					<div><a data-publisher></a></div>
					<div data-price></div>
					<div data-tags></div>
					<div class="my-2">
						<a href="/cart/add_book?id=<?php echo $_GET['id']?>" class="btn btn-primary <?php isset($disabled) ? print($disabled) : "" ?>">
							Add to cart
							<i class="fa fa-shopping-bag"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="row user">
			<div class="col-md-3">
				<div class="tile p-0">
					<ul class="nav flex-column nav-tabs user-tabs">
						<li class="nav-item"><a class="nav-link active" href="#book_description" data-toggle="tab">Description</a></li>
						<li class="nav-item"><a class="nav-link" href="#user-settings" data-toggle="tab">Details</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-9">
				<div class="tab-content">
					<div class="tab-pane active" id="book_description" >
						<div class="timeline-post">
							<h5>Description: </h5>
						</div>
					</div>
					<div class="tab-pane fade" id="user-settings">
						<div class="tile user-settings">
							<h4 class="line-head">Details</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
	<script type="text/javascript">
		const book_data = $('#book_<?php echo $_GET['id'] ?>');
		book_data.find('[data-image]').attr('src', book.image);
		book_data.find('[data-name]').append(book.name)
		book_data.find('[data-type]').append(book.book_type)
		book_data.find('[data-publisher]').attr('href', "/publisher?id="+book.publisher_id).append(book.publisher_name);
		if(book.price_after != 0){
			book_data.find('[data-price]').append('<div><s>'+currencyRp(book.price_before)+'</s></div>')
			book_data.find('[data-price]').append('<h4 class="text-danger">'+currencyRp(book.price_after)+'</h4>')
		}else{
			book_data.find('[data-price]').append('<h4 class="text-danger">'+currencyRp(book.price_before)+'</h4>')
		}
		book_data.find('#book_description div').append(book.description);
		book_data.find('[data-tags]').append(book_tags.map(function(data){
			return '<span class="badge-pill badge-secondary badge p-2 mr-1">'+data.tag_name+'</span>'
		}))
	</script>
</body>
</html>