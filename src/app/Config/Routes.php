<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->addRedirect('/', 'bw/habilidade/usuario/endpoint/auth');
$routes->addRedirect('/bom', 'exemple/group/endpoint/bom_login');
$routes->addRedirect('/main', 'exemple/group/endpoint/bom_main');

$routes->group('analise', function ($routes) {
    # Modelo
    $routes->group('modelo', function ($routes) {
        # www/analise/modelo/api/(:any)
        $routes->group('api', function ($routes) {
            # www/analise/modelo/api/exe01/(:any)
            $routes->get('exe01', 'ModeloApiController::dbMethod');
            $routes->get('exe01/(:segment)', 'ModeloApiController::dbMethod/$1');
            $routes->get('exe01/(:any)', 'ModeloApiController::dbMethod/$1');
            $routes->post('exe01', 'ModeloApiController::dbMethod');
            $routes->post('exe01/(:any)', 'ModeloApiController::dbMethod/$1');
            $routes->post('exe01/(:any)', 'ModeloApiController::dbMethod/$1');
        });
        # www/analise/modelo/endpoint/(:any)
        $routes->group('endpoint', function ($routes) {
            # www/analise/modelo/endpoint/AppPrincipal/(:any)
            $routes->get('AppPrincipal', 'AnaliseEndpointController::AppPrincipal');
            $routes->get('AppPrincipal/(:segment)', 'AnaliseEndpointController::AppPrincipal/$1');
            $routes->get('AppPrincipal/(:any)', 'AnaliseEndpointController::AppPrincipal/$1');
            $routes->post('AppPrincipal', 'AnaliseEndpointController::AppPrincipal');
            $routes->post('AppPrincipal/(:any)', 'AnaliseEndpointController::AppPrincipal/$1');
            # www/analise/modelo/endpoint/AppExecApi/(:any)
            $routes->get('AppExecApi', 'AnaliseEndpointController::AppExecApi');
            $routes->get('AppExecApi/(:segment)', 'AnaliseEndpointController::AppExecApi/$1');
            $routes->get('AppExecApi/(:any)', 'AnaliseEndpointController::AppExecApi/$1');
            $routes->post('AppExecApi', 'AnaliseEndpointController::AppExecApi');
            $routes->post('AppExecApi/(:any)', 'AnaliseEndpointController::AppExecApi/$1');
            # www/analise/modelo/endpoint/AppExecLoading/(:any)
            $routes->get('AppExecLoading', 'AnaliseEndpointController::AppExecLoading');
            $routes->get('AppExecLoading/(:segment)', 'AnaliseEndpointController::AppExecLoading/$1');
            $routes->get('AppExecLoading/(:any)', 'AnaliseEndpointController::AppExecLoading/$1');
            $routes->post('AppExecLoading', 'AnaliseEndpointController::AppExecLoading');
            $routes->post('AppExecLoading/(:any)', 'AnaliseEndpointController::AppExecLoading/$1');
        });
    });
});


$routes->group('bw', function ($routes) {
    $routes->group('habilidade', function ($routes) {
        # habilidade
        $routes->group('usuario', function ($routes) {
            # www/bw/habilidade/usuario/api/(:any)
            $routes->group('api', function ($routes) {
                # www/bw/habilidade/usuario/api/loginEtapa1/(:any)
                $routes->get('loginEtapa1', 'UsuarioApiController::loginEtapa1');
                $routes->get('loginEtapa1/(:segment)', 'UsuarioApiController::loginEtapa1/$1');
                $routes->get('loginEtapa1/(:any)', 'UsuarioApiController::loginEtapa1/$1');
                $routes->post('loginEtapa1', 'UsuarioApiController::loginEtapa1');
                $routes->post('loginEtapa1/(:any)', 'UsuarioApiController::loginEtapa1/$1');
                # www/bw/habilidade/usuario/api/loginEtapa2/(:any)
                $routes->get('loginEtapa2', 'UsuarioApiController::loginEtapa2');
                $routes->get('loginEtapa2/(:segment)', 'UsuarioApiController::loginEtapa2/$1');
                $routes->get('loginEtapa2/(:any)', 'UsuarioApiController::loginEtapa2/$1');
                $routes->post('loginEtapa2', 'UsuarioApiController::loginEtapa2');
                $routes->post('loginEtapa2/(:any)', 'UsuarioApiController::loginEtapa2/$1');
            });
            # www/bw/habilidade/usuario/endpoint/(:any)
            $routes->group('endpoint', function ($routes) {
                # www/bw/habilidade/usuario/endpoint/auth/(:any)
                $routes->get('auth', 'UsuarioEndpointController::loginHabilidade');
                $routes->get('auth/(:segment)', 'UsuarioEndpointController::loginHabilidade/$1');
                $routes->get('auth/(:any)', 'UsuarioEndpointController::loginHabilidade/$1');
                $routes->post('auth', 'UsuarioEndpointController::loginHabilidade');
                $routes->post('auth/(:any)', 'UsuarioEndpointController::loginHabilidade/$1');
            });
        });
    });

    # Usuário
    $routes->group('usuario', function ($routes) {
        # www/bw/usuario/api/(:any)
        $routes->group('api', function ($routes) {
            # www/bw/usuario/api/exe01/(:any)
            $routes->get('exe01', 'ModeloApiController::dbMethod');
            $routes->get('exe01/(:segment)', 'ModeloApiController::dbMethod/$1');
            $routes->get('exe01/(:any)', 'ModeloApiController::dbMethod/$1');
            $routes->post('exe01', 'ModeloApiController::dbMethod');
            $routes->post('exe01/(:any)', 'ModeloApiController::dbMethod/$1');
            $routes->post('exe01/(:any)', 'ModeloApiController::dbMethod/$1');
        });
        # www/bw/usuario/endpoint/(:any)
        $routes->group('endpoint', function ($routes) {
            # www/bw/usuario/endpoint/login/(:any)
            $routes->get('login', 'UsuarioEndpointController::loginWeb');
            $routes->get('login/(:segment)', 'UsuarioEndpointController::loginWeb/$1');
            $routes->get('login/(:any)', 'UsuarioEndpointController::loginWeb/$1');
            $routes->post('login', 'UsuarioEndpointController::loginWeb');
            $routes->post('login/(:any)', 'UsuarioEndpointController::loginWeb/$1');
        });
    });
    
    # Empresa
    $routes->group('empresa', function ($routes) {
        # www/bw/empresa/api/(:any)
        $routes->group('api', function ($routes) {
            # www/bw/empresa/api/cadastrar/(:any)
            $routes->get('cadastrar', 'ApiController::dbMethod');
            $routes->get('cadastrar/(:segment)', 'ApiController::dbMethod/$1');
            $routes->get('cadastrar/(:any)', 'ApiController::dbMethod/$1');
            $routes->post('cadastrar', 'ApiController::dbMethod');
            $routes->post('cadastrar/(:any)', 'ApiController::dbMethod/$1');
            $routes->post('cadastrar/(:any)', 'ApiController::dbMethod/$1');
        });
        # www/bw/empresa/endpoint/(:any)
        $routes->group('endpoint', function ($routes) {
            # www/bw/empresa/endpoint/cadastrar/(:any)
            $routes->get('cadastrar', 'EmpresaEndpointController::dbCreate');
            $routes->get('cadastrar/(:segment)', 'EmpresaEndpointController::dbCreate/$1');
            $routes->get('cadastrar/(:any)', 'EmpresaEndpointController::dbCreate/$1');
            $routes->post('cadastrar', 'EmpresaEndpointController::dbCreate');
            $routes->post('cadastrar/(:any)', 'EmpresaEndpointController::dbCreate/$1');
        });
    });
});

