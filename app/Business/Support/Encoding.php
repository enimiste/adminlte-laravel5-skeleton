<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 09/04/2016
 * Time: 11:05
 */

namespace App\Business\Support;


class Encoding {

	/**
	 * Decode a string to utf-8 from utf-8 to $to encoding
	 *
	 * @param string $str
	 *
	 * @param string $to source encoding
	 *
	 * @return string
	 */
	public static function utf8Decode( $str, $to = 'windows-1252' ) {
		if ( extension_loaded( 'iconv' ) ) {
			return iconv( 'UTF-8', $to, $str );
		}

		return utf8_decode( $str );
	}

	/**
	 * Encode a string from a $from encoding to utf-8
	 *
	 * @param string $str
	 *
	 * @param string $from source encoding
	 *
	 * @return string
	 */
	public static function utf8Encode( $str, $from = 'windows-1252' ) {
		if ( extension_loaded( 'iconv' ) ) {
			return iconv( $from, 'UTF-8', $str );
		}

		return utf8_encode( $str );
	}
}