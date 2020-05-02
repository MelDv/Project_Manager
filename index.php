<?php

// Laitetaan virheilmoitukset näkymään
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Selvitetään, missä kansiossa index.php on
$script_name = $_SERVER['SCRIPT_NAME'];
$explode = explode('/', $script_name);

if ($explode[1] == 'index.php') {
    $base_folder = '';
} else {
    $base_folder = $explode[1];
}

// Määritetään sovelluksen juuripolulle vakio BASE_PATH
define('BASE_PATH', '/' . $base_folder);

// Luodaan uusi tai palautetaan olemassaoleva sessio
if (session_id() == '') {
    session_start();
}

// Asetetaan vastauksen Content-Type-otsake, jotta ääkköset näkyvät normaalisti
header('Content-Type: text/html; charset=utf-8');

// Otetaan Composer käyttöön
require 'vendor/autoload.php';
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

use \Zeuxisoo\Whoops\Slim\WhoopsMiddleware;
use \Slim\Slim;

$routes = new \Slim\Slim();
$routes->add(new WhoopsMiddleware());

$routes->get('/tietokantayhteys', function() {
    DB::test_connection();
});

// Otetaan reitit käyttöön
require 'config/routes.php';
require 'kint.phar';

$routes->run();
