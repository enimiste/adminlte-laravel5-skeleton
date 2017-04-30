<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 20/12/16
 * Time: 14:47
 */

use Illuminate\Contracts\Cache\Repository;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Debug\Dumper;
use Org\Asso\Business\Contracts\File\FileWriterInterface;

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

if (! function_exists('logs_path')) {
    /**
     * Get the path to the storage/logs folder.
     *
     * @param  string  $path
     * @return string
     */
    function logs_path($path = '')
    {
        return app('path.storage'). DIRECTORY_SEPARATOR . 'logs' . ($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if (!function_exists('move_from_fs_to_temp_file')) {
    /**
     * @param Filesystem $fs
     * @param string $fsPath
     * @return string temp file path
     */
    function move_from_fs_to_temp_file(Filesystem $fs, $fsPath)
    {
        /** @var Repository $cache */
        $cache = app(Repository::class);

        $tmpDir = sys_get_temp_dir();
        //$tmpFile = $tmpDir . DIRECTORY_SEPARATOR . random_int(1, 1000) . '_' . time() . '.' . basename($fsPath);

        $key = $tmpDir . DIRECTORY_SEPARATOR . sha1(serialize($fs) . $fsPath) . '_' . basename($fsPath);
        if (!file_exists($key)) {
            /** @var FileWriterInterface $fileWriter */
            $fileWriter = app(FileWriterInterface::class);
            $fileWriter->setContents($key, $fs->get($fsPath), false);
        }

        return $key;
    }
}


if (!function_exists('can_i')) {
    /**
     * @param string $permission_code
     * @return bool
     */
    function can_i($permission_code)
    {
        if (!env('ENABLE_API_AUTH', false) Or !env('ENABLE_AUTHORISATION', true))
            return true;
        else {
            $user = \Auth::user();
            $permissions = $user->getPermissions();
            return $permissions->contains($permission_code);
        }
    }
}
