<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 30/04/17
 * Time: 21:25
 */

namespace App\Business\Contracts\Filter;


interface CustomAdvancedSearchInterface extends AdvancedSearchEngineInterface
{
    //It will be implemented and used to inject specific search engine.
}