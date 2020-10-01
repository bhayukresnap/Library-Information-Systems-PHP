<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/src/AdminSession.php');
if(!isset($_GET['id']) && empty($_GET['id'])) exit(header("Location: /admin/books"));
require_once($_SERVER['DOCUMENT_ROOT'].'/src/Controller/Book.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/Controller/Publisher.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/Controller/Rack.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/Controller/Tag.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/Controller/Type.php');
$book = new Book();
$publisher = new Publisher();
$racks = new Rack();
$tags = new Tag();
$book_tags = new Tag();
$types = new Type();
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php require_once($_SERVER['DOCUMENT_ROOT']."/templates/vendor_library.php");?>
	<script type="text/javascript">
		const book = <?php echo $book->select("where id = $_GET[id];"); ?>[0];
		const book_tags = <?php echo $book_tags->select("inner join books_tags on tags.id = books_tags.tag_id where books_tags.book_id = $_GET[id]", "tags.id as id"); ?>;
		const racks = <?php echo $racks->select(); ?>;
		const publisher = <?php echo $publisher->select(); ?>;
		const tags = <?php echo $tags->select(); ?>;
		const types = <?php echo $types->select(); ?>;
	</script>
</head>
<body class="app sidebar-mini">
	<?php include_once($_SERVER['DOCUMENT_ROOT']."/templates/header.php") ?>
	<?php include_once($_SERVER['DOCUMENT_ROOT']."/templates/side_bar.php") ?>
	<main class="app-content">
		<div class="app-title">
			<div class="div">
				<h1><i class="fa fa-book"></i> Add Book</h1>
			</div>
			<ul class="app-breadcrumb breadcrumb">
				<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			</ul>
		</div>
		<div class="tile mb-4">
			<form class="row" method="POST" action="action/update" enctype="multipart/form-data">
				<div class="col-12 col-md-6">
					<div class="form-group text-center">
						<img id="preview_image" src="/images/no_image_2.jpg" class="img-fluid img-thumbnail mb-4">
						<input type="file" class="form-control-file" name="image" onchange="readURL(this)">
						<input type="hidden" name="current_image">
						<input type="hidden" name="book_id" value="<?php echo $_GET['id'] ?>">
					</div>
					<div class="row">
						<div class="form-group col-md-6">
							<label>Price</label>
							<input type="hidden" name="price_before">
							<input type="text" class="form-control" data-attribute="currency" data-name="price_before">
						</div>
						<div class="form-group col-md-6">
							<label>Sale price (optional)</label>
							<input type="hidden" name="price_after">
							<input type="text" class="form-control" data-attribute="currency" data-name="price_after">
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="form-group">
						<label>Book name</label>
						<input type="text" name="name" class="form-control" autocomplete="Off">
					</div>
					<div class="form-group">
						<label>Rack</label>
						<select class="form-control" id="list_racks" name="rack">
							<option disabled selected value="0">--Rack--</option>
						</select>
					</div>
					<div class="form-group">
						<label>Book quantity</label>
						<input type="number" name="quantity" class="form-control" min="0" autocomplete="Off">
					</div>
					<div class="form-group">
						<label>Book year</label>
						<input type="text" name="year" class="form-control" autocomplete="Off" data-attribute="year">
					</div>
					<div class="form-group">
						<label>Publisher</label>
						<select class="form-control" id="list_publisher" name="publisher">
							<option disabled selected value="0">--Publisher--</option>
						</select>
					</div>
					<div class="form-group">
						<label>Book type</label>
						<select class="form-control" id="list_types" name="type">
							<option disabled selected value="0">--Type--</option>
						</select>
					</div>
					<div class="form-group">
						<label>Tags</label>
						<select class="form-control" data-attribute="select" name="tags[]" id="list_tags"></select>
					</div>
				</div>
				<div class="col-12 mb-4">
					<textarea name="description" data-attribute="description"></textarea>
				</div>
				<div class="col-12">
					<input type="submit" name="submit_update" class="btn btn-primary" value="Save">
				</div>
			</form>
		</div>
	</main>
	<script type="text/javascript">
		function appendRacks(json){
			json.map(function(data){
				let str = '';
				str +=	'<option value="'+data.id+'" '+(book.rack_id == data.id ? "selected" : "")+'>'
				str +=		data.rack_name
				str +=	'</option>'
				$('#list_racks').append(str)
			});
		}
		function appendPublisher(json){
			json.map(function(data){
				let str = '';
				str +=	'<option value="'+data.id+'" '+(book.publisher_id == data.id ? "selected" : "")+'>'
				str +=		data.publisher_name
				str +=	'</option>'
				$('#list_publisher').append(str)
			});
		}		
		function appendTags(json){
			json.map(function(data){
				let str = '';
				str +=	'<option value="'+data.id+'">'
				str +=		data.tag_name
				str +=	'</option>'
				$('#list_tags').append(str)
			});
		}	
		function appendTypes(json){
			json.map(function(data){
				let str = '';
				str +=	'<option value="'+data.id+'" '+(book.book_type_id == data.id ? "selected" : "")+'>'
				str +=		data.book_type
				str +=	'</option>'
				$('#list_types').append(str)
			});
		}		
		appendRacks(racks)
		appendTags(tags)
		appendPublisher(publisher)
		appendTypes(types)

		$('input[name="name"]').val(book.book_name);
		$('input[name="quantity"]').val(book.quantity);
		$('input[name="year"]').val(book.book_year);
		$('input[data-name="price_before"]').val(book.price_before)
		$('input[name="price_before"]').val(book.price_before)
		$('input[data-name="price_after"]').val(book.price_after)
		$('input[name="price_after"]').val(book.price_after)
		$('textarea[name="description"]').attr('data-value', book.book_description)
		$('#preview_image').attr('src', book.book_image)
		$('input[name="current_image"]').val(book.book_image);
		$(document).ready(function(){
			$('#list_tags').val(book_tags.map(function(value){
				return value.id
			})).trigger('change');
		})
	</script>
</body>
</html>