<?php 
use AdinanCenci\RadioBrowser\RadioBrowserApi;

//-----------------------------

error_reporting(E_ALL);
ini_set('display_errors', 1);

//-----------------------------

require '../vendor/autoload.php';

//-----------------------------

$browser    = new RadioBrowserApi(false, 'xml');
$orderBy    = 'clickcount';
$reverse    = true; // ( decrescent )
$hideBroken = false;
$offset     = 0;
$limit      = 10;
$data       = $browser->getStations($orderBy, $reverse, $hideBroken, $offset, $limit);

header ("Content-Type:text/xml");
echo $data;