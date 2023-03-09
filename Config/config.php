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
        'Activity'=>[
            'icon'=>'heroicon-o-cube',
            'name'=>'activities',
        ],
        'User'=>[
            'icon'=>'heroicon-o-cube',
            'name'=>'users',
        ],
        'Permission'=>[
            'icon'=>'heroicon-o-cube',
            'name'=>'permissions',
        ],
        'Role'=>[
            'icon'=>'heroicon-o-cube',
            'name'=>'roles',
        ],
        'Module'=>[
            'icon'=>'heroicon-o-cube',
            'name'=>'modules',
        ],
        'Comment'=>[
            'icon'=>'heroicon-o-chat',
            'name'=>'comments',
        ],
        'Coupon'=>[
            'icon'=>'heroicon-o-gift',
            'name'=>'coupons',
        ],
        'Extra'=>[
            'icon'=>'heroicon-o-view-grid-add',
            'name'=>'extras',
        ],
        'Phone'=>[
            'icon'=>'heroicon-o-phone',
            'name'=>'phones'
        ],
        'Address'=>[
            'icon'=>'heroicon-o-at-symbol',
            'name'=>'addresses',
        ],
        'Rating'=>[
            'icon'=>'heroicon-o-star',
            'name'=>'ratings',
        ],
        'Price'=>[
            'icon'=>'heroicon-o-currency-dollar',
            'name'=>'prices',
        ],
        'Import'=>[
            'icon'=>'heroicon-o-upload',
            'name'=>'imports',
        ],
        'Tag'=>[
            'icon'=>'heroicon-o-tag',
            'name'=>'tags',
        ],
    ],
    'navigation'=>[
        'name'=>'Utilities',
        'enabled'=>true,
    ],
];
