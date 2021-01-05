<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/src/Session.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php require_once($_SERVER['DOCUMENT_ROOT']."/templates/vendor_library.php");?>
	<script type="text/javascript">
	</script>
</head>
<body class="app sidebar-mini">
	<?php include_once($_SERVER['DOCUMENT_ROOT']."/templates/header.php") ?>
	<?php include_once($_SERVER['DOCUMENT_ROOT']."/templates/side_bar.php") ?>
	<main class="app-content" id="<?php echo "book_".$_GET['id']; ?>">
		<div class="row user">
			<div class="col text-center">
				<div class="tile">
					<h1>Thanks for borrowing books from us</h1>
					<p>
						Please check your order status in order page.
					</p>
				</div>
			</div>
		</div>
	</main>
</body>
</html>