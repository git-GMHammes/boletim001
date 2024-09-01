<?php
if (!function_exists('jwtCookie')) {
    function jwtCookie()
    {
        $dbResponse = "ERRO";
        require_once(APPPATH . 'Libraries/JWT/src/BeforeValidException.php');
        require_once(APPPATH . 'Libraries/JWT/src/ExpiredException.php');
        require_once(APPPATH . 'Libraries/JWT/src/SignatureInvalidException.php');
        require_once(APPPATH . 'Libraries/JWT/src/JWT.php');
        $key = D2B5A170764157EB93CFCBF66151A70C; // Lembre-se de manter esta chave segura!
        $shelf_life = time() + (10 * 60 * 60); // 10 horas
        $request = service('request');
        $processRequest = (array)$request->getVar();
        // myPrint($processRequest, 'src\app\Controllers\UserApiController.php', true);
        if (isset($processRequest['enviar'])) {
            unset($processRequest['enviar']);
        }
        try {
            $logSystem = [
                'user' => 'gmhammes',
                'profile' => 'su',
                'token' => strtoupper(md5(time())),
            ];
            session()->set('logSystem',  $logSystem);
            session()->markAsTempdata('logSystem', 28800);

            $token = array(
                "iss" => $_SERVER['REQUEST_SCHEME'] . $_SERVER['SERVER_NAME'],
                "aud" => $_SERVER['REQUEST_SCHEME'] . $_SERVER['SERVER_NAME'],
                "iat" => 1356999524,
                "nbf" => 1357000000,
                "data" => array(
                    "userId" => $logSystem['user'], // Id do usuário
                    "userEmail" => $logSystem['profile'] // Email do usuário ou qualquer outro dado que você queira incluir
                )
            );
            $header = [
                "alg" => "HS256",
                "typ" => "JWT",
                "kid" => "key1" // Adicione o kid ao cabeçalho
            ];
            $jwt = \Firebase\JWT\JWT::encode($token, $key, 'HS256', null, $header);
            // myPrint($jwt, 'www\ci431\app\Controllers\FunarjEditalGTCController.php, Line: 240', true);
            // Definindo o cookie
            setcookie('token', $jwt, [
                'expires' => $shelf_life,
                'path' => '/',
                'secure' => true, // cookies serão enviados apenas através de conexões seguras
                'httponly' => true, // cookies não serão acessíveis através de scripts do lado do cliente
                'samesite' => 'None' // os cookies serão enviados com requisições cross-site
            ]);
        } catch (\Exception $e) {
            $systemReport['danger'] = $e->getMessage();
            $message['message']['warning'] = [
                'Problemas ao Montar o Menu',
                'Erro: src\app\Filters\ProfileMenuFilter.php'
            ];
            session()->set('message',  $message);
            session()->markAsTempdata('message', 5);
        }
    }
}