$routes->group('bomweb', function ($routes) {
    # Empresa
    $routes->group('empresa', function ($routes) {
        # www/bomweb/empresa/api/(:any)
        $routes->group('api', function ($routes) {
            # www/bomweb/empresa/api/cadastrar/(:any)
            $routes->get('cadastrar', 'EmpresaApiController::dbCreate');
            $routes->get('cadastrar/(:segment)', 'EmpresaApiController::dbCreate/$1');
            $routes->get('cadastrar/(:any)', 'EmpresaApiController::dbCreate/$1');
            $routes->post('cadastrar', 'EmpresaApiController::dbCreate');
            $routes->post('cadastrar/(:any)', 'EmpresaApiController::dbCreate/$1');
            # www/bomweb/empresa/api/exibir/(:any)
            $routes->get('exibir', 'EmpresaApiController::dbRead');
            $routes->get('exibir/(:segment)', 'EmpresaApiController::dbRead/$1');
            $routes->get('exibir/(:any)', 'EmpresaApiController::dbRead/$1');
            $routes->post('exibir', 'EmpresaApiController::dbRead');
            $routes->post('exibir/(:any)', 'EmpresaApiController::dbRead/$1');
            # www/bomweb/empresa/api/atualizar/(:any)
            $routes->get('atualizar', 'EmpresaApiController::dbUpdate');
            $routes->get('atualizar/(:segment)', 'EmpresaApiController::dbUpdate/$1');
            $routes->get('atualizar/(:any)', 'EmpresaApiController::dbUpdate/$1');
            $routes->post('atualizar', 'EmpresaApiController::dbUpdate');
            $routes->post('atualizar/(:any)', 'EmpresaApiController::dbUpdate/$1');
            # www/bomweb/empresa/api/deletar/(:any)
            $routes->get('deletar', 'EmpresaApiController::dbDelete');
            $routes->get('deletar/(:segment)', 'EmpresaApiController::dbDelete/$1');
            $routes->get('deletar/(:any)', 'EmpresaApiController::dbDelete/$1');
            $routes->post('deletar', 'EmpresaApiController::dbDelete');
            $routes->post('deletar/(:any)', 'EmpresaApiController::dbDelete/$1');
            # www/bomweb/empresa/api/limpar/(:any)
            $routes->get('limpar', 'EmpresaApiController::dbLimpar');
            $routes->get('limpar/(:segment)', 'EmpresaApiController::dbLimpar/$1');
            $routes->get('limpar/(:any)', 'EmpresaApiController::dbLimpar/$1');
            $routes->post('limpar', 'EmpresaApiController::dbLimpar');
            $routes->post('limpar/(:any)', 'EmpresaApiController::dbLimpar/$1');
        });
        # www/bomweb/empresa/endpoint/(:any)
        $routes->group('endpoint', function ($routes) {
            # www/bomweb/empresa/endpoint/cadastrar/(:any)
            $routes->get('cadastrar', 'EmpresaEndPointController::dbCreate');
            $routes->get('cadastrar/(:segment)', 'EmpresaEndPointController::dbCreate/$1');
            $routes->get('cadastrar/(:any)', 'EmpresaEndPointController::dbCreate/$1');
            $routes->post('cadastrar', 'EmpresaEndPointController::dbCreate');
            $routes->post('cadastrar/(:any)', 'EmpresaEndPointController::dbCreate/$1');
            # www/bomweb/empresa/api/exibir/(:any)
            $routes->get('exibir', 'EmpresaEndPointController::dbRead');
            $routes->get('exibir/(:segment)', 'EmpresaEndPointController::dbRead/$1');
            $routes->get('exibir/(:any)', 'EmpresaEndPointController::dbRead/$1');
            $routes->post('exibir', 'EmpresaEndPointController::dbRead');
            $routes->post('exibir/(:any)', 'EmpresaEndPointController::dbRead/$1');
            # www/bomweb/empresa/api/atualizar/(:any)
            $routes->get('atualizar', 'EmpresaEndPointController::dbUpdate');
            $routes->get('atualizar/(:segment)', 'EmpresaEndPointController::dbUpdate/$1');
            $routes->get('atualizar/(:any)', 'EmpresaEndPointController::dbUpdate/$1');
            $routes->post('atualizar', 'EmpresaEndPointController::dbUpdate');
            $routes->post('atualizar/(:any)', 'EmpresaEndPointController::dbUpdate/$1');
            # www/bomweb/empresa/api/deletar/(:any)
            $routes->get('deletar', 'EmpresaEndPointController::dbDelete');
            $routes->get('deletar/(:segment)', 'EmpresaEndPointController::dbDelete/$1');
            $routes->get('deletar/(:any)', 'EmpresaEndPointController::dbDelete/$1');
            $routes->post('deletar', 'EmpresaEndPointController::dbDelete');
            $routes->post('deletar/(:any)', 'EmpresaEndPointController::dbDelete/$1');
            # www/bomweb/empresa/api/limpar/(:any)
            $routes->get('limpar', 'EmpresaEndPointController::dbLimpar');
            $routes->get('limpar/(:segment)', 'EmpresaEndPointController::dbLimpar/$1');
            $routes->get('limpar/(:any)', 'EmpresaEndPointController::dbLimpar/$1');
            $routes->post('limpar', 'EmpresaEndPointController::dbLimpar');
            $routes->post('limpar/(:any)', 'EmpresaEndPointController::dbLimpar/$1');
        });
    });

    # Linha
    $routes->group('linha', function ($routes) {
        # www/bomweb/linha/api/(:any)
        $routes->group('api', function ($routes) {
            # www/bomweb/linha/api/cadastrar/(:any)
            $routes->get('cadastrar', 'LinhaApiController::dbCreate');
            $routes->get('cadastrar/(:segment)', 'LinhaApiController::dbCreate/$1');
            $routes->get('cadastrar/(:any)', 'LinhaApiController::dbCreate/$1');
            $routes->post('cadastrar', 'LinhaApiController::dbCreate');
            $routes->post('cadastrar/(:any)', 'LinhaApiController::dbCreate/$1');
            # www/bomweb/linha/api/exibir/(:any)
            $routes->get('exibir', 'LinhaApiController::dbRead');
            $routes->get('exibir/(:segment)', 'LinhaApiController::dbRead/$1');
            $routes->get('exibir/(:any)', 'LinhaApiController::dbRead/$1');
            $routes->post('exibir', 'LinhaApiController::dbRead');
            $routes->post('exibir/(:any)', 'LinhaApiController::dbRead/$1');
            # www/bomweb/linha/api/atualizar/(:any)
            $routes->get('atualizar', 'LinhaApiController::dbUpdate');
            $routes->get('atualizar/(:segment)', 'LinhaApiController::dbUpdate/$1');
            $routes->get('atualizar/(:any)', 'LinhaApiController::dbUpdate/$1');
            $routes->post('atualizar', 'LinhaApiController::dbUpdate');
            $routes->post('atualizar/(:any)', 'LinhaApiController::dbUpdate/$1');
            # www/bomweb/linha/api/deletar/(:any)
            $routes->get('deletar', 'LinhaApiController::dbDelete');
            $routes->get('deletar/(:segment)', 'LinhaApiController::dbDelete/$1');
            $routes->get('deletar/(:any)', 'LinhaApiController::dbDelete/$1');
            $routes->post('deletar', 'LinhaApiController::dbDelete');
            $routes->post('deletar/(:any)', 'LinhaApiController::dbDelete/$1');
            # www/bomweb/linha/api/limpar/(:any)
            $routes->get('limpar', 'LinhaApiController::dbLimpar');
            $routes->get('limpar/(:segment)', 'LinhaApiController::dbLimpar/$1');
            $routes->get('limpar/(:any)', 'LinhaApiController::dbLimpar/$1');
            $routes->post('limpar', 'LinhaApiController::dbLimpar');
            $routes->post('limpar/(:any)', 'LinhaApiController::dbLimpar/$1');
        });
        # www/bomweb/linha/endpoint/(:any)
        $routes->group('endpoint', function ($routes) {
            # www/bomweb/linha/endpoint/cadastrar/(:any)
            $routes->get('cadastrar', 'LinhaEndPointController::dbCreate');
            $routes->get('cadastrar/(:segment)', 'LinhaEndPointController::dbCreate/$1');
            $routes->get('cadastrar/(:any)', 'LinhaEndPointController::dbCreate/$1');
            $routes->post('cadastrar', 'LinhaEndPointController::dbCreate');
            $routes->post('cadastrar/(:any)', 'LinhaEndPointController::dbCreate/$1');
            # www/bomweb/linha/api/exibir/(:any)
            $routes->get('exibir', 'LinhaEndPointController::dbRead');
            $routes->get('exibir/(:segment)', 'LinhaEndPointController::dbRead/$1');
            $routes->get('exibir/(:any)', 'LinhaEndPointController::dbRead/$1');
            $routes->post('exibir', 'LinhaEndPointController::dbRead');
            $routes->post('exibir/(:any)', 'LinhaEndPointController::dbRead/$1');
            # www/bomweb/linha/api/atualizar/(:any)
            $routes->get('atualizar', 'LinhaEndPointController::dbUpdate');
            $routes->get('atualizar/(:segment)', 'LinhaEndPointController::dbUpdate/$1');
            $routes->get('atualizar/(:any)', 'LinhaEndPointController::dbUpdate/$1');
            $routes->post('atualizar', 'LinhaEndPointController::dbUpdate');
            $routes->post('atualizar/(:any)', 'LinhaEndPointController::dbUpdate/$1');
            # www/bomweb/linha/api/deletar/(:any)
            $routes->get('deletar', 'LinhaEndPointController::dbDelete');
            $routes->get('deletar/(:segment)', 'LinhaEndPointController::dbDelete/$1');
            $routes->get('deletar/(:any)', 'LinhaEndPointController::dbDelete/$1');
            $routes->post('deletar', 'LinhaEndPointController::dbDelete');
            $routes->post('deletar/(:any)', 'LinhaEndPointController::dbDelete/$1');
            # www/bomweb/linha/api/limpar/(:any)
            $routes->get('limpar', 'LinhaEndPointController::dbLimpar');
            $routes->get('limpar/(:segment)', 'LinhaEndPointController::dbLimpar/$1');
            $routes->get('limpar/(:any)', 'LinhaEndPointController::dbLimpar/$1');
            $routes->post('limpar', 'LinhaEndPointController::dbLimpar');
            $routes->post('limpar/(:any)', 'LinhaEndPointController::dbLimpar/$1');
        });
    });

    # Tipo de Veículo
    $routes->group('tipoveiculo', function ($routes) {
        # www/bomweb/tipoveiculo/api/(:any)
        $routes->group('api', function ($routes) {
            # www/bomweb/tipoveiculo/api/cadastrar/(:any)
            $routes->get('cadastrar', 'TipoVeiculoApiController::dbCreate');
            $routes->get('cadastrar/(:segment)', 'TipoVeiculoApiController::dbCreate/$1');
            $routes->get('cadastrar/(:any)', 'TipoVeiculoApiController::dbCreate/$1');
            $routes->post('cadastrar', 'TipoVeiculoApiController::dbCreate');
            $routes->post('cadastrar/(:any)', 'TipoVeiculoApiController::dbCreate/$1');
            # www/bomweb/tipoveiculo/api/exibir/(:any)
            $routes->get('exibir', 'TipoVeiculoApiController::dbRead');
            $routes->get('exibir/(:segment)', 'TipoVeiculoApiController::dbRead/$1');
            $routes->get('exibir/(:any)', 'TipoVeiculoApiController::dbRead/$1');
            $routes->post('exibir', 'TipoVeiculoApiController::dbRead');
            $routes->post('exibir/(:any)', 'TipoVeiculoApiController::dbRead/$1');
            # www/bomweb/tipoveiculo/api/atualizar/(:any)
            $routes->get('atualizar', 'TipoVeiculoApiController::dbUpdate');
            $routes->get('atualizar/(:segment)', 'TipoVeiculoApiController::dbUpdate/$1');
            $routes->get('atualizar/(:any)', 'TipoVeiculoApiController::dbUpdate/$1');
            $routes->post('atualizar', 'TipoVeiculoApiController::dbUpdate');
            $routes->post('atualizar/(:any)', 'TipoVeiculoApiController::dbUpdate/$1');
            # www/bomweb/tipoveiculo/api/deletar/(:any)
            $routes->get('deletar', 'TipoVeiculoApiController::dbDelete');
            $routes->get('deletar/(:segment)', 'TipoVeiculoApiController::dbDelete/$1');
            $routes->get('deletar/(:any)', 'TipoVeiculoApiController::dbDelete/$1');
            $routes->post('deletar', 'TipoVeiculoApiController::dbDelete');
            $routes->post('deletar/(:any)', 'TipoVeiculoApiController::dbDelete/$1');
            # www/bomweb/tipoveiculo/api/limpar/(:any)
            $routes->get('limpar', 'TipoVeiculoApiController::dbLimpar');
            $routes->get('limpar/(:segment)', 'TipoVeiculoApiController::dbLimpar/$1');
            $routes->get('limpar/(:any)', 'TipoVeiculoApiController::dbLimpar/$1');
            $routes->post('limpar', 'TipoVeiculoApiController::dbLimpar');
            $routes->post('limpar/(:any)', 'TipoVeiculoApiController::dbLimpar/$1');
        });
        # www/bomweb/tipoveiculo/endpoint/(:any)
        $routes->group('endpoint', function ($routes) {
            # www/bomweb/tipoveiculo/endpoint/cadastrar/(:any)
            $routes->get('cadastrar', 'TipoVeiculoEndPointController::dbCreate');
            $routes->get('cadastrar/(:segment)', 'TipoVeiculoEndPointController::dbCreate/$1');
            $routes->get('cadastrar/(:any)', 'TipoVeiculoEndPointController::dbCreate/$1');
            $routes->post('cadastrar', 'TipoVeiculoEndPointController::dbCreate');
            $routes->post('cadastrar/(:any)', 'TipoVeiculoEndPointController::dbCreate/$1');
            # www/bomweb/tipoveiculo/api/exibir/(:any)
            $routes->get('exibir', 'TipoVeiculoEndPointController::dbRead');
            $routes->get('exibir/(:segment)', 'TipoVeiculoEndPointController::dbRead/$1');
            $routes->get('exibir/(:any)', 'TipoVeiculoEndPointController::dbRead/$1');
            $routes->post('exibir', 'TipoVeiculoEndPointController::dbRead');
            $routes->post('exibir/(:any)', 'TipoVeiculoEndPointController::dbRead/$1');
            # www/bomweb/tipoveiculo/api/atualizar/(:any)
            $routes->get('atualizar', 'TipoVeiculoEndPointController::dbUpdate');
            $routes->get('atualizar/(:segment)', 'TipoVeiculoEndPointController::dbUpdate/$1');
            $routes->get('atualizar/(:any)', 'TipoVeiculoEndPointController::dbUpdate/$1');
            $routes->post('atualizar', 'TipoVeiculoEndPointController::dbUpdate');
            $routes->post('atualizar/(:any)', 'TipoVeiculoEndPointController::dbUpdate/$1');
            # www/bomweb/tipoveiculo/api/deletar/(:any)
            $routes->get('deletar', 'TipoVeiculoEndPointController::dbDelete');
            $routes->get('deletar/(:segment)', 'TipoVeiculoEndPointController::dbDelete/$1');
            $routes->get('deletar/(:any)', 'TipoVeiculoEndPointController::dbDelete/$1');
            $routes->post('deletar', 'TipoVeiculoEndPointController::dbDelete');
            $routes->post('deletar/(:any)', 'TipoVeiculoEndPointController::dbDelete/$1');
            # www/bomweb/tipoveiculo/api/limpar/(:any)
            $routes->get('limpar', 'TipoVeiculoEndPointController::dbLimpar');
            $routes->get('limpar/(:segment)', 'TipoVeiculoEndPointController::dbLimpar/$1');
            $routes->get('limpar/(:any)', 'TipoVeiculoEndPointController::dbLimpar/$1');
            $routes->post('limpar', 'TipoVeiculoEndPointController::dbLimpar');
            $routes->post('limpar/(:any)', 'TipoVeiculoEndPointController::dbLimpar/$1');
        });
    });

    # Tipo de Linha
    $routes->group('tipolinha', function ($routes) {
        # www/bomweb/tipolinha/api/(:any)
        $routes->group('api', function ($routes) {
            # www/bomweb/tipolinha/api/cadastrar/(:any)
            $routes->get('cadastrar', 'TipoLinhaloApiController::dbCreate');
            $routes->get('cadastrar/(:segment)', 'TipoLinhaloApiController::dbCreate/$1');
            $routes->get('cadastrar/(:any)', 'TipoLinhaloApiController::dbCreate/$1');
            $routes->post('cadastrar', 'TipoLinhaloApiController::dbCreate');
            $routes->post('cadastrar/(:any)', 'TipoLinhaloApiController::dbCreate/$1');
            # www/bomweb/tipolinha/api/exibir/(:any)
            $routes->get('exibir', 'TipoLinhaloApiController::dbRead');
            $routes->get('exibir/(:segment)', 'TipoLinhaloApiController::dbRead/$1');
            $routes->get('exibir/(:any)', 'TipoLinhaloApiController::dbRead/$1');
            $routes->post('exibir', 'TipoLinhaloApiController::dbRead');
            $routes->post('exibir/(:any)', 'TipoLinhaloApiController::dbRead/$1');
            # www/bomweb/tipolinha/api/atualizar/(:any)
            $routes->get('atualizar', 'TipoLinhaloApiController::dbUpdate');
            $routes->get('atualizar/(:segment)', 'TipoLinhaloApiController::dbUpdate/$1');
            $routes->get('atualizar/(:any)', 'TipoLinhaloApiController::dbUpdate/$1');
            $routes->post('atualizar', 'TipoLinhaloApiController::dbUpdate');
            $routes->post('atualizar/(:any)', 'TipoLinhaloApiController::dbUpdate/$1');
            # www/bomweb/tipolinha/api/deletar/(:any)
            $routes->get('deletar', 'TipoLinhaloApiController::dbDelete');
            $routes->get('deletar/(:segment)', 'TipoLinhaloApiController::dbDelete/$1');
            $routes->get('deletar/(:any)', 'TipoLinhaloApiController::dbDelete/$1');
            $routes->post('deletar', 'TipoLinhaloApiController::dbDelete');
            $routes->post('deletar/(:any)', 'TipoLinhaloApiController::dbDelete/$1');
            # www/bomweb/tipolinha/api/limpar/(:any)
            $routes->get('limpar', 'TipoLinhaloApiController::dbLimpar');
            $routes->get('limpar/(:segment)', 'TipoLinhaloApiController::dbLimpar/$1');
            $routes->get('limpar/(:any)', 'TipoLinhaloApiController::dbLimpar/$1');
            $routes->post('limpar', 'TipoLinhaloApiController::dbLimpar');
            $routes->post('limpar/(:any)', 'TipoLinhaloApiController::dbLimpar/$1');
        });
        # www/bomweb/tipolinha/endpoint/(:any)
        $routes->group('endpoint', function ($routes) {
            # www/bomweb/tipolinha/endpoint/cadastrar/(:any)
            $routes->get('cadastrar', 'TipoLinhaloEndPointController::dbCreate');
            $routes->get('cadastrar/(:segment)', 'TipoLinhaloEndPointController::dbCreate/$1');
            $routes->get('cadastrar/(:any)', 'TipoLinhaloEndPointController::dbCreate/$1');
            $routes->post('cadastrar', 'TipoLinhaloEndPointController::dbCreate');
            $routes->post('cadastrar/(:any)', 'TipoLinhaloEndPointController::dbCreate/$1');
            # www/bomweb/tipolinha/api/exibir/(:any)
            $routes->get('exibir', 'TipoLinhaloEndPointController::dbRead');
            $routes->get('exibir/(:segment)', 'TipoLinhaloEndPointController::dbRead/$1');
            $routes->get('exibir/(:any)', 'TipoLinhaloEndPointController::dbRead/$1');
            $routes->post('exibir', 'TipoLinhaloEndPointController::dbRead');
            $routes->post('exibir/(:any)', 'TipoLinhaloEndPointController::dbRead/$1');
            # www/bomweb/tipolinha/api/atualizar/(:any)
            $routes->get('atualizar', 'TipoLinhaloEndPointController::dbUpdate');
            $routes->get('atualizar/(:segment)', 'TipoLinhaloEndPointController::dbUpdate/$1');
            $routes->get('atualizar/(:any)', 'TipoLinhaloEndPointController::dbUpdate/$1');
            $routes->post('atualizar', 'TipoLinhaloEndPointController::dbUpdate');
            $routes->post('atualizar/(:any)', 'TipoLinhaloEndPointController::dbUpdate/$1');
            # www/bomweb/tipolinha/api/deletar/(:any)
            $routes->get('deletar', 'TipoLinhaloEndPointController::dbDelete');
            $routes->get('deletar/(:segment)', 'TipoLinhaloEndPointController::dbDelete/$1');
            $routes->get('deletar/(:any)', 'TipoLinhaloEndPointController::dbDelete/$1');
            $routes->post('deletar', 'TipoLinhaloEndPointController::dbDelete');
            $routes->post('deletar/(:any)', 'TipoLinhaloEndPointController::dbDelete/$1');
            # www/bomweb/tipolinha/api/limpar/(:any)
            $routes->get('limpar', 'TipoLinhaloEndPointController::dbLimpar');
            $routes->get('limpar/(:segment)', 'TipoLinhaloEndPointController::dbLimpar/$1');
            $routes->get('limpar/(:any)', 'TipoLinhaloEndPointController::dbLimpar/$1');
            $routes->post('limpar', 'TipoLinhaloEndPointController::dbLimpar');
            $routes->post('limpar/(:any)', 'TipoLinhaloEndPointController::dbLimpar/$1');
        });
    });

    # Tarifa
    $routes->group('tarifa', function ($routes) {
        # www/bomweb/tarifa/api/(:any)
        $routes->group('api', function ($routes) {
            # www/bomweb/tarifa/api/cadastrar/(:any)
            $routes->get('cadastrar', 'TarifaApiController::dbCreate');
            $routes->get('cadastrar/(:segment)', 'TarifaApiController::dbCreate/$1');
            $routes->get('cadastrar/(:any)', 'TarifaApiController::dbCreate/$1');
            $routes->post('cadastrar', 'TarifaApiController::dbCreate');
            $routes->post('cadastrar/(:any)', 'TarifaApiController::dbCreate/$1');
            # www/bomweb/tarifa/api/exibir/(:any)
            $routes->get('exibir', 'TarifaApiController::dbRead');
            $routes->get('exibir/(:segment)', 'TarifaApiController::dbRead/$1');
            $routes->get('exibir/(:any)', 'TarifaApiController::dbRead/$1');
            $routes->post('exibir', 'TarifaApiController::dbRead');
            $routes->post('exibir/(:any)', 'TarifaApiController::dbRead/$1');
            # www/bomweb/tarifa/api/atualizar/(:any)
            $routes->get('atualizar', 'TarifaApiController::dbUpdate');
            $routes->get('atualizar/(:segment)', 'TarifaApiController::dbUpdate/$1');
            $routes->get('atualizar/(:any)', 'TarifaApiController::dbUpdate/$1');
            $routes->post('atualizar', 'TarifaApiController::dbUpdate');
            $routes->post('atualizar/(:any)', 'TarifaApiController::dbUpdate/$1');
            # www/bomweb/tarifa/api/deletar/(:any)
            $routes->get('deletar', 'TarifaApiController::dbDelete');
            $routes->get('deletar/(:segment)', 'TarifaApiController::dbDelete/$1');
            $routes->get('deletar/(:any)', 'TarifaApiController::dbDelete/$1');
            $routes->post('deletar', 'TarifaApiController::dbDelete');
            $routes->post('deletar/(:any)', 'TarifaApiController::dbDelete/$1');
            # www/bomweb/tarifa/api/limpar/(:any)
            $routes->get('limpar', 'TarifaApiController::dbLimpar');
            $routes->get('limpar/(:segment)', 'TarifaApiController::dbLimpar/$1');
            $routes->get('limpar/(:any)', 'TarifaApiController::dbLimpar/$1');
            $routes->post('limpar', 'TarifaApiController::dbLimpar');
            $routes->post('limpar/(:any)', 'TarifaApiController::dbLimpar/$1');
        });
        # www/bomweb/tarifa/endpoint/(:any)
        $routes->group('endpoint', function ($routes) {
            # www/bomweb/tarifa/endpoint/cadastrar/(:any)
            $routes->get('cadastrar', 'TarifaEndPointController::dbCreate');
            $routes->get('cadastrar/(:segment)', 'TarifaEndPointController::dbCreate/$1');
            $routes->get('cadastrar/(:any)', 'TarifaEndPointController::dbCreate/$1');
            $routes->post('cadastrar', 'TarifaEndPointController::dbCreate');
            $routes->post('cadastrar/(:any)', 'TarifaEndPointController::dbCreate/$1');
            # www/bomweb/tarifa/api/exibir/(:any)
            $routes->get('exibir', 'TarifaEndPointController::dbRead');
            $routes->get('exibir/(:segment)', 'TarifaEndPointController::dbRead/$1');
            $routes->get('exibir/(:any)', 'TarifaEndPointController::dbRead/$1');
            $routes->post('exibir', 'TarifaEndPointController::dbRead');
            $routes->post('exibir/(:any)', 'TarifaEndPointController::dbRead/$1');
            # www/bomweb/tarifa/api/atualizar/(:any)
            $routes->get('atualizar', 'TarifaEndPointController::dbUpdate');
            $routes->get('atualizar/(:segment)', 'TarifaEndPointController::dbUpdate/$1');
            $routes->get('atualizar/(:any)', 'TarifaEndPointController::dbUpdate/$1');
            $routes->post('atualizar', 'TarifaEndPointController::dbUpdate');
            $routes->post('atualizar/(:any)', 'TarifaEndPointController::dbUpdate/$1');
            # www/bomweb/tarifa/api/deletar/(:any)
            $routes->get('deletar', 'TarifaEndPointController::dbDelete');
            $routes->get('deletar/(:segment)', 'TarifaEndPointController::dbDelete/$1');
            $routes->get('deletar/(:any)', 'TarifaEndPointController::dbDelete/$1');
            $routes->post('deletar', 'TarifaEndPointController::dbDelete');
            $routes->post('deletar/(:any)', 'TarifaEndPointController::dbDelete/$1');
            # www/bomweb/tarifa/api/limpar/(:any)
            $routes->get('limpar', 'TarifaEndPointController::dbLimpar');
            $routes->get('limpar/(:segment)', 'TarifaEndPointController::dbLimpar/$1');
            $routes->get('limpar/(:any)', 'TarifaEndPointController::dbLimpar/$1');
            $routes->post('limpar', 'TarifaEndPointController::dbLimpar');
            $routes->post('limpar/(:any)', 'TarifaEndPointController::dbLimpar/$1');
        });
    });

    # Usuário
    $routes->group('usuario', function ($routes) {
        # www/bomweb/usuario/api/(:any)
        $routes->group('api', function ($routes) {
            # www/bomweb/usuario/api/cadastrar/(:any)
            $routes->get('cadastrar', 'UsuarioApiController::dbCreate');
            $routes->get('cadastrar/(:segment)', 'UsuarioApiController::dbCreate/$1');
            $routes->get('cadastrar/(:any)', 'UsuarioApiController::dbCreate/$1');
            $routes->post('cadastrar', 'UsuarioApiController::dbCreate');
            $routes->post('cadastrar/(:any)', 'UsuarioApiController::dbCreate/$1');
            # www/bomweb/usuario/api/exibir/(:any)
            $routes->get('exibir', 'UsuarioApiController::dbRead');
            $routes->get('exibir/(:segment)', 'UsuarioApiController::dbRead/$1');
            $routes->get('exibir/(:any)', 'UsuarioApiController::dbRead/$1');
            $routes->post('exibir', 'UsuarioApiController::dbRead');
            $routes->post('exibir/(:any)', 'UsuarioApiController::dbRead/$1');
            # www/bomweb/usuario/api/atualizar/(:any)
            $routes->get('atualizar', 'UsuarioApiController::dbUpdate');
            $routes->get('atualizar/(:segment)', 'UsuarioApiController::dbUpdate/$1');
            $routes->get('atualizar/(:any)', 'UsuarioApiController::dbUpdate/$1');
            $routes->post('atualizar', 'UsuarioApiController::dbUpdate');
            $routes->post('atualizar/(:any)', 'UsuarioApiController::dbUpdate/$1');
            # www/bomweb/usuario/api/deletar/(:any)
            $routes->get('deletar', 'UsuarioApiController::dbDelete');
            $routes->get('deletar/(:segment)', 'UsuarioApiController::dbDelete/$1');
            $routes->get('deletar/(:any)', 'UsuarioApiController::dbDelete/$1');
            $routes->post('deletar', 'UsuarioApiController::dbDelete');
            $routes->post('deletar/(:any)', 'UsuarioApiController::dbDelete/$1');
            # www/bomweb/usuario/api/limpar/(:any)
            $routes->get('limpar', 'UsuarioApiController::dbLimpar');
            $routes->get('limpar/(:segment)', 'UsuarioApiController::dbLimpar/$1');
            $routes->get('limpar/(:any)', 'UsuarioApiController::dbLimpar/$1');
            $routes->post('limpar', 'UsuarioApiController::dbLimpar');
            $routes->post('limpar/(:any)', 'UsuarioApiController::dbLimpar/$1');
        });
        # www/bomweb/usuario/endpoint/(:any)
        $routes->group('endpoint', function ($routes) {
            # www/bomweb/usuario/endpoint/cadastrar/(:any)
            $routes->get('cadastrar', 'UsuarioEndPointController::dbCreate');
            $routes->get('cadastrar/(:segment)', 'UsuarioEndPointController::dbCreate/$1');
            $routes->get('cadastrar/(:any)', 'UsuarioEndPointController::dbCreate/$1');
            $routes->post('cadastrar', 'UsuarioEndPointController::dbCreate');
            $routes->post('cadastrar/(:any)', 'UsuarioEndPointController::dbCreate/$1');
            # www/bomweb/usuario/api/exibir/(:any)
            $routes->get('exibir', 'UsuarioEndPointController::dbRead');
            $routes->get('exibir/(:segment)', 'UsuarioEndPointController::dbRead/$1');
            $routes->get('exibir/(:any)', 'UsuarioEndPointController::dbRead/$1');
            $routes->post('exibir', 'UsuarioEndPointController::dbRead');
            $routes->post('exibir/(:any)', 'UsuarioEndPointController::dbRead/$1');
            # www/bomweb/usuario/api/atualizar/(:any)
            $routes->get('atualizar', 'UsuarioEndPointController::dbUpdate');
            $routes->get('atualizar/(:segment)', 'UsuarioEndPointController::dbUpdate/$1');
            $routes->get('atualizar/(:any)', 'UsuarioEndPointController::dbUpdate/$1');
            $routes->post('atualizar', 'UsuarioEndPointController::dbUpdate');
            $routes->post('atualizar/(:any)', 'UsuarioEndPointController::dbUpdate/$1');
            # www/bomweb/usuario/api/deletar/(:any)
            $routes->get('deletar', 'UsuarioEndPointController::dbDelete');
            $routes->get('deletar/(:segment)', 'UsuarioEndPointController::dbDelete/$1');
            $routes->get('deletar/(:any)', 'UsuarioEndPointController::dbDelete/$1');
            $routes->post('deletar', 'UsuarioEndPointController::dbDelete');
            $routes->post('deletar/(:any)', 'UsuarioEndPointController::dbDelete/$1');
            # www/bomweb/usuario/api/limpar/(:any)
            $routes->get('limpar', 'UsuarioEndPointController::dbLimpar');
            $routes->get('limpar/(:segment)', 'UsuarioEndPointController::dbLimpar/$1');
            $routes->get('limpar/(:any)', 'UsuarioEndPointController::dbLimpar/$1');
            $routes->post('limpar', 'UsuarioEndPointController::dbLimpar');
            $routes->post('limpar/(:any)', 'UsuarioEndPointController::dbLimpar/$1');
        });
    });

    # BOM
    $routes->group('bom', function ($routes) {
        # www/bomweb/bom/api/(:any)
        $routes->group('api', function ($routes) {
            # www/bomweb/bom/api/cadastrar/(:any)
            $routes->get('cadastrar', 'BomApiController::dbCreate');
            $routes->get('cadastrar/(:segment)', 'BomApiController::dbCreate/$1');
            $routes->get('cadastrar/(:any)', 'BomApiController::dbCreate/$1');
            $routes->post('cadastrar', 'BomApiController::dbCreate');
            $routes->post('cadastrar/(:any)', 'BomApiController::dbCreate/$1');
            # www/bomweb/bom/api/exibir/(:any)
            $routes->get('exibir', 'BomApiController::dbRead');
            $routes->get('exibir/(:segment)', 'BomApiController::dbRead/$1');
            $routes->get('exibir/(:any)', 'BomApiController::dbRead/$1');
            $routes->post('exibir', 'BomApiController::dbRead');
            $routes->post('exibir/(:any)', 'BomApiController::dbRead/$1');
            # www/bomweb/bom/api/atualizar/(:any)
            $routes->get('atualizar', 'BomApiController::dbUpdate');
            $routes->get('atualizar/(:segment)', 'BomApiController::dbUpdate/$1');
            $routes->get('atualizar/(:any)', 'BomApiController::dbUpdate/$1');
            $routes->post('atualizar', 'BomApiController::dbUpdate');
            $routes->post('atualizar/(:any)', 'BomApiController::dbUpdate/$1');
            # www/bomweb/bom/api/deletar/(:any)
            $routes->get('deletar', 'BomApiController::dbDelete');
            $routes->get('deletar/(:segment)', 'BomApiController::dbDelete/$1');
            $routes->get('deletar/(:any)', 'BomApiController::dbDelete/$1');
            $routes->post('deletar', 'BomApiController::dbDelete');
            $routes->post('deletar/(:any)', 'BomApiController::dbDelete/$1');
            # www/bomweb/bom/api/limpar/(:any)
            $routes->get('limpar', 'BomApiController::dbLimpar');
            $routes->get('limpar/(:segment)', 'BomApiController::dbLimpar/$1');
            $routes->get('limpar/(:any)', 'BomApiController::dbLimpar/$1');
            $routes->post('limpar', 'BomApiController::dbLimpar');
            $routes->post('limpar/(:any)', 'BomApiController::dbLimpar/$1');
        });
        # www/bomweb/bom/endpoint/(:any)
        $routes->group('endpoint', function ($routes) {
            # www/bomweb/bom/endpoint/cadastrar/(:any)
            $routes->get('cadastrar', 'BomEndPointController::dbCreate');
            $routes->get('cadastrar/(:segment)', 'BomEndPointController::dbCreate/$1');
            $routes->get('cadastrar/(:any)', 'BomEndPointController::dbCreate/$1');
            $routes->post('cadastrar', 'BomEndPointController::dbCreate');
            $routes->post('cadastrar/(:any)', 'BomEndPointController::dbCreate/$1');
            # www/bomweb/bom/api/exibir/(:any)
            $routes->get('exibir', 'BomEndPointController::dbRead');
            $routes->get('exibir/(:segment)', 'BomEndPointController::dbRead/$1');
            $routes->get('exibir/(:any)', 'BomEndPointController::dbRead/$1');
            $routes->post('exibir', 'BomEndPointController::dbRead');
            $routes->post('exibir/(:any)', 'BomEndPointController::dbRead/$1');
            # www/bomweb/bom/api/atualizar/(:any)
            $routes->get('atualizar', 'BomEndPointController::dbUpdate');
            $routes->get('atualizar/(:segment)', 'BomEndPointController::dbUpdate/$1');
            $routes->get('atualizar/(:any)', 'BomEndPointController::dbUpdate/$1');
            $routes->post('atualizar', 'BomEndPointController::dbUpdate');
            $routes->post('atualizar/(:any)', 'BomEndPointController::dbUpdate/$1');
            # www/bomweb/bom/api/deletar/(:any)
            $routes->get('deletar', 'BomEndPointController::dbDelete');
            $routes->get('deletar/(:segment)', 'BomEndPointController::dbDelete/$1');
            $routes->get('deletar/(:any)', 'BomEndPointController::dbDelete/$1');
            $routes->post('deletar', 'BomEndPointController::dbDelete');
            $routes->post('deletar/(:any)', 'BomEndPointController::dbDelete/$1');
            # www/bomweb/bom/api/limpar/(:any)
            $routes->get('limpar', 'BomEndPointController::dbLimpar');
            $routes->get('limpar/(:segment)', 'BomEndPointController::dbLimpar/$1');
            $routes->get('limpar/(:any)', 'BomEndPointController::dbLimpar/$1');
            $routes->post('limpar', 'BomEndPointController::dbLimpar');
            $routes->post('limpar/(:any)', 'BomEndPointController::dbLimpar/$1');
        });
    });

    # Relatório
    $routes->group('relatorio', function ($routes) {
        # www/bomweb/relatorio/api/(:any)
        $routes->group('api', function ($routes) {
            # www/bomweb/relatorio/api/cadastrar/(:any)
            $routes->get('cadastrar', 'RelatorioApiController::dbCreate');
            $routes->get('cadastrar/(:segment)', 'RelatorioApiController::dbCreate/$1');
            $routes->get('cadastrar/(:any)', 'RelatorioApiController::dbCreate/$1');
            $routes->post('cadastrar', 'RelatorioApiController::dbCreate');
            $routes->post('cadastrar/(:any)', 'RelatorioApiController::dbCreate/$1');
            # www/bomweb/relatorio/api/exibir/(:any)
            $routes->get('exibir', 'RelatorioApiController::dbRead');
            $routes->get('exibir/(:segment)', 'RelatorioApiController::dbRead/$1');
            $routes->get('exibir/(:any)', 'RelatorioApiController::dbRead/$1');
            $routes->post('exibir', 'RelatorioApiController::dbRead');
            $routes->post('exibir/(:any)', 'RelatorioApiController::dbRead/$1');
            # www/bomweb/relatorio/api/atualizar/(:any)
            $routes->get('atualizar', 'RelatorioApiController::dbUpdate');
            $routes->get('atualizar/(:segment)', 'RelatorioApiController::dbUpdate/$1');
            $routes->get('atualizar/(:any)', 'RelatorioApiController::dbUpdate/$1');
            $routes->post('atualizar', 'RelatorioApiController::dbUpdate');
            $routes->post('atualizar/(:any)', 'RelatorioApiController::dbUpdate/$1');
            # www/bomweb/relatorio/api/deletar/(:any)
            $routes->get('deletar', 'RelatorioApiController::dbDelete');
            $routes->get('deletar/(:segment)', 'RelatorioApiController::dbDelete/$1');
            $routes->get('deletar/(:any)', 'RelatorioApiController::dbDelete/$1');
            $routes->post('deletar', 'RelatorioApiController::dbDelete');
            $routes->post('deletar/(:any)', 'RelatorioApiController::dbDelete/$1');
            # www/bomweb/relatorio/api/limpar/(:any)
            $routes->get('limpar', 'RelatorioApiController::dbLimpar');
            $routes->get('limpar/(:segment)', 'RelatorioApiController::dbLimpar/$1');
            $routes->get('limpar/(:any)', 'RelatorioApiController::dbLimpar/$1');
            $routes->post('limpar', 'RelatorioApiController::dbLimpar');
            $routes->post('limpar/(:any)', 'RelatorioApiController::dbLimpar/$1');
        });
        # www/bomweb/relatorio/endpoint/(:any)
        $routes->group('endpoint', function ($routes) {
            # www/bomweb/relatorio/endpoint/cadastrar/(:any)
            $routes->get('cadastrar', 'RelatorioEndPointController::dbCreate');
            $routes->get('cadastrar/(:segment)', 'RelatorioEndPointController::dbCreate/$1');
            $routes->get('cadastrar/(:any)', 'RelatorioEndPointController::dbCreate/$1');
            $routes->post('cadastrar', 'RelatorioEndPointController::dbCreate');
            $routes->post('cadastrar/(:any)', 'RelatorioEndPointController::dbCreate/$1');
            # www/bomweb/relatorio/api/exibir/(:any)
            $routes->get('exibir', 'RelatorioEndPointController::dbRead');
            $routes->get('exibir/(:segment)', 'RelatorioEndPointController::dbRead/$1');
            $routes->get('exibir/(:any)', 'RelatorioEndPointController::dbRead/$1');
            $routes->post('exibir', 'RelatorioEndPointController::dbRead');
            $routes->post('exibir/(:any)', 'RelatorioEndPointController::dbRead/$1');
            # www/bomweb/relatorio/api/atualizar/(:any)
            $routes->get('atualizar', 'RelatorioEndPointController::dbUpdate');
            $routes->get('atualizar/(:segment)', 'RelatorioEndPointController::dbUpdate/$1');
            $routes->get('atualizar/(:any)', 'RelatorioEndPointController::dbUpdate/$1');
            $routes->post('atualizar', 'RelatorioEndPointController::dbUpdate');
            $routes->post('atualizar/(:any)', 'RelatorioEndPointController::dbUpdate/$1');
            # www/bomweb/relatorio/api/deletar/(:any)
            $routes->get('deletar', 'RelatorioEndPointController::dbDelete');
            $routes->get('deletar/(:segment)', 'RelatorioEndPointController::dbDelete/$1');
            $routes->get('deletar/(:any)', 'RelatorioEndPointController::dbDelete/$1');
            $routes->post('deletar', 'RelatorioEndPointController::dbDelete');
            $routes->post('deletar/(:any)', 'RelatorioEndPointController::dbDelete/$1');
            # www/bomweb/relatorio/api/limpar/(:any)
            $routes->get('limpar', 'RelatorioEndPointController::dbLimpar');
            $routes->get('limpar/(:segment)', 'RelatorioEndPointController::dbLimpar/$1');
            $routes->get('limpar/(:any)', 'RelatorioEndPointController::dbLimpar/$1');
            $routes->post('limpar', 'RelatorioEndPointController::dbLimpar');
            $routes->post('limpar/(:any)', 'RelatorioEndPointController::dbLimpar/$1');
        });
    });

    # Log
    $routes->group('log', function ($routes) {
        # www/bomweb/log/api/(:any)
        $routes->group('api', function ($routes) {
            # www/bomweb/log/api/cadastrar/(:any)
            $routes->get('cadastrar', 'LogApiController::dbCreate');
            $routes->get('cadastrar/(:segment)', 'LogApiController::dbCreate/$1');
            $routes->get('cadastrar/(:any)', 'LogApiController::dbCreate/$1');
            $routes->post('cadastrar', 'LogApiController::dbCreate');
            $routes->post('cadastrar/(:any)', 'LogApiController::dbCreate/$1');
            # www/bomweb/log/api/exibir/(:any)
            $routes->get('exibir', 'LogApiController::dbRead');
            $routes->get('exibir/(:segment)', 'LogApiController::dbRead/$1');
            $routes->get('exibir/(:any)', 'LogApiController::dbRead/$1');
            $routes->post('exibir', 'LogApiController::dbRead');
            $routes->post('exibir/(:any)', 'LogApiController::dbRead/$1');
            # www/bomweb/log/api/atualizar/(:any)
            $routes->get('atualizar', 'LogApiController::dbUpdate');
            $routes->get('atualizar/(:segment)', 'LogApiController::dbUpdate/$1');
            $routes->get('atualizar/(:any)', 'LogApiController::dbUpdate/$1');
            $routes->post('atualizar', 'LogApiController::dbUpdate');
            $routes->post('atualizar/(:any)', 'LogApiController::dbUpdate/$1');
            # www/bomweb/log/api/deletar/(:any)
            $routes->get('deletar', 'LogApiController::dbDelete');
            $routes->get('deletar/(:segment)', 'LogApiController::dbDelete/$1');
            $routes->get('deletar/(:any)', 'LogApiController::dbDelete/$1');
            $routes->post('deletar', 'LogApiController::dbDelete');
            $routes->post('deletar/(:any)', 'LogApiController::dbDelete/$1');
            # www/bomweb/log/api/limpar/(:any)
            $routes->get('limpar', 'LogApiController::dbLimpar');
            $routes->get('limpar/(:segment)', 'LogApiController::dbLimpar/$1');
            $routes->get('limpar/(:any)', 'LogApiController::dbLimpar/$1');
            $routes->post('limpar', 'LogApiController::dbLimpar');
            $routes->post('limpar/(:any)', 'LogApiController::dbLimpar/$1');
        });
        # www/bomweb/log/endpoint/(:any)
        $routes->group('endpoint', function ($routes) {
            # www/bomweb/log/endpoint/cadastrar/(:any)
            $routes->get('cadastrar', 'LogEndPointController::dbCreate');
            $routes->get('cadastrar/(:segment)', 'LogEndPointController::dbCreate/$1');
            $routes->get('cadastrar/(:any)', 'LogEndPointController::dbCreate/$1');
            $routes->post('cadastrar', 'LogEndPointController::dbCreate');
            $routes->post('cadastrar/(:any)', 'LogEndPointController::dbCreate/$1');
            # www/bomweb/log/api/exibir/(:any)
            $routes->get('exibir', 'LogEndPointController::dbRead');
            $routes->get('exibir/(:segment)', 'LogEndPointController::dbRead/$1');
            $routes->get('exibir/(:any)', 'LogEndPointController::dbRead/$1');
            $routes->post('exibir', 'LogEndPointController::dbRead');
            $routes->post('exibir/(:any)', 'LogEndPointController::dbRead/$1');
            # www/bomweb/log/api/atualizar/(:any)
            $routes->get('atualizar', 'LogEndPointController::dbUpdate');
            $routes->get('atualizar/(:segment)', 'LogEndPointController::dbUpdate/$1');
            $routes->get('atualizar/(:any)', 'LogEndPointController::dbUpdate/$1');
            $routes->post('atualizar', 'LogEndPointController::dbUpdate');
            $routes->post('atualizar/(:any)', 'LogEndPointController::dbUpdate/$1');
            # www/bomweb/log/api/deletar/(:any)
            $routes->get('deletar', 'LogEndPointController::dbDelete');
            $routes->get('deletar/(:segment)', 'LogEndPointController::dbDelete/$1');
            $routes->get('deletar/(:any)', 'LogEndPointController::dbDelete/$1');
            $routes->post('deletar', 'LogEndPointController::dbDelete');
            $routes->post('deletar/(:any)', 'LogEndPointController::dbDelete/$1');
            # www/bomweb/log/api/limpar/(:any)
            $routes->get('limpar', 'LogEndPointController::dbLimpar');
            $routes->get('limpar/(:segment)', 'LogEndPointController::dbLimpar/$1');
            $routes->get('limpar/(:any)', 'LogEndPointController::dbLimpar/$1');
            $routes->post('limpar', 'LogEndPointController::dbLimpar');
            $routes->post('limpar/(:any)', 'LogEndPointController::dbLimpar/$1');
        });
    });

    # Configurações
    $routes->group('configuracoes', function ($routes) {
        # www/bomweb/configuracoes/api/(:any)
        $routes->group('api', function ($routes) {
            # www/bomweb/configuracoes/api/cadastrar/(:any)
            $routes->get('cadastrar', 'ConfiguracoesApiController::dbCreate');
            $routes->get('cadastrar/(:segment)', 'ConfiguracoesApiController::dbCreate/$1');
            $routes->get('cadastrar/(:any)', 'ConfiguracoesApiController::dbCreate/$1');
            $routes->post('cadastrar', 'ConfiguracoesApiController::dbCreate');
            $routes->post('cadastrar/(:any)', 'ConfiguracoesApiController::dbCreate/$1');
            # www/bomweb/configuracoes/api/exibir/(:any)
            $routes->get('exibir', 'ConfiguracoesApiController::dbRead');
            $routes->get('exibir/(:segment)', 'ConfiguracoesApiController::dbRead/$1');
            $routes->get('exibir/(:any)', 'ConfiguracoesApiController::dbRead/$1');
            $routes->post('exibir', 'ConfiguracoesApiController::dbRead');
            $routes->post('exibir/(:any)', 'ConfiguracoesApiController::dbRead/$1');
            # www/bomweb/configuracoes/api/atualizar/(:any)
            $routes->get('atualizar', 'ConfiguracoesApiController::dbUpdate');
            $routes->get('atualizar/(:segment)', 'ConfiguracoesApiController::dbUpdate/$1');
            $routes->get('atualizar/(:any)', 'ConfiguracoesApiController::dbUpdate/$1');
            $routes->post('atualizar', 'ConfiguracoesApiController::dbUpdate');
            $routes->post('atualizar/(:any)', 'ConfiguracoesApiController::dbUpdate/$1');
            # www/bomweb/configuracoes/api/deletar/(:any)
            $routes->get('deletar', 'ConfiguracoesApiController::dbDelete');
            $routes->get('deletar/(:segment)', 'ConfiguracoesApiController::dbDelete/$1');
            $routes->get('deletar/(:any)', 'ConfiguracoesApiController::dbDelete/$1');
            $routes->post('deletar', 'ConfiguracoesApiController::dbDelete');
            $routes->post('deletar/(:any)', 'ConfiguracoesApiController::dbDelete/$1');
            # www/bomweb/configuracoes/api/limpar/(:any)
            $routes->get('limpar', 'ConfiguracoesApiController::dbLimpar');
            $routes->get('limpar/(:segment)', 'ConfiguracoesApiController::dbLimpar/$1');
            $routes->get('limpar/(:any)', 'ConfiguracoesApiController::dbLimpar/$1');
            $routes->post('limpar', 'ConfiguracoesApiController::dbLimpar');
            $routes->post('limpar/(:any)', 'ConfiguracoesApiController::dbLimpar/$1');
        });
        # www/bomweb/configuracoes/endpoint/(:any)
        $routes->group('endpoint', function ($routes) {
            # www/bomweb/configuracoes/endpoint/cadastrar/(:any)
            $routes->get('cadastrar', 'ConfiguracoesEndPointController::dbCreate');
            $routes->get('cadastrar/(:segment)', 'ConfiguracoesEndPointController::dbCreate/$1');
            $routes->get('cadastrar/(:any)', 'ConfiguracoesEndPointController::dbCreate/$1');
            $routes->post('cadastrar', 'ConfiguracoesEndPointController::dbCreate');
            $routes->post('cadastrar/(:any)', 'ConfiguracoesEndPointController::dbCreate/$1');
            # www/bomweb/configuracoes/api/exibir/(:any)
            $routes->get('exibir', 'ConfiguracoesEndPointController::dbRead');
            $routes->get('exibir/(:segment)', 'ConfiguracoesEndPointController::dbRead/$1');
            $routes->get('exibir/(:any)', 'ConfiguracoesEndPointController::dbRead/$1');
            $routes->post('exibir', 'ConfiguracoesEndPointController::dbRead');
            $routes->post('exibir/(:any)', 'ConfiguracoesEndPointController::dbRead/$1');
            # www/bomweb/configuracoes/api/atualizar/(:any)
            $routes->get('atualizar', 'ConfiguracoesEndPointController::dbUpdate');
            $routes->get('atualizar/(:segment)', 'ConfiguracoesEndPointController::dbUpdate/$1');
            $routes->get('atualizar/(:any)', 'ConfiguracoesEndPointController::dbUpdate/$1');
            $routes->post('atualizar', 'ConfiguracoesEndPointController::dbUpdate');
            $routes->post('atualizar/(:any)', 'ConfiguracoesEndPointController::dbUpdate/$1');
            # www/bomweb/configuracoes/api/deletar/(:any)
            $routes->get('deletar', 'ConfiguracoesEndPointController::dbDelete');
            $routes->get('deletar/(:segment)', 'ConfiguracoesEndPointController::dbDelete/$1');
            $routes->get('deletar/(:any)', 'ConfiguracoesEndPointController::dbDelete/$1');
            $routes->post('deletar', 'ConfiguracoesEndPointController::dbDelete');
            $routes->post('deletar/(:any)', 'ConfiguracoesEndPointController::dbDelete/$1');
            # www/bomweb/configuracoes/api/limpar/(:any)
            $routes->get('limpar', 'ConfiguracoesEndPointController::dbLimpar');
            $routes->get('limpar/(:segment)', 'ConfiguracoesEndPointController::dbLimpar/$1');
            $routes->get('limpar/(:any)', 'ConfiguracoesEndPointController::dbLimpar/$1');
            $routes->post('limpar', 'ConfiguracoesEndPointController::dbLimpar');
            $routes->post('limpar/(:any)', 'ConfiguracoesEndPointController::dbLimpar/$1');
        });
    });

    # Tarifa Retroativa
    $routes->group('tarifaretroativa', function ($routes) {
        # www/bomweb/tarifaretroativa/api/(:any)
        $routes->group('api', function ($routes) {
            # www/bomweb/tarifaretroativa/api/cadastrar/(:any)
            $routes->get('cadastrar', 'TarifaRetroativaApiController::dbCreate');
            $routes->get('cadastrar/(:segment)', 'TarifaRetroativaApiController::dbCreate/$1');
            $routes->get('cadastrar/(:any)', 'TarifaRetroativaApiController::dbCreate/$1');
            $routes->post('cadastrar', 'TarifaRetroativaApiController::dbCreate');
            $routes->post('cadastrar/(:any)', 'TarifaRetroativaApiController::dbCreate/$1');
            # www/bomweb/tarifaretroativa/api/exibir/(:any)
            $routes->get('exibir', 'TarifaRetroativaApiController::dbRead');
            $routes->get('exibir/(:segment)', 'TarifaRetroativaApiController::dbRead/$1');
            $routes->get('exibir/(:any)', 'TarifaRetroativaApiController::dbRead/$1');
            $routes->post('exibir', 'TarifaRetroativaApiController::dbRead');
            $routes->post('exibir/(:any)', 'TarifaRetroativaApiController::dbRead/$1');
            # www/bomweb/tarifaretroativa/api/atualizar/(:any)
            $routes->get('atualizar', 'TarifaRetroativaApiController::dbUpdate');
            $routes->get('atualizar/(:segment)', 'TarifaRetroativaApiController::dbUpdate/$1');
            $routes->get('atualizar/(:any)', 'TarifaRetroativaApiController::dbUpdate/$1');
            $routes->post('atualizar', 'TarifaRetroativaApiController::dbUpdate');
            $routes->post('atualizar/(:any)', 'TarifaRetroativaApiController::dbUpdate/$1');
            # www/bomweb/tarifaretroativa/api/deletar/(:any)
            $routes->get('deletar', 'TarifaRetroativaApiController::dbDelete');
            $routes->get('deletar/(:segment)', 'TarifaRetroativaApiController::dbDelete/$1');
            $routes->get('deletar/(:any)', 'TarifaRetroativaApiController::dbDelete/$1');
            $routes->post('deletar', 'TarifaRetroativaApiController::dbDelete');
            $routes->post('deletar/(:any)', 'TarifaRetroativaApiController::dbDelete/$1');
            # www/bomweb/tarifaretroativa/api/limpar/(:any)
            $routes->get('limpar', 'TarifaRetroativaApiController::dbLimpar');
            $routes->get('limpar/(:segment)', 'TarifaRetroativaApiController::dbLimpar/$1');
            $routes->get('limpar/(:any)', 'TarifaRetroativaApiController::dbLimpar/$1');
            $routes->post('limpar', 'TarifaRetroativaApiController::dbLimpar');
            $routes->post('limpar/(:any)', 'TarifaRetroativaApiController::dbLimpar/$1');
        });
        # www/bomweb/tarifaretroativa/endpoint/(:any)
        $routes->group('endpoint', function ($routes) {
            # www/bomweb/tarifaretroativa/endpoint/cadastrar/(:any)
            $routes->get('cadastrar', 'TarifaRetroativaEndPointController::dbCreate');
            $routes->get('cadastrar/(:segment)', 'TarifaRetroativaEndPointController::dbCreate/$1');
            $routes->get('cadastrar/(:any)', 'TarifaRetroativaEndPointController::dbCreate/$1');
            $routes->post('cadastrar', 'TarifaRetroativaEndPointController::dbCreate');
            $routes->post('cadastrar/(:any)', 'TarifaRetroativaEndPointController::dbCreate/$1');
            # www/bomweb/tarifaretroativa/api/exibir/(:any)
            $routes->get('exibir', 'TarifaRetroativaEndPointController::dbRead');
            $routes->get('exibir/(:segment)', 'TarifaRetroativaEndPointController::dbRead/$1');
            $routes->get('exibir/(:any)', 'TarifaRetroativaEndPointController::dbRead/$1');
            $routes->post('exibir', 'TarifaRetroativaEndPointController::dbRead');
            $routes->post('exibir/(:any)', 'TarifaRetroativaEndPointController::dbRead/$1');
            # www/bomweb/tarifaretroativa/api/atualizar/(:any)
            $routes->get('atualizar', 'TarifaRetroativaEndPointController::dbUpdate');
            $routes->get('atualizar/(:segment)', 'TarifaRetroativaEndPointController::dbUpdate/$1');
            $routes->get('atualizar/(:any)', 'TarifaRetroativaEndPointController::dbUpdate/$1');
            $routes->post('atualizar', 'TarifaRetroativaEndPointController::dbUpdate');
            $routes->post('atualizar/(:any)', 'TarifaRetroativaEndPointController::dbUpdate/$1');
            # www/bomweb/tarifaretroativa/api/deletar/(:any)
            $routes->get('deletar', 'TarifaRetroativaEndPointController::dbDelete');
            $routes->get('deletar/(:segment)', 'TarifaRetroativaEndPointController::dbDelete/$1');
            $routes->get('deletar/(:any)', 'TarifaRetroativaEndPointController::dbDelete/$1');
            $routes->post('deletar', 'TarifaRetroativaEndPointController::dbDelete');
            $routes->post('deletar/(:any)', 'TarifaRetroativaEndPointController::dbDelete/$1');
            # www/bomweb/tarifaretroativa/api/limpar/(:any)
            $routes->get('limpar', 'TarifaRetroativaEndPointController::dbLimpar');
            $routes->get('limpar/(:segment)', 'TarifaRetroativaEndPointController::dbLimpar/$1');
            $routes->get('limpar/(:any)', 'TarifaRetroativaEndPointController::dbLimpar/$1');
            $routes->post('limpar', 'TarifaRetroativaEndPointController::dbLimpar');
            $routes->post('limpar/(:any)', 'TarifaRetroativaEndPointController::dbLimpar/$1');
        });
    });

    # Importar Linhas
    $routes->group('importarlinhas', function ($routes) {
        # www/bomweb/importarlinhas/api/(:any)
        $routes->group('api', function ($routes) {
            # www/bomweb/importarlinhas/api/cadastrar/(:any)
            $routes->get('cadastrar', 'ImportarLinhasApiController::dbCreate');
            $routes->get('cadastrar/(:segment)', 'ImportarLinhasApiController::dbCreate/$1');
            $routes->get('cadastrar/(:any)', 'ImportarLinhasApiController::dbCreate/$1');
            $routes->post('cadastrar', 'ImportarLinhasApiController::dbCreate');
            $routes->post('cadastrar/(:any)', 'ImportarLinhasApiController::dbCreate/$1');
            # www/bomweb/importarlinhas/api/exibir/(:any)
            $routes->get('exibir', 'ImportarLinhasApiController::dbRead');
            $routes->get('exibir/(:segment)', 'ImportarLinhasApiController::dbRead/$1');
            $routes->get('exibir/(:any)', 'ImportarLinhasApiController::dbRead/$1');
            $routes->post('exibir', 'ImportarLinhasApiController::dbRead');
            $routes->post('exibir/(:any)', 'ImportarLinhasApiController::dbRead/$1');
            # www/bomweb/importarlinhas/api/atualizar/(:any)
            $routes->get('atualizar', 'ImportarLinhasApiController::dbUpdate');
            $routes->get('atualizar/(:segment)', 'ImportarLinhasApiController::dbUpdate/$1');
            $routes->get('atualizar/(:any)', 'ImportarLinhasApiController::dbUpdate/$1');
            $routes->post('atualizar', 'ImportarLinhasApiController::dbUpdate');
            $routes->post('atualizar/(:any)', 'ImportarLinhasApiController::dbUpdate/$1');
            # www/bomweb/importarlinhas/api/deletar/(:any)
            $routes->get('deletar', 'ImportarLinhasApiController::dbDelete');
            $routes->get('deletar/(:segment)', 'ImportarLinhasApiController::dbDelete/$1');
            $routes->get('deletar/(:any)', 'ImportarLinhasApiController::dbDelete/$1');
            $routes->post('deletar', 'ImportarLinhasApiController::dbDelete');
            $routes->post('deletar/(:any)', 'ImportarLinhasApiController::dbDelete/$1');
            # www/bomweb/importarlinhas/api/limpar/(:any)
            $routes->get('limpar', 'ImportarLinhasApiController::dbLimpar');
            $routes->get('limpar/(:segment)', 'ImportarLinhasApiController::dbLimpar/$1');
            $routes->get('limpar/(:any)', 'ImportarLinhasApiController::dbLimpar/$1');
            $routes->post('limpar', 'ImportarLinhasApiController::dbLimpar');
            $routes->post('limpar/(:any)', 'ImportarLinhasApiController::dbLimpar/$1');
        });
        # www/bomweb/importarlinhas/endpoint/(:any)
        $routes->group('endpoint', function ($routes) {
            # www/bomweb/importarlinhas/endpoint/cadastrar/(:any)
            $routes->get('cadastrar', 'ImportarLinhasEndPointController::dbCreate');
            $routes->get('cadastrar/(:segment)', 'ImportarLinhasEndPointController::dbCreate/$1');
            $routes->get('cadastrar/(:any)', 'ImportarLinhasEndPointController::dbCreate/$1');
            $routes->post('cadastrar', 'ImportarLinhasEndPointController::dbCreate');
            $routes->post('cadastrar/(:any)', 'ImportarLinhasEndPointController::dbCreate/$1');
            # www/bomweb/importarlinhas/api/exibir/(:any)
            $routes->get('exibir', 'ImportarLinhasEndPointController::dbRead');
            $routes->get('exibir/(:segment)', 'ImportarLinhasEndPointController::dbRead/$1');
            $routes->get('exibir/(:any)', 'ImportarLinhasEndPointController::dbRead/$1');
            $routes->post('exibir', 'ImportarLinhasEndPointController::dbRead');
            $routes->post('exibir/(:any)', 'ImportarLinhasEndPointController::dbRead/$1');
            # www/bomweb/importarlinhas/api/atualizar/(:any)
            $routes->get('atualizar', 'ImportarLinhasEndPointController::dbUpdate');
            $routes->get('atualizar/(:segment)', 'ImportarLinhasEndPointController::dbUpdate/$1');
            $routes->get('atualizar/(:any)', 'ImportarLinhasEndPointController::dbUpdate/$1');
            $routes->post('atualizar', 'ImportarLinhasEndPointController::dbUpdate');
            $routes->post('atualizar/(:any)', 'ImportarLinhasEndPointController::dbUpdate/$1');
            # www/bomweb/importarlinhas/api/deletar/(:any)
            $routes->get('deletar', 'ImportarLinhasEndPointController::dbDelete');
            $routes->get('deletar/(:segment)', 'ImportarLinhasEndPointController::dbDelete/$1');
            $routes->get('deletar/(:any)', 'ImportarLinhasEndPointController::dbDelete/$1');
            $routes->post('deletar', 'ImportarLinhasEndPointController::dbDelete');
            $routes->post('deletar/(:any)', 'ImportarLinhasEndPointController::dbDelete/$1');
            # www/bomweb/importarlinhas/api/limpar/(:any)
            $routes->get('limpar', 'ImportarLinhasEndPointController::dbLimpar');
            $routes->get('limpar/(:segment)', 'ImportarLinhasEndPointController::dbLimpar/$1');
            $routes->get('limpar/(:any)', 'ImportarLinhasEndPointController::dbLimpar/$1');
            $routes->post('limpar', 'ImportarLinhasEndPointController::dbLimpar');
            $routes->post('limpar/(:any)', 'ImportarLinhasEndPointController::dbLimpar/$1');
        });
    });
});

