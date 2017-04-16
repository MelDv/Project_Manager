<?php

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

//TaskController
$routes->post('/projektit/:pid/tehtava/:id/poista', function($pid, $id) {
    TaskController::poista($id);
});

$routes->post('/projektit/:pid/tehtava/:id/valmis', function($pid, $id) {
    TaskController::valmis($id);
});

$routes->post('/projektit/tehtava/:id/muokkaa', function($id) {
    TaskController::muokkaa($id);
});

$routes->post('/projektit/:id/uusitehtava', function(){
    TaskController::lisaauusi();
});

$routes->get('/projektit/:id/uusitehtava', function() {
    TaskController::lisaa();
});

$routes->get('/projektit/omattehtavat', function() {
    TaskController::index();
});

$routes->get('/projektit/:pid/tehtava/:id', function($pid, $id) {
    TaskController::tehtava($pid, $id);
});

//ProjectController
$routes->get('/', function() {
    ProjectController::etusivu();
});

$routes->get('/projektit/', function() {
    ProjectController::index();
});

$routes->get('projektit/uusi', function() {
    ProjectController::lisaa();
});

$routes->get('/projektit/:id', function($id) {
    ProjectController::projekti($id);
});

//PersonController
//kirjautuminen
$routes->post('/kirjaudu', function() {
    PersonController::kirjaudu_sisaan();
});

$routes->get('/kirjaudu', function() {
    PersonController::kirjaudu();
});

$routes->post('/logout', function() {
    PersonController::kirjaudu_ulos();
});

$routes->get('/kayttajat/', function() {
    PersonController::index();
});

//käyttäjän lisääminen
$routes->post('/uusikayttaja', function() {
    PersonController::uusi();
});

//muokkaaminen
$routes->post('/kayttajat/:id/muokkaa_omasivu', function($id) {
    PersonController::muokkaa_oma($id);
});
$routes->post('/kayttajat/:id/muokkaa', function($id) {
    PersonController::muokkaa_muita($id);
});
//muokkaussivujen näyttäminen
$routes->get('/kayttajat/:id/muokkaa_omasivu', function($id) {
    PersonController::muokkaa_omasivu($id);
});

$routes->get('/kayttajat/:id/muokkaa', function($id) {
    PersonController::muokkaa_hlotietoja($id);
});

$routes->get('/kayttajat/omasivu', function() {
    PersonController::omasivu();
});

//kunkin käyttäjän esittelysivu, josta linkki admin-muokkaussivulle
$routes->get('/kayttajat/:id', function($id) {
    PersonController::esittely($id);
});

$routes->post('/kayttajat/:id/poista', function($id) {
    PersonController::poista_kayttaja($id);
});
//lisäyslomake
$routes->get('/uusikayttaja', function() {
    PersonController::uusikayttaja();
});

$routes->post('kayttajat/:id', function($id) {
    PersonController::muokkaa_oma($id);
});

$routes->get('/omattehtavat', function() {
    HelloWorldController::omatTehtavat();
});
