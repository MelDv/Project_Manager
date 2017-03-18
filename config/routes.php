<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/etusivu', function() {
    HelloWorldController::etusivu();
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