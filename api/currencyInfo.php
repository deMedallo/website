<?php 

header('Content-Type: application/json');
include('../_cms/autoload.php');

$jsonFinal = new stdClass();
$jsonFinal->error = true;
$jsonFinal->fields = $datos;
$jsonFinal->data = null;
$jsonFinal->msg = null;

if(isset($_GET['optionList']) && $_GET['optionList'] == true){
	$coinsList = CoinListSelected();
	
	if(count($coinsList) > 0){
		$jsonFinal->error = false;
		$jsonFinal->data = $coinsList;
	}
}

#FINAL
echo json_encode($jsonFinal, JSON_PRETTY_PRINT);
return json_encode($jsonFinal, JSON_PRETTY_PRINT);