<?php

use app\Service\UserService;

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../src/Database/connect.php';

/** @var $database */
$user = new UserService($database);

$token = $_POST['token'];
print_r(json_decode($user->feed($token), true));