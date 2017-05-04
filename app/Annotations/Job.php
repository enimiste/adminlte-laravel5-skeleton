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
class Job extends BaseAnnotation
{
    /** @var  string */
    public $name;
    /** @var  string */
    public $queue;
    /** @var  int|string */
    public $delay;
    /**
     * Specify the extension points when the Job is
     * sometimes dispatched
     *
     * @var  array
     */
    public $whens;
}