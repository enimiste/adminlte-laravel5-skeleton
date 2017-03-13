<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 13/03/2017
 * Time: 21:05
 */

namespace App\Http\Requests;


class NewUserRequest extends BaseFormRequest
{

    /**
     * @return bool
     */
    function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->input('name');
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->input('email');
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->input('password');
    }
}