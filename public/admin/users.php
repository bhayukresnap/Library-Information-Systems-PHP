<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/src/OwnerSession.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/Controller/User.php');
$users = new User;
?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php require_once($_SERVER['DOCUMENT_ROOT']."/templates/vendor_library.php");?>
	<script type="text/javascript">
		const shopping_cart_data = <?php echo $users->select('where role_id < 3 order by role_id desc'); ?>;
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
	            <h2 class="tile-title text-center">Users</h2>
	            <div class="table-responsive">
	              <table class="table table-hover" id="shopping_cart_container">
	                <thead>
	                  <tr>
	                    <th>#</th>
	                    <th>Email</th>
	                    <th>Name</th>
	                    <th>Status</th>
	                    <th>Grant</th>
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
					str +=		'<td>'+data.email+'</td>'
					str +=		'<td>'+data.name+'</td>'
					str +=		'<td>'
					switch(parseInt(data.role_id)){
						case 1: 
							str += "<span class='badge badge-pill badge-info'>User</span> ";
							break;
						case 2: 
							str += "<span class='badge badge-pill badge-primary'>Admin</span> ";
							break;
						default:
							str += "<span class='badge badge-pill badge-secondary'>No Role</span> ";
							break;
					}
					str +=		'</td>'
					str +=		'<td>'
					str +=			'<select class="select" onchange="window.location = ($(this).val())">'
					str +=				'<option disabled selected>--Change role--</option>'
					str +=				'<option value="/admin/users/update?id='+data.id+'&role_id=2">Admin</option>'
					str +=				'<option value="/admin/users/update?id='+data.id+'&role_id=1">User</option>'
					str +=				'<option value="/admin/users/update?id='+data.id+'&role_id=0">Revoke</option>'
					str +=			'</select>'
					str +=		'</td>'
					str +=	'</tr>'
					target.append(str)
					str = ''; no++;
				});
				target.append(str);
			}else{
				str +=	'<tr>'
				str +=		'<td colspan="5" class="text-center align-middle">No Users</td>'
				str +=	'</tr>'
				target.append(str);
			}
		}

		fetchShoppingcart(shopping_cart_data)

	</script>
</body>
</html>