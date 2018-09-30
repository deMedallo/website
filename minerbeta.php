
 <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>Terminal Runing |
            CPU Win        </title>
<meta name="theme-color" content="#313440" />
<meta name="apple-mobile-web-app-status-bar-style" content="#313440" />
<meta name="csrf" content="43aea9d09fc2b9d3581cef5fbb81f021">
<link rel="icon" type="image/x-icon" href="https://www.cpuwin.com/nem-mining/assets/images/terminal.png">
<link rel="stylesheet" href="https://www.cpuwin.com/nem-mining/assets/css/bootstrap.min.css?088662008242">
<link rel="stylesheet" href="https://www.cpuwin.com/nem-mining/assets/css/sweetalert.min.css?088662008242">
<link rel="stylesheet" href="https://www.cpuwin.com/nem-mining/assets/css/shards.min.css?088662008242">
<link rel="stylesheet" href="https://www.cpuwin.com/nem-mining/assets/css/style.css?088662008242">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=PT+Mono" rel="stylesheet">
<script src="https://www.cpuwin.com/nem-mining/assets/js/ads.js"></script>
<script src="https://www.cpuwin.com/nem-mining/../currency_data.js?5ba975462e5e7"></script>
<script>
            var currency_round = true;
            var currency_decimalSeparator = '.';
            var currency_thousandsSeparator = ',';
            var currency_thousandsSeparatorMin = 3;
        </script>
