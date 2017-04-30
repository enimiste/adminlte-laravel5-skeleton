<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 09/04/2016
 * Time: 10:22
 */

namespace App\Business\File;


use App\Business\Contracts\File\FileWriterInterface;

class PHPFileWriter implements FileWriterInterface {

	/**
	 * @param string $filePath
	 * @param        $content
	 * @param bool   $append if true the content will be appended to the existing file
	 *
	 * @return bool
	 */
	function setContents( $filePath, $content, $append = false ) {
		if ( $append ) {
			return file_put_contents( $filePath, $content, FILE_APPEND );
		} else {
			return file_put_contents( $filePath, $content );
		}
	}
}