<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param string $type
     * @param string $msg
     */
    public function flash($type, $msg)
    {
        $notices = \Session::get('notices', []);
        $notices[$type] = [$msg];
        \Session::flash('notices', $notices);
    }
}
