<?php 
if(!isset($_GET['id']) || empty($_GET['id'])) exit(header("Location: /"));
elseif (empty($_GET['id'])) exit(header("Location: /"));
require_once($_SERVER['DOCUMENT_ROOT'].'/src/Session.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/Controller/Book.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/Controller/Publisher.php');
$publisher = new Publisher();
$books = new Book();
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php require_once($_SERVER['DOCUMENT_ROOT']."/templates/vendor_library.php");

	?>
	<script type="text/javascript">
		const books = <?php echo $books->display("inner join publishers on books.publisher_id = publishers.id left join types on books.book_type_id = types.id where publishers.id = $_GET[id]", 'books.id as book_id, books.book_name as name, books.book_image as image, books.price_before, books.price_after, books.publisher_id, publishers.publisher_name, types.book_type'); ?>;
		const publisher = "<?php 
			echo json_decode($publisher->select("where id = $_GET[id]"), true)[0]["publisher_name"];
		 ?>";
	</script>
</head>
<body class="app sidebar-mini">
	<?php include_once($_SERVER['DOCUMENT_ROOT']."/templates/header.php") ?>
	<?php include_once($_SERVER['DOCUMENT_ROOT']."/templates/side_bar.php") ?>
	<main class="app-content">
		<div class="app-title">
			<div class="div">
				<h1><i class="fa fa-book"></i> Welcome to Vali - Library</h1>
				<?php 
					echo $_SERVER['REQUEST_URI'];
				 ?>
			</div>
			<ul class="app-breadcrumb breadcrumb">
				<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			</ul>
		</div>
		<div class="tile mb-4">
			<div class="page-header text-center">
			</div>
			<div class="row" id="list_book">
			</div>
		</div>
	</main>
	<script type="text/javascript">
		function fetchBooks(json){
			if(json.data.length > 0){
				json.data.map(function(data){
					let str = '';
					str +=	'<div class="col-6 col-md-2">'
					str +=		'<div class="card mb-3 border-light" data-toggle="tooltip" title="'+data.name+'">'
					str +=			'<a href="book?id='+data.book_id+'">'
					str +=				'<img src="'+data.image+'" class="card-img-top mb-2">'
					str +=			'</a>'
					str +=			'<div class="card-body">'
					str +=				'<h6 class="text-truncate m-0">'+data.name+'</h6>'
					str +=				'<a href="#">'+data.publisher_name+'</a>'
					str +=				'<div class="mb-2">'+data.book_type+'</div>'
					if(data.price_after != 0){
						str +=				'<div><s>'+currencyRp(data.price_before)+'</s></div>'
						str +=				'<h5 class="text-danger">'+currencyRp(data.price_after)+'</h5>'
					}else{
						str +=				'<h5 class="text-danger">'+currencyRp(data.price_before)+'</h5>'
					}
					str +=			'</div>'
					str +=		'</div>'
					str +=	'</div>'
					$('#list_book').append(str);
				});
			}else{
				let str = '';
				str +=	'<div class="col-6 col-md-2">'
				str +=		'This publisher has no book'
				str +=	'</div>'
				$('#list_book').append(str);
			}
			$(json.page).insertAfter('#list_book');
			$('.page-header').html("<h1>"+publisher+"</h1>");
		}
		fetchBooks(books)
	</script>
</body>
</html>