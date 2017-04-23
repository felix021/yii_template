<?php

$env_config = require(__DIR__ . '/env/' . $_SERVER['SITE_ENV'] . '.php');


$main_config = [
    'basePath' => dirname(__DIR__),
    'name' => 'Template',

    // preloading 'log' component
    'preload' => ['log'],

    'import' => [
        'application.models.*',
        'application.components.*',
    ],

    // application components
    'components' => [
        'cache'  =>  [
            'class'           =>  'system.caching.CFileCache',
            'directoryLevel'  =>  '2', //缓存文件的目录深度
        ],
    ],

    'params'    => [
        'memory_limit_warning'  => 64, #MB
    ],
];

return CMap::mergeArray($main_config, $env_config);
