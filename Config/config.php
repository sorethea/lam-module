<?php

return [
    'name' => 'Laravel Admin Module',
    'cache' => [
        'enabled' => false,
        'driver' => 'file',
        'key' => 'lam-modules',
        'lifetime' => 60,
    ],
    'installer'=>[
        'file'=>[
            'path' => base_path('installed_modules.json'),
            'class' => \Modules\LAM\Contracts\FileInstaller::class,
            'cache-key' => 'installer-file',
            'cache-lifetime' => 604800,
        ]
    ],

    'system-navigation'=>[
       'name'=>'System',
        'enabled'=>true,
    ],
    'models'=>[
        'Module'=>[
            'icon'=>'heroicon-o-cube'
        ],
        'Comment'=>[
            'icon'=>'heroicon-o-chat'
        ],
        'Coupon'=>[
            'icon'=>'heroicon-o-gift'
        ],
        'Extra'=>[
            'icon'=>'heroicon-o-view-grid-add'
        ],
        'Phone'=>[
            'icon'=>'heroicon-o-phone'
        ],
        'Address'=>[
            'icon'=>'heroicon-o-at-symbol'
        ],
        'Rating'=>[
            'icon'=>'heroicon-o-star'
        ],
        'Price'=>[
            'icon'=>'heroicon-o-currency-dollar'
        ],
        'Import'=>[
            'icon'=>'heroicon-o-upload'
        ],
        'Tag'=>[
            'icon'=>'heroicon-o-tag'
        ],
    ],
    'navigation'=>[
        'name'=>'Utilities',
        'enabled'=>true,
    ],
];
