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
		if(isset($datos->coin_id)){
			$coinInfo = CoinForId($datos->coin_id);
			if($coinInfo->id > 0){
				$address = $userInfo->wallets->{$coinInfo->symbol}->address;
				$coin_id = $userInfo->wallets->{$coinInfo->symbol}->coin_id;
				$deleteW = eliminarSQL("DELETE FROM ".TBL_WALLET." WHERE address='{$address}' AND coin='{$coin_id}'");
				
				if(isset($deleteW->error) && $deleteW->error == false){
					$jsonFinal->msg = "Billetera removida con exito.";
					$jsonFinal->error = false;
					$jsonFinal->data = $address;
				}else{
					$jsonFinal->msg = 'No se elimino la billetera...';
				}
			}else{ $jsonFinal->msg = 'Esta moneda no esta permitida.'; }
		}else{ $jsonFinal->msg = 'Campos Invalidos.'; }
	}else{ $jsonFinal->msg = 'Token Invalido.'; }
}else{ $jsonFinal->msg = 'No existe Token.'; }


#FINAL
echo json_encode($jsonFinal, JSON_PRETTY_PRINT);
return json_encode($jsonFinal, JSON_PRETTY_PRINT);