<?php

use yii\caching\DummyCache;
use yii\web\JsonParser;
use yii\web\Response;

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'components' => [
        'cache' => [
            'class' => DummyCache::class,
        ],
        'response' => [
            'format' => Response::FORMAT_JSON
        ],
        'request' => [
            'enableCsrfValidation' => false,
            'parsers' => [
                'application/json' => JsonParser::class
            ]
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => require_once __DIR__ . '/rules.php',
        ],
        'user' => [
            'identityClass' => '',
        ]
    ]
];
