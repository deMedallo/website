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
define('folderSitio', '/website'); // Ruta de la carpeta del Sitio
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


# Definir Intervalos API Points
define('intervalPoints', 1); // Segundos
define('pointsForSeconds', 1); // Puntos X Segundo

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

function stringParse($s){
	$r = (string) $s;
	$r = strtolower($r);
	return $r;
}

function createToken($id, $nick, $hash){
	$nick = stringParse($nick);
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

# Cargar moneda por Symbol
function CoinForSymbol($coin_symbol){
	$coinInfo = new CoinInfo();
	$result = datosSQL("Select * from ".TBL_COIN." where symbol='{$coin_symbol}' ");
	if(isset($result->error) && $result->error == false && isset($result->data[0])){
		$coinInfo = new CoinInfo($result->data[0]);
	}
	return $coinInfo;
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

function CoinList(){
	$coinsList = array();
	$result = datosSQL("Select * from ".TBL_COIN." ");
	if(isset($result->error) && $result->error == false && isset($result->data[0])){
		foreach($result->data As $currency){
			$coinsList[] = new CoinInfo($currency);
		}
	}
	return $coinsList;
}

function CoinListSelected(){
	$coinsList = array();
	$result = datosSQL("Select * from ".TBL_COIN." ");
	if(isset($result->error) && $result->error == false && isset($result->data[0])){
		foreach($result->data As $currency){
			$item = new stdClass();
			$item->text = $currency['symbol'].' - '.$currency['name'];
			$item->value = $currency['id'];
			$item->symbol = $currency['symbol'];
			$coinsList[] = $item;
		}
	}
	return $coinsList;
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
	$result = datosSQL("Select ".TBL_WALLET.".address as address, ".TBL_WALLET.".coin as coin_id, ".TBL_WALLET.".balance as balance, ".TBL_COIN.".name As name, ".TBL_COIN.".symbol As symbol, ".TBL_COIN.".decimals As decimals from ".TBL_WALLET." INNER JOIN ".TBL_COIN." ON ".TBL_WALLET.".coin='{$coin}' AND ".TBL_WALLET.".address='{$address}' AND ".TBL_COIN.".id='{$coin}'");
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

function ChartTxWallet($wallet, $coinId, $start, $end, $enable_data=true){
	$resultArray = array();
	$result = datosSQL("Select * from ".TBL_TRANSACTION." where `from`='{$wallet}' AND `coin`='{$coinId}' and `create` >= ('{$end}') OR `to`='{$wallet}' AND `coin`='{$coinId}' and `create` >= ('{$end}') OR `from`='{$wallet}' AND `coin`='{$coinId}' and `create` <= ('{$start}') OR `to`='{$wallet}' AND `coin`='{$coinId}' AND `create` <= ('{$start}')");
	
	$chart = new stdClass();
	$chart->labels = array();
	$chart->data = array();
	$chart->complete = new stdClass();
	if(isset($result->error) && $result->error == false && isset($result->data[0])){
		foreach($result->data As $tx){
			$tx = new TransferInfo($tx);
			$resultArray[] = ($tx);
			
			$day = date('Y-m-d', strtotime($tx->create));
			
			if(isset($chart->complete->{$day})){
				$chart->complete->{$day}->total++;
				$chart->complete->{$day}->data[] = $tx;
			}else{
				$chart->complete->{$day} = new stdClass();
				$chart->complete->{$day}->label = $day;
				$chart->complete->{$day}->total = 1;
				$chart->complete->{$day}->data = array();
				$chart->complete->{$day}->data[] = $tx;
			}
		}
		
		foreach($chart->complete As $k=>$obj){
			$chart->labels[] = $obj->label;
			$chart->data[] = $obj->total;
		}
	}
	if($enable_data == false){ unset($chart->complete); }
	return $chart;
}

function loadWalletsCoin($coinId){
	$walletsInfo = array();
	$result = datosSQL("Select ".TBL_WALLET.".address as address, ".TBL_WALLET.".coin as coin_id, ".TBL_WALLET.".balance as balance, ".TBL_COIN.".name As name, ".TBL_COIN.".symbol As symbol, ".TBL_COIN.".decimals As decimals from ".TBL_WALLET." INNER JOIN ".TBL_COIN." ON ".TBL_WALLET.".coin='{$coinId}' group by ".TBL_WALLET.".id");
	if(isset($result->error) && $result->error == false && isset($result->data[0])){
		
		foreach($result->data As $object){
			$walletsInfo[] = new BalanceWallet($object);
		}
	}	
	return $walletsInfo;
}

function totalSendWallet($address, $coin_id=0){
	$r = new stdClass();
	$r->value = 0;
	$r->total = 0;
	$result = datosSQL("Select * from ".TBL_TRANSACTION." where `from`='{$address}' AND `coin`='{$coin_id}'  ");
	if(isset($result->error) && $result->error == false && isset($result->data[0])){
		$r->total = count($result->data);
		foreach($result->data As $e){
			$e['value'] = (double) $e['value'];
			$r->value = $r->value+$e['value'];
		}
	}
	return $r;
}

function totalRecibeWallet($address, $coin_id=0){
	$r = new stdClass();
	$r->value = 0;
	$r->total = 0;
	$result = datosSQL("Select * from ".TBL_TRANSACTION." where `to`='{$address}' AND `coin`='{$coin_id}' ");
	if(isset($result->error) && $result->error == false && isset($result->data[0])){
		$r->total = count($result->data);
		foreach($result->data As $e){
			$e['value'] = (double) $e['value'];
			$r->value = $r->value+$e['value'];
		}
	}
	return $r;
}

function rateCurrency($coinFrom, $coinTo){
	$r = 0;
	# LISTADO COMPLETO
	# https://api.coinmarketcap.com/v2/listings/
	
	$coin1 = 0;
	$coin2 = $coinTo;
	if($coinFrom == 'WEB' || $coinFrom == 'DM'){ $coin1 = 3361; }
	else if($coinFrom == 'XMR'){ $coin1 = 328; }
	
	
	if($coinTo == 'DM'){ $coin2 = 'WEB'; }
	
	
	
	$url_datosDM = "https://api.coinmarketcap.com/v2/ticker/{$coin1}/?convert={$coin2}";
	$datosDM = json_decode(@file_get_contents($url_datosDM));


	if($coinFrom == 'DM'){
		$datosDM->data->quotes->{$coin2}->price = (float) $datosDM->data->quotes->{$coin2}->price / (1000000);	
	}
	if($coinTo == 'DM'){
		$datosDM->data->quotes->{$coin2}->price = (float) $datosDM->data->quotes->{$coin2}->price * (1000000);	
	}
	
	
	if(isset($datosDM->data->quotes->{$coin2}->price)){
		$r = $datosDM->data->quotes->{$coin2}->price;
	}
	return $r;
}

function getDifficulty(){
	#webchain.miningpoolhouse.com ALTER
	$opts = array(
		'http'=>array(
			'header'=>"Host: pool.webchain.network",
			'user_agent'=>"My Custom User Agent"
		)
	);
	$context = stream_context_create($opts);

	$file = json_decode(@file_get_contents('https://pool.webchain.network/api/stats', false, $context));
	if(isset($file->nodes[0])){
		return (int) $file->nodes[0]->difficulty;
	}else{
		return 0;
	}
	
}

function calculateHash(){
	# 0.000000077527708 BASE
	return (0.000000077527708*getDifficulty());
}



class WalletValidator
{
	var $address = '';
	
    public function isAddress(): bool
    {
        if ($this->matchesPattern($this->address)) {
            return $this->isAllSameCaps($this->address) ?: $this->isValidChecksum($this->address);
        }

        return false;
    }

    protected function matchesPattern(): int
    {
        return preg_match('/^(0x)?[0-9a-f]{32}$/i', $this->address);
    }

    protected function isAllSameCaps(): bool
    {
        return preg_match('/^(0x)?[0-9a-f]{32}$/', $this->address) || preg_match('/^(0x)?[0-9A-F]{32}$/', $this->address);
    }

    protected function isValidChecksum()
    {
        $address = str_replace('0x', '', $this->address);
		
        for ($i = 0; $i < 32; $i++ ) {
            if (ctype_alpha($address{$i})) {
                $charInt = intval($hash{$i}, 16);
                if ((ctype_upper($address{$i}) && $charInt <= 7) || (ctype_lower($address{$i}) && $charInt > 7)) {
                    return false;
                }
            }
        }

        return true;
    }
	
	function __construct(string $address) {
	   $this->address = $address;
	}
}

class TxValidator
{
	var $tx = '';
	
    public function isTx(): bool
    {
        if ($this->matchesPattern($this->tx)) {
            return $this->isAllSameCaps($this->tx) ?: $this->isValidChecksum($this->tx);
        }

        return false;
    }

    protected function matchesPattern(): int
    {
        return preg_match('/^(0x)?[0-9a-f]{64}$/i', $this->tx);
    }

    protected function isAllSameCaps(): bool
    {
        return preg_match('/^(0x)?[0-9a-f]{64}$/', $this->tx) || preg_match('/^(0x)?[0-9A-F]{64}$/', $this->tx);
    }

    protected function isValidChecksum()
    {
        $tx = str_replace('0x', '', $this->tx);
		
        for ($i = 0; $i < 64; $i++ ) {
            if (ctype_alpha($tx{$i})) {
                $charInt = intval($hash{$i}, 16);
                if ((ctype_upper($tx{$i}) && $charInt <= 7) || (ctype_lower($tx{$i}) && $charInt > 7)) {
                    return false;
                }
            }
        }

        return true;
    }
	
	function __construct(string $tx) {
	   $this->tx = $tx;
	}
}


