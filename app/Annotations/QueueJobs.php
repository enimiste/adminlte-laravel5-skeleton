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
class QueueJobs extends BaseAnnotation
{

    /** @var  array of @Job */
    public $always;
    /** @var  array of @Job */
    public $sometimes;

}