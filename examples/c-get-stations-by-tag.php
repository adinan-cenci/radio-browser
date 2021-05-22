<?php 
use AdinanCenci\RadioBrowser\RadioBrowser;

//-----------------------------

error_reporting(E_ALL);
ini_set('display_errors', 1);

//-----------------------------

require '../vendor/autoload.php';

//-----------------------------

$browser    = new RadioBrowser();
$tag        = 'power metal';
$orderBy    = 'clickcount';
$reverse    = true; // ( decrescent )
$hideBroken = false;
$offset     = 0;
$limit      = 50;
$data       = $browser->getStationsByTag($tag, $orderBy, $reverse, $hideBroken, $offset, $limit);

echo '<pre>';
print_r($data);
echo '</pre>';
