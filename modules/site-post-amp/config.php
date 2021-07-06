<?php

return [
    '__name' => 'site-post-amp',
    '__version' => '0.0.1',
    '__git' => 'git@github.com:getmim/site-post-amp.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'http://iqbalfn.com/'
    ],
    '__files' => [
        'app/site-post-amp' => ['install','remove'],
        'modules/site-post-amp' => ['install','update','remove'],
        'theme/site/post/amp' => ['install','remove']
    ],
    '__dependencies' => [
        'required' => [
            [
                'site-post' => NULL
            ]
        ],
        'optional' => [],
        'composer' => [
            'magyarandras/amp-converter' => '^1.0'
        ]
    ],
    'autoload' => [
        'classes' => [
            'SitePostAmp\\Controller' => [
                'type' => 'file',
                'base' => 'app/site-post-amp/controller'
            ]
        ],
        'files' => []
    ],
    'routes' => [
        'site' => [
            'sitePostAmp' => [
                'path' => [
                    'value' => '/post/amp/(:slug)',
                    'params' => [
                        'slug' => 'slug'
                    ]
                ],
                'method' => 'GET',
                'handler' => 'SitePostAmp\\Controller\\Post::single'
            ]
        ]
    ],
    'libFormatter' => [
        'formats' => [
            'post' => [
                'amp' => [
                    'type' => 'router',
                    'router' => [
                        'name' => 'sitePostAmp',
                        'params' => [
                            'slug' => '$slug'
                        ]
                    ]
                ]
            ]
        ]
    ]
];
