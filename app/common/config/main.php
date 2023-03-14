<?php

use domain\repository\AuthorInterface as AuthorRepositoryInterface;
use domain\repository\GenreInterface as GenreRepositoryInterface;
use domain\repository\BookInterface as BookRepositoryInterface;
use infrastructure\repository\author\Author as AuthorRepository;
use infrastructure\repository\genre\Genre as GenreRepository;
use infrastructure\repository\book\Book as BookRepository;
use yii\log\FileTarget;
use yii\db\Connection;

return [
    'vendorPath' => dirname(__DIR__, 2) . '/vendor',
    'bootstrap' => ['log'],
    'components' => [
        'db' => [
            'class' => Connection::class,
            'dsn' => 'mysql:host=' . getenv('MYSQL_DB_HOST') . ';dbname=' . getenv('MYSQL_BASE_NAME'),
            'username' => getenv('MYSQL_USER_NAME'),
            'password' => getenv('MYSQL_PASSWORD'),
            'charset' => 'utf8',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => FileTarget::class,
                    'levels' => ['error', 'warning'],
                    'logFile' => '@api/logs/app.log',
                    'logVars' => []
                ],
            ],
        ],
    ],
    'container' => [
        'definitions' => [
            AuthorRepositoryInterface::class => AuthorRepository::class,
            GenreRepositoryInterface::class => GenreRepository::class,
            BookRepositoryInterface::class => BookRepository::class
        ]
    ],
];
