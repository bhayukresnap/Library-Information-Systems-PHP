<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/src/AdminSession.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/Controller/Book.php');
$book = new Book();
if (isset($_GET['delete']) && !empty($_GET['delete'])) $book->delete($_GET['delete']);
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php require_once($_SERVER['DOCUMENT_ROOT']."/templates/vendor_library.php");?>
	<script type="text/javascript">
		const books = <?php 
		if (isset($_GET['search']) && !empty($_GET['search'])){
			echo $book->display("where book_name like '%$_GET[search]%'", "books.id as book_id, books.book_name as name, books.book_image as image");
		}else{
			echo $book->display("", "books.id as book_id, books.book_name as name, books.book_image as image");
		}
		?>
	</script>
</head>
<body class="app sidebar-mini">
	<?php include_once($_SERVER['DOCUMENT_ROOT']."/templates/header.php") ?>
	<?php include_once($_SERVER['DOCUMENT_ROOT']."/templates/side_bar.php") ?>
	<main class="app-content">
		<div class="app-title">
			<div class="div">
				<h1><i class="fa fa-book"></i> Books</h1>
			</div>
			<ul class="app-breadcrumb breadcrumb">
				<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			</ul>
		</div>
		<div class="tile mb-4">
			<div class="row mb-4">
				<form class="col">
					<div class="form-group">
						<input type="text" name="search" class="form-control" placeholder="Search book name" autocomplete="off">
					</div>
					<div class="form-group">
						<input type="submit" value="Search" class="btn btn-info">
						<?php 
							if (isset($_GET['search']) && !empty($_GET['search'])){
								echo '
									<a href="'.strtok($_SERVER["REQUEST_URI"], '?').'" class="btn btn-danger">Clear</a>
								';
							}
						 ?>
						
					</div>
				</form>
				<div class="col text-right">
					<a href="/admin/books/add" class="btn btn-primary">Add book</a>
				</div>
			</div>
			<?php 
				if (isset($_GET['search']) && !empty($_GET['search'])){
					echo '
						<div class="row mb-4">
							<div class="col-12 text-center">
								<h1>You are searching for: '.$_GET['search'].'</h1>
							</div>
						</div>
					';
				}
			 ?>

			<div class="row" id="list_books">
				<div class="col-12">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Book image</th>
								<th>Book name</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</main>
	<script type="text/javascript">
		function fetchBooks(json){
			let no = 1;
			json.data.map(function(data){
				let str = '';
				str +=	'<tr>'
				str +=		'<td>'+no+'</td>'
				str +=		'<td><img src="'+(data.image ? data.image : "http://localhost/images/no_image.png")+'" width="50px"></td>'
				str +=		'<td>'+data.name+'</td>'
				str +=		'<td>'
				str +=			'<button class="btn btn-outline-primary mx-1" onclick=\'window.location.href="/admin/books/edit?id='+data.book_id+'"\'><i class="fa fa-edit"></i></button> '
				str +=			'<button class="btn btn-outline-danger mx-1" data-action="remove" data-id="'+data.book_id+'"><i class="fa fa-trash fa-6x"></i></button>'
				str +=		'</td>'
				str +=	'</tr>'
				$('#list_books tbody').append(str);
				no++;
			});
			$(json.page).insertAfter('#list_books tbody');
			console.log(json)
		}
		fetchBooks(books)
	</script>
</body>
</html>