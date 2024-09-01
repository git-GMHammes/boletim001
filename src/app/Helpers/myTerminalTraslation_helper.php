<?php

if (!function_exists('myTerminalTraslation')) {
    function myTerminalTraslation($text)
    {
        $translator['preferred_username'] = 'ID SSO';
        $translator['name'] = 'Nome';
        $translator['slug_profile_id'] = 'perfil pelo ID';
        $translator['email'] = 'e-mail';
        $translator['created_at'] = 'criado em';
        $translator['updated_at'] = 'atualizado em';
        $translator['deleted_at'] = 'excluído em';
        $translator['select_icone'] = 'ID do ícone';
        $translator['rotulo'] = 'rótulo';
        $translator['url'] = 'endereço web';
        $translator['id'] = 'identificação';
        $translator['token_csrf'] = 'token de segurança do comando';
        $translator['debug-bar-state'] = 'estado de Depuração';
        $translator['ci_session'] = 'código da Sessão';
        foreach ($translator as $chave => $valor) {
            if ($chave === $text) {
                $var = $valor;
                break;
            }
        }
        if (isset($var)) {
            return $var;
        } else {
            return $text;
        }
    }
}

if (!function_exists('myFirstLetterRelease')) {
    function myFirstLetterRelease($text)
    {
        return $text;
    }
}
