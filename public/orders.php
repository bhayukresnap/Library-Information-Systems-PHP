<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/src/Session.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/Controller/Order.php');
$orders = new Order();
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php require_once($_SERVER['DOCUMENT_ROOT']."/templates/vendor_library.php");?>
	<style type="text/css">
		i:hover{
			cursor: pointer;
		}
	</style>
	<script type="text/javascript">
		const orders = <?php echo $orders->display('where user_id = "'.$_SESSION['user']['id'].'" order by date desc'); ?>
	</script>
</head>
<body class="app sidebar-mini">
	<?php include_once($_SERVER['DOCUMENT_ROOT']."/templates/header.php") ?>
	<?php include_once($_SERVER['DOCUMENT_ROOT']."/templates/side_bar.php") ?>
	<main class="app-content">
		<div class="app-title">
			<div class="div">
				<h1><i class="fa fa-book"></i> Your list orders</h1>
			</div>
			<ul class="app-breadcrumb breadcrumb">
				<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			</ul>
		</div>
		<div class="tile mb-4">
			<div class="row" id="list_orders">
				<div class="col-12">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Order ID</th>
								<th>Create Date</th>
								<th>Last Update</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</main>
	<script type="text/javascript">
		function fetchOrders(json){
			let no = 1;
			json.data.map(function(order){
				let str = '';
				str +=	'<tr>'
				str +=		'<td>'+no+'</td>'
				str +=		'<td><a href="/orders/details?id='+order.id+'">'+order.id+'</a></td>'
				str +=		'<td>'+order.date+'</td>'
				str +=		'<td>'+order.last_update_by+'</td>'
				str +=		'<td>'
				switch(parseInt(order.status)){
					case 1: 
						str += "<span class='badge badge-pill badge-info'>Pending</span> ";
						str +=	'<a href="/orders/update?id='+order.id+'"><i class="fa fa-close text-danger"></i></a>';
						break;
					case 2: 
						str += "<span class='badge badge-pill badge-primary'>Approved</span> ";
						str +=	'<a href="/orders/update?id='+order.id+'"><i class="fa fa-close text-danger"></i></a>';
						break;
					case 3: 
						str += "<span class='badge badge-pill badge-danger'>Rejected</span> ";
						str +=	'<a href="/orders/update?id='+order.id+'"><i class="fa fa-close text-danger"></i></a>';
						break;
					case 4: 
						str += "<span class='badge badge-pill badge-secondary'>Canceled</span>";
						break;
				}
				str +=		'</td>'
				str +=	'</tr>'
				$('#list_orders tbody').append(str);
				no++;
			});
			$(json.page).insertAfter('#list_orders tbody');
		}
		fetchOrders(orders);
	</script>
</body>
</html>