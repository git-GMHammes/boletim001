<?php

/**
 * This file is part of CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

// CodeIgniter myResolution Helpers

if (!function_exists('myResolution')) {
    /**
     * Devolve um array com a resolução da Tela
     */
    function myResolution()
    {
        $screen_resolution = array(
            '<script type=\"text/javascript\">',
            'var tela_height = screen.height;',
            'var tela_width = screen.width;',
            '</script>'
        );
        $code_php = var_dump(implode(" ", $screen_resolution));
        return ($code_php);
    }
}
