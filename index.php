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
		</script>
		<!--
			<script src="https://unpkg.com/vue/dist/vue.js"></script>
			<script src="https://unpkg.com/vue-router/dist/vue-router.js"></script>
		-->
		<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
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
										<form method="POST" class="form row"action="javascript:false;" @submit="submitRegister">
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
								<router-link tag="a" class="btn btn-secondary" colspan="2" v-bind:to="'/lastTx/' + wallet.address + '/' + wallet.coin_id">Transacciones</router-link>
							</td>
							<td><a href="sendW.dm?coin=coin_id" class="btn btn-info">Enviar</a></td>
						</tr>
					</table>
					
				</fieldset>
			</div>
		</template>
		
		<template id="viewWallets-template">
			<div>
				<div class="container marketing">
					<h1><hr>Visor de Billetera:  <span></span></h1>
					<h2>{{ balance.toFixed(decimals) }} {{ symbol }}</h2>
					<hr>
					<div class="row">
					  <div class="col-md-6">
						<table class="table">
							<tr><th>Address</th><td>{{ $route.params.address }}</td></tr>
							<tr><th>Name</th><td>{{ name }}</td></tr>
							<tr><th>Symbol</th><td><a href="teamW.dm?coin=">{{ symbol }}</a></td></tr>
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
							<tr>
							<tr v-for="tx in lastTx">
								<td title=""><a href="tx.dm?tx=">{{ tx.tx }}</a></td>
								<td title=""><a href="wallets.dm?address=&coin=">{{ tx.from }}</a></td>
								<td title=""><a href="wallets.dm?address=&coin=">{{ tx.to }}</a></td>
								<td>{{ tx.value.toFixed(decimals) }}</td>
								<td>{{ symbol }}</td>
							</tr>
						</table>
						<a href="lastTx.dm?address=address&coin=coin_id" class="btn btn-md btn-primary">Ver mas</a>
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

<script>
const _DM = axios.create({
  baseURL: 'http://localhost/website/api',
  timeout: 1000,
  headers: {'X-Custom-Header': 'foobar'}
});

const component_formRegister = Vue.component('component_formRegister', {
	data: function () {
		return {
			error: false,
			message: '',
			name: '',
			nick: '',
			email: '',
			pass1: '',
			pass2: '',
			adcopy_challenge: '',
			adcopy_response: ''
		}
	},
	template: '#formRegister-template',
	created(){
		var self = this;
		var sessionCheck = self.$parent.checkSession();
		if(sessionCheck == true){
			return false;
		}
		setTimeout(function(){
			self.$parent.realoadCaptcha('acwidget-register')
		}, 1000);
	},
	methods: {
		submitRegister: function(){
			var self = this;
			console.log('submit register');
			var nameCap = 'acwidget-register';
			self.adcopy_challenge = jQuery("#adcopy_challenge-" + nameCap).val();
			self.adcopy_response = jQuery("#adcopy_response-" + nameCap).val();
			
			dataSend = {
				name: self.name,
				nick: self.nick,
				email: self.email,
				pass1: self.pass1,
				pass2: self.pass2,
				adcopy_response: self.adcopy_response,
				adcopy_challenge: self.adcopy_challenge
			};
			
			_DM.get('/register', {
				params: dataSend
			})
			.then(function (response) {
				console.log(response.data);
				
				self.error = response.data.error;
				self.message = response.data.msg;
				
				if(response.data.error == false){ self.$parent.saveSession(response.data.data); }
			})
			.catch(function (error) {
				console.log(error);
			})
			.then(function (response) {
			});
			
			self.$parent.realoadCaptcha(nameCap);
		}
	}
});

const component_formLogin = Vue.component('component_formLogin', {
	data: function () {
		return {
			error: false,
			message: '',
			mailornick: '',
			hash: '',
			adcopy_challenge: '',
			adcopy_response: ''
		}
	},
	template: '#formLogin-template',
	created(){
		var self = this;
		setTimeout(function(){
			self.$parent.realoadCaptcha('acwidget-login')
		}, 1000);
	},
	methods: {
		submitLogin: function(){
			var self = this;
			console.log('submit');
			var nameCap = 'acwidget-login';
			
			self.adcopy_challenge = jQuery("#adcopy_challenge-" + nameCap).val();
			self.adcopy_response = jQuery("#adcopy_response-" + nameCap).val();
			
			dataSend = {
				mailornick: self.mailornick,
				hash: self.hash,
				adcopy_response: self.adcopy_response,
				adcopy_challenge: self.adcopy_challenge
			};
			
			_DM.get('/login', {
				params: dataSend
			})
			.then(function (response) {
				console.log(response.data);
				
				self.error = response.data.error;
				self.message = response.data.msg;
				
				if(response.data.error == false){ self.$parent.saveSession(response.data.data); }
			})
			.catch(function (error) {
				console.log(error);
			})
			.then(function (response) {
			});
			
			self.$parent.realoadCaptcha(nameCap);
		}
	}
});

const component_myaccountModal = Vue.component('component_myaccountModal', {
	data: function () {
		return {
			nick: '',
		}
	},
	template: '#myaccountModal-template',
	created(){
		
	},
	methods: {
	}
});

