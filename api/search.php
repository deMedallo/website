<?php 
header('Content-Type: application/json');
include('../_cms/autoload.php');

$jsonFinal = new stdClass();
$jsonFinal->error = true;
$jsonFinal->fields = $datos;
$jsonFinal->data = null;
$jsonFinal->msg = null;



if(isset($datos->search_text)){
	$dmWallet = new WalletValidator($datos->search_text);
	$dmTx = new TxValidator($datos->search_text);
	
	if($dmWallet->isAddress() == true){
		$jsonFinal->error = false;
		$jsonFinal->msg = "WalletResult_DM";
		$jsonFinal->data = loadWalletOne($datos->search_text, 1);;
	}
	else if($dmTx->isTx() == true){
		$jsonFinal->error = false;
		$jsonFinal->msg = "TxResult";
		$jsonFinal->data = TransferForTx($datos->search_text);
	}
	else{
		$jsonFinal->error = false;
		$jsonFinal->msg = "Google";
	}
}
else{
	$jsonFinal->msg = 'No se encontraron campos.';
}

#FINAL
echo json_encode($jsonFinal, JSON_PRETTY_PRINT);
return json_encode($jsonFinal, JSON_PRETTY_PRINT);