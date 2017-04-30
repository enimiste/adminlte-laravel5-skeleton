<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 09/04/2016
 * Time: 10:19
 */

namespace App\Business\Contracts\File;


interface FileWriterInterface
{

    /**
     * @param string $filePath absolute path
     * @param string $content
     * @param bool $append if true the content will be appended to the existing file
     *
     * @return bool
     */
    function setContents($filePath, $content, $append = false);
}