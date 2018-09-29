<?php

/*
	Administrador del Sitio
	admin
	admin@demedallo.com
	W{5$khQ{,##mT8EH
	0x4b9987ccafacb8d8fc08d22bbca797ba
	Initial: 
	631720000000000000000
	
	         
*/

include('models/global.php');

define("DB_SERVER", "localhost");
define("DB_USER", "id7278274_feliphegomez");
define("DB_PASS", "Celeste.0.Samael");
define("DB_NAME", "id7278274_demedallo");

error_reporting(-1);
ini_set('display_errors', 'on');
#setlocale(LC_TIME,"es_CO"); // Configurar Hora para Colombia
#setlocale(LC_TIME, 'es_CO.UTF-8'); // Configurar Hora para Colombia en UTF-8
#date_default_timezone_set('America/Bogota'); // Configurar Zona Horaria
define('site_name', 'deMedallo.com - El mejor contenido al alcance de un clic!'); // Titulo X defecto de la aplicacion
define('site_name_md', 'deMedallo.com'); // Titulo X defecto small
define('folderSitio', '/demedallo/website'); // Ruta de la carpeta del Sitio
define("SERVER_NAME", $_SERVER['SERVER_NAME']); // Definir nombre del servidor
define("SERVER_HOST", $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME']); // Definir nombre del servidor con host -> ORGANIZAR -> $_SERVER['REQUEST_SCHEME'].
#define('url_api', SERVER_HOST.folderAPI); // Definir url de la API

define('url_site', SERVER_HOST.folderSitio); // Definir url del aplicativo/sitio
define('site_author_name', 'FelipheGomez'); // Nombre del desarrollador del Sitio
define('site_author_url', 'wWw.FelipheGomez.Info'); // URL del creador del Sitio
session_set_cookie_params(0, url_site);
session_start(['cookie_lifetime' => 86400,'read_and_close'  => false,]); // 86400 -> 1 Dia /// Tiempo de expiracion de la sesion en el servidor // Lectura y Cierre de la sessio e servidor 
header('Access-Control-Allow-Origin: *'); // Control de acceso Permitir origen de:

############### ---- DEFINIR TABLAS ---- ###############
define('TBL_USER', 'users'); // tabla de 
define('TBL_COIN', 'coins'); // tabla de 
define('TBL_WALLET', 'wallets'); // tabla de 
define('TBL_TRANSACTION', 'transactions'); // tabla de 


### DEFINIR CUENTA PRINCIPAL
define('admin_address', '0x4b9987ccafacb8d8fc08d22bbca797ba'); // Address Site Admin
define('admin_token', 'MTphZG1pbjpjYWMyYWQ1ZTU3NzQ4ZDg3NDgwNzJlZTU5ZWQzMTRmMA=='); // Address Site Admin


/* --------------- FUNCIONES ------------- */
## Consulta SQL SELECT
function datosSQL($sql){
	$rawdata = new stdClass();
	$rawdata->error = true;
	$rawdata->data = array();
	$rawdata->sql = $sql;
	try {
		$conn = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASS);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare($sql); 
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		$result = $stmt->fetchAll();
		$rawdata->error = false;
		if(count($result)>0){
			$rawdata->data = $result;
		}else{
			$rawdata->data = array();
		}
	}
	catch(PDOException $e) { $rawdata->data = "Error: " . $e->getMessage(); }
	$conn = null;	
	return $rawdata;
};

## Consulta SQL INSERT // EJEMPLO -> "INSERT INTO ".TBL_IMAGENES_GLOBAL." ( data ) VALUES (?)"
## Consulta SQL UPDATE // EJEMPLO -> $change = crearSQL("UPDATE ".TBL_CALENDARIO." SET trash=? WHERE id='{$data['id']}' ",array(1))
function crearSQL($comando,$array){
	$rawdata = new stdClass();
	$rawdata->error = true;
	$rawdata->last_id = 0;
	$rawdata->sql = $comando;
	try {
		$conn = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$sentencia = $conn->prepare($comando);
		$insert = $sentencia->execute($array);
		$last_id = $conn->lastInsertId();
		if($insert==true){
			$rawdata->error = false;
			$rawdata->last_id = $last_id;
		}else{
			$rawdata->error_message = "Intenta nuevamente";
		}
	}
	catch(PDOException $e)
	{
		$rawdata->error_message = $e->errorInfo;
	}
	$conn = null;
	return $rawdata;
};

