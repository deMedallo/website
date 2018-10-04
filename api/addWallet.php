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
		if(
			isset($datos->adcopy_challenge)
			&& isset($datos->adcopy_response)
		){
			$privkey="ZS4BVFroH0hYurbHdFnSMxBv1p306n3i";
			$hashkey="-EdHgD5NSwdD-5dNNmz8mG0eqsfqtL9W";
			$solvemedia_response = solvemedia_check_answer($privkey,
								$_SERVER["REMOTE_ADDR"],
								$datos->adcopy_challenge,
								$datos->adcopy_response,
								$hashkey);
			if (!$solvemedia_response->is_valid) { $jsonFinal->msg = "El Captcha no es valido intente nuevamente."; }
			else {
				if(isset($datos->coin_id) && isset($datos->address)){
					$coinInfo = CoinForId($datos->coin_id);
					if($coinInfo->id > 0){
						if($coinInfo->symbol == 'DM'){
							$datos->address = createWalletDM($userInfo->id, $userInfo->nick);
						}
						
						$createW = crearSQL("INSERT INTO ".TBL_WALLET." ( userid, address, coin ) VALUES (?,?,?)",array(
							$userInfo->id
							, $datos->address
							, $coinInfo->id
						));
						
						if(isset($createW->error) && $createW->error == false){
							$jsonFinal->msg = "Billetera agregada con exito.";
							$jsonFinal->error = false;
							$jsonFinal->data = $datos->address;
						}else{
							$jsonFinal->msg = 'No se creo la billetera...';
						}
					}else{ $jsonFinal->msg = 'Esta moneda no esta permitida.'; }
				}else{ $jsonFinal->msg = 'Campos Invalidos.'; }
			}
		}else{ $jsonFinal->msg = 'Falta Captcha.'; }
	}else{ $jsonFinal->msg = 'Token Invalido.'; }
}else{ $jsonFinal->msg = 'No existe Token.'; }


#FINAL
echo json_encode($jsonFinal, JSON_PRETTY_PRINT);
return json_encode($jsonFinal, JSON_PRETTY_PRINT);