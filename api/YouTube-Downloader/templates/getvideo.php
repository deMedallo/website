<?php
$total_videos = 0;
foreach($this->get('formats', []) as $format) {
	if($format['size'] !== '0B'){
		$total_videos = $total_videos + 1;
	}
}

$total_audios = 0;
foreach($this->get('formats', []) as $format) {
	if($format['size'] !== '0B'){
		$total_audios = $total_audios + 1;
	}
}
?>
<div class="container marketing">
	<hr class="featurette-divider">

	<?php if ($this->get('no_stream_map_found', false) === true) { ?>
		<div class="row featurette">
		  <div class="col-md-12">
			<h2 class="featurette-heading">No se encontró flujo de formato codificado.. <span class="text-muted">Esto es lo que obtuvimos:</span></h2>
			<p class="lead"><pre><?php echo $this->get('no_stream_map_found_dump'); ?></pre></p>
		  </div>
		</div>
		<hr class="featurette-divider">
	<?php } else { ?>
		<?php if ($this->get('show_debug1', false) === true) { ?>
			<ul class="feature">
			   <li> <i class="icon-trophy"></i></li>
				<li class="feature_right"><h4>show_debug1</h4>
				<p><pre><?php echo $this->get('debug1'); ?></pre></p>
				</li>
				<div class="clearfix"></div>
			</ul>
		<?php } ?>
		<?php if ($this->get('show_debug2', false) === true) { ?>
			<ul class="feature">
			   <li> <i class="icon-trophy"></i></li>
				<li class="feature_right"><h4>debug2_expires</h4>
					<p>Estos enlaces caducarán en<?php echo $this->get('debug2_expires'); ?></p>
					<p>El servidor estaba en la dirección IP<?php echo $this->get('debug2_ip'); ?> que es un <?php echo $this->get('debug2ipbits'); ?>poco dirección IP. Tenga en cuenta que cuando se utilizan direcciones IP de 8 bits, los enlaces de descarga pueden fallar.</p>
				</li>
				<div class="clearfix"></div>
			</ul>
		<?php } ?>

		<div class="row featurette">
		  <div class="col-md-7">
			<h2 class="featurette-heading"><?php echo $this->get('video_title'); ?> <span class="text-muted">[<?php echo $_GET['videoid']; ?>]</span></h2>
			<p class="lead">otro video compartido gracias a YouTube</p>
		  </div>
		  <div class="col-md-5">
			<?php if ($this->get('show_thumbnail') === true) { ?>
				<img class="featurette-image img-fluid mx-auto" width="500" data-src="https://i.ytimg.com/vi/<?php echo $_GET['videoid']; ?>/hqdefault.jpg" src="https://i.ytimg.com/vi/<?php echo $_GET['videoid']; ?>/hqdefault.jpg" alt="Generic placeholder image">
			<?php } ?>
		  </div>
		</div>
		
		<hr class="featurette-divider">


		<div class="row">	
			<div class="col-md-3">
				<?php 
					foreach($this->get('streams', []) as $format) {
						if($format['size'] !== '0B'){ 
					?>
					<ul class="feature last_grid">
						<li> <i class="icon-video"></i></li>
						<li class="feature_right">
							<h4>
								<?php 
									$t = (string) $format['type'];
									$t = substr($format['type'], -4, 5);
									echo $t;
								?>
								<a class="btn btn-default btn-type disabled" href="#"><?php echo $format['quality']; ?></a>
								<div class="label label-warning"><?php echo $format['size']; ?></div>
							</h4>								
							<p>
								<?php if ($format['show_direct_url'] === true) { ?>
									<a class="btn btn-sm btn-default btn-download" href="<?php echo $format['direct_url']; ?>" class="mime"> Direct</a>
								<?php } ?>
								<?php if ($format['show_proxy_url'] === true) { ?>
									<a class="btn btn-sm btn-primary btn-download" href="api/YouTube-Downloader/<?php echo $format['proxy_url']; ?>" class="mime"> Proxy</a>
								<?php } ?>
							</p>
						</li>
						<hr>
						<div class="clearfix"></div>
					</ul>
					
					<?php 
							} 
						} 
					?>
		  
				
				<?php if ($this->get('showMP3Download', false) === true) { ?>
					<h2>Convert and Download to .mp3</h2>
					<ul class="dl-list">
						<li>
							<a class="btn btn-default btn-type disabled" href="#" class="mime">audio/mp3 - <?php echo $this->get('mp3_download_quality'); ?></a>
							<a class="btn btn-primary btn-download" href="api/YouTube-Downloader/<?php echo $this->get('mp3_download_url'); ?>" class="mime"><i class="glyphicon glyphicon-download-alt"></i> Convert and Download</a>
						</li>
					</ul>
				<?php } ?>
			  
			</div>
			<div class="col-md-9">
				<?php if($total_videos == 0 && isset($_GET['videoid'])){ ?>
					<?php if(checkSession() == true){
						$demo = UserForId($_SESSION['id']);
						?>
						<!--
						<h3>Contenido sin Puntos!</h3>
						<div class="row">
							<div class="col-md-12">
								<p>Ahora con deMedallo adquiere Puntos DM <b>GRATIS</b> por cada <b>Segundo</b> visto, actualmente tienes <?php echo $demo->wallets->DM->balance; ?>.</p>
								<p>Lo sentimos este contenido no esta habilitado para obtener puntos, pronto será configurado.</p>
							</div>
						</div>
						<hr>-->
						<h3>Contenido con Puntos!</h3>
						<div class="row">
							<div class="col-md-12">
								<p>Ahora con deMedallo adquiere Puntos DM <b>GRATIS</b> por cada <b>Segundo</b> visto, actualmente tienes <?php echo $demo->wallets->DM->balance; ?>.</p>
								<p>Actualizando puntos: <span class="wallet-DM-balance"><?php echo $demo->wallets->DM->balance; ?></span></p>
							</div>
						</div>
					
					<?php } ?>
					
					<div id="player"></div>
					<script>
					  var tag = document.createElement('script');

					  tag.src = "https://www.youtube.com/iframe_api";
					  var firstScriptTag = document.getElementsByTagName('script')[0];
					  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
					  
					  var playerYT;
					  function onYouTubeIframeAPIReady() {
						playerYT = new YT.Player('player', {
						  height: '480',
						  width: '100%',
						  videoId: '<?php echo $_GET['videoid']; ?>',
						  events: {
							'onReady': onPlayerReady,
							'onStateChange': onPlayerStateChange
						  }
						});
					  }
					  
					  function onPlayerReady(event) {
						event.target.playVideo();
					  }
					  
					  var done = false;
					  function onPlayerStateChange(event) {
						  var myVarDos = setInterval(myTimerDos, 1000);
						  
						  function myTimerDos(){
							if (playerYT.getPlayerState() == 1) {
								//console.log('OK');
								//setTimeout(stopVideo, 6000);
								//done = true;
							  
								axios.get('api/points', { params: { token: "<?php echo $_SESSION['token']; ?>" }})
								.then(function (response) {
									//console.log(response);
									if(response.data.error == false){ jQuery(".wallet-DM-balance").html(response.data.data); }
								})
								.catch(function (error) { console.log(error); });
							}
						  }
	
					  }
					  function stopVideo() {
						playerYT.stopVideo();
					  }
					</script>
				<?php }else{ ?>
					<?php if(checkSession() == true){
						$demo = UserForId($_SESSION['id']);
						?>
						<h3>Contenido con Puntos!</h3>
						<div class="row">
							<div class="col-md-12">
								<p>Ahora con deMedallo adquiere Puntos DM <b>GRATIS</b> por cada <b>Segundo</b> visto, actualmente tienes <?php echo $demo->wallets->DM->balance; ?>.</p>
								<p>Actualizando puntos: <span class="wallet-DM-balance"><?php echo $demo->wallets->DM->balance; ?></span></p>
							</div>
						</div>
					<?php } ?>
					<?php 
						$videos = array();
						foreach($this->get('streams', []) as $format) {
							if($format['size'] !== '0B'){
								if ($format['show_direct_url'] === true) {
									$item = new stdClass();
									$item->label = $format['quality'].' - YouTube';
									$item->type = $format['type'];
									$item->file = $format['direct_url'];
									$videos[] = $item;
								}
								
								if ($format['show_proxy_url'] === true) {
									$item = new stdClass();
									$item->label = $format['quality'].' - deMedallo';
									$item->type = $format['type'];
									$item->file = 'api/YouTube-Downloader/'.$format['proxy_url'];
									$videos[] = $item;
								}
							}
						} 
						$videos = array_reverse($videos);
					?>
					
						<script src="//content.jwplatform.com/libraries/IDzF9Zmk.js"></script>
						<div id="player"></div>
						<script type="text/javascript">
							var player = jwplayer('player');

							player.setup({
							  playlist: {
								  "feed_instance_id": "c9912caf-321f-4811-b3e9-9932918d965d",
								  "title": "<?php echo $this->get('video_title'); ?>",
								  "kind": "Single Item",
								  "playlist": [
									{
									  "mediaid": "8L4m9FJB",
									  "description": "un video mas compartido por Youtube.",
									  "pubdate": 1495054284,
									  "tags": "Youtube video demedallo",
									  "image": "api/YouTube-Downloader/<?php echo $this->get('thumbnail_src'); ?>",
									  "title": "<?php echo $this->get('video_title'); ?>",
									  "variations": {
										
									  },
									  "sources": <?php echo json_encode($videos); ?>,
									  "tracks": [
										//{
										//  "kind": "thumbnails",
										//  file: "//www.youtube.com/watch?v=8CjdLYBDUqw",
										//}
									  ],
									  "link": "#"
									}
								  ],
								  "description": "un video mas con deMedallo.com."
								},
								"volume": 100,
								"mute": false
							});
							player.addButton(
							  "//icons.jwplayer.com/icons/white/download.svg",
							  "Adquirir Video",
							  function() {
								window.location.href = player.getPlaylistItem()['file'];
							  },
							  "download"
							);
						</script>
				<?php } ?>
			</div>
		</div>
		<hr class="featurette-divider">
		<div class="row">
			<?php 
				$total = 0;
				foreach($this->get('formats', []) as $format) { 
					if($format['size'] !== '0B'){
						$total = $total + 1;
				?>
				<div class="col-lg-2">
					<img class="rounded-circle" src="api/YouTube-Downloader/<?php echo $this->get('thumbnail_src'); ?>" alt="" width="140" height="140">
					<h2>
					<?php 
						$t = (string) $format['type'];
						$t = substr($format['type'], -4, 5);
						echo $t;
					?> - <?php echo $format['quality']; ?></h2>
					<p><?php echo $format['size']; ?></p>
					<p>
						<?php if ($format['show_direct_url'] === true) { ?>
							<a class="btn btn-sm btn-default btn-download" href="<?php echo $format['direct_url']; ?>" class="mime"> Direct</a>
						<?php } ?>
						<?php if ($format['show_proxy_url'] === true) { ?>
							<a class="btn btn-sm btn-primary btn-download" href="api/YouTube-Downloader/<?php echo $format['proxy_url']; ?>" class="mime"> Proxy</a>
						<?php } ?>
					</p>
				</div>
				<?php } ?>
			<?php } ?>
		  
		</div>
		<div>
			<script>
			  (function() {
				var cx = '007894479317154908154:jwktchapsu0';
				var gcse = document.createElement('script');
				gcse.type = 'text/javascript';
				gcse.async = true;
				gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(gcse, s);
			  })();
			</script>
			<gcse:searchbox-only resultsUrl="search.dm"></gcse:searchbox-only>
			<gcse:searchresults-only></gcse:searchresults-only>
		</div>
	<?php } ?>
</div>