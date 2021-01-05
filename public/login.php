<?php 
	session_start();
	if(isset($_SESSION['user'])) exit(header("Location: /"));
 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php require_once($_SERVER['DOCUMENT_ROOT']."/templates/vendor_library.php");?>
</head>
<body>
	<section class="material-half-bg">
		<div class="cover"></div>
	</section>
	<section class="login-content">
		<div class="logo">
			<h1>Vali - Library</h1>
		</div>
		<div class="login-box">
			<form class="login-form" method="POST" action="/validation/login">
				<h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>SIGN IN</h3>
				<div class="form-group">
					<label class="control-label">USERNAME</label>
					<input class="form-control" type="text" placeholder="Username" autofocus autocomplete="off" name="email">
				</div>
				<div class="form-group">
					<label class="control-label">PASSWORD</label>
					<input class="form-control" type="password" placeholder="Password" autocomplete="off" name="password">
				</div>
				<div class="form-group btn-container">
					<button class="btn btn-primary btn-block" name="submit_login"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
				</div>
				<p class="semibold-text mb-2"><a href="#" data-toggle="flip">Forgot Password ?</a></p>
			</form>
			<form class="forget-form">
				<h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Forgot Password ?</h3>
				<div class="form-group">
					<label class="control-label">EMAIL</label>
					<input class="form-control" type="text" placeholder="Email">
				</div>
				<div class="form-group btn-container">
					<button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
				</div>
				<div class="form-group mt-3">
					<p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Back to Login</a></p>
				</div>
			</form>
		</div>
	</section>
	<script type="text/javascript" src="/js/custom.js"></script>
	<script type="text/javascript">
		$('.login-content [data-toggle="flip"]').click(function() {
			$('.login-box').toggleClass('flipped');
			return false;
		});
	</script>
	<?php require_once($_SERVER['DOCUMENT_ROOT']."/templates/notification.php"); ?>
</body>
</html>