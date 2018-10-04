<?php 

header('Content-Type: application/json');
include('../_cms/autoload.php');

$jsonFinal = new stdClass();
$jsonFinal->error = true;
$jsonFinal->fields = $datos;
$jsonFinal->data = null;
$jsonFinal->msg = null;


if(isset($datos->coinFrom) && isset($datos->coinTo)){
	$coinFrom = CoinForSymbol($datos->coinFrom);
	if($coinFrom->id > 0){
		$coinFrom->coinTo = '';
		$jsonFinal->data = rateCurrency($datos->coinFrom, $datos->coinTo);
	}else{
		$jsonFinal->msg = 'una de las monedas no esta permitida.';
	}
}





#FINAL
echo json_encode($jsonFinal, JSON_PRETTY_PRINT);
return json_encode($jsonFinal, JSON_PRETTY_PRINT);