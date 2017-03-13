<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 06/03/2017
 * Time: 17:08
 */

namespace App\Http\Requests;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exception\HttpResponseException;

abstract class BaseFormRequest extends FormRequest
{
    /**
     * @param Validator $validator
     *
     * @return mixed|void
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()
                ->back()
                ->withInput()
                ->withErrors($validator)
        );
    }

    /**
     * @return bool
     */
    abstract function authorize();

    /**
     * @return array
     */
    abstract function rules();
}