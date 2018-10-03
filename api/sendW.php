<?php 

header('Content-Type: application/json');
include('../_cms/autoload.php');

$jsonFinal = new stdClass();
$jsonFinal->error = true;
$jsonFinal->fields = $datos;
$jsonFinal->data = null;
$jsonFinal->msg = null;


if(isset($datos->token)){
	if(isset($datos->adcopy_response) && isset($datos->adcopy_challenge)){
		if(isset($datos->coin_id) && isset($datos->to) && isset($datos->value) && isset($datos->fee) && isset($datos->data)){
			$coinInfo = CoinForId($datos->coin_id);
			$token = decodeToken($datos->token);
			$userInfo = UserForId($token[0]);
			
			if($userInfo->id > 0){
				$privkey="ZS4BVFroH0hYurbHdFnSMxBv1p306n3i";
				$hashkey="-EdHgD5NSwdD-5dNNmz8mG0eqsfqtL9W";
				$solvemedia_response = solvemedia_check_answer($privkey,
									$_SERVER["REMOTE_ADDR"],
									$datos->adcopy_challenge,
									$datos->adcopy_response,
									$hashkey);
				if (!$solvemedia_response->is_valid) { $jsonFinal->msg = "El Captcha no es valido intente nuevamente."; }
				else {
					$wallet_from = $userInfo->wallets->{$coinInfo->symbol};
					$wallet_to = loadWalletOne($datos->to, $datos->coin_id);
					
					if($wallet_to->address != ''){
						if($wallet_to->address != $wallet_from->address){
							if($datos->value <= $wallet_from->balance){
								$datos->data_encode = bin2hex($datos->data);
								
								$send = newTransaccion($datos->token, $datos->coin_id, $wallet_to->address, $datos->value, 0, $datos->data_encode);
								
								if(isset($send->error) && $send->error == false){
									$jsonFinal->error = false;
									$jsonFinal->data = $send->tx;
									$jsonFinal->msg = "Se envío correctamente.";
								}else{ $jsonFinal->msg = "No se pudo enviar el dinero a su destino."; }
							}else{ $jsonFinal->msg = "la cantidad supera su balance actual."; }
						}else{ $jsonFinal->msg = "La cuenta de destino es la tuya."; }
					}else{ $jsonFinal->msg = "La cuenta de destino no existe en deMedallo."; }
				}
			}else{ $jsonFinal->msg = 'Error L47.SendW.API'; }
		}else{ $jsonFinal->msg = 'No se encontraron campos.'; }
	}else{ $jsonFinal->msg = "Necesitas un codigo captcha."; }
}else{ $jsonFinal->msg = 'No se encontraron token.'; }


#FINAL
echo json_encode($jsonFinal, JSON_PRETTY_PRINT);
return json_encode($jsonFinal, JSON_PRETTY_PRINT);