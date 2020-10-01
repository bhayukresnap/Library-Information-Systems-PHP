<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/src/AdminSession.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/src/Controller/Rack.php');
$rack = new Rack();
if(isset($_GET['add_rack']) && !empty($_GET['add_rack'])) $rack->insert($_GET['add_rack']);
elseif (isset($_GET['update_rack']) && !empty($_GET['update_rack'])) $rack->update($_GET);
elseif (isset($_GET['delete']) && !empty($_GET['delete'])) $rack->delete($_GET['delete']);
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php require_once($_SERVER['DOCUMENT_ROOT']."/templates/vendor_library.php");?>
	<script type="text/javascript">
		const racks = <?php echo $rack->select("ORDER BY rack_name asc"); ?>
	</script>
</head>
<body class="app sidebar-mini">
	<?php include_once($_SERVER['DOCUMENT_ROOT']."/templates/header.php") ?>
	<?php include_once($_SERVER['DOCUMENT_ROOT']."/templates/side_bar.php") ?>
	<main class="app-content">
		<div class="app-title">
			<div class="div">
				<h1><i class="fa fa-tag"></i> Racks</h1>
			</div>
			<ul class="app-breadcrumb breadcrumb">
				<li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
			</ul>
		</div>
		<div class="tile mb-4">
			<div class="row">
				<form class="col-md-4">
					<div class="form-group">
						<label>Add Rack</label>
						<input type="text" name="add_rack" class="form-control" autocomplete="off">
					</div>
					<div class="form-group">
						<input type="submit" name="" value="Submit" class="btn btn-primary">
					</div>
				</form>
				<div class="col">
					<table class="table table-hover" id="list_tags">
						<thead>
							<tr>
								<th>No.</th>
								<th>Rack</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</main>
	<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal">
		<div class="modal-dialog modal-md">
			<form class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modal_title"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Rack name:</label>
						<input type="hidden" name="id">
						<input type="text" class="form-control" name="update_rack" autocomplete="off">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Update</button>
				</div>
			</form>
		</div>
	</div>
	<script type="text/javascript">
		fetchTag(racks);
		function fetchTag(json){
			let str = '';
			$(json).each(function(index, item){
				index++;
				str +=	'<tr>'
				str +=		'<td>'+index+'</td>'
				str +=		'<td>'+item.rack_name+'</td>'
				str +=		'<td>'
				str +=			'<button class="btn btn-outline-primary mx-1" onclick=\'updateModal('+item.id+', "'+item.rack_name+'")\'><i class="fa fa-edit"></i></button> '
				str +=			'<button class="btn btn-outline-danger mx-1" data-action="remove" data-id="'+item.id+'"><i class="fa fa-trash fa-6x"></i></button>'
				str +=		'</td>'
				str +=	'</tr>'
			});
			$('#list_tags').append(str)
		}
		function updateModal(id, tag_name){
			$('#modal').modal("show");
			$('#modal #modal_title').text(tag_name)
			$('#modal input[name="id"]').val(id)
			$('#modal input[name="update_rack"]').val(tag_name)
		}
	</script>
</body>
</html>