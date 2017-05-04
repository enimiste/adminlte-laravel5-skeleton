<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 16/06/2016
 * Time: 13:08
 */

namespace App\Annotations;

/**
 * Class BaseAnnotation
 * @package App\Annotations
 */
abstract class BaseAnnotation {

	/**
	 * ApiDoc constructor.
	 *
	 * @param array $config
	 */
	public function __construct( array $config ) {
		foreach ( $config as $key => $conf ) {
			if ( property_exists( $this, $key ) ) {
				$this->$key = $config;
			}
		}
	}
}