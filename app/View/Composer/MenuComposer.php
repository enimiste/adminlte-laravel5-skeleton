<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 19/11/16
 * Time: 17:10
 */

namespace App\View\Composer;


use App\Menu\BackEndMenu;
use Illuminate\Contracts\View\View;

class MenuComposer
{
    /**
     * @var BackEndMenu
     */
    private $backendMenu;

    public function __construct(BackEndMenu $backendMenu)
    {
        $this->backendMenu = $backendMenu;
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('back_menu', $this->backendMenu->get());
    }
}