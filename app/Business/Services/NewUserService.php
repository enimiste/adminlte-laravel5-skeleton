<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 13/03/2017
 * Time: 21:01
 */

namespace App\Business\Services;


use App\Business\Contracts\BusinessInterface;
use App\Business\Exception\BusinessException;
use App\User;

class NewUserService implements BusinessInterface
{

    /**
     * @param string $name
     * @param string $password
     * @param string $email
     * @return User
     */
    public function register($name, $password, $email)
    {
        try {
            return User::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password),
                'deletable' => true
            ]);
        } catch (\Exception $e) {
            throw BusinessException::from($e);
        }
    }
}