</head>
<body class="noselect">
<style type="text/css">
            body {
                background: #313440;
                color: #bdc3c7;
                font-family: monospace;
                font-size: 15px;
            }
            
            .terminal-content {
                padding: 10px;
            }
            
            .terminal-content ul {
                list-style: none;
            }
            
            .terminal-content ul li {
                list-style: none;
            }
            
            .try {
                animation-iteration-count: infinite;
            }
            
            .loading {
                z-index: 100;
                position: fixed;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background: #313440;
            }
            
            .flags {
                display: block;
                margin: 0 auto 20px;
                width: 50px;
                background: #bdc3c7;
                padding: 2px;
                border-radius: 2px;
            }
            
            .load {
                margin: 0 auto;
                width: 290px;
                margin-top: 150px;
                min-height: 95px;
                display: block;
                margin-bottom: 20px;
            }
            
            .progress-bar {
                box-shadow: 0px 3px 5px 0px #0000002b;
                background: transparent;
                border: 2px solid #bdc3c7;
                width: 275px;
                padding: 6px 1px;
                position: relative;
                border-radius: 10px;
            }
            
            .progress-status {
                background: #bdc3c7;
                color: #000;
                text-align: center;
                height: 100%;
                padding: 5px 0;
                border-radius: 10px;
            }
            
            .isp {
                text-align: center;
                font-size: 19px;
                position: relative;
                top: 10px;
                text-shadow: 0px 1px 1px #00000054;
                margin-bottom: 20px;
            }
            
            #logs {
                padding: 5px;
                margin: 0;
            }
            
            #logs li span {
                font-size: 20px;
            }
            
            #logs li span .material-icons {
                position: relative;
                top: 5px;
            }
            
            #settings,
            #save {
                font-size: 30px !important;
            }
            
            #amount {
				font-family: 'PT Mono', monospace;
                font-size: 22px;
            }
            
            .currencytext {
                background: #bdc3c7;
                color: #313440;
                font-weight: 700;
                margin-right: 10px;
                padding: 0 0px 0px 10px;
				font-size: 22px;
            }
            
            .footer {
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                z-index: 3;
                background: #313440;
                padding-bottom: 20px;
            }
            
            .footer ul {
                list-style-type: none;
                list-style: none;
            }
            
            .footer ul {
                padding: 0 15px;
            }
            
            .footer li {
                float: left;
            }
            
            .footer li:not(:first-child) {
                margin-left: 20px;
            }
            
            .noselect {
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }
            
            .error {
                position: fixed;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                z-index: 1000;
                text-align: center;
                background: #a80000;
                padding-top: 65px;
                font-size: 18px;
                font-weight: bold;
                text-shadow: 0 2px 5px #450000;
                box-shadow: inset 0 0 20px 0px #5e0000;
                color: #ffffff !important;
            }
            
            .error i {
                font-size: 85px;
            }
            
            @media screen and (min-width: 1350px) {
                .container {
                    width: 100%;
                }
            }
            
            @media screen and (max-width: 480px) {
                #logs li span {
                    font-size: 15px;
                }
            }
            
            @media screen and (max-width: 350px) {
                #logs li span {
                    font-size: 13px;
                }
            }
            
            .controllerSystem {
                background: #db1011;
                position: fixed;
                width: 100%;
                height: 100%;
                z-index: 1000000000;
                box-shadow: inset 0 0 25px 10px #be0505;
            }
            
            .controllerSystem div {
                padding: 20px;
                position: relative;
                margin: auto;
                margin-top: 75px;
            }
            
            .controllerSystem img {
                width: 150px;
            }
            
            .controllerSystem p {
                font-family: Arial;
                font-size: 35px;
                color: #f4f0f0;
                text-shadow: 1px 1px 4px #6c0000;
                margin-top: 15px;
                font-weight: bold;
                letter-spacing: 0.3px;
            }
            
            .none-flag {
                width: 75px !important;
                animation: none !important;
                background: initial !important;
            }
            
            #_controlRay {
                display: none;
                background-image: url('https://www.cpuwin.com/nem-mining/assets/images/ray.png');
                background-repeat: no-repeat;
                bottom: 0px;
                width: 740px;
                position: fixed;
                height: 136px;
                z-index: 5;
                overflow: hidden;
                padding: 10px 8px 25px 6px;
            }
            
            #_controlRayClose {
                transition: all 1s linear;
                z-index: 10000;
                position: absolute;
                top: 40px;
                left: 370px;
                border-radius: 15px;
                padding: 0px 3px;
                line-height: 1em;
                color: red;
                background: white;
                box-shadow: #ffffff 0px 0px 10px;
                cursor: pointer;
            }
            
            #_controlRayClose i {
                font-size: 18px;
                font-weight: bold;
                line-height: 1.3em;
            }
            
            .setting-box {
                display: none;
                width: 320px;
                background-color: #1e1e1e !important;
                color: #ffffff !important;
                border: 4px solid #ffffff;
                position: fixed;
                box-shadow: 0 0 0 0, 0 0px 20px rgba(0, 0, 0, 0.44);
                left: 50%;
                padding: 15px;
                top: 50%;
                margin-left: -160px;
                margin-top: -100px;
                z-index: 1;
            }
            
            .setting-box table {
                width: 100%;
                line-height: 2.5em;
            }
            
            .setting-box table tr td:nth-child(odd) {
                font-size: 19px;
                font-weight: bold;
            }
            
            .setting-box i {
                cursor: pointer;
                display: table-cell;
                vertical-align: middle;
                text-align: center;
                font-size: 24px;
            }
            
            .setting-box select {
                background: #ffffff !important;
                outline: none;
                width: 100%;
                border: 1px solid #0e0e0e;
            }
            
            .setting-box .confirm {
				cursor:pointer;
                color: #fff!important;
                background-color: #0e0e0e !important;
                width: 100%;
                font-weight: bold;
                margin-top: 15px;
                padding: 5px 0;
                outline: none;
                border: 1px solid #000!important;
            }
            
            .setting-box .confirm:hover {
                opacity: 0.7;
            }
            
            .time_ajax {
                padding: 4px 7px;
                border: 1px solid #bdc3c7;
                background: #313440;
                border-radius: 20px;
                line-height: 2em;
                width: 40px;
                text-align: center;
            }
            
            #terminal_time {
                display: none;
            }
            
            .buy-box {
                display: none;
                position: absolute;
                left: 0;
                top: 0;
                background: #1e1e1e;
                width: 100%;
                height: 100%;
                z-index: 5;
                text-align: center;
                padding: 15px;
            }
            
            .buy-btn {
                color: #001701;
                text-shadow: 1px 1px 1px #56ff00;
                font-weight: bold;
                cursor: pointer;
                box-shadow: inset 0px 0px 3px 2px #00c208;
                padding: 2px 4px;
                border: 1px solid #00ff0f;
                background: #21df00;
                font-family: Arial;
            }
        </style>
