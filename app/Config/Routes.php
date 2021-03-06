<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Home::index');

$routes->get('/', 'Usuario::loginUsuario');
$routes->get('/usuario/cadastrar', 'Usuario::mostraCadastroUsuario');
$routes->post('/usuario/cadastrar', 'Usuario::insertUsuario');
$routes->get('/usuario/depositoInicial/(:idUsuario)', 'Usuario::mostraDepositoInicial');
$routes->get('/usuario/logout', 'Usuario::logoutUser');
$routes->post('/usuario/depositoInicial/(:idUsuario)', 'Usuario::depositoInicial');
$routes->post('/usuario/login','Usuario::loginUser');

$routes->get('/dashboard', 'Home::index');
$routes->get('/transacao/pagamento', 'Transacao::mostraPagamento');
$routes->get('/transacao/transferencia', 'Transacao::mostraTransferencia');
$routes->post('/transacao/pagamento', 'Transacao::cadastraPagamento');
$routes->post('/transacao/transferencia', 'Transacao::cadastraTransferencia');
$routes->get('/transacao/resgate/(:idUsuario)', 'Transacao::mostraResgate');
$routes->post('/transacao/resgate', 'Transacao::resgate');
$routes->get('/transacao/aplicacao/(:idUsuario)', 'Transacao::mostraAplicacao');
$routes->post('/transacao/aplicacao', 'Transacao::aplicacao');
$routes->post('/conta/extrato/(:idUsuario)', 'Conta::extrato');
$routes->get('/conta/extratoPoupanca/(:idUsuario)', 'Conta::extratoPoupanca');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
