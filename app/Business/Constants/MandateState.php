<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 08/03/2017
 * Time: 14:37
 */

namespace App\Business\Constants;


use App\Business\Constants\Traits\ConstantsTrait;

class MandateState
{
    use ConstantsTrait;

    const PENDING_CUSTOMER_APPROVAL = 'PENDING_CUSTOMER_APPROVAL';
    const PENDING_SUBMISSION = 'PENDING_SUBMISSION';
    const SUBMITTED = 'SUBMITTED';
    const ACTIVE = 'ACTIVE';
    const FAILED = 'FAILED';
    const CANCELLED = 'CANCELLED';
    const EXPIRED = 'EXPIRED';
}