<div class="terminal-content">
<div class="loading">
<span class="pull-right" style=" padding: 5px 10px; opacity: 0.8; ">
<small>v7.1</small>
</span>
<div class="load">
<center>
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="lds-gears" width="100px" height="100px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" style="background: none;">
<g transform="translate(50 50)">
<g transform="translate(-19 -19) scale(0.6)">
<g transform="rotate(5.80032)">
<animateTransform attributeName="transform" type="rotate" values="0;360" keyTimes="0;1" dur="1s" begin="0s" repeatCount="indefinite" />
<path d="M37.3496987939662 -7 L47.3496987939662 -7 L47.3496987939662 7 L37.3496987939662 7 A38 38 0 0 1 31.359972760794346 21.46047782418268 L31.359972760794346 21.46047782418268 L38.431040572659825 28.531545636048154 L28.531545636048154 38.431040572659825 L21.46047782418268 31.359972760794346 A38 38 0 0 1 7.0000000000000036 37.3496987939662 L7.0000000000000036 37.3496987939662 L7.000000000000004 47.3496987939662 L-6.999999999999999 47.3496987939662 L-7 37.3496987939662 A38 38 0 0 1 -21.46047782418268 31.35997276079435 L-21.46047782418268 31.35997276079435 L-28.531545636048154 38.431040572659825 L-38.43104057265982 28.531545636048158 L-31.359972760794346 21.460477824182682 A38 38 0 0 1 -37.3496987939662 7.000000000000007 L-37.3496987939662 7.000000000000007 L-47.3496987939662 7.000000000000008 L-47.3496987939662 -6.9999999999999964 L-37.3496987939662 -6.999999999999997 A38 38 0 0 1 -31.35997276079435 -21.460477824182675 L-31.35997276079435 -21.460477824182675 L-38.431040572659825 -28.531545636048147 L-28.53154563604818 -38.4310405726598 L-21.4604778241827 -31.35997276079433 A38 38 0 0 1 -6.999999999999992 -37.3496987939662 L-6.999999999999992 -37.3496987939662 L-6.999999999999994 -47.3496987939662 L6.999999999999977 -47.3496987939662 L6.999999999999979 -37.3496987939662 A38 38 0 0 1 21.460477824182686 -31.359972760794342 L21.460477824182686 -31.359972760794342 L28.531545636048158 -38.43104057265982 L38.4310405726598 -28.53154563604818 L31.35997276079433 -21.4604778241827 A38 38 0 0 1 37.3496987939662 -6.999999999999995 M0 -23A23 23 0 1 0 0 23 A23 23 0 1 0 0 -23" fill="#bdc3c7" />
</g>
</g>
<g transform="translate(19 19) scale(0.6)">
<g transform="rotate(331.7)">
<animateTransform attributeName="transform" type="rotate" values="360;0" keyTimes="0;1" dur="1s" begin="-0.0625s" repeatCount="indefinite" />
<path d="M37.3496987939662 -7 L47.3496987939662 -7 L47.3496987939662 7 L37.3496987939662 7 A38 38 0 0 1 31.359972760794346 21.46047782418268 L31.359972760794346 21.46047782418268 L38.431040572659825 28.531545636048154 L28.531545636048154 38.431040572659825 L21.46047782418268 31.359972760794346 A38 38 0 0 1 7.0000000000000036 37.3496987939662 L7.0000000000000036 37.3496987939662 L7.000000000000004 47.3496987939662 L-6.999999999999999 47.3496987939662 L-7 37.3496987939662 A38 38 0 0 1 -21.46047782418268 31.35997276079435 L-21.46047782418268 31.35997276079435 L-28.531545636048154 38.431040572659825 L-38.43104057265982 28.531545636048158 L-31.359972760794346 21.460477824182682 A38 38 0 0 1 -37.3496987939662 7.000000000000007 L-37.3496987939662 7.000000000000007 L-47.3496987939662 7.000000000000008 L-47.3496987939662 -6.9999999999999964 L-37.3496987939662 -6.999999999999997 A38 38 0 0 1 -31.35997276079435 -21.460477824182675 L-31.35997276079435 -21.460477824182675 L-38.431040572659825 -28.531545636048147 L-28.53154563604818 -38.4310405726598 L-21.4604778241827 -31.35997276079433 A38 38 0 0 1 -6.999999999999992 -37.3496987939662 L-6.999999999999992 -37.3496987939662 L-6.999999999999994 -47.3496987939662 L6.999999999999977 -47.3496987939662 L6.999999999999979 -37.3496987939662 A38 38 0 0 1 21.460477824182686 -31.359972760794342 L21.460477824182686 -31.359972760794342 L28.531545636048158 -38.43104057265982 L38.4310405726598 -28.53154563604818 L31.35997276079433 -21.4604778241827 A38 38 0 0 1 37.3496987939662 -6.999999999999995 M0 -23A23 23 0 1 0 0 23 A23 23 0 1 0 0 -23" fill="#bdc3c7" />
</g>
</g>
</g>
</svg>
</center>
<div class="progress-bar">
<div class="progress-status flash animated try" id="loading" style="width: 0%;"></div>
</div>
<div class="isp">
Terminal Loading... </div>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-7507206664135683" data-ad-slot="9209957992" data-ad-format="link">
</ins>
<script>
					(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
</div>
</div>
<ul id="logs"></ul>
<div class="setting-box" id="setting">
<div class="buy-box">
<form action="" method="post">
<p>Are you sure you want to purchase the automatic registration feature in exchange for
<b>
0.003 XEM </b>?</p>
<br />
<input type="hidden" value="1" name="form" />
<p onclick="$('.buy-box').fadeToggle('fast')">
<font color="red">Your account does not have enough
XEM.</font>
</p>
</form>
</div>
<form action="" method="post">
<table>
<tbody>
<tr>
<td>SOUND</td>
<td>
<i onclick="_TerminalSound();" class="material-icons" id="mute">volume_up</i>
</td>
</tr>
<tr>
<td>AUTO SAVE</td>
<td>
<span class="buy-btn" onclick="$('.buy-box').fadeToggle('fast')">Buy Now</span>
</td>
</tr>
<tr>
<td>THEME</td>
<td>
<select name="terminaltheme">
<option value="1">Blue + White</option>
<option value="2">Black + Green</option>
<option value="3">Black + White</option>
<option value="4" selected>Fume + Grey</option>
</select>
</td>
</tr>
</tbody>
</table>
<input type="hidden" value="2" name="form" />
<button class="confirm" type="submit" name="save">Confirm</button>
</form>
</div>
<div id="_controlRay">
<div id="_controlRayClose" onclick="$('#_controlRay').slideUp('slow')">
<i class="material-icons">&#xE5CD;</i>
</div>
<center>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle" style="display:inline-block;width:728px;height:90px" data-ad-client="ca-pub-7507206664135683" data-ad-slot="1198082023"></ins>
<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
</center>
</div>
</div>
<div class="footer">
<ul>
<li data-toggle="tooltip" title="Amount Produced" data-placement="top">
<span class="currencytext">
XEM </span>
<span id="amount">
0.00000000 </span>
</li>
<li onclick="$('#setting').fadeToggle('fast')" style="cursor:pointer;" data-toggle="tooltip" title="Settings" data-placement="top">
<i class="material-icons" id="settings">&#xE8B8;</i>
</li>
<li id="terminal_time" data-toggle="tooltip" title="Please Wait..." data-placement="top">
<span class="time_ajax"></span>
</li>
<li id="terminal_update" onclick="_TerminalUpdate();" style="cursor:pointer;" data-toggle="tooltip" title="Save" data-placement="top">
<i class="material-icons" id="save">&#xE161;</i>
</li>
</ul>
</div>
<audio id="load">
<source src="https://www.cpuwin.com/nem-mining/assets/sound/load.mp3" type="audio/mpeg">
</audio>
<audio id="coin">
<source src="https://www.cpuwin.com/nem-mining/assets/sound/coin.mp3" type="audio/mpeg">
</audio>
<audio id="error">
<source src="https://www.cpuwin.com/nem-mining/assets/sound/error.mp3" type="audio/mpeg">
</audio>
<audio id="saved">
<source src="https://www.cpuwin.com/nem-mining/assets/sound/save.mp3" type="audio/mpeg">
</audio>
<script src="https://www.cpuwin.com/nem-mining/assets/js/jquery.min.js?933067619656"></script>
<script src="https://www.cpuwin.com/nem-mining/assets/js/popper.min.js?933067619656"></script>
<script src="https://www.cpuwin.com/nem-mining/assets/js/bootstrap.min.js?933067619656"></script>
<script src="https://www.cpuwin.com/nem-mining/assets/js/jquery.mask.money.js?933067619656"></script>
<script src="https://www.cpuwin.com/nem-mining/assets/js/jquery.charts.js?933067619656"></script>
<script src="https://www.cpuwin.com/nem-mining/assets/js/countUp.min.js?933067619656"></script>
<script src="https://www.cpuwin.com/nem-mining/assets/js/sweetalert.min.js?933067619656"></script>
<script src="https://www.cpuwin.com/nem-mining/assets/js/jquery.cookie.min.js?v=933067619656"></script>
<script src="https://www.cpuwin.com/nem-mining/assets/js/terminal.js?v=933067619656"></script>
<script type="text/javascript">
            (function(d, w, c) {
                (w[c] = w[c] || []).push(function() {
                    try {
                        w.yaCounter47963108 = new Ya.Metrika({
                            id: 47963108,
                            clickmap: true,
                            trackLinks: true,
                            accurateTrackBounce: true,
                            trackHash: true
                        });
                    } catch (e) {}
                });

                var n = d.getElementsByTagName("script")[0],
                    s = d.createElement("script"),
                    f = function() {
                        n.parentNode.insertBefore(s, n);
                    };
                s.type = "text/javascript";
                s.async = true;
                s.src = "https://mc.yandex.ru/metrika/watch.js";

                if (w.opera == "[object Opera]") {
                    d.addEventListener("DOMContentLoaded", f, false);
                } else {
                    f();
                }
            })(document, window, "yandex_metrika_callbacks");
        </script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-89566527-2"></script>
<script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'UA-89566527-2');
        </script>
