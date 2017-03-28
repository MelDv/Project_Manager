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

$routes->get('/projektit/:id', function() {
    HelloWorldController::projekti($id);
});

$routes->get('/tehtava', function() {
    HelloWorldController::tehtava();
});


//PersonController

$routes->get('/kirjaudu', function() {
    HelloWorldController::kirjaudu();
});

$routes->get('/muokkaa_omasivu', function() {
    HelloWorldController::muokkaa_omasivu();
});

$routes->get('/uusikayttaja', function() {
    HelloWorldController::uusikayttaja();
});

$routes->get('/muokkaa', function() {
    HelloWorldController::muokkaa();
});

$routes->get('/muokkaa', function() {
    PersonController::muokkaa_hlotietoja($id);
});

$routes->get('/kayttajat', function() {
    PersonController::index();
});

$routes->get('/kayttajat', function() {
    PersonController::kayttajat();
});

$routes->get('/kayttaja/:id', function() {
    PersonController::omasivu($id);
});
