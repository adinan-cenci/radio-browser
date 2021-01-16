<?php 
use AdinanCenci\RadioBrowser\RadioBrowser;

//-----------------------------

error_reporting(E_ALL);
ini_set('display_errors', 1);

//-----------------------------

require '../vendor/autoload.php';

//-----------------------------

$browser    = new RadioBrowser();
$filter     = 'Campinas';
$country    = '';
$orderBy    = 'name';
$reverse    = true; // ( decrescent )
$hideBroken = false;
$offset     = 0;
$limit      = 50;
$json       = $browser->getStates($filter, $orderBy, $reverse, $hideBroken, $country);
$data       = json_decode($json, true);

echo '<pre>';
print_r($data);
echo '</pre>';
