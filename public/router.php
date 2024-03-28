<?php

switch ($_SERVER['REQUEST_URI']) {
    case '':
    case '/':
        require_once __DIR__ . '/view/index.php';
        break;
    case '/register':
        require_once __DIR__ . '/../src/operations/create_user.php';
        break;
    case '/authorize':
        require_once __DIR__. '/../src/operations/auth_user.php';
        break;
    case '/feed':
        require __DIR__ . '/../src/operations/feed.php';
        break;
}
