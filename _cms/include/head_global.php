
<title>deMedallo.com | Videos, Desacargas y mas!!</title>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


<link href="https://vjs.zencdn.net/7.1.0/video-js.css" rel="stylesheet">
<!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
<script src="https://vjs.zencdn.net/ie8/ie8-version/videojs-ie8.min.js"></script>
  
  
  
  

<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfont-->
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<script src="js/jquery.easydropdown.js"></script>
<!--Animation-->
<script src="js/wow.min.js"></script>
<link href="css/animate.css" rel='stylesheet' type='text/css' />

    <!-- Vue core JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <!-- Vue Axios JavaScript -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	
<script>
	new WOW().init();
</script>

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
		else {
			return null;
		}
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
		<?php } ?>
	}

	function myStopFunction() {
		clearInterval(myVar);
	}
}



</script>