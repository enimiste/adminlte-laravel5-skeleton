<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Rendering options
    |--------------------------------------------------------------------------
    |
    | For more information see: https://github.com/KnpLabs/KnpMenu/blob/master/doc/01-Basic-Menus.markdown#other-rendering-options
    |
    */

    'render' => [
        //required
        'default' => [
            'depth' => null,
            'currentAsLink' => true,
            'currentClass' => 'active',
            'ancestorClass' => 'current_ancestor',
            'firstClass' => 'treeview',
            'lastClass' => '',
            'compressed' => false,
            'allow_safe_labels' => false,
            'clear_matcher' => true
        ],
        'front' => [
            'depth' => null,
            'currentAsLink' => true,
            'currentClass' => 'active',
            'ancestorClass' => 'current_ancestor',
            'firstClass' => 'treeview',
            'lastClass' => '',
            'compressed' => false,
            'allow_safe_labels' => false,
            'clear_matcher' => true
        ],
    ]
];
