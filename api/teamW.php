<?php 

header('Content-Type: application/json');
include('../_cms/autoload.php');

$jsonFinal = new stdClass();
$jsonFinal->error = true;
$jsonFinal->fields = $datos;
$jsonFinal->data = null;
$jsonFinal->msg = null;


if(isset($datos->coin_id)){
	$wallets = new stdClass();
	$wallets = CoinForId($datos->coin_id);
	$wallets->wallets = loadWalletsCoin($datos->coin_id);
	
	if(count($wallets->wallets) <= 0){
		$jsonFinal->msg = 'Cuenta no encontrada, te vamos a redirigir a otra pagina...';
	}else{
		$jsonFinal->error = false;
		$jsonFinal->data = $wallets;
	}
}
else{ $jsonFinal->msg = "No existen datos validos."; }

#FINAL
echo json_encode($jsonFinal, JSON_PRETTY_PRINT);
return json_encode($jsonFinal, JSON_PRETTY_PRINT);