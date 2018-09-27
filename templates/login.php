<?php
	$msg = new stdClass();
	$msg->e = false;
	$msg->t = '';
	# ------------------------ 

	if(isset($_POST['mailornick']) && isset($_POST['hash']) && isset($_POST["adcopy_challenge"]) && isset($_POST["adcopy_response"])){
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
					
			$_POST['hash'] = md5($_POST['hash']);		
			$checkb = datosSQL("Select * from ".TBL_USER." where mail='{$_POST['mailornick']}' and hash='{$_POST['hash']}' OR nick='{$_POST['mailornick']}' and hash='{$_POST['hash']}'");
			if(isset($checkb->error) && $checkb->error == false && isset($checkb->data[0])){			
				$session = UserForId($checkb->data[0]['id']);
				$_SESSION = (array) $session;
				
				echo '<meta http-equiv="refresh" content="0; url=home.dm">';
				exit();
			}else{
				echo "Datos Incorrectos.";
			}
		}
	}
?>
<div class="content_middle">
	<div class="container">
		<div class="row">
			<hr>
			<h1>Ingresar</h1>
			<p>Ingresa tus datos en el formulario para acceder a deMedallo.</p>
			<hr>
			<div class="col-md-12">

				<?php if($msg->e == true){ ?>
					<div class="alert alert-info" role="alert">
					  <?php echo $msg->t; ?>
					</div>
				<?php } ?>
				
				<div class="card text-center card  bg-default mb-3">
					<form method="POST" action="">
						<div class="col-md-6">
							<div class="card-body">
								<input type="text" name="mailornick" class="form-control input-sm chat-input" placeholder="Usuario" />
								</br>
								<input type="password" name="hash" class="form-control input-sm chat-input" placeholder="Contraseña" />
							</div>
						</div>
						<div class="col-md-6">
							<?php echo solvemedia_get_html("5JNz5YEWn5j50mNNCPmaY-yRLR-8VuMN");	//outputs the widget ?>
							
							<hr>
							<div class="card-footer text-muted text-center">
								<button type="submit" class="btn btn-secondary">Ingresar</button>
							</div>
					<hr><hr>
						</div>
					</form>
					<hr><hr>
				</div>
			</div>
			<hr>
		</div>
	</div>
</div>