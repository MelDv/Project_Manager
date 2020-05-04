<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use \Zeuxisoo\Whoops\Slim\WhoopsMiddleware;
use \Slim\Slim;

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
define('BASE_PATH', 'http://webprojectmanager.herokuapp.com' . $base_folder);

// Luodaan uusi tai palautetaan olemassaoleva sessio
if (session_id() == '') {
    session_start();
}

// Asetetaan vastauksen Content-Type-otsake, jotta ääkköset näkyvät normaalisti
header('Content-Type: text/html; charset=utf-8');

// Otetaan Composer käyttöön
require 'vendor/autoload.php';

//require __DIR__ . '/../vendor/autoload.php';

$routes = AppFactory::create();
$routes->add(new WhoopsMiddleware());
$routes->get('/cowsay', function () use ($routes) {
    $routes['monolog']->addDebug('cowsay');
    return "<pre>" . \Cowsayphp\Cow::say("Cool beans") . "</pre>";
});
$routes->setBasePath('http://webprojectmanager.herokuapp.com');
// Otetaan reitit käyttöön
require 'config/routes.php';

$routes->run();
