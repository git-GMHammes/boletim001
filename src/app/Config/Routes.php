<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('exemple', function ($routes) {
    $routes->group('group', function ($routes) {
        # www/exemple/group/api/(:any)
        $routes->group('api', function ($routes) {
            # www/exemple/group/api/teste/(:any)
            $routes->get('teste', 'ExampleApiController::onRest');
            $routes->get('teste/(:segment)', 'ExampleApiController::onRest/$1');
            $routes->get('teste/(:any)', 'ExampleApiController::onRest/$1');
            $routes->post('teste', 'ExampleApiController::onRest');
            $routes->post('teste/(:any)', 'ExampleApiController::onRest/$1');
        });
        # www/exemple/group/endpoint/(:any)
        $routes->group('endpoint', function ($routes) {
            # www/exemple/group/endpoint/bom_login/(:any)
            $routes->get('bom_login', 'ExampleEndpointController::bomLogin');
            $routes->get('bom_login/(:segment)', 'ExampleEndpointController::bomLogin/$1');
            $routes->get('bom_login/(:any)', 'ExampleEndpointController::bomLogin/$1');
            $routes->post('bom_login', 'ExampleEndpointController::bomLogin');
            $routes->post('bom_login/(:any)', 'ExampleEndpointController::bomLogin/$1');
            # www/exemple/group/endpoint/bom_main/(:any)
            $routes->get('bom_main', 'ExampleEndpointController::bomMain');
            $routes->get('bom_main/(:segment)', 'ExampleEndpointController::bomMain/$1');
            $routes->get('bom_main/(:any)', 'ExampleEndpointController::bomMain/$1');
            $routes->post('bom_main', 'ExampleEndpointController::bomMain');
            $routes->post('bom_main/(:any)', 'ExampleEndpointController::bomMain/$1');
            # www/exemple/group/endpoint/bom_empresa_filtrar/(:any)
            $routes->get('bom_empresa_filtrar', 'ExampleEndpointController::bomEmpresaFiltro');
            $routes->get('bom_empresa_filtrar/(:segment)', 'ExampleEndpointController::bomEmpresaFiltro/$1');
            $routes->get('bom_empresa_filtrar/(:any)', 'ExampleEndpointController::bomEmpresaFiltro/$1');
            $routes->post('bom_empresa_filtrar', 'ExampleEndpointController::bomEmpresaFiltro');
            $routes->post('bom_empresa_filtrar/(:any)', 'ExampleEndpointController::bomEmpresaFiltro/$1');
            # www/exemple/group/endpoint/bom_empresa_cadasrtar/(:any)
            $routes->get('bom_empresa_cadasrtar', 'ExampleEndpointController::bomEmpresaCadastrar');
            $routes->get('bom_empresa_cadasrtar/(:segment)', 'ExampleEndpointController::bomEmpresaCadastrar/$1');
            $routes->get('bom_empresa_cadasrtar/(:any)', 'ExampleEndpointController::bomEmpresaCadastrar/$1');
            $routes->post('bom_empresa_cadasrtar', 'ExampleEndpointController::bomEmpresaCadastrar');
            $routes->post('bom_empresa_cadasrtar/(:any)', 'ExampleEndpointController::bomEmpresaCadastrar/$1');
            # www/exemple/group/endpoint/bom_linha_filtrar/(:any)
            $routes->get('bom_linha_filtrar', 'ExampleEndpointController::bomLinhaFiltro');
            $routes->get('bom_linha_filtrar/(:segment)', 'ExampleEndpointController::bomLinhaFiltro/$1');
            $routes->get('bom_linha_filtrar/(:any)', 'ExampleEndpointController::bomLinhaFiltro/$1');
            $routes->post('bom_linha_filtrar', 'ExampleEndpointController::bomLinhaFiltro');
            $routes->post('bom_linha_filtrar/(:any)', 'ExampleEndpointController::bomLinhaFiltro/$1');
            # www/exemple/group/endpoint/bom_linha_cadasrtar/(:any)
            $routes->get('bom_linha_cadasrtar', 'ExampleEndpointController::bomLinhaCadastrar');
            $routes->get('bom_linha_cadasrtar/(:segment)', 'ExampleEndpointController::bomLinhaCadastrar/$1');
            $routes->get('bom_linha_cadasrtar/(:any)', 'ExampleEndpointController::bomLinhaCadastrar/$1');
            $routes->post('bom_linha_cadasrtar', 'ExampleEndpointController::bomLinhaCadastrar');
            $routes->post('bom_linha_cadasrtar/(:any)', 'ExampleEndpointController::bomLinhaCadastrar/$1');
            # www/exemple/group/endpoint/bom_veiculo_filtrar/(:any)
            $routes->get('bom_veiculo_filtrar', 'ExampleEndpointController::bomVeiculoFiltro');
            $routes->get('bom_veiculo_filtrar/(:segment)', 'ExampleEndpointController::bomVeiculoFiltro/$1');
            $routes->get('bom_veiculo_filtrar/(:any)', 'ExampleEndpointController::bomVeiculoFiltro/$1');
            $routes->post('bom_veiculo_filtrar', 'ExampleEndpointController::bomVeiculoFiltro');
            $routes->post('bom_veiculo_filtrar/(:any)', 'ExampleEndpointController::bomVeiculoFiltro/$1');
            # www/exemple/group/endpoint/bom_veiculo_cadasrtar/(:any)
            $routes->get('bom_veiculo_cadasrtar', 'ExampleEndpointController::bomVeiculoCadastrar');
            $routes->get('bom_veiculo_cadasrtar/(:segment)', 'ExampleEndpointController::bomVeiculoCadastrar/$1');
            $routes->get('bom_veiculo_cadasrtar/(:any)', 'ExampleEndpointController::bomVeiculoCadastrar/$1');
            $routes->post('bom_veiculo_cadasrtar', 'ExampleEndpointController::bomVeiculoCadastrar');
            $routes->post('bom_veiculo_cadasrtar/(:any)', 'ExampleEndpointController::bomVeiculoCadastrar/$1');
        });
    });
});