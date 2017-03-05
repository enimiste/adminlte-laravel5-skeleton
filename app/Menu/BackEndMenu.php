<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 19/11/16
 * Time: 17:09
 */

namespace App\Menu;


use Knp\Menu\MenuItem;

class BackEndMenu
{

    /**
     * @return MenuItem
     */
    public function get()
    {
        /** @var MenuItem $menu */
        $menu = \Menu::create('main-menu', [
            'attributes' => ['class' => 'sidebar-menu'],
            'childrenAttributes' => ['class' => 'treeview']
        ]);

        /*
         * Model :
         * $menu->addChild('Title', [
         *   'uri' => null,
         *   'label' => null,
         *   'attributes' => array(),
         *   'linkAttributes' => array(),
         *   'childrenAttributes' => array(),
         *   'labelAttributes' => array(),
         *   'extras' => array(),
         *   'current' => null,
         *   'display' => true,
         *   'displayChildren' => true,
         *  ]);
         */
        $menu->addChild('menu-item-1', [
            'label' => 'Menu 1',
            'uri' => route('home_page'),
            'extras' => [
                'icon' => 'fa fa-files-o',
                'current' => true,
                'routes' => [
                    ['route' => 'home_page'],
                ]
            ]
        ]);
        $menu->addChild('Menu 2', [
            'uri' => route('home_page'),
            'extras' => [
                'icon' => 'fa fa-files-o',
            ]
        ]);

        $menu->addChild('Open in new tab', [
            'uri' => route('home_page'),
            'linkAttributes' => [
                'target' => '_blank',
            ],
            'extras' => [
                'icon' => 'fa fa-files-o',
            ]
        ]);


        return $menu;
    }
}