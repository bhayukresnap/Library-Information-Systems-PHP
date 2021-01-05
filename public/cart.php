<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/src/Session.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/Controller/Shoppingcart.php');
$shoppingcart = new Shoppingcart();
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php require_once($_SERVER['DOCUMENT_ROOT']."/templates/vendor_library.php");?>
	<script type="text/javascript">
		const shopping_cart_data = <?php echo $shoppingcart->select('inner join shopping_cart_details on shopping_cart.id = shopping_cart_details.shopping_cart_id inner join books on books.id = shopping_cart_details.book_id inner join publishers on books.publisher_id = publishers.id left join types on books.book_type_id = types.id where shopping_cart.user_id = '.$_SESSION["user"]['id'], 'books.id as book_id, books.book_name as name, books.book_image as image, books.price_before, books.price_after, books.publisher_id, publishers.publisher_name, types.book_type, books.quantity, books.book_description as description, shopping_cart.id as shopping_cart_id'); ?>;
	</script>
</head>
<body class="app sidebar-mini">
	<?php include_once($_SERVER['DOCUMENT_ROOT']."/templates/header.php") ?>
	<?php include_once($_SERVER['DOCUMENT_ROOT']."/templates/side_bar.php") ?>
	<main class="app-content">
		<div>
		</div>
		<div class="row">
			<div class="col-md-12">
	          <div class="tile">
	            <h2 class="tile-title text-center">Shopping cart</h2>
	            <div class="table-responsive">
	              <table class="table table-hover" id="shopping_cart_container">
	                <thead>
	                  <tr>
	                    <th>#</th>
	                    <th>Book image</th>
	                    <th>Book name</th>
	                    <th>Price</th>
	                    <th>Action</th>
	                  </tr>
	                </thead>
	                <tbody>
	                </tbody>
	              </table>
	            </div>
	          </div>
	        </div>
		</div>
	</main>
	<script type="text/javascript">
		function fetchShoppingcart(json){
			let str = '', no = 1, total = 0;
			const target = $('#shopping_cart_container tbody');
			if(json.length > 0){
				json.map(function(data){
					str +=	'<tr>'
					str +=		'<td>'+no+'</td>'
					str +=		'<td><img src="'+data.image+'" width="100px"></td>'
					str +=		'<td>'+data.name+'</td>'
					str +=		'<td>'
					if(data.price_after != 0){
						str +=			'<s>'+currencyRp(data.price_before)+'</s><br>'
						str +=			'<div class="text-danger">'+currencyRp(data.price_after)+'</div>'
						total += parseInt(data.price_after);
					}else{
						str +=			'<div class="text-danger">'+currencyRp(data.price_before)+'</div>'
						total += parseInt(data.price_before);
					}
					str +=		'</td>'
					str +=		'<td>'
					str +=			'<a href="/book?id='+data.book_id+'"><button class="btn btn-outline-primary mx-1">View</button></a>'
					str +=			'<a href="/cart/delete_book?id='+data.book_id+'"><button class="btn btn-outline-danger mx-1">Remove</button></a>'
					str +=		'</td>'
					str +=	'</tr>'
					console.log(data)
					target.append(str)
					str = ''; no++;
				});
				str +=	'<tr>'
				str +=		'<td colspan="3" class="text-center align-middle"><b>Total</b></td>'
				str +=		'<td class="align-middle"><b>'+currencyRp(String(total))+'</b></td>'
				str +=		'<td>'
				str +=			'<a href="#"><button class="btn btn-outline-primary mx-1">Order</button></a>'
				str +=			'<a href="/cart/delete"><button class="btn btn-outline-danger mx-1">Remove all</button></a>'
				str +=		'</td>'
				str +=	'</tr>'
				target.append(str);
			}else{
				str +=	'<tr>'
				str +=		'<td colspan="5" class="text-center align-middle">No books have been added</td>'
				str +=	'</tr>'
				target.append(str);
			}
		}

		fetchShoppingcart(shopping_cart_data)

	</script>
</body>
</html>''