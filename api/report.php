<?php 

header('Content-Type: application/json');
include('../_cms/autoload.php');


$jsonFinal = new stdClass();
$jsonFinal->error = true;
$jsonFinal->data = null;


if(
	isset($_GET['token'])
){
	$demo = UserForId($_SESSION['id']);
	$Wallets = $demo->wallets;
	$chart = new stdClass();
	
	foreach($Wallets As $W=>$item){
		$dt = new DateTime();
		$today = $dt->format('Y-m-d H:i:s');
		
		$old = strtotime('-1 month', strtotime($today));
		$old = date('Y-m-d H:i:s', $old);
		
		
		$data_enable = true;
		if(isset($_GET['data_enable']) && $_GET['data_enable'] == false){ $data_enable = false; };
		
		$chart->{$item->symbol} = ChartTxWallet($item->address, $item->coin_id, $today, $old, $data_enable);
	}
	
	
	$jsonFinal->data = $chart;
	$jsonFinal->error = false;
}

#FINAL
echo json_encode($jsonFinal, JSON_PRETTY_PRINT);
return json_encode($jsonFinal, JSON_PRETTY_PRINT);