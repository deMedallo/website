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
			$userInfo->wallets->DM->balance++;
			
			
			$update_last_activity = crearSQL("UPDATE ".TBL_USER." SET last_activity=? where id='{$token[0]}'", array(date("Y-m-d H:i:s")));
			
			if(isset($update_last_activity->error) && $update_last_activity->error == false){
				$update_balance = crearSQL("UPDATE ".TBL_WALLET." SET balance=? WHERE coin='{$userInfo->wallets->DM->coin_id}' AND address='{$userInfo->wallets->DM->address}' ",array($userInfo->wallets->DM->balance));
				
				if(isset($update_balance->error) && $update_balance->error == false){
					$jsonFinal->error = false;
					$jsonFinal->data = $userInfo->wallets->DM->balance;
				}else{
					$jsonFinal->data = "000";
				}
			}else{
				$jsonFinal->data = "00";
			}
		}else{
			$jsonFinal->data = "0";
		}
	}else{
		$jsonFinal->data = "Token invalido.";
	}
}else{
	
}

#FINAL
echo json_encode($jsonFinal, JSON_PRETTY_PRINT);
return json_encode($jsonFinal, JSON_PRETTY_PRINT);