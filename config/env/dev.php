<?php

return [
    'modules' => [
        'gii' => [
            'class'          => 'system.gii.GiiModule',
            'password'       => '123456',
            'ipFilters'      => ['*'],
            'generatorPaths' => ['bootstrap.gii'],
        ],
    ],
    'components' => [
        'db' => [
            'connectionString' => 'mysql:host=localhost;dbname=test',
            'emulatePrepare'   => true,
            'username'         => 'root',
            'password'         => '123456',
            'charset'          => 'utf8',
        ],
        'log' => [
            'class' => 'CLogRouter',
            'routes' => [
                [
                    'class'         => 'CFileLogRoute',
                    'levels'        => 'trace, info, error, warning',
                    'maxFileSize'   => 262144, #KB
                ],
            ],
        ],
    ],
];
