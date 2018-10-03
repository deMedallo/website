<?php 
	$_GET['type'] = 'Download';
header('Content-Type: application/json');
$app = include_once('YouTube-Downloader/bootstrap.php');
$app->runWithRoute('results');