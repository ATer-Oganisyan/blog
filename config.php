<?php

$config = [

    'routing' => [
        '/' => [
            'method' => 'GET',
            'controller' => 'post',
            'action' => 'listAction',
            'template' => 'blog/list.tpl.php',
            'context' => 'html'
        ],

        '/post/' => [
            'method' => 'GET',
            'controller' => 'post',
            'action' => 'showAction',
            'template' => 'blog/show.tpl.php',
            'context' => 'html'
        ],

        '/postcreate/' => [
            'method' => 'POST',
            'controller' => 'post',
            'action' => 'addAction',
            'context' => 'json'
        ],

        '/comment/' => [
            'method' => 'GET',
            'controller' => 'comment',
            'action' => 'listAction',
            'context' => 'json'
        ],

        '/comment/create/' => [
            'method' => 'POST',
            'controller' => 'comment',
            'action' => 'addAction',
            'context' => 'json',
        ],

        '/login/' => [
            'method' => 'GET',
            'controller' => 'auth',
            'template' => 'auth/main.tpl.php',
            'action' => 'authAction',
            'context' => 'html'
        ],

        '/auth/' => [
            'method' => 'POST',
            'controller' => 'auth',
            'action' => 'authAction',
            'context' => 'json'
        ],
    ],




    'db_connections' => [
        'default' => [
            'host' => 'localhost',
            'db' => 'blog',
            'user' => 'blog_rw',
            'password' => 'qwerty12345'
        ]
    ],

    'modules' => [
        'blog' => [
            'db_connection' => 'default',
            'string_length' => 50,
            'text_length'   => 5000,
            'simple_string_regexp' => '/[a-zA-z0-9_\s](5, 20)/',
            'posts_num_per_page' => 10,
            'comments_num_per_page' => 10
        ],
    ],

    'security' => [
        'refersh_user_by_every_request' => 0,
        'auth_type' => 'basic',
        'auth_redirect' => '/',
        'auth_page' => '/login/'
    ],




];