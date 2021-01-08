<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/src/AdminSession.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/Controller/Order.php');
$orders = new Order();
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php require_once($_SERVER['DOCUMENT_ROOT']."/templates/vendor_library.php");?>
	<style type="text/css">
		.select::after {
		  content: "";
		  width: 0.8em;
		  height: 0.5em;
		  background-color: var(--select-arrow);
		  clip-path: polygon(100% 0%, 0 0%, 50% 100%);
		}
	</style>
	<script type="text/javascript">
		const orders = <?php echo $orders->display("order by status ASC"); ?>
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
								<th>Date</th>
								<th>Last update</th>
								<th>Status</th>
								<th>Action</th>
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
				str +=		'<td>'+order.id+'</td>'
				str +=		'<td>'+order.date+'</td>'
				str +=		'<td>'+order.last_update_by+'</td>'
				str +=		'<td>'
				switch(parseInt(order.status)){
					case 1: 
						str += "<span class='badge badge-pill badge-info'>Pending</span>";
						break;
					case 2: 
						str += "<span class='badge badge-pill badge-primary'>Approved</span>";
						break;
					case 3: 
						str += "<span class='badge badge-pill badge-danger'>Rejected</span>";
						break;
					case 4: 
						str += "<span class='badge badge-pill badge-secondary'>Canceled</span>";
						break;
				}
				str +=		'</td>'
				str +=		'<td>'
				switch(parseInt(order.status)){
					case 4: break;
					default:
					str +=			'<select class="select" onchange="window.location = ($(this).val())">'
					str +=				'<option disabled selected value="/orders/update?id='+order.id+'&status=1">--Change status--</option>'
					str +=				'<option value="/admin/orders/update?id='+order.id+'&status=2">Approved</option>'
					str +=				'<option value="/admin/orders/update?id='+order.id+'&status=3">Rejected</option>'
					str +=			'</select>'
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