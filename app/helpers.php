<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 20/12/16
 * Time: 14:47
 */

use Illuminate\Support\Debug\Dumper;

if (!function_exists('dd_multi')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed
     * @return void
     */
    function dd_multi()
    {
        array_map(function ($x) {
            (new Dumper)->dump($x);
        }, func_get_args());
    }
}

if (!function_exists('array_nth')) {
    /**
     * Get the nth element from the array
     * @param array $arr
     * @param int $nth from 0
     *
     * @return mixed null if not found
     */
    function array_nth(array $arr, $nth)
    {
        $i = 0;
        foreach ($arr as $k => $v) {
            if ($i === $nth) return $v;
            $i++;
        }
        return null;
    }
}

if (!function_exists('add_if_macosx')) {
    /**
     * @param array $config
     * @param string $key
     * @param string $value
     * @return array
     */
    function add_if_macosx(array $config, $key, $value)
    {
        if (env('IS_MAC_OSX')) {
            $config[$key] = $value;
        }
        return $config;
    }
}

