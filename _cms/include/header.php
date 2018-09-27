<?php
if(isset($_GET['q'])){ $q = $_GET['q']; }else{ $q = 'musica, series, peliculas...'; };
?>
<div class="header">
    <div class="col-sm-8 header-left">
		 <div class="logo">
			<a href="home.dm"><img height="52" src="images/logo.png" alt=""/></a>
		 </div>
		 <div class="menu">
			  <a class="toggleMenu" href="#"><img src="images/nav.png" alt="" /></a>
				<ul class="nav" id="nav">
					<!-- <li><a href="home.dm">Inicio</a></li> -->
					
					<div class="clearfix"></div>
				</ul>
				<script type="text/javascript" src="js/responsive-nav.js"></script>
		</div>	
		 <!-- start search-->
		  <div class="search-box">
				<div id="sb-search" class="sb-search">
					<form class="" method="get" id="download" action="search.dm">
						<input class="sb-search-input" placeholder="<?php echo $q; ?>" type="search" name="q" id="q">
						<input class="sb-search-submit" type="submit" value="">
						<span class="sb-icon-search"> </span>
					</form>
				</div>
			</div>
			<!----search-scripts---->
			<script src="js/classie.js"></script>
			<script src="js/uisearch.js"></script>
			<script>
				new UISearch( document.getElementById( 'sb-search' ) );
			</script>
			<!----//search-scripts---->						
		<div class="clearfix"></div>
	</div>
	 <?php if(checkSession() == false){ ?>
		<div class="col-sm-2 header_right">
			<div id="loginContainer"><a href="#" id="loginButton"><img src="images/login.png"><span>Ingresar</span></a>
				<div id="loginBox">                
					<form id="loginForm" method="POST" action="login.dm">
						<fieldset id="body">
							<?php 
								if(isset($_GET['page']) && $_GET['page'] == 'login'){
									echo 'Utiliza el formulario de la pagina principal';
								}else if(isset($_GET['page']) && $_GET['page'] == 'register'){
									echo 'Ingresa el Captcha desde la pagina de registro o ingresa desde <a href="login.dm"><b>aquí</b></a>';
								}else{
									?>
									<fieldset>
										<label for="email">Usuario o Correo Electronico</label>
										<input type="text" name="mailornick" id="email">
									</fieldset>
									<fieldset>
										<label for="password">Contraseña</label>
										<input type="password" name="hash" id="password">
									 </fieldset>
									<fieldset>
										<label for="password">Captcha</label>
										<?php echo solvemedia_get_html("5JNz5YEWn5j50mNNCPmaY-yRLR-8VuMN"); ?>
									 </fieldset>
									 <input type="submit" id="login" value="Ingresar">
									<!-- <label for="checkbox"><input type="checkbox" id="checkbox"> <i>Remember me</i></label> -->
									<?php
								}
							?>
						</fieldset>
						<!-- <span><a href="#">Perdio su contraseña?</a></span> -->
					 </form>
				 </div>
			</div>
			<div class="clearfix"></div>
		</div>
		 
		<div class="col-sm-2 header_right">
			<div id="loginContainer"><a href="<?php echo url_site; ?>/register.dm" id="registerButton"><img src="images/login.png"><span>Soy nuevo</span></a></div>
			<div class="clearfix"></div>
		</div>
	 <?php }else{
			$demo = UserForId($_SESSION['id']);
		 ?>
		<div class="col-sm-3 header_right">
			<div id="loginContainer"><a href="#" id="loginButton"><img src="images/login.png"><span>Mi Cuenta (<?php echo $_SESSION['nick']; ?>)</span></a>
				<div id="loginBox">                
					<form id="loginForm">
						<fieldset id="body">
							<fieldset>
								<label>Nombres</label>
								<?php echo $demo->name; ?>
							</fieldset>
							<fieldset>
								<label>Email</label>
								<?php echo $demo->mail; ?>
							</fieldset>
							<fieldset>
								<label>Referidos</label>
								<?php echo $demo->refers; ?>
							</fieldset>
							<fieldset>
								<label>Wallets</label>
								<table class="table table-responsive">
									<tr>
										<th>Address</th>
										<th>Balance</th>
										<th>Coin</th>
									<tr>
									<?php foreach($demo->wallets As $symbol=>$data){ ?>
									<tr>
										<td><?php echo substr($data->address, 0, 10) . '...'; ?></td>
										<td class="wallet-DM-balance"><?php echo $data->balance; ?></td>
										<td><?php echo $data->symbol; ?></td>
									</tr>
									<?php } ?>
								</table>
							</fieldset>
						</fieldset>
					 </form>
				 </div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="col-sm-1 header_right">
			<div id="loginContainer"><a href="<?php echo url_site; ?>/logout.dm" id="registerButton"><span>Salir</span></a></div>
			<div class="clearfix"></div>
		</div>
	 <?php } ?>
	<div class="clearfix"></div>
</div>