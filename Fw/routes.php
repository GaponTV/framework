<?php
$routes = [
    [
        'condition' => '#^/news/([0-9]+)/([0-9]+)/#',
        'rule' => 'sid=$default&id=$2',
        'path' => "/news/index.php"
    ]
];