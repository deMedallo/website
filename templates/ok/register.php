
<?php if(checkSession() == false){ ?>
	<?php 

		$msg = new stdClass();
		$msg->e = false;
		$msg->t = '';
		# ------------------------ 
	
		if(
			isset($_POST['name'])
			&& isset($_POST['nick'])
			&& isset($_POST['email'])
			&& isset($_POST['pass1'])
			&& isset($_POST['pass2'])
			&& isset($_POST["adcopy_challenge"]) 
			&& isset($_POST["adcopy_response"])
		){
						
			$privkey="ZS4BVFroH0hYurbHdFnSMxBv1p306n3i";
			$hashkey="-EdHgD5NSwdD-5dNNmz8mG0eqsfqtL9W";
			$solvemedia_response = solvemedia_check_answer($privkey,
								$_SERVER["REMOTE_ADDR"],
								$_POST["adcopy_challenge"],
								$_POST["adcopy_response"],
								$hashkey);
			if (!$solvemedia_response->is_valid) {
				// $solvemedia_response->error
				$msg->e = true;
				$msg->t = "<hr><h3>Error</h3>"."<p>El Captcha no es valido intente nuevamente.</p><hr>";
			}
			else {
				$datos = $_POST;
				$_POST = array();
				unset($_POST);
				
				if($datos['pass1'] !== $datos['pass2']){
					$msg->e = true;
					$msg->t = ('las contraseñas no coinciden, intente nuevamente.');
				}else{
					$datos['name'] = (string) $datos['name'];
					$datos['nick'] = stringParse($datos['nick']);
					$datos['email'] = (string) $datos['email'];
					$datos['pass1'] = (string) $datos['pass1'];
					$datos['hash'] = md5($datos['pass1']);
					
					
					$create = crearSQL("INSERT INTO ".TBL_USER." ( name, nick, mail, hash ) VALUES (?,?,?,?)",array(
						$datos['name']
						, $datos['nick']
						, $datos['email']
						, $datos['hash']
					));
					
					if(isset($create->error) && $create->error == false){
						$session = UserForId($create->last_id);
						$createW = crearSQL("INSERT INTO ".TBL_WALLET." ( userid, address, coin ) VALUES (?,?,?)",array(
							$session->id
							, createWalletDM($session->id, $session->nick)
							, 1
						));
						
						
						if(isset($createW->error) && $createW->error == false){
							$_SESSION = (array) $session;
							echo '<meta http-equiv="refresh" content="0; url=home.dm">';
							exit();
						}else{
							$msg->e = true;
							$msg->t = 'No se creo la billetera deMedallo contacte con soporte...';
						}
						
						
					}else{
						$msg->e = true;
						$msg->t = 'No se creo la cuenta intente nuevamente';
					}	
			}				
		}
		?>
		
		<?php }else{ ?>
		<?php } ?>
			<div class="content_middle">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<?php if($msg->e == true){ ?>
								<div class="alert alert-info" role="alert">
								  <?php echo $msg->t; ?>
								</div>
							<?php } ?>
							<div class="panel panel-primary" style="margin:20px;">
								<div class="panel-heading"><h3 class="panel-title">Formulario de registro</h3></div>
								<div class="panel-body">
									<form method="POST" class="form row">
										<div class="col-md-6 col-sm-6">
											<div class="form-group col-md-12 col-sm-12">
												<label for="name">Nombre Completo*</label>
												<input type="text" class="form-control input-sm" name="name" placeholder="">
											</div>
											<div class="form-group col-md-12 col-sm-12">
												<label for="name">Nick / Usuario*</label>
												<input type="text" class="form-control input-sm" name="nick" placeholder="">
											</div>
											<div class="form-group col-md-12 col-sm-12">
												<label for="email">Correo Electronico*</label>
												<input type="email" class="form-control input-sm" name="email" placeholder="">
											</div>
											<div class="form-group col-md-12 col-sm-12">
												<label for="pincode">Contraseña*</label>
												<input type="password" class="form-control input-sm" name="pass1" placeholder="">
											</div>
											<div class="form-group col-md-12 col-sm-12">
												<label for="pincode">Verificar Contraseña*</label>
												<input type="password" class="form-control input-sm" name="pass2" placeholder="">
											</div>
										</div>

										<div class="col-md-6 col-sm-6">
											<div class="form-group col-md-12 col-sm-12" >
												<?php echo solvemedia_get_html("5JNz5YEWn5j50mNNCPmaY-yRLR-8VuMN");	//outputs the widget ?><br>
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
			
<?php }else{ ?>

<div class="content_middle">
	<div class="container">
		<div class="row">
			<h2>Ya estas registrado</h2>
			<p>Ya tienes una cuenta de deMedallo abierta.</p>
			<p><a href="home.dm" class="btn btn-info">Pagina principal</a></p>
		</div>
	</div>
</div>
<?php } ?>