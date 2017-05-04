<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 16/06/2016
 * Time: 13:06
 */

namespace App\Annotations;

/**
 * Class FiresEvents
 * @package App\Annotations
 *
 * @Annotation
 */
class FiresEvents extends BaseAnnotation
{

    /** @var  array */
    public $always;
    /** @var  array */
    public $sometimes;
    /**
     * Specify the extension points when the Event is
     * sometimes fired
     *
     * @var  array
     */
    public $whens;

}