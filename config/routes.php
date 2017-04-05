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

$routes->get('/kayttajat/', function() {
    PersonController::index();
});

$routes->get('/kayttajat/:id/omasivu', function($id) {
    PersonController::omasivu($id);
});

//muokkaaminen
$routes->post('/kayttajat/:id/muokkaa_omasivu', function($id) {
    PersonController::muokkaa_oma($id);
});

$routes->post('/kayttajat/:id/muokkaa', function($id) {
    PersonController::muokkaa_oma($id);
});

//muokkaussivujen näyttäminen
$routes->get('/kayttajat/:id/muokkaa_omasivu', function($id) {
    PersonController::muokkaa_omasivu($id);
});

$routes->get('/kayttajat/:id/muokkaa', function($id) {
    PersonController::muokkaa_hlotietoja($id);
});

//käyttäjän lisääminen
$routes->post('/kayttajat', function() {
    PersonController::uusi();
});

$routes->post('/kayttajat/:id/poista', function($id) {
    PersonController::poista_kayttaja($id);
});

//lisäyslomake
$routes->get('/kayttajat/uusikayttaja', function() {
    PersonController::uusikayttaja();
});


$routes->post('kayttajat/:id', function($id) {
    PersonController::muokkaa_oma($id);
});

$routes->get('/omattehtavat', function() {
    HelloWorldController::omatTehtavat();
});
$routes->get('/kayttajat/:id', function($id) {
    PersonController::omasivu($id);
});
