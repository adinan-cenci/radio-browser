<?php 
use AdinanCenci\RadioBrowser\RadioBrowser;

//-----------------------------

error_reporting(E_ALL);
ini_set('display_errors', 1);

//-----------------------------

require '../vendor/autoload.php';

//-----------------------------

$browser    = new RadioBrowser();
$country    = 'Brazil';
$orderBy    = 'clickcount';
$reverse    = true; // ( decrescent )
$hideBroken = false;
$offset     = 0;
$limit      = 10;
$data       = $browser->getStationsByCountry($country, $orderBy, $reverse, $hideBroken, $offset, $limit);

echo '<pre>';
print_r($data);
echo '</pre>';
