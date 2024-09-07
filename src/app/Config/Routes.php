<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->addRedirect('/', 'exemple/group/endpoint/bom_login');
$routes->addRedirect('/main', 'exemple/group/endpoint/bom_main');

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
            $routes->get('bom_empresa_filtrar', 'ExampleEndpointController::bomEmpresaFiltrar');
            $routes->get('bom_empresa_filtrar/(:segment)', 'ExampleEndpointController::bomEmpresaFiltrar/$1');
            $routes->get('bom_empresa_filtrar/(:any)', 'ExampleEndpointController::bomEmpresaFiltrar/$1');
            $routes->post('bom_empresa_filtrar', 'ExampleEndpointController::bomEmpresaFiltrar');
            $routes->post('bom_empresa_filtrar/(:any)', 'ExampleEndpointController::bomEmpresaFiltrar/$1');
            # www/exemple/group/endpoint/bom_empresa_cadasrtar/(:any)
            $routes->get('bom_empresa_cadasrtar', 'ExampleEndpointController::bomEmpresaCadastrar');
            $routes->get('bom_empresa_cadasrtar/(:segment)', 'ExampleEndpointController::bomEmpresaCadastrar/$1');
            $routes->get('bom_empresa_cadasrtar/(:any)', 'ExampleEndpointController::bomEmpresaCadastrar/$1');
            $routes->post('bom_empresa_cadasrtar', 'ExampleEndpointController::bomEmpresaCadastrar');
            $routes->post('bom_empresa_cadasrtar/(:any)', 'ExampleEndpointController::bomEmpresaCadastrar/$1');
            # www/exemple/group/endpoint/bom_linha_filtrar/(:any)
            $routes->get('bom_linha_filtrar', 'ExampleEndpointController::bomLinhaFiltrar');
            $routes->get('bom_linha_filtrar/(:segment)', 'ExampleEndpointController::bomLinhaFiltrar/$1');
            $routes->get('bom_linha_filtrar/(:any)', 'ExampleEndpointController::bomLinhaFiltrar/$1');
            $routes->post('bom_linha_filtrar', 'ExampleEndpointController::bomLinhaFiltrar');
            $routes->post('bom_linha_filtrar/(:any)', 'ExampleEndpointController::bomLinhaFiltrar/$1');
            # www/exemple/group/endpoint/bom_linha_cadasrtar/(:any)
            $routes->get('bom_linha_cadasrtar', 'ExampleEndpointController::bomLinhaCadastrar');
            $routes->get('bom_linha_cadasrtar/(:segment)', 'ExampleEndpointController::bomLinhaCadastrar/$1');
            $routes->get('bom_linha_cadasrtar/(:any)', 'ExampleEndpointController::bomLinhaCadastrar/$1');
            $routes->post('bom_linha_cadasrtar', 'ExampleEndpointController::bomLinhaCadastrar');
            $routes->post('bom_linha_cadasrtar/(:any)', 'ExampleEndpointController::bomLinhaCadastrar/$1');
            # www/exemple/group/endpoint/bom_veiculo_filtrar/(:any)
            $routes->get('bom_veiculo_filtrar', 'ExampleEndpointController::bomVeiculoFiltrar');
            $routes->get('bom_veiculo_filtrar/(:segment)', 'ExampleEndpointController::bomVeiculoFiltrar/$1');
            $routes->get('bom_veiculo_filtrar/(:any)', 'ExampleEndpointController::bomVeiculoFiltrar/$1');
            $routes->post('bom_veiculo_filtrar', 'ExampleEndpointController::bomVeiculoFiltrar');
            $routes->post('bom_veiculo_filtrar/(:any)', 'ExampleEndpointController::bomVeiculoFiltrar/$1');
            # www/exemple/group/endpoint/bom_veiculo_cadasrtar/(:any)
            $routes->get('bom_veiculo_cadasrtar', 'ExampleEndpointController::bomVeiculoCadastrar');
            $routes->get('bom_veiculo_cadasrtar/(:segment)', 'ExampleEndpointController::bomVeiculoCadastrar/$1');
            $routes->get('bom_veiculo_cadasrtar/(:any)', 'ExampleEndpointController::bomVeiculoCadastrar/$1');
            $routes->post('bom_veiculo_cadasrtar', 'ExampleEndpointController::bomVeiculoCadastrar');
            $routes->post('bom_veiculo_cadasrtar/(:any)', 'ExampleEndpointController::bomVeiculoCadastrar/$1');
            # www/exemple/group/endpoint/bom_linha_tipo_filtrar/(:any)
            $routes->get('bom_linha_tipo_filtrar', 'ExampleEndpointController::bomLinhaTipoFiltrar');
            $routes->get('bom_linha_tipo_filtrar/(:segment)', 'ExampleEndpointController::bomLinhaTipoFiltrar/$1');
            $routes->get('bom_linha_tipo_filtrar/(:any)', 'ExampleEndpointController::bomLinhaTipoFiltrar/$1');
            $routes->post('bom_linha_tipo_filtrar', 'ExampleEndpointController::bomLinhaTipoFiltrar');
            $routes->post('bom_linha_tipo_filtrar/(:any)', 'ExampleEndpointController::bomLinhaTipoFiltrar/$1');
            # www/exemple/group/endpoint/bom_veiculo_cadasrtar/(:any)
            $routes->get('bom_linha_tipo_cadasrtar', 'ExampleEndpointController::bomLinhaTipoCadastrar');
            $routes->get('bom_linha_tipo_cadasrtar/(:segment)', 'ExampleEndpointController::bomLinhaTipoCadastrar/$1');
            $routes->get('bom_linha_tipo_cadasrtar/(:any)', 'ExampleEndpointController::bomLinhaTipoCadastrar/$1');
            $routes->post('bom_linha_tipo_cadasrtar', 'ExampleEndpointController::bomLinhaTipoCadastrar');
            $routes->post('bom_linha_tipo_cadasrtar/(:any)', 'ExampleEndpointController::bomLinhaTipoCadastrar/$1');
            # www/exemple/group/endpoint/bom_tarifa_filtrar/(:any)
            $routes->get('bom_tarifa_filtrar', 'ExampleEndpointController::bomTarifaFiltrar');
            $routes->get('bom_tarifa_filtrar/(:segment)', 'ExampleEndpointController::bomTarifaFiltrar/$1');
            $routes->get('bom_tarifa_filtrar/(:any)', 'ExampleEndpointController::bomTarifaFiltrar/$1');
            $routes->post('bom_tarifa_filtrar', 'ExampleEndpointController::bomTarifaFiltrar');
            $routes->post('bom_tarifa_filtrar/(:any)', 'ExampleEndpointController::bomTarifaFiltrar/$1');
            # www/exemple/group/endpoint/bom_tarifa_cadasrtar/(:any)
            $routes->get('bom_tarifa_cadasrtar', 'ExampleEndpointController::bomTarifaCadastrar');
            $routes->get('bom_tarifa_cadasrtar/(:segment)', 'ExampleEndpointController::bomTarifaCadastrar/$1');
            $routes->get('bom_tarifa_cadasrtar/(:any)', 'ExampleEndpointController::bomTarifaCadastrar/$1');
            $routes->post('bom_tarifa_cadasrtar', 'ExampleEndpointController::bomTarifaCadastrar');
            $routes->post('bom_tarifa_cadasrtar/(:any)', 'ExampleEndpointController::bomTarifaCadastrar/$1');
            # www/exemple/group/endpoint/bom_usuario_filtrar/(:any)
            $routes->get('bom_usuario_filtrar', 'ExampleEndpointController::bomUsuarioFiltrar');
            $routes->get('bom_usuario_filtrar/(:segment)', 'ExampleEndpointController::bomUsuarioFiltrar/$1');
            $routes->get('bom_usuario_filtrar/(:any)', 'ExampleEndpointController::bomUsuarioFiltrar/$1');
            $routes->post('bom_usuario_filtrar', 'ExampleEndpointController::bomUsuarioFiltrar');
            $routes->post('bom_usuario_filtrar/(:any)', 'ExampleEndpointController::bomUsuarioFiltrar/$1');
            # www/exemple/group/endpoint/bom_usuario_cadasrtar/(:any)
            $routes->get('bom_usuario_cadasrtar', 'ExampleEndpointController::bomUsuarioCadastrar');
            $routes->get('bom_usuario_cadasrtar/(:segment)', 'ExampleEndpointController::bomUsuarioCadastrar/$1');
            $routes->get('bom_usuario_cadasrtar/(:any)', 'ExampleEndpointController::bomUsuarioCadastrar/$1');
            $routes->post('bom_usuario_cadasrtar', 'ExampleEndpointController::bomUsuarioCadastrar');
            $routes->post('bom_usuario_cadasrtar/(:any)', 'ExampleEndpointController::bomUsuarioCadastrar/$1');
            # www/exemple/group/endpoint/bom_filtrar/(:any)
            $routes->get('bom_filtrar', 'ExampleEndpointController::bomFiltrar');
            $routes->get('bom_filtrar/(:segment)', 'ExampleEndpointController::bomFiltrar/$1');
            $routes->get('bom_filtrar/(:any)', 'ExampleEndpointController::bomFiltrar/$1');
            $routes->post('bom_filtrar', 'ExampleEndpointController::bomFiltrar');
            $routes->post('bom_filtrar/(:any)', 'ExampleEndpointController::bomFiltrar/$1');
            # www/exemple/group/endpoint/bom_cadasrtar/(:any)
            $routes->get('bom_cadasrtar', 'ExampleEndpointController::bomCadastrar');
            $routes->get('bom_cadasrtar/(:segment)', 'ExampleEndpointController::bomCadastrar/$1');
            $routes->get('bom_cadasrtar/(:any)', 'ExampleEndpointController::bomCadastrar/$1');
            $routes->post('bom_cadasrtar', 'ExampleEndpointController::bomCadastrar');
            $routes->post('bom_cadasrtar/(:any)', 'ExampleEndpointController::bomCadastrar/$1');
            # www/exemple/group/endpoint/bom_relatorio_filtrar/(:any)
            $routes->get('bom_relatorio_filtrar', 'ExampleEndpointController::bomRelatorioFiltrar');
            $routes->get('bom_relatorio_filtrar/(:segment)', 'ExampleEndpointController::bomRelatorioFiltrar/$1');
            $routes->get('bom_relatorio_filtrar/(:any)', 'ExampleEndpointController::bomRelatorioFiltrar/$1');
            $routes->post('bom_relatorio_filtrar', 'ExampleEndpointController::bomRelatorioFiltrar');
            $routes->post('bom_relatorio_filtrar/(:any)', 'ExampleEndpointController::bomRelatorioFiltrar/$1');
            # www/exemple/group/endpoint/bom_relatorio_cadasrtar/(:any)
            $routes->get('bom_relatorio_cadasrtar', 'ExampleEndpointController::bomRelatorioCadastrar');
            $routes->get('bom_relatorio_cadasrtar/(:segment)', 'ExampleEndpointController::bomRelatorioCadastrar/$1');
            $routes->get('bom_relatorio_cadasrtar/(:any)', 'ExampleEndpointController::bomRelatorioCadastrar/$1');
            $routes->post('bom_relatorio_cadasrtar', 'ExampleEndpointController::bomRelatorioCadastrar');
            $routes->post('bom_relatorio_cadasrtar/(:any)', 'ExampleEndpointController::bomRelatorioCadastrar/$1');
            # www/exemple/group/endpoint/bom_log_filtrar/(:any)
            $routes->get('bom_log_filtrar', 'ExampleEndpointController::bomLogFiltrar');
            $routes->get('bom_log_filtrar/(:segment)', 'ExampleEndpointController::bomLogFiltrar/$1');
            $routes->get('bom_log_filtrar/(:any)', 'ExampleEndpointController::bomLogFiltrar/$1');
            $routes->post('bom_log_filtrar', 'ExampleEndpointController::bomLogFiltrar');
            $routes->post('bom_log_filtrar/(:any)', 'ExampleEndpointController::bomLogFiltrar/$1');
            # www/exemple/group/endpoint/bom_log_cadasrtar/(:any)
            $routes->get('bom_log_cadasrtar', 'ExampleEndpointController::bomLogCadastrar');
            $routes->get('bom_log_cadasrtar/(:segment)', 'ExampleEndpointController::bomLogCadastrar/$1');
            $routes->get('bom_log_cadasrtar/(:any)', 'ExampleEndpointController::bomLogCadastrar/$1');
            $routes->post('bom_log_cadasrtar', 'ExampleEndpointController::bomLogCadastrar');
            $routes->post('bom_log_cadasrtar/(:any)', 'ExampleEndpointController::bomLogCadastrar/$1');
            # www/exemple/group/endpoint/bom_configuracoes_home/(:any)
            $routes->get('bom_configuracoes_home', 'ExampleEndpointController::bomConfiguracoesHome');
            $routes->get('bom_configuracoes_home/(:segment)', 'ExampleEndpointController::bomConfiguracoesHome/$1');
            $routes->get('bom_configuracoes_home/(:any)', 'ExampleEndpointController::bomConfiguracoesHome/$1');
            $routes->post('bom_configuracoes_home', 'ExampleEndpointController::bomConfiguracoesHome');
            $routes->post('bom_configuracoes_home/(:any)', 'ExampleEndpointController::bomConfiguracoesHome/$1');
            # www/exemple/group/endpoint/bom_configuracoes_bom/(:any)
            $routes->get('bom_configuracoes_bom', 'ExampleEndpointController::bomConfiguracoesBom');
            $routes->get('bom_configuracoes_bom/(:segment)', 'ExampleEndpointController::bomConfiguracoesBom/$1');
            $routes->get('bom_configuracoes_bom/(:any)', 'ExampleEndpointController::bomConfiguracoesBom/$1');
            $routes->post('bom_configuracoes_bom', 'ExampleEndpointController::bomConfiguracoesBom');
            $routes->post('bom_configuracoes_bom/(:any)', 'ExampleEndpointController::bomConfiguracoesBom/$1');
            # www/exemple/group/endpoint/bom_configuracoes_permissoes/(:any)
            $routes->get('bom_configuracoes_permissoes', 'ExampleEndpointController::bomConfiguracoesPermissoes');
            $routes->get('bom_configuracoes_permissoes/(:segment)', 'ExampleEndpointController::bomConfiguracoesPermissoes/$1');
            $routes->get('bom_configuracoes_permissoes/(:any)', 'ExampleEndpointController::bomConfiguracoesPermissoes/$1');
            $routes->post('bom_configuracoes_permissoes', 'ExampleEndpointController::bomConfiguracoesPermissoes');
            $routes->post('bom_configuracoes_permissoes/(:any)', 'ExampleEndpointController::bomConfiguracoesPermissoes/$1');
            # www/exemple/group/endpoint/bom_tarifa_retroativa_filtrar/(:any)
            $routes->get('bom_tarifa_retroativa_filtrar', 'ExampleEndpointController::bomTarifaRetroativaFiltrar');
            $routes->get('bom_tarifa_retroativa_filtrar/(:segment)', 'ExampleEndpointController::bomTarifaRetroativaFiltrar/$1');
            $routes->get('bom_tarifa_retroativa_filtrar/(:any)', 'ExampleEndpointController::bomTarifaRetroativaFiltrar/$1');
            $routes->post('bom_tarifa_retroativa_filtrar', 'ExampleEndpointController::bomTarifaRetroativaFiltrar');
            $routes->post('bom_tarifa_retroativa_filtrar/(:any)', 'ExampleEndpointController::bomTarifaRetroativaFiltrar/$1');
            # www/exemple/group/endpoint/bom_tarifa_retroativa_cadasrtar/(:any)
            $routes->get('bom_tarifa_retroativa_cadasrtar', 'ExampleEndpointController::bomTarifaRetroativaCadastrar');
            $routes->get('bom_tarifa_retroativa_cadasrtar/(:segment)', 'ExampleEndpointController::bomTarifaRetroativaCadastrar/$1');
            $routes->get('bom_tarifa_retroativa_cadasrtar/(:any)', 'ExampleEndpointController::bomTarifaRetroativaCadastrar/$1');
            $routes->post('bom_tarifa_retroativa_cadasrtar', 'ExampleEndpointController::bomTarifaRetroativaCadastrar');
            $routes->post('bom_tarifa_retroativa_cadasrtar/(:any)', 'ExampleEndpointController::bomTarifaRetroativaCadastrar/$1');
            # www/exemple/group/endpoint/bom_importar_linhas_filtrar/(:any)
            $routes->get('bom_importar_linhas_filtrar', 'ExampleEndpointController::bomImportarLinhasFiltrar');
            $routes->get('bom_importar_linhas_filtrar/(:segment)', 'ExampleEndpointController::bomImportarLinhasFiltrar/$1');
            $routes->get('bom_importar_linhas_filtrar/(:any)', 'ExampleEndpointController::bomImportarLinhasFiltrar/$1');
            $routes->post('bom_importar_linhas_filtrar', 'ExampleEndpointController::bomImportarLinhasFiltrar');
            $routes->post('bom_importar_linhas_filtrar/(:any)', 'ExampleEndpointController::bomImportarLinhasFiltrar/$1');
            # www/exemple/group/endpoint/bom_importar_linhas_cadasrtar/(:any)
            $routes->get('bom_importar_linhas_cadasrtar', 'ExampleEndpointController::bomImportarLinhasCadastrar');
            $routes->get('bom_importar_linhas_cadasrtar/(:segment)', 'ExampleEndpointController::bomImportarLinhasCadastrar/$1');
            $routes->get('bom_importar_linhas_cadasrtar/(:any)', 'ExampleEndpointController::bomImportarLinhasCadastrar/$1');
            $routes->post('bom_importar_linhas_cadasrtar', 'ExampleEndpointController::bomImportarLinhasCadastrar');
            $routes->post('bom_importar_linhas_cadasrtar/(:any)', 'ExampleEndpointController::bomImportarLinhasCadastrar/$1');
        });
    });
});