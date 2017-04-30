<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 25/03/2016
 * Time: 22:11
 */

namespace App\Business\Contracts\Serialization\Formatter;


interface FormatterInterface {

	/**
	 * Format a value to a string, int or float
	 *
	 * @param string|int|float $value
	 *
	 * @return string|int|float
	 */
	function format( $value );
}