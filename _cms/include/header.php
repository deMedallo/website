<?php
if(isset($_GET['q'])){ $q = $_GET['q']; }else{ $q = 'musica, series, peliculas...'; };
?>


<header>
	<nav class="navbar navbar-expand-md navbar-dark sticky-top bg-dark">
		<a class="navbar-brand" href="home.dm">
			<img src="images/logo.png" height="52" class="d-inline-block align-top" alt="">
			
		</a>
  
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
		<div class="collapse navbar-collapse" id="navbarCollapse">
			<form class="navbar-nav mr-auto form-inline" method="search" action="search.dm">
				<input class="form-control mr-sm-2" type="text" placeholder="<?php echo $q; ?>" aria-label="<?php echo $q; ?>" value="<?php echo $q; ?>"  name="q" id="q"  onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '<?php echo $q; ?>';}" />
				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
			</form>
			<ul class="navbar-nav mt-2 mt-md-0">
				<!--
				<li class="nav-item active"><a class="nav-link" href="hme.dm">Home <span class="sr-only">(current)</span></a></li>
				<li class="nav-item"><a class="nav-link" href="#">Link</a></li>
				<li class="nav-item"><a class="nav-link disabled" href="#">Disabled</a></li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Dropdown
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="#">Action</a>
						<a class="dropdown-item" href="#">Another action</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Something else here</a>
					</div>
				</li>
				<li class="nav-item"><a class="nav-link" href="#">Link</a></li>
				-->
				
				
				 <?php if(checkSession() == false){ ?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Ingresar
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">						
							<form id="loginForm" method="POST" action="login.dm">
								<?php 
									if(isset($_GET['page']) && $_GET['page'] == 'login'){
										echo 'Utiliza el formulario de la pagina principal';
									}else if(isset($_GET['page']) && $_GET['page'] == 'register'){
										echo 'Ingresa el Captcha desde la pagina de registro o ingresa desde <a href="login.dm"><b>aquí</b></a>';
									}else{
										?>
										<div class="dropdown-item"><label for="email">Usuario o Correo Electronico</label></div>
										<div class="dropdown-item"><input class="form-control" type="text" name="mailornick" id="email"></div>
										<div class="dropdown-item"><label for="password">Contraseña</label></div>
										<div class="dropdown-item"><input class="form-control" type="password" name="hash" id="password"></div>
										<div class="dropdown-item"><label for="password">Captcha</label></div>
										<div class="dropdown-item"><?php echo solvemedia_get_html("5JNz5YEWn5j50mNNCPmaY-yRLR-8VuMN"); ?></div>
										<div class="dropdown-item"><input class="btn btn-success" type="submit" id="login" value="Ingresar"></div>
										<!-- <label for="checkbox"><input type="checkbox" id="checkbox"> <i>Remember me</i></label> -->
										<div class="dropdown-divider"></div>
										<!-- <span><a href="#">Perdio su contraseña?</a></span> -->
										<?php
									}
								?>
							</form>
						</div>
					</li>
					<li class="nav-item"><a class="nav-link" href="<?php echo url_site; ?>/register.dm">Soy nuevo</a></li>
				 <?php }else{
						$demo = UserForId($_SESSION['id']);
						$listTx = lastTx($demo->wallets->DM->address, $demo->wallets->DM->coin_id);		
					 ?>
					
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Mi Cuenta (<?php echo $_SESSION['nick']; ?>)
							</a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								<!--<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>-->
								<div class="dropdown-divider"></div>
								<div class="dropdown-item" ><b>Nombres</b>: <?php echo $demo->name; ?></div>
								<div class="dropdown-item" ><b>Email</b>: <?php echo $demo->mail; ?></div>
								<div class="dropdown-item" ><b>Referidos</b>: <?php echo $demo->refers; ?></div>
								
								<div class="dropdown-divider"></div>
								<div class="dropdown-item" href="#"><h3>Wallets</h3></div>
								<?php foreach($demo->wallets As $symbol=>$data){
									#echo json_encode($data);
										?>
									<fieldset class="dropdown-item">
										<label>Wallet <?php echo $data->name; ?> / <?php echo $data->symbol; ?></label>
										<table class="table table-responsive">
											<tr>
												<th colspan="2">Address: <a href="wallets.dm?address=<?php echo $data->address; ?>&coin=<?php echo $data->coin_id; ?>"><?php echo $data->address; ?></a></th>
											</tr>
											<tr>
												<td class="wallet-DM-balance"><?php echo convertInFloat($data->balance, $data->decimals); ?></td>
												<td><?php echo $data->symbol; ?></td>
											</tr>
										</table>
									</fieldset>
								<?php } ?>
								<div class="dropdown-item" href="#"><h3>Ultimos movimientos</h3></div>
								<fieldset class="dropdown-item">
									<table class="table table-responsive" style="zoom: 0.7;">
										<tr>
											<th>Tx</th>
											<th>From</th>
											<th>To</th>
											<th>Value</th>
											<th>Coin</th>
										<tr>
										<?php foreach($listTx As $txItem){ ?>
										<tr>
											<td title="<?php echo $txItem->tx; ?>"><a href="tx.dm?tx=<?php echo $txItem->tx; ?>"><?php echo substr($txItem->tx, 0, 10) . '...'; ?></a></td>
											<td title="<?php echo $txItem->from; ?>"><a href="wallets.dm?address=<?php echo $txItem->from; ?>&coin=<?php echo $txItem->coinInfo->id; ?>"><?php echo substr($txItem->from, 0, 10) . '...'; ?></a></td>
											<td title="<?php echo $txItem->to; ?>"><a href="wallets.dm?address=<?php echo $txItem->to; ?>&coin=<?php echo $txItem->coinInfo->id; ?>"><?php echo substr($txItem->to, 0, 10) . '...'; ?></a></td>
											<td><?php echo convertInFloat($txItem->value, $demo->wallets->DM->decimals); ?></td>
											<td><?php echo $demo->wallets->DM->symbol; ?></td>
										</tr>
										<?php } ?>
										
									</table>
								</fieldset>
							</div>
						</li>
						
						<li class="nav-item"><a class="nav-link" href="<?php echo url_site; ?>/logout.dm" id="registerButton">Salir</a></li>
				 <?php } ?>
			</ul>
		</div>
	</nav>
</header>