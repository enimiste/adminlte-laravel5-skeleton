<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 02/04/17
 * Time: 11:53
 */
namespace Org\Asso\Business\Validators;

interface FakeEmailCheckerInterface
{
    /**
     * Checks if a given email address is a fake one or not
     *
     * @param string $email
     * @return bool true if the email is valid, false otherwise
     */
    public function check($email);
}