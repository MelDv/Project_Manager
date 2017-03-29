<?php

$routes->get('/', function() {
    HelloWorldController::etusivu();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/projektit', function() {
    HelloWorldController::projektit();
});

$routes->get('/projektit/:id', function($id) {
    HelloWorldController::projekti($id);
});

$routes->get('/tehtava', function() {
    HelloWorldController::tehtava();
});


//PersonController

$routes->get('/kirjaudu', function() {
    HelloWorldController::kirjaudu();
});

$routes->get('/kayttajat', function() {
    PersonController::index();
});

$routes->get('/omasivu', function($id) {
    PersonController::omasivu($id);
});

$routes->get('/kayttajat/:id/muokkaa', function($id) {
    PersonController::muokkaa_hlotietoja($id);
});

$routes->post('/kayttajat', function() {
    PersonController::uusi();
});

$routes->get('/kayttajat/uusikayttaja', function() {
    PersonController::uusikayttaja();
});

$routes->get('/kayttajat/:id', function($id) {
    PersonController::omasivu($id);
});

$routes->get('/muokkaa_omasivu', function() {
    PersonController::muokkaa_omasivu();
});

$routes->get('/omattehtavat', function() {
    HelloWorldController::omatTehtavat();
});
