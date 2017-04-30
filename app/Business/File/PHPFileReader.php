<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 09/04/2016
 * Time: 10:22
 */

namespace Org\Asso\Business\File;


use Org\Asso\Business\Contracts\File\FileReaderInterface;

class PHPFileReader implements FileReaderInterface {

	/**
	 * @param string $filePath
	 *
	 * @return string
	 *
	 * @throws \Exception
	 */
	function getContents( $filePath ) {
		return file_get_contents( $filePath );
	}
}