const component_viewWallets = Vue.component('component_viewWallets', {
	data: function () {
		return {
			error: false,
			message: '',
			address: '',
			coin_id: 0,
			balance: 0,
			name: '',
			symbol: '',
			decimals: 0.0,
			totalSend: {},
			totalRecibe: {},
			lastTx: [],
		}
	},
	template: '#viewWallets-template',
	created(){
		var self = this;
		
		dataSend = {
			token: self.$parent.token,
			address: self.$route.params.address,
			coin_id: self.$route.params.coin_id
		};
		
		_DM.get('/wallets', {
			params: dataSend
		})
		.then(function (response) {
			var target = response.data;
			console.log(target);
			
			if(target.error == false){
				for (var k in target.data){
					if (typeof target.data[k] !== 'function') {
						self[k] = (target.data[k]);
					}
				}
			}
		})
		.catch(function (error) {
			console.log(error);
		})
		.then(function (response) {
		});
	},
	methods: {
	}
});

const routes = [
	{ path: '/wallet/:address/:coin_id', component: component_viewWallets },
	{ path: '/Register', component: component_formRegister },
];

const router = new VueRouter({
  routes
})

new Vue({
	el: '#app',
	router: router,
	components: {
		'component_formLogin': component_formLogin
	},
	data: {
		isLogin: false,
		name: '',
		nick: '',
		token: '',
		refers: 0,
		mail: '',
		userid: 0,
		actived: 0,
		banned: 0,
		create: '',
		wallets: [],
	},
	created() {
		var self = this;
		self.loadCaptcha();
		self.checkSession();
		
		// console.log(self.wallets);
	},
	mounted() {
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
	},
	watch: {
		//token(newName) { localStorage.token = newName; }
	},
	methods: {
		checkSession(){
			var self = this;
			if (localStorage.token) {
				self.isLogin = true;
				self.name = localStorage.name;
				self.nick = localStorage.nick;
				self.token = localStorage.token;
				self.mail = localStorage.mail;
				self.userid = localStorage.id;
				self.create = localStorage.create;
				self.refers = localStorage.refers;
				self.banned = localStorage.banned;
				self.actived = localStorage.actived;
				self.wallets = JSON.parse(localStorage.wallets);
				
				return true;
			}
			else{
				self.isLogin = false;
				return false;
			}
		},
		saveSession(target){
			var self = this;
			
			for (var k in target){
				if (typeof target[k] !== 'function') {
					if(k == 'wallets'){
						localStorage.setItem(k, JSON.stringify(target[k]));
					}else{
						localStorage.setItem(k, target[k]);
					}
				}
			}
			location.reload();
		},
		loadCaptcha() {
			let recaptchaScript = document.createElement('script');
			recaptchaScript.setAttribute('src', 'http://api.solvemedia.com/papi/challenge.ajax');
			document.head.appendChild(recaptchaScript);
			// console.log('solvemedia cargado.');
		},
		realoadCaptcha(element){
			ACPuzzle.create('5JNz5YEWn5j50mNNCPmaY-yRLR-8VuMN', element, { multi: true, id: element, lang: 'de', size: 'standard' });
		},
		LogOut() {
			localStorage.clear();
			location.reload();
		}
	},
	beforeCreate:function(){
		
	},
	template: `<div>
		<header>
			<nav class="navbar navbar-expand-md navbar-dark sticky-top bg-dark">
				<a class="navbar-brand" href="index.dm"><img src="images/logo.png" height="52" class="d-inline-block align-top" alt=""></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
				<div class="collapse navbar-collapse" id="navbarCollapse">
					<form class="navbar-nav mr-auto form-inline" method="search" action="search.dm">
						<input class="form-control mr-sm-2" type="text" placeholder="¿Que Buscas?" aria-label="¿Que Buscas?" value=""  name="q" id="q"  onfocus="" onblur="" />
						<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
					</form>
					<ul class="navbar-nav mt-2 mt-md-0">
						<!--
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Minar</a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#" target="_new">DM - deMedallo</a>
								<div class="dropdown-divider"></div>
							</div>
						</li>-->
						
						<li class="nav-item dropdown" v-if="isLogin == false">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ingresar</a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<component_formLogin></component_formLogin>								
							</div>
						</li>
						<li class="nav-item dropdown" v-else="">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ nick }}</a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#" target="_new">DM - deMedallo</a>
								<div class="dropdown-divider"></div>
								<component_myaccountModal></component_myaccountModal>
							</div>
						</li>
						
 
						<li class="nav-item" v-if="isLogin == true"><a class="nav-link" @click="LogOut()">Salir</a></li>
						<router-link tag="li" class="nav-item" to="/Register" v-else=""><a class="nav-link" >Crear Cuenta</a></router-link>
						<!---->
					</ul>
				</div>
			</nav>
		</header>

		<main role="main">
			<transition>
			  <keep-alive>
				<router-view></router-view>
			  </keep-alive>
			</transition>
		</main>
	</div>`
});

		
		</script>
	</body>
</html>
