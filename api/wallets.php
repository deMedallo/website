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
		if(isset($datos->address) && isset($datos->coin_id)){
			$walletInfo = loadWalletOne($datos->address, $datos->coin_id);
			
			if($walletInfo->coin_id == 0){
				$jsonFinal->msg = 'Cuenta no encontrada, te vamos a redirigir a otra pagina...';
			}else{
				$jsonFinal->error = false;
				$walletInfo->totalSend = totalSendWallet($datos->address, $datos->coin_id);
				$walletInfo->totalRecibe = totalRecibeWallet($datos->address, $datos->coin_id);
				$walletInfo->lastTx = lastTx($walletInfo->address, $walletInfo->coin_id, 10);
				$jsonFinal->data = $walletInfo;
			}
		}
		else{ $jsonFinal->msg = "No existen datos validos."; }
	}
	else{ $jsonFinal->msg = "Token invalido."; }
}else{ $jsonFinal->msg = "No existe Token."; }

#FINAL
echo json_encode($jsonFinal, JSON_PRETTY_PRINT);
return json_encode($jsonFinal, JSON_PRETTY_PRINT);