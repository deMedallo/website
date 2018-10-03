<?php 

header('Content-Type: application/json');
include('../_cms/autoload.php');

$jsonFinal = new stdClass();
$jsonFinal->error = true;
$jsonFinal->fields = $datos;
$jsonFinal->data = null;
$jsonFinal->msg = null;


if(isset($datos->tx)){
	$txInfo = TransferForTx($datos->tx);
	
	if($txInfo->id == 0){
		$jsonFinal->msg = 'Tx no encontrada.';
	}else{
		$jsonFinal->msg = 'Tx encontrada.';
		$jsonFinal->error = false;
		$jsonFinal->data = $txInfo;
	}
}
else{ $jsonFinal->msg = "No existen datos validos."; }
#FINAL
echo json_encode($jsonFinal, JSON_PRETTY_PRINT);
return json_encode($jsonFinal, JSON_PRETTY_PRINT);