<?php 
/**
 * Search states by name
 */

use AdinanCenci\RadioBrowser\RadioBrowser;

//-----------------------------

error_reporting(E_ALL);
ini_set('display_errors', 1);

//-----------------------------

require '../vendor/autoload.php';

//-----------------------------

$browser    = new RadioBrowser();
$filter     = 'Texas';
$country    = '';
$orderBy    = 'name';
$reverse    = true; // ( decrescent )
$hideBroken = false;
$offset     = 0;
$limit      = 50;
$data       = $browser->getStates($filter, $country, $orderBy, $reverse, $hideBroken);

echo '<pre>';
print_r($data);
echo '</pre>';
