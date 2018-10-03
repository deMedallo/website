<?php 

header('Content-Type: application/json');
include('../_cms/autoload.php');

$jsonFinal = new stdClass();
$jsonFinal->error = true;
$jsonFinal->fields = $datos;
$jsonFinal->data = null;
$jsonFinal->msg = null;


if(isset($datos->address) && isset($datos->coin_id)){
	$walletInfo = loadWalletOne($datos->address, $datos->coin_id);
	
	if($walletInfo->coin_id == 0){
		$jsonFinal->msg = 'Cuenta no encontrada, te vamos a redirigir a otra pagina...';
	}else{
		$jsonFinal->error = false;
		$walletInfo->lastTx = lastTx($walletInfo->address, $walletInfo->coin_id, 25);
		$jsonFinal->data = $walletInfo;
	}
}
else{ $jsonFinal->msg = "No existen datos validos."; }

#FINAL
echo json_encode($jsonFinal, JSON_PRETTY_PRINT);
return json_encode($jsonFinal, JSON_PRETTY_PRINT);