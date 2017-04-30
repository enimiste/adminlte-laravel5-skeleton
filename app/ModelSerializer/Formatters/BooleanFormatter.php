<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 25/03/2016
 * Time: 22:13
 */

namespace App\ModelSerializer\Formatters;

use App\Business\Contracts\Serialization\Formatter\FormatterInterface;

class BooleanFormatter implements FormatterInterface {

	/**
	 * Format a value to a string, int or float
	 *
	 * @param string|int|float $value
	 *
	 * @return string|int|float
	 */
	function format( $value ) {
		if ( is_bool( $value ) ) {
			return $value ? 1 : 0;
		}

		return $value;
	}
}