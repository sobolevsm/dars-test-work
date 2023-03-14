<?php

use yii\web\GroupUrlRule;

return [
    [
        'class' => GroupUrlRule::class,
        'prefix' => 'admin',
        'rules' => [
            'POST    author'          => 'author/create/author-create/index',
            'GET     author'          => 'author/read/author-list/index',
            'GET     author/<id:\d+>' => 'author/read/author-view/index',
            'PUT     author/<id:\d+>' => 'author/update/author-update/index',
            'DELETE  author/<id:\d+>' => 'author/delete/author-delete/index',

            'POST    genre'          => 'genre/create/genre-create/index',
            'GET     genre'          => 'genre/read/genre-list/index',
            'GET     genre/<id:\d+>' => 'genre/read/genre-view/index',
            'PUT     genre/<id:\d+>' => 'genre/update/genre-update/index',
            'DELETE  genre/<id:\d+>' => 'genre/delete/genre-delete/index',

            'POST    book'          => 'book/create/book-create/index',
            'GET     book'          => 'book/read/book-list/index',
            'GET     book/<id:\d+>' => 'book/read/book-view/index',
            'PUT     book/<id:\d+>' => 'book/update/book-update/index',
            'DELETE  book/<id:\d+>' => 'book/delete/book-delete/index',
        ],
    ],
    'POST  book' => 'book/book-list/index',
];
