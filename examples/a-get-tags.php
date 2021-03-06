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
$data       = $browser->getTags($filter, $orderBy, $reverse);

echo '<pre>';
print_r($data);
echo '</pre>';
