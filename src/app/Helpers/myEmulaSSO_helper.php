<?php

/**
 * This file is part of CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

// CodeIgniter My CPF validation Helpers

if (!function_exists('myEmulaSSO')) {
    /**
     * Valida o CPF para o sistema
     */
    function myEmulaSSO()
    {
        $myReturn = array(
            'exp' => '1704799303',
            'iat' => '1704799003',
            'auth_time' => '1704798634',
            'jti' => '7c2c2ff6-d862-4110-a237-0bd0e57b0a61',
            'iss' => 'https://login.rj.gov.br/auth/realms/rj',
            'aud' => array(
                'broker',
                'account',
            ),
            'sub' => '718ec8f7-9e1d-4e38-8545-5b9118122317',
            'typ' => 'Bearer',
            'azp' => 'degase',
            'session_state' => 'ce67bedb-97b2-414d-9b97-6b5ad1a9b24c',
            'acr' => 0,
            'realm_access' => array(
                'roles' => array(
                    'offline_access',
                    'default-roles-rj',
                    'gov-br',
                    'uma_authorization',
                    'cidadao-valid-user',
                ),
            ),
            'resource_access' => array(
                'broker' => array(
                    'roles' => array(
                        'read-token',
                    ),
                ),
                'account' => array(
                    'roles' => array(
                        'manage-account',
                        'manage-account-links',
                        'view-profile',
                    ),
                ),
            ),
            'scope' => 'profile email',
            'sid' => 'ce67bedb-97b2-414d-9b97-6b5ad1a9b24c',
            'email_verified' => 1,
            'name' => 'DESENVOLVEDOR em HOMOLOGAÇÃO',
            'preferred_username' => '00000000000',
            'given_name' => 'DESENVOLVEDOR em',
            'family_name' => 'MOMOLOGAÇÃO',
            'picture' => 'https://sso.acesso.gov.br/userinfo/picture',
            'email' => 'homologa2024@proderj.com'
        );

        return ($myReturn);
    }
}
