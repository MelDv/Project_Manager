<?php

$routes->get('/', function() {
    HelloWorldController::etusivu();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/omasivu', function() {
    HelloWorldController::omasivu();
});

$routes->get('/omattehtavat', function() {
    HelloWorldController::omatTehtavat();
});

$routes->get('/projektit', function() {
    HelloWorldController::projektit();
});

$routes->get('/projektit/1', function() {
    HelloWorldController::projekti();
});

$routes->get('/tehtava', function() {
    HelloWorldController::tehtava();
});

$routes->get('/kirjaudu', function() {
    HelloWorldController::kirjaudu();
});

$routes->get('/muokkaa_omasivu', function() {
    HelloWorldController::muokkaa_omasivu();
});