<?php 
header('Content-Type: application/json');
include('../_cms/autoload.php');

$jsonFinal = new stdClass();
$jsonFinal->error = true;
$jsonFinal->fields = $datos;
$jsonFinal->data = null;
$jsonFinal->msg = null;

if(isset($datos->mailornick) && isset($datos->hash) && isset($datos->adcopy_challenge) && isset($datos->adcopy_response)){
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
		$datos->hash = md5($datos->hash);
		$datos->mailornick = stringParse($datos->mailornick);
		
		$checkb = datosSQL("Select * from ".TBL_USER." where mail='{$datos->mailornick}' and hash='{$datos->hash}' OR nick='{$datos->mailornick}' and hash='{$datos->hash}'");
		if(isset($checkb->error) && $checkb->error == false && isset($checkb->data[0])){			
			$session = UserForId($checkb->data[0]['id']);
			
			$jsonFinal->msg = "Datos correctos.";
			$jsonFinal->error = false;
			$jsonFinal->data = $session;
		}else{
			$jsonFinal->msg = "Datos Incorrectos.";
		}
	}
}
else{
	$jsonFinal->msg = 'No se encontraron campos.';
}

#FINAL
echo json_encode($jsonFinal, JSON_PRETTY_PRINT);
return json_encode($jsonFinal, JSON_PRETTY_PRINT);