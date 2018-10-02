<?php

include('config/config.php');
include('lib/solvemedialib.php');


$method = $_SERVER["REQUEST_METHOD"];
$datos = null;

switch ($method) {
  case 'GET':
    $datos = $_GET;
	break;
  case 'PUT':
    $datos = $_PUT;
	break;
  case 'POST':
    $datos = ($_POST);
	break;
  case 'DELETE':
    $datos = $_DELETE;
	break;
  default:
	break;
}

$datos = json_decode(json_encode($datos));