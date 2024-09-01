<?php

/**
 * This file is part of CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

// CodeIgniter myIdUFF

if (!function_exists('myIdUFF')) {
    # retorna os dados de um determinado item no código
    function myIdUFF($numberBytes = 8)
    {
        $random = random_bytes($numberBytes);
        return bin2hex($random);
    }
}
