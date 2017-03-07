<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
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

    /**
     * @return int
     */
    public function page_size()
    {
        $page_size = app(Request::class)->get('page_size', env('PAGINATION_PAGE_SIZE', 10));
        return intval($page_size);
    }
}
