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
		$userInfo->last_activity;
		if(strtotime($userInfo->last_activity) < strtotime(date('Y-m-d H:i:s'))){
			$update_last_activity = crearSQL("UPDATE ".TBL_USER." SET last_activity=? where id='{$token[0]}'", array(date("Y-m-d H:i:s")));
		
			if(isset($update_last_activity->error) && $update_last_activity->error == false){
				$newTX = newTransaccion(admin_token, 1, $userInfo->wallets->DM->address, 1, 0, '');
				
				$jsonFinal->error = $newTX->error;
				$jsonFinal->data = $newTX;
			}else{ $jsonFinal->data = "00"; }
		}else{ $jsonFinal->msg = "ya cobraste este segundo"; }
	}else{ $jsonFinal->msg = 'Usuario no existe.'; }
}else{ $jsonFinal->msg = 'No se encontraron token.'; }



#FINAL
echo json_encode($jsonFinal, JSON_PRETTY_PRINT);
return json_encode($jsonFinal, JSON_PRETTY_PRINT);