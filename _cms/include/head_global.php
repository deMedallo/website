<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="favicon.ico">

<title>deMedallo.com | Videos, Desacargas y mas!!</title>

<!-- Bootstrap core CSS -->
<link href="dist/bootstrap/4.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="assets/carousel.css" rel="stylesheet">
<!--<link href="assets/style.css" rel="stylesheet">-->
<!-- Vue core JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<!-- Vue Axios JavaScript -->
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://vjs.zencdn.net/7.1.0/video-js.css" rel="stylesheet">
<!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
<!-- <script src="https://vjs.zencdn.net/ie8/ie8-version/videojs-ie8.min.js"></script> -->

  
<script type="text/javascript">
function validateYouTubeUrl(url){
	if (url != undefined || url != '') {
		var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
		var match = url.match(regExp);
		if (match && match[2].length == 11) {
			// Do anything for being valid
			// if need to change the url to embed url then use below line
			return match[2];
		}
		else { return null; }
	}
}

window.onload = function() {
	var myVar = setInterval(myTimer, 1000);

	function myTimer() {
		var anchors = document.getElementsByTagName("a");
		for (var i = 0; i < anchors.length; i++) {
			var n = validateYouTubeUrl(anchors[i].href);
			if(n != null){
				//anchors[i].href = "getvideo.php?videoid=" + n + "type=Download";
				
				url = "getvideo.dm?videoid=" + n + "&type=Download<?php if(isset($_GET['q'])){ echo "&q={$_GET['q']}"; }; ?>";
				anchors[i].setAttribute("href", url);
				anchors[i].removeAttribute("data-cturl");
				anchors[i].removeAttribute("target");
			}
		}
		
		<?php if(checkSession() == true){ ?>
			if (typeof player != 'undefined'){
				
				var dmplayer = player.getState();
				if(dmplayer == 'playing'){
					axios.get('api/points', {
						params: {
							token: "<?php echo $_SESSION['token']; ?>"
						}
					})
					.then(function (response) {
						// console.log(response);
						if(response.data.error == false){
							jQuery(".wallet-DM-balance").html(response.data.data);
						}
					})
					.catch(function (error) { console.log(error); });
				}
			}
		<?php } ?>
	}

	function myStopFunction() {
		clearInterval(myVar);
	}
}



</script>