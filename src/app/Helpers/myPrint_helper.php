<?php

/**
 * This file is part of CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

// CodeIgniter myPrint

if (!function_exists('myPrint')) {
    # retorna os dados de um determinado item no código
    function myPrint($value, $local, $continuous = NULL, $server = NULL)
    {
        if (DEBUG_MY_PRINT) {
            if ($continuous !== NULL) {
                echo "<pre>";
                print_r($value);
                echo "<br> \n";
                print_r($local);
                echo "</pre>";
                if ($server !== NULL) {
                    echo "<pre>";
                    # echo "<br/>" . "_ENV REQUEST_METHOD: " . $_ENV['REQUEST_METHOD']; # GET
                    echo "<br/>" . "_SERVER HTTP_HOST: " . $_SERVER['HTTP_HOST']; # site.com.br 
                    # echo "<br/>" . "_ENV SERVER_NAME: " . $_ENV['SERVER_NAME']; # site.com.br
                    # echo "<br/>" . "_ENV REMOTE_ADDR: " . $_ENV['REMOTE_ADDR']; # 177.12.58.88
                    # echo "<br/>" . "_ENV SERVER_ADDR: " . $_ENV['SERVER_ADDR']; # 187.1.138.2
                    echo "<br/>" . "_SERVER PATH_INFO: " . $_SERVER['PATH_INFO']; # /lp/form
                    # echo "<br/>" . "_ENV SCRIPT_URL: " . $_ENV['SCRIPT_URL']; # /ci4/public/lp/form
                    # echo "<br/>" . "_SERVER SCRIPT_URL: " . $_SERVER['SCRIPT_URL']; # /ci4/public/lp/form
                    echo "<br/>" . "_SERVER REQUEST_URI: " . $_SERVER['REQUEST_URI']; # /ci4/public/lp/form
                    echo "<br/>" . "_SERVER PHP_SELF: " . $_SERVER['PHP_SELF']; # /ci4/public/index.php/lp/form
                    # echo "<br/>" . "_ENV SCRIPT_URI: " . $_ENV['SCRIPT_URI']; # http://site.com.br/ci4/public/lp/form
                    # echo "<br/>" . "_SERVER SCRIPT_URI: " . $_SERVER['SCRIPT_URI']; # http://site.com.br/ci4/public/lp/form
                    echo "<br/>" . "_SERVER HTTP_USER_AGENT: " . $_SERVER['HTTP_USER_AGENT']; # Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:102.0) Gecko/20100101 Firefox/102.0
                    echo "<br/>" . "_SERVER DOCUMENT_ROOT: " . $_SERVER['DOCUMENT_ROOT']; # /home/site/www/
                    echo "<br/>" . "_SERVER PATH_TRANSLATED: " . $_SERVER['PATH_TRANSLATED']; # /home/site/www/lp/form
                    echo "<br/>" . "_SERVER SCRIPT_FILENAME: " . $_SERVER['SCRIPT_FILENAME']; # //home/site/www/ci4/public/index.php
                    # echo "<br/>" . "_SERVER UNIQUE_ID: " . $_SERVER['UNIQUE_ID']; # Yt6FlF91xHQpctjjinBiwAAAAEs 
                    echo "</pre>";
                    var_dump($value);
                }
            } else {
                echo "<pre>";
                print_r($value);
                echo "<br> \n";
                print_r($local);
                echo "</pre>";
                if ($server !== NULL) {
                    echo "<pre>";
                    # echo "<br/>" . "_ENV REQUEST_METHOD: " . $_ENV['REQUEST_METHOD']; # GET
                    echo "<br/>" . "_SERVER HTTP_HOST: " . $_SERVER['HTTP_HOST']; # site.com.br 
                    # echo "<br/>" . "_ENV SERVER_NAME: " . $_ENV['SERVER_NAME']; # site.com.br
                    # echo "<br/>" . "_ENV REMOTE_ADDR: " . $_ENV['REMOTE_ADDR']; # 177.12.58.88
                    # echo "<br/>" . "_ENV SERVER_ADDR: " . $_ENV['SERVER_ADDR']; # 187.1.138.2
                    echo "<br/>" . "_SERVER PATH_INFO: " . $_SERVER['PATH_INFO']; # /lp/form
                    # echo "<br/>" . "_ENV SCRIPT_URL: " . $_ENV['SCRIPT_URL']; # /ci4/public/lp/form
                    # echo "<br/>" . "_SERVER SCRIPT_URL: " . $_SERVER['SCRIPT_URL']; # /ci4/public/lp/form
                    echo "<br/>" . "_SERVER REQUEST_URI: " . $_SERVER['REQUEST_URI']; # /ci4/public/lp/form
                    echo "<br/>" . "_SERVER PHP_SELF: " . $_SERVER['PHP_SELF']; # /ci4/public/index.php/lp/form
                    # echo "<br/>" . "_ENV SCRIPT_URI: " . $_ENV['SCRIPT_URI']; # http://site.com.br/ci4/public/lp/form
                    # echo "<br/>" . "_SERVER SCRIPT_URI: " . $_SERVER['SCRIPT_URI']; # http://site.com.br/ci4/public/lp/form
                    echo "<br/>" . "_SERVER HTTP_USER_AGENT: " . $_SERVER['HTTP_USER_AGENT']; # Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:102.0) Gecko/20100101 Firefox/102.0
                    echo "<br/>" . "_SERVER DOCUMENT_ROOT: " . $_SERVER['DOCUMENT_ROOT']; # /home/site/www/
                    echo "<br/>" . "_SERVER PATH_TRANSLATED: " . $_SERVER['PATH_TRANSLATED']; # /home/site/www/lp/form
                    echo "<br/>" . "_SERVER SCRIPT_FILENAME: " . $_SERVER['SCRIPT_FILENAME']; # //home/site/www/ci4/public/index.php
                    # echo "<br/>" . "_SERVER UNIQUE_ID: " . $_SERVER['UNIQUE_ID']; # Yt6FlF91xHQpctjjinBiwAAAAEs 
                    echo "</pre>";
                    var_dump($value);
                    echo "</pre><br/>";
                }
                exit($_SERVER['PHP_SELF']);
            }
        }
        return NULL;
    }

    /**
     * This file is part of CodeIgniter 4 framework.
     *
     * (c) CodeIgniter Foundation <admin@codeigniter.com>
     *
     * For the full copyright and license information, please view
     * the LICENSE file that was distributed with this source code.
     */

    // CodeIgniter Teste de funções

    if (!function_exists('myTeste')) {
        function myTeste($parameter = NULL)
        {
            if (is_array($parameter) and $parameter != array()) {
                $path = implode('/', $parameter);
                $uri = base_url() . '/qlikadmin/api/bidding/list/first/' . $path;
            } elseif (is_string($parameter)) {
                $uri = base_url() . '/qlikadmin/api/bidding/list/first/' . $parameter;
            } elseif ($parameter == NULL) {
                $uri = base_url() . '/qlikadmin/api/bidding/list/first/';
            }
            return ($uri);
        }
    }
}
