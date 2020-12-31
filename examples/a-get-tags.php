<?php 
use AdinanCenci\RadioBrowser\RadioBrowser;

//-----------------------------

error_reporting(E_ALL);
ini_set('display_errors', 1);

//-----------------------------

require '../vendor/autoload.php';

//-----------------------------

$browser    = new RadioBrowser();
$filter     = 'metal';
$orderBy    = 'stationcount';
$reverse    = true; // ( decrescent )
$json       = $browser->getTags($filter, $orderBy, $reverse);
$data       = json_decode($json, true);

echo '<pre>';
print_r($data);
echo '</pre>';
