<?php

require __DIR__ . '/../Database/connect.php';
require __DIR__ . '/../../vendor/autoload.php';

use app\Service\UserService;

$fields = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
];

/** @var $database */
$user = new UserService($database);
print_r($user->register($fields['email'], $fields['password']));
