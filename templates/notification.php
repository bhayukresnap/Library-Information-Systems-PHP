 <script type="text/javascript">
 	$(document).ready(function(){
 		const errors = <?php
			if(isset($_SESSION['notification'])){
				echo $_SESSION['notification'];
				unset($_SESSION['notification']);
			}else print("false");
	 	 ?>;
 		if(errors) notify(errors)
 	});
 </script>