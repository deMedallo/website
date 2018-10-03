<?php 

header('Content-Type: application/json');
include('../_cms/autoload.php');

$jsonFinal = new stdClass();
$jsonFinal->error = true;
$jsonFinal->fields = $datos;
$jsonFinal->data = null;
$jsonFinal->msg = null;

/*
{
  "public": "6996157e2c83a329123cbad342b1aeb8aa073fa1cd8e571c7f4ea71c44f282b1",
  "private": "182780437c7d9047262f445e5e98f17efb127e214dca956b02ab7184bc08f3b4"
}
curl https://www.coinimp.com/api/v2/hashes
        -H 'X-API-ID:6996157e2c83a329123cbad342b1aeb8aa073fa1cd8e571c7f4ea71c44f282b1'
        -H 'X-API-KEY:182780437c7d9047262f445e5e98f17efb127e214dca956b02ab7184bc08f3b4'
*/

if(!isset($_GET['currency']) || $_GET['currency'] == ''){
	$_GET['currency'] = 'WEB';
}
if(!isset($_GET['type']) || $_GET['type'] == ''){
	$_GET['type'] = 'reward';
}

$url = "https://www.coinimp.com/api/v2/{$_GET['type']}?currency={$_GET['currency']}";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	'X-API-ID:6996157e2c83a329123cbad342b1aeb8aa073fa1cd8e571c7f4ea71c44f282b1',
	'X-API-KEY:182780437c7d9047262f445e5e98f17efb127e214dca956b02ab7184bc08f3b4'
));
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($ch);
curl_close($ch);
echo $data;

#FINAL
#echo json_encode($jsonFinal, JSON_PRETTY_PRINT);
#return json_encode($jsonFinal, JSON_PRETTY_PRINT);