<script type="text/javascript">
            if (window.ADSController === undefined) {
                document.addEventListener('contextmenu', event => event.preventDefault());
				$('body').prepend('<div class="locked" onclick="location.reload();"><div class="lock-img"></div><div class="info-text">Please Disable Ad Blocker Apps.</div></div>');
				var audioBlock = document.createElement('audio');
				audioBlock.setAttribute('src', 'assets/sound/adblock.mp3');
				audioBlock.play();
            } else if ($(window).width() >= 800) {
                if ($.cookie("CONTROL_RAYS") != "ok") {
                    setTimeout(function() {

                        $("#_controlRay").slideDown("fast");
                        var expDate = new Date();
                        expDate.setTime(expDate.getTime() + (180 * 60 * 1000));
                        $.cookie("CONTROL_RAYS", 'ok', {
                            path: '/',
                            expires: expDate
                        });

                    }, 9076);

                    var attempt = 0;
                    $("#_controlRayClose").mouseover(function() {
                        if (attempt < 4) {
                            var ft = Math.floor(Math.random() * 675) + 25;
                            $(this).css({
                                "left": ft
                            });
                        }
                        attempt++;
                    });
                }
            }

            var auto = 0;
            var stop = 0;
            var rows = 0;
            var total = 0;
            var width = 0;
            var level = 0.00000020;

                                </script>
</body>
</html>