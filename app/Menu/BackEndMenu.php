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
        $m3 = $menu->addChild('Utilisateurs', [
            'uri' => '#',
            'extras' => [
                'icon' => 'fa fa-users',
                'routes' => [
                    ['route' => 'users_list'],
                    ['route' => 'users_logs'],
                ]
            ]
        ]);

        $m3->addChild('Ajouter un nouvel user', [
            'uri' => route('users_list'),
            'extras' => [
                'icon' => 'fa fa-user',
                'routes' => [
                ]
            ]
        ]);

        $m3->addChild('Historique des actions', [
            'uri' => route('users_logs'),
            'extras' => [
                'icon' => 'fa fa-user',
                'routes' => [
                ]
            ]
        ]);


        return $menu;
    }
}