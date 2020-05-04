<?php

//TaskController
$routes->post('/projektit/:pid/tehtava/:id/lisaatekija', function($pid, $id) {
    TaskController::lisaatekija($pid, $id);
});

$routes->post('/projektit/:pid/tehtava/:id/poistatekija', function($pid, $id){
    TaskController::poistatekija($pid, $id);
});

$routes->post('/projektit/:pid/tehtava/:id/poista', function($pid, $id) {
    TaskController::poista($pid, $id);
});

$routes->post('/projektit/:pid/tehtava/:id/hyvaksy', function($pid, $id) {
    TaskController::hyvaksy($pid, $id);
});

$routes->post('/projektit/:pid/tehtava/:id/hylkaa', function($pid, $id) {
    TaskController::hylkaa($pid, $id);
});

$routes->post('/projektit/:pid/tehtava/:id/valmis', function($pid, $id) {
    TaskController::valmis($id);
});

$routes->post('/projektit/:pid/tehtava/:id/muokkaa', function($pid, $id) {
    TaskController::muokkaatehtava($pid, $id);
});

$routes->post('/projektit/:pid/uusitehtava', function($pid) {
    TaskController::lisaauusi($pid);
});

$routes->get('/projektit/:pid/tehtava/:id/muokkaa', function($pid, $id) {
    TaskController::muokkaa($pid, $id);
});

$routes->get('/projektit/:pid/uusitehtava', function($pid) {
    TaskController::lisaa($pid);
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

$routes->post('/projektit/:pid/poista', function($pid) {
    ProjectController::poista($pid);
});

$routes->post('/projektit/:pid/muokkaa', function($pid) {
    ProjectController::muokkaaprojekti($pid);
});

$routes->get('/projektit/:pid/muokkaa', function($pid) {
    ProjectController::muokkaa($pid);
});

$routes->post('/projektit/uusiprojekti', function() {
    ProjectController::lisaauusi();
});

$routes->get('/projektit/uusi', function() {
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
$routes->post('/kayttajat/:id/muokkaa', function($id) {
    PersonController::muokkaa_kayttaja($id);
});

//muokkaussivun näyttäminen
$routes->get('/kayttajat/:id/muokkaa', function($id) {
    PersonController::muokkaa($id);
});

//kunkin käyttäjän esittelysivu, josta linkki muokkaussivulle
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