## Consulta SQL DELETE
function eliminarSQL($sql){
	$rawdata = new stdClass();
	$rawdata->error = true;
	$rawdata->sql = $sql;
	try {
		$conn = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conn->exec($sql);
		$rawdata->error = false;
	}
	catch(PDOException $e)
	{
		$rawdata->error_message = $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
	return $rawdata;
};

#################### ------------------------------------- ------------------------------------- ####################
function createToken($id, $nick, $hash){
	return base64_encode($id.':'.$nick.':'.$hash);
}

function decodeToken($token){
	return explode(':', base64_decode($token));
}

function createWalletDM($id, $nick){
	return '0x'.md5($id.':'.$nick);
}

# Cargar usuario por ID
function UserForId($userId){
	$userInfo = new UserInfo();
	$result = datosSQL("Select * from ".TBL_USER." where id='{$userId}' ");
	if(isset($result->error) && $result->error == false && isset($result->data[0])){
		$userInfo = new UserInfo($result->data[0]);
	}
	return $userInfo;
}

# Cargar moneda por ID
function CoinForId($coin_id){
	$coinInfo = new CoinInfo();
	$result = datosSQL("Select * from ".TBL_COIN." where id='{$coin_id}' ");
	if(isset($result->error) && $result->error == false && isset($result->data[0])){
		$coinInfo = new CoinInfo($result->data[0]);
	}
	return $coinInfo;
}

function loadWallets($userId){
	$walletInfo = new stdClass();
	$result = datosSQL("Select ".TBL_WALLET.".address as address, ".TBL_WALLET.".coin as coin_id, ".TBL_WALLET.".balance as balance, ".TBL_COIN.".name As name, ".TBL_COIN.".symbol As symbol, ".TBL_COIN.".decimals As decimals from ".TBL_WALLET." INNER JOIN ".TBL_COIN." ON ".TBL_COIN.".id = ".TBL_WALLET.".coin AND ".TBL_WALLET.".userid='{$userId}'");
	if(isset($result->error) && $result->error == false && isset($result->data[0])){
		foreach($result->data As $symbol=>$object){
			$walletInfo->{$object['symbol']} = new BalanceWallet($object);
		}
	}
	return $walletInfo;
}

function convertInFloat($balance, $decimals){
	if($balance>0){ $float = ($balance / (1**$decimals)); }
	else { $float = 0; }
	return number_format($float,$decimals,'.','');
}

function loadWalletOne($address, $coin){
	$walletInfo = new BalanceWallet();
	$result = datosSQL("Select ".TBL_WALLET.".address as address, ".TBL_WALLET.".coin as coin_id, ".TBL_WALLET.".balance as balance, ".TBL_COIN.".name As name, ".TBL_COIN.".symbol As symbol, ".TBL_COIN.".decimals As decimals from ".TBL_WALLET." INNER JOIN ".TBL_COIN." ON ".TBL_WALLET.".coin='{$coin}' AND ".TBL_WALLET.".address='{$address}'");
	if(isset($result->error) && $result->error == false && isset($result->data[0])){
		$walletInfo = new BalanceWallet($result->data[0]);
	}	
	return $walletInfo;
}


#################### ------------------------------------- ------------------------------------- ####################
# Check si la session existe.
function checkSession(){
	if(!isset($_SESSION['token']) || !isset($_SESSION['id']) || !isset($_SESSION['nick'])){ return false; }
	else{ return true; }
}

function createTX_DM(){
	$reference = sha1(md5(time()));
	$uniqid = (uniqid('1'.time()));
	return '0x'.$reference.$uniqid;
}

function newTransaccion($token, $coinId, $to, $value=0, $fee=0, $data=''){
	$coin = CoinForId($coinId);
	$token = decodeToken($token);
	$userInfo = UserForId($token[0]);
	
	$sendr = new stdClass();
	$sendr->error = true;
	$sendr->id = (int) 0;
	$sendr->tx = (string) createTX_DM();
	$sendr->from = "";
	$sendr->to = (string) $to;
	$sendr->value = (double) $value;
	$sendr->fee = (double) $fee;
	$sendr->data = (string) $data;
	$sendr->balance_from = 0;
	$sendr->balance_to = 0;
	
	if(isset($userInfo->wallets->{$coin->symbol})){
		$sendr->from = (string) $userInfo->wallets->{$coin->symbol}->address;
		
		$wallet_from = loadWalletOne($sendr->from, $coin->id);
		$wallet_to = loadWalletOne($sendr->to, $coin->id);
			
		$sendr->balance_from = $wallet_from->balance;
		$sendr->balance_to = $wallet_to->balance;
		
		
		if($wallet_from->address !== $wallet_to->address){
			$new_balance_from = $wallet_from->balance - ($sendr->value + $sendr->fee);
			$new_balance_to = $wallet_to->balance + $sendr->value;
			if(isset($wallet_from->balance) && $wallet_from->balance >= ($sendr->value + $sendr->fee)){				
				$update_last_activity = crearSQL("UPDATE ".TBL_USER." SET last_activity=? where id='{$token[0]}'", array(date("Y-m-d H:i:s")));
				
				if(isset($update_last_activity->error) && $update_last_activity->error == false){
					$update_balace_from = crearSQL("UPDATE ".TBL_WALLET." SET balance=? WHERE address='{$sendr->from}' AND coin='{$coin->id}' ",array(
						$new_balance_from
					));
						
					if(isset($update_balace_from->error) && $update_balace_from->error == false){
						$sendr->balance_from = $new_balance_from;
						$update_balace_to = crearSQL("UPDATE ".TBL_WALLET." SET balance=? WHERE address='{$sendr->to}' AND coin='{$coin->id}' ",array(
							$new_balance_to
						));
						if(isset($update_balace_to->error) && $update_balace_to->error == false){
							$sendr->balance_to = $new_balance_to;
							$create = crearSQL("INSERT INTO ".TBL_TRANSACTION." ( `tx`, `from`, `to`, `value`, `fee`, `data`, `coin` ) VALUES (?,?,?,?,?,?,?)",array(
								$sendr->tx
								, $sendr->from
								, $sendr->to
								, $sendr->value
								, $sendr->fee
								, $sendr->data
								, $coin->id
							));
							
							if(isset($create->error) && $create->error == false){
								$sendr->error = false;
								$sendr->id = $create->last_id;
								
								
							}
						}
					}
				}
				

			}
		}
	}
	return $sendr;
}


function lastTx($address, $coin_id=0, $limit=8, $order='DESC'){
	$resultArray = array();
	$result = datosSQL("Select * from ".TBL_TRANSACTION." where `from`='{$address}' AND `coin`='{$coin_id}' OR `to`='{$address}' AND `coin`='{$coin_id}' ORDER BY id {$order} LIMIT {$limit}");
	if(isset($result->error) && $result->error == false && isset($result->data[0])){
		foreach($result->data As $tx){
			$resultArray[] = new TransferInfo($tx);
		}
	}
	
	return $resultArray;
}

function TransferForTx($tx){
	$resultado = new TransferInfo();
	$result = datosSQL("Select * from ".TBL_TRANSACTION." where `tx`='{$tx}'");
	if(isset($result->error) && $result->error == false && isset($result->data[0])){
		$resultado = new TransferInfo($result->data[0]);
	}
	
	return $resultado;
}













