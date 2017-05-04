<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 31/01/2016
 * Time: 13:20
 */

namespace App\Annotations;

/**
 * Class ApiDoc
 * @package App\Annotations
 *
 * @Annotation
 */
class ApiDoc extends BaseAnnotation
{

    /** @var  string */
    public $method;
    /** @var  array json object */
    public $input;
    /** @var  array json object */
    public $output;
    /**
     * Http code returned by the api
     *
     * @var  array of integers
     */
    public $statusCode;
    /** @var  string */
    public $url;
    /** @var  array */
    public $urlParams;
    /** @var  array */
    public $inputMetaData = [];
    /** @var  array */
    public $outputMetaData = [];
    /** @var  string */
    protected $description;
    /** @var array */
    protected $headers = [];
    /** @var array */
    protected $headersMetaData = [];

}