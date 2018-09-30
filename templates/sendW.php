<?php
	$msg = new stdClass();
	$msg->e = false;
	$msg->t = '';
	# ------------------------ 
	
	if(isset($_GET['coin'])){
		$coinInfo = CoinForId($_GET['coin']);
		$demo = UserForId($_SESSION['id']);
		
		
		if(!isset($demo->wallets->{$coinInfo->symbol})){
			echo 'Moneda no encontrada, te vamos a redirigir a otra pagina...';
			echo '<meta http-equiv="refresh" content="2; url=home.dm">';
			exit();
		}
		
		if(
			isset($_POST['address'])
			&& isset($_POST['value'])
			&& isset($_POST['data'])
			&& isset($_POST["adcopy_challenge"]) && isset($_POST["adcopy_response"])
		){
			$_POST['address'] = (string) $_POST['address'];
			$_POST['value'] = (double) $_POST['value'];
			$_POST['data'] = (string) $_POST['data'];
			$_POST['data_encode'] = bin2hex($_POST['data']);
			
		
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
				$wallet_from = $demo->wallets->{$coinInfo->symbol};
				$wallet_to = loadWalletOne($_POST['address'], $_GET['coin']);
				
				if($wallet_to->address != ''){
					if($wallet_to->address != $wallet_from->address){
						if($_POST['value'] <= $wallet_from->balance){
							# echo json_encode($wallet_to);
							
							$send = newTransaccion($_SESSION['token'], $_GET['coin'], $wallet_to->address, $_POST['value'], 0, $_POST['data_encode']);
							
							# echo json_encode($send);
							
							if(isset($send->error) && $send->error == false){
								$msg->e = true;
								$msg->t = "<hr><h3>Enviado!</h3>"."<p>Se envío correctamente - TX: <a href=\"tx.dm?tx={$send->tx}\">{$send->tx}</a>.</p><hr>";
							}else{
								$msg->e = true;
								$msg->t = "<hr><h3>Error</h3>"."<p>No se pudo enviar el dinero a su destino.</p><hr>";
							}
							
							$demo = UserForId($_SESSION['id']);
						}else{
							$msg->e = true;
							$msg->t = "<hr><h3>Error</h3>"."<p>la cantidad supera su balance actual.</p><hr>";
						}
					}else{
						$msg->e = true;
						$msg->t = "<hr><h3>Error</h3>"."<p>La cuenta de destino es la tuya.</p><hr>";
					}
				}else{
					$msg->e = true;
					$msg->t = "<hr><h3>Error</h3>"."<p>La cuenta de destino no existe en deMedallo.</p><hr>";
				}
			}
		}
	}else{
		echo '<meta http-equiv="refresh" content="0; url=home.dm">';
		exit();
	}
?>

<div class="container marketing">
	<h1><hr>Enviar : <?php echo $coinInfo->name; ?> (<?php echo $coinInfo->symbol; ?>)</h1>
	<h3>Balance: <?php echo convertInFloat($demo->wallets->{$coinInfo->symbol}->balance, $demo->wallets->{$coinInfo->symbol}->decimals); ?></h3>
	<hr>
	<?php if($msg->e == true){ ?>
		<div class="alert alert-info" role="alert">
		  <?php echo $msg->t; ?>
		</div>
	<?php } ?>
	<form method="POST">
		<table class="table">
			<tr>
				<th>Direccion Destino</th>
				<td><input name="address" class="form-control" type="text" value="<?php if(isset($_POST['address'])){ echo $_POST['address']; }; ?>"></td>
			</tr>
			<tr>
				<th>Valor</th>
				<td><input name="value" class="form-control" type="number" step="<?php echo '0.'.str_repeat("0", ($demo->wallets->{$coinInfo->symbol}->decimals - 1)).'1'; ?>" value="<?php if(isset($_POST['value'])){ echo convertInFloat($_POST['value'], $demo->wallets->{$coinInfo->symbol}->decimals); }else{ echo '0.'.str_repeat("0", ($demo->wallets->{$coinInfo->symbol}->decimals - 1)).'1'; }; ?>" min="0" max="<?php echo convertInFloat($demo->wallets->{$coinInfo->symbol}->balance, $demo->wallets->{$coinInfo->symbol}->decimals); ?>"></td>
			</tr>
			 
			<tr>
				<th>Fee</th>
				<td><input class="form-control" disabled value="0"></td>
			</tr>
			<tr>
				<th>Data</th>
				<td><textarea name="data" class="form-control" spellcheck="false" style="width: 100%; font-size: small; font-family: Monospace; padding: 8px; background-color: #EEEEEE;" rows="5"><?php if(isset($_POST['data_encode'])){ echo $_POST['data']; }; ?></textarea></td>
			</tr>
			<tr>
				<th>Captcha</th>
				<td class="text-center"><?php echo solvemedia_get_html("5JNz5YEWn5j50mNNCPmaY-yRLR-8VuMN"); ?></td>
			</tr>
			<tr>
				<th></th>
				<td><input type="submit" class="btn btn-success" class="form-control"></td>
			</tr>
		</table>
	</form>
	<hr>
</div>