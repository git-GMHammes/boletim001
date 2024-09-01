<?php

/**
 * This file is part of CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use CodeIgniter\HTTP\Response;

// CodeIgniter myIdUFF

if (!function_exists('myCaptchaTimestamp')) {
    # retorna os dados de um determinado item no código
    function myCaptchaTimestamp()
    {
        $num_str[0] = rand(0, -25);
        $upper = strtoupper(md5(time()));
        $substr = substr($upper, $num_str[0], 6);
        $pad_left = str_pad($substr, 6, 'P', STR_PAD_LEFT);
        $explode[] = substr($pad_left, 0, 1);
        $explode[] = substr($pad_left, 1, 1);
        $explode[] = substr($pad_left, 2, 1);
        $explode[] = substr($pad_left, 3, 1);
        $explode[] = substr($pad_left, 4, 1);
        $explode[] = substr($pad_left, 5, 1);
        return ($explode);
    }
}

// CodeIgniter myIdUFF

if (!function_exists('myCaptchaRotate')) {
    # retorna os dados de um determinado item no código
    function myCaptchaRotate()
    {
        // transform: rotate
        $num_str[] = rand(-45, 45);
        $val = implode("", $num_str);
        return ("rotate({$val}deg)");
    }
}

// CodeIgniter myIdUFF

if (!function_exists('myCaptchaImg')) {
    # retorna os dados de um determinado item no código
    function myCaptchaImg()
    {
        $num_str[] = rand(0, 99);
        $val = implode("", $num_str);
        $response = str_pad($val, 3, '0', STR_PAD_LEFT);
        return ($response);
    }
}

// CodeIgniter myIdUFF

if (!function_exists('myCaptchaColor')) {
    # retorna os dados de um determinado item no código
    function myCaptchaColor()
    {
        $color = array(
            '#000000',
            '#000080',
            '#00008B',
            '#0000CD',
            '#0000FF',
            '#006400',
            '#008000',
            '#008080',
            '#008B8B',
            '#00BFFF',
            '#00CED1',
            '#00FA9A',
            '#00FF00',
            '#00FF7F',
            '#00FFFF',
            '#191970',
            '#1C1C1C',
            '#1E90FF',
            '#20B2AA',
            '#228B22',
            '#2E8B57',
            '#2F4F4F',
            '#32CD32',
            '#363636',
            '#3CB371',
            '#40E0D0',
            '#4169E1',
            '#4682B4',
            '#483D8B',
            '#48D1CC',
            '#4B0082',
            '#4F4F4F',
            '#556B2F',
            '#5F9EA0',
            '#6495ED',
            '#66CDAA',
            '#6959CD',
            '#696969',
            '#6A5ACD',
            '#708090',
            '#778899',
            '#7B68EE',
            '#7CFC00',
            '#7FFF00',
            '#7FFFD4',
            '#800000',
            '#808000',
            // '#808080',
            '#836FFF',
            '#87CEEB',
            '#87CEFA',
            '#8A2BE2',
            '#8B0000',
            '#8B008B',
            '#8B4513',
            // '#8FBC8F',
            '#90EE90',
            '#9370DB',
            '#9400D3',
            '#98FB98',
            '#9932CC',
            '#9ACD32',
            '#A020F0',
            '#A0522D',
            '#A52A2A',
            '#A9A9A9',
            '#ADD8E6',
            '#ADFF2F',
            '#B0C4DE',
            '#B0E0E6',
            '#B22222',
            '#B8860B',
            '#BA55D3',
            '#BC8F8F',
            // '#BDB76B',
            // '#C0C0C0',
            '#C71585',
            '#CD5C5C',
            '#CD853F',
            '#D2691E',
            // '#D2B48C',
            // '#D3D3D3',
            // '#D8BFD8',
            '#DA70D6',
            '#DAA520',
            '#DB7093',
            '#DC143C',
            // '#DCDCDC',
            '#DDA0DD',
            '#DEB887',
            // '#E0FFFF',
            // '#E6E6FA',
            '#E9967A',
            '#EE82EE',
            // '#EEE8AA',
            '#F08080',
            // '#F0E68C',
            // '#F0F8FF',
            // '#F0FFF0',
            // '#F0FFFF',
            '#F4A460',
            // '#F5DEB3',
            // '#F5F5DC',
            // '#F5F5F5',
            // '#F5FFFA',
            // '#F8F8FF',
            '#FA8072',
            // '#FAEBD7',
            // '#FAF0E6',
            // '#FAFAD2',
            // '#FDF5E6',
            '#FF0000',
            '#FF00FF',
            '#FF1493',
            '#FF4500',
            '#FF6347',
            '#FF69B4',
            '#FF7F50',
            '#FF8C00',
            '#FFA07A',
            '#FFA500',
            '#FFB6C1',
            '#FFC0CB',
            '#FFD700',
            '#FFDAB9',
            // '#FFDEAD',
            // '#FFE4B5',
            // '#FFE4C4',
            // '#FFE4E1',
            // '#FFEBCD',
            // '#FFEFD5',
            // '#FFF0F5',
            // '#FFF5EE',
            // '#FFF8DC',
            // '#FFFACD',
            // '#FFFAF0',
            '#FFFAFA',
            '#FFFF00',
            // '#FFFFE0',
            '#FFFFF0',
            '#6B8E23'
        );
        $rand_keys = array_rand($color, 2);
        $captchaColor[] = $color[$rand_keys[0]];
        # -- Nome completo
        return implode(" ", $captchaColor);
    }
}
