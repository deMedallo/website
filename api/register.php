<?php 
header('Content-Type: application/json');
include('../_cms/autoload.php');

$jsonFinal = new stdClass();
$jsonFinal->error = true;
$jsonFinal->fields = $datos;
$jsonFinal->data = null;
$jsonFinal->msg = null;

if(
	isset($datos->name)
	&& isset($datos->nick)
	&& isset($datos->email)
	&& isset($datos->pass1)
	&& isset($datos->pass2)
	&& isset($datos->adcopy_challenge) 
	&& isset($datos->adcopy_response)
){
	
	$privkey="ZS4BVFroH0hYurbHdFnSMxBv1p306n3i";
	$hashkey="-EdHgD5NSwdD-5dNNmz8mG0eqsfqtL9W";
	$solvemedia_response = solvemedia_check_answer($privkey,
						$_SERVER["REMOTE_ADDR"],
						$datos->adcopy_challenge,
						$datos->adcopy_response,
						$hashkey);
	if (!$solvemedia_response->is_valid) {
		$jsonFinal->msg = "El Captcha no es valido intente nuevamente.";
	}
	else {
		if($datos->pass1 !== $datos->pass2){
			$jsonFinal->msg = ('las contraseñas no coinciden, intente nuevamente.');
		}else{
			$datos->name = (string) $datos->name;
			$datos->nick = stringParse($datos->nick);
			$datos->email = (string) $datos->email;
			$datos->pass1 = (string) $datos->pass1;
			$datos->hash = md5($datos->pass1);
			
			$create = crearSQL("INSERT INTO ".TBL_USER." ( name, nick, mail, hash ) VALUES (?,?,?,?)",array(
				$datos->name
				, $datos->nick
				, $datos->email
				, $datos->hash
			));
			
			if(isset($create->error) && $create->error == false){
				$session = UserForId($create->last_id);
				$createW = crearSQL("INSERT INTO ".TBL_WALLET." ( userid, address, coin ) VALUES (?,?,?)",array(
					$session->id
					, createWalletDM($session->id, $session->nick)
					, 1
				));
				
				
				if(isset($createW->error) && $createW->error == false){
					$jsonFinal->msg = "Cuenta creada con exito correctos.";
					$jsonFinal->error = false;
					$jsonFinal->data = $session;
				}else{
					$jsonFinal->msg = 'No se creo la billetera deMedallo contacte con soporte...';
				}
			}else{
				$jsonFinal->msg = 'No se creo la cuenta intente nuevamente';
			}
		}
	}
}

else{
	$jsonFinal->msg = 'No se encontraron campos.';
}

#FINAL
echo json_encode($jsonFinal, JSON_PRETTY_PRINT);
return json_encode($jsonFinal, JSON_PRETTY_PRINT);