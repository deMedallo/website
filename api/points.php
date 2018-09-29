<?php 

header('Content-Type: application/json');
include('../_cms/autoload.php');

$jsonFinal = new stdClass();
$jsonFinal->error = true;
$jsonFinal->data = null;

if(
	isset($_GET['token'])
){
	$token = decodeToken($_GET['token']);
	$userInfo = UserForId($token[0]);
	
	if($userInfo->id > 0){
		$userInfo->last_activity;
		if(strtotime($userInfo->last_activity) < strtotime(date('Y-m-d H:i:s'))){
			$newTX = newTransaccion(admin_token, 1, $userInfo->wallets->DM->address, 1, 0, '');
			
			$jsonFinal->dataTx = $newTX;
			$jsonFinal->error = $jsonFinal->dataTx->error;
			$jsonFinal->data = $jsonFinal->dataTx->balance_to;
		}else{ $jsonFinal->data = "0"; }
	}else{ $jsonFinal->data = "Token invalido."; }
}else{ }

#FINAL
echo json_encode($jsonFinal, JSON_PRETTY_PRINT);
return json_encode($jsonFinal, JSON_PRETTY_PRINT);