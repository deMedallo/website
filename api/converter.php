<?php 

header('Content-Type: application/json');
include('../_cms/autoload.php');

$jsonFinal = new stdClass();
$jsonFinal->error = true;
$jsonFinal->fields = $datos;
$jsonFinal->data = null;
$jsonFinal->msg = null;



if(isset($datos->token)){
	$token = decodeToken($datos->token);
	$userInfo = UserForId($token[0]);

	if($userInfo->id > 0){
		if(
			isset($datos->adcopy_challenge)
			&& isset($datos->adcopy_response)
			&& isset($datos->amountConvert)
			&& isset($datos->coinFrom)
			&& isset($datos->coinTo)
		){
			$privkey="ZS4BVFroH0hYurbHdFnSMxBv1p306n3i";
			$hashkey="-EdHgD5NSwdD-5dNNmz8mG0eqsfqtL9W";
			$solvemedia_response = solvemedia_check_answer($privkey,
								$_SERVER["REMOTE_ADDR"],
								$datos->adcopy_challenge,
								$datos->adcopy_response,
								$hashkey);
			if (!$solvemedia_response->is_valid) { $jsonFinal->msg = "El Captcha no es valido intente nuevamente."; }
			else {
				$coinFrom = CoinForSymbol($datos->coinFrom);
				$coinTo = CoinForSymbol($datos->coinTo);
				
						
				if($coinFrom->id > 0 && $coinTo->id > 0){
					if(isset($userInfo->wallets->{$coinFrom->symbol}) && isset($userInfo->wallets->{$coinTo->symbol})){
						$rateCurrency = rateCurrency($coinFrom->symbol, $coinTo->symbol);
						$totalConvert = $datos->amountConvert * $rateCurrency;
						
						if($userInfo->wallets->{$coinFrom->symbol}->balance >= $datos->amountConvert){
							$newBalanceFrom = $userInfo->wallets->{$coinFrom->symbol}->balance - $datos->amountConvert;
							$newBalanceTo = $userInfo->wallets->{$coinTo->symbol}->balance + $totalConvert;
							
							$update_balace_from = crearSQL("UPDATE ".TBL_WALLET." SET balance=? WHERE address='".$userInfo->wallets->{$coinFrom->symbol}->address."' AND coin='".$userInfo->wallets->{$coinFrom->symbol}->coin_id."' ",array(
								$newBalanceFrom
							));
							
							if(isset($update_balace_from->error) && $update_balace_from->error == false){
								$update_balace_to = crearSQL("UPDATE ".TBL_WALLET." SET balance=? WHERE address='".$userInfo->wallets->{$coinTo->symbol}->address."' AND coin='".$userInfo->wallets->{$coinTo->symbol}->coin_id."' ",array(
									$newBalanceTo
								));
								if(isset($update_balace_to->error) && $update_balace_to->error == false){
									$jsonFinal->error = false;
									$jsonFinal->msg = "Se agrego con exito {$totalConvert} {$coinTo->symbol} en el bote ".$userInfo->wallets->{$coinTo->symbol}->address." con exito. Nuevo balance {$newBalanceTo} {$coinTo->symbol}";			
									$jsonFinal->data = $newBalanceTo;
									# CREAR HISTORY
									
								}else{ $jsonFinal->msg = 'Error descontando de la cuenta 2.'; }	
							}else{ $jsonFinal->msg = 'Error descontando de la cuenta 1.'; }
						}else{ $jsonFinal->msg = 'No tienes suficiente saldo para este cambio.'; }
					}else{ $jsonFinal->msg = 'No tienes las billeteras necesarias para este cambio.'; }
				}else{ $jsonFinal->msg = 'una de las monedas no esta permitida.'; }
			}
		}else{ $jsonFinal->msg = 'Campos Invalidos.'; }
	}else{ $jsonFinal->msg = 'Token Invalido.'; }
}else{ $jsonFinal->msg = 'No existe Token.'; }


#FINAL
echo json_encode($jsonFinal, JSON_PRETTY_PRINT);
return json_encode($jsonFinal, JSON_PRETTY_PRINT);