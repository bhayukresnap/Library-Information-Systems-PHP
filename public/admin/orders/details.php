<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/src/AdminSession.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/Controller/Order.php');
$order = new Order();

if(!isset($_GET['id'])){
	exit(header("Location: /admin/orders"));
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php require_once($_SERVER['DOCUMENT_ROOT']."/templates/vendor_library.php");?>
	<script type="text/javascript">
		const shopping_cart_data = <?php echo $order->select('inner join order_details on order_details.order_id = orders.id inner join books on books.id = order_details.book_id where orders.id = "'.$_GET['id'].'"', 'books.id as book_id, books.book_name as name, books.book_image as image, books.price_before, books.price_after, books.publisher_id, books.quantity, books.book_description as description, orders.id as order_id'); ?>;
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
	            <h2 class="tile-title text-center">Order - <?php echo $_GET['id']; ?></h2>
	            <div class="table-responsive">
	              <table class="table table-hover" id="shopping_cart_container">
	                <thead>
	                  <tr>
	                    <th>#</th>
	                    <th>Book image</th>
	                    <th>Book name</th>
	                    <th>Price</th>
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
					str +=	'</tr>'
					console.log(data)
					target.append(str)
					str = ''; no++;
				});
				str +=	'<tr>'
				str +=		'<td colspan="3" class="text-center align-middle"><b>Total</b></td>'
				str +=		'<td class="align-middle"><b>'+currencyRp(String(total))+'</b></td>'
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
</html>