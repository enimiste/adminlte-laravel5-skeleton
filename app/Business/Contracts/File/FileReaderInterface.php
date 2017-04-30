<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 09/04/2016
 * Time: 10:19
 */

namespace App\Business\Contracts\File;


interface FileReaderInterface
{

    /**
     * @param string $filePath absolute path
     *
     * @return string
     *
     * @throws \Exception
     */
    function getContents($filePath);
}