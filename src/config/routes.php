<?php
return [
    '' => [
        'class' => 'Blog\Controller\HomeController',
        'method' => 'index'
    ],
    'default' => [
        'class' => 'Blog\Controller\HomeController',
        'method' => 'index'
    ],
    'home' => [
        'class' => 'Blog\Controller\HomeController',
        'method' => 'index'
    ],
    'login' => [
        'class' => 'Blog\Controller\LoginController',
        'method' => 'index'
    ],
    'logout' => [
        'class' => 'Blog\Controller\LogoutController',
        'method' => 'index'
    ],
    'edit-post' => [
        'class' => 'Blog\Controller\Post\EditController',
        'method' => 'process'
    ],
    'post' => [
        'class' => 'Blog\Controller\Post\DetailsController',
        'method' => 'details'
    ],
    'delete-post' => [
        'class' => 'Blog\Controller\Post\DeleteController',
        'method' => 'delete'
    ]
];