# 
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
            # www/exemple/group/endpoint/bom_relatorio_pendente/(:any)
            $routes->get('bom_relatorio_pendente', 'ExampleEndpointController::bomRelatorioPendente');
            $routes->get('bom_relatorio_pendente/(:segment)', 'ExampleEndpointController::bomRelatorioPendente/$1');
            $routes->get('bom_relatorio_pendente/(:any)', 'ExampleEndpointController::bomRelatorioPendente/$1');
            $routes->post('bom_relatorio_pendente', 'ExampleEndpointController::bomRelatorioPendente');
            $routes->post('bom_relatorio_pendente/(:any)', 'ExampleEndpointController::bomRelatorioPendente/$1');
            # www/exemple/group/endpoint/bom_relatorio_cadastrar/(:any)
            $routes->get('bom_relatorio_cadastrar', 'ExampleEndpointController::bomRelatorioCadastrar');
            $routes->get('bom_relatorio_cadastrar/(:segment)', 'ExampleEndpointController::bomRelatorioCadastrar/$1');
            $routes->get('bom_relatorio_cadastrar/(:any)', 'ExampleEndpointController::bomRelatorioCadastrar/$1');
            $routes->post('bom_relatorio_cadastrar', 'ExampleEndpointController::bomRelatorioCadastrar');
            $routes->post('bom_relatorio_cadastrar/(:any)', 'ExampleEndpointController::bomRelatorioCadastrar/$